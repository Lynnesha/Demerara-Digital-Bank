<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';

// Load only accounts owned by the signed-in demonstration customer.
$pdo = db();
$accountStmt = $pdo->prepare('SELECT * FROM accounts WHERE user_id = ? ORDER BY id');
$accountStmt->execute([$_SESSION['user_id']]);
$accounts = $accountStmt->fetchAll();

$errors = [];
$confirmation = null;
$values = ['from_account' => (string)($accounts[0]['id'] ?? ''), 'transfer_type' => 'own', 'recipient' => '', 'to_account' => '', 'amount' => '', 'description' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trim posted fields before applying transfer-specific validation.
    foreach ($values as $key => $value) $values[$key] = trim((string)($_POST[$key] ?? $value));
    $amount = filter_var($values['amount'], FILTER_VALIDATE_FLOAT);
    $target = null;

    if (!verify_csrf()) $errors['general'] = 'Your transfer form has expired. Please try again.';
    $source = null;
    foreach ($accounts as $account) if ((string)$account['id'] === $values['from_account']) $source = $account;
    if (!$source) $errors['from_account'] = 'Choose an account to transfer from.';
    if (!in_array($values['transfer_type'], ['own', 'ddb'], true)) $errors['transfer_type'] = 'Choose a valid transfer type.';
    if ($amount === false || $amount <= 0) $errors['amount'] = 'Enter a transfer amount greater than zero.';
    if (strlen($values['description']) > 180) $errors['description'] = 'Keep the description under 180 characters.';
    if ($values['transfer_type'] === 'own') {
        if ($values['to_account'] === '' || $values['to_account'] === $values['from_account']) $errors['recipient'] = 'Choose a different DDB account to receive the transfer.';
        foreach ($accounts as $account) if ((string)$account['id'] === $values['to_account']) $target = $account;
        if (!$target) $errors['recipient'] = 'Choose one of your DDB accounts.';
    } elseif (strlen($values['recipient']) < 2) $errors['recipient'] = 'Enter the recipient’s name.';
    if ($source && $amount !== false && $amount > (float)$source['balance']) $errors['amount'] = 'The amount exceeds the available demonstration balance.';

    if (!$errors && $source) {
        try {
            // A reference ties the debit and optional credit entries to one simulated transfer.
            $reference = 'DDB-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));
            // Keep balance updates and transaction history atomic: either every required change succeeds or none do.
            $pdo->beginTransaction();
            $debit = $pdo->prepare('UPDATE accounts SET balance = balance - ? WHERE id = ? AND user_id = ?');
            $debit->execute([$amount, $source['id'], $_SESSION['user_id']]);
            $out = $pdo->prepare('INSERT INTO transactions (account_id, transaction_type, description, amount, transaction_date) VALUES (?, "transfer", ?, ?, NOW())');
            $recipientLabel = $values['transfer_type'] === 'own' ? 'your DDB account' : $values['recipient'];
            $out->execute([$source['id'], 'Transfer to ' . $recipientLabel . ($values['description'] ? ' — ' . $values['description'] : '') . ' [' . $reference . ']', -$amount]);
            if ($values['transfer_type'] === 'own') {
                $credit = $pdo->prepare('UPDATE accounts SET balance = balance + ? WHERE id = ? AND user_id = ?');
                $credit->execute([$amount, $target['id'], $_SESSION['user_id']]);
                $in = $pdo->prepare('INSERT INTO transactions (account_id, transaction_type, description, amount, transaction_date) VALUES (?, "transfer", ?, ?, NOW())');
                $in->execute([$target['id'], 'Transfer from ' . $source['account_type'] . ' [' . $reference . ']', $amount]);
            }
            $pdo->commit();
            $confirmation = ['reference' => $reference, 'amount' => $amount, 'recipient' => $recipientLabel];
        } catch (Throwable $exception) {
            // Restore balances if any database operation in the transfer cannot complete.
            if ($pdo->inTransaction()) $pdo->rollBack();
            $errors['general'] = 'The simulated transfer could not be completed. Please try again.';
        }
    }
}

$pageTitle = 'Transfer Money';
$portal = true;
require __DIR__ . '/includes/header.php';
?>
<section class="portal-shell"><div class="portal-welcome"><div><p class="eyebrow">Transfer money</p><h1>Move money with clarity.</h1><p>Transfers in this prototype are simulated only; no real payment is sent.</p></div></div><?php if ($confirmation): ?><section class="confirmation-card" role="status"><span class="confirmation-check" aria-hidden="true">✓</span><p class="eyebrow">Transfer confirmed</p><h2>Your simulated transfer is complete.</h2><p><strong><?= money($confirmation['amount']) ?></strong> was transferred to <?= e($confirmation['recipient']) ?>.</p><p>Reference number: <code><?= e($confirmation['reference']) ?></code></p><div class="button-row"><a class="button" href="transactions.php">View transaction history</a><a class="button button-outline" href="transfer.php">Make another transfer</a></div></section><?php else: ?><section class="transfer-card"><h2>Transfer details</h2><?php if (isset($errors['general'])): ?><div class="form-alert" role="alert"><?= e($errors['general']) ?></div><?php endif; ?><form method="post" data-transfer-form><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><div class="form-grid two-columns"><div><label for="from_account">From account</label><select id="from_account" name="from_account"><?php foreach ($accounts as $account): ?><option value="<?= e((string)$account['id']) ?>" <?= $values['from_account'] === (string)$account['id'] ? 'selected' : '' ?>><?= e($account['account_type']) ?> — <?= e(mask_account($account['account_number'])) ?> (<?= money($account['balance']) ?>)</option><?php endforeach; ?></select><?php if(isset($errors['from_account'])):?><p class="field-error"><?= e($errors['from_account']) ?></p><?php endif; ?></div><div><label for="transfer_type">Transfer type</label><select id="transfer_type" name="transfer_type"><option value="own" <?= $values['transfer_type']==='own'?'selected':'' ?>>Between My Accounts</option><option value="ddb" <?= $values['transfer_type']==='ddb'?'selected':'' ?>>Another DDB Customer</option></select></div></div><div id="own-recipient"><label for="to_account">Recipient account</label><select id="to_account" name="to_account"><option value="">Choose an account</option><?php foreach ($accounts as $account): ?><option value="<?= e((string)$account['id']) ?>" <?= $values['to_account']===(string)$account['id']?'selected':'' ?>><?= e($account['account_type']) ?> — <?= e(mask_account($account['account_number'])) ?></option><?php endforeach; ?></select></div><div id="ddb-recipient" hidden><label for="recipient">Recipient</label><input id="recipient" name="recipient" value="<?= e($values['recipient']) ?>" placeholder="Recipient’s full name"></div><?php if(isset($errors['recipient'])):?><p class="field-error"><?= e($errors['recipient']) ?></p><?php endif; ?><div class="form-grid two-columns"><div><label for="amount">Amount</label><div class="input-with-label"><span>$</span><input id="amount" type="number" name="amount" min="0.01" step="0.01" value="<?= e($values['amount']) ?>" required></div><?php if(isset($errors['amount'])):?><p class="field-error"><?= e($errors['amount']) ?></p><?php endif; ?></div><div><label for="description">Description <span class="optional">(optional)</span></label><input id="description" name="description" maxlength="180" value="<?= e($values['description']) ?>" placeholder="What is this for?"></div></div><button class="button" type="submit">Continue &amp; confirm transfer →</button></form></section><?php endif; ?></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
