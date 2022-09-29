<?php
/*
Plugin Name: CNAlpsGeolocate2
Author: Marina Rubis

*/

function cnalps_register_geolocate_shortcode2($atts = [])
{
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    $latitude = $atts['latitude'];
    $longitude = $atts['longitude'];
    $zoom = $atts['zoom'];

    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js"></script>
    <div id="cnalps-map" style="width: 100%; height: 300px;"></div>
    <script>
        let map = L.map("cnalps-map").setView([<?php echo $latitude; ?>, <?php echo $longitude; ?>], <?php echo $zoom; ?>);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution: '&copy; OpenStreetMap contributors'}).addTo(map);
        L.marker([<?php echo $latitude; ?>, <?php echo $longitude; ?>]).addTo(map).bindPopup("toto");
    </script>

    <?php
}

add_shortcode('CNAlpsGeolocate2', 'cnalps_register_geolocate_shortcode2');

?>

