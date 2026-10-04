<?php
// Shared site header: outputs common metadata, branding and responsive navigation across DDB pages.
declare(strict_types=1);
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/helpers.php';

$pageTitle = $pageTitle ?? 'Demerara Digital Bank';
$portal = $portal ?? false;
$currentPage = basename($_SERVER['PHP_SELF'] ?? 'index.php');
$flash = take_flash();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Demerara Digital Bank academic website prototype using fictional demonstration data.">
    <title><?= e($pageTitle) ?> | Demerara Digital Bank</title>
    <link rel="icon" type="image/svg+xml" href="images/ddb-mark.svg">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="<?= $portal ? 'portal-body' : 'public-body' ?>">
<a class="skip-link" href="#main-content">Skip to main content</a>
<header class="site-header <?= $portal ? 'portal-header' : '' ?>">
    <div class="nav-shell">
        <a class="brand" href="<?= $portal ? 'dashboard.php' : 'index.php' ?>" aria-label="Demerara Digital Bank home">
            <span class="brand-mark" aria-hidden="true">D</span>
            <span><strong>Demerara</strong><small>Digital Bank</small></span>
        </a>
        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu">
            <span class="sr-only">Toggle navigation</span><span></span><span></span><span></span>
        </button>
        <?php if ($portal): ?>
            <nav id="primary-menu" class="primary-nav portal-nav" aria-label="Customer portal">
                <a <?= active_link('dashboard.php', $currentPage) ?> href="dashboard.php">Dashboard</a>
                <a <?= active_link('accounts.php', $currentPage) ?> href="accounts.php">Accounts</a>
                <a <?= active_link('transactions.php', $currentPage) ?> href="transactions.php">Transactions</a>
                <a <?= active_link('transfer.php', $currentPage) ?> href="transfer.php">Transfer</a>
                <a <?= active_link('statements.php', $currentPage) ?> href="statements.php">Statements</a>
                <a <?= active_link('portfolio.php', $currentPage) ?> href="portfolio.php">Investments</a>
                <a <?= active_link('profile.php', $currentPage) ?> href="profile.php">Profile</a>
                <a class="logout-link" href="logout.php">Log out</a>
            </nav>
        <?php else: ?>
            <nav id="primary-menu" class="primary-nav" aria-label="Primary navigation">
                <a <?= active_link('index.php', $currentPage) ?> href="index.php">Home</a>
                <a <?= active_link('personal-banking.php', $currentPage) ?> href="personal-banking.php">Personal</a>
                <a <?= active_link('business.php', $currentPage) ?> href="business.php">Business</a>
                <a <?= active_link('investments.php', $currentPage) ?> href="investments.php">Investments</a>
                <a <?= active_link('calculator.php', $currentPage) ?> href="calculator.php">Learn</a>
                <a href="index.php#about">About</a>
            </nav>
            <div class="nav-actions">
                <?php if (is_logged_in()): ?>
                    <a class="text-action" href="dashboard.php">Dashboard</a>
                <?php else: ?>
                    <a class="text-action" href="login.php">Log in</a>
                <?php endif; ?>
                <a class="button button-small" href="register.php">Open an account</a>
            </div>
        <?php endif; ?>
    </div>
</header>
<?php if ($flash): ?>
<div class="notice-wrap"><div class="notice notice-<?= e($flash['type']) ?>" role="status"><?= e($flash['message']) ?></div></div>
<?php endif; ?>
<main id="main-content">
