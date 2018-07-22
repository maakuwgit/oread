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
    className: 'loop-video',
    selector : function() {
      return '.' + this.className;
    },
    isWideScreen: function( video ) {

      if ( ( $(video).parent().outerWidth() / $(video)[0].videoWidth ) > ( $(video).parent().outerHeight() / $(video)[0].videoHeight ) ) {
        return true;
      } else {
        return false;
      }
    },
    fitVideo: function( video ) {
      if ( this.isWideScreen( video ) ) {
        $( video ).css({
          height: 'auto',
          width: $(video).parent().outerWidth(),
          top: '50%',
          left: 0,
          transform: 'translateY(-50%)'
        });
      } else {
        $( video ).css({
          height: $( video ).parent().outerHeight(),
          width: 'auto',
          top: 0,
          left: '50%',
          transform: 'translateX(-50%)'
        });
      }
    },
    init: function() {
      var _this = this;
      var videos = $( this.selector() );

      $( videos ).each( function( index, el ) {
        $(el).on('loadedmetadata', function(){
          _this.fitVideo( el );
        })
      });

      $( window ).resize( function() {

        $( videos ).each( function( index, el ) {
          _this.fitVideo( el );
        });

      });
    },

    finalize: function() {
    }
  };

  app.registerComponent( 'loop-video', COMPONENT );
} )( app );
