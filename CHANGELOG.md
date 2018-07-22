# Change Log
All notable changes to this project will be documented in this file.

## [1.2.0] - 2016-07-07
### Added
- generate: folder containing template files for grunt generate
- sass: _reset.scss to replace bootstrap reset

### Changed
- gruntfile: fixed variable being used before declaration
- gruntfile: added semicolons to satisfy jshint
- gruntfile: include tasks for grunt generate
- package.json: include grunt-contrib-copy
- sass: grid is now flexbox based
- sass: more utility classes
- sass: media object is now flexbox based
- js: new collapse js to replace bootstrap
- lib nav: add item ids to menu items for collapse functionality
- config.json: add new variable for generate prefix

### Removed
- sass: all instances of bootstrap by default

## [1.1.8] - 2015-10-30
### Added
- sass: screen-[size]-maximum variables (matches max-width media query breakpoints to the pixel)

### Changed
- bower: updated modernizr

### Removed
- sass: absolutely positioned footer

### Fixed
- theme: modernizr src


## [1.1.7] - 2015-10-27
### Added
- sass: img { height: auto; }
- sass: %cover utility
- admin: "wpe_dify_news_feed" metabox removal
- theme: <meta name="format-detection" content="telephone=no">

### Changed
- modernizr: updated default modernizr custom build to v3 syntax
- packages: updated modernizr, bower, grunt-contrib-uglify, grunt-sass, grunt-postcss, time-grunt

### Removed
- theme: unused google analytics snippet


## [1.1.6] - 2015-09-28
### Added
- sass: .navbar { border-radius: 0; }
- sass: %overlay utility
- sass: hide gravity form honeypot field

### Changed
- packages: updated bower, grunt-modernizr, autoprefixer, load-grunt-tasks

### Removed
- directory: assets/img/favicons/


## [1.1.5] - 2015-09-11
### Added
- site options: environment toggle for Production and Development environments


## [1.1.4] - 2015-09-09

### Added
- file: config.json.example for devUrl implementation in Gruntfile (duplicate the file and rename the copy to "config.json" - always make sure there is a config.json.example in the repo)

### Changed
- package: updated bower 1.4.1 > 1.5.2
- package: updated grunt-contrib-jshint 0.11.2 > 0.11.3
- package: updated grunt-contrib-uglify 0.9.1 > 0.9.2
- package: updated grunt-postcss 0.5.5 > 0.6.0
- package: updated autoprefixer 5.2.1 > 6.0.1
- package: updated csswring 3.0.5 > 4.0.0

### Removed
- custom favicon module in favor of WordPress 4.3 native icon method


## [1.1.3] - 2015-08-03
### Added
- sass: _variables.scss: $footer-height
- sass: _form-skin.scss: more input selectors

### Changed
- gruntfile: decreased version hash length from 32 > 8
- jquery: updated from 1.11.3 > 2.1.4
- sass: variables organization


## [1.1.2] - 2015-07-28
### Added
- function: added "wpseo-dashboard-overview" to ll_remove_dashboard_meta (removes metabox from WP dashboard)
- sass: img { max-width: 100%; }

### Changed
- gruntfile: browserSync and watch file syntax to catch-all > **/*
- package: updated grunt-postcss 0.5.1 > 0.5.5
- package: updated autoprefixer-core 5.2.0 > 5.2.1
- tgm: updated required plugins module to 2.5.2

### Removed
- file: CONTRIBUTING.md


## [1.1.1] - 2015-07-06
### Added
- sass: _post.scss (used for single post pages)

### Changed
- tgm: updated required plugins module to 2.5.0
- sass: _entry.scss (used for news/blog archive page) - incorporates BEM syntax
- sass: navbar li elements display inline-block (previously inline)
- sass: navbar a elements display block (previously inline-block)
- sass: old transition mixin syntax to regular transition syntax in favor of autoprefixer, which handles prefixing automatically
- file: content.php - modified parent article to include "entry" class, incorporated BEM syntax on all elements
- file: comments.php - modified class to "post__comments"

### Removed
- file: README.md (need to re-write it)
- theme: class "banner" from navbar

### Fixed
- function: set_post_background() spacing issue


## [1.1.0] - 2015-06-23
### Added
- package: grunt-browser-sync (run "grunt" or "grunt dev" instead of "grunt watch")
- package: postcss
- package: autoprefixer-core
- package: csswring
- theme: add_theme_support('title-tag')
- file: helpers/_functions.scss
- map: $breakpoints
- mixin: font-size()
- mixin: make-font-size()

### Changed
- Updated Gruntfile.js
- Updated load-grunt-tasks to 3.2.0
- Updated time-grunt to 1.2.1
- Commented out add_theme_support('post-formats')

### Removed
- package: grunt-autoprefixer
- package: grunt-contrib-concat
- mixin: "border-radius"
- mixin: "opacity" mixin
- mixin: "transform" mixin
- mixin: "transition" mixin
- mixin: "transition-delay" mixin
- theme: wp_title()
- theme: roots_wp_title()
- theme: <link type="application/rss+xml"...> (hardcoded feed link)
- theme: sidebar-footer widget
- theme: load_theme_textdomain()
- theme: lang, lang/roots.pot


## [1.0.14] - 2015-06-17
### Added
- Private attribute to package.json
- transition-delay mixin

### Changed
- Updated bootstrap-sass to 3.3.5
- Updated jQuery to 1.11.3
- Updated grunt-sass to 1.0.0


## [1.0.13] - 2015-06-10
### Added
- "ll_remove_wp_version" filter that removes WP version meta from the <head>
- "ll_remove_wp_emoji" filter that removes Emoji styles/scripts

### Changed
- Updated TGM required plugins module
- Updated CMB2 "example-functions.php"
- Updated "_main.js" to include finalize function for the "about_us" page example

### Removed
- Duplicate variable in _variables.scss

### Fixed
- block-table__cell display issue once it begins to tile


## [1.0.12] - 2015-05-27
### Added
- Filter that adds page slug to the body class

### Changed
- Moved appropriate functions into "custom-functions"
- Bumped jQuery bower dependency to 1.11.3


## [1.0.11] - 2015-05-17
### Added
- %vertical-align utility in _utilities.scss
- Two more examples z-layer uses in _maps.scss

### Changed
- Meta options function prefixes


## [1.0.1] - 2015-02-17
### Added
- _block-table.scss 
- _gravity-forms.scss

### Changed
- Update Favicons module
- Spacing throughout SCSS files
- Rename "meta-options-main" > "meta-options-global"
- Rename "meta-options-social" > "meta-options-contact"


## [1.0.0] - 2014-04-14
### Added
- Initial launch
