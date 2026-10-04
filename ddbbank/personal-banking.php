<?php
// Public personal-banking page: presents DDB account, card, lending and mortgage options.
$pageTitle = 'Personal Banking';
require_once __DIR__ . '/includes/header.php';
$products = [
    ['Savings Account', 'Give your goals a dedicated place to grow.', ['No monthly maintenance fee', 'Interest paid on eligible balances', 'Easy transfers from chequing'], 'Save with intention'],
    ['Chequing Account', 'A reliable account for the money you use every day.', ['Secure debit card access', 'Bill payment controls', 'Clear transaction history'], 'Manage everyday money'],
    ['Debit Card', 'Spend with a simple view of every purchase and payment.', ['Card controls in your portal', 'Contactless-ready demo experience', 'Transaction alerts interface'], 'Explore card features'],
    ['Personal Loan', 'A structured way to imagine funding a major next step.', ['Fixed repayment illustration', 'Transparent rate examples', 'Clear application pathway'], 'View loan options'],
    ['Mortgage', 'Start shaping the path toward a place of your own.', ['Mortgage education', 'Planning calculator connection', 'Specialist conversation prompt'], 'Explore mortgage planning'],
];
?>
<section class="page-hero page-hero-green"><div><p class="eyebrow">Personal banking</p><h1>Your money, <em>on your terms.</em></h1><p>Practical accounts and financial tools designed to make everyday decisions feel more considered.</p></div><aside class="hero-note"><span>Fictional demonstration</span><strong>Every product shown here is part of an academic prototype.</strong></aside></section>
<section class="section"><div class="section-heading narrow"><p class="eyebrow">Find your fit</p><h2>Five ways to make banking feel more useful.</h2></div><div class="product-list">
<?php foreach ($products as $index => [$name, $description, $benefits, $action]): ?>
<article class="product-row"><div class="product-index">0<?= $index + 1 ?></div><div><h3><?= e($name) ?></h3><p><?= e($description) ?></p></div><ul><?php foreach ($benefits as $benefit): ?><li><?= e($benefit) ?></li><?php endforeach; ?></ul><div class="product-actions"><a class="text-action" href="register.php">Learn more</a><a class="button button-small" href="register.php"><?= e($action) ?></a></div></article>
<?php endforeach; ?>
</div></section>
<section class="info-strip"><div><p class="eyebrow">One clear place to start</p><h2>Open an account for the way you live now.</h2></div><a class="button button-light" href="register.php">Open an account →</a></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
