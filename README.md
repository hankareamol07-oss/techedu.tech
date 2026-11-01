# techedu.tech – Amol Hankare Freelance Portfolio

Motion-rich portfolio (websites, Android apps, HTML5 games) written in plain PHP, plus an auto-generated static copy in `dist/` for Cloudflare Pages.

## Edit content
- `config.php` – name, email, **WhatsApp/phone** (fill these to show WhatsApp button), social links.
- `data/portfolio.php` – services, projects, apps, games, pricing, FAQ.
- Images: `assets/img/work/` (websites/games), `assets/apps/` (app icons).

After editing, rebuild the static version: double-click **BUILD-STATIC.bat** (Windows, needs PHP / XAMPP in PATH) or run `php build.php`. Then commit & push – Cloudflare redeploys automatically.

## Run locally (XAMPP)
Copy the folder to `C:\xampp\htdocs\techedu` and open http://localhost/techedu, or double-click **START-LOCAL.bat**.

## Deploy option A – Cloudflare Pages (free, static)
1. Cloudflare dashboard → **Workers & Pages → Create → Pages → Connect to Git** → pick `hankareamol07-oss/techedu.tech`.
2. Production branch: `main`. Framework preset: **None**. Build command: *(leave empty)*. Build output directory: **`dist`**.
3. Save and Deploy → you get `techedu-tech.pages.dev`.
4. Project → **Custom domains → Set up a domain** → `techedu.tech` (and again `www.techedu.tech`). Cloudflare adds DNS records automatically.

Contact form on the static site uses FormSubmit: the very first message sends an activation email to `form_email` – click **Activate** once, then all enquiries arrive in your inbox.

## Deploy option A2 – Cloudflare Workers (new dashboard, no Pages option)
1. Workers & Pages → **Create application** → **Import a repository** → GitHub → `techedu.tech`.
2. Project name `techedu-tech`, Build command: *(empty)*, Deploy command: `npx wrangler deploy` → **Deploy**. `wrangler.jsonc` serves the `dist/` folder.
3. Worker → **Settings → Domains & Routes → Add → Custom domain** → `techedu.tech` (and `www.techedu.tech`).

## Deploy option B – PHP hosting (InfinityFree, Hostinger, cPanel)
Upload everything **except `dist/`** to `htdocs`/`public_html`. The contact form (`contact.php`) saves messages to `storage/messages.csv` and emails you. Read them at `/admin.php` – **change `ADMIN_PASSWORD` in admin.php first.**
