# GTA VI News — design plan

## Official references

Reviewed October 6, 2026:
- https://www.rockstargames.com/VI — cinematic artwork, oversized condensed typography, warm gradients, purple backgrounds, minimal navigation.
- https://www.rockstargames.com/VI/only-in-leonida — image-led character and location storytelling, alternating purple/pink surfaces.
- https://www.rockstargames.com/VI/media — editorial media grid, trailers and official screenshots.
- https://www.rockstargames.com/newswire — reference for news metadata and card hierarchy.

The official site's published CSS uses ArtDeco font families and colors including #f976b0, #0d0c1a, #1f1f38, #2f2e52, and #fff9cb. The browser connector was unavailable; visual references were inspected using a standalone headless browser and downloaded official assets/CSS.

## Adaptation

Create an independent GTA VI news publication, **VI NEWS**, with the game name in its wordmark and a clearly labeled independent identity. Keep CMS article, category, tag, author, game, and content-block functionality.

Palette: midnight #0d0c1a, raised surface #181726, cream #fff9eb, muted lavender #a7a3bb, pink #f976b0, peach #ffc49b, teal #9ae1d4. Pink/peach form the sunset accent; cream stays dominant for readable headlines.

Typography: self-hosted open-license Barlow Condensed (600–800) for large editorial headings, Inter (400–700) for navigation and reading text. These are alternatives to Rockstar's custom font, not copies of its font files.

Homepage: compact masthead → full-width Vice City image with a large publication statement → linked lead-story ticker → topic navigation → latest CMS articles with an official trailer/Leonida sidebar → image-led world exploration link → footer. Actual articles remain database-backed. An optional, additive local starter-content seeder supplies source-linked evergreen GTA VI introductions on an empty development database; it is not part of the default production seeder.

Article: breadcrumb, large title, author/date, hero image, readable 70-character content width and related-news sidebar. Category: topic chips, responsive cards, empty-state text, existing pagination. Apply consistent styling to authors, game details, contact, static pages and errors.

Interactions: accessible mobile menu with Escape/close behavior; normal route-based topic navigation and pagination; links to Rockstar's official trailer/media/world pages; existing view tracking and image lightboxes retained. No simulated newsletter subscription or fake search.

Accessibility: semantic main landmark, skip link, visible keyboard focus, contrasting text, 44px controls, native image lazy loading, reduced-motion support, responsive 360px–desktop layouts.

## Implementation and validation

1. Repair fresh-install blockers and run Sail on isolated local ports.
2. Add a public CSS/JS skin and self-hosted fonts, favicon, and official image assets.
3. Rebuild the public header, homepage and footer; adapt shared cards and remaining templates.
4. Render desktop/mobile screenshots and exercise menu, topic, pagination, article and contact routes.
5. Run the PHP tests, compile Blade views, build Vite assets, and record health findings in project-health.md.

Asset source URLs and font licensing are recorded in public/images/gta-vi/SOURCES.md and public/fonts/*-LICENSE.txt.
