/*
Plugin Name: CNAlpsGeolocateMultiple
Author: Marina Rubis
*/
<?php

function cnalps_register_geolocate_multiple_shortcode($atts = [])
{
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    $url = $atts['url'];

    ?>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js"></script>
    <div id="cnalps-map" style="width: 100%; height: 600px;"></div>

    <?php

    //$url ='https://mocki.io/v1/a49d4fbb-754b-4851-be63-03f1eb3c32bb';
    $json = file_get_contents($url);
    $data = json_decode($json);
    foreach ($data as $k => $v){
        $LatLngBounds = new stdClass();
        $Lat =  $LatLngBounds->latitude += $v->lat;
        $Lon = $LatLngBounds->longitude += $v->lon;
        $i +=1;
    }
    $La = $Lat / $i;
    $Lo = $Lon /$i;

    echo" <script>  let map = L.map('cnalps-map').setView([".$La.",".$Lo."], 3); var test = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap contributors'}).addTo(map); map.addLayer(test);</script>";


    foreach ($data as $key => $value) {
        $latitude = $value->lat;
        $longitude = $value->lon;
        $title = $value->capitale;


        echo
            "<script>
                L.marker([" . $latitude . "," . $longitude . "]).addTo(map).bindPopup('".$title."').openPopup();</script>";

    }





}


add_shortcode('CNAlpsGeolocateMultiple', 'cnalps_register_geolocate_multiple_shortcode');
