# AGENTS.md

This file provides guidance to coding agents when working with code in this repository.

## What this repo is

A block-based **child theme** for the WordPress.org Showcase (`wordpress.org/showcase/`), bundled with a local `wp-env` environment. The only versioned code is `source/wp-content/themes/wporg-showcase-2022/` — everything else under `source/` is installed by Composer and gitignored.

Parent theme is `wporg-parent-2021` (`Template:` in `style.css`), pulled in via Composer along with `wporg-mu-plugins` (which supplies the `wporg/global-header`, `wporg/global-footer`, `wporg/query-filter`, `wporg/query-total`, `wporg/local-navigation-bar` blocks the templates rely on) and the legacy `wporg-showcase` theme.

## Commands

Run from the repo root, not from the theme folder.

```bash
yarn && composer install && yarn setup:tools   # first-time setup (setup:tools generates lint configs)
yarn wp-env start                              # start env at localhost:8888 (admin/password)
yarn setup:wp                                  # import content, activate theme, set options
yarn build:theme                               # build the theme's JS/CSS
yarn start:theme                               # build + watch
yarn lint:php                                  # phpcs over the theme
composer run format source/wp-content/themes/wporg-showcase-2022   # phpcbf, autofix PHP style
yarn lighthouse                                # asserts a11y/best-practices/SEO = 100
yarn wp-env run cli "post list --post_status=publish"   # wp-cli (keep command quoted)
yarn wp-env clean all && yarn setup:wp         # reset WordPress to a clean install
yarn update:tools                              # composer update + re-sync repo-tools configs
```

JS/CSS linting lives in the theme workspace: `yarn workspace wporg-showcase-2022-theme lint:js` / `lint:css` / `format`.

There is **no test suite** in this repo. CI runs linting only (`.github/workflows/linters.yml`, via `wporg-repo-tools`).

Node version is pinned in `.nvmrc` (20).

## Build & deploy

`.github/workflows/build.yml` runs on every push to `trunk`: it strips the repo down to just the theme directory, appends the short SHA to the `Version:` header in `style.css`, and force-pushes the result to the `build` branch. Downstream consumers (and other wporg repos' Composer deps) track that branch — never commit to `build` directly.

## Gotchas

`build/` is gitignored and is not optional at runtime: `functions.php` calls `filemtime()` on `build/style/style-index.css` and every block registers from `build/<name>`. A fresh clone (or anything that clears `build/`) leaves the theme erroring until `yarn build:theme` runs.

Local seed content comes from `env/showcase-posts.xml` and `env/showcase-pages.xml`, imported by `env/setup.sh`. To refresh it from a production export, scrub PII first with `env/scrub-export.php`.

## Linting configuration

`.eslintrc.js`, `.prettierrc.js`, `.stylelintrc`, and `phpcs.xml.dist` are **generated** by `yarn setup:tools` from `wporg-repo-tools` and are gitignored. The committed `phpcs.xml` imports `phpcs.xml.dist` and only adds project overrides — chiefly relaxing escaping, embedded-PHP, and filename rules inside `patterns/`.

## Theme architecture

### Blocks

Each custom block lives in `src/<block-name>/`:

- `block.json` — metadata. `render` points back into source (`file:../../src/<name>/render.php`) even though the built block ships in `build/`.
- `index.js` — editor registration; `style.scss`/`editor.scss` compiled by `wp-scripts`.
- `index.php` — namespaced under `WordPressdotorg\Theme\Showcase_2022\<Block>`, hooks `init`, and calls `register_block_type( dirname( dirname( __DIR__ ) ) . '/build/<name>' )` — i.e. registration always reads the **build** directory, so `yarn build:theme` is required after touching block metadata.

`functions.php` `require_once`s each `src/*/index.php` explicitly; adding a block means adding a require line there.

`src/style/` is not a real block — it's a webpack entry point whose `index.js` only imports `style.scss`, producing the theme's main stylesheet (`build/style/style-index.css`), enqueued with the parent stylesheet as a dependency.

`src/meta-box/` is editor-only; `functions.php` registers its script by hand from `build/meta-box/block.json` and enqueues it in admin.

### Templates & patterns

`templates/*.html` are thin — they compose global header/footer blocks plus `<!-- wp:pattern -->` references. The real markup lives in `patterns/*.php`.

Pattern files prefixed with `_` (e.g. `_site-grid.php`, `_nav.php`, `_footer.php`) are partials marked `Inserter: no`, included by other patterns/templates. Patterns are PHP so they can call `esc_html_e()` inside block attributes for translation.

### Content model

Showcase sites are plain `post` objects. Site data lives in registered post meta (`domain`, `author`, `country`, `theme`, `feature-color`, `screenshot-desktop`, `screenshot-mobile`), all registered in `setup_theme()` in `functions.php`.

Taxonomies: core `category` and `post_tag`, plus a custom hierarchical `flavor` taxonomy. The `featured` category is an internal marker — it is filtered out of frontend term lists (`remove_featured_category_frontend`) and excluded from the category filter dropdown, but must stay visible in admin and REST.

Screenshots fall back to mShots captures driven by the `domain` meta when no image is uploaded; the loading state uses the Interactivity API (`src/site-screenshot/view.js`). See `src/site-screenshot/readme.md` for the block's attributes and the `location` sizing hints.

### Filtering & queries

`inc/block-config.php` is the integration point with the mu-plugins query-filter block. It supplies options via `wporg_query_filter_options_{post_tag,flavor,category,sort}`, injects the other active filters as hidden inputs (`wporg_query_filter_in_form`) so filters combine into URLs like `?tag[]=cuisine&cat[]=3&s=…`, and rewrites the archive title.

Two quirks worth knowing:

- Sorting is a single combined value (`date_desc`) because a filter can only emit one key; `modify_query()` splits it back into `orderby`/`order` on `pre_get_posts`.
- Single-term filter URLs (`/archives/?tag[]=x`) redirect to the canonical term archive (`/tag/x/`) in `redirect_term_archives()` to avoid duplicate URLs.

### Jetpack

Related posts come from Jetpack but the auto-injected markup is removed and replaced with a block-markup query (`jetpack_related_posts_display`), padded out with recent `featured` posts when Elasticsearch returns fewer than three. Contact form submissions (site submissions) are redirected via `grunion_contact_form_redirect_url`.

## Conventions

- Text domain is `wporg` for everything.
- PHP is namespaced under `WordPressdotorg\Theme\Showcase_2022\…`; hooks are registered at the top of each file with `__NAMESPACE__ . '\function_name'`.
- Prefer `theme.json` and template/pattern markup over CSS — `style.css` is intentionally near-empty, and the parent theme owns most design tokens.
- Commit subjects follow `Area: Description` (e.g. `Filters: Update the sort filter label`).

## Working against a local parent theme

To test parent-theme changes, clone `wporg-parent-2021` and create `.wp-env.override.json` with the **entire** `themes` array copied from `.wp-env.json`, repointing the parent path — the override replaces the array rather than merging it.
