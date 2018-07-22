/**
* single-post-hero JS
* -----------------------------------------------------------------------------
*
* All the JS for the single-post-hero component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-single-post-hero',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'single-post-hero', COMPONENT );
} )( app );
