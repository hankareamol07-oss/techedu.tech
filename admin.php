<?php
declare(strict_types=1);
// View contact-form messages. CHANGE THIS PASSWORD before uploading.
const ADMIN_PASSWORD = 'change-me-123';
session_start();
if (isset($_POST['pw']) && hash_equals(ADMIN_PASSWORD, (string)$_POST['pw'])) $_SESSION['adm'] = true;
if (isset($_GET['logout'])) { session_destroy(); header('Location: admin.php'); exit; }
$e = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
?><!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="robots" content="noindex"><title>Messages | TechEdu</title>
<style>body{font-family:system-ui,'Noto Sans Devanagari',sans-serif;background:#060818;color:#e8ecff;padding:30px}table{width:100%;border-collapse:collapse;font-size:14px}td,th{border:1px solid #23284d;padding:10px;text-align:left;vertical-align:top}th{background:#11163a}input,button{padding:12px;border-radius:8px;border:1px solid #333;font-size:15px}button{background:#6c5cff;color:#fff;border:0;cursor:pointer}a{color:#22d3ee}</style></head><body>
<?php if (empty($_SESSION['adm'])): ?>
<form method="post" style="max-width:320px;margin:15vh auto;display:grid;gap:12px"><h2>Admin login</h2><input type="password" name="pw" placeholder="Password" autofocus><button>Login</button></form>
<?php else:
$rows = [];
if (is_file(__DIR__ . '/storage/messages.csv') && ($fh = fopen(__DIR__ . '/storage/messages.csv', 'r'))) { while (($r = fgetcsv($fh, 0, ',', '"', '\\')) !== false) $rows[] = $r; fclose($fh); }
$rows = array_reverse($rows); ?>
<h2>Messages (<?= count($rows) ?>) <a href="?logout=1" style="font-size:14px;float:right">Logout</a></h2>
<table><tr><th>Date</th><th>Name</th><th>Email</th><th>Phone</th><th>Service</th><th>Message</th></tr>
<?php foreach ($rows as $r): ?><tr><td><?= $e($r[0] ?? '') ?></td><td><?= $e($r[1] ?? '') ?></td><td><a href="mailto:<?= $e($r[2] ?? '') ?>"><?= $e($r[2] ?? '') ?></a></td><td><?= $e($r[3] ?? '') ?></td><td><?= $e($r[4] ?? '') ?></td><td style="white-space:pre-wrap"><?= $e($r[5] ?? '') ?></td></tr><?php endforeach; ?>
</table><?php endif; ?></body></html>
