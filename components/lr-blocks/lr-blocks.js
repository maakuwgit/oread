/**
* lr-blocks JS
* -----------------------------------------------------------------------------
*
* All the JS for the lr-blocks component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-lr-blocks',


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
  app.registerComponent( 'lr-blocks', COMPONENT );
} )( app );
