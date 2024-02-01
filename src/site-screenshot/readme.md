# Site Screenshots

Display the screenshot for the current post (site). This uses the uploaded image if available, otherwise falls back to using the `domain` to take and load a screenshot from mshots.

The mshots behavior uses the [Interactivity API](https://github.com/WordPress/gutenberg/blob/trunk/packages/interactivity/docs/1-getting-started.md) to provide a CSS-controlled loading state.

When a local image is used, the block may use responsive images, depending on the location.

This block also controls loading the panel into the Document Settings sidebar for uploading the desktop & mobile images, and setting the custom background color.

## Attributes

### `isLink`: boolean

- Default: false

If true, will wrap the screenshot in a link to the current post.

### `lazyLoad`: boolean

- Default: false

Controls the `loading` attribute on the `img` tag. This is currently not used for mshots images.

### `type`: "desktop" | "mobile"

- Default: "desktop"

Controls which image to show/capture. When `desktop`, it uses the image saved as `screenshot-desktop` or captures from mshots at 1920x1080. When `mobile`, it uses the image saves as `screenshot-mobile` or captures from mshots at 375x667.

### `location`: "grid" | "hero" | "header" | "row"

- Default: "grid"

This indicates to the block where in the layout this will be rendered. This is used to control the responsive image hints.

- grid: the main site grid, on homepage or archives, which displays at 3, 2, or 1 column depending on screen size.
- hero: the homepage header, does not use responsive images.
- header: single site page header, does not use responsive images.
- row: the "related sites" section, which displays at 3 or 1 column depending on screen size.

