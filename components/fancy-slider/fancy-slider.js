/**
* fancy-slider JS
* -----------------------------------------------------------------------------
*
* All the JS for the fancy-slider component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-fancy-slider',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;
      var gallery = $("."+_this.className),
          nextArrow = '';

        nextArrow += '<button type="button" class="fancy-slider__slick-next">';
        nextArrow += '<svg class="icon icon-arrow-right">';
        nextArrow += '<use xlink:href="#icon-arrow-right"></use>';
        nextArrow += '</svg></button>';

        gallery.each(function(){

          $(this).find('.fancy-slider__slides').slick({
            infinite: true,
            fade: true,
            prevArrow: false,
            nextArrow: nextArrow,
            dots: true,
            appendArrows: gallery
          });

        });
    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'fancy-slider', COMPONENT );
} )( app );
