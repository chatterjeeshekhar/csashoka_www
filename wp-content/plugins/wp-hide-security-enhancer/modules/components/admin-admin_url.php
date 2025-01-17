<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class WPH_module_admin_admin_url extends WPH_module_component
        {
            function get_component_title()
                {
                    return "Admin URL";
                }
                                    
            function get_module_settings()
                {
                    $this->module_settings[]                  =   array(
                                                                        'id'            =>  'admin_url',
                                                                        'label'         =>  __('New Admin Url',    'wp-hide-security-enhancer'),
                                                                        'description'   =>  array(
                                                                                                    __('Create a new admin url instead default /wp-admin and /login.',  'wp-hide-security-enhancer') . '<br />'
                                                                                                    . __('More details can be found at',    'wp-hide-security-enhancer') .' <a href="http://www.wp-hide.com/documentation/admin-change-wp-admin/" target="_blank">Link</a>'
                                                                                                    ),                                                                        
                                                                        'input_type'    =>  'text',
                                                                        
                                                                        'sanitize_type' =>  array(array($this->wph->functions, 'sanitize_file_path_name'), array($this, 'sanitize_path_name')),
                                                                        'processing_order'  =>  60
                                                                        
                                                                        );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                        'id'            =>  'block_default_admin_url',
                                                                        'label'         =>  __('Block default Admin Url',    'wp-hide-security-enhancer'),
                                                                        'description'   =>  array(
                                                                                                    '<span class="important">'. __('Ensure the above option works correctly on your server before activate this.',    'wp-hide-security-enhancer') .'</span><br />' . __('Block default admin url and files from being accesible.',  'wp-hide-security-enhancer')
                                                                                                    ),
                                                                        'input_type'    =>  'radio',
                                                                        'options'       =>  array(
                                                                                                    'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                    'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                    ),
                                                                        'default_value' =>  'no',
                                                                        
                                                                        'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                        'processing_order'  =>  65
                                                                        
                                                                        );
                                                                    
                    return $this->module_settings;   
                }
                
                
                
            function _init_admin_url($saved_field_data)
                {

                    if(empty($saved_field_data))
                        return FALSE;
                        
                    remove_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );
                    
                    //conflict handle with other plugins
                    include_once(WPH_PATH . 'compatibility/wp-simple-firewall.php');
                    WPH_conflict_handle_wp_simple_firewall::custom_login_check();
                    
                    $this->wph->functions->add_replacement( trailingslashit(    site_url()  ) .  'wp-admin' , trailingslashit(    home_url()  ) .  $saved_field_data );

                    add_action('set_auth_cookie',       array($this,'set_auth_cookie'), 999, 5);
                    
                    //make sure the admin url redirect url is updated when updating WordPress Core
                    add_filter('user_admin_url',    array($this, 'wp_core_update_user_admin_url'), 999, 2);
                    add_filter('admin_url',         array($this, 'wp_core_update_admin_url'),      999, 3);
                    
                    //ensure admin_url() return correct url
                    add_filter('admin_url',         array($this, 'update_admin_url'),      999, 3);
                                        
                }
                
            function _callback_saved_admin_url($saved_field_data)
                {
                    $processing_response    =   array();
                    
                    //check if the field is noe empty
                    if(empty($saved_field_data))
                        return  $processing_response; 
                        
                    $wp_admin   =   untrailingslashit ( $this->wph->functions->get_url_path( trailingslashit(    site_url()  ) .  'wp-admin'   ) );
                    $new_admin  =   untrailingslashit ( $this->wph->functions->get_url_path( trailingslashit(    home_url()  ) .  $saved_field_data   ) );
                    
                    $rewrite_base   =   $saved_field_data;
                    $rewrite_to     =   $this->wph->functions->get_rewrite_to_base( $wp_admin, TRUE, FALSE );
                    $rewrite_to_new_admin   =   $new_admin;
          
                    $text   =   '';
          
                    if($this->wph->server_htaccess_config   === TRUE)
                        {
                            $text   =       "\nRewriteCond %{REQUEST_URI} ".  $rewrite_to_new_admin    ."$";
                            $text   .=      "\nRewriteRule ^(.*)$ ".  $rewrite_to_new_admin    ."/ [R=301,L]";
                            $text   .=      "\nRewriteRule ^"    .   $rewrite_base    .   '(.*) '. $rewrite_to .'$1 [L,QSA]';
                        }
                        
                    if($this->wph->server_web_config   === TRUE)
                            $text   = '
                                        <rule name="wph-admin_url1" stopProcessing="true">  
                                            <match url="^(.*)$" />  
                                            <conditions>  
                                                <add input="{REQUEST_URI}" matchType="Pattern" pattern="'. $rewrite_to_new_admin .'$"  />  
                                            </conditions>  
                                            <action type="Redirect" redirectType="Permanent" url="'.    $rewrite_to_new_admin . '{R:1}/" />  
                                        </rule>
                                        <rule name="wph-admin_url2" stopProcessing="true">
                                            <match url="^'.  $rewrite_base   .'(.*)"  />
                                            <action type="Rewrite" url="'.  $rewrite_to .'{R:1}"  appendQueryString="true" />
                                        </rule>
                                                            ';
                                   
                    $processing_response['rewrite']        =   $text;
                    $processing_response['page_refresh']    =   TRUE;
                                                    
                    return  $processing_response;   
                }
                
                
            function admin_url($url, $path, $blog_id)
                {
                    if($this->wph->uninstall === TRUE)
                        return $url; 
                            
                    $new_admin_url =   $this->wph->functions->get_module_item_setting('admin_url');
                       
                    $admin_dir_uri      =   trailingslashit(    site_url()  )   . trim($new_admin_url,  "/");
                    $new_url            =   trailingslashit(    $admin_dir_uri  )   .   $path;
                    
                    //add replacement
                    $this->wph->functions->add_replacement($url, $new_url);
                    
                    return $new_url;
                       
                }
               
            function set_auth_cookie($auth_cookie, $expire, $expiration, $user_id, $scheme) 
                {
                    
                    $new_admin_url =   $this->wph->functions->get_module_item_setting('admin_url');

                    if ( $scheme == 'secure_auth' ) 
                        {
                            $auth_cookie_name = SECURE_AUTH_COOKIE;
                            $secure = TRUE;
                        } 
                    else 
                        {
                            $auth_cookie_name = AUTH_COOKIE;
                            $secure = FALSE;
                        }        
                    
                    $sitecookiepath =   empty($this->wph->default_variables['wordpress_directory']) ?   SITECOOKIEPATH  :   rtrim(SITECOOKIEPATH, trailingslashit($this->wph->default_variables['wordpress_directory']));
                    if (empty ($sitecookiepath))
                        $sitecookiepath =   '/';
                    
                    setcookie($auth_cookie_name, $auth_cookie, $expire, $sitecookiepath  .   $new_admin_url, COOKIE_DOMAIN, $secure, true);
                  
                    $manager            =   WP_Session_Tokens::get_instance( $user_id );
                    $token              =   $manager->create( $expiration );
                    
                    $logged_in_cookie   =   wp_generate_auth_cookie( $user_id, $expiration, 'logged_in', $token );
                   
                }

            
            function _init_block_default_admin_url($saved_field_data)
                {
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
       
                }
                
            function _callback_saved_block_default_admin_url($saved_field_data)
                {
                    $processing_response    =   array();
                    
                    //check if the field is noe empty
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return  $processing_response; 
          
                    //prevent from blocking if the admin_url is empty
                    $admin_url     =   $this->wph->functions->get_module_item_setting('admin_url');
                    if (empty(  $admin_url ))
                        return FALSE;  
                    
                    $rewrite_base  =   $this->wph->functions->get_rewrite_base( '', FALSE);
                    $rewrite_to    =   $this->wph->functions->get_rewrite_to_base( 'index.php', TRUE, FALSE, 'site_path' );
                    
                    $text   =   '';
                                
                    if($this->wph->server_htaccess_config   === TRUE)
                        {           
                                    
                            $text   .=      "RewriteCond %{ENV:REDIRECT_STATUS} ^$\n";
                            $text   .=      "RewriteRule ^".$rewrite_base."wp-admin(.+) ". $rewrite_to ."?wph-throw-404 [L]\n";

                        }
                        
                    if($this->wph->server_web_config   === TRUE)
                        {
                            $text   .= '
                                        <rule name="wph-block_default_admin_url4" stopProcessing="true">
                                            <match url="^'. $rewrite_base   .'wp-admin(.+)"  />
                                            <action type="Rewrite" url="'.  $rewrite_to .'?wph-throw-404" />
                                        </rule>
                                                            ';    
                            
                            
                        }
                        
                               
                    $processing_response['rewrite'] = $text;
                                
                    return  $processing_response;   
                }
                
            
            /**
            * Replace any dots in the slug, as it will confuse the server uppon being an actual file
            *     
            * @param mixed $value
            */
            function sanitize_path_name( $value )
                {
                    
                    $value  =   str_replace(".","-", $value);
                    
                    return $value;   
                    
                }
                
                
                
            function wp_core_update_user_admin_url( $url, $path )
                {
                    
                    if( strpos( $_SERVER['REQUEST_URI'], "/update-core.php")    === FALSE )
                        return $url;
                        
                    //replace the wp-admin with custom slug
                    $admin_url     =   $this->wph->functions->get_module_item_setting('admin_url');
                    
                    $url    =   str_replace('/wp-admin', '/' . $admin_url, $url);

                    return $url;
                       
                }

            function wp_core_update_admin_url( $url, $path, $blog_id )
                {
                    if( strpos( $_SERVER['REQUEST_URI'], "/update-core.php")    === FALSE && strpos( $_SERVER['REQUEST_URI'], "/update.php")    === FALSE)
                        return $url;
                    
                    //replace the wp-admin with custom slug
                    $admin_url     =   $this->wph->functions->get_module_item_setting('admin_url');
                    
                    $url    =   str_replace('/wp-admin', '/' . $admin_url, $url);
                        
                    return $url;
                       
                }
                
            
            function update_admin_url( $url, $path, $blog_id )
                {
                    //if( strpos( $_SERVER['REQUEST_URI'], "/admin-ajax.php")    === FALSE )
                        //return $url;
                    
                    //replace the wp-admin with custom slug
                    $admin_url     =   $this->wph->functions->get_module_item_setting('admin_url');
                    
                    $url    =   str_replace('/wp-admin', '/' . $admin_url, $url);
                        
                    return $url;
                       
                }

                
        }
?>