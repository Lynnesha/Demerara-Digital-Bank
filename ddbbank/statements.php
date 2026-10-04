<?php
// Protected statements page: presents fictional monthly statements for the academic banking prototype.
declare(strict_types=1);
require_once __DIR__ . '/includes/auth.php'; require_login();
$pageTitle = 'Statements'; $portal = true; require __DIR__ . '/includes/header.php';
$statements = [['September 2026', 'Sep 1–30', 'ddb-statement-2026-09.pdf'], ['August 2026', 'Aug 1–31', 'ddb-statement-2026-08.pdf'], ['July 2026', 'Jul 1–31', 'ddb-statement-2026-07.pdf']];
?>
<section class="portal-shell"><div class="portal-welcome"><div><p class="eyebrow">Bank statements</p><h1>Your records, ready when you need them.</h1><p>These downloadable sample statements are provided for the academic prototype only.</p></div></div><section class="statements-card"><div class="statement-header"><span>Statement</span><span>Period</span><span>Action</span></div><?php foreach ($statements as [$name, $period, $file]): ?><div class="statement-row"><div><span class="document-icon" aria-hidden="true">▤</span><strong><?= e($name) ?></strong></div><span><?= e($period) ?></span><div><a class="text-action" href="statements/<?= e($file) ?>" target="_blank" rel="noopener">View</a><a class="button button-small" href="statements/<?= e($file) ?>" download>Download</a></div></div><?php endforeach; ?></section></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
