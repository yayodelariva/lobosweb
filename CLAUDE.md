# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Running the site

No build step — open any `index.html` directly in a browser, or serve from the repo root with a local server:

```bash
npx serve .
# or
python3 -m http.server 8080
```

## Deployment

Deployment to the cPanel host is declared in `.cpanel.yml`. It copies top-level folders and files to `/home1/bgyakwmy/public_html/` on the server. There is no CI; deployment is triggered manually via cPanel's Git deployment integration.

## Architecture

### File layout

The site is a multi-page static site. Each section is a directory with its own `index.html`. The team roster section has two levels of nesting:

```
equipos/
  foam/
    foamvaronil/   foamfemenil/   foammixto/
  cloth/
    clothvaronil/  clothfemenil/  clothmixto/
```

### Single shared CSS

All pages reference the single `style.css` at the repo root via relative paths (e.g., `../../style.css`). There is no scoped or per-page stylesheet.

### Navbar and footer (scripts/navbar.js, scripts/footer.js)

Both scripts are included in every page. They populate empty `<a>` and `<div>` placeholder elements with text content and `href`/`src` values at runtime. Because the site uses relative paths and no routing, each script contains a chain of `if/else` blocks keyed on `window.location.pathname` to compute the correct relative path for every link and image depending on the current page's nesting depth.

**Consequence:** adding a new page at a new depth requires adding a new `if/else` branch to both `navbar.js` and `footer.js`.

### Player data (two layers)

Player data exists in two separate places and must be kept in sync manually:

1. **Portrait layer** — each roster page (e.g., `equipos/foam/foamvaronil/`) has a paired `dom*.js` file. It defines a `Player` class with a `generateDom()` method that injects a portrait image and name into a pre-existing `<div id="playerCamelCaseName">` placeholder in the HTML. Each roster page's HTML must have matching placeholder `div` IDs.

2. **Playercard layer** — `scripts/playercards.js` defines a separate `playercard` class with richer stats (position, nickname, height, years, teams, etc.). It handles click events on player wrappers and renders a modal overlay with full player details. Player data (stats + image path) is hard-coded directly in the constructor calls in this file.

Adding a new player requires: (a) a placeholder `div` in the roster HTML, (b) a `Player` instance and `generateDom()` call in the relevant `dom*.js`, and (c) a `playercard` instance and `case` in the `switch` inside `handleClickedPlayercard` in `playercards.js`.
