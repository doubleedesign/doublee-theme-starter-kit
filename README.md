# doublee-dev-starter-kit

**A WordPress site starter kit for developers of bespoke websites.**

Designed for use with Classic Editor, Advanced Custom Fields Pro, and my own included breadcrumb plugin. Includes some other plugins I commonly use, but they are not essential for the base install to work out-of-the-box.

The starter kit theme does not yet support the block editor because my projects tend to involve extensive use of custom post types, taxonomies, archive pages, etc which would result in very different editing experiences for different parts of the site if the block editor was used. So for the best client experience currently possible, I'm sticking with the "classic" method at least for now.

## Build tools for themes

Scripts are set up in `package.json` for:
- [eslint](https://eslint.org)
- [phplint](https://www.npmjs.com/package/phplint)
- [stylelint](https://stylelint.io/) with [SCSS plugin](https://www.npmjs.com/package/stylelint-scss) 
- [prettier](https://prettier.io/)

I use PHPStorm which also has an option to run ESLint and Prettier on file save.

A Gulpfile is included to: 
- Concatenate and minify JS files
- Compile, concatenate and minify SCSS files into the theme's `style.css`
- Generate sourcemaps for JS and SCSS

[Commitizen](https://github.com/commitizen/cz-cli) is set up to run with the `yarn commit` command. It will also lint staged files before proceeding to the 
commit options.

## Front-end libraries

I worked with [Foundation](https://get.foundation/) for many years, as well as working at an agency where our starter kit used [Bootstrap](https://getbootstrap.com/). In both cases, some parts of the framework were used and not others (whether it be simply not implementing a component, or using an alternative or a custom replacement). After having a few cracks at rolling my own and taking some other frameworks out for a brief test drive, I decided it was best to cherry-pick the parts of libraries/frameworks that it makes the most sense for me to use - no more, no less - and combine them along with my own custom stuff as needed. Let's not have all of Bootstrap sitting there if we're just using the grid and a couple of other components. Let's not have three different accordions in the code when we only need one. 

So far, the third-party libraries/parts of libraries used are:
- Bootstrap 5.2's [flexbox grid system](https://getbootstrap.com/docs/5.2/layout/grid/) and [breakpoints](https://getbootstrap.com/docs/5.2/layout/breakpoints/) .  It works well, it's easy to use, it's flexbox - it makes sense to use it.

I'm sure I will add to this list as I build sites with this starter kit and create new reusable components, find it makes sense to include a utility library, etc.