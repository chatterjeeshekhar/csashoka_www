<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class WPH_module_admin_new_wp_login_php extends WPH_module_component
        {
            function get_component_title()
                {
                    return "wp-login.php";
                }
                                    
            function get_module_settings()
                {
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'new_wp_login_php',
                                                                    'label'         =>  __('New wp-login.php',    'wp-hide-security-enhancer'),
                                                                    'description'   =>  array(
                                                                                                __('Map a new wp-login.php instead default. This also need to include <i>.php</i> extension.',  'wp-hide-security-enhancer') . '<br />'
                                                                                                . __('More details can be found at',    'wp-hide-security-enhancer') .' <a href="http://www.wp-hide.com/documentation/admin-change-wp-login-php/" target="_blank">Link</a>',
                                                                                                '<div class="notice-error"><span class="important"><span class="dashicons dashicons-warning important" alt="f534">'. __('warning',    'wp-hide-security-enhancer') .'</span> ' . __('Make sure your log-in url is not already modified by another plugin or theme. In such case, you should disable other code and take advantage of these features. More details at ',  'wp-hide-security-enhancer') . '<a target="_blank" href="http://www.wp-hide.com/login-conflicts/">'. __('Login Conflicts',    'wp-hide-security-enhancer') .'</a></span></div>'
                                                                                                
                                                                                                ),
                                                                    'input_type'    =>  'text',
                                                                    
                                                                    'sanitize_type' =>  array(array($this->wph->functions, 'sanitize_file_path_name')),
                                                                    'processing_order'  =>  50
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'block_default_wp_login_php',
                                                                    'label'         =>  __('Block default wp-login.php',    'wp-hide-security-enhancer'),
                                                                    'description'   =>  '<span class="important">'. __('Ensure the above option works correctly on your server before activate this.',    'wp-hide-security-enhancer') .'</span><br />' . __('Block default wp-login.php file from being accesible.',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  55
                                                                    
                                                                    );
                    
                                                                    
                    return $this->module_settings;   
                }
                
                
                
            function _init_new_wp_login_php($saved_field_data)
                {
                    //check if the value has changed, e-mail the new url to site administrator
                    $previous_url   =   get_option('wph-previous-login-url');
                    if($saved_field_data    !=  $previous_url)
                        {
                            $this->new_login_email_notice($saved_field_data); 
                            update_option('wph-previous-login-url', $saved_field_data);  
                        }
                    
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                            
                    //conflict handle with other plugins
                    include_once(WPH_PATH . 'compatibility/wp-simple-firewall.php');
                    WPH_conflict_handle_wp_simple_firewall::custom_login_check();
                    
  
                    add_filter('login_url',             array($this,'login_url'), 999, 3 ); 
  
                    //add replacement
                    $this->wph->functions->add_replacement( trailingslashit(    site_url()  ) .  'wp-login.php',  trailingslashit(    home_url()  ) .  $saved_field_data );
                     
                }
                
                
            function new_login_email_notice( $new_login_url )
                {
                    if(empty( $new_login_url ))
                        $new_login_url    =   'wp-admin';
                    
                    $to         =   get_option('admin_email');
                    $subject    =   get_option('blogname') . ' - WP Hide New Login Url for your WordPress';
                    $message    =   __('Hello',  'wp-hide-security-enhancer') . ", \n\n" 
                                    . __('This is an automated message to inform that your login url has been changed at site ',  'wp-hide-security-enhancer') . " " .  trailingslashit(site_url()) . "\n"
                                    . __('The new login url is',  'wp-hide-security-enhancer') .  ": " . trailingslashit( trailingslashit(site_url()) .  $new_login_url ) . "\n\n"
                                    . __('Additionality you can use the following link to reset all options ',  'wp-hide-security-enhancer') .  ": " . site_url() . '?wph-recovery='.  $this->wph->functions->get_recovery_code() . "\n\n"
                                    . __('Please keep this url to a safe place.',  'wp-hide-security-enhancer');
                    $headers = 'From: '.  get_option('blogname') .' <'.  get_option('admin_email')  .'>' . "\r\n";
                    $this->wph->functions->wp_mail( $to, $subject, $message, $headers );   
                }
            
            
            function login_url($login_url, $redirect, $force_reauth)
                {
                    $new_wp_login_php     =   $this->wph->functions->get_module_item_setting('new_wp_login_php');
                    
                    $login_url = home_url($new_wp_login_php, 'login');
                    
                    return $login_url;   
                }
                
            function _callback_saved_new_wp_login_php($saved_field_data)
                {
                    $processing_response    =   array();
                    
                    if(empty($saved_field_data))
                        return  $processing_response; 
          
                    $new_wp_login_php =   untrailingslashit ( $this->wph->functions->get_url_path( trailingslashit(    site_url()  ) .  'wp-login.php'   ) );
                                
                    $rewrite_base   =   $saved_field_data;
                    $rewrite_to     =   $this->wph->functions->get_rewrite_to_base( $new_wp_login_php, TRUE, FALSE );
                               
                    if($this->wph->server_htaccess_config   === TRUE)
                        $processing_response['rewrite'] = "\nRewriteRule ^"    .   $rewrite_base     .   '(.*) '. $rewrite_to .'$1 [L,QSA]';
                    
                    if($this->wph->server_web_config   === TRUE)
                        $processing_response['rewrite'] = '
                            <rule name="wph-new_wp_login_php" stopProcessing="true">
                                <match url="^'.  $rewrite_base   .'(.*)"  />
                                <action type="Rewrite" url="'.  $rewrite_to .'{R:1}"  appendQueryString="true" />
                            </rule>
                                                            ';
                                
                    return  $processing_response;   
                }
                
                
            function _init_block_default_wp_login_php($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                        
  
                }
                
            function _callback_saved_block_default_wp_login_php($saved_field_data)
                {
                    $processing_response    =   array();
                    
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return  $processing_response;
                        
                    //prevent from blocking if the new_wp_login_php is empty
                    $new_wp_login_php     =   $this->wph->functions->get_module_item_setting('new_wp_login_php');
                    if (empty(  $new_wp_login_php ))
                        return FALSE;  
                                        
                    
                    $rewrite_base   =   $this->wph->functions->get_rewrite_base( 'wp-login.php', FALSE, FALSE );
                    $rewrite_to     =   $this->wph->functions->get_rewrite_to_base( 'index.php', TRUE, FALSE );
                    
                    if($this->wph->server_htaccess_config   === TRUE)
                        {           
                            $text   =       "RewriteCond %{ENV:REDIRECT_STATUS} ^$\n";
                            $text   .=      "RewriteRule ^" . $rewrite_base ." ".  $rewrite_to ."?wph-throw-404 [L]";
                        }
                        
                    if($this->wph->server_web_config   === TRUE)
                            $text   = '
                                        <rule name="wph-block_default_wp_login_php" stopProcessing="true">
                                            <match url="^'.  $rewrite_base   .'"  />
                                            <action type="Rewrite" url="'.  $rewrite_to .'?wph-throw-404" />  
                                        </rule>
                                                            ';
                               
                    $processing_response['rewrite'] = $text;    
                                                    
                    return  $processing_response;   
                }
                
            
                            

        }
?>