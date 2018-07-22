/**
* location_hero JS
* -----------------------------------------------------------------------------
*
* All the JS for the location_hero component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-location-hero',


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
  app.registerComponent( 'location-hero', COMPONENT );
} )( app );
