<?php
declare(strict_types=1);
// Contact form handler for PHP hosting (InfinityFree, Hostinger, cPanel...). Saves every message
// to storage/messages.csv and tries to email you. View messages at /admin.php
$cfg  = require __DIR__ . '/config.php';
$ajax = str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json');

function done(bool $ok, string $msg, bool $ajax): never {
    if ($ajax) { header('Content-Type: application/json'); http_response_code($ok ? 200 : 422); echo json_encode(['success' => $ok, 'message' => $msg]); }
    else { header('Location: index.php?sent=' . ($ok ? '1' : '0') . '#contact'); }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') done(false, 'Invalid request.', $ajax);
if (!empty($_POST['_honey'])) done(true, 'ok', $ajax); // bot

$clean = fn(string $k, int $max) => mb_substr(trim(strip_tags((string)($_POST[$k] ?? ''))), 0, $max);
$name = $clean('name', 80); $email = $clean('email', 120); $phone = $clean('phone', 20);
$service = $clean('service', 80); $message = $clean('message', 3000);

if ($name === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) done(false, 'Please fill name, a valid email and message.', $ajax);

// simple rate limit: 1 message / 30s per IP
$dir = __DIR__ . '/storage';
if (!is_dir($dir)) mkdir($dir, 0755, true);
$ip = $_SERVER['REMOTE_ADDR'] ?? '';
$rl = $dir . '/rl_' . md5($ip);
if (is_file($rl) && time() - (int)file_get_contents($rl) < 30) done(false, 'Please wait a few seconds before sending again.', $ajax);
file_put_contents($rl, (string)time());

$fh = fopen($dir . '/messages.csv', 'a');
if ($fh) { fputcsv($fh, [date('Y-m-d H:i:s'), $name, $email, $phone, $service, $message, $ip], ',', '"', '\\'); fclose($fh); }

$body = "New enquiry from techedu.tech\n\nName: $name\nEmail: $email\nPhone: $phone\nService: $service\n\n$message\n";
$headers = 'From: TechEdu Website <no-reply@' . ($_SERVER['HTTP_HOST'] ?? 'techedu.tech') . ">\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";
@mail($cfg['email'], 'New enquiry: ' . $name, $body, $headers);

done(true, 'Thanks! Your message has been sent.', $ajax);
