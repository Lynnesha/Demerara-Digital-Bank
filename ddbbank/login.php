<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';
// An authenticated visitor does not need to see the login form again.
if (is_logged_in()) redirect_to('dashboard.php');

$error = '';
$identity = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Keep the submitted identifier visible, but never retain a password in the HTML response.
    $identity = trim((string) ($_POST['identity'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    if (!verify_csrf()) {
        $error = 'Your form session has expired. Please try again.';
    } elseif ($identity === '' || $password === '') {
        $error = 'Enter both your username or email and password.';
    } else {
        // Search with a prepared statement so supplied credentials are always treated as data.
        $user = db()->prepare('SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1');
        $user->execute([$identity, $identity]);
        $record = $user->fetch();
        // password_verify compares against the one-way hash stored during registration.
        if ($record && password_verify($password, $record['password'])) {
            login_user($record);
            redirect_to('dashboard.php');
        }
        $error = 'The username/email or password you entered is not recognised.';
    }
}
$pageTitle = 'Log In';
require __DIR__ . '/includes/header.php';
?>
<section class="auth-layout login-layout"><div class="auth-side"><p class="eyebrow">Customer portal</p><h1>Welcome back to your financial view.</h1><p>Log in to explore the DDB academic prototype. Use the preloaded demonstration profile or create your own.</p><div class="demo-login"><strong>Demonstration login</strong><span>Username: <code>amara.doe</code></span><span>Password: <code>DemoPass!2026</code></span></div></div><section class="auth-card compact"><p class="eyebrow">Log in securely</p><h2>Customer portal</h2><?php if ($error): ?><div class="form-alert" role="alert"><?= e($error) ?></div><?php endif; ?><form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><div><label for="identity">Username or email</label><input id="identity" name="identity" autocomplete="username" value="<?= e($identity) ?>" required></div><div><label for="password">Password</label><input id="password" type="password" name="password" autocomplete="current-password" required></div><div class="form-row"><label class="checkbox-label"><input type="checkbox" name="remember"> <span>Remember me</span></label><a href="#forgot-password" class="text-action">Forgot password?</a></div><button class="button button-full" type="submit">Log in</button><p class="form-footnote">New to DDB? <a href="register.php">Open an account</a></p></form><p id="forgot-password" class="small-note">Password recovery is a non-functional interface element in this academic prototype.</p></section></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
