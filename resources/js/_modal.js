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

( function( app ) {

  var COMPONENT = {

    loadPopup : function( popupId ) {
      var popup = $.magnificPopup.open({
        items           : {
          src: popupId
        },
        type            : 'inline',
        fixedContentPos : true,
        fixedBgPos      : true,
        overflowY       : 'auto',
        closeBtnInside  : true,
        preloader       : false,
        midClick        : true,
        removalDelay    : 300,
      }, 0);
    },

    init: function() {

      var _this = this;

      $('.js-init-video').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        callbacks: {
          open: function() {
            $('video').trigger('pause');
          },
          close: function() {
            $('video').trigger('play');
          }
        }
      });


      $(document).on('click', '.js-init-popup', function(e) {
        e.preventDefault();
        var popupId = $(this).data('modal');

        if( popupId !== '' ) {
          _this.loadPopup( popupId );
        }
      });

    },

    finalize: function() {
    }
  };

  app.registerComponent( 'modal', COMPONENT );
} )( app );
