<?php
/*
Plugin Name: General Settings
Description: Used to add custom fields in the general settings.
*/

/* Add fields to settings (use get_option to retreive, i.e. $custom_field_facebook = get_option('custom_field_facebook'); */
    
    /* Twitter */
        add_filter('admin_init', 'custom_field_twitter');

        function custom_field_twitter()
        {
            register_setting('general', 'custom_field_twitter', 'esc_attr');
            add_settings_field('custom_field_twitter', '<label for="custom_field_twitter">'.__('Twitter Username' , 'custom_field_twitter' ).'</label>' , 'custom_field_twitter_html', 'general');
        }

        function custom_field_twitter_html()
        {
            $value = get_option( 'custom_field_twitter', '' );
            echo '<input type="text" id="custom_field_twitter" name="custom_field_twitter" value="' . $value . '" />';
        }
    
    /* Facebook */
        add_filter('admin_init', 'custom_field_facebook');

        function custom_field_facebook()
        {
            register_setting('general', 'custom_field_facebook', 'esc_attr');
            add_settings_field('custom_field_facebook', '<label for="custom_field_facebook">'.__('Facebook Username/ID' , 'custom_field_facebook' ).'</label>' , 'custom_field_facebook_html', 'general');
        }

        function custom_field_facebook_html()
        {
            $value = get_option( 'custom_field_facebook', '' );
            echo '<input type="text" id="custom_field_facebook" name="custom_field_facebook" value="' . $value . '" />';
        }
    
    /* Vimeo */
        add_filter('admin_init', 'custom_field_vimeo');

        function custom_field_vimeo()
        {
            register_setting('general', 'custom_field_vimeo', 'esc_attr');
            add_settings_field('custom_field_vimeo', '<label for="custom_field_vimeo">'.__('Vimeo Username/ID' , 'custom_field_vimeo' ).'</label>' , 'custom_field_vimeo_html', 'general');
        }

        function custom_field_vimeo_html()
        {
            $value = get_option( 'custom_field_vimeo', '' );
            echo '<input type="text" id="custom_field_vimeo" name="custom_field_vimeo" value="' . $value . '" />';
        }
    
    /* Google */
        add_filter('admin_init', 'custom_field_google');

        function custom_field_google()
        {
            register_setting('general', 'custom_field_google', 'esc_attr');
            add_settings_field('custom_field_google', '<label for="custom_field_google">'.__('Google+ Username/ID' , 'custom_field_google' ).'</label>' , 'custom_field_google_html', 'general');
        }

        function custom_field_google_html()
        {
            $value = get_option( 'custom_field_google', '' );
            echo '<input type="text" id="custom_field_google" name="custom_field_google" value="' . $value . '" />';
        }
        
?>