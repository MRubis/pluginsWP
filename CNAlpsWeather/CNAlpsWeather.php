<?php
/*
Plugin Name: CNAlpsWeather
Author: Marina Rubis

*/

// The widget class 
class CNAlpsWeather extends WP_Widget
{

    // Main constructor
    public function __construct()
    {
        parent::__construct(
            'CNAlpsWeather',
            __('CNAlpsWeather', 'text_domain'),
            array(
                'customize_selective_refresh' => true,
            )
        );
    }

    // The widget form (for the backend )
    public function form($instance)
    {

        // Set widget defaults
        $defaults = array(
            'city' => '',
            'country' => '',

        );

        // Parse current settings with defaults
        extract(wp_parse_args(( array )$instance, $defaults)); ?>


        <?php // City
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('city')); ?>"><?php _e('Ville:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('city')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('city')); ?>" type="text"
                   value="<?php echo esc_attr($city); ?>"/>
        </p>
        <?php // Country
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('country')); ?>"><?php _e('Pays:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('country')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('country')); ?>" type="text"
                   value="<?php echo esc_attr($country); ?>"/>
        </p>


    <?php }

    // Update widget settings
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['city'] = isset($new_instance['city']) ? wp_strip_all_tags($new_instance['city']) : '';
        $instance['country'] = isset($new_instance['country']) ? wp_strip_all_tags($new_instance['country']) : '';

        return $instance;
    }

    // Display the widget
    public function widget($args, $instance)
    {


        extract($args);

        // Check the widget options

        $city = isset($instance['city']) ? $instance['city'] : '';
        $country = isset($instance['country']) ? $instance['country'] : '';
        $url = 'https://www.weatherwp.com/api/common/publicWeatherForLocation.php?city='.$city.'&country='.$country.'&language=french';

        $json = file_get_contents($url);
        $data = json_decode($json);

        // WordPress core before_widget hook (always include )
        echo $before_widget;

        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box">';


        // Display text field
        if ($city && $country) {
            echo '<p>Météo de '.$city.' :</p>';
            echo '<p> ' . $data->temp . '°c</p>';
            echo'<p>'. $data->description.' </p>';
            echo'<img src="'. $data->icon.'">';


        }




        echo '</div>';

        // WordPress core after_widget hook (always include )
        echo $after_widget;

    }

}

// Register the widget
function my_register_custom_widget()
{
    register_widget('CNAlpsWeather');
}

add_action('widgets_init', 'my_register_custom_widget');
