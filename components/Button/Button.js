/**
* Button JS
* -----------------------------------------------------------------------------
*
* All the JS for the Button component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-Button',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;

      $( _this.selector() ).click(function(e) {

        $( this ).toggleClass( _this.className + '--rotate' );
      } );
    },


    finalize: function() {

    }
  };

  // Hooks the component into the app
  app.registerComponent( 'Button', COMPONENT );
} )( app );
