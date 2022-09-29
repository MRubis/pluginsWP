<?php
/*
Plugin Name: CNAlpsGeolocate
Author: Marina Rubis

*/
?>



<?php

class CNAlpsGeolocate extends WP_Widget
{

    public function __construct()
    {
        add_shortcode('CNAlpsGeolocate', array($this, 'cnalps_register_geolocate_shortcode'));
    }

    public function cnalps_register_geolocate_shortcode($atts =[])
    {
        ?>
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js"></script>

        <?php
        // normalize attribute keys, lowercase
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
        $latitude = $atts['latitude'];
        $longitude = $atts['longitude'];
        $zoom = $atts['zoom'];


        $o = '<div id="cnalps-map" style="width: 100%; height: 300px;"></div>';
        $o .= '<script>let map = L.map("cnalps-map").setView(['.$latitude.', '.$longitude.'], '.$zoom.');';
        $o .= "L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors'}).addTo(map);";
      /*  $o .=  'L.marker([10.01, 10]).addTo(map)
            .bindPopup(\'coucou\')
            .openPopup();'; */
        $o .=  'L.marker(['.$latitude.', '.$longitude.']).addTo(map)
           
            .openPopup(); </script>';

        return $o;






    }
}

$CNAlpsGeolocate = new CNAlpsGeolocate();

?>

