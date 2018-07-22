'use strict';

module.exports = function(grunt) {

  function slugify(text, useHyphens) {

    if ( typeof useHyphens === 'undefined' ) {
      useHyphens = true;
    }

    var replacement = '-';

    if ( ! useHyphens ) {
      replacement = '_';
    }

    text = text.toString().toLowerCase().trim()
      .replace(/\s+/g, replacement)                      // Replace spaces with -
      .replace(/&/g, replacement + 'and' + replacement)  // Replace & with 'and'
      .replace(/[^\w\-]+/g, '')                          // Remove all non-word chars
      .replace(/\-\-+/g, replacement);                   // Replace multiple - with single -

    if ( useHyphens ) {
      text = text.replace(/\_/g, '-');                          // Replace _ with -
    }

    return text;
  }
  function insertBeforeLastOccurrence(strToSearch, strToFind, strToInsert) {
    var n = strToSearch.lastIndexOf(strToFind);
    if ( strToFind !== 'eof' ) {
      if (n < 0) {
        return strToSearch;
      }
    }
    else {
      var matches = strToSearch.match(/\r?\n$/);

      if ( matches ) {
        n = matches.index;
      }
      else {
        return strToSearch;
      }
    }

    return strToSearch.substring(0,n) + strToInsert + strToSearch.substring(n);
  }

  // Load all tasks
  require('load-grunt-tasks')(grunt);

  // Show elapsed time
  require('time-grunt')(grunt);

  // Config
  var config = require('./config.json');

  // JS file list
  // Comment out unused JS files
  var jsFileList = [
    'resources/vendor/magnific-popup/dist/jquery.magnific-popup.min.js',
    'resources/js/plugins/*.js',
    'resources/js/app.js',
    'resources/js/_*.js',
    'components/**/*.js'
  ];

  grunt.initConfig({

    /**
     * jshint
     * https://github.com/gruntjs/grunt-contrib-jshint
     */
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'resources/js/*.js',
        '!assets/js/scripts.js',
        '!assets/**/*.min.*'
      ]
    },

    /**
     * uglify
     * https://github.com/gruntjs/grunt-contrib-uglify
     */
    uglify: {
      options : {
        beautify: false,
        mangle: true,
        compress: true,
      },
      dist: {
        files: {
          'assets/js/scripts.min.js': [jsFileList]
        }
      }
    },

    /**
     * modernizr
     * https://github.com/Modernizr/grunt-modernizr
     */
    modernizr: {
      build: {
        dest: 'assets/js/vendor/modernizr-custom.min.js',
        files: {
          'src': [
            ['assets/js/scripts.min.js'],
            ['assets/css/main.min.css']
          ]
        },
        uglify: true,
        parseFiles: true
      }
    },

    /**
     * sass import
     * https://github.com/eduardoboucas/grunt-sass-import
     */
    sass_import: {
      option: {},
      dist: {
        files: {
          'resources/sass/app.scss': [
            'resources/sass/main.scss',
            'components/**/*.scss'
          ]
        }
      }
    },
    /**
     * sass
     * https://github.com/sindresorhus/grunt-sass
     */
    sass: {
      options: {
        sourceMap: true,
        outputStyle: 'compressed'
      },
      dist: {
        files: {
          'assets/css/main.min.css': ['resources/sass/app.scss']
        }
      }
    },

    /**
     * postcss
     * https://github.com/nDmitry/grunt-postcss
     * https://github.com/postcss/autoprefixer
     * https://github.com/ai/browserslist
     */
    postcss: {
      options: {
        map: true,
        processors: [
          require('autoprefixer')({
            browsers: ['last 3 versions', 'Safari >= 8', 'iOS >= 7', 'Android >= 4']
          }),
          require('csswring')
        ]
      },
      dist: {
        src: 'assets/css/main.min.css'
      }
    },

    /**
     * version
     * https://github.com/roots/grunt-wp-assets
     */
    version: {
      default: {
        options: {
          format: true,
          length: 8,
          manifest: 'assets/manifest.json',
          querystring: {
            style: 'roots_css',
            script: 'roots_js'
          }
        },
        files: {
          'lib/scripts.php': 'assets/{css,js}/{main,scripts}.min.{css,js}'
        }
      }
    },

    /**
     * browserSync
     * https://github.com/BrowserSync/grunt-browser-sync
     * http://www.browsersync.io/docs/grunt/
     */
    browserSync: {
      dev: {
        bsFiles: {
          src : [
            'assets/css/main.min.css',
            'assets/js/scripts.min.js',
            '**/*.php'
          ]
        },
        options: {
          proxy: config.devUrl,
          watchTask: true
        }
      }
    },

    /**
     * watch
     * https://github.com/gruntjs/grunt-contrib-watch
     */
    watch: {
      sass: {
        files: [
          'resources/sass/**/*.scss',
          'components/**/*.scss'
        ],
        tasks: ['sass_import', 'sass', 'postcss', 'version']
      },
      js: {
        files: [
          jsFileList,
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'uglify']
      }
    },

    /**
     * generate new files
     */
    generate: {

      /**
       * Component generator
       */
      component: {
        expand: true,
        src: 'generate/component/*',
        rename: function( dest, src ) {
          var slug = slugify( grunt.task.current.args[0] );
          return 'components/' + slug + '/' + src.replace( 'component', slug );
        },
        flatten: true,
        nonull: true,
        options: {
          process: function( content, srcpath ) {
            var data = {
              name: grunt.task.current.args[0],
              slug: slugify( grunt.task.current.args[0] ),
              prefix: config.prefix
            };

            return grunt.template.process( content, { data: data } );
          }
        }
      },

      /**
       * Sass generators
       */
      sassHelper: {
        expand: true,
        src: 'generate/helper.scss',
        rename: function() {
          var slug = slugify(grunt.task.current.args[0]);
          return 'resources/sass/helpers/_' + slug + '.scss';
        },
        flatten: true,
        filter: 'isFile',
        nonull: true,
        options: {
          process: function(content, srcpath) {
            var data = {
              name: grunt.task.current.args[0],
              slug: slugify(grunt.task.current.args[0])
            };

            var mainSass = grunt.file.read('resources/sass/main.scss');

            mainSass = insertBeforeLastOccurrence(mainSass, '\n// Vendors', '@import "helpers/_' + data.slug + '";\r\n');

            grunt.file.write('resources/sass/main.scss', mainSass);
            return grunt.template.process(content, {data: data});
          }
        }
      },
      sassBase: {
        expand: true,
        src: 'generate/base.scss',
        rename: function() {
          var slug = slugify(grunt.task.current.args[0]);
          return 'resources/sass/base/_' + slug + '.scss';
        },
        flatten: true,
        filter: 'isFile',
        nonull: true,
        options: {
          process: function(content, srcpath) {
            var data = {
              name: grunt.task.current.args[0],
              slug: slugify(grunt.task.current.args[0])
            };

            var mainSass = grunt.file.read('resources/sass/main.scss');

            mainSass = insertBeforeLastOccurrence(mainSass, '\n// Layout', '@import "base/_' + data.slug + '";\r\n');

            grunt.file.write('resources/sass/main.scss', mainSass);
            return grunt.template.process(content, {data: data});
          }
        }
      },
      sassLayout: {
        expand: true,
        src: 'generate/layout.scss',
        rename: function() {
          var slug = slugify(grunt.task.current.args[0]);
          return 'resources/sass/layout/_' + slug + '.scss';
        },
        flatten: true,
        filter: 'isFile',
        nonull: true,
        options: {
          process: function(content, srcpath) {
            var data = {
              name: grunt.task.current.args[0],
              slug: slugify(grunt.task.current.args[0])
            };

            var mainSass = grunt.file.read('resources/sass/main.scss');

            mainSass = insertBeforeLastOccurrence(mainSass, '\n// Partials', '@import "layout/_' + data.slug + '";\r\n');

            grunt.file.write('resources/sass/main.scss', mainSass);
            return grunt.template.process(content, {data: data});
          }
        }
      },
      sassPartial: {
        expand: true,
        src: 'generate/partial.scss',
        rename: function() {
          var slug = slugify(grunt.task.current.args[0]);
          return 'resources/sass/partials/_' + slug + '.scss';
        },
        flatten: true,
        filter: 'isFile',
        nonull: true,
        options: {
          process: function(content, srcpath) {
            var data = {
              name: grunt.task.current.args[0],
              slug: slugify(grunt.task.current.args[0])
            };

            var mainSass = grunt.file.read('resources/sass/main.scss');

            mainSass = insertBeforeLastOccurrence(mainSass, '\n// Pages', '@import "partials/_' + data.slug + '";\r\n');

            grunt.file.write('resources/sass/main.scss', mainSass);
            return grunt.template.process(content, {data: data});
          }
        }
      },
      sassPage: {
        expand: true,
        src: 'generate/page.scss',
        rename: function() {
          var slug = slugify(grunt.task.current.args[0]);
          return 'resources/sass/pages/_' + slug + '.scss';
        },
        flatten: true,
        filter: 'isFile',
        nonull: true,
        options: {
          process: function(content, srcpath) {
            var data = {
              name: grunt.task.current.args[0],
              slug: slugify(grunt.task.current.args[0])
            };

            var mainSass = grunt.file.read('resources/sass/main.scss');

            mainSass = insertBeforeLastOccurrence(mainSass, 'eof', '\r\n@import "pages/_' + data.slug + '";');

            grunt.file.write('resources/sass/main.scss', mainSass);
            return grunt.template.process(content, {data: data});
          }
        }
      }
    }
  });

  // Register tasks
  grunt.registerTask('default', [
    'dev'
  ]);

  grunt.loadNpmTasks('grunt-contrib-copy');

  grunt.task.renameTask('copy', 'generate');

  grunt.registerTask('dev', [
    'browserSync',
    'watch'
  ]);

  grunt.registerTask('build', [
    'jshint',
    'uglify',
    'sass_import',
    'modernizr',
    'sass',
    'postcss',
    'version'
  ]);

};
