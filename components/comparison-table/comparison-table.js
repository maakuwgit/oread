/**
* comparison-table JS
* -----------------------------------------------------------------------------
*
* All the JS for the comparison-table component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-comparison-table',


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
  app.registerComponent( 'comparison-table', COMPONENT );
} )( app );
