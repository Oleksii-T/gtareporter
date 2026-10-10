# Project health — October 6, 2026

## Runtime

Laravel 10 / PHP 8.2 in Sail, MySQL 8, Vue 3 and Vite 3. Docker is working. The app and MySQL containers are running. Local preview: http://localhost:8087.

This project initially could not start because host port 3306 belonged to another project. Local `.env` ports now use 8087 (app), 3309 (MySQL), and 5187 (Vite). The existing neighboring containers were left running. A new project-specific Docker volume was migrated and seeded; no existing databases were reset.

## Startup and functional fixes

- Data-backed web routes are skipped before the redirects table exists, allowing Artisan to bootstrap a fresh database for migrations.
- Author seeds now provide the required description fields. Author and category seeds avoid duplicate records on repeat runs.
- App debug configuration now reads APP_DEBUG directly, avoiding an authentication lookup before the auth service exists. This fixed the test-suite bootstrap failure. Debugbar honors an explicit disabled setting; it is disabled in this local preview.
- Restored the small admin info SVG needed by Blade compilation.
- Added the missing editorial-policy and author page definitions to the page seeder.
- Removed an unused `/new-front-page-test` route referencing a nonexistent controller method.
- Articles without explicit block groups now render their ordered content instead of silently hiding it. Added regression coverage for default and explicit grouping.
- Replaced a static-page template that referenced deleted components.
- Corrected contact submissions to use the POST feedback route and the token field expected by existing reCAPTCHA middleware. When reCAPTCHA is unconfigured, the form submits without attempting to load it. Errors and success are displayed in an accessible status region.
- Author lists now show pagination. Shared JavaScript leaves native pagination alone when an AJAX pagination container is absent.

## Verification

- Composer manifest validation: passed.
- All 48 migrations: applied successfully to the new local database and the separate testing database.
- PHP tests: **5 passed**, including the homepage, duplicate-source validation, and regressions for ungrouped/explicitly grouped article content.
- `php artisan list --raw` with an empty SQLite in-memory database: passed (fresh-install bootstrap check).
- Blade view compilation: passed.
- Pint for changed PHP files: passed.
- `npm run build`: passed; the existing admin bundle builds successfully.
- `git diff --check`: passed.
- Browser: homepage, news listing, character filter, article, author, contact, about, privacy, terms, cookies, editorial policy and expected 404 response checked. No JavaScript errors or horizontal overflow.
- Mobile: 360, 390 and 768 pixel layouts checked, including news/article/contact pages and menu open/Escape close behavior.
- Local contact submission: successful; QA feedback is removed after verification.
- Author pagination: page 2 renders the remaining article. Category AJAX pagination: next page and previous page verified with temporary fixtures, removed afterward.
- Public fonts are self-hosted, subset for Latin/extended Latin, and compressed as WOFF2. Official artwork is local, with original URLs recorded in the asset directory. Article images use lazy loading.

Browser connector discovery returned no available browser. Browser verification used a separate headless Chrome process with Playwright installed outside the project; no app dependency was added for QA.

## Remaining issues

Dependency audit results are inherited from the starter's lockfiles:

- npm: **21 vulnerabilities** (1 low, 4 moderate, 13 high, 3 critical).
- Composer: **61 advisories across 19 packages**, including Laravel and several transitive dependencies.

These dependencies have not been upgraded as part of the public design work. A separate upgrade and compatibility pass is needed before considering the application production-ready.

The local preview has six optional starter articles sourced from Rockstar's official site. Each article is marked as local preview content; no fabricated release announcements were added. The default seeder does not publish these stories. Privacy, terms and cookie pages have no substantive policy content in the starter CMS; the styled templates show a truthful unpublished-content message until that content is supplied.

Local reCAPTCHA was unconfigured. The no-key submission path was verified; a live Google reCAPTCHA flow was not exercised. Existing CMS services, admin CRUD and external API integrations have not been comprehensively tested by this design pass.
