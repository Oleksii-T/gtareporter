# GTA VI News

A Laravel news blog with a GTA VI inspired public design. It includes posts, categories, tags, games, author profiles, a flexible content builder, view tracking, and an admin panel.

The public site uses midnight purple, sunset accents, condensed editorial headings, and official GTA VI imagery. The CMS, AdminLTE admin/editor styles, vendor pagination views, and shared content-block renderer are retained.

## Starting a new skin

1. Copy `.env.example` to `.env` for a new installation. Set `APP_NAME` and `APP_URL` for the new site and configure its database and services.
2. Install dependencies with `composer install` and `npm ci`, then run `php artisan key:generate`.
3. On a new database, run `php artisan migrate --seed` and `php artisan storage:link`.
4. Add the new public styles and assets. Load styles through the `styles` section in `resources/views/layouts/app.blade.php`, and adapt the existing views for the new design. Preserve `resources/views/components/content-blocks.blade.php` and the vendor views when replacing templates; the vendor pagination markup can be restyled.
5. Run `npm run build` to build the admin Vue components.

The header and footer use `APP_NAME` unless overridden through their CMS `site-name` fields. Open Graph site identity and default canonical URLs use `APP_NAME` and `APP_URL`. Set social preview images through the `meta-image` Blade section, and add favicons and site verification tags for the new site.

Google Analytics is optional: set `GA_MEASUREMENT_ID` to enable it outside the local environment. Configure the new site's advertising file and sitemap URL in `public/robots.txt` when deploying.

Existing databases, uploads, and local `.env` values are not reset by this cleanup. Review their site names, page content, metadata, and service IDs before reusing them for a new site; the updated seeders provide neutral defaults for new installations.

## GTA VI News skin

The public site now uses the GTA VI inspired skin in `public/css/gta-news.css` and `public/js/theme.js`, with self-hosted fonts and official editorial imagery. The research and layout decisions are in [docs/design-plan.md](docs/design-plan.md); verification and remaining dependency issues are in [docs/project-health.md](docs/project-health.md).

This workspace runs Sail at **http://localhost:8087**. Its local `.env` uses `APP_PORT=8087`, `FORWARD_DB_PORT=3309`, `VITE_PORT=5187`, and `APP_URL=http://localhost:8087` to avoid neighboring projects. Start it with `./vendor/bin/sail up -d`. The public skin does not require a running Vite development server; `npm run build` builds the existing admin components.

For an empty local database, run migrations and the default seeders, then optionally run `./vendor/bin/sail artisan db:seed --class=GtaViDemoSeeder`. This adds six source-linked starter articles, marked as preview content in their bodies and metadata. It skips existing non-preview articles, does not run on production, and is not called by the default seeder. Replace the starter stories with editorial content through the CMS. Existing CMS header/footer `site-name` values override the GTA VI News wordmark. Set `APP_NAME="GTA VI News"` for metadata and admin identity, and populate policy-page content in the CMS.

Tests require a migrated, seeded `testing` database. With Sail, initialize that database using `./vendor/bin/sail exec -e DB_DATABASE=testing laravel.test php artisan migrate --seed`, then run `./vendor/bin/sail test`. This targets the separate testing database, not the normal local database.
