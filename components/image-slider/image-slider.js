/**
* image-slider JS
* -----------------------------------------------------------------------------
*
* All the JS for the image-slider component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-image-slider',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;
      var gallery = $("."+_this.className),
          nextArrow = '',
          prevArrow = '';

        nextArrow += '<button type="button" class="image-slider__slick-next">Next</button>';
        prevArrow += '<button type="button" class="image-slider__slick-prev">Previous</button>';

        gallery.each(function(){

          $(this).find('.image-slider__slides').slick({
            infinite: true,
            fade: true,
            prevArrow: prevArrow,
            nextArrow: nextArrow,
            dots: true,
            appendArrows: gallery.find('.image-slider__footer'),
            appendDots: gallery.find('.image-slider__footer')
          });

        });

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'image-slider', COMPONENT );
} )( app );
