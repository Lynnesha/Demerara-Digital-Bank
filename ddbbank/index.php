<?php
// Public homepage: introduces DDB services and provides primary navigation to account access and financial products.
$pageTitle = 'Bank. Invest. Build Your Future.';
require_once __DIR__ . '/includes/header.php';
?>
<section class="hero-section">
    <div class="hero-content">
        <p class="eyebrow">Demerara Digital Bank</p>
        <h1>Bank. Invest.<br><em>Build Your Future.</em></h1>
        <p class="hero-copy">A more confident way to manage everyday money, invest with intent and shape the life you want — all in one clear digital experience.</p>
        <div class="button-row">
            <a class="button" href="register.php">Open an account <span aria-hidden="true">→</span></a>
            <a class="button button-outline" href="personal-banking.php">Explore banking</a>
        </div>
        <div class="trust-line"><span class="trust-dot" aria-hidden="true"></span> Built for clarity. Secured for your journey.</div>
    </div>
    <div class="hero-visual" aria-label="Illustration of a fictional DDB account balance">
        <div class="orbit orbit-one"></div><div class="orbit orbit-two"></div>
        <div class="debit-card">
            <div class="card-top"><span>DDB / CHEQUING</span><span>•••</span></div>
            <div class="card-chip"></div>
            <p class="card-balance">$8,420.75</p>
            <div class="card-bottom"><span>DEMO MEMBER</span><span>4823</span></div>
        </div>
        <div class="floating-stat stat-growth"><span>Portfolio growth</span><strong>+8.4%</strong><small>This year</small></div>
        <div class="floating-stat stat-safe"><span class="shield" aria-hidden="true">✓</span><p><strong>Your money, in view</strong><br><small>Security by design</small></p></div>
    </div>
</section>
<section class="feature-ribbon" aria-label="DDB service highlights">
    <div><span class="feature-icon">↗</span><p><strong>Everyday banking</strong><br>Built around your routines</p></div>
    <div><span class="feature-icon">◇</span><p><strong>Investment access</strong><br>Make your money work harder</p></div>
    <div><span class="feature-icon">⌁</span><p><strong>Human guidance</strong><br>When a plan needs perspective</p></div>
</section>
<section class="section split-intro">
    <div><p class="eyebrow">Banking that follows your lead</p><h2>Every financial chapter deserves a better starting point.</h2></div>
    <div><p>Whether you are setting foundations, running a growing business or planning what comes next, DDB brings your everyday banking and long-term goals into focus.</p><a class="inline-link" href="personal-banking.php">Find the right account <span aria-hidden="true">→</span></a></div>
</section>
<section class="service-showcase" aria-label="DDB services">
    <article class="service-panel personal-panel"><p class="eyebrow">01 / Personal banking</p><h3>Money that moves with your life.</h3><p>Save, spend and plan with accounts made for practical momentum.</p><a href="personal-banking.php">Explore personal banking <span aria-hidden="true">→</span></a></article>
    <article class="service-panel business-panel"><p class="eyebrow">02 / Business banking</p><h3>Big plans need a strong operating account.</h3><p>Build a more organised financial base for every business day.</p><a href="business.php">Explore business banking <span aria-hidden="true">→</span></a></article>
    <article class="service-panel invest-panel"><p class="eyebrow">03 / Investment services</p><h3>Turn today’s decisions into tomorrow’s potential.</h3><p>Explore a clear view of funds, bonds and stock-based investing.</p><a href="investments.php">Explore investments <span aria-hidden="true">→</span></a></article>
    <article class="service-panel wealth-panel"><p class="eyebrow">04 / Wealth management</p><h3>Bring your ambitions into one conversation.</h3><p>Thoughtful guidance for the goals that deserve a longer view.</p><a href="calculator.php">Plan your growth <span aria-hidden="true">→</span></a></article>
</section>
<section id="security" class="security-band">
    <div class="security-symbol" aria-hidden="true">⌾</div>
    <div><p class="eyebrow">Digital banking, thoughtfully protected</p><h2>Your information should feel as secure as your ambitions.</h2><p>DDB’s prototype demonstrates secure sessions, protected portal pages, password hashing and careful input validation. It uses fictional data only and does not process real transactions.</p><a class="button button-light" href="login.php">Visit customer portal</a></div>
</section>
<section class="section tools-section">
    <div class="section-heading"><p class="eyebrow">Build with intention</p><h2>Useful tools for the road ahead.</h2></div>
    <div class="tool-cards">
        <a class="tool-card" href="calculator.php"><span class="tool-number">01</span><h3>Investment Growth Calculator</h3><p>See how regular contributions can influence a future balance.</p><span class="inline-link">Calculate growth →</span></a>
        <a class="tool-card" href="investments.php"><span class="tool-number">02</span><h3>Investment Explorer</h3><p>Learn the basics of stocks, bonds and diversified funds.</p><span class="inline-link">Explore options →</span></a>
        <a class="tool-card" href="register.php"><span class="tool-number">03</span><h3>Open a Demo Account</h3><p>Experience the academic prototype customer journey for yourself.</p><span class="inline-link">Begin the journey →</span></a>
    </div>
</section>
<section id="about" class="closing-cta"><p class="eyebrow">Designed for what’s next</p><h2>Ready to put your future in focus?</h2><a class="button" href="register.php">Open an account <span aria-hidden="true">→</span></a></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
