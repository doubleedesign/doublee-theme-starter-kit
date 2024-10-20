## Changes in version 3

### Theme features
- Header updated to use Vue to render a new responsive menu, in line with recent client projects.
- Admin - support for ACF Extended for dynamic previews of flexible content modules in the backend. 
- Removed favicon field from global options because it's now available natively in the site general settings (it used to be in the customiser, which I disable).

### Code structure
- Moved functions that were duplicated in this and the block theme into a plugin.
- Moved ACF flexible content modules into `./modules` folder and co-located styles and scripts, for use in Storybook and by ACF Extended for rendering dynamic previews in the backend. 
- Moved other template partials into `./components` and also co-located their styles and scripts for use in Storybook and general consistency with the content modules. 
- Moved common CSS and JS into `./common` folder.
- Renamed `theme.json` to `theme-vars.json` to avoid confusion with the `theme.json` file used by block themes.
- Added loading of fonts and Font Awesome from URLs/kit IDs set in the Global Options page, for ease of per-client setup as well as ensuring I stop loading and distributing my accounts' URLs/kit IDs with this theme.

### Dependencies
- Updated some Bootstrap scripts to the latest version.
- Added Vue ESM browser build and Vue SFC Loader for use in the theme.

### Tooling 
- Upgraded to Gulp 5.
- Fixed some SCSS mixins that weren't applying breakpoints properly.
- Change some utility class names to match the way they're done in blocks, so I can more easily share code between themes.


## Changes in version 2
### Theme features
- `theme.json` file for easy customisation of theme colours, fonts, and other settings. This file is used:
    - in the Gulp SCSS compilation process to generate the theme's `style.css` file
    - in PHP files that customise some TinyMCE and ACF options in the admin.
- Preview of colour selections in ACF fields when the colour names match those in `theme.json` (e.g., primary, secondary).

### Code structure
- PHP function files refactored into an object-oriented pattern, similar to how my [plugin framework](https://github.com/doubleedesign/doublee-plugin-framework) is structured.

### Tooling
- All Gulp tasks now run immediately when the `gulp` command is run, rather than waiting for a file change.
- Removed BrowserSync because I don't really use it much and want to keep dependencies to a minimum.
- Various dependency updates, cleanup and simplification.
