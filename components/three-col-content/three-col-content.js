/**
* three-col-content JS
* -----------------------------------------------------------------------------
*
* All the JS for the three-col-content component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-three-col-content',


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
  app.registerComponent( 'three-col-content', COMPONENT );
} )( app );
