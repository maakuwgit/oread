/**
* lr_w_hover JS
* -----------------------------------------------------------------------------
*
* All the JS for the lr_w_hover component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-lr-w-hover',


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
  app.registerComponent( 'lr-w-hover', COMPONENT );
} )( app );
