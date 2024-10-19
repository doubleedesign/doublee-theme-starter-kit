# Double-E WP Theme Starterkit (Classic Editor edition)

**A WordPress theme starterkit for developers of bespoke websites.**

Designed for use with Classic Editor with Advanced Editor Tools (previously TinyMCE Advanced) and Advanced Custom Fields Pro.

## Version 3

Version 3 contains many breaking changes due to restructuring a lot of things and intention to start using this is a parent theme. (Shouldn't really matter for previous projects because it was not previously designed to be a parent theme.) See the [changelog](CHANGELOG.md) for more details.

---

## Working with this starter kit

### Getting started

- Install and activate [Classic Editor](https://wordpress.org/plugins/classic-editor/) and [Advanced Editor Tools](https://wordpress.org/plugins/tinymce-advanced/) plugins
- Set Classic Editor to the default editor everywhere
- Import [these TinyMCE settings](setup/tinymce-settings.json) (Go to Settings > Advanced Editor Tools > Import Settings)
- Get the plugins/licenses described below
- Fork this repo, set it up in your IDE, and rename `starterkit` and `Starterkit` everywhere to your own theme name (do a case-sensitive find-and-replace)
- Install [Gulp](https://gulpjs.com/) globally
- Navigate to the theme folder in your terminal
- Run `npm install`
- Update `theme-vars.json` with your settings 
- Run `gulp` to watch SCSS, JS, and `theme-vars.json` for changes
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
- Update the SCSS variables file using the `theme-vars.json` file
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

With that in mind, to take a separation-of-concerns approach as much as is practical, I use this theme starterkit with my own [base plugin](https://github.com/doubleedesign/doublee-base-plugin) and an additional plugin for client-specific functionality. 

This theme is also designed to work with my [breadcrumb](https://github.com/doubleedesign/breadcrumbs-doublee) plugin.

The front-end layout grid system used is a modified version of Bootstrap 5.2's [flexbox grid system](https://getbootstrap.com/docs/5.2/layout/grid/)
and [breakpoints](https://getbootstrap.com/docs/5.2/layout/breakpoints/). My version does not require both containers and rows - rows have the max-width properties of containers added.

