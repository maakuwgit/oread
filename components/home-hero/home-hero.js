/**
* home_hero JS
* -----------------------------------------------------------------------------
*
* All the JS for the home_hero component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-home-hero',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var hero = $(this.selector);
      var string = false;
      var typeit = $(hero).find('.type-it');
      var btn = hero.find('.js-play-video');

      if ( typeit.length > 0 ) {
        string = typeit.parent().attr('data-type-it');
        if( string ) {
          string = string.split(', ');
        }
      }

      if( string.length > 0 ) {
        typeit.typeIt({
          strings: string,
          breakLines: false,
          autostart: false
        });
      }

      $(btn).on('click', playVideo);

      function playVideo(e) {
        e.preventDefault();
        $(btn).hide();
        hero.find('.loop-video')[0].play();
      }

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'home-hero', COMPONENT );
} )( app );
