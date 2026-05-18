# CLAUDE.md

Guidance for Claude Code when working in this repository.

## What's here

This repo holds the **WordPress revamp** of the Lobos Club de Dodgeball site. It's an Astra child theme plus a Docker dev stack — that's the entire codebase.

```
wp-revamp/
  docker-compose.yml    # local dev stack (WordPress + MySQL on :8081)
  config/apache.conf    # Apache vhost mounted into the WP container
  theme/                # the Astra child theme — this is what gets deployed
```

The previous incarnation of this site — a hand-rolled static HTML/CSS/JS site that lived at the repo root — was removed in commit `231e00d`. It's preserved on the `legacy` branch and tag (both at commit `4e4a878`) if you ever need to look at the old markup, copy, or assets.

## Running locally

The stack runs in Docker on **http://localhost:8081/**.

```bash
docker compose -p lobosweb-wp -f wp-revamp/docker-compose.yml up -d
```

**Always pass `-p lobosweb-wp`.** The stack's containers and volumes (`lobosweb-wp-wordpress-1`, `lobosweb-wp-db-1`, `lobosweb-wp_wp_data`, `lobosweb-wp_db_data`) were originally created when the compose file lived in a directory named `lobosweb-wp/`. The compose file has since moved into `wp-revamp/`, but the project name is sticky — without `-p lobosweb-wp`, Compose derives the name from the directory (`wp-revamp`), sees an empty stack, and would create a fresh parallel set of empty volumes.

The theme is bind-mounted from `wp-revamp/theme/` into `/var/www/html/wp-content/themes/lobos/` inside the container, so PHP/CSS/JS edits are live without rebuild. WP core and uploads live in the `lobosweb-wp_wp_data` Docker volume, and the DB is in `lobosweb-wp_db_data`.

## Deployment

There is no automated deploy. The production site at lobosdedodge.com still runs the old static site (deployed via Bluehost cPanel git from the `legacy` branch — the `.cpanel.yml` that drove that was removed when the legacy files were deleted).

To ship the WP revamp: zip `wp-revamp/theme/` and upload it via Bluehost WP admin (Appearance → Themes → Add New → Upload), or via cPanel File Manager into `wp-content/themes/lobos/`. The Astra parent theme must be installed and active on the server. After upload, activate the child theme — content from this dev environment doesn't transfer; the production WP install needs its own seeding.

## Architecture notes

### ACF Free, not Pro

The site uses **Advanced Custom Fields Free**. Repeater, Flexible Content, Gallery, and Clone field types do **not** work — they require ACF Pro. When the design calls for repeater-style content (sponsor list, etc.), hardcode the array in PHP (see the `$sponsors` array in `front-page.php`) rather than introducing a Pro dependency.

### Player taxonomy: single `equipo`, not disciplina × categoria

The `jugadores` CPT uses a **single `equipo` taxonomy** with 6 hierarchical terms: `foam-varonil`, `foam-femenil`, `foam-mixto`, `cloth-varonil`, `cloth-femenil`, `cloth-mixto`. Splitting these into independent `disciplina` and `categoria` taxonomies (the original design) created a cartesian-product bug — a player who plays Cloth Varonil + Foam Mixto would be tagged with `disciplinas={foam,cloth} × categorias={varonil,mixto}`, incorrectly surfacing on Foam Varonil and Cloth Mixto rosters too.

Consequences:
- Roster queries use `tax_query` against `equipo` with a single specific term slug.
- Roster pages have one ACF select field `equipo_filter` (not separate disciplina + categoria filters).
- To derive the discipline for sorting/number selection, split the slug on `-`: `explode('-', $equipo_slug)[0]` returns `foam` or `cloth`.

### Per-discipline jersey numbers

Players who play both disciplines often wear different numbers in each. Two separate ACF fields: `numero_foam` and `numero_cloth`. `scripts/admin-jugador.js` watches the equipo checklist meta box and shows/hides the matching number field based on which `foam-*` / `cloth-*` terms are checked. Publish validation (`lobos_check_jugador_requirements` in `functions.php`) requires at least one equipo plus the corresponding number(s).

### Seeders and migrations are guarded, leave them in place

Files like `acf-seed.php`, `numero-migrate.php`, etc. populated the dev DB from legacy site data. Each one guards itself with a `wp_options` flag (`lobos_*_seeded` / `lobos_*_migrated`), so they cannot run twice on the same DB. **Don't suggest deleting them** as a follow-up — they're harmless on this DB and useful if a fresh WP environment (staging, new local install) ever needs to be seeded.
