

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Reverse Geocoding</title>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAABejZuAsySdz5ubatZYvla_uHY1aJ7YY&ver=3.exp"></script>
<script type="text/javascript">
    jQuery( document ).ready( function($) {
 
    $( "#get-mylocation" ).click( function(e) {
        e.preventDefault();
 
        /* Chrome need SSL! */
        var is_chrome = /chrom(e|ium)/.test( navigator.userAgent.toLowerCase() );
        var is_ssl    = 'https:' == document.location.protocol;
        if( is_chrome && ! is_ssl ){
            return false;
        }
 
        /* HTML5 Geolocation */
        navigator.geolocation.getCurrentPosition(
            function( position ){ // success cb
 
                /* Current Coordinate */
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                var google_map_pos = new google.maps.LatLng( lat, lng );
 
                /* Use Geocoder to get address */
                var google_maps_geocoder = new google.maps.Geocoder();
                google_maps_geocoder.geocode(
                    { 'latLng': google_map_pos },
                    function( results, status ) {
                        if ( status == google.maps.GeocoderStatus.OK && results[0] ) {
                            console.log( results[0].formatted_address );
                        }
                    }
                );
            },
            function(){ // fail cb
            }
        );
    });
 
 
});
</script>
</head>
<body >
<a id="get-mylocation" href="#">aaa</a>
<form method="post" action="" name="local_cityname">
<div id="local_state"></div>
<div id="local_city"></div>
</form>
</body>
</html>
