/**
* cards JS
* -----------------------------------------------------------------------------
*
* All the JS for the cards component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-cards',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;

      $('.ll-cards__card').unbind().on('click', function(){
        var btn = $(this).find('a').one();
        document.location.href = btn.attr('href');
      });

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'cards', COMPONENT );
} )( app );
