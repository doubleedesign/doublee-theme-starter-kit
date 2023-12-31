# doublee-theme-starter-kit

**A WordPress theme starterkit for developers of bespoke websites.**

Designed for use with Classic Editor with Advanced Editor Tools (previously TinyMCE Advanced) and Advanced Custom Fields Pro.

**Note:** This starterkit theme does not yet support the block editor because my projects tend to involve extensive use of
custom post types, taxonomies, archive pages, etc which would result in very different editing experiences for
different parts of the site if the block editor was used. So for the best client experience currently possible,
I'm sticking with the "classic" method for now.

## Build tools 

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
- Compile, concatenate and minify SCSS files into the theme's `style.css`
- Generate sourcemaps for JS and SCSS

Gulp needs to be installed globally: `npm install gulp-cli -g`.

[Commitizen](https://github.com/commitizen/cz-cli) is set up to run with the `yarn commit` command.
It will also lint staged files before proceeding to the commit options.

## Setup

- Install and activate [Classic Editor](https://wordpress.org/plugins/classic-editor/) and [Advanced Editor Tools](https://wordpress.org/plugins/tinymce-advanced/) plugins
- Set Classic Editor to the default editor everywhere
- Import [these TinyMCE settings](setup/tinymce-settings.json) (Go to Settings > Advanced Editor Tools > Import Settings)
- Get the plugins/licenses described below
- Fork this repo, set it up in your IDE, and rename `starterkit` everywhere to your own theme name
- Install Gulp globally if you haven't already (or modify to use whatever tool you prefer to compile stuff)
- Navigate to the theme folder in your terminal
- Run `npm install` or `yarn install`
- Run `gulp` (or your alternative) to watch SCSS and JS for changes
- Get theming!

## General intentions and advice

I am of the firm opinion that it is best practice for custom post types, taxonomies, related custom fields/meta (ACF-based or otherwise) to be defined in plugins (not themes). Similarly, most functionality that is not about the front-end design / content display usually also belongs in a plugin.

With that in mind, to take a separation-of-concerns approach as much as is practical, I use this theme starterkit with my own [plugin framework](https://github.com/doubleedesign/doublee-plugin-framework). I create a custom theme and plugin for each individual client site by copying, modifying, and adding to these two codebases.

This theme is also designed to work with my [breadcrumb](https://github.com/doubleedesign/breadcrumbs-doublee) plugin.

## Licensing, plugins, and APIs

To use this kit you will need:
- Your own [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/) licence
- Your own [ACF Component Field plugin](https://acf-component-field.gummi.io/) licence (if using the component fields, such as "colour theme")
- Your own [Hover.css](https://ianlunn.github.io/Hover/) licence if using for a commercial project
- Your own [Google Maps API](https://developers.google.com/maps/documentation/javascript/get-api-key) key (with Maps JavaScript API and Places API enabled) if using any of the map-related content modules
- Your own [Font Awesome Pro](https://fontawesome.com/) licence (or change the icons throughout the theme code to use only free icons or a different icon library of your choice)

The form modules have been styled for and tested with Ninja Forms, but not all extensions have been tested. The modules should work with any form plugin that allows you to use a shortcode to display a form, you will just need to do your own styling.

## A bit of background re front-end libraries

I worked with [Foundation](https://get.foundation/) for many years, as well as working at an agency where our starter
kit
used [Bootstrap](https://getbootstrap.com/). In both cases, some parts of the framework were used and not others
(whether it be simply not implementing a component, or using an alternative or a custom replacement).
After having a few cracks at rolling my own and taking some other frameworks out for a brief test drive,
I decided it was best to cherry-pick the parts of libraries/frameworks that it makes the most sense for me to use - no
more, no less -
and combine them along with my own custom stuff as needed.
e.g., Let's not have all of Bootstrap sitting there if we're just using the grid and a couple of other components. Let's
not have three different accordions in the code when we only need one, etc.

So far, the third-party libraries/parts of libraries used/adapted are:

- A modified version of Bootstrap 5.2's [flexbox grid system](https://getbootstrap.com/docs/5.2/layout/grid/)
  and [breakpoints](https://getbootstrap.com/docs/5.2/layout/breakpoints/). My version does not require both containers
  and rows - rows have the max-width
  properties of containers added.
- Bootstrap 5.2's Accordion

I will add to this list as I build sites with this starter kit and create new reusable components, find it makes sense
to include a utility library, etc.
