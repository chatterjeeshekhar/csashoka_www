<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class WPH_module_general_admin_bar extends WPH_module_component
        {
            
            var $_initialized   =   FALSE;
            
            function get_component_title()
                {
                    return "Admin Bar";
                }
            
                                    
            function get_module_settings()
                {
                    
                    global $wpdb;
                    
                    $wp_roles   =   get_option( $wpdb->base_prefix . 'user_roles');
                    
                    foreach  ( $wp_roles     as  $role_slug  =>  $role )
                        {
                    
                            $this->module_settings[]                  =   $this->_prepare_modle_setting( $role_slug, $role['name'] );
                                                                    
                        }
                                                                    
                    return $this->module_settings;   
                }
                
                
            function _prepare_modle_setting( $role_slug, $role_name )
                {
                    
                    $module_setting     =   array(
                                                                    'id'                    =>  'remove_admin_bar_' . $role_slug,
                                                                    'label'                 =>  __('Remove Admin Bar for ',    'wp-hide-security-enhancer') . $role_name,
                                                                    'description'           =>  __('Remove WordPress Admin Bar for ',    'wp-hide-security-enhancer') . $role_name . ' ' .  __('role, which is being displayed by default on front side of your website.',    'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'            =>  'radio',
                                                                    'options'               =>  array(
                                                                                                        'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                        'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                        ),
                                                                    'default_value'         =>  'no',
                                                                    
                                                                    'sanitize_type'         =>  array('sanitize_title', 'strtolower'),
                                                                    
                                                                    'callback'              =>  '_init_remove_admin_bar',
                                                                    'callback_arguments'    =>  array('role_slug'  =>  $role_slug ),
                                                                    
                                                                    );
                    
                    return $module_setting;   
                }
                
                
                
            function _init_remove_admin_bar( $saved_field_data, $role )
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    //trigger once
                    if  ( $this->_initialized )
                        return;   
                         
                    $this->_initialized =   TRUE;
                        
                    add_action('init',          array($this, 'remove_admin_bar'));
                }
                
                
            function remove_admin_bar()
                {
                    if ( is_user_logged_in()    === FALSE )
                        return;
                    
                    $current_user   = wp_get_current_user();
                    $user_role      =   isset(  $current_user->roles[0] ) ?     $current_user->roles[0] :   '';
                    if ( empty ( $user_role ))
                        return;
                         
                    $role_hide_admin_bar    =   $this->wph->functions->get_module_item_setting('remove_admin_bar_' . $user_role );
                    if( $role_hide_admin_bar    !=  'yes')
                        return;
                        
                    add_filter('show_admin_bar', '__return_false');                    
                    
                }
            
           


        }
        
?>