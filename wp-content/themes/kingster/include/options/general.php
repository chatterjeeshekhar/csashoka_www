<?php
	/*	
	*	Goodlayers Option
	*	---------------------------------------------------------------------
	*	This file store an array of theme options
	*	---------------------------------------------------------------------
	*/	

	// add custom css for theme option
	add_filter('gdlr_core_theme_option_top_file_write', 'kingster_gdlr_core_theme_option_top_file_write', 10, 2);
	if( !function_exists('kingster_gdlr_core_theme_option_top_file_write') ){
		function kingster_gdlr_core_theme_option_top_file_write( $css, $option_slug ){
			if( $option_slug != 'goodlayers_main_menu' ) return;

			ob_start();

			// default title background
			$enable_default_title_background = kingster_get_option('general', 'enable-default-title-background', 'enable');
			if( $enable_default_title_background == 'disable' ){
				echo '.kingster-page-title-wrap{ background-image: none; }';
			}else{
				
				$default_title_background = kingster_get_option('general', 'default-title-background', '');
				if( $default_title_background ){
					$default_title_background_url = wp_get_attachment_url($default_title_background);
					if( !empty($default_title_background_url) ){
						echo '.kingster-page-title-wrap{ background-image: url(' . esc_url($default_title_background_url) . '); }';
					}
				}
			}

			// header bottom shadow
			$header_style = kingster_get_option('general', 'header-style', '');
			if( $header_style == 'plain' ){
				$header_bottom_shadow = kingster_get_option('general', 'header-plain-bottom-shadow', 'disable');
				if( $header_bottom_shadow == 'enable' ){
					echo '.kingster-header-wrap.kingster-header-style-plain{ box-shadow: 0px 1px 4px rgba(0,0,0,0.1); -webkit-box-shadow: 0px 1px 4px rgba(0,0,0,0.1); }';
				}
			}

			// top bar bottom
			$bottom_padding = kingster_get_option('general', 'top-bar-bottom-padding', '');
			if( !empty($bottom_padding) ){
				$bottom_padding = (intval($bottom_padding) + 1);
				echo '.kingster-top-bar-right-button{ padding-bottom: ' . $bottom_padding . 'px; margin-bottom: -' . $bottom_padding . 'px; }';
			}

?>
.kingster-body h1, .kingster-body h2, .kingster-body h3, .kingster-body h4, .kingster-body h5, .kingster-body h6{ margin-top: 0px; margin-bottom: 20px; line-height: 1.2; font-weight: 700; }
#poststuff .gdlr-core-page-builder-body h2{ padding: 0px; margin-bottom: 20px; line-height: 1.2; font-weight: 700; }
#poststuff .gdlr-core-page-builder-body h1{ padding: 0px; font-weight: 700; }

.gdlr-core-button, .kingster-button, 
input[type="button"], input[type="submit"], input[type="reset"]{ text-transform: none; font-weight: 700; }
input, textarea{ border-bottom-width: 1px; }

.gdlr-core-twitter-item{ position: relative; }
.gdlr-core-twitter-item .gdlr-core-block-item-title-nav{ margin-bottom: 0px; position: absolute; right: 0px; font-size: 20px; z-index: 1; }
.gdlr-core-twitter-item .gdlr-core-block-item-title-nav .gdlr-core-flexslider-nav.gdlr-core-plain-style li a{ font-size: 20px; }
.gdlr-core-twitter-item .gdlr-core-block-item-title-nav .gdlr-core-flexslider-nav.gdlr-core-plain-style li a.flex-prev i:before{ content: "\f177"; font-family: fontAwesome; }
.gdlr-core-twitter-item .gdlr-core-block-item-title-nav .gdlr-core-flexslider-nav.gdlr-core-plain-style li a.flex-next i:before{ content: "\f178"; font-family: fontAwesome; margin-left: 10px; }

.gdlr-core-twitter-item .gdlr-core-flexslider li:before{ content: "\f099"; float: left; font-size: 24px; line-height: 25px; font-family: fontAwesome; margin-right: 25px; }
.gdlr-core-twitter-item .gdlr-core-flexslider li .gdlr-core-twitter-item-list{ overflow: hidden; padding-right: 80px; }
.gdlr-core-twitter-item .gdlr-core-flexslider .gdlr-core-twitter-item-list-date{ display: inline; }
.gdlr-core-twitter-item .gdlr-core-flexslider .gdlr-core-twitter-item-list-content{ margin-right: 12px; }
.gdlr-core-twitter-item .gdlr-core-twitter-item-list-content{ font-size: 14px; }

.gdlr-core-tab-item .gdlr-core-tab-item-title{ font-size: 17px; font-weight: 700; text-transform: none; letter-spacing: 0px; }
.gdlr-core-tab-style1-horizontal .gdlr-core-tab-item-title{ border: 0px; margin-left: 0px; padding: 24px 40px 24px; }
.gdlr-core-tab-style1-horizontal .gdlr-core-tab-item-title.gdlr-core-active{ margin-bottom: 0px; padding: 24px 40px 24px; }
.gdlr-core-tab-style1-horizontal .gdlr-core-tab-item-title-wrap{ border: 0px; }
.gdlr-core-tab-style1-horizontal .gdlr-core-tab-item-content{ padding: 67px 59px 45px; background-repeat: no-repeat; }

.gdlr-core-tab-item .gdlr-core-tab-item-content-image-wrap{ width: 30%; height: 1px; float: left; }
.gdlr-core-tab-item .gdlr-core-tab-item-image{ opacity: 0; position: absolute; z-index: -1; width: 100%; height: 100%; overflow: hidden; 
	transition: opacity 200ms; -moz-transition: opacity 200ms; -o-transition: opacity 200ms; -webkit-transition: opacity 200ms; }
.gdlr-core-tab-item .gdlr-core-tab-item-image.gdlr-core-active{ opacity:1; position: relative; z-index: 0; }
.gdlr-core-tab-item .gdlr-core-tab-item-image i{ position: absolute; font-size: 30px; top: 50%; left: 50%; 
    width: 84px; text-align: center; padding: 27px 0px 27px 8px; margin-top: -42px; margin-left: -42px; background: #fff; 
    border-radius: 50%; -moz-border-radius: 50%; -webkit-border-radius: 50%; }
.gdlr-core-tab-item .gdlr-core-tab-item-wrap{ overflow: hidden; }
.gdlr-core-tab-item .gdlr-core-tab-item-image-background{ display: block; width: 100%; height: 100%; background-size: cover;a background-position: center; }

.gdlr-core-blockquote-item .gdlr-core-blockquote-item-content{ font-style: normal; }
.gdlr-core-blockquote-item .gdlr-core-blockquote-item-author{ font-style: normal; }
.gdlr-core-blockquote-item .gdlr-core-blockquote-item-author:before{ display: none; }
.gdlr-core-blockquote-item.gdlr-core-left-align .gdlr-core-blockquote-item-quote,
.gdlr-core-blockquote-item.gdlr-core-right-align .gdlr-core-blockquote-item-quote{ float: none; }
.gdlr-core-blockquote-item.gdlr-core-small-size .gdlr-core-blockquote-item-quote{ height: 48px; }
.gdlr-core-blockquote-item.gdlr-core-medium-size .gdlr-core-blockquote-item-quote{ height: 56px; }
.gdlr-core-blockquote-item.gdlr-core-large-size .gdlr-core-blockquote-item-quote{ font-size: 170px; height: 82px; }
.gdlr-core-blockquote-item.gdlr-core-large-size .gdlr-core-blockquote-item-content{ font-size: 21px; font-weight: bold; }
.gdlr-core-blockquote-item.gdlr-core-large-size .gdlr-core-blockquote-item-author { font-size: 18px; }

.gdlr-core-blockquote-item.gdlr-core-small-size.gdlr-core-center-align .gdlr-core-blockquote-item-quote,
.gdlr-core-blockquote-item.gdlr-core-medium-size.gdlr-core-center-align .gdlr-core-blockquote-item-quote,
.gdlr-core-blockquote-item.gdlr-core-large-size.gdlr-core-center-align .gdlr-core-blockquote-item-quote{ margin-bottom: 0px; }

.gdlr-core-accordion-style-background-title-icon .gdlr-core-accordion-item-title,
.gdlr-core-toggle-box-style-background-title-icon .gdlr-core-toggle-box-item-title,
.gdlr-core-accordion-style-background-title .gdlr-core-accordion-item-title,
.gdlr-core-toggle-box-style-background-title .gdlr-core-toggle-box-item-title{ font-size: 16px; text-transform: none; letter-spacing: 0px; padding: 25px 25px 23px; }
.gdlr-core-accordion-style-background-title-icon .gdlr-core-accordion-item-title:before, 
.gdlr-core-toggle-box-style-background-title-icon .gdlr-core-accordion-item-title:before{ font-size: 24px; }

.gdlr-core-title-item .gdlr-core-title-item-link{ font-size: 14px; }
.gdlr-core-title-item.gdlr-core-left-align .gdlr-core-title-item-title{ float: left; }
.gdlr-core-title-item.gdlr-core-left-align .gdlr-core-title-item-divider{ position: static; overflow: hidden; padding-top: 0.6em; margin-top: 0px; }
.gdlr-core-title-item-caption-top.gdlr-core-left-align .gdlr-core-title-item-link, 
.gdlr-core-title-item-caption-bottom.gdlr-core-left-align .gdlr-core-title-item-link{ position: static; margin-top: 8px; line-height: 1.7; }

.gdlr-core-block-item-title-wrap.gdlr-core-center-align .gdlr-core-block-item-caption.gdlr-core-bottom{ margin-top: 10px; }
.gdlr-core-block-item-title-wrap.gdlr-core-center-align .gdlr-core-block-item-read-more{ margin-top: 8px; }
.gdlr-core-block-item-title-wrap.gdlr-core-left-align .gdlr-core-block-item-caption.gdlr-core-bottom{ margin-top: 10px; }
.gdlr-core-block-item-title-wrap.gdlr-core-left-align .gdlr-core-block-item-read-more{ margin-top: 8px; display: inline-block; }
.gdlr-core-block-item-title-wrap.gdlr-core-left-align .gdlr-core-block-item-title{ float: left; margin-right: 30px; }
.gdlr-core-block-item-title-wrap.gdlr-core-left-align .gdlr-core-block-item-title-divider{ overflow: hidden; border-bottom-style: solid; border-bottom-width: 1px; padding-top: 0.6em; }

.gdlr-core-personnel-info-item .gdlr-core-personnel-info-item-head{ margin-bottom: 20px; }
.gdlr-core-personnel-info-item .gdlr-core-personnel-info-item-title{ font-size: 34px; margin-bottom: 7px; }
.gdlr-core-personnel-info-item .gdlr-core-personnel-info-item-position{ font-size: 20px; margin-bottom: 7px; }
.gdlr-core-personnel-info-item .kingster-personnel-info-list{ font-size: 17px; margin-bottom: 12px; }
.gdlr-core-personnel-info-item .kingster-personnel-info-list.kingster-type-social-shortcode{ margin-bottom: 22px; }
.gdlr-core-personnel-info-item .kingster-personnel-info-list-icon{ font-size: 16px; width: 20px; margin-right: 12px; }

.gdlr-core-personnel-item .gdlr-core-personnel-list-title{ margin-bottom: 4px; font-size: 23px; font-weight: 800; letter-spacing: 0px; }
.gdlr-core-personnel-item .gdlr-core-personnel-list-position{ font-size: 16px; font-weight: 600; }
.gdlr-core-personnel-item .gdlr-core-personnel-info{ margin-top: 20px; }
.gdlr-core-personnel-item .gdlr-core-personnel-list-button{ border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; margin-top: 5px; margin-bottom: 20px; }
.gdlr-core-personnel-item .kingster-personnel-info-list{ font-size: 16px; margin-bottom: 6px; }
.gdlr-core-personnel-item .kingster-personnel-info-list.kingster-type-social-shortcode{ margin-bottom: 22px; }
.gdlr-core-personnel-item .kingster-personnel-info-list-icon{ font-size: 15px; width: 20px; margin-right: 12px; }

.gdlr-core-personnel-style-grid .gdlr-core-personnel-list-social,
.gdlr-core-personnel-style-modern .gdlr-core-personnel-list-social,
.gdlr-core-personnel-style-medium .gdlr-core-personnel-list-social{ margin-top: 0px; margin-bottom: 10px; }
.gdlr-core-personnel-style-grid.gdlr-core-with-background .gdlr-core-personnel-list-content-wrap{ padding: 35px 40px 20px; border-bottom-width: 3px; border-bottom-style: solid; }

.gdlr-core-blog-info-wrapper .gdlr-core-head{ vertical-align: baseline; margin-right: 7px; }
.gdlr-core-blog-info-wrapper .gdlr-core-blog-info{ font-size: 13px; font-weight: 600; margin-right: 12px; }
.gdlr-core-blog-info-wrapper .gdlr-core-blog-info:before{ content: "/"; margin-right: 12px; }
.gdlr-core-blog-info-wrapper .gdlr-core-blog-info:first-child:before { display: none; }
.gdlr-core-blog-grid .gdlr-core-blog-info-wrapper{ padding-top: 0px; border: none; margin-bottom: 6px; }
.gdlr-core-blog-grid .gdlr-core-blog-thumbnail{ border-radius: 3px; }
.gdlr-core-blog-grid-with-frame .gdlr-core-blog-thumbnail{ border-radius: 3px 3px 0px 0px; }
.gdlr-core-blog-widget{ padding-top: 0px; border: none; margin-bottom: 30px; }
.gdlr-core-blog-widget .gdlr-core-blog-thumbnail{ max-width: 80px;
    border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; }
.gdlr-core-blog-widget .gdlr-core-blog-info-wrapper{ margin-bottom: 6px; }
.gdlr-core-blog-widget .gdlr-core-blog-title{ margin-bottom 0px; }

ul.gdlr-core-custom-menu-widget.gdlr-core-menu-style-list{ font-size: 16px; margin-top: -18px; }
ul.gdlr-core-custom-menu-widget.gdlr-core-menu-style-list li a{ padding-left: 0px; border: none; font-weight: 400; }
ul.gdlr-core-custom-menu-widget.gdlr-core-menu-style-list li a:before{ margin-left: 0px; opacity: 1; }

.gdlr-core-event-item .gdlr-core-event-item-info-wrap{ font-size: 13px; }
.gdlr-core-event-item .gdlr-core-event-item-info-wrap .gdlr-core-head{ margin-right: 10px; }
.gdlr-core-event-item-info.gdlr-core-type-start-date-month{ display: block; float: left; width: 40px; text-align: center; 
	white-space: nowrap; margin-right: 25px; border-bottom-width: 3px; border-bottom-style: solid; padding-bottom: 10px; }
.gdlr-core-type-start-date-month .gdlr-core-date{ font-size: 34px; line-height: 1; font-weight: 700; display: block; }
.gdlr-core-type-start-date-month .gdlr-core-month{ font-size: 16px; display: block; font-weight: 700; text-transform: uppercase; }

.gdlr-core-event-item-list.gdlr-core-style-widget{ margin-bottom: 25px; }
.gdlr-core-event-item-list.gdlr-core-style-widget .gdlr-core-event-item-title{ font-size: 18px; margin-bottom: 14px; }
.gdlr-core-event-item-list.gdlr-core-style-widget .gdlr-core-event-item-content-wrap{ overflow: hidden; }
.gdlr-core-event-item-list.gdlr-core-style-widget .gdlr-core-event-item-info{ margin-bottom: 2px; margin-right: 20px; }

.gdlr-core-event-item-list.gdlr-core-style-grid{ margin-bottom: 35px; }
.gdlr-core-event-item-list.gdlr-core-style-grid .gdlr-core-event-item-thumbnail{ margin-bottom: 28px; overflow: hidden; 
	border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; }
.gdlr-core-event-item-list.gdlr-core-style-grid .gdlr-core-event-item-title{ font-size: 19px; margin-bottom: 14px; font-weight: 700; }
.gdlr-core-event-item-list.gdlr-core-style-grid .gdlr-core-event-item-content-wrap{ overflow: hidden; }
.gdlr-core-event-item-list.gdlr-core-style-grid .gdlr-core-event-item-info{ display: block; margin-bottom: 2px; }

@media only screen and (max-width: 1260px){
	.gdlr-core-tab-style1-horizontal .gdlr-core-tab-item-title.gdlr-core-active,
	.gdlr-core-tab-style1-horizontal .gdlr-core-tab-item-title{ padding: 20px 25px 16px; }
	.gdlr-core-tab-style1-horizontal .gdlr-core-tab-item-content{ padding: 25px 25px }
}
@media only screen and (max-width: 999px){
	.gdlr-core-twitter-item .gdlr-core-flexslider li .gdlr-core-twitter-item-list{ padding-right: 0px; }
	.gdlr-core-tab-item .gdlr-core-tab-item-content-image-wrap{ display: none; float: none; width: auto; height: 300px !important; }
}
@media only screen and (max-width: 767px){
	.gdlr-core-tab-item .gdlr-core-tab-item-title{ font-size: 13px; font-weight: 600; }
	.gdlr-core-tab-style1-horizontal .gdlr-core-tab-item-title-wrap{ padding-left: 15px; padding-right: 15px; }
	body .gdlr-core-tab-style1-horizontal .gdlr-core-tab-item-title.gdlr-core-active{ background: transparent; }
	.gdlr-core-tab-style1-horizontal .gdlr-core-tab-item-title, 
	.gdlr-core-tab-style1-horizontal .gdlr-core-tab-item-title.gdlr-core-active{ padding: 15px 9px; }
}


body .gdlr-core-blog-quote-format.gdlr-core-small .gdlr-core-blog-quote{ font-size: 80px; margin-bottom: -25px; }
body .gdlr-core-portfolio-grid .gdlr-core-portfolio-content-wrap .gdlr-core-portfolio-info{ font-size: 14px; }
.gdlr-core-sidebar-item .textwidget .gdlr-core-button-full-width{ display: block; margin-right: 0 !important; text-align: center; }
body .gdlr-core-accordion-style-icon .gdlr-core-accordion-item-title{ font-size: 17px; text-transform: none; font-weight: 400; letter-spacing: 0px; }
body .gdlr-core-button{ letter-spacing: 0; }
body .gdlr-core-newsletter-item.gdlr-core-style-rectangle-full .gdlr-core-newsletter-submit input[type="submit"]{ font-size: 15px; font-weight: 700; line-height: 20px; padding: 17px 19px; letter-spacing: 0; }
body .gdlr-core-block-item-title-wrap .gdlr-core-block-item-title{ font-weight: 700; }
body .gdlr-core-icon-pos-right.gdlr-core-accordion-style-background-title-icon .gdlr-core-accordion-item-title{ padding: 25px 25px 25px 30px; }
body .gdlr-core-blog-grid .gdlr-core-blog-title{ font-size: 19px; }
body .gdlr-core-newsletter-item.gdlr-core-style-rectangle-full .gdlr-core-newsletter-email input[type="email"]{ font-size: 14px; padding: 18px 20px; }
body .gdlr-core-social-network-item .gdlr-core-social-network-icon{ font-size: 19px; }
body .gdlr-core-button{ font-size: 15px; }

<?php
			$css .= ob_get_contents();
			ob_end_clean(); 

			return $css;
		}
	}
	add_filter('gdlr_core_theme_option_bottom_file_write', 'kingster_gdlr_core_theme_option_bottom_file_write', 10, 2);
	if( !function_exists('kingster_gdlr_core_theme_option_bottom_file_write') ){
		function kingster_gdlr_core_theme_option_bottom_file_write( $css, $option_slug ){
			if( $option_slug != 'goodlayers_main_menu' ) return;

			$general = get_option('kingster_general');

			if( !empty($general['item-padding']) ){
				$margin = 2 * intval(str_replace('px', '', $general['item-padding']));
				if( !empty($margin) && is_numeric($margin) ){
					$css .= '.kingster-item-mgb, .gdlr-core-item-mgb{ margin-bottom: ' . $margin . 'px; }';
				}
			}

			if( !empty($general['mobile-logo-position']) && $general['mobile-logo-position'] == 'logo-right' ){
				$css .= '.kingster-mobile-header .kingster-logo-inner{ margin-right: 0px; margin-left: 80px; float: right; }';	
				$css .= '.kingster-mobile-header .kingster-mobile-menu-right{ left: 30px; right: auto; }';	
				$css .= '.kingster-mobile-header .kingster-main-menu-search{ float: right; margin-left: 0px; margin-right: 25px; }';	
				$css .= '.kingster-mobile-header .kingster-mobile-menu{ float: right; margin-left: 0px; margin-right: 30px; }';	
				$css .= '.kingster-mobile-header .kingster-main-menu-cart{ float: right; margin-left: 0px; margin-right: 20px; padding-left: 0px; padding-right: 5px; }';	
				$css .= '.kingster-mobile-header .kingster-top-cart-content-wrap{ left: 0px; }';
			}

			return $css;
		}
	}

	$course_info = array();
	if( function_exists('goodlayers_core_course_get_custom_tax_list') ){
		$course_info = goodlayers_core_course_get_custom_tax_list();
	}

	$kingster_admin_option->add_element(array(
	
		// general head section
		'title' => esc_html__('General', 'kingster'),
		'slug' => 'kingster_general',
		'icon' => get_template_directory_uri() . '/include/options/images/general.png',
		'options' => array(
		
			'layout' => array(
				'title' => esc_html__('Layout', 'kingster'),
				'options' => array(
					
					'layout' => array(
						'title' => esc_html__('Layout', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'full' => esc_html__('Full', 'kingster'),
							'boxed' => esc_html__('Boxed', 'kingster'),
						)
					),
					'boxed-layout-top-margin' => array(
						'title' => esc_html__('Box Layout Top/Bottom Margin', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '150',
						'data-type' => 'pixel',
						'default' => '0px',
						'selector' => 'body.kingster-boxed .kingster-body-wrapper{ margin-top: #gdlr#; margin-bottom: #gdlr#; }',
						'condition' => array( 'layout' => 'boxed' ) 
					),
					'body-margin' => array(
						'title' => esc_html__('Body Magin ( Frame Spaces )', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '0px',
						'selector' => '.kingster-body-wrapper.kingster-with-frame, body.kingster-full .kingster-fixed-footer{ margin: #gdlr#; }',
						'condition' => array( 'layout' => 'full' ),
						'description' => esc_html__('This value will be automatically omitted for side header style.', 'kingster'),
					),
					'background-type' => array(
						'title' => esc_html__('Background Type', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'color' => esc_html__('Color', 'kingster'),
							'image' => esc_html__('Image', 'kingster'),
							'pattern' => esc_html__('Pattern', 'kingster'),
						),
						'condition' => array( 'layout' => 'boxed' )
					),
					'background-image' => array(
						'title' => esc_html__('Background Image', 'kingster'),
						'type' => 'upload',
						'data-type' => 'file', 
						'selector' => '.kingster-body-background{ background-image: url(#gdlr#); }',
						'condition' => array( 'layout' => 'boxed', 'background-type' => 'image' )
					),
					'background-image-opacity' => array(
						'title' => esc_html__('Background Image Opacity', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '100',
						'condition' => array( 'layout' => 'boxed', 'background-type' => 'image' ),
						'selector' => '.kingster-body-background{ opacity: #gdlr#; }'
					),
					'background-pattern' => array(
						'title' => esc_html__('Background Type', 'kingster'),
						'type' => 'radioimage',
						'data-type' => 'text',
						'options' => 'pattern', 
						'selector' => '.kingster-background-pattern .kingster-body-outer-wrapper{ background-image: url(' . GDLR_CORE_URL . '/include/images/pattern/#gdlr#.png); }',
						'condition' => array( 'layout' => 'boxed', 'background-type' => 'pattern' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'enable-boxed-border' => array(
						'title' => esc_html__('Enable Boxed Border', 'kingster'),
						'type' => 'checkbox',
						'default' => 'disable',
						'condition' => array( 'layout' => 'boxed', 'background-type' => 'pattern' ),
					),
					'item-padding' => array(
						'title' => esc_html__('Item Left/Right Spaces', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '40',
						'data-type' => 'pixel',
						'default' => '15px',
						'description' => 'Space between each page items',
						'selector' => '.kingster-item-pdlr, .gdlr-core-item-pdlr{ padding-left: #gdlr#; padding-right: #gdlr#; }' . 
							'.kingster-item-rvpdlr, .gdlr-core-item-rvpdlr{ margin-left: -#gdlr#; margin-right: -#gdlr#; }' .
							'.gdlr-core-metro-rvpdlr{ margin-top: -#gdlr#; margin-right: -#gdlr#; margin-bottom: -#gdlr#; margin-left: -#gdlr#; }' .
							'.kingster-item-mglr, .gdlr-core-item-mglr, .kingster-navigation .sf-menu > .kingster-mega-menu .sf-mega,' . 
							'.sf-menu.kingster-top-bar-menu > .kingster-mega-menu .sf-mega{ margin-left: #gdlr#; margin-right: #gdlr#; }' .
							'.kingster-body .gdlr-core-personnel-item .gdlr-core-flexslider.gdlr-core-with-outer-frame-element .flex-viewport, ' . 
							'.kingster-body .gdlr-core-hover-box-item .gdlr-core-flexslider.gdlr-core-with-outer-frame-element .flex-viewport,' . 
							'.kingster-body .gdlr-core-blog-item .gdlr-core-flexslider.gdlr-core-with-outer-frame-element .flex-viewport{ padding-top: #gdlr#; margin-top: -#gdlr#; padding-right: #gdlr#; margin-right: -#gdlr#; padding-left: #gdlr#; margin-left: -#gdlr#; padding-bottom: #gdlr#; margin-bottom: -#gdlr#; }' .
							'.gdlr-core-twitter-item .gdlr-core-block-item-title-nav{ margin-right: #gdlr#; }'
					),
					'container-width' => array(
						'title' => esc_html__('Container Width', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '1180px',
						'selector' => '.kingster-container, .gdlr-core-container, body.kingster-boxed .kingster-body-wrapper, ' . 
							'body.kingster-boxed .kingster-fixed-footer .kingster-footer-wrapper, body.kingster-boxed .kingster-fixed-footer .kingster-copyright-wrapper{ max-width: #gdlr#; }' 
					),
					'container-padding' => array(
						'title' => esc_html__('Container Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.kingster-body-front .gdlr-core-container, .kingster-body-front .kingster-container{ padding-left: #gdlr#; padding-right: #gdlr#; }'  . 
							'.kingster-body-front .kingster-container .kingster-container, .kingster-body-front .kingster-container .gdlr-core-container, '.
							'.kingster-body-front .gdlr-core-container .gdlr-core-container{ padding-left: 0px; padding-right: 0px; }'
					),
					'sidebar-width' => array(
						'title' => esc_html__('Sidebar Width', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'30' => '50%', '20' => '33.33%', '15' => '25%', '12' => '20%', '10' => '16.67%'
						),
						'default' => 20,
					),
					'both-sidebar-width' => array(
						'title' => esc_html__('Both Sidebar Width', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'30' => '50%', '20' => '33.33%', '15' => '25%', '12' => '20%', '10' => '16.67%'
						),
						'default' => 15,
					),
					
				) // header-options
			), // header-nav	
			
			'top-bar' => array(
				'title' => esc_html__('Top Bar', 'kingster'),
				'options' => array(

					'enable-top-bar' => array(
						'title' => esc_html__('Enable Top Bar', 'kingster'),
						'type' => 'checkbox',
					),
					'enable-top-bar-on-mobile' => array(
						'title' => esc_html__('Enable Top Bar On Mobile', 'kingster'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
					'top-bar-width' => array(
						'title' => esc_html__('Top Bar Width', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'boxed' => esc_html__('Boxed ( Within Container )', 'kingster'),
							'full' => esc_html__('Full', 'kingster'),
							'custom' => esc_html__('Custom', 'kingster'),
						),
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-width-pixel' => array(
						'title' => esc_html__('Top Bar Width Pixel', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'default' => '1140px',
						'condition' => array( 'enable-top-bar' => 'enable', 'top-bar-width' => 'custom' ),
						'selector' => '.kingster-top-bar-container.kingster-top-bar-custom-container{ max-width: #gdlr#; }'
					),
					'top-bar-full-side-padding' => array(
						'title' => esc_html__('Top Bar Full ( Left/Right ) Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.kingster-top-bar-container.kingster-top-bar-full{ padding-right: #gdlr#; padding-left: #gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable', 'top-bar-width' => 'full' )
					),
					'top-bar-menu-position' => array(
						'title' => esc_html__('Top Bar Menu Position', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'none' => esc_html__('None', 'kingster'),
							'left' => esc_html__('Left', 'kingster'),
							'right' => esc_html__('Right', 'kingster'),
						),
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-left-text' => array(
						'title' => esc_html__('Top Bar Left Text', 'kingster'),
						'type' => 'textarea',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-right-text' => array(
						'title' => esc_html__('Top Bar Right Text', 'kingster'),
						'type' => 'textarea',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-right-button-text' => array(
						'title' => esc_html__('Top Bar Right Button Text', 'kingster'),
						'type' => 'text',
						'default' => esc_html__('Support KU', 'kingster'),
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-right-button-link' => array(
						'title' => esc_html__('Top Bar Right Button Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-right-button-target' => array(
						'title' => esc_html__('Top Bar Right Button Target', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'_self' => esc_html__('Current Screen', 'kingster'),
							'_blank' => esc_html__('New Window', 'kingster'),
						),
						'default' => '_blank',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-top-padding' => array(
						'title' => esc_html__('Top Bar Top Padding', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
 						'default' => '10px',
						'selector' => '.kingster-top-bar{ padding-top: #gdlr#; }' . 
							'.kingster-top-bar-right-button{ padding-top: #gdlr#; margin-top: -#gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-bottom-padding' => array(
						'title' => esc_html__('Top Bar Bottom Padding', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '10px',
						'selector' => '.kingster-top-bar{ padding-bottom: #gdlr#; }' .
							'.kingster-top-bar .kingster-top-bar-menu > li > a{ padding-bottom: #gdlr#; }' .  
							'.sf-menu.kingster-top-bar-menu > .kingster-mega-menu .sf-mega, .sf-menu.kingster-top-bar-menu > .kingster-normal-menu ul{ margin-top: #gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-text-size' => array(
						'title' => esc_html__('Top Bar Text Size', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.kingster-top-bar{ font-size: #gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-bottom-border' => array(
						'title' => esc_html__('Top Bar Bottom Border', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '10',
						'default' => '0',
						'selector' => '.kingster-top-bar{ border-bottom-width: #gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),

				)
			), // top bar

			'top-bar-social' => array(
				'title' => esc_html__('Top Bar Social', 'kingster'),
				'options' => array(
					'enable-top-bar-social' => array(
						'title' => esc_html__('Enable Top Bar Social', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'top-bar-social-delicious' => array(
						'title' => esc_html__('Top Bar Social Delicious Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-email' => array(
						'title' => esc_html__('Top Bar Social Email Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-deviantart' => array(
						'title' => esc_html__('Top Bar Social Deviantart Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-digg' => array(
						'title' => esc_html__('Top Bar Social Digg Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-facebook' => array(
						'title' => esc_html__('Top Bar Social Facebook Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-flickr' => array(
						'title' => esc_html__('Top Bar Social Flickr Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-google-plus' => array(
						'title' => esc_html__('Top Bar Social Google Plus Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-lastfm' => array(
						'title' => esc_html__('Top Bar Social Lastfm Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-linkedin' => array(
						'title' => esc_html__('Top Bar Social Linkedin Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-pinterest' => array(
						'title' => esc_html__('Top Bar Social Pinterest Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-rss' => array(
						'title' => esc_html__('Top Bar Social RSS Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-skype' => array(
						'title' => esc_html__('Top Bar Social Skype Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-stumbleupon' => array(
						'title' => esc_html__('Top Bar Social Stumbleupon Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-tumblr' => array(
						'title' => esc_html__('Top Bar Social Tumblr Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-twitter' => array(
						'title' => esc_html__('Top Bar Social Twitter Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-vimeo' => array(
						'title' => esc_html__('Top Bar Social Vimeo Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-youtube' => array(
						'title' => esc_html__('Top Bar Social Youtube Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-instagram' => array(
						'title' => esc_html__('Top Bar Social Instagram Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-snapchat' => array(
						'title' => esc_html__('Top Bar Social Snapchat Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),

				)
			),			

			'header' => array(
				'title' => esc_html__('Header', 'kingster'),
				'options' => array(

					'header-style' => array(
						'title' => esc_html__('Header Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'plain' => esc_html__('Plain', 'kingster'),
							'bar' => esc_html__('Bar', 'kingster'),
							'boxed' => esc_html__('Boxed', 'kingster'),
							'side' => esc_html__('Side Menu', 'kingster'),
							'side-toggle' => esc_html__('Side Menu Toggle', 'kingster'),
						),
						'default' => 'plain',
					),
					'header-plain-style' => array(
						'title' => esc_html__('Header Plain Style', 'kingster'),
						'type' => 'radioimage',
						'options' => array(
							'menu-right' => get_template_directory_uri() . '/images/header/plain-menu-right.jpg',
							'center-logo' => get_template_directory_uri() . '/images/header/plain-center-logo.jpg',
							'center-menu' => get_template_directory_uri() . '/images/header/plain-center-menu.jpg',
							'splitted-menu' => get_template_directory_uri() . '/images/header/plain-splitted-menu.jpg',
						),
						'default' => 'menu-right',
						'condition' => array( 'header-style' => 'plain' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'header-plain-bottom-shadow' => array(
						'title' => esc_html__('Header Bottom Shadow', 'kingster'),
						'type' => 'checkbox',
						'default' => 'disable',
						'condition' => array( 'header-style' => 'plain' )
					),
					'header-plain-bottom-border' => array(
						'title' => esc_html__('Plain Header Bottom Border', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '10',
						'default' => '0',
						'selector' => '.kingster-header-style-plain{ border-bottom-width: #gdlr#; }',
						'condition' => array( 'header-style' => array('plain') )
					),
					'header-bar-navigation-align' => array(
						'title' => esc_html__('Header Bar Style', 'kingster'),
						'type' => 'radioimage',
						'options' => array(
							'left' => get_template_directory_uri() . '/images/header/bar-left.jpg',
							'center' => get_template_directory_uri() . '/images/header/bar-center.jpg',
							'center-logo' => get_template_directory_uri() . '/images/header/bar-center-logo.jpg',
						),
						'default' => 'center',
						'condition' => array( 'header-style' => 'bar' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'header-background-style' => array(
						'title' => esc_html__('Header/Navigation Background Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'solid' => esc_html__('Solid', 'kingster'),
							'transparent' => esc_html__('Transparent', 'kingster'),
						),
						'default' => 'solid',
						'condition' => array( 'header-style' => array('plain', 'bar') )
					),
					'top-bar-background-opacity' => array(
						'title' => esc_html__('Top Bar Background Opacity', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '50',
						'condition' => array( 'header-style' => 'plain', 'header-background-style' => 'transparent' ),
						'selector' => '.kingster-header-background-transparent .kingster-top-bar-background{ opacity: #gdlr#; }'
					),
					'header-background-opacity' => array(
						'title' => esc_html__('Header Background Opacity', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '50',
						'condition' => array( 'header-style' => 'plain', 'header-background-style' => 'transparent' ),
						'selector' => '.kingster-header-background-transparent .kingster-header-background{ opacity: #gdlr#; }'
					),
					'navigation-background-opacity' => array(
						'title' => esc_html__('Navigation Background Opacity', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '50',
						'condition' => array( 'header-style' => 'bar', 'header-background-style' => 'transparent' ),
						'selector' => '.kingster-navigation-bar-wrap.kingster-style-transparent .kingster-navigation-background{ opacity: #gdlr#; }'
					),
					'header-boxed-style' => array(
						'title' => esc_html__('Header Boxed Style', 'kingster'),
						'type' => 'radioimage',
						'options' => array(
							'menu-right' => get_template_directory_uri() . '/images/header/boxed-menu-right.jpg',
							'center-menu' => get_template_directory_uri() . '/images/header/boxed-center-menu.jpg',
							'splitted-menu' => get_template_directory_uri() . '/images/header/boxed-splitted-menu.jpg',
						),
						'default' => 'menu-right',
						'condition' => array( 'header-style' => 'boxed' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'boxed-top-bar-background-opacity' => array(
						'title' => esc_html__('Top Bar Background Opacity', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '0',
						'condition' => array( 'header-style' => 'boxed' ),
						'selector' => '.kingster-header-boxed-wrap .kingster-top-bar-background{ opacity: #gdlr#; }'
					),
					'boxed-top-bar-background-extend' => array(
						'title' => esc_html__('Top Bar Background Extend ( Bottom )', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0px',
						'data-max' => '200px',
						'default' => '0px',
						'condition' => array( 'header-style' => 'boxed' ),
						'selector' => '.kingster-header-boxed-wrap .kingster-top-bar-background{ margin-bottom: -#gdlr#; }'
					),
					'boxed-header-top-margin' => array(
						'title' => esc_html__('Header Top Margin', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0px',
						'data-max' => '200px',
						'default' => '0px',
						'condition' => array( 'header-style' => 'boxed' ),
						'selector' => '.kingster-header-style-boxed{ margin-top: #gdlr#; }'
					),
					'header-side-style' => array(
						'title' => esc_html__('Header Side Style', 'kingster'),
						'type' => 'radioimage',
						'options' => array(
							'top-left' => get_template_directory_uri() . '/images/header/side-top-left.jpg',
							'middle-left' => get_template_directory_uri() . '/images/header/side-middle-left.jpg',
							'middle-left-2' => get_template_directory_uri() . '/images/header/side-middle-left-2.jpg',
							'top-right' => get_template_directory_uri() . '/images/header/side-top-right.jpg',
							'middle-right' => get_template_directory_uri() . '/images/header/side-middle-right.jpg',
							'middle-right-2' => get_template_directory_uri() . '/images/header/side-middle-right-2.jpg',
						),
						'default' => 'top-left',
						'condition' => array( 'header-style' => 'side' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'header-side-align' => array(
						'title' => esc_html__('Header Side Text Align', 'kingster'),
						'type' => 'radioimage',
						'options' => 'text-align',
						'default' => 'left',
						'condition' => array( 'header-style' => 'side' )
					),
					'header-side-toggle-style' => array(
						'title' => esc_html__('Header Side Toggle Style', 'kingster'),
						'type' => 'radioimage',
						'options' => array(
							'left' => get_template_directory_uri() . '/images/header/side-toggle-left.jpg',
							'right' => get_template_directory_uri() . '/images/header/side-toggle-right.jpg',
						),
						'default' => 'left',
						'condition' => array( 'header-style' => 'side-toggle' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'header-side-toggle-menu-type' => array(
						'title' => esc_html__('Header Side Toggle Menu Type', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'left' => esc_html__('Left Slide Menu', 'kingster'),
							'right' => esc_html__('Right Slide Menu', 'kingster'),
							'overlay' => esc_html__('Overlay Menu', 'kingster'),
						),
						'default' => 'overlay',
						'condition' => array( 'header-style' => 'side-toggle' )
					),
					'header-side-toggle-display-logo' => array(
						'title' => esc_html__('Display Logo', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'header-style' => 'side-toggle' )
					),
					'header-width' => array(
						'title' => esc_html__('Header Width', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'boxed' => esc_html__('Boxed ( Within Container )', 'kingster'),
							'full' => esc_html__('Full', 'kingster'),
							'custom' => esc_html__('Custom', 'kingster'),
						),
						'condition' => array('header-style'=> array('plain', 'bar', 'boxed'))
					),
					'header-width-pixel' => array(
						'title' => esc_html__('Header Width Pixel', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'default' => '1140px',
						'condition' => array('header-style'=> array('plain', 'bar', 'boxed'), 'header-width' => 'custom'),
						'selector' => '.kingster-header-container.kingster-header-custom-container{ max-width: #gdlr#; }'
					),
					'header-full-side-padding' => array(
						'title' => esc_html__('Header Full ( Left/Right ) Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.kingster-header-container.kingster-header-full{ padding-right: #gdlr#; padding-left: #gdlr#; }',
						'condition' => array('header-style'=> array('plain', 'bar', 'boxed'), 'header-width'=>'full')
					),
					'boxed-header-frame-radius' => array(
						'title' => esc_html__('Header Frame Radius', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '3px',
						'condition' => array( 'header-style' => 'boxed' ),
						'selector' => '.kingster-header-boxed-wrap .kingster-header-background{ border-radius: #gdlr#; -moz-border-radius: #gdlr#; -webkit-border-radius: #gdlr#; }'
					),
					'boxed-header-content-padding' => array(
						'title' => esc_html__('Header Content ( Left/Right ) Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '30px',
						'selector' => '.kingster-header-style-boxed .kingster-header-container-item{ padding-left: #gdlr#; padding-right: #gdlr#; }' . 
							'.kingster-navigation-right{ right: #gdlr#; } .kingster-navigation-left{ left: #gdlr#; }',
						'condition' => array( 'header-style' => 'boxed' )
					),
					'navigation-text-top-margin' => array(
						'title' => esc_html__('Navigation Text Top Padding', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '0px',
						'condition' => array( 'header-style' => 'plain', 'header-plain-style' => 'splitted-menu' ),
						'selector' => '.kingster-header-style-plain.kingster-style-splitted-menu .kingster-navigation .sf-menu > li > a{ padding-top: #gdlr#; } ' .
							'.kingster-header-style-plain.kingster-style-splitted-menu .kingster-main-menu-left-wrap,' .
							'.kingster-header-style-plain.kingster-style-splitted-menu .kingster-main-menu-right-wrap{ padding-top: #gdlr#; }'
					),
					'navigation-text-top-margin-boxed' => array(
						'title' => esc_html__('Navigation Text Top Padding', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '0px',
						'condition' => array( 'header-style' => 'boxed', 'header-boxed-style' => 'splitted-menu' ),
						'selector' => '.kingster-header-style-boxed.kingster-style-splitted-menu .kingster-navigation .sf-menu > li > a{ padding-top: #gdlr#; } ' .
							'.kingster-header-style-boxed.kingster-style-splitted-menu .kingster-main-menu-left-wrap,' .
							'.kingster-header-style-boxed.kingster-style-splitted-menu .kingster-main-menu-right-wrap{ padding-top: #gdlr#; }'
					),
					'navigation-text-side-spacing' => array(
						'title' => esc_html__('Navigation Text Side ( Left / Right ) Spaces', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '30',
						'data-type' => 'pixel',
						'default' => '13px',
						'selector' => '.kingster-navigation .sf-menu > li{ padding-left: #gdlr#; padding-right: #gdlr#; }',
						'condition' => array( 'header-style' => array('plain', 'bar', 'boxed') )
					),
					'navigation-left-offset' => array(
						'title' => esc_html__('Navigation Left Offset Spaces', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '0',
						'selector' => '.kingster-navigation .kingster-main-menu{ margin-left: #gdlr#; }'
					),
					'navigation-slide-bar' => array(
						'title' => esc_html__('Navigation Slide Bar', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'header-style' => array('plain', 'bar', 'boxed') )
					),
					'side-header-width-pixel' => array(
						'title' => esc_html__('Header Width Pixel', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '600',
						'default' => '340px',
						'condition' => array('header-style' => array('side', 'side-toggle')),
						'selector' => '.kingster-header-side-nav{ width: #gdlr#; }' . 
							'.kingster-header-side-content.kingster-style-left{ margin-left: #gdlr#; }' .
							'.kingster-header-side-content.kingster-style-right{ margin-right: #gdlr#; }'
					),
					'side-header-side-padding' => array(
						'title' => esc_html__('Header Side Padding', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '70px',
						'condition' => array('header-style' => 'side'),
						'selector' => '.kingster-header-side-nav.kingster-style-side{ padding-left: #gdlr#; padding-right: #gdlr#; }' . 
							'.kingster-header-side-nav.kingster-style-left .sf-vertical > li > ul.sub-menu{ padding-left: #gdlr#; }' .
							'.kingster-header-side-nav.kingster-style-right .sf-vertical > li > ul.sub-menu{ padding-right: #gdlr#; }'
					),
					'navigation-text-top-spacing' => array(
						'title' => esc_html__('Navigation Text Top / Bottom Spaces', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '40',
						'data-type' => 'pixel',
						'default' => '16px',
						'selector' => ' .kingster-navigation .sf-vertical > li{ padding-top: #gdlr#; padding-bottom: #gdlr#; }',
						'condition' => array( 'header-style' => array('side') )
					),
					'logo-right-text' => array(
						'title' => esc_html__('Header Right Text', 'kingster'),
						'type' => 'textarea',
						'condition' => array('header-style' => 'bar'),
					),
					'logo-right-text-top-padding' => array(
						'title' => esc_html__('Header Right Text Top Padding', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '30px',
						'condition' => array('header-style' => 'bar'),
						'selector' => '.kingster-header-style-bar .kingster-logo-right-text{ padding-top: #gdlr#; }'
					),

				)
			), // header
			
			'logo' => array(
				'title' => esc_html__('Logo', 'kingster'),
				'options' => array(
					'logo' => array(
						'title' => esc_html__('Logo', 'kingster'),
						'type' => 'upload'
					),
					'logo-top-padding' => array(
						'title' => esc_html__('Logo Top Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '20px',
						'selector' => '.kingster-logo{ padding-top: #gdlr#; }',
						'description' => esc_html__('This option will be omitted on splitted menu option.', 'kingster'),
					),
					'logo-bottom-padding' => array(
						'title' => esc_html__('Logo Bottom Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '20px',
						'selector' => '.kingster-logo{ padding-bottom: #gdlr#; }',
						'description' => esc_html__('This option will be omitted on splitted menu option.', 'kingster'),
					),
					'logo-left-padding' => array(
						'title' => esc_html__('Logo Left Padding', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.kingster-logo.kingster-item-pdlr{ padding-left: #gdlr#; }',
						'description' => esc_html__('Leave this field blank for default value.', 'kingster'),
					),
					'max-logo-width' => array(
						'title' => esc_html__('Max Logo Width', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '200px',
						'selector' => '.kingster-logo-inner{ max-width: #gdlr#; }'
					),

					'mobile-logo' => array(
						'title' => esc_html__('Mobile/Tablet Logo', 'kingster'),
						'type' => 'upload',
						'description' => esc_html__('Leave this option blank to use the same logo.', 'kingster'),
					),
					'max-tablet-logo-width' => array(
						'title' => esc_html__('Max Tablet Logo Width', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '@media only screen and (max-width: 1260px){ .kingster-mobile-header .kingster-logo-inner{ max-width: #gdlr#; } }'
					),
					'max-mobile-logo-width' => array(
						'title' => esc_html__('Max Mobile Logo Width', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '@media only screen and (max-width: 767px){ .kingster-mobile-header .kingster-logo-inner{ max-width: #gdlr#; } }'
					),
					'mobile-logo-position' => array(
						'title' => esc_html__('Mobile Logo Position', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'logo-left' => esc_html__('Logo Left', 'kingster'),
							'logo-center' => esc_html__('Logo Center', 'kingster'),
							'logo-right' => esc_html__('Logo Right', 'kingster'),
						)
					),
				
				)
			),
			'navigation' => array(
				'title' => esc_html__('Navigation', 'kingster'),
				'options' => array(
					'main-navigation-top-padding' => array(
						'title' => esc_html__('Main Navigation Top Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '25px',
						'selector' => '.kingster-navigation{ padding-top: #gdlr#; }' . 
							'.kingster-navigation-top{ top: #gdlr#; }'
					),
					'main-navigation-bottom-padding' => array(
						'title' => esc_html__('Main Navigation Bottom Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '20px',
						'selector' => '.kingster-navigation .sf-menu > li > a{ padding-bottom: #gdlr#; }'
					),
					'main-navigation-item-right-padding' => array(
						'title' => esc_html__('Main Navigation Item Right Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '0px',
						'selector' => '.kingster-navigation .kingster-main-menu{ padding-right: #gdlr#; }'
					),
					'main-navigation-right-padding' => array(
						'title' => esc_html__('Main Navigation Wrap Right Padding', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.kingster-navigation.kingster-item-pdlr{ padding-right: #gdlr#; }',
						'description' => esc_html__('Leave this field blank for default value.', 'kingster'),
					),
					'enable-main-navigation-submenu-indicator' => array(
						'title' => esc_html__('Enable Main Navigation Submenu Indicator', 'kingster'),
						'type' => 'checkbox',
						'default' => 'disable',
					),
					'navigation-right-top-margin' => array(
						'title' => esc_html__('Navigation Right ( search/cart/button ) Top Margin ', 'kingster'),
						'type' => 'text',
						'data-input-type' => 'pixel',
						'data-type' => 'pixel',
						'selector' => '.kingster-main-menu-right-wrap{ margin-top: #gdlr#; }'
					),
					'enable-main-navigation-search' => array(
						'title' => esc_html__('Enable Main Navigation Search', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
					),
					'enable-main-navigation-cart' => array(
						'title' => esc_html__('Enable Main Navigation Cart ( Woocommerce )', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
						'description' => esc_html__('The icon only shows if the woocommerce plugin is activated', 'kingster')
					),
					'enable-main-navigation-right-button' => array(
						'title' => esc_html__('Enable Main Navigation Right Button', 'kingster'),
						'type' => 'checkbox',
						'default' => 'disable',
						'description' => esc_html__('This option will be ignored on header side style', 'kingster')
					),
					'main-navigation-right-button-style' => array(
						'title' => esc_html__('Main Navigation Right Button Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'default' => esc_html__('Default', 'kingster'),
							'round' => esc_html__('Round', 'kingster'),
							'round-with-shadow' => esc_html__('Round With Shadow', 'kingster'),
						),
						'condition' => array( 'enable-main-navigation-right-button' => 'enable' ) 
					),
					'main-navigation-right-button-text' => array(
						'title' => esc_html__('Main Navigation Right Button Text', 'kingster'),
						'type' => 'text',
						'default' => esc_html__('Buy Now', 'kingster'),
						'condition' => array( 'enable-main-navigation-right-button' => 'enable' ) 
					),
					'main-navigation-right-button-link' => array(
						'title' => esc_html__('Main Navigation Right Button Link', 'kingster'),
						'type' => 'text',
						'condition' => array( 'enable-main-navigation-right-button' => 'enable' ) 
					),
					'main-navigation-right-button-link-target' => array(
						'title' => esc_html__('Main Navigation Right Button Link Target', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'_self' => esc_html__('Current Screen', 'kingster'),
							'_blank' => esc_html__('New Window', 'kingster'),
						),
						'condition' => array( 'enable-main-navigation-right-button' => 'enable' ) 
					),
					'right-menu-type' => array(
						'title' => esc_html__('Secondary/Mobile Menu Type', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'left' => esc_html__('Left Slide Menu', 'kingster'),
							'right' => esc_html__('Right Slide Menu', 'kingster'),
							'overlay' => esc_html__('Overlay Menu', 'kingster'),
						),
						'default' => 'right'
					),
					'right-menu-style' => array(
						'title' => esc_html__('Secondary/Mobile Menu Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'hamburger-with-border' => esc_html__('Hamburger With Border', 'kingster'),
							'hamburger' => esc_html__('Hamburger', 'kingster'),
						),
						'default' => 'hamburger-with-border'
					),
					
				) // logo-options
			), // logo-navigation			
			
			'fixed-navigation' => array(
				'title' => esc_html__('Fixed Navigation', 'kingster'),
				'options' => array(

					'enable-main-navigation-sticky' => array(
						'title' => esc_html__('Enable Fixed Navigation Bar', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
					),
					'enable-logo-on-main-navigation-sticky' => array(
						'title' => esc_html__('Enable Logo on Fixed Navigation Bar', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' )
					),
					'fixed-navigation-bar-logo' => array(
						'title' => esc_html__('Fixed Navigation Bar Logo', 'kingster'),
						'type' => 'upload',
						'description' => esc_html__('Leave blank to show default logo', 'kingster'),
						'condition' => array( 'enable-main-navigation-sticky' => 'enable', 'enable-logo-on-main-navigation-sticky' => 'enable' )
					),
					'fixed-navigation-max-logo-width' => array(
						'title' => esc_html__('Fixed Navigation Max Logo Width', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' ),
						'selector' => '.kingster-fixed-navigation.kingster-style-slide .kingster-logo-inner img{ max-height: none !important; }' .
							'.kingster-animate-fixed-navigation.kingster-header-style-plain .kingster-logo-inner, ' . 
							'.kingster-animate-fixed-navigation.kingster-header-style-boxed .kingster-logo-inner{ max-width: #gdlr#; }'
					),
					'fixed-navigation-logo-top-padding' => array(
						'title' => esc_html__('Fixed Navigation Logo Top Padding', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '20px',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' ),
						'selector' => '.kingster-animate-fixed-navigation.kingster-header-style-plain .kingster-logo, ' . 
							'.kingster-animate-fixed-navigation.kingster-header-style-boxed .kingster-logo{ padding-top: #gdlr#; }'
					),
					'fixed-navigation-logo-bottom-padding' => array(
						'title' => esc_html__('Fixed Navigation Logo Bottom Padding', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '20px',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' ),
						'selector' => '.kingster-animate-fixed-navigation.kingster-header-style-plain .kingster-logo, ' . 
							'.kingster-animate-fixed-navigation.kingster-header-style-boxed .kingster-logo{ padding-bottom: #gdlr#; }'
					),
					'fixed-navigation-top-padding' => array(
						'title' => esc_html__('Fixed Navigation Top Padding', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '30px',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' ),
						'selector' => '.kingster-animate-fixed-navigation.kingster-header-style-plain .kingster-navigation, ' . 
							'.kingster-animate-fixed-navigation.kingster-header-style-boxed .kingster-navigation{ padding-top: #gdlr#; }' . 
							'.kingster-animate-fixed-navigation.kingster-header-style-plain .kingster-navigation-top, ' . 
							'.kingster-animate-fixed-navigation.kingster-header-style-boxed .kingster-navigation-top{ top: #gdlr#; }'
					),
					'fixed-navigation-bottom-padding' => array(
						'title' => esc_html__('Fixed Navigation Bottom Padding', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '25px',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' ),
						'selector' => '.kingster-animate-fixed-navigation.kingster-header-style-plain .kingster-navigation .sf-menu > li > a, ' . 
							'.kingster-animate-fixed-navigation.kingster-header-style-boxed .kingster-navigation .sf-menu > li > a{ padding-bottom: #gdlr#; }'
					),
					'fixed-navigation-anchor-offset' => array(
						'title' => esc_html__('Fixed Navigation Anchor Offset ( Fixed Navigation Height )', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '75px',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' ),
					),
					'enable-mobile-navigation-sticky' => array(
						'title' => esc_html__('Enable Mobile Fixed Navigation Bar', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
					),

				)
			),

			'title-style' => array(
				'title' => esc_html__('Page Title Style', 'kingster'),
				'options' => array(
					'enable-breadcrumbs' => array(
						'title' => esc_html__('Enable Breadcrumbs (Breadcrumb NavXT Plugin)', 'kingster'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
					'breadcrumbs-top-padding' => array(
						'title' => esc_html__('Breadcrumbs Top Padding', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '25px',
						'selector' => '.kingster-breadcrumbs{ padding-top: #gdlr#; }'
					),
					'breadcrumbs-bottom-padding' => array(
						'title' => esc_html__('Breadcrumbs Bottom Padding', 'kingster'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '25px',
						'selector' => '.kingster-breadcrumbs{ padding-bottom: #gdlr#; }'
					),
					'default-title-style' => array(
						'title' => esc_html__('Default Page Title Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'small' => esc_html__('Small', 'kingster'),
							'medium' => esc_html__('Medium', 'kingster'),
							'large' => esc_html__('Large', 'kingster'),
							'custom' => esc_html__('Custom', 'kingster'),
						),
						'default' => 'small'
					),
					'default-title-align' => array(
						'title' => esc_html__('Default Page Title Alignment', 'kingster'),
						'type' => 'radioimage',
						'options' => 'text-align',
						'default' => 'left'
					),
					'default-title-top-padding' => array(
						'title' => esc_html__('Default Page Title Top Padding', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '350',
						'default' => '93px',
						'selector' => '.kingster-page-title-wrap.kingster-style-custom .kingster-page-title-content{ padding-top: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-title-bottom-padding' => array(
						'title' => esc_html__('Default Page Title Bottom Padding', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '350',
						'default' => '87px',
						'selector' => '.kingster-page-title-wrap.kingster-style-custom .kingster-page-title-content{ padding-bottom: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-page-caption-top-margin' => array(
						'title' => esc_html__('Default Page Caption Bottom Margin', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '13px',						
						'selector' => '.kingster-page-title-wrap.kingster-style-custom .kingster-page-caption{ margin-bottom: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-title-font-transform' => array(
						'title' => esc_html__('Default Page Title Font Transform', 'kingster'),
						'type' => 'combobox',
						'data-type' => 'text',
						'options' => array(
							'' => esc_html__('Default', 'kingster'),
							'none' => esc_html__('None', 'kingster'),
							'uppercase' => esc_html__('Uppercase', 'kingster'),
							'lowercase' => esc_html__('Lowercase', 'kingster'),
							'capitalize' => esc_html__('Capitalize', 'kingster'),
						),
						'default' => 'default',
						'selector' => '.kingster-page-title-wrap .kingster-page-title{ text-transform: #gdlr#; }'
					),
					'default-title-font-size' => array(
						'title' => esc_html__('Default Page Title Font Size', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '37px',
						'selector' => '.kingster-page-title-wrap.kingster-style-custom .kingster-page-title{ font-size: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-title-font-weight' => array(
						'title' => esc_html__('Default Page Title Font Weight', 'kingster'),
						'type' => 'text',
						'data-type' => 'text',
						'selector' => '.kingster-page-title-wrap .kingster-page-title{ font-weight: #gdlr#; }',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800. Leave this field blank for default value (700).', 'kingster')					
					),
					'default-title-letter-spacing' => array(
						'title' => esc_html__('Default Page Title Letter Spacing', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '20',
						'default' => '0px',
						'selector' => '.kingster-page-title-wrap.kingster-style-custom .kingster-page-title{ letter-spacing: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-caption-font-transform' => array(
						'title' => esc_html__('Default Page Caption Font Transform', 'kingster'),
						'type' => 'combobox',
						'data-type' => 'text',
						'options' => array(
							'' => esc_html__('Default', 'kingster'),
							'none' => esc_html__('None', 'kingster'),
							'uppercase' => esc_html__('Uppercase', 'kingster'),
							'lowercase' => esc_html__('Lowercase', 'kingster'),
							'capitalize' => esc_html__('Capitalize', 'kingster'),
						),
						'default' => 'default',
						'selector' => '.kingster-page-title-wrap .kingster-page-caption{ text-transform: #gdlr#; }'
					),
					'default-caption-font-size' => array(
						'title' => esc_html__('Default Page Caption Font Size', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '16px',
						'selector' => '.kingster-page-title-wrap.kingster-style-custom .kingster-page-caption{ font-size: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-caption-font-weight' => array(
						'title' => esc_html__('Default Page Caption Font Weight', 'kingster'),
						'type' => 'text',
						'data-type' => 'text',
						'selector' => '.kingster-page-title-wrap .kingster-page-caption{ font-weight: #gdlr#; }',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800. Leave this field blank for default value (400).', 'kingster')					
					),
					'default-caption-letter-spacing' => array(
						'title' => esc_html__('Default Page Caption Letter Spacing', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '20',
						'default' => '0px',
						'selector' => '.kingster-page-title-wrap.kingster-style-custom .kingster-page-caption{ letter-spacing: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'page-title-top-bottom-gradient' => array(
						'title' => esc_html__('Default Page Title Top/Bottom Gradient', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'both' => esc_html__('Both', 'kingster'),
							'top' => esc_html__('Top', 'kingster'),
							'bottom' => esc_html__('Bottom', 'kingster'),
							'none' => esc_html__('None', 'kingster'),
						),
						'default' => 'none',
					),
					'page-title-top-gradient-size' => array(
						'title' => esc_html__('Default Page Title Top Gradient Size', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '1000',
 						'default' => '413px',
						'selector' => '.kingster-page-title-wrap .kingster-page-title-top-gradient{ height: #gdlr#; }',
					),
					'page-title-bottom-gradient-size' => array(
						'title' => esc_html__('Default Page Title Bottom Gradient Size', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '1000',
 						'default' => '413px',
						'selector' => '.kingster-page-title-wrap .kingster-page-title-bottom-gradient{ height: #gdlr#; }',
					),
					'default-title-background-overlay-opacity' => array(
						'title' => esc_html__('Default Page Title Background Overlay Opacity', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '80',
						'selector' => '.kingster-page-title-wrap .kingster-page-title-overlay{ opacity: #gdlr#; }'
					),
				) 
			), // title style

			'title-background' => array(
				'title' => esc_html__('Page Title Background', 'kingster'),
				'options' => array(

					'enable-default-title-background' => array(
						'title' => esc_html__('Enable Default Title Background', 'kingster'),
						'type' => 'checkbox'
					),
					'default-title-background' => array(
						'title' => esc_html__('Default Title Background', 'kingster'),
						'type' => 'upload',
						'data-type' => 'file',
						'condition' => array('enable-default-title-background' => 'enable')
					),
					'default-portfolio-title-background' => array(
						'title' => esc_html__('Default Portfolio Title Background', 'kingster'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.single-portfolio .kingster-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-personnel-title-background' => array(
						'title' => esc_html__('Default Personnel Title Background', 'kingster'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.single-personnel .kingster-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-search-title-background' => array(
						'title' => esc_html__('Default Search Title Background', 'kingster'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.search .kingster-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-archive-title-background' => array(
						'title' => esc_html__('Default Archive Title Background', 'kingster'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.archive .kingster-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-404-background' => array(
						'title' => esc_html__('Default 404 Background', 'kingster'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => '.kingster-not-found-wrap .kingster-not-found-background{ background-image: url(#gdlr#); }'
					),
					'default-404-background-opacity' => array(
						'title' => esc_html__('Default 404 Background Opacity', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '27',
						'selector' => '.kingster-not-found-wrap .kingster-not-found-background{ opacity: #gdlr#; }'
					),

				) 
			), // title background

			'blog-title-style' => array(
				'title' => esc_html__('Blog Title Style', 'kingster'),
				'options' => array(

					'default-blog-title-style' => array(
						'title' => esc_html__('Default Blog Title Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'small' => esc_html__('Small', 'kingster'),
							'large' => esc_html__('Large', 'kingster'),
							'custom' => esc_html__('Custom', 'kingster'),
							'inside-content' => esc_html__('Inside Content', 'kingster'),
							'none' => esc_html__('None', 'kingster'),
						),
						'default' => 'small'
					),
					'default-blog-title-top-padding' => array(
						'title' => esc_html__('Default Blog Title Top Padding', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '400',
						'default' => '93px',
						'selector' => '.kingster-blog-title-wrap.kingster-style-custom .kingster-blog-title-content{ padding-top: #gdlr#; }',
						'condition' => array( 'default-blog-title-style' => 'custom' )
					),
					'default-blog-title-bottom-padding' => array(
						'title' => esc_html__('Default Blog Title Bottom Padding', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '400',
						'default' => '87px',
						'selector' => '.kingster-blog-title-wrap.kingster-style-custom .kingster-blog-title-content{ padding-bottom: #gdlr#; }',
						'condition' => array( 'default-blog-title-style' => 'custom' )
					),
					'default-blog-feature-image' => array(
						'title' => esc_html__('Default Blog Feature Image Location', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'content' => esc_html__('Inside Content', 'kingster'),
							'title-background' => esc_html__('Title Background', 'kingster'),
							'none' => esc_html__('None', 'kingster'),
						),
						'default' => 'content',
						'condition' => array( 'default-blog-title-style' => array('small', 'large', 'custom') )
					),
					'default-blog-title-background-image' => array(
						'title' => esc_html__('Default Blog Title Background Image', 'kingster'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => '.kingster-blog-title-wrap{ background-image: url(#gdlr#); }',
						'condition' => array( 'default-blog-title-style' => array('small', 'large', 'custom') )
					),
					'default-blog-top-bottom-gradient' => array(
						'title' => esc_html__('Default Blog ( Feature Image ) Title Top/Bottom Gradient', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'enable' => esc_html__('Both', 'kingster'),
							'top' => esc_html__('Top', 'kingster'),
							'bottom' => esc_html__('Bottom', 'kingster'),
							'disable' => esc_html__('None', 'kingster'),
						),
						'default' => 'enable',
					),
					'single-blog-title-top-gradient-size' => array(
						'title' => esc_html__('Single Blog Title Top Gradient Size', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '1000',
 						'default' => '413px',
						'selector' => '.kingster-blog-title-wrap.kingster-feature-image .kingster-blog-title-top-overlay{ height: #gdlr#; }',
					),
					'single-blog-title-bottom-gradient-size' => array(
						'title' => esc_html__('Single Blog Title Bottom Gradient Size', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '1000',
 						'default' => '413px',
						'selector' => '.kingster-blog-title-wrap.kingster-feature-image .kingster-blog-title-bottom-overlay{ height: #gdlr#; }',
					),
					'default-blog-title-background-overlay-opacity' => array(
						'title' => esc_html__('Default Blog Title Background Overlay Opacity', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '80',
						'selector' => '.kingster-blog-title-wrap .kingster-blog-title-overlay{ opacity: #gdlr#; }',
						'condition' => array( 'default-blog-title-style' => array('small', 'large', 'custom') )
					),

				) 
			), // post title style			

			'blog-style' => array(
				'title' => esc_html__('Blog Style', 'kingster'),
				'options' => array(
					'blog-style' => array(
						'title' => esc_html__('Single Blog Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'kingster'),
							'style-2' => esc_html__('Style 2', 'kingster'),
							'magazine' => esc_html__('Magazine', 'kingster')
						),
						'default' => 'style-1'
					),
					'blockquote-style' => array(
						'title' => esc_html__('Blockquote Style ( <blockquote> tag )', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'kingster'),
							'style-2' => esc_html__('Style 2', 'kingster')
						),
						'default' => 'style-1'
					),
					'blog-sidebar' => array(
						'title' => esc_html__('Single Blog Sidebar ( Default )', 'kingster'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'none',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'blog-sidebar-left' => array(
						'title' => esc_html__('Single Blog Sidebar Left ( Default )', 'kingster'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'blog-sidebar'=>array('left', 'both') )
					),
					'blog-sidebar-right' => array(
						'title' => esc_html__('Single Blog Sidebar Right ( Default )', 'kingster'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'blog-sidebar'=>array('right', 'both') )
					),
					'blog-max-content-width' => array(
						'title' => esc_html__('Single Blog Max Content Width ( No sidebar layout )', 'kingster'),
						'type' => 'text',
						'data-type' => 'text',
						'data-input-type' => 'pixel',
						'default' => '900px',
						'selector' => 'body.single-post .kingster-sidebar-style-none, body.blog .kingster-sidebar-style-none, ' . 
							'.kingster-blog-style-2 .kingster-comment-content{ max-width: #gdlr#; }'
					),
					'blog-thumbnail-size' => array(
						'title' => esc_html__('Single Blog Thumbnail Size', 'kingster'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'default' => 'full'
					),
					'blog-date-feature' => array(
						'title' => esc_html__('Enable Blog Date Feature', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'blog-style' => 'style-1' )
					),
					'blog-date-feature-year' => array(
						'title' => esc_html__('Enable Year on Blog Date Feature', 'kingster'),
						'type' => 'checkbox',
						'default' => 'disable',
						'condition' => array( 'blog-style' => 'style-1', 'blog-date-feature' => 'enable' )
					),
					'meta-option' => array(
						'title' => esc_html__('Meta Option', 'kingster'),
						'type' => 'multi-combobox',
						'options' => array( 
							'date' => esc_html__('Date', 'kingster'),
							'author' => esc_html__('Author', 'kingster'),
							'category' => esc_html__('Category', 'kingster'),
							'tag' => esc_html__('Tag', 'kingster'),
							'comment' => esc_html__('Comment', 'kingster'),
							'comment-number' => esc_html__('Comment Number', 'kingster'),
						),
						'default' => array('author', 'category', 'tag', 'comment-number')
					),
					'blog-author' => array(
						'title' => esc_html__('Enable Single Blog Author', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'blog-navigation' => array(
						'title' => esc_html__('Enable Single Blog Navigation', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'pagination-style' => array(
						'title' => esc_html__('Pagination Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'plain' => esc_html__('Plain', 'kingster'),
							'rectangle' => esc_html__('Rectangle', 'kingster'),
							'rectangle-border' => esc_html__('Rectangle Border', 'kingster'),
							'round' => esc_html__('Round', 'kingster'),
							'round-border' => esc_html__('Round Border', 'kingster'),
							'circle' => esc_html__('Circle', 'kingster'),
							'circle-border' => esc_html__('Circle Border', 'kingster'),
						),
						'default' => 'round'
					),
					'pagination-align' => array(
						'title' => esc_html__('Pagination Alignment', 'kingster'),
						'type' => 'radioimage',
						'options' => 'text-align',
						'default' => 'right'
					),
					'enable-related-post' => array(
						'title' => esc_html__('Enable Related Post', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array('blog-style' => array('style-2', 'magazine'))
					),
					'related-post-blog-style' => array(
						'title' => esc_html__('Related Post Blog Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'blog-column' => esc_html__('Blog Column', 'kingster'), 
							'blog-column-with-frame' => esc_html__('Blog Column With Frame', 'kingster'), 
						),
						'default' => 'blog-column-with-frame',
						'condition' => array('blog-style' => array('style-2', 'magazine'), 'enable-related-post'=>'enable')
					),
					'related-post-blog-column-style' => array(
						'title' => esc_html__('Related Post Blog Column Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'kingster'), 
							'style-2' => esc_html__('Style 2', 'kingster'), 
						),
						'default' => 'blog-column-with-frame',
						'condition' => array('blog-style' => array('style-2', 'magazine'), 'enable-related-post'=>'enable')
					),
					'related-post-column-size' => array(
						'title' => esc_html__('Related Post Column Size', 'kingster'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5 ),
						'default' => '20',
						'condition' => array('blog-style' => array('style-2', 'magazine'), 'enable-related-post'=>'enable')
					),
					'related-post-meta-option' => array(
						'title' => esc_html__('Related Post Meta Option', 'kingster'),
						'type' => 'multi-combobox',
						'options' => array(
							'date' => esc_html__('Date', 'kingster'),
							'author' => esc_html__('Author', 'kingster'),
							'category' => esc_html__('Category', 'kingster'),
							'tag' => esc_html__('Tag', 'kingster'),
							'comment' => esc_html__('Comment', 'kingster'),
							'comment-number' => esc_html__('Comment Number', 'kingster'),
						),
						'default' => array('date', 'author', 'category', 'comment-number'),
						'condition' => array('blog-style' => array('style-2', 'magazine'), 'enable-related-post'=>'enable')
					),
					'related-post-thumbnail-size' => array(
						'title' => esc_html__('Related Post Blog Thumbnail Size', 'kingster'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'default' => 'full',
						'condition' => array('blog-style' => array('style-2', 'magazine'), 'enable-related-post'=>'enable')
					),
					'related-post-num-fetch' => array(
						'title' => esc_html__('Related Post Num Fetch', 'kingster'),
						'type' => 'text',
						'default' => '3',
						'condition' => array('blog-style' => array('style-2', 'magazine'), 'enable-related-post'=>'enable')
					),
					'related-post-excerpt-number' => array(
						'title' => esc_html__('Related Post Excerpt Number', 'kingster'),
						'type' => 'text',
						'default' => '0',
						'condition' => array('blog-style' => array('style-2', 'magazine'), 'enable-related-post'=>'enable')
					),
				) // blog-style-options
			), // blog-style-nav

			'blog-social-share' => array(
				'title' => esc_html__('Blog Social Share', 'kingster'),
				'options' => array(
					'blog-social-share' => array(
						'title' => esc_html__('Enable Single Blog Share', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'blog-social-share-count' => array(
						'title' => esc_html__('Enable Single Blog Share Count', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'blog-social-facebook' => array(
						'title' => esc_html__('Facebook', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),			
					'blog-social-linkedin' => array(
						'title' => esc_html__('Linkedin', 'kingster'),
						'type' => 'checkbox',
						'default' => 'disable'
					),			
					'blog-social-google-plus' => array(
						'title' => esc_html__('Google Plus', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),			
					'blog-social-pinterest' => array(
						'title' => esc_html__('Pinterest', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),			
					'blog-social-stumbleupon' => array(
						'title' => esc_html__('Stumbleupon', 'kingster'),
						'type' => 'checkbox',
						'default' => 'disable'
					),			
					'blog-social-twitter' => array(
						'title' => esc_html__('Twitter', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),			
					'blog-social-email' => array(
						'title' => esc_html__('Email', 'kingster'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
				) // blog-style-options
			), // blog-style-nav
			
			'event' => array(
				'title' => esc_html__('Event', 'kingster'),
				'options' => array(
					'default-event-title-background' => array(
						'title' => esc_html__('Default Event Title Background', 'kingster'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.single-event .kingster-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-event-sidebar' => array(
						'title' => esc_html__('Default Event Sidebar', 'kingster'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'none',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'default-event-sidebar-left' => array(
						'title' => esc_html__('Default Event Sidebar Left', 'kingster'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'default-event-sidebar'=>array('left', 'both') )
					),
					'default-event-sidebar-right' => array(
						'title' => esc_html__('Default Event Sidebar Right', 'kingster'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'default-event-sidebar'=>array('right', 'both') )
					),
				)
			),

			'course' => array(
				'title' => esc_html__('Course', 'kingster'),
				'options' => array(
					'course-search-page' => array(
						'title' => esc_html__('Select Course Search Page', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'' => esc_html__('None', 'kingster')
						) +  gdlr_core_get_post_list('page')
					),
					'course-search-num-fetch' => array(
						'title' => esc_html__('(Search Page) Course Item Num Fetch', 'kingster'),
						'type' => 'text',
						'default' => 9
					),
					'course-search-info' => array(
						'title' => esc_html__('(Search Page) Course Item Info', 'kingster'),
						'type' => 'multi-combobox',
						'options' => $course_info
					),
					'course-search-item-fields' => array(
						'title' => esc_html__('(Search Page) Course Search Item fields', 'kingster'),
						'type' => 'multi-combobox',
						'options' => array(
							'keywords' => esc_html__('Keywords', 'kingster'),
							'course-id' => esc_html__('Course ID', 'kingster'),
							'course_category' => esc_html__('Course Category', 'kingster'),
							'course_tag' => esc_html__('Course Tag', 'kingster')
						) + $course_info
					),
					'course-search-title-color' => array(
						'title' => esc_html__('(Search Page) Course Search Item Title Color', 'kingster'),
						'type' => 'colorpicker',
					),
					'course-search-frame-background' => array(
						'title' => esc_html__('(Search Page) Course Search Item Frame Background', 'kingster'),
						'type' => 'upload'
					),
				)
			),

			'search-archive' => array(
				'title' => esc_html__('Search/Archive', 'kingster'),
				'options' => array(
					'archive-blog-sidebar' => array(
						'title' => esc_html__('Archive Blog Sidebar', 'kingster'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'right',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'archive-blog-sidebar-left' => array(
						'title' => esc_html__('Archive Blog Sidebar Left', 'kingster'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'archive-blog-sidebar'=>array('left', 'both') )
					),
					'archive-blog-sidebar-right' => array(
						'title' => esc_html__('Archive Blog Sidebar Right', 'kingster'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'archive-blog-sidebar'=>array('right', 'both') )
					),
					'archive-blog-style' => array(
						'title' => esc_html__('Archive Blog Style', 'kingster'),
						'type' => 'radioimage',
						'options' => array(
							'blog-full' => GDLR_CORE_URL . '/include/images/blog-style/blog-full.png',
							'blog-full-with-frame' => GDLR_CORE_URL . '/include/images/blog-style/blog-full-with-frame.png',
							'blog-column' => GDLR_CORE_URL . '/include/images/blog-style/blog-column.png',
							'blog-column-with-frame' => GDLR_CORE_URL . '/include/images/blog-style/blog-column-with-frame.png',
							'blog-column-no-space' => GDLR_CORE_URL . '/include/images/blog-style/blog-column-no-space.png',
							'blog-image' => GDLR_CORE_URL . '/include/images/blog-style/blog-image.png',
							'blog-image-no-space' => GDLR_CORE_URL . '/include/images/blog-style/blog-image-no-space.png',
							'blog-left-thumbnail' => GDLR_CORE_URL . '/include/images/blog-style/blog-left-thumbnail.png',
							'blog-right-thumbnail' => GDLR_CORE_URL . '/include/images/blog-style/blog-right-thumbnail.png',
						),
						'default' => 'blog-full',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'archive-blog-full-style' => array(
						'title' => esc_html__('Blog Full Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'kingster'),
							'style-2' => esc_html__('Style 2', 'kingster'),
						),
						'condition' => array( 'archive-blog-style'=>array('blog-full', 'blog-full-with-frame') )
					),
					'archive-blog-side-thumbnail-style' => array(
						'title' => esc_html__('Blog Side Thumbnail Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'kingster'),
							'style-1-large' => esc_html__('Style 1 Large Thumbnail', 'kingster'),
							'style-2' => esc_html__('Style 2', 'kingster'),
							'style-2-large' => esc_html__('Style 2 Large Thumbnail', 'kingster'),
						),
						'condition' => array( 'archive-blog-style'=>array('blog-left-thumbnail', 'blog-right-thumbnail') )
					),
					'archive-blog-column-style' => array(
						'title' => esc_html__('Blog Column Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'kingster'),
							'style-2' => esc_html__('Style 2', 'kingster'),
						),
						'condition' => array( 'archive-blog-style'=>array('blog-column', 'blog-column-with-frame', 'blog-column-no-space') )
					),
					'archive-blog-image-style' => array(
						'title' => esc_html__('Blog Image Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'kingster'),
							'style-2' => esc_html__('Style 2', 'kingster'),
						),
						'condition' => array( 'archive-blog-style'=>array('blog-image', 'blog-image-no-space') )
					),
					'archive-blog-full-alignment' => array(
						'title' => esc_html__('Archive Blog Full Alignment', 'kingster'),
						'type' => 'combobox',
						'default' => 'enable',
						'options' => array(
							'left' => esc_html__('Left', 'kingster'),
							'center' => esc_html__('Center', 'kingster'),
						),
						'condition' => array( 'archive-blog-style' => array('blog-full', 'blog-full-with-frame') )
					),
					'archive-thumbnail-size' => array(
						'title' => esc_html__('Archive Thumbnail Size', 'kingster'),
						'type' => 'combobox',
						'options' => 'thumbnail-size'
					),
					'archive-show-thumbnail' => array(
						'title' => esc_html__('Archive Show Thumbnail', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-column', 'blog-column-with-frame', 'blog-column-no-space', 'blog-left-thumbnail', 'blog-right-thumbnail') )
					),
					'archive-column-size' => array(
						'title' => esc_html__('Archive Column Size', 'kingster'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5 ),
						'default' => 20,
						'condition' => array( 'archive-blog-style' => array('blog-column', 'blog-column-with-frame', 'blog-column-no-space', 'blog-image', 'blog-image-no-space') )
					),
					'archive-excerpt' => array(
						'title' => esc_html__('Archive Excerpt Type', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'specify-number' => esc_html__('Specify Number', 'kingster'),
							'show-all' => esc_html__('Show All ( use <!--more--> tag to cut the content )', 'kingster'),
						),
						'default' => 'specify-number',
						'condition' => array('archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-column', 'blog-column-with-frame', 'blog-column-no-space', 'blog-left-thumbnail', 'blog-right-thumbnail'))
					),
					'archive-excerpt-number' => array(
						'title' => esc_html__('Archive Excerpt Number', 'kingster'),
						'type' => 'text',
						'default' => 55,
						'data-input-type' => 'number',
						'condition' => array('archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-column', 'blog-column-with-frame', 'blog-column-no-space', 'blog-left-thumbnail', 'blog-right-thumbnail'), 'archive-excerpt' => 'specify-number')
					),
					'archive-date-feature' => array(
						'title' => esc_html__('Enable Blog Date Feature', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-left-thumbnail', 'blog-right-thumbnail') )
					),
					'archive-meta-option' => array(
						'title' => esc_html__('Archive Meta Option', 'kingster'),
						'type' => 'multi-combobox',
						'options' => array( 
							'date' => esc_html__('Date', 'kingster'),
							'author' => esc_html__('Author', 'kingster'),
							'category' => esc_html__('Category', 'kingster'),
							'tag' => esc_html__('Tag', 'kingster'),
							'comment' => esc_html__('Comment', 'kingster'),
							'comment-number' => esc_html__('Comment Number', 'kingster'),
						),
						'default' => array('date', 'author', 'category')
					),
					'archive-show-read-more' => array(
						'title' => esc_html__('Archive Show Read More Button', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array('archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-left-thumbnail', 'blog-right-thumbnail'),)
					),
					'archive-blog-title-font-size' => array(
						'title' => esc_html__('Blog Title Font Size', 'kingster'),
						'type' => 'text',
						'data-input-type' => 'pixel',
					),
					'archive-blog-title-font-weight' => array(
						'title' => esc_html__('Blog Title Font Weight', 'kingster'),
						'type' => 'text',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800', 'kingster')
					),
					'archive-blog-title-letter-spacing' => array(
						'title' => esc_html__('Blog Title Letter Spacing', 'kingster'),
						'type' => 'text',
						'data-input-type' => 'pixel',
					),
					'archive-blog-title-text-transform' => array(
						'title' => esc_html__('Blog Title Text Transform', 'kingster'),
						'type' => 'combobox',
						'data-type' => 'text',
						'options' => array(
							'none' => esc_html__('None', 'kingster'),
							'uppercase' => esc_html__('Uppercase', 'kingster'),
							'lowercase' => esc_html__('Lowercase', 'kingster'),
							'capitalize' => esc_html__('Capitalize', 'kingster'),
						),
						'default' => 'none'
					),
				)
			),

			'woocommerce-style' => array(
				'title' => esc_html__('Woocommerce Style', 'kingster'),
				'options' => array(

					'woocommerce-archive-sidebar' => array(
						'title' => esc_html__('Woocommerce Archive Sidebar', 'kingster'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'right',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'woocommerce-archive-sidebar-left' => array(
						'title' => esc_html__('Woocommerce Archive Sidebar Left', 'kingster'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'woocommerce-archive-sidebar'=>array('left', 'both') )
					),
					'woocommerce-archive-sidebar-right' => array(
						'title' => esc_html__('Woocommerce Archive Sidebar Right', 'kingster'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'woocommerce-archive-sidebar'=>array('right', 'both') )
					),
					'woocommerce-archive-column-size' => array(
						'title' => esc_html__('Woocommerce Archive Column Size', 'kingster'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5, 10 => 6, ),
						'default' => 15
					),
					'woocommerce-archive-thumbnail' => array(
						'title' => esc_html__('Woocommerce Archive Thumbnail Size', 'kingster'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'default' => 'full'
					),
					'woocommerce-related-product-column-size' => array(
						'title' => esc_html__('Woocommerce Related Product Column Size', 'kingster'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5, 10 => 6, ),
						'default' => 15
					),
					'woocommerce-related-product-num-fetch' => array(
						'title' => esc_html__('Woocommerce Related Product Num Fetch', 'kingster'),
						'type' => 'text',
						'default' => 4,
						'data-input-type' => 'number'
					),
					'woocommerce-related-product-thumbnail' => array(
						'title' => esc_html__('Woocommerce Related Product Thumbnail Size', 'kingster'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'default' => 'full'
					),
				)
			),

			'portfolio-style' => array(
				'title' => esc_html__('Portfolio Style', 'kingster'),
				'options' => array(
					'portfolio-slug' => array(
						'title' => esc_html__('Portfolio Slug (Permalink)', 'kingster'),
						'type' => 'text',
						'default' => 'portfolio',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'kingster')
					),
					'portfolio-category-slug' => array(
						'title' => esc_html__('Portfolio Category Slug (Permalink)', 'kingster'),
						'type' => 'text',
						'default' => 'portfolio_category',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'kingster')
					),
					'portfolio-tag-slug' => array(
						'title' => esc_html__('Portfolio Tag Slug (Permalink)', 'kingster'),
						'type' => 'text',
						'default' => 'portfolio_tag',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'kingster')
					),
					'enable-single-portfolio-navigation' => array(
						'title' => esc_html__('Enable Single Portfolio Navigation', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'enable-single-portfolio-navigation-in-same-tag' => array(
						'title' => esc_html__('Enable Single Portfolio Navigation Within Same Tag', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'enable-single-portfolio-navigation' => 'enable' )
					),
					'portfolio-icon-hover-link' => array(
						'title' => esc_html__('Portfolio Hover Icon (Link)', 'kingster'),
						'type' => 'radioimage',
						'options' => 'hover-icon-link',
						'default' => 'icon_link_alt'
					),
					'portfolio-icon-hover-video' => array(
						'title' => esc_html__('Portfolio Hover Icon (Video)', 'kingster'),
						'type' => 'radioimage',
						'options' => 'hover-icon-video',
						'default' => 'icon_film'
					),
					'portfolio-icon-hover-image' => array(
						'title' => esc_html__('Portfolio Hover Icon (Image)', 'kingster'),
						'type' => 'radioimage',
						'options' => 'hover-icon-image',
						'default' => 'icon_zoom-in_alt'
					),
					'portfolio-icon-hover-size' => array(
						'title' => esc_html__('Portfolio Hover Icon Size', 'kingster'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '22px',
						'selector' => '.gdlr-core-portfolio-thumbnail .gdlr-core-portfolio-icon{ font-size: #gdlr#; }' 
					),
					'enable-related-portfolio' => array(
						'title' => esc_html__('Enable Related Portfolio', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'related-portfolio-style' => array(
						'title' => esc_html__('Related Portfolio Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'grid' => esc_html__('Grid', 'kingster'),
							'modern' => esc_html__('Modern', 'kingster'),
						),
						'condition' => array('enable-related-portfolio'=>'enable')
					),
					'related-portfolio-column-size' => array(
						'title' => esc_html__('Related Portfolio Column Size', 'kingster'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5, 10 => 6, ),
						'default' => 15,
						'condition' => array('enable-related-portfolio'=>'enable')
					),
					'related-portfolio-num-fetch' => array(
						'title' => esc_html__('Related Portfolio Num Fetch', 'kingster'),
						'type' => 'text',
						'default' => 4,
						'data-input-type' => 'number',
						'condition' => array('enable-related-portfolio'=>'enable')
					),
					'related-portfolio-thumbnail-size' => array(
						'title' => esc_html__('Related Portfolio Thumbnail Size', 'kingster'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'condition' => array('enable-related-portfolio'=>'enable'),
						'default' => 'medium'
					),
					'related-portfolio-num-excerpt' => array(
						'title' => esc_html__('Related Portfolio Num Excerpt', 'kingster'),
						'type' => 'text',
						'default' => 20,
						'data-input-type' => 'number',
						'condition' => array('enable-related-portfolio'=>'enable', 'related-portfolio-style'=>'grid')
					),
				)
			),

			'portfolio-archive' => array(
				'title' => esc_html__('Portfolio Archive', 'kingster'),
				'options' => array(
					'archive-portfolio-sidebar' => array(
						'title' => esc_html__('Archive Portfolio Sidebar', 'kingster'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'none',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'archive-portfolio-sidebar-left' => array(
						'title' => esc_html__('Archive Portfolio Sidebar Left', 'kingster'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'archive-portfolio-sidebar'=>array('left', 'both') )
					),
					'archive-portfolio-sidebar-right' => array(
						'title' => esc_html__('Archive Portfolio Sidebar Right', 'kingster'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'archive-portfolio-sidebar'=>array('right', 'both') )
					),
					'archive-portfolio-style' => array(
						'title' => esc_html__('Archive Portfolio Style', 'kingster'),
						'type' => 'radioimage',
						'options' => array(
							'modern' => get_template_directory_uri() . '/include/options/images/portfolio/modern.png',
							'modern-no-space' => get_template_directory_uri() . '/include/options/images/portfolio/modern-no-space.png',
							'grid' => get_template_directory_uri() . '/include/options/images/portfolio/grid.png',
							'grid-no-space' => get_template_directory_uri() . '/include/options/images/portfolio/grid-no-space.png',
							'modern-desc' => get_template_directory_uri() . '/include/options/images/portfolio/modern-desc.png',
							'modern-desc-no-space' => get_template_directory_uri() . '/include/options/images/portfolio/modern-desc-no-space.png',
							'medium' => get_template_directory_uri() . '/include/options/images/portfolio/medium.png',
						),
						'default' => 'medium',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'archive-portfolio-thumbnail-size' => array(
						'title' => esc_html__('Archive Portfolio Thumbnail Size', 'kingster'),
						'type' => 'combobox',
						'options' => 'thumbnail-size'
					),
					'archive-portfolio-grid-text-align' => array(
						'title' => esc_html__('Archive Portfolio Grid Text Align', 'kingster'),
						'type' => 'radioimage',
						'options' => 'text-align',
						'default' => 'left',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space' ) )
					),
					'archive-portfolio-grid-style' => array(
						'title' => esc_html__('Archive Portfolio Grid Content Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'normal' => esc_html__('Normal', 'kingster'),
							'with-frame' => esc_html__('With Frame', 'kingster'),
							'with-bottom-border' => esc_html__('With Bottom Border', 'kingster'),
						),
						'default' => 'normal',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space' ) )
					),
					'archive-enable-portfolio-tag' => array(
						'title' => esc_html__('Archive Enable Portfolio Tag', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space', 'modern-desc', 'modern-desc-no-space', 'medium' ) )
					),
					'archive-portfolio-medium-size' => array(
						'title' => esc_html__('Archive Portfolio Medium Thumbnail Size', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'small' => esc_html__('Small', 'kingster'),
							'large' => esc_html__('Large', 'kingster'),
						),
						'condition' => array( 'archive-portfolio-style' => 'medium' )
					),
					'archive-portfolio-medium-style' => array(
						'title' => esc_html__('Archive Portfolio Medium Thumbnail Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'left' => esc_html__('Left', 'kingster'),
							'right' => esc_html__('Right', 'kingster'),
							'switch' => esc_html__('Switch ( Between Left and Right )', 'kingster'),
						),
						'default' => 'switch',
						'condition' => array( 'archive-portfolio-style' => 'medium' )
					),
					'archive-portfolio-hover' => array(
						'title' => esc_html__('Archive Portfolio Hover Style', 'kingster'),
						'type' => 'radioimage',
						'options' => array(
							'title' => get_template_directory_uri() . '/include/options/images/portfolio/hover/title.png',
							'title-icon' => get_template_directory_uri() . '/include/options/images/portfolio/hover/title-icon.png',
							'title-tag' => get_template_directory_uri() . '/include/options/images/portfolio/hover/title-tag.png',
							'icon-title-tag' => get_template_directory_uri() . '/include/options/images/portfolio/hover/icon-title-tag.png',
							'icon' => get_template_directory_uri() . '/include/options/images/portfolio/hover/icon.png',
							'margin-title' => get_template_directory_uri() . '/include/options/images/portfolio/hover/margin-title.png',
							'margin-title-icon' => get_template_directory_uri() . '/include/options/images/portfolio/hover/margin-title-icon.png',
							'margin-title-tag' => get_template_directory_uri() . '/include/options/images/portfolio/hover/margin-title-tag.png',
							'margin-icon-title-tag' => get_template_directory_uri() . '/include/options/images/portfolio/hover/margin-icon-title-tag.png',
							'margin-icon' => get_template_directory_uri() . '/include/options/images/portfolio/hover/margin-icon.png',
							'none' => get_template_directory_uri() . '/include/options/images/portfolio/hover/none.png',
						),
						'default' => 'icon',
						'max-width' => '100px',
						'condition' => array( 'archive-portfolio-style' => array('modern', 'modern-no-space', 'grid', 'grid-no-space', 'medium') ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'archive-portfolio-column-size' => array(
						'title' => esc_html__('Archive Portfolio Column Size', 'kingster'),
						'type' => 'combobox',
						'options' => array( 60=>1, 30=>2, 20=>3, 15=>4, 12=>5 ),
						'default' => 20,
						'condition' => array( 'archive-portfolio-style' => array('modern', 'modern-no-space', 'grid', 'grid-no-space', 'modern-desc', 'modern-desc-no-space') )
					),
					'archive-portfolio-excerpt' => array(
						'title' => esc_html__('Archive Portfolio Excerpt Type', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'specify-number' => esc_html__('Specify Number', 'kingster'),
							'show-all' => esc_html__('Show All ( use <!--more--> tag to cut the content )', 'kingster'),
							'none' => esc_html__('Disable Exceprt', 'kingster'),
						),
						'default' => 'specify-number',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space', 'modern-desc', 'modern-desc-no-space', 'medium' ) )
					),
					'archive-portfolio-excerpt-number' => array(
						'title' => esc_html__('Archive Portfolio Excerpt Number', 'kingster'),
						'type' => 'text',
						'default' => 55,
						'data-input-type' => 'number',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space', 'modern-desc', 'modern-desc-no-space', 'medium' ), 'archive-portfolio-excerpt' => 'specify-number' )
					),

				)
			),

			'personnel-style' => array(
				'title' => esc_html__('Personnel Style', 'kingster'),
				'options' => array(
					'personnel-slug' => array(
						'title' => esc_html__('Personnel Slug (Permalink)', 'kingster'),
						'type' => 'text',
						'default' => 'personnel',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'kingster')
					),
					'personnel-category-slug' => array(
						'title' => esc_html__('Personnel Category Slug (Permalink)', 'kingster'),
						'type' => 'text',
						'default' => 'personnel_category',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'kingster')
					),
				)
			),

			'footer' => array(
				'title' => esc_html__('Footer/Copyright', 'kingster'),
				'options' => array(

					'fixed-footer' => array(
						'title' => esc_html__('Fixed Footer', 'kingster'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
					'enable-footer' => array(
						'title' => esc_html__('Enable Footer', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'footer-background' => array(
						'title' => esc_html__('Footer Background', 'kingster'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => '.kingster-footer-wrapper{ background-image: url(#gdlr#); background-size: cover; }',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'enable-footer-column-divider' => array(
						'title' => esc_html__('Enable Footer Column Divider', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'footer-top-padding' => array(
						'title' => esc_html__('Footer Top Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '300',
						'data-type' => 'pixel',
						'default' => '70px',
						'selector' => '.kingster-footer-wrapper{ padding-top: #gdlr#; }',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'footer-bottom-padding' => array(
						'title' => esc_html__('Footer Bottom Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '300',
						'data-type' => 'pixel',
						'default' => '50px',
						'selector' => '.kingster-footer-wrapper{ padding-bottom: #gdlr#; }',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'footer-style' => array(
						'title' => esc_html__('Footer Style', 'kingster'),
						'type' => 'radioimage',
						'wrapper-class' => 'gdlr-core-fullsize',
						'options' => array(
							'footer-1' => get_template_directory_uri() . '/include/options/images/footer-style1.png',
							'footer-2' => get_template_directory_uri() . '/include/options/images/footer-style2.png',
							'footer-3' => get_template_directory_uri() . '/include/options/images/footer-style3.png',
							'footer-4' => get_template_directory_uri() . '/include/options/images/footer-style4.png',
							'footer-5' => get_template_directory_uri() . '/include/options/images/footer-style5.png',
							'footer-6' => get_template_directory_uri() . '/include/options/images/footer-style6.png',
						),
						'default' => 'footer-2',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'enable-copyright' => array(
						'title' => esc_html__('Enable Copyright', 'kingster'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'copyright-style' => array(
						'title' => esc_html__('Copyright Style', 'kingster'),
						'type' => 'combobox',
						'options' => array(
							'center' => esc_html__('Center', 'kingster'),
							'left-right' => esc_html__('Left & Right', 'kingster'),
						),
						'condition' => array( 'enable-copyright' => 'enable' )
					),
					'copyright-top-padding' => array(
						'title' => esc_html__('Copyright Top Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '300',
						'data-type' => 'pixel',
						'default' => '38px',
						'selector' => '.kingster-copyright-container{ padding-top: #gdlr#; }',
						'condition' => array( 'enable-copyright' => 'enable' )
					),
					'copyright-bottom-padding' => array(
						'title' => esc_html__('Copyright Bottom Padding', 'kingster'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '300',
						'data-type' => 'pixel',
						'default' => '38px',
						'selector' => '.kingster-copyright-container{ padding-bottom: #gdlr#; }',
						'condition' => array( 'enable-copyright' => 'enable' )
					),	
					'copyright-text' => array(
						'title' => esc_html__('Copyright Text', 'kingster'),
						'type' => 'textarea',
						'wrapper-class' => 'gdlr-core-fullsize',
						'condition' => array( 'enable-copyright' => 'enable' )
					),
					'copyright-left' => array(
						'title' => esc_html__('Copyright Left', 'kingster'),
						'type' => 'textarea',
						'wrapper-class' => 'gdlr-core-fullsize',
						'condition' => array( 'enable-copyright' => 'enable', 'copyright-style' => 'left-right' )
					),
					'copyright-right' => array(
						'title' => esc_html__('Copyright Right', 'kingster'),
						'type' => 'textarea',
						'wrapper-class' => 'gdlr-core-fullsize',
						'condition' => array( 'enable-copyright' => 'enable', 'copyright-style' => 'left-right' )
					),
					'enable-back-to-top' => array(
						'title' => esc_html__('Enable Back To Top Button', 'kingster'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
				) // footer-options
			), // footer-nav	
		
		) // general-options
		
	), 2);