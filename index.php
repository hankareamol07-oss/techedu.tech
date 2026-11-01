<?php
declare(strict_types=1);
// English page. The Marathi page (mr/index.php) sets $LANG = 'mr' and $BASE = '../' then includes this file.
$lang = (isset($LANG) && $LANG === 'mr') ? 'mr' : 'en';
$base = $BASE ?? '';
$cfg  = require __DIR__ . '/config.php';
$data = require __DIR__ . '/data/portfolio.php';
$L    = (require __DIR__ . '/includes/lang.php')[$lang];
require_once __DIR__ . '/includes/icons.php';

if ($lang === 'mr') {
    $mr = require __DIR__ . '/data/portfolio.mr.php';
    foreach (['stats', 'services', 'process', 'pricing', 'faq'] as $k) if (!empty($mr[$k])) $data[$k] = $mr[$k];
    foreach ($data['projects'] as &$p) if (isset($mr['projects'][$p['url']])) $p = array_merge($p, $mr['projects'][$p['url']]);
    unset($p);
}

$static = defined('STATIC_BUILD') && STATIC_BUILD;
$sent   = $_GET['sent'] ?? '';
if (!function_exists('e')) { function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); } }
// "{word}" in a heading becomes animated gradient text
$g = fn(string $s): string => preg_replace('/\{(.+?)\}/u', '<span class="grad-txt">$1</span>', e($s));

$projects = $data['projects'];
$count = ['web' => 0, 'app' => 0, 'game' => 0];
foreach ($projects as $p) { $count[$p['type']]++; }
$wa = $cfg['whatsapp'] ? 'https://wa.me/' . preg_replace('/\D/', '', $cfg['whatsapp']) . '?text=' . rawurlencode($L['wa_msg']) : '';
$site = rtrim($cfg['site_url'], '/');
$url  = $site . ($lang === 'mr' ? '/mr/' : '/');
$swap = $lang === 'en' ? $base . 'mr/' : ($base !== '' ? $base : './');
?><!doctype html>
<html lang="<?= $L['html_lang'] ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= e($L['title']) ?></title>
<meta name="description" content="<?= e($L['desc']) ?>">
<meta name="keywords" content="freelance web developer Sangli, website developer Maharashtra, Marathi website, Android app developer, educational games, school website, coaching website, news portal developer, वेबसाईट डेव्हलपर सांगली">
<link rel="canonical" href="<?= e($url) ?>">
<link rel="alternate" hreflang="en" href="<?= e($site) ?>/"><link rel="alternate" hreflang="mr" href="<?= e($site) ?>/mr/"><link rel="alternate" hreflang="x-default" href="<?= e($site) ?>/">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($L['title']) ?>">
<meta property="og:description" content="<?= e($L['desc']) ?>">
<meta property="og:url" content="<?= e($url) ?>">
<meta property="og:image" content="<?= e($site) ?>/assets/img/work/krantiwave.jpg">
<meta name="twitter:card" content="summary_large_image">
<meta name="theme-color" content="#ffffff">
<link rel="icon" href="<?= $base ?>assets/img/favicon.svg" type="image/svg+xml">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Noto+Sans+Devanagari:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= $base ?>assets/css/style.css?v=2">
<script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org', '@type' => 'ProfessionalService',
    'name' => 'TechEdu', 'url' => $site . '/',
    'description' => $L['desc'], 'areaServed' => 'India',
    'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Sangli', 'addressRegion' => 'Maharashtra', 'addressCountry' => 'IN'],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body class="lang-<?= $lang ?>">
<div id="loader"><div style="text-align:center"><div class="ld-logo grad-txt">TechEdu</div><div class="ld-bar"><i></i></div></div></div>
<div id="progress"></div>
<canvas id="bgfx"></canvas>
<div class="blob b1"></div><div class="blob b2"></div><div class="blob b3"></div>
<div class="cursor-glow" id="glow"></div>

<header class="nav" id="nav">
  <div class="wrap">
    <a href="#home" class="logo"><span class="logo-mark">TE</span><span>TechEdu<small><?= e($L['tagline']) ?></small></span></a>
    <div class="nav-r">
      <a class="lang-sw lang-sw-m" href="<?= e($swap) ?>" hreflang="<?= $lang === 'en' ? 'mr' : 'en' ?>"><?= e($L['switch']) ?></a>
      <button class="burger" id="burger" aria-label="Menu"><?= icon('menu') ?></button>
    </div>
    <ul class="menu" id="menu">
    <?php foreach (['services', 'work', 'about', 'pricing', 'faq'] as $k): ?>
      <li><a href="#<?= $k ?>"><?= e($L['nav'][$k]) ?></a></li>
    <?php endforeach; ?>
      <li class="lang-li"><a class="lang-sw" href="<?= e($swap) ?>" hreflang="<?= $lang === 'en' ? 'mr' : 'en' ?>"><?= e($L['switch']) ?></a></li>
      <li><a href="#contact" class="btn btn-pri btn-sm"><?= e($L['nav']['hire']) ?> <?= icon('arrow') ?></a></li>
    </ul>
  </div>
</header>

<main>
<!-- HERO -->
<section class="hero" id="home">
  <div class="wrap">
    <div>
      <span class="badge rv"><span class="dot"></span> <?= e($L['badge']) ?></span>
      <h1 class="split"><?= str_replace('{w}', '<span class="grad-txt typed" data-words=\'' . e(json_encode($L['words'], JSON_UNESCAPED_UNICODE)) . '\'>' . e($L['words'][0]) . '</span>', $L['h1']) ?></h1>
      <p class="lead rv"><?= $L['lead'] ?></p>
      <p class="mr rv"><?= e($L['sub']) ?></p>
      <div class="cta-row rv">
        <a href="#work" class="btn btn-pri"><?= e($L['cta_work']) ?> <?= icon('arrow') ?></a>
        <a href="#contact" class="btn btn-ghost"><?= e($L['cta_quote']) ?></a>
      </div>
      <div class="trust rv">
        <div><?= icon('download') ?><span><b>200K+</b><?= e($L['trust'][0]) ?></span></div>
        <div><?= icon('globe') ?><span><b><?= $count['web'] + 1 ?>+</b><?= e($L['trust'][1]) ?></span></div>
        <div><?= icon('star') ?><span><b>4.8★</b><?= e($L['trust'][2]) ?></span></div>
      </div>
    </div>
    <div class="stage rv z" id="stage">
      <div class="device d1" data-depth="18"><div class="bar"><i></i><i></i><i></i><span>krantiwave.in</span></div><img src="<?= $base ?>assets/img/work/krantiwave.jpg" alt="Kranti WAVE news portal" width="1000" height="625"></div>
      <div class="device d2" data-depth="30"><div class="bar"><i></i><i></i><i></i><span>vijetaacademysangli.in</span></div><img src="<?= $base ?>assets/img/work/vijeta.jpg" alt="Vijeta Academy website" width="1000" height="625"></div>
      <div class="phone" data-depth="45"><img src="<?= $base ?>assets/apps/com.techedu.navoday.png" alt="Navodaya app"><b><?= $L['phone'] ?></b><span class="pill"><?= e($L['pill']) ?></span></div>
      <div class="chip c1" data-depth="60"><?= icon('android') ?> <?= e($L['chips'][0]) ?></div>
      <div class="chip c2" data-depth="55"><?= icon('game') ?> <?= e($L['chips'][1]) ?></div>
      <div class="chip c3" data-depth="50"><?= icon('check') ?> <?= e($L['chips'][2]) ?></div>
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
    <div class="sec-head rv"><span class="eyebrow"><?= e($L['svc_eye']) ?></span><h2><?= $g($L['svc_h2']) ?></h2><p><?= e($L['svc_p']) ?></p></div>
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
    <div class="sec-head rv"><span class="eyebrow"><?= e($L['work_eye']) ?></span><h2><?= $g($L['work_h2']) ?></h2><p><?= e($L['work_p']) ?></p></div>
    <div class="filters rv" id="filters">
      <button class="on" data-f="all"><?= e($L['f_all']) ?> <small><?= count($projects) ?></small></button>
      <button data-f="web"><?= e($L['f_web']) ?> <small><?= $count['web'] ?></small></button>
      <button data-f="app"><?= e($L['f_app']) ?> <small><?= $count['app'] ?></small></button>
      <button data-f="game"><?= e($L['f_game']) ?> <small><?= $count['game'] ?></small></button>
    </div>
    <div class="work-grid" id="workGrid">
    <?php foreach ($projects as $i => $p): $t = $p['type']; $img = $base . $p['image']; ?>
      <a class="pj <?= $t ?> rv tilt<?= ($t === 'web' && !empty($p['featured']) && $i === 0) ? ' wide' : '' ?>" data-type="<?= $t ?>" href="<?= e($p['url']) ?>" target="_blank" rel="noopener" style="transition-delay:<?= ($i % 3) * .1 ?>s">
      <?php if ($t === 'app'): ?>
        <div class="pj-img"><img src="<?= e($img) ?>" alt="<?= e($p['title']) ?>" loading="lazy" width="86" height="86">
          <div class="app-meta"><span class="pj-type"><?= e($L['types'][$t]) ?></span>
            <div class="dl"><?php if (!empty($p['downloads'])): ?><span><?= icon('download') ?><?= e($p['downloads']) ?></span><?php endif; ?><?php if (!empty($p['rating'])): ?><span class="star"><?= icon('star') ?><?= e($p['rating']) ?></span><?php endif; ?></div>
          </div>
        </div>
        <div class="pj-body"><h3><?= e($p['title']) ?></h3><p><?= e($p['summary']) ?></p><span class="pj-go"><?= e($L['view_play']) ?> <?= icon('ext') ?></span></div>
      <?php else: ?>
        <div class="pj-img"><span class="pj-type"><?= e($L['types'][$t]) ?></span><img src="<?= e($img) ?>" alt="<?= e($p['title']) ?>" loading="lazy"><span class="pj-go"><?= icon($t === 'game' ? 'play' : 'ext') ?></span></div>
        <div class="pj-body"><?php if (!empty($p['client'])): ?><small><?= e($p['client']) ?></small><?php endif; ?><h3><?= e($p['title']) ?></h3><p><?= e($p['summary']) ?></p>
          <div class="tags"><?php foreach ($p['tags'] as $tg) echo '<span>' . e($tg) . '</span>'; ?></div></div>
      <?php endif; ?>
      </a>
    <?php endforeach; ?>
    </div>
    <div class="center rv"><a class="btn btn-ghost" href="<?= e($cfg['play_store']) ?>" target="_blank" rel="noopener"><?= icon('android') ?> <?= e($L['all_apps']) ?></a></div>
  </div>
</section>

<!-- ABOUT -->
<section id="about">
  <div class="wrap about">
    <div class="about-card rv l">
      <div class="ring"></div>
      <div class="big grad-txt">20+</div>
      <p style="color:var(--mut);margin-top:6px"><?= $L['about_big'] ?></p>
      <ul><?php foreach ($L['about_list'] as $li) echo '<li>' . icon('check') . ' ' . $li . '</li>'; ?></ul>
    </div>
    <div class="rv r">
      <span class="eyebrow"><?= e($L['about_eye']) ?></span>
      <h2><?= $g($L['about_h2']) ?></h2>
      <p><?= $L['about_p1'] ?></p>
      <p><?= $L['about_p2'] ?></p>
      <div class="skills"><?php foreach (['HTML5 / CSS3','JavaScript','PHP & MySQL','Laravel','WordPress','Android (Java/Kotlin)','HTML5 Games','SEO','Cloudflare','UI/UX Design'] as $s) echo '<span>' . e($s) . '</span>'; ?></div>
      <a href="#contact" class="btn btn-pri"><?= e($L['about_cta']) ?> <?= icon('arrow') ?></a>
    </div>
  </div>
</section>

<!-- PROCESS -->
<section id="process">
  <div class="wrap">
    <div class="sec-head rv"><span class="eyebrow"><?= e($L['proc_eye']) ?></span><h2><?= $g($L['proc_h2']) ?></h2></div>
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
    <div class="sec-head rv"><span class="eyebrow"><?= e($L['price_eye']) ?></span><h2><?= $g($L['price_h2']) ?></h2><p><?= e($L['price_p']) ?></p></div>
    <div class="grid3">
    <?php foreach ($data['pricing'] as $i => $p): ?>
      <div class="card price rv<?= $p['highlight'] ? ' hl' : '' ?>" style="transition-delay:<?= $i * .12 ?>s">
        <?php if ($p['highlight']): ?><span class="pop"><?= e($L['popular']) ?></span><?php endif; ?>
        <h3><?= e($p['name']) ?></h3><div class="amt"><?= e($p['price']) ?><small><?= e($p['note']) ?></small></div>
        <ul><?php foreach ($p['features'] as $f) echo '<li>' . icon('check') . e($f) . '</li>'; ?></ul>
        <a href="#contact" class="btn <?= $p['highlight'] ? 'btn-pri' : 'btn-ghost' ?>" data-plan="<?= e($p['name'] . $L['pkg']) ?>"><?= e($L['get_started']) ?></a>
      </div>
    <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FAQ -->
<section id="faq" style="padding-top:40px">
  <div class="wrap">
    <div class="sec-head rv"><span class="eyebrow"><?= e($L['faq_eye']) ?></span><h2><?= $g($L['faq_h2']) ?></h2></div>
    <div class="faq"><?php foreach ($data['faq'] as $f): ?><details class="rv"><summary><?= e($f['q']) ?></summary><p><?= e($f['a']) ?></p></details><?php endforeach; ?></div>
  </div>
</section>

<!-- CONTACT -->
<section id="contact">
  <div class="wrap">
    <div class="contact rv z">
      <div>
        <span class="eyebrow"><?= e($L['c_eye']) ?></span>
        <h2><?= $g($L['c_h2']) ?></h2>
        <p><?= e($L['c_p']) ?></p>
        <div class="c-list">
          <?php if ($wa): ?><a href="<?= e($wa) ?>" target="_blank" rel="noopener"><span class="ci wa"><?= icon('whatsapp') ?></span><span><?= e($L['wa_chat']) ?><small><?= e($cfg['whatsapp_display'] ?? '') ?></small></span></a><?php endif; ?>
          <?php if ($cfg['email']): ?><a href="mailto:<?= e($cfg['email']) ?>"><span class="ci"><?= icon('mail') ?></span><?= e($cfg['email']) ?></a><?php endif; ?>
          <?php if ($cfg['phone']): ?><a href="tel:<?= e(preg_replace('/\s/', '', $cfg['phone'])) ?>"><span class="ci"><?= icon('phone') ?></span><?= e($cfg['phone']) ?></a><?php endif; ?>
          <div><span class="ci"><?= icon('pin') ?></span><?= e($L['location']) ?></div>
        </div>
      </div>
      <form class="cf" id="contactForm" method="post"
            action="<?= $static ? 'https://formsubmit.co/' . e($cfg['form_email']) : $base . 'contact.php' ?>"
            data-ajax="<?= $static ? 'https://formsubmit.co/ajax/' . e($cfg['form_email']) : $base . 'contact.php' ?>"
            data-ok="<?= e($L['sent_ok']) ?>" data-err="<?= e($L['sent_err']) ?>" data-sending="<?= e($L['sending']) ?>">
        <?php if ($static): ?>
          <input type="hidden" name="_subject" value="New enquiry from techedu.tech">
          <input type="hidden" name="_template" value="table">
          <input type="hidden" name="_captcha" value="false">
          <input type="hidden" name="_next" value="<?= e($url) ?>?sent=1#contact">
        <?php endif; ?>
        <input type="hidden" name="lang" value="<?= $lang ?>">
        <input type="text" name="_honey" class="hp" tabindex="-1" autocomplete="off">
        <div class="row2"><input name="name" placeholder="<?= e($L['ph_name']) ?>" required maxlength="80"><input name="phone" placeholder="<?= e($L['ph_phone']) ?>" maxlength="20"></div>
        <div class="row2"><input type="email" name="email" placeholder="<?= e($L['ph_email']) ?>" required maxlength="120">
          <select name="service" id="service"><option value=""><?= e($L['ph_need']) ?></option><?php foreach ($data['services'] as $s) echo '<option>' . e($s['title']) . '</option>'; ?><?php foreach ($data['pricing'] as $p) echo '<option>' . e($p['name'] . $L['pkg']) . '</option>'; ?><option><?= e($L['other']) ?></option></select></div>
        <textarea name="message" placeholder="<?= e($L['ph_msg']) ?>" required maxlength="3000"></textarea>
        <div class="form-msg <?= $sent === '1' ? 'ok' : ($sent === '0' ? 'err' : '') ?>" id="formMsg"><?= $sent === '1' ? e($L['sent_ok']) : ($sent === '0' ? e($L['sent_err']) : '') ?></div>
        <button class="btn btn-pri" type="submit" style="justify-content:center"><?= e($L['send']) ?> <?= icon('arrow') ?></button>
      </form>
    </div>
  </div>
</section>
</main>

<footer>
  <div class="wrap">
    <a href="#home" class="logo"><span class="logo-mark">TE</span><span>TechEdu<small>techedu.tech</small></span></a>
    <p>© <span id="yr"><?= date('Y') ?></span> TechEdu. <?= e($L['footer']) ?> · <a href="<?= e($swap) ?>" class="lang-sw-f"><?= e($L['switch']) ?></a></p>
    <div class="socials">
      <a href="<?= e($cfg['play_store']) ?>" target="_blank" rel="noopener" aria-label="Google Play"><?= icon('android') ?></a>
      <?php if ($wa): ?><a href="<?= e($wa) ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><?= icon('whatsapp') ?></a><?php endif; ?>
      <?php foreach ($cfg['socials'] as $k => $u) if ($u) echo '<a href="' . e($u) . '" target="_blank" rel="noopener" aria-label="' . e($k) . '">' . icon($k) . '</a>'; ?>
      <?php if ($cfg['email']): ?><a href="mailto:<?= e($cfg['email']) ?>" aria-label="Email"><?= icon('mail') ?></a><?php endif; ?>
    </div>
  </div>
</footer>

<?php if ($wa): ?><a class="fab" href="<?= e($wa) ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><?= icon('whatsapp') ?></a><?php endif; ?>
<button class="totop" id="totop" aria-label="Back to top"><?= icon('arrow') ?></button>
<script src="<?= $base ?>assets/js/main.js?v=2" defer></script>
</body>
</html>
