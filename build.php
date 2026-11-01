<?php
// Generates the static site in dist/ for Cloudflare Pages / GitHub Pages / Netlify.
// Run:  php build.php   (or double-click BUILD-STATIC.bat on Windows)
declare(strict_types=1);
define('STATIC_BUILD', true);
$root = __DIR__; $dist = $root . '/dist';
$cfg = require $root . '/config.php';

function rrmdir(string $d): void { if (!is_dir($d)) return; foreach (scandir($d) as $f) { if ($f === '.' || $f === '..') continue; $p = "$d/$f"; is_dir($p) ? rrmdir($p) : unlink($p); } rmdir($d); }
function rcopy(string $s, string $d): void { @mkdir($d, 0755, true); foreach (scandir($s) as $f) { if ($f === '.' || $f === '..') continue; is_dir("$s/$f") ? rcopy("$s/$f", "$d/$f") : copy("$s/$f", "$d/$f"); } }

rrmdir($dist); mkdir($dist, 0755, true);
$_GET = [];
$render = function (string $LANG, string $BASE) use ($root): string { ob_start(); include $root . '/index.php'; return ob_get_clean(); };
$html = $render('en', '');
file_put_contents("$dist/index.html", $html);
mkdir("$dist/mr", 0755, true);
file_put_contents("$dist/mr/index.html", $render('mr', '../'));
rcopy("$root/assets", "$dist/assets");

$u = rtrim($cfg['site_url'], '/');
file_put_contents("$dist/robots.txt", "User-agent: *\nAllow: /\nSitemap: $u/sitemap.xml\n");
file_put_contents("$dist/sitemap.xml", '<?xml version="1.0" encoding="UTF-8"?>' . "\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"><url><loc>$u/</loc><lastmod>" . date('Y-m-d') . "</lastmod><priority>1.0</priority></url><url><loc>$u/mr/</loc><lastmod>" . date('Y-m-d') . "</lastmod><priority>0.9</priority></url></urlset>\n");
file_put_contents("$dist/_headers", "/*\n  X-Content-Type-Options: nosniff\n  Referrer-Policy: strict-origin-when-cross-origin\n  X-Frame-Options: SAMEORIGIN\n/assets/*\n  Cache-Control: public, max-age=604800\n");
file_put_contents("$dist/404.html", '<!doctype html><meta charset="utf-8"><meta http-equiv="refresh" content="0;url=/"><title>Redirecting…</title>');
echo "Static site (English + Marathi) built in dist/ (" . round(strlen($html) / 1024) . " KB html)\n";
