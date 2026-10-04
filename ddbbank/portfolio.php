<?php
// Protected investment portfolio page: displays fictional holdings and watchlist information for demonstration purposes.
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';

$symbols = [
    'DDBX' => 'Demerara Equity Fund',
    'CB29' => 'Caribbean Treasury Bond 2029',
    'RGS' => 'Regional Growth Shares',
    'WVC' => 'West Coast Ventures',
];
$_SESSION['watchlist'] = $_SESSION['watchlist'] ?? ['DDBX', 'CB29'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf()) {
    $symbol = (string) ($_POST['symbol'] ?? '');
    $action = (string) ($_POST['watchlist_action'] ?? '');
    if (isset($symbols[$symbol])) {
        if ($action === 'add' && !in_array($symbol, $_SESSION['watchlist'], true)) {
            $_SESSION['watchlist'][] = $symbol;
        }
        if ($action === 'remove') {
            $_SESSION['watchlist'] = array_values(array_filter($_SESSION['watchlist'], fn($item) => $item !== $symbol));
        }
    }
}

$stmt = db()->prepare('SELECT * FROM investments WHERE user_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$holdings = $stmt->fetchAll();
$portfolioValue = array_sum(array_map(fn($holding) => (float) $holding['value'], $holdings));
$pageTitle = 'Investment Portfolio';
$portal = true;
require __DIR__ . '/includes/header.php';
?>
<section class="portal-shell">
    <div class="portal-welcome"><div><p class="eyebrow">Investments dashboard</p><h1>Keep your future in view.</h1><p>All values and performance figures are fictional demonstration data.</p></div><a class="button" href="calculator.php">Use growth calculator →</a></div>
    <section class="portfolio-value"><div><span>Portfolio value</span><strong><?= money($portfolioValue) ?></strong><p><b>+8.2%</b> illustrative year-to-date performance</p></div><div class="allocation-bars" aria-label="Illustrative portfolio allocation"><span class="allocation-funds">Funds</span><span class="allocation-stocks">Stocks</span><span class="allocation-bonds">Bonds</span></div></section>
    <section class="portal-section"><div class="section-heading portal-heading"><div><p class="eyebrow">Sample holdings</p><h2>What’s in your portfolio.</h2></div></div><div class="table-wrap" tabindex="0" role="region" aria-label="Scrollable investment holdings table"><table class="transactions-table"><thead><tr><th>Investment</th><th>Type</th><th class="amount-cell">Value</th><th class="amount-cell">Performance</th></tr></thead><tbody><?php foreach ($holdings as $holding): ?><tr><td><strong><?= e($holding['investment_name']) ?></strong></td><td><?= e($holding['investment_type']) ?></td><td class="amount-cell"><?= money($holding['value']) ?></td><td class="amount-cell amount-credit">+<?= number_format((float) $holding['performance'], 1) ?>%</td></tr><?php endforeach; ?></tbody></table></div></section>
    <section class="portal-section"><div class="section-heading portal-heading"><div><p class="eyebrow">Watchlist</p><h2>Keep an eye on what interests you.</h2></div></div><div class="watchlist-grid"><?php foreach ($symbols as $symbol => $name): $watching = in_array($symbol, $_SESSION['watchlist'], true); ?><article class="watchlist-card"><div><span><?= e($symbol) ?></span><h3><?= e($name) ?></h3><p>Fictional market information</p></div><form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><input type="hidden" name="symbol" value="<?= e($symbol) ?>"><input type="hidden" name="watchlist_action" value="<?= $watching ? 'remove' : 'add' ?>"><button type="submit" class="<?= $watching ? 'button button-outline button-small' : 'button button-small' ?>"><?= $watching ? 'Remove from Watchlist' : 'Add to Watchlist' ?></button></form></article><?php endforeach; ?></div></section>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
