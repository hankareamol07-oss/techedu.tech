<?php
declare(strict_types=1);
$cfg  = require __DIR__ . '/config.php';
$data = require __DIR__ . '/data/portfolio.php';
require __DIR__ . '/includes/icons.php';

$static = defined('STATIC_BUILD') && STATIC_BUILD;
$sent   = $_GET['sent'] ?? '';
function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

$projects = $data['projects'];
$count = ['web' => 0, 'app' => 0, 'game' => 0];
foreach ($projects as $p) { $count[$p['type']]++; }
$typeLabel = ['web' => 'Website', 'app' => 'Android App', 'game' => 'Web Game'];
$wa = $cfg['whatsapp'] ? 'https://wa.me/' . preg_replace('/\D/', '', $cfg['whatsapp']) . '?text=' . rawurlencode('Hi Amol, I saw your portfolio on techedu.tech and want to discuss a project.') : '';
$title = $cfg['name'] . ' | ' . $cfg['role'] . ' | TechEdu';
$desc  = 'Freelance web, Android app and educational game developer from Sangli, Maharashtra. 200K+ app downloads, Marathi & English websites, news portals, coaching institute sites and school portals.';
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($desc) ?>">
<meta name="keywords" content="freelance web developer Sangli, website developer Maharashtra, Marathi website, Android app developer, educational games, school website, coaching website, news portal developer">
<link rel="canonical" href="<?= e($cfg['site_url']) ?>/">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($desc) ?>">
<meta property="og:url" content="<?= e($cfg['site_url']) ?>/">
<meta property="og:image" content="<?= e($cfg['site_url']) ?>/assets/img/work/krantiwave.jpg">
<meta name="twitter:card" content="summary_large_image">
<meta name="theme-color" content="#060818">
<link rel="icon" href="assets/img/favicon.svg" type="image/svg+xml">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Noto+Sans+Devanagari:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css?v=1">
<script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org', '@type' => 'ProfessionalService',
    'name' => 'TechEdu: ' . $cfg['name'], 'url' => $cfg['site_url'], 'email' => $cfg['email'],
    'description' => $desc, 'areaServed' => 'India',
    'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Sangli', 'addressRegion' => 'Maharashtra', 'addressCountry' => 'IN'],
    'founder' => ['@type' => 'Person', 'name' => $cfg['name'], 'jobTitle' => $cfg['role']],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body>
<div id="loader"><div style="text-align:center"><div class="ld-logo grad-txt">TechEdu</div><div class="ld-bar"><i></i></div></div></div>
<div id="progress"></div>
<canvas id="bgfx"></canvas>
<div class="blob b1"></div><div class="blob b2"></div><div class="blob b3"></div>
<div class="cursor-glow" id="glow"></div>

<header class="nav" id="nav">
  <div class="wrap">
    <a href="#home" class="logo"><span class="logo-mark">TE</span><span>TechEdu<small>BY AMOL HANKARE</small></span></a>
    <button class="burger" id="burger" aria-label="Menu"><?= icon('menu') ?></button>
    <ul class="menu" id="menu">
      <li><a href="#services">Services</a></li>
      <li><a href="#work">Work</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#pricing">Pricing</a></li>
      <li><a href="#faq">FAQ</a></li>
      <li><a href="#contact" class="btn btn-pri btn-sm">Hire Me <?= icon('arrow') ?></a></li>
    </ul>
  </div>
</header>

<main>
<!-- HERO -->
<section class="hero" id="home">
  <div class="wrap">
    <div>
      <span class="badge rv"><span class="dot"></span> Available for freelance projects</span>
      <h1 class="split">I build <span class="grad-txt typed" data-words='["Websites","Android Apps","Learning Games","News Portals","School Portals"]'>Websites</span><br>that people love.</h1>
      <p class="lead rv">Hi, I'm <b><?= e($cfg['name']) ?></b>. I'm a freelance developer from Sangli with apps downloaded <b>200,000+ times</b> on Google Play. I design and build fast, beautiful websites, apps and interactive games for businesses, schools, institutes and media.</p>
      <p class="mr rv">तुमच्या व्यवसायासाठी आकर्षक वेबसाईट, अ‍ॅप आणि गेम्स, मराठी व इंग्रजीत.</p>
      <div class="cta-row rv">
        <a href="#work" class="btn btn-pri">View My Work <?= icon('arrow') ?></a>
        <a href="#contact" class="btn btn-ghost">Get a Free Quote</a>
      </div>
      <div class="trust rv">
        <div><?= icon('download') ?><span><b>200K+</b>downloads</span></div>
        <div><?= icon('globe') ?><span><b><?= $count['web'] + 1 ?>+</b>live sites</span></div>
        <div><?= icon('star') ?><span><b>4.8★</b>top app rating</span></div>
      </div>
    </div>
    <div class="stage rv z" id="stage">
      <div class="device d1" data-depth="18"><div class="bar"><i></i><i></i><i></i><span>krantiwave.in</span></div><img src="assets/img/work/krantiwave.jpg" alt="Kranti WAVE news portal" width="1000" height="625"></div>
      <div class="device d2" data-depth="30"><div class="bar"><i></i><i></i><i></i><span>vijetaacademysangli.in</span></div><img src="assets/img/work/vijeta.jpg" alt="Vijeta Academy website" width="1000" height="625"></div>
      <div class="phone" data-depth="45"><img src="assets/apps/com.techedu.navoday.png" alt="Navodaya app"><b>Navodaya<br>Entrance Exam</b><span class="pill">100K+ installs</span></div>
      <div class="chip c1" data-depth="60"><?= icon('android') ?> 7 Play Store apps</div>
      <div class="chip c2" data-depth="55"><?= icon('game') ?> HTML5 learning games</div>
      <div class="chip c3" data-depth="50"><?= icon('check') ?> Mobile-first & SEO-ready</div>
    </div>
  </div>
</section>

<div class="marquee"><div class="mq-track">
<?php $mq = ['krantiwave.in','Vijeta Academy Sangli','DiGi School Sangli','techedu.in','Google Play','Navodaya Exam App','Marathi Kids School','HTML5 Games','ZP Sangli'];
for ($i = 0; $i < 2; $i++) foreach ($mq as $m) echo '<span>' . e($m) . '</span>'; ?>
</div></div>

<!-- STATS -->
<div class="wrap" style="padding-top:80px">
  <div class="stats">
  <?php foreach ($data['stats'] as $i => $s): ?>
    <div class="stat rv" style="transition-delay:<?= $i * .1 ?>s"><div class="num grad-txt"><span class="count" data-to="<?= (int)$s['value'] ?>">0</span><?= e($s['suffix']) ?></div><p><?= e($s['label']) ?></p></div>
  <?php endforeach; ?>
  </div>
</div>

<!-- SERVICES -->
<section id="services">
  <div class="wrap">
    <div class="sec-head rv"><span class="eyebrow">What I do</span><h2>Everything you need to <span class="grad-txt">grow online</span></h2><p>From a simple business website to a full learning platform with apps and games. One developer, end to end.</p></div>
    <div class="grid3">
    <?php foreach ($data['services'] as $i => $s): ?>
      <div class="card rv tilt" style="transition-delay:<?= ($i % 3) * .12 ?>s"><div class="svc-ic"><?= icon($s['icon']) ?></div><h3><?= e($s['title']) ?></h3><p><?= e($s['text']) ?></p></div>
    <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- WORK -->
<section id="work">
  <div class="wrap">
    <div class="sec-head rv"><span class="eyebrow">Portfolio</span><h2>Selected <span class="grad-txt">work</span></h2><p>Real projects, live right now. Click any card to open it.</p></div>
    <div class="filters rv" id="filters">
      <button class="on" data-f="all">All <small><?= count($projects) ?></small></button>
      <button data-f="web">Websites <small><?= $count['web'] ?></small></button>
      <button data-f="app">Android Apps <small><?= $count['app'] ?></small></button>
      <button data-f="game">Games <small><?= $count['game'] ?></small></button>
    </div>
    <div class="work-grid" id="workGrid">
    <?php foreach ($projects as $i => $p): $t = $p['type']; ?>
      <a class="pj <?= $t ?> rv tilt<?= ($t === 'web' && !empty($p['featured']) && $i === 0) ? ' wide' : '' ?>" data-type="<?= $t ?>" href="<?= e($p['url']) ?>" target="_blank" rel="noopener" style="transition-delay:<?= ($i % 3) * .1 ?>s">
      <?php if ($t === 'app'): ?>
        <div class="pj-img"><img src="<?= e($p['image']) ?>" alt="<?= e($p['title']) ?>" loading="lazy" width="86" height="86">
          <div class="app-meta"><span class="pj-type"><?= $typeLabel[$t] ?></span>
            <div class="dl"><?php if (!empty($p['downloads'])): ?><span><?= icon('download') ?><?= e($p['downloads']) ?></span><?php endif; ?><?php if (!empty($p['rating'])): ?><span class="star"><?= icon('star') ?><?= e($p['rating']) ?></span><?php endif; ?></div>
          </div>
        </div>
        <div class="pj-body"><h3><?= e($p['title']) ?></h3><p><?= e($p['summary']) ?></p><span class="pj-go">View on Google Play <?= icon('ext') ?></span></div>
      <?php else: ?>
        <div class="pj-img"><span class="pj-type"><?= $typeLabel[$t] ?></span><img src="<?= e($p['image']) ?>" alt="<?= e($p['title']) ?>" loading="lazy"><span class="pj-go"><?= icon($t === 'game' ? 'play' : 'ext') ?></span></div>
        <div class="pj-body"><?php if (!empty($p['client'])): ?><small><?= e($p['client']) ?></small><?php endif; ?><h3><?= e($p['title']) ?></h3><p><?= e($p['summary']) ?></p>
          <div class="tags"><?php foreach ($p['tags'] as $tg) echo '<span>' . e($tg) . '</span>'; ?></div></div>
      <?php endif; ?>
      </a>
    <?php endforeach; ?>
    </div>
    <div class="center rv"><a class="btn btn-ghost" href="<?= e($cfg['play_store']) ?>" target="_blank" rel="noopener"><?= icon('android') ?> All my apps on Google Play</a></div>
  </div>
</section>

<!-- ABOUT -->
<section id="about">
  <div class="wrap about">
    <div class="about-card rv l">
      <div class="ring"></div>
      <div class="big grad-txt">20+</div>
      <p style="color:var(--mut);margin-top:6px">live projects: websites,<br>Android apps &amp; games</p>
      <ul>
        <li><?= icon('check') ?> Teacher-turned-developer: I understand users</li>
        <li><?= icon('check') ?> Marathi, Hindi &amp; English projects</li>
        <li><?= icon('check') ?> Website + app + game under one roof</li>
        <li><?= icon('check') ?> Honest pricing &amp; quick WhatsApp support</li>
      </ul>
    </div>
    <div class="rv r">
      <span class="eyebrow">About me</span>
      <h2>A developer who thinks like your <span class="grad-txt">customer</span></h2>
      <p>I started as a primary teacher who wanted better digital tools for kids. That led to <b>Techedu.in</b>, a set of HTML5 learning games, and Android apps like <b>Navodaya Entrance Exam</b> and <b>Marathi Kids First School</b>, each with 100K+ downloads.</p>
      <p>Today I build websites, portals and apps for news media, coaching institutes, schools and local businesses: clean design, fast loading, easy to manage, and built to bring you enquiries.</p>
      <div class="skills"><?php foreach (['HTML5 / CSS3','JavaScript','PHP & MySQL','Laravel','WordPress','Android (Java/Kotlin)','HTML5 Games','SEO','Cloudflare','UI/UX Design'] as $s) echo '<span>' . e($s) . '</span>'; ?></div>
      <a href="#contact" class="btn btn-pri">Let's work together <?= icon('arrow') ?></a>
    </div>
  </div>
</section>

<!-- PROCESS -->
<section id="process">
  <div class="wrap">
    <div class="sec-head rv"><span class="eyebrow">How it works</span><h2>From idea to launch in <span class="grad-txt">4 simple steps</span></h2></div>
    <div class="steps">
    <?php foreach ($data['process'] as $i => $s): ?>
      <div class="step rv" style="transition-delay:<?= $i * .15 ?>s"><div class="n">0<?= $i + 1 ?></div><h3><?= e($s['title']) ?></h3><p><?= e($s['text']) ?></p></div>
    <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- PRICING -->
<section id="pricing">
  <div class="wrap">
    <div class="sec-head rv"><span class="eyebrow">Pricing</span><h2>Simple, <span class="grad-txt">transparent</span> packages</h2><p>Starting prices. Every project gets a free consultation and an exact quote.</p></div>
    <div class="grid3">
    <?php foreach ($data['pricing'] as $i => $p): ?>
      <div class="card price rv<?= $p['highlight'] ? ' hl' : '' ?>" style="transition-delay:<?= $i * .12 ?>s">
        <?php if ($p['highlight']): ?><span class="pop">MOST POPULAR</span><?php endif; ?>
        <h3><?= e($p['name']) ?></h3><div class="amt"><?= e($p['price']) ?><small><?= e($p['note']) ?></small></div>
        <ul><?php foreach ($p['features'] as $f) echo '<li>' . icon('check') . e($f) . '</li>'; ?></ul>
        <a href="#contact" class="btn <?= $p['highlight'] ? 'btn-pri' : 'btn-ghost' ?>" data-plan="<?= e($p['name']) ?>">Get Started</a>
      </div>
    <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FAQ -->
<section id="faq" style="padding-top:40px">
  <div class="wrap">
    <div class="sec-head rv"><span class="eyebrow">FAQ</span><h2>Questions? <span class="grad-txt">Answers.</span></h2></div>
    <div class="faq"><?php foreach ($data['faq'] as $f): ?><details class="rv"><summary><?= e($f['q']) ?></summary><p><?= e($f['a']) ?></p></details><?php endforeach; ?></div>
  </div>
</section>

<!-- CONTACT -->
<section id="contact">
  <div class="wrap">
    <div class="contact rv z">
      <div>
        <span class="eyebrow">Contact</span>
        <h2>Have a project in mind? <span class="grad-txt">Let's talk.</span></h2>
        <p>Tell me what you need and I'll reply within 24 hours with ideas and a free quote.</p>
        <div class="c-list">
          <a href="mailto:<?= e($cfg['email']) ?>"><span class="ci"><?= icon('mail') ?></span><?= e($cfg['email']) ?></a>
          <?php if ($cfg['phone']): ?><a href="tel:<?= e(preg_replace('/\s/', '', $cfg['phone'])) ?>"><span class="ci"><?= icon('phone') ?></span><?= e($cfg['phone']) ?></a><?php endif; ?>
          <?php if ($wa): ?><a href="<?= e($wa) ?>" target="_blank" rel="noopener"><span class="ci"><?= icon('whatsapp') ?></span>Chat on WhatsApp</a><?php endif; ?>
          <div><span class="ci"><?= icon('pin') ?></span><?= e($cfg['location']) ?></div>
        </div>
      </div>
      <form class="cf" id="contactForm" method="post"
            action="<?= $static ? 'https://formsubmit.co/' . e($cfg['form_email']) : 'contact.php' ?>"
            data-mode="<?= $static ? 'static' : 'php' ?>"
            data-ajax="<?= $static ? 'https://formsubmit.co/ajax/' . e($cfg['form_email']) : 'contact.php' ?>">
        <?php if ($static): ?>
          <input type="hidden" name="_subject" value="New enquiry from techedu.tech">
          <input type="hidden" name="_template" value="table">
          <input type="hidden" name="_captcha" value="false">
          <input type="hidden" name="_next" value="<?= e($cfg['site_url']) ?>/?sent=1#contact">
        <?php endif; ?>
        <input type="text" name="_honey" class="hp" tabindex="-1" autocomplete="off">
        <div class="row2"><input name="name" placeholder="Your name *" required maxlength="80"><input name="phone" placeholder="Phone / WhatsApp" maxlength="20"></div>
        <div class="row2"><input type="email" name="email" placeholder="Email *" required maxlength="120">
          <select name="service" id="service"><option value="">I need a…</option><?php foreach ($data['services'] as $s) echo '<option>' . e($s['title']) . '</option>'; ?><?php foreach ($data['pricing'] as $p) echo '<option>' . e($p['name']) . ' package</option>'; ?><option>Other</option></select></div>
        <textarea name="message" placeholder="Tell me about your project *" required maxlength="3000"></textarea>
        <div class="form-msg <?= $sent === '1' ? 'ok' : ($sent === '0' ? 'err' : '') ?>" id="formMsg"><?= $sent === '1' ? 'Thanks! Your message has been sent. I will reply soon.' : ($sent === '0' ? 'Sorry, something went wrong. Please email me directly.' : '') ?></div>
        <button class="btn btn-pri" type="submit" style="justify-content:center">Send Message <?= icon('arrow') ?></button>
      </form>
    </div>
  </div>
</section>
</main>

<footer>
  <div class="wrap">
    <a href="#home" class="logo"><span class="logo-mark">TE</span><span>TechEdu<small>techedu.tech</small></span></a>
    <p>© <span id="yr"><?= date('Y') ?></span> <?= e($cfg['name']) ?>. Websites · Apps · Games.</p>
    <div class="socials">
      <a href="<?= e($cfg['play_store']) ?>" target="_blank" rel="noopener" aria-label="Google Play"><?= icon('android') ?></a>
      <?php foreach ($cfg['socials'] as $k => $u) if ($u) echo '<a href="' . e($u) . '" target="_blank" rel="noopener" aria-label="' . e($k) . '">' . icon($k) . '</a>'; ?>
      <a href="mailto:<?= e($cfg['email']) ?>" aria-label="Email"><?= icon('mail') ?></a>
    </div>
  </div>
</footer>

<?php if ($wa): ?><a class="fab" href="<?= e($wa) ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><?= icon('whatsapp') ?></a><?php endif; ?>
<button class="totop" id="totop" aria-label="Back to top"><?= icon('arrow') ?></button>
<script src="assets/js/main.js?v=1" defer></script>
</body>
</html>
