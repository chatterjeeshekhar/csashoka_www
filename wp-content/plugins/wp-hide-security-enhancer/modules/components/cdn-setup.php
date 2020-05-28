<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class WPH_module_cdn_setup extends WPH_module_component
        {
            function get_component_title()
                {
                    return "CDN";
                }
                                    
            function get_module_settings()
                {
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'cdn_url',
                                                                    'label'         =>  __('CDN Url',    'wp-hide-security-enhancer'),
                                                                    'description'   =>  __('Some CDN providers (like stackpath.com ) replace site assets with custom url, enter here such url. Otherwise this option should stay empty.', 'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'text',
                                                         
                                                                    
                                                                    'sanitize_type' =>  array()
                                                                    
                                                                    );
                                                                    
                    return $this->module_settings;   
                }
                
                
                
            function _init_scripts_remove_version($saved_field_data)
                {
   
                    
                }


        }
?>