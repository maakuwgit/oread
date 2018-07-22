/**
* call-to-action JS
* -----------------------------------------------------------------------------
*
* All the JS for the call-to-action component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-call-to-action',


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
  app.registerComponent( 'call-to-action', COMPONENT );
} )( app );
