<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class WPH_module_rewrite_root_files extends WPH_module_component
        {
            
            function get_component_title()
                {
                    return "Root Files";
                }
                                                
            function get_module_settings()
                {
                                      
                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'block_license_txt',
                                                                    'label'         =>  __('Block license.txt',    'wp-hide-security-enhancer'),
                                                                    'description'   =>  __('Block access to license.txt root file',    'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  55
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'block_readme_html',
                                                                    'label'         =>  __('Block readme.html',    'wp-hide-security-enhancer'),
                                                                    'description'   =>  __('Block access to readme.html root file',    'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  55
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'block_wp_activate_php',
                                                                    'label'         =>  __('Block wp-activate.php',    'wp-hide-security-enhancer'),
                                                                    'description'   =>  __('Block access to wp-activate.php file. This file confirms that the activation key that is sent in an email after a user signs up for a new blog matches the key for that user. If <b>anyone can register</b> on your site, you shold keep this off.',    'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  55
                                                                    );
                    
                    $local_ip   =   $this->domain_get_ip();
                    $option_description     =   __('Block access to wp-cron.php file. If remote cron calls not being used this can be set to Yes.',    'wp-hide-security-enhancer');
                    if (    $local_ip   === FALSE )
                        {
                            $option_description     .=   '<br /><span class="important">'  .   __('Unable to identify site domain IP, blocking wp-cron.php will stop the site internal WordPress cron functionality.',    'wp-hide-security-enhancer') .   '</span>';   
                        }
                        else
                        {
                            $option_description     .=   '<br /><span class="important">'  .   __('Site domain rezolved to IP',    'wp-hide-security-enhancer') . ' ' . $local_ip . ' ' .  __('If blocked, all internal calls to cron will continue to run fine. All calls from a different IP are blocked, including direct calls.',    'wp-hide-security-enhancer') . '</span>';
                        }
                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'block_wp_cron_php',
                                                                    'label'         =>  __('Block wp-cron.php',    'wp-hide-security-enhancer'),
                                                                    'description'   =>  $option_description,
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  55
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'block_default_wp_signup_php',
                                                                    'label'         =>  __('Block wp-signup.php',    'wp-hide-security-enhancer'),
                                                                    'description'   =>  __('Block default wp-signup.php file. If <b>anyone can register</b> on your site, you shold keep this off.',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  55
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'block_default_wp_register_php',
                                                                    'label'         =>  __('Block wp-register.php',    'wp-hide-security-enhancer'),
                                                                    'description'   =>  __('Block default wp-register.php file. This file is now deprecated however still exists within code and redirected to /register page.',  'wp-hide-security-enhancer'),
                                                                    
                                                                    'input_type'    =>  'radio',
                                                                    'options'       =>  array(
                                                                                                'no'        =>  __('No',     'wp-hide-security-enhancer'),
                                                                                                'yes'       =>  __('Yes',    'wp-hide-security-enhancer'),
                                                                                                ),
                                                                    'default_value' =>  'no',
                                                                    
                                                                    'sanitize_type' =>  array('sanitize_title', 'strtolower'),
                                                                    'processing_order'  =>  55
                                                                    
                                                                    );
                                                                    
                    $this->module_settings[]                  =   array(
                                                                    'id'            =>  'block_other_wp_files',
                                                                    'label'         =>  __('Block other wp-*.php files',    'wp-hide-security-enhancer'),
                                                                    'description'   =>  __('Block other wp-*.php files. E.g. wp-blog-header.php, wp-config.php, wp-cron.php. Those files are used internally, blocking those will not affect any functionality. Other root files (wp-activate.php, wp-login.php, wp-signup.php) are ignored, they can be controlled through own setting.',  'wp-hide-security-enhancer'),
                                                                    
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
                
         
                
            function _callback_saved_block_license_txt($saved_field_data)
                {
                    $processing_response    =   array();
                    
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    $rewrite_base   =   $this->wph->functions->get_rewrite_base( 'license.txt', FALSE, FALSE );
                    $rewrite_to     =   $this->wph->functions->get_rewrite_to_base( 'index.php', TRUE, FALSE, 'site_path' );
                    
                    $text   =   '';
                                                            
                    if($this->wph->server_htaccess_config   === TRUE)
                        {
                            $text   =   "RewriteCond %{ENV:REDIRECT_STATUS} ^$\n";
                            $text   .=   "RewriteRule ^" . $rewrite_base ." ".  $rewrite_to ."?wph-throw-404 [L]";
                        }
                    
                    if($this->wph->server_web_config   === TRUE)
                            $text   = '
                                        <rule name="wph-block_license_txt" stopProcessing="true">
                                            <match url="^' . $rewrite_base . '"  />
                                            <action type="Rewrite" url="'.  $rewrite_to .'?wph-throw-404" />  
                                        </rule>
                                                            ';
                               
                    $processing_response['rewrite'] = $text;            
                                
                    return  $processing_response;     
                    
                    
                }
                
            function _callback_saved_block_readme_html($saved_field_data)
                {
                    $processing_response    =   array();
                    
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    $rewrite_base   =   $this->wph->functions->get_rewrite_base( 'readme.html', FALSE, FALSE );
                    $rewrite_to     =   $this->wph->functions->get_rewrite_to_base( 'index.php', TRUE, FALSE, 'site_path' );
                    
                    $text   =   '';
                    
                    if($this->wph->server_htaccess_config   === TRUE)
                        {                                        
                            $text   =   "RewriteCond %{ENV:REDIRECT_STATUS} ^$\n";
                            $text   .=   "RewriteRule ^" . $rewrite_base ." ".  $rewrite_to ."?wph-throw-404 [L]";
                        }
                    
                    if($this->wph->server_web_config   === TRUE)
                            $text   = '
                                        <rule name="wph-block_readme_html" stopProcessing="true">
                                            <match url="^' . $rewrite_base . '"  />
                                            <action type="Rewrite" url="'.  $rewrite_to .'?wph-throw-404" />  
                                        </rule>
                                                            ';
                               
                    $processing_response['rewrite'] = $text;            
                                
                    return  $processing_response;     
                    
                    
                }
                
            function _callback_saved_block_wp_activate_php($saved_field_data)
                {
                    $processing_response    =   array();
                    
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;

                    $rewrite_base   =   $this->wph->functions->get_rewrite_base( 'wp-activate.php', FALSE, FALSE );
                    $rewrite_to     =   $this->wph->functions->get_rewrite_to_base( 'index.php', TRUE, FALSE, 'site_path' );
                    
                    $text   =   '';
                    
                    if($this->wph->server_htaccess_config   === TRUE)
                        {                                        
                            $text   =   "RewriteCond %{ENV:REDIRECT_STATUS} ^$\n";
                            $text   .=   "RewriteRule ^" . $rewrite_base ." ".  $rewrite_to ."?wph-throw-404 [L]";
                        }
                    
                    if($this->wph->server_web_config   === TRUE)
                            $text   = '
                                        <rule name="wph-block_wp_activate_php" stopProcessing="true">
                                            <match url="^' . $rewrite_base . '"  />
                                            <action type="Rewrite" url="'.  $rewrite_to .'?wph-throw-404" />  
                                        </rule>
                                                            ';
                               
                    $processing_response['rewrite'] = $text;            
                                
                    return  $processing_response;     
                    
                    
                }
                
                
            function _callback_saved_block_wp_cron_php($saved_field_data)
                {
                    $processing_response    =   array();
                    
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return FALSE;
                    
                    $rewrite_base   =   $this->wph->functions->get_rewrite_base( 'wp-cron.php', FALSE, FALSE );
                    $rewrite_to     =   $this->wph->functions->get_rewrite_to_base( 'index.php', TRUE, FALSE, 'site_path' );
                    
                    $text   =   '';
                    
                    $local_ip   =   $this->domain_get_ip();
                    
                    if($this->wph->server_htaccess_config   === TRUE)
                        {                                        
                            $text   =   "RewriteCond %{ENV:REDIRECT_STATUS} ^$\n";
                            
                            if  ( $local_ip !== FALSE )
                                {
                                    $text   .=  "RewriteCond %{REMOTE_ADDR} !^".  str_replace(".",'\.', $local_ip )  ."$\n";
                                }
                            
                            $text   .=   "RewriteRule ^" . $rewrite_base ." ".  $rewrite_to ."?wph-throw-404 [L]";
                        }
                    
                    if($this->wph->server_web_config   === TRUE)
                        {
                            $text   = '
                                        <rule name="wph-block_wp_cron_php" stopProcessing="true">
                                            <match url="^' . $rewrite_base . '"  />';
                            
                            if  ( $local_ip !== FALSE )
                                {
                                    $text   .=  '
                                                <conditions>  
                                                    <add input="{REMOTE_ADDR}" pattern="^'.  str_replace(".",'\.', $local_ip )  . '$" ignoreCase="true" negate="true" />
                                                </conditions>';
                                }
                                            
                            $text   .=  '             
                                            <action type="Rewrite" url="'.  $rewrite_to .'?wph-throw-404" />  
                                        </rule>
                                                            ';
                        }
                               
                    $processing_response['rewrite'] = $text;            
                                
                    return  $processing_response;     
                    
                    
                }
                
            function _callback_saved_block_default_wp_signup_php($saved_field_data)
                {
                    $processing_response    =   array();
                    
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return  $processing_response;
                    
                    $rewrite_base   =   $this->wph->functions->get_rewrite_base( 'wp-signup.php', FALSE, FALSE );
                    $rewrite_to     =   $this->wph->functions->get_rewrite_to_base( 'index.php', TRUE, FALSE, 'site_path' );
                    
                    $text   =   '';
                    
                    if($this->wph->server_htaccess_config   === TRUE)
                        {                              
                            $text   =       "RewriteCond %{ENV:REDIRECT_STATUS} ^$\n";
                            $text   .=      "RewriteRule ^" . $rewrite_base ." ".  $rewrite_to ."?wph-throw-404 [L]";
                        }
                        
                    if($this->wph->server_web_config   === TRUE)
                            $text   = '
                                        <rule name="wph-block_default_wp_signup_php" stopProcessing="true">
                                            <match url="^' . $rewrite_base . '"  />
                                            <action type="Rewrite" url="'.  $rewrite_to .'?wph-throw-404" />  
                                        </rule>
                                                            ';
                               
                    $processing_response['rewrite'] = $text;    
                                                    
                    return  $processing_response;   
                }
                
                
            function _callback_saved_block_default_wp_register_php( $saved_field_data )
                {
                    $processing_response    =   array();
                    
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return  $processing_response;
                    
                    $rewrite_base   =   $this->wph->functions->get_rewrite_base( 'wp-register.php', FALSE, FALSE );
                    $rewrite_to     =   $this->wph->functions->get_rewrite_to_base( 'index.php', TRUE, FALSE, 'site_path' );
                    
                    $text   =   '';
                    
                    if($this->wph->server_htaccess_config   === TRUE)
                        {                              
                            $text   =       "RewriteCond %{ENV:REDIRECT_STATUS} ^$\n";
                            $text   .=      "RewriteRule ^" . $rewrite_base ." ".  $rewrite_to ."?wph-throw-404 [L]";
                        }
                        
                    if($this->wph->server_web_config   === TRUE)
                            $text   = '
                                        <rule name="wph-block_default_wp_register_php" stopProcessing="true">
                                            <match url="^'. $rewrite_base .'"  />
                                            <action type="Rewrite" url="'.  $rewrite_to .'?wph-throw-404" />  
                                        </rule>
                                                            ';
                               
                    $processing_response['rewrite'] = $text;    
                                                    
                    return  $processing_response;   
                }

            function _callback_saved_block_other_wp_files($saved_field_data)
                {
                    $processing_response    =   array();
                    
                    if(empty($saved_field_data) ||  $saved_field_data   ==  'no')
                        return  $processing_response;
                    
                    $rewrite_conditional    =   $this->wph->functions->get_rewrite_base( '', FALSE );
                    $rewrite_base           =   $this->wph->functions->get_rewrite_base( '', FALSE);
                    $rewrite_to             =   $this->wph->functions->get_rewrite_to_base( 'index.php', TRUE, FALSE, 'site_path' );
                    
                    $text   =   '';
                                        
                    if($this->wph->server_htaccess_config   === TRUE)
                        {                              
                            $text   =       "RewriteCond %{ENV:REDIRECT_STATUS} ^$\n";
                            $text   .=       "RewriteCond %{REQUEST_FILENAME} -f\n";

                            $text   .=       "RewriteCond %{REQUEST_FILENAME} !".$rewrite_conditional."wp-activate.php [NC]\n";
                            $text   .=       "RewriteCond %{REQUEST_FILENAME} !".$rewrite_conditional."wp-cron.php [NC]\n";
                            $text   .=       "RewriteCond %{REQUEST_FILENAME} !".$rewrite_conditional."wp-signup.php [NC]\n";
                            $text   .=       "RewriteCond %{REQUEST_FILENAME} !".$rewrite_conditional."wp-register.php [NC]\n";
                            $text   .=       "RewriteCond %{REQUEST_FILENAME} !".$rewrite_conditional."wp-comments-post.php [NC]\n";
                            $text   .=       "RewriteCond %{REQUEST_FILENAME} !".$rewrite_conditional."wp-login.php [NC]\n";
                            
                            $text   .=      "RewriteRule ^" . $rewrite_base . "wp-([a-z-])+.php ".  $rewrite_to ."?wph-throw-404 [L]";
                        }
                        
                    if($this->wph->server_web_config   === TRUE)
                        $text = '
                            <rule name="wph-block_other_wp_files" stopProcessing="true">  
                                    <match url="^'. $rewrite_base .'wp-([a-z-])+.php" />  
                                    <conditions>  
                                        <add input="{REQUEST_FILENAME}" matchType="IsFile" ignoreCase="true" />
                                        <add input="{REQUEST_FILENAME}" pattern="wp-activate.php" ignoreCase="true" negate="true" />
                                        <add input="{REQUEST_FILENAME}" pattern="wp-cron.php" ignoreCase="true" negate="true" />
                                        <add input="{REQUEST_FILENAME}" pattern="wp-signup.php" ignoreCase="true" negate="true" />
                                        <add input="{REQUEST_FILENAME}" pattern="wp-register.php" ignoreCase="true" negate="true" />
                                        <add input="{REQUEST_FILENAME}" pattern="wp-comments-post.php" ignoreCase="true" negate="true" />
                                        <add input="{REQUEST_FILENAME}" pattern="wp-login.php" ignoreCase="true" negate="true" />
                                    </conditions>  
                                    <action type="Rewrite" url="'.  $rewrite_to .'?wph-throw-404" />  
                                </rule>
                                                            ';
                               
                    $processing_response['rewrite'] = $text;    
                                                    
                    return  $processing_response;   
                }
                
            
            /**
            * Return curent domain reversed ip
            *     
            */
            function domain_get_ip()
                {
                    $local_ip   =   FALSE;
                    $site_domain_parsed =   parse_url( home_url() );
                    if ( $site_domain_parsed !==    FALSE   &&  function_exists('gethostbyname')    &&  function_exists('ip2long') )
                        {
                            $site_domain_is_ip  =   ip2long( $site_domain_parsed['host'] )  === FALSE   ?   FALSE   :   TRUE;
                            $local_ip   =   gethostbyname( $site_domain_parsed['host'] );
                            
                            if  ( $site_domain_is_ip    === FALSE  &&   $local_ip  ==  $site_domain_parsed['host'] )
                                $local_ip   =   FALSE;
                            
                        }
                    
                    return $local_ip;
                }
                
        }
?>