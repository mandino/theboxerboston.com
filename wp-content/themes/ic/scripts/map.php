<script type="text/javascript">

$(function() {

        
            // Get map position
            var $map = $('.map');
            var latitude = parseFloat($map.data('latitude').replace(',', '.'));
            var longtitude = parseFloat($map.data('longtitude').replace(',', '.'));
            var center = new google.maps.LatLng(latitude - 0.003105999999997721, longtitude);
            
            // Render map
            var map = new google.maps.Map($map[0], {
                zoom: 16,
                scrollWheel: false,
                center: center,
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                panControlOptions: {
                    position: google.maps.ControlPosition.LEFT_TOP
                },
                zoomControlOptions: {
                    position: google.maps.ControlPosition.LEFT_TOP
                },
                scaleControlOptions: {
                    position: google.maps.ControlPosition.LEFT_TOP
                }
            });
            
            // Center map on window resize
            google.maps.event.addDomListener(window, 'resize', function() {
                map.setCenter(center);
            });

            // Custom marker
            new google.maps.Marker({
                draggable: false,
                map: map,
                shape: {
                    coord: [63, 0, 68, 1, 72, 2, 75, 3, 77, 4, 80, 5, 81, 6, 83, 7, 85, 8, 86, 9, 88, 10, 89, 11, 90, 12, 91, 13, 93, 14, 94, 15, 95, 16, 95, 17, 96, 18, 97, 19, 98, 20, 99, 21, 99, 22, 100, 23, 101, 24, 101, 25, 102, 26, 103, 27, 103, 28, 104, 29, 104, 30, 104, 31, 105, 32, 105, 33, 106, 34, 106, 35, 106, 36, 107, 37, 107, 38, 107, 39, 107, 40, 108, 41, 108, 42, 108, 43, 108, 44, 108, 45, 109, 46, 109, 47, 109, 48, 109, 49, 109, 50, 109, 51, 109, 52, 109, 53, 109, 54, 109, 55, 109, 56, 109, 57, 109, 58, 109, 59, 109, 60, 109, 61, 109, 62, 109, 63, 108, 64, 108, 65, 108, 66, 108, 67, 108, 68, 107, 69, 107, 70, 107, 71, 107, 72, 106, 73, 106, 74, 106, 75, 105, 76, 105, 77, 104, 78, 104, 79, 104, 80, 103, 81, 103, 82, 102, 83, 101, 84, 101, 85, 100, 86, 99, 87, 99, 88, 98, 89, 97, 90, 96, 91, 95, 92, 95, 93, 94, 94, 93, 95, 91, 96, 90, 97, 89, 98, 88, 99, 86, 100, 85, 101, 83, 102, 82, 103, 80, 104, 77, 105, 75, 106, 72, 107, 68, 108, 63, 109, 46, 109, 41, 108, 37, 107, 34, 106, 32, 105, 29, 104, 27, 103, 26, 102, 24, 101, 23, 100, 21, 99, 20, 98, 19, 97, 18, 96, 16, 95, 15, 94, 14, 93, 14, 92, 13, 91, 12, 90, 11, 89, 10, 88, 10, 87, 9, 86, 8, 85, 8, 84, 7, 83, 6, 82, 6, 81, 5, 80, 5, 79, 5, 78, 4, 77, 4, 76, 3, 75, 3, 74, 3, 73, 2, 72, 2, 71, 2, 70, 2, 69, 1, 68, 1, 67, 1, 66, 1, 65, 1, 64, 0, 63, 0, 62, 0, 61, 0, 60, 0, 59, 0, 58, 0, 57, 0, 56, 0, 55, 0, 54, 0, 53, 0, 52, 0, 51, 0, 50, 0, 49, 0, 48, 0, 47, 0, 46, 1, 45, 1, 44, 1, 43, 1, 42, 1, 41, 2, 40, 2, 39, 2, 38, 2, 37, 3, 36, 3, 35, 3, 34, 4, 33, 4, 32, 5, 31, 5, 30, 5, 29, 6, 28, 6, 27, 7, 26, 8, 25, 8, 24, 9, 23, 10, 22, 10, 21, 11, 20, 12, 19, 13, 18, 14, 17, 14, 16, 15, 15, 16, 14, 18, 13, 19, 12, 20, 11, 21, 10, 23, 9, 24, 8, 26, 7, 28, 6, 29, 5, 32, 4, 34, 3, 37, 2, 41, 1, 46, 0, 63, 0],
                    type: 'poly'
                },
                icon: new google.maps.MarkerImage(
                    '<?php bloginfo('template_url'); ?>/images/marker.png',
                    new google.maps.Size(110, 110),
                    new google.maps.Point(0, 0),
                    new google.maps.Point(55, 110)
                ),
                position: new google.maps.LatLng(latitude, longtitude)
            });
            
            
            
            
            
            // Get map position
            var $map = $('.rightmin .map');
            var latitude = parseFloat($map.data('latitude'));
            var longtitude = parseFloat($map.data('longtitude'));
            var center = new google.maps.LatLng(latitude - 0.003105999999997721, longtitude);
            
            // Render map
            var map = new google.maps.Map($map[0], {
                zoom: 8,
                scrollWheel: false,
                center: center,
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                panControlOptions: {
                    position: google.maps.ControlPosition.LEFT_CENTER
                },
                zoomControlOptions: {
                    position: google.maps.ControlPosition.LEFT_CENTER
                },
                scaleControlOptions: {
                    position: google.maps.ControlPosition.LEFT_CENTER
                }
            });
            
            // Center map on window resize
            google.maps.event.addDomListener(window, 'resize', function() {
                map.setCenter(center);
            });

            // Custom marker
            new google.maps.Marker({
                draggable: false,
                map: map,
                shape: {
                    coord: [63, 0, 68, 1, 72, 2, 75, 3, 77, 4, 80, 5, 81, 6, 83, 7, 85, 8, 86, 9, 88, 10, 89, 11, 90, 12, 91, 13, 93, 14, 94, 15, 95, 16, 95, 17, 96, 18, 97, 19, 98, 20, 99, 21, 99, 22, 100, 23, 101, 24, 101, 25, 102, 26, 103, 27, 103, 28, 104, 29, 104, 30, 104, 31, 105, 32, 105, 33, 106, 34, 106, 35, 106, 36, 107, 37, 107, 38, 107, 39, 107, 40, 108, 41, 108, 42, 108, 43, 108, 44, 108, 45, 109, 46, 109, 47, 109, 48, 109, 49, 109, 50, 109, 51, 109, 52, 109, 53, 109, 54, 109, 55, 109, 56, 109, 57, 109, 58, 109, 59, 109, 60, 109, 61, 109, 62, 109, 63, 108, 64, 108, 65, 108, 66, 108, 67, 108, 68, 107, 69, 107, 70, 107, 71, 107, 72, 106, 73, 106, 74, 106, 75, 105, 76, 105, 77, 104, 78, 104, 79, 104, 80, 103, 81, 103, 82, 102, 83, 101, 84, 101, 85, 100, 86, 99, 87, 99, 88, 98, 89, 97, 90, 96, 91, 95, 92, 95, 93, 94, 94, 93, 95, 91, 96, 90, 97, 89, 98, 88, 99, 86, 100, 85, 101, 83, 102, 82, 103, 80, 104, 77, 105, 75, 106, 72, 107, 68, 108, 63, 109, 46, 109, 41, 108, 37, 107, 34, 106, 32, 105, 29, 104, 27, 103, 26, 102, 24, 101, 23, 100, 21, 99, 20, 98, 19, 97, 18, 96, 16, 95, 15, 94, 14, 93, 14, 92, 13, 91, 12, 90, 11, 89, 10, 88, 10, 87, 9, 86, 8, 85, 8, 84, 7, 83, 6, 82, 6, 81, 5, 80, 5, 79, 5, 78, 4, 77, 4, 76, 3, 75, 3, 74, 3, 73, 2, 72, 2, 71, 2, 70, 2, 69, 1, 68, 1, 67, 1, 66, 1, 65, 1, 64, 0, 63, 0, 62, 0, 61, 0, 60, 0, 59, 0, 58, 0, 57, 0, 56, 0, 55, 0, 54, 0, 53, 0, 52, 0, 51, 0, 50, 0, 49, 0, 48, 0, 47, 0, 46, 1, 45, 1, 44, 1, 43, 1, 42, 1, 41, 2, 40, 2, 39, 2, 38, 2, 37, 3, 36, 3, 35, 3, 34, 4, 33, 4, 32, 5, 31, 5, 30, 5, 29, 6, 28, 6, 27, 7, 26, 8, 25, 8, 24, 9, 23, 10, 22, 10, 21, 11, 20, 12, 19, 13, 18, 14, 17, 14, 16, 15, 15, 16, 14, 18, 13, 19, 12, 20, 11, 21, 10, 23, 9, 24, 8, 26, 7, 28, 6, 29, 5, 32, 4, 34, 3, 37, 2, 41, 1, 46, 0, 63, 0],
                    type: 'poly'
                },
                icon: new google.maps.MarkerImage(
                    'images/marker.png',
                    new google.maps.Size(110, 110),
                    new google.maps.Point(0, 0),
                    new google.maps.Point(55, 110)
                ),
                position: new google.maps.LatLng(latitude, longtitude)
            });
      
});

</script>