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