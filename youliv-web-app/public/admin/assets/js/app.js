

$( document ).ready(function() {
    var sid = $("#state").val(); 
    if(sid){
        $.ajax({
            type:"get",
            url: "city/"+sid,
            success: function(res){
                $("#city").empty();
                $("#city").append('<option value="">Select City</option>');
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+value.id+'">'+value.city_name+'</option>');
                });
            }
        })
    }
    $("#state").change(function(){
        var sid = $(this).val();
        if(sid){
            $.ajax({
                type:"get",
                url: "city/"+sid,
                success: function(res){
                    $("#city").empty();
                    $("#city").append('<option value="">Select City</option>');
                    $.each(res,function(key,value){
                        $("#city").append('<option value="'+value.id+'">'+value.city_name+'</option>');
                    });
                }
            })
        }
   })
    if ($('.property-list-data').length > 0) {
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "property_list_data",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'property_id', name: 'property_id'},
                    {data: 'property_name', name: 'property_name'},
                    //{data: 'owner_name', name: 'owner_name'},
                    {data: 'complete_address', name: 'complete_address'},
                    {data: 'property_type_view', name: 'property_type_view'},
                    //{data: 'total_bedrooms', name: 'total_bedrooms'},
                    //{data: 'owner_name', name: 'owner_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    }

   
    // if($('.map-div').length > 0) {
    //     var map;
    //     function initialize() {
    //         document.getElementById("lat").value = '30.72160083654737';
    //         document.getElementById("lng").value = "76.73057975754385";
    //         var myLatlng = new google.maps.LatLng(30.72160083654737, 76.73057975754385);
    //         var myOptions = {
    //             zoom: 8,
    //             center: myLatlng,
    //             mapTypeId: google.maps.MapTypeId.ROADMAP
    //         };
    //         map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    //         var marker = new google.maps.Marker({
    //             draggable: true,
    //             position: myLatlng,
    //             map: map,
    //             title: "Your location"
    //         });
    //         google.maps.event.addListener(marker, 'dragend', function (event) {
    //             document.getElementById("lat").value = event.latLng.lat();
    //             document.getElementById("lng").value = event.latLng.lng();
    //         });
    //     }
    //     google.maps.event.addDomListener(window, "load", initialize());
    // }
    // if($('.map-div-view-property').length > 0) {
    //     var map;
    //     function initialize() {
    //         var lat = document.getElementById("lat").value; 
    //         var lng = document.getElementById("lng").value; 
            
    //         console.log("latlng");
    //         console.log(lat);
    //         console.log(lng);

    //         var myLatlng = new google.maps.LatLng(lat, lng);
    //         var myOptions = {
    //             zoom: 8,
    //             center: myLatlng,
    //             mapTypeId: google.maps.MapTypeId.ROADMAP
    //         };
    //         map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    //         var marker = new google.maps.Marker({
    //             draggable: true,
    //             position: myLatlng,
    //             map: map,
    //             title: "Your location"
    //         });
    //         google.maps.event.addListener(marker, 'dragend', function (event) {
    //             //document.getElementById("lat").value = event.latLng.lat();
    //             //document.getElementById("lng").value = event.latLng.lng();
    //         });
    //     }
    //     google.maps.event.addDomListener(window, "load", initialize());
    // }
    
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 30.72160083654737, lng: 76.73057975754385},
          zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          draggable: true,
          anchorPoint: new google.maps.Point(0, -29)
        });
        
        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

        //   infowindowContent.children['place-icon'].src = place.icon;
        //   infowindowContent.children['place-name'].textContent = place.name;
        //   infowindowContent.children['place-address'].textContent = address;
         infowindow.setContent(address);
          var lat = place.geometry.location.lat();
          var lng = place.geometry.location.lng();
          document.getElementById("lat").value = lat;
          document.getElementById("lng").value = lng;
          infowindow.open(map, marker);
        });

        google.maps.event.addListener(marker, 'dragend', function (event) {
            //infowindow.close();
            var marker_lat = marker.getPosition().lat();
            var marker_lng = marker.getPosition().lng();
            var geocoder = new google.maps.Geocoder;

            var latlng = {lat: parseFloat(marker_lat), lng: parseFloat(marker_lng)};
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    
                if (results[0]) {
                    address = [
                        (results[0].address_components[0] && results[0].address_components[0].short_name || ''),
                        (results[0].address_components[1] && results[0].address_components[1].short_name || ''),
                        (results[0].address_components[2] && results[0].address_components[2].short_name || ''),
                      ].join(' ');
                      //infowindowContent.children['place-icon'].style.display = "none";
                      //infowindowContent.children['place-name'].style.display = "none";
                      //infowindowContent.children['place-address'].textContent = address;
                      infowindow.setContent(address);
                      infowindow.open(map, marker);
                      document.getElementById("lat").value = marker_lat;
                      document.getElementById("lng").value = marker_lng;
                      document.getElementById("pac-input").value = address;
                } else {
                    window.alert('No results found');
                }
                } else {
                window.alert('Geocoder failed due to: ' + status);
                }
            });

        });
        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
      }
      if($('.map-div').length > 0) {
        initMap();
      };
      
    if($('#add_property_page').length > 0) {
        var business_model = $("input[name='business_model']:checked").val();
        var water_connection = $("input[name='water_connection']:checked").val();
        var parking_area = $("input[name='parking_area']:checked").val();
        var common_area = $("input[name='common_area']:checked").val();
        var dining_area = $("input[name='dining_area']:checked").val();
        var washing_area = $("input[name='washing_area']:checked").val();
        if(business_model == 1){
            $("#revenue_sharing_section").css("display","block");
        }else if(business_model == 2){
            $("#leased_section").css("display","block");
        }
        if(water_connection == 1){
            $("#water_tank_capacity").attr("disabled",false);
            $("#water_tank_quantity").attr("disabled",false);
        }else if(water_connection == 2){
            $("#water_tank_capacity").attr("disabled",true);
                $("#water_tank_quantity").attr("disabled",true);
        }
        if(parking_area == 1){
            $("#parking_area_value").attr("disabled",false);
        }else if(parking_area == 2){
            $("#parking_area_value").attr("disabled",true);
        }
        if(common_area == 1){
            $("#common_area_value").attr("disabled",false);
        }else if(common_area == 2){
            $("#common_area_value").attr("disabled",true);
        }
        if(dining_area == 1){
            $("#dining_area_value").attr("disabled",false);
        }else if(dining_area == 2){
            $("#dining_area_value").attr("disabled",true);
        }
        if(washing_area == 1){
            $("#washing_area_value").attr("disabled",false);
        }else if(washing_area == 2){
            $("#washing_area_value").attr("disabled",true);
        }

        $('input[type=radio][name=business_model]').change(function() {
            if (this.value == 1) {
                $("#revenue_sharing_section").css("display","block");
                $("#leased_section").css("display","none");
            }
            else if (this.value == 2) {
                $("#revenue_sharing_section").css("display","none");
                $("#leased_section").css("display","block");
            }
        });
        $('input[type=radio][name=water_connection]').change(function() {
            if (this.value == 1) {
                $("#water_tank_capacity").attr("disabled",false);
                $("#water_tank_quantity").attr("disabled",false);
            }
            else if (this.value == 2) {
                $("#water_tank_capacity").attr("disabled",true);
                $("#water_tank_quantity").attr("disabled",true);
            }
        });
        $('input[type=radio][name=parking_area]').change(function() {
            if (this.value == 1) {
                $("#parking_area_value").attr("disabled",false);
            }
            else if (this.value == 2) {
                $("#parking_area_value").attr("disabled",true);
            }
        });
        $('input[type=radio][name=common_area]').change(function() {
            if (this.value == 1) {
                $("#common_area_value").attr("disabled",false);
            }
            else if (this.value == 2) {
                $("#common_area_value").attr("disabled",true);
            }
        });
        $('input[type=radio][name=dining_area]').change(function() {
            if (this.value == 1) {
                $("#dining_area_value").attr("disabled",false);
            }
            else if (this.value == 2) {
                $("#dining_area_value").attr("disabled",true);
            }
        });
        $('input[type=radio][name=washing_area]').change(function() {
            if (this.value == 1) {
                $("#washing_area_value").attr("disabled",false);
            }
            else if (this.value == 2) {
                $("#washing_area_value").attr("disabled",true);
            }
        });
    }
    
});
