<?php
declare(strict_types=1);

// Detect HTTPS even when the public preview proxy forwards requests to local PHP over HTTP.
function is_secure_request(): bool
{
    $forwarded = strtolower((string) ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ''));
    return $forwarded === 'https'
        || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (int) ($_SERVER['SERVER_PORT'] ?? 80) === 443;
}

function start_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    // Use an HTTP-only cookie and require HTTPS in the public preview to protect the session identifier.
    $secure = is_secure_request();
    session_name('DDBSESSID');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $secure,
        'httponly' => true,
        'samesite' => $secure ? 'None' : 'Lax',
    ]);
    session_start();
}

start_session();

function redirect_to(string $path): never
{
    header("Location: {$path}");
    exit;
}

function is_logged_in(): bool
{
    return isset($_SESSION['user_id']) && is_int($_SESSION['user_id']);
}

// Keep portal routes inaccessible until the session contains a verified customer identifier.
function require_login(): void
{
    if (!is_logged_in()) {
        set_flash('Please log in to access the customer portal.', 'info');
        redirect_to('login.php');
    }
}

function login_user(array $user): void
{
    // Prevent session fixation by assigning a fresh identifier after credentials are verified.
    session_regenerate_id(true);
    $_SESSION['user_id'] = (int) $user['id'];
    $_SESSION['user_name'] = $user['first_name'];
    $_SESSION['logged_in_at'] = time();
}

function logout_user(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        // Expire the browser cookie as well as destroying the server-side session data.
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], (bool) $params['secure'], (bool) $params['httponly']);
    }
    session_destroy();
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        // Store one unpredictable token in the session for state-changing forms.
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf(): bool
{
    $submitted = (string) ($_POST['csrf_token'] ?? '');
    return $submitted !== '' && isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $submitted);
}

function set_flash(string $message, string $type = 'success'): void
{
    $_SESSION['flash'] = ['message' => $message, 'type' => $type];
}

function take_flash(): ?array
{
    // Display a notice exactly once after a redirect.
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return is_array($flash) ? $flash : null;
}
