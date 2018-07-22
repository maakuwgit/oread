/**
* interactive-image JS
* -----------------------------------------------------------------------------
*
* All the JS for the interactive-image component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-interactive-image',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var component = $('.'+this.className);
      var track     = component.find('.interactive-image__track');
      var handle    = component.find('.interactive-image__handle');
      var before    = $(handle).parent().find('.interactive-image__images__before');
      var newW      = component.find(".interactive-image__images__before img").width();
      var newH      = component.find(".interactive-image__images__before img").height();

      $(track).css({'left': newW/2, 'height': newH});

      $(handle).css({
          'left': newW/2,
          'height': newH*.2,
          'top': newH/2,
          'margin-top': newH*-.1
      });

      function scrubAdjust(e){
        newH = component.find(".interactive-image__images__before img").height();

        $(handle).css({'height': newH*.2, 'top': newH/2, 'margin-top': newH*-.1});
        $(before).css({'clip':'rect(0,'+newW+'px,'+newH+'px,0)'});
        $(track).css({'height': newH});
      }

      $(window).on('resize.scrubAdjust', scrubAdjust);

      $(handle, track).mousedown(function() {

          function scrubMove(event) {
            if (event.pageX >= newW){
              $(handle, track).css("left", newW);
              $(before).css({'clip':'rect(0,'+newW+'px,'+newH+'px,0)'});
              $(track).css({'left':newW});
            } else if (event.pageX <= 0) {
              $(handle, track).css("left", 0);
              $(before).css({'clip':'rect(0,0,'+newH+'px,0)'});
              $(track).css({'left':1.5});
            } else {
              $(handle, track).css("left", event.pageX);
              $(before).css({'clip':'rect(0,'+event.pageX+'px,'+newH+'px,0)'});
              $(track).css({'left':event.pageX});
            }
          }

          $(window).mouseup(function() {
              $(window).off('mousemove.scrubMove');
          });

          $(window).on('mousemove.scrubMove', scrubMove);

      });

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'interactive-image', COMPONENT );
} )( app );
