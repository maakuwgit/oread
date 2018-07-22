/**
* hero-w-slider JS
* -----------------------------------------------------------------------------
*
* All the JS for the hero-w-slider component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-hero-w-slider',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;
      var gallery = $("."+_this.className),
          nextArrow = '',
          prevArrow = '';

        prevArrow = '<button type="button" class="hero__slick-prev">';
        prevArrow += '<svg class="icon icon-arrow-right">';
        prevArrow += '<use xlink:href="#icon-arrow-right"></use>';
        prevArrow += '</svg></button>';

        nextArrow += '<button type="button" class="hero__slick-next">';
        nextArrow += '<svg class="icon icon-arrow-right">';
        nextArrow += '<use xlink:href="#icon-arrow-right"></use>';
        nextArrow += '</svg></button>';

        gallery.each(function(){

          $(this).find('.hero__slides').slick({
            infinite: true,
            fade: true,
            prevArrow: prevArrow,
            nextArrow: nextArrow,
            appendArrows: gallery
          });

        });


    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'hero-w-slider', COMPONENT );
} )( app );
