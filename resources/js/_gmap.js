/**
* google map JS
* -----------------------------------------------------------------------------
*
* All the JS for the google map component.
*/
( function( app ) {

  var COMPONENT = {
    defaultCoordinates: {
      lat: '38.966829',
      lng: '-95.2360857'
    },
    className: 'gmap',
    address: site_info.address.street + ' ' + site_info.address.city + ' ' + site_info.address.state + ' ' + site_info.address.zip,
    mapPinIcon: 'M12 11.484q1.031 0 1.758-0.727t0.727-1.758-0.727-1.758-1.758-0.727-1.758 0.727-0.727 1.758 0.727 1.758 1.758 0.727zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z',
    pinColor: '#D7DF23',
    locationName: site_info.name,

    selector : function() {
      return '.' + this.className;
    },

    mapElementTarget : function() {
      return '#gmap';
    },

    mapElementId : function () {
      return 'gmap';
    },

    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;
      // map
      var map;
      var markers = [];
      var bounds = new google.maps.LatLngBounds();
      var address = _this.address;

      function initialize_map() {
        var center_coordinates = new google.maps.LatLng('38.966829','-95.2360857');
        var mapOptions = {
          zoom: 15,
          scrollwheel: false,
          draggable: false,
          center: center_coordinates,
          styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
        };
        map = new google.maps.Map(document.getElementById( _this.mapElementId() ), mapOptions);
        update_map_markers();
      }

      if ( typeof $(_this.mapElementId) !== 'undefined' && $(_this.mapElementTarget()).length > 0 ) {
        google.maps.event.addDomListener(window, 'load', initialize_map);
      }

      var update_map_markers = function() {

        var geocoder = new google.maps.Geocoder();

        var icon = {
          path: _this.mapPinIcon,
          fillColor: _this.pinColor,
          fillOpacity: 1,
          anchor: new google.maps.Point( 12, 16 ),
          strokeWeight: 0,
          scale: 2
        };

        var infoContent = '<div class="infowindow"><span class="infowindow__title">'+_this.locationName+'</span>'+
                          '<address>'+site_info.address.street+'<br>'+site_info.address.city+', '+site_info.address.state+' '+site_info.address.zip+'</address>'+
                          '<a class="primary-hover" href="https://www.google.com/maps/place/'+_this.address+'" target="_blank">Get Directions</a></div>';

        var infowindow = new google.maps.InfoWindow({
          content: infoContent
        });

         geocoder.geocode({
          'address': address
         },

         function(results, status) {
            if(status === google.maps.GeocoderStatus.OK) {
              var marker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map,
                icon: icon
              });
              map.setCenter(results[0].geometry.location);

              setTimeout( function() {
                infowindow.open(map, marker);
              }, 500);

              marker.addListener('click', function() {
                infowindow.open(map, marker);
              });
            }
         });

      };

      initialize_map();

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'gmap', COMPONENT );
} )( app );
