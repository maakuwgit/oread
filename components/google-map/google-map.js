/**
* Google Map JS
* -----------------------------------------------------------------------------
*
* All the JS for the Google Map component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-google-map',
    mapPinIcon: 'M12 11.484q1.031 0 1.758-0.727t0.727-1.758-0.727-1.758-1.758-0.727-1.758 0.727-0.727 1.758 0.727 1.758 1.758 0.727zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z',
    pinColor: '#e93530',

    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;
      $('.ll-google-map .google-map__wrapper').each( function(index, el) {
        var map;
        var locations = $(el).data('locations');
        var bounds = new google.maps.LatLngBounds();
        var mapId = $(el).attr('id');

        function initialize_map() {
          var center_coordinates = new google.maps.LatLng('38.966829','-95.2360857');
          var mapOptions = {
            zoom: 15,
            scrollwheel: false,
            draggable: true,
            maxZoom: 15,
            center: center_coordinates,
            styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
          };

          map = new google.maps.Map(document.getElementById( mapId ), mapOptions);

          $.each( locations, function() {
            var newMarker = this;
            var latLng = {lat: parseFloat( newMarker['lat'] ), lng: parseFloat( newMarker['lng'] )};
            //console.log( newMarker );

            var icon = {
              path: _this.mapPinIcon,
              fillColor: _this.pinColor,
              fillOpacity: 1,
              anchor: new google.maps.Point( 12, 16 ),
              strokeWeight: 0,
              scale: 2
            };

            var marker = new google.maps.Marker({
              position: latLng,
              map: map,
              icon: icon
            });

            bounds.extend(marker.position);

            setTimeout( function() {
              //infowindow.open(map, marker);
            }, 500);

            marker.addListener('click', function() {
              target = $('*[data-map-lat="'+marker.internalPosition.lat()+
                       '"][data-map-lng="'+marker.internalPosition.lng()+'"]');

              if( target ) {
                target.show().parent().show();
                target.siblings().removeAttr('style');
              }
            });

          });

          map.fitBounds(bounds);

        }

        if ( typeof $(el) !== 'undefined' && $( el ).length > 0 ) {
          google.maps.event.addDomListener(window, 'load', initialize_map);
        }

        initialize_map();

      });

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'google-map', COMPONENT );
} )( app );
