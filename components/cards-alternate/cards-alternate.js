/**
* cards-alternate JS
* -----------------------------------------------------------------------------
*
* All the JS for the cards-alternate component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-cards-alternate',


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
  app.registerComponent( 'cards-alternate', COMPONENT );
} )( app );
