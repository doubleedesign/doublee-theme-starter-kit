# doublee-theme-starter-kit

**A WordPress theme starterkit for developers of bespoke websites.**

Designed for use with Classic Editor with Advanced Editor Tools (previously TinyMCE Advanced) and Advanced Custom Fields Pro.

**Note:** This starterkit theme does not yet support the block editor because my projects tend to involve extensive use of
custom post types, taxonomies, archive pages, etc which would result in very different editing experiences for
different parts of the site if the block editor was used. So for the best client experience currently possible,
I'm sticking with the "classic" method for now.

## Changes in version 2
#### Theme features
- `theme.json` file for easy customisation of theme colours, fonts, and other settings. This file is used: 
  - in the Gulp SCSS compilation process to generate the theme's `style.css` file
  - in PHP files that customise some TinyMCE and ACF options in the admin.
- Preview of colour selections in ACF fields when the colour names match those in `theme.json` (e.g., primary, secondary).

#### Code structure
- PHP function files refactored into an object-oriented pattern, similar to how my [plugin framework](https://github.com/doubleedesign/doublee-plugin-framework) is structured.

#### Tooling
- All Gulp tasks now run immediately when the `gulp` command is run, rather than waiting for a file change.
- Removed BrowserSync because I don't really use it much and want to keep dependencies to a minimum.
- Various dependency updates, cleanup and simplification.

---

## Working with this starter kit

### Getting started

- Install and activate [Classic Editor](https://wordpress.org/plugins/classic-editor/) and [Advanced Editor Tools](https://wordpress.org/plugins/tinymce-advanced/) plugins
- Set Classic Editor to the default editor everywhere
- Import [these TinyMCE settings](setup/tinymce-settings.json) (Go to Settings > Advanced Editor Tools > Import Settings)
- Get the plugins/licenses described below
- Fork this repo, set it up in your IDE, and rename `starterkit` and `Starterkit` everywhere to your own theme name (do a case-sensitive find-and-replace)
- Install Gulp globally if you haven't already (or modify to use whatever tool you prefer to compile stuff)
- Navigate to the theme folder in your terminal
- Run `npm install`
- Update `theme.json` with your settings 
- Run `gulp` to watch SCSS, JS, and `theme.json` for changes
- Get theming!

### Build tools

Scripts are set up in `package.json` for:

- [eslint](https://eslint.org)
- [stylelint](https://stylelint.io/) with [SCSS plugin](https://www.npmjs.com/package/stylelint-scss)

I use PHPStorm which has some built-in formatting and code quality options (inspections) for PHP, so I use those rather
than a separate PHP linting/code quality tool. My preferences are included in this repo (in the `.idea` folder) but you
can easily override them in your own projects using PHPStorm's preferences dialog.

You can see the results of PHPStorm's inspections as you go using the Problems tool window. I configure mine to just
check the theme and/or any custom plugins I'm working on in the project.

A Gulpfile is included to:

- Concatenate JS files, including support for ES6 module imports
- Update the SCSS variables file using the `theme.json` file
- Compile, concatenate and minify SCSS files into the theme's `style.css`
- Generate sourcemaps for JS and SCSS

Gulp needs to be installed globally: `npm install gulp-cli -g`.

[Commitizen](https://github.com/commitizen/cz-cli) is set up to run with the `npm run commit` command.
It will also lint staged files before proceeding to the commit options.

### Licensing, plugins, and APIs

To use this kit you will need:
- Your own [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/) licence
- Your own [ACF Component Field plugin](https://acf-component-field.gummi.io/) licence (if using the component fields, such as "colour theme")
- Your own [Hover.css](https://ianlunn.github.io/Hover/) licence if using for a commercial project
- Your own [Google Maps API](https://developers.google.com/maps/documentation/javascript/get-api-key) key (with Maps JavaScript API and Places API enabled) if using any of the map-related content modules
- Your own [Font Awesome Pro](https://fontawesome.com/) licence (or change the icons throughout the theme code to use only free icons or a different icon library of your choice)

The form modules have been styled for and tested with Ninja Forms, but not all extensions have been tested. The modules should work with any form plugin that allows you to use a shortcode to display a form, you will just need to do your own styling.

Some parts of the code have been pulled from open source libraries and modified to suit my needs, for example the [Bootstrap](https://getbootstrap.com/) grid* and accordion. I have included attribution comments where this is the case.

### General intentions and advice

I am of the firm opinion that it is best practice for custom post types, taxonomies, related custom fields/meta (ACF-based or otherwise) to be defined in plugins (not themes). Similarly, most functionality that is not about the front-end design / content display usually also belongs in a plugin.

With that in mind, to take a separation-of-concerns approach as much as is practical, I use this theme starterkit with my own [plugin framework](https://github.com/doubleedesign/doublee-plugin-framework). I create a custom theme and plugin for each individual client site by copying, modifying, and adding to these two codebases.

This theme is also designed to work with my [breadcrumb](https://github.com/doubleedesign/breadcrumbs-doublee) plugin.

The front-end layout grid system used is a modified version of Bootstrap 5.2's [flexbox grid system](https://getbootstrap.com/docs/5.2/layout/grid/)
and [breakpoints](https://getbootstrap.com/docs/5.2/layout/breakpoints/). My version does not require both containers and rows - rows have the max-width properties of containers added.

