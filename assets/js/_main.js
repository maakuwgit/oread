/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  var arrayUnique = function(a) {
    return a.reduce(function(p, c) {
      if (p.indexOf(c) < 0) { p.push(c); }
      return p;
    }, []);
  };

  var COMPONENTS = {

    common: {
      init: function() {
        // JavaScript to be fired on all pages

      // Smooth Scrolling
      // offset for fixed header
      $(function() {
        $('a[href*="#"]:not(.js-no-scroll):not([href="#"])').click(function() {
          if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
            var target = $(this.hash);
            var wpadminBarHeight = 0;
            if ( $('#wpadminbar').length > 0 ) {
              wpadminBarHeight = $('#wpadminbar').outerHeight();
            }
            var headerHeight = $('header.navbar').outerHeight();
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
              $('html, body').animate({
                scrollTop: target.offset().top - ( headerHeight + wpadminBarHeight )
              }, 1000);
              return false;
            }
          }
        });
      });

      //Basic Collapse toggle for dropdowns and toggle menus
      $('[data-toggle="collapse"]').on('click', function(e) {
        e.preventDefault();

        //if target element is not open already
        //find all open collapse elements and close them
        if ( !$(this).is('.collapsed') ) {

          if ( $('.collapsed[data-toggle="collapse"]').length > 0 ) {
            $('.collapsed[data-toggle="collapse"]').each(function(){
              $(this).trigger('click');
            });
          }
        }
        var target = $(this).data('target');
        $(this).toggleClass('collapsed');
        $(target).toggleClass('collapsed');
      });

      $(window).resize(function(e) {

        if ( $('header.navbar').width() > 992 ) {
          $('#primary-nav').attr('style', '');
          $('.navbar-toggle').removeClass('collapsed');
        }
      });

      $(document).click(function(e) {

        // !$.contains( document.querySelectorAll('[data-content="collapse"]')[0], $(e.target)[0] )
        //close all [data-toggle="collapse"] elements if
        //target doesn't have any data attributes defined or
        //if the target is does not have a data-toggle and
        //it does not have a data-content and
        //then make sure that the target is not a child of data-content="collapse"
        if (
            ( $(e.target).data('toggle') === undefined || $(e.target).data('toggle') === false ) &&
            ( $(e.target).data('content') === undefined || $(e.target).data('content') ===  false ) &&
            !$(e.target).parents( '[data-content="collapse"]' ).length &&
            !$(e.target).parents( '[data-toggle="collapse"]' ).length
          ) {

          $('.collapsed[data-toggle="collapse"]').each(function(e){
            $(this).trigger('click');
          });
        }
      });

      $('[data-nav="collapse"]').on('click', function(e) {
        e.preventDefault();
        //if target element is not open already
        //find all open collapse elements and close them
        if ( !$(this).is('.collapsed') ) {
          if ( $('.collapsed[data-nav="collapse"]').length > 0 ) {
            $('.collapsed[data-nav="collapse"]').each(function(){
              $(this).trigger('click');
            });
          }
        }

        var target = $(this).data('target');
        $(this).toggleClass('collapsed');
        $('body').toggleClass('locked');
        // $(target).toggleClass('collapsed');
        $(target).slideToggle();
      });


        // Magnific Popup
        // For embeded images within the post content
        $('a[rel="magnific"]').magnificPopup({
          type: 'image',
          removalDelay: 300,
          mainClass: 'mfp-fade'
        });
      },
      finalize: function() {

      }
    },

    /**
     * Scripts for the Test component
     * This is fired when an element has the data-component attribute with a
     * value of "test"
     *
     * @type {Object}
     */
    test: {
      init: function() {

      },
      finalize: function() {

      }
    },
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = COMPONENTS;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      var components = [];

      $('[data-component]').each(function(index, el) {
        components.push( $( this ).attr( 'data-component' ).replace( /-/g, '_' ) );
      });

      components = arrayUnique( components );

      // Fire page-specific init JS, and then finalize JS
      $.each(components, function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
