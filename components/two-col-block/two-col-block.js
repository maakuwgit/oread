/**
* two-col-block JS
* -----------------------------------------------------------------------------
*
* All the JS for the two-col-block component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-two-col-block',


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
  app.registerComponent( 'two-col-block', COMPONENT );
} )( app );
