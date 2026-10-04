<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';

$errors = [];
$values = ['first_name' => '', 'last_name' => '', 'email' => '', 'phone' => '', 'date_of_birth' => '', 'account_type' => 'Chequing', 'username' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preserve trimmed form values so a visitor does not have to retype valid fields after an error.
    foreach ($values as $key => $value) {
        $values[$key] = trim((string) ($_POST[$key] ?? $value));
    }
    $password = (string) ($_POST['password'] ?? '');
    $confirmPassword = (string) ($_POST['confirm_password'] ?? '');
    $types = ['Savings', 'Chequing', 'Investment'];

    // Server-side validation remains essential even though the browser provides immediate feedback.
    if (!verify_csrf()) $errors['general'] = 'Your form session has expired. Please try again.';
    if (!preg_match("/^[a-zA-ZÀ-ÿ' -]{2,60}$/", $values['first_name'])) $errors['first_name'] = 'Enter a valid first name.';
    if (!preg_match("/^[a-zA-ZÀ-ÿ' -]{2,60}$/", $values['last_name'])) $errors['last_name'] = 'Enter a valid last name.';
    if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Enter a valid email address.';
    if (strlen(preg_replace('/[^0-9+]/', '', $values['phone'])) < 7) $errors['phone'] = 'Enter a valid telephone number.';
    if (!$values['date_of_birth'] || strtotime($values['date_of_birth']) > strtotime('-18 years')) $errors['date_of_birth'] = 'You must be at least 18 years old for this demonstration account.';
    if (!in_array($values['account_type'], $types, true)) $errors['account_type'] = 'Choose a valid account type.';
    if (!preg_match('/^[a-zA-Z0-9_.-]{4,40}$/', $values['username'])) $errors['username'] = 'Use 4–40 letters, numbers, dots, dashes or underscores.';
    if (strlen($password) < 8) $errors['password'] = 'Use at least 8 characters for your password.';
    if ($password !== $confirmPassword) $errors['confirm_password'] = 'Passwords do not match.';

    if (!$errors) {
        try {
            $pdo = db();
            // Prepared parameters prevent submitted email and username text from becoming SQL syntax.
            $lookup = $pdo->prepare('SELECT id FROM users WHERE email = ? OR username = ? LIMIT 1');
            $lookup->execute([$values['email'], $values['username']]);
            if ($lookup->fetch()) {
                $errors['general'] = 'That email address or username is already in use.';
            } else {
                // Create the customer record and its initial fictional account as one all-or-nothing operation.
                $pdo->beginTransaction();
                $insert = $pdo->prepare('INSERT INTO users (first_name, last_name, email, phone, date_of_birth, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)');
                $insert->execute([$values['first_name'], $values['last_name'], $values['email'], $values['phone'], $values['date_of_birth'], $values['username'], password_hash($password, PASSWORD_DEFAULT)]);
                $userId = (int) $pdo->lastInsertId();
                $accountNumber = '4048' . str_pad((string) random_int(10000000, 99999999), 8, '0', STR_PAD_LEFT) . str_pad((string) random_int(1000, 9999), 4, '0', STR_PAD_LEFT);
                $account = $pdo->prepare('INSERT INTO accounts (user_id, account_number, account_type, balance, status) VALUES (?, ?, ?, 0.00, "Active")');
                $account->execute([$userId, $accountNumber, $values['account_type']]);
                $pdo->commit();
                set_flash('Your DDB demonstration account has been created. Please log in to continue.', 'success');
                redirect_to('login.php');
            }
        } catch (Throwable $exception) {
            // Do not leave an orphaned user record if account creation cannot finish.
            if (isset($pdo) && $pdo->inTransaction()) $pdo->rollBack();
            $errors['general'] = 'We could not create the account at this time. Please check the local database setup.';
        }
    }
}

$pageTitle = 'Open an Account';
require __DIR__ . '/includes/header.php';
?>
<section class="auth-layout"><div class="auth-side"><p class="eyebrow">Join the DDB journey</p><h1>Open a demonstration account.</h1><p>Start the academic prototype experience with an account profile built around fictional data.</p><ul class="check-list"><li>Securely hashed password</li><li>Protected customer portal</li><li>Fictional financial information only</li></ul></div><section class="auth-card"><p class="eyebrow">Open an account</p><h2>Your details</h2><?php if (isset($errors['general'])): ?><div class="form-alert" role="alert"><?= e($errors['general']) ?></div><?php endif; ?><form method="post" data-register-form novalidate><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><div class="form-grid two-columns"><div><label for="first_name">First name</label><input id="first_name" name="first_name" autocomplete="given-name" value="<?= e($values['first_name']) ?>" required aria-describedby="first_name-error"><?php if (isset($errors['first_name'])): ?><p id="first_name-error" class="field-error"><?= e($errors['first_name']) ?></p><?php endif; ?></div><div><label for="last_name">Last name</label><input id="last_name" name="last_name" autocomplete="family-name" value="<?= e($values['last_name']) ?>" required aria-describedby="last_name-error"><?php if (isset($errors['last_name'])): ?><p id="last_name-error" class="field-error"><?= e($errors['last_name']) ?></p><?php endif; ?></div></div><div class="form-grid two-columns"><div><label for="email">Email address</label><input id="email" type="email" name="email" autocomplete="email" value="<?= e($values['email']) ?>" required><?php if (isset($errors['email'])): ?><p class="field-error"><?= e($errors['email']) ?></p><?php endif; ?></div><div><label for="phone">Telephone number</label><input id="phone" name="phone" autocomplete="tel" value="<?= e($values['phone']) ?>" required><?php if (isset($errors['phone'])): ?><p class="field-error"><?= e($errors['phone']) ?></p><?php endif; ?></div></div><div class="form-grid two-columns"><div><label for="date_of_birth">Date of birth</label><input id="date_of_birth" type="date" name="date_of_birth" max="<?= date('Y-m-d', strtotime('-18 years')) ?>" value="<?= e($values['date_of_birth']) ?>" required><?php if (isset($errors['date_of_birth'])): ?><p class="field-error"><?= e($errors['date_of_birth']) ?></p><?php endif; ?></div><div><label for="account_type">Account type</label><select id="account_type" name="account_type"><option <?= $values['account_type'] === 'Savings' ? 'selected' : '' ?>>Savings</option><option <?= $values['account_type'] === 'Chequing' ? 'selected' : '' ?>>Chequing</option><option <?= $values['account_type'] === 'Investment' ? 'selected' : '' ?>>Investment</option></select><?php if (isset($errors['account_type'])): ?><p class="field-error"><?= e($errors['account_type']) ?></p><?php endif; ?></div></div><div class="form-grid two-columns"><div><label for="username">Username</label><input id="username" name="username" autocomplete="username" value="<?= e($values['username']) ?>" required><?php if (isset($errors['username'])): ?><p class="field-error"><?= e($errors['username']) ?></p><?php endif; ?></div><div><label for="password">Password</label><input id="password" type="password" name="password" autocomplete="new-password" minlength="8" required><?php if (isset($errors['password'])): ?><p class="field-error"><?= e($errors['password']) ?></p><?php endif; ?></div></div><div><label for="confirm_password">Confirm password</label><input id="confirm_password" type="password" name="confirm_password" autocomplete="new-password" minlength="8" required><?php if (isset($errors['confirm_password'])): ?><p class="field-error"><?= e($errors['confirm_password']) ?></p><?php endif; ?></div><p id="register-client-error" class="field-error" aria-live="polite"></p><button class="button button-full" type="submit">Create demonstration account</button><p class="form-footnote">Already have an account? <a href="login.php">Log in</a></p></form></section></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
