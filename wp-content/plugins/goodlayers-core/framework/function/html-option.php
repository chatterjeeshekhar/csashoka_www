<?php
	/*	
	*	Goodlayers Html Option File
	*	---------------------------------------------------------------------
	*	This file create the class that help you create the input form element
	*	---------------------------------------------------------------------
	*/	
	
	if( !class_exists('gdlr_core_html_option') ){
		
		class gdlr_core_html_option{

			// call this function on wp_enqueue_script hook
			static function include_script($elements = array()){
				
				$elements = wp_parse_args($elements, array(
					'style' => 'html-option',
				));				

				gdlr_core_include_utility_script();

				wp_enqueue_media();
				wp_enqueue_style('wp-color-picker');
				wp_enqueue_style('gdlr-core-html-option', GDLR_CORE_URL . '/framework/css/' . $elements['style'] . '.css');
				
				// enqueue the script
				wp_enqueue_script('gdlr-core-html-option', GDLR_CORE_URL . '/framework/js/html-option.js', array(
					'jquery', 'jquery-effects-core', 'wp-color-picker', 'jquery-ui-slider', 'jquery-ui-datepicker'
				), '1.4.5', true);	
				
				// localize the script
				$html_option_val =  array();
				$html_option_val['text'] = array(
					'ajaxurl' => GDLR_CORE_AJAX_URL,
					'error_head' => esc_html__('An error occurs', 'goodlayers-core'),
					'error_message' => esc_html__('Please refresh the page to try again. If the problem still persists, please contact administrator for this.', 'goodlayers-core'),
					'nonce' => wp_create_nonce('gdlr_core_html_option'),
					'upload_media' => esc_html__('Select or Upload Media', 'goodlayers-core'),
					'choose_media' => esc_html__('Use this media', 'goodlayers-core'),
				);
				$html_option_val['tabs'] = array(
					'title_text' => esc_html__('Item\'s Title', 'goodlayers-core'),
					'tab_checkbox_on' => esc_html__('On', 'goodlayers-core'),
					'tab_checkbox_off' => esc_html__('Off', 'goodlayers-core')
				);
				$html_option_val['skin'] = array(
					'input' => esc_html__('Skin Name', 'goodlayers-core'),
					'empty_input' => esc_html__('Please fill the name in skin name box to create new skin.', 'goodlayers-core'),
					'duplicate_input' => esc_html__('This skin name has already been assigned, please try filling another name.', 'goodlayers-core'),
					'description' => esc_html__('* Please fill english character for skin name with no special characters. The skin you\'re created can be used in Color/Background Wrapper Section', 'goodlayers-core')
				);
				$html_option_val['fontupload'] = array(
					'none' => esc_html__('You don\'t have any font uploaded', 'goodlayers-core'),
					'font_name' => esc_html__('Font Name', 'goodlayers-core'),
					'font_name_p' => esc_html__('Fill in font name in English', 'goodlayers-core'),
					'eot' => esc_html__('EOT Font', 'goodlayers-core'),
					'ttf' => esc_html__('TTF Font', 'goodlayers-core'),
					'button' => esc_html__('Upload', 'goodlayers-core'),
				);
				$html_option_val['thumbnail_sizing'] = array(
					'name' => esc_html__('Thumbnail Name', 'goodlayers-core'),
					'width' => esc_html__('Width (px)', 'goodlayers-core'),
					'height' => esc_html__('Height (px)', 'goodlayers-core'),
					'add' => esc_html__('Add Thumbnail', 'goodlayers-core'),
					'empty_input' => esc_html__('Please fill all required fields', 'goodlayers-core'),
					'description' => esc_html__('*After creating new thumbnail, you have to regenerate the thumbnail for old images.', 'goodlayers-core') . ' ' .
						esc_html__('We recommend the \'ONet Regenerate thumbnails\' plugin for this process.', 'goodlayers-core')
						
				);
				wp_localize_script('gdlr-core-html-option', 'html_option_val', $html_option_val);

				// for tmce initialization
				// $html_option_val['tmce'] = self::tmce_init();
				add_action('admin_head', 'gdlr_core_html_option::late_include_script', 999);
			}
			static function late_include_script(){
				$gdlr_core_tmce = self::tmce_init();
?>
<script>
	var gdlr_core_tmce = <?php echo json_encode($gdlr_core_tmce); ?>;
</script>
<?php
			}
			
			// use to obtain input elements based on the settings variable
			static function get_element($settings){
				
				if( empty($settings['type']) || $settings['type'] == 'customizer-description' ) return;
				
				$wrapper_class  = empty($settings['wrapper-class'])? '': $settings['wrapper-class'];
				$wrapper_class .= ' gdlr-core-html-option-' . trim($settings['type']);
				$condition = empty($settings['condition'])? '': 'data-condition="' . esc_attr(json_encode($settings['condition'])) . '"';
				
				$ret  = '<div class="gdlr-core-html-option-item ' . esc_attr($wrapper_class) . '-item" ' . $condition . ' >';
				
				if( !empty($settings['title']) ){
					$ret .= '<div class="gdlr-core-html-option-item-title" >' . gdlr_core_escape_content($settings['title']) . '</div>';
				}

				if( !empty($settings['description-position']) && $settings['description-position'] == 'top' && !empty($settings['description']) ){
					$ret .= '<div class="gdlr-core-html-option-item-description" >' . gdlr_core_escape_content($settings['description']) . '</div>';
				}
				
				$ret .= '<div class="gdlr-core-html-option-item-input">';
				switch($settings['type']){
					case 'text': 
						$ret .= self::text($settings);
						break;
					case 'datepicker': 
						$ret .= self::datepicker($settings);
						break;
					case 'textarea': 
						$ret .= self::textarea($settings);
						break;
					case 'combobox':
						$ret .= self::combobox($settings);
						break;
					case 'multi-combobox':
						$ret .= self::multi_combobox($settings);
						break;
					case 'checkbox': 
						$ret .= self::checkbox($settings);
						break;
					case 'radioimage': 
					case 'radioimage-frame': 
						$ret .= self::radioimage($settings);
						break;
					case 'upload': 
						$ret .= self::upload($settings);
						break;
					case 'colorpicker': 
						$ret .= self::colorpicker($settings);
						break;
					case 'font': 
						$ret .= self::font($settings);
						break;
					case 'fontslider': 
						$ret .= self::fontslider($settings);
						break;
					case 'tinymce': 
						$ret .= self::tinymce($settings);
						break;
					case 'icons': 
						$ret .= self::icons($settings);
						break;
					case 'custom': 
						$ret .= self::custom($settings);
						break;
					case 'import': 
						$ret .= self::import($settings);
						break;
					case 'export': 
						$ret .= self::export($settings);
						break;
					default: break;
				}
				$ret .= '</div>';
				
				if( empty($settings['description-position']) && !empty($settings['description']) ){
					$ret .= '<div class="gdlr-core-html-option-item-description" >' . gdlr_core_escape_content($settings['description']) . '</div>';
				}
				
				if( !empty($settings['options']) && $settings['options'] == 'skin' ){
					$ret .= '<div class="gdlr-core-html-option-skin-edit" >' . esc_html__('Create Skin', 'goodlayers-core') . '<i class="fa fa-plus-circle" ></i></div>';
				}

				$ret .= '<div class="clear"></div>';
				$ret .= '</div>'; // gdlr-core-html-option-item
				
				return $ret;
			}
			
			//////////////////////////
			// element started here
			//////////////////////////			
			
			// input text
			static function text($settings){
				$value = '';
				
				if( isset($settings['value']) ){
					$value = $settings['value'];
				}else if( isset($settings['default']) ){
					$value = $settings['default'];
				}

				$ret  = '<input type="text" class="gdlr-core-html-option-text" data-type="text" data-slug="' . esc_attr($settings['slug']) . '" value="' . esc_attr($value) . '" ';
				$ret .= empty($settings['data-input-type'])? '': ' data-input-type="' . esc_attr($settings['data-input-type']) . '"';
				$ret .= ' />';
	
				return $ret;
			}	

			// input datepicker
			static function datepicker($settings){
				$value = '';
				
				if( isset($settings['value']) ){
					$value = $settings['value'];
				}else if( isset($settings['default']) ){
					$value = $settings['default'];
				}

				$ret  = '<input type="text" class="gdlr-core-html-option-text gdlr-core-html-option-datepicker" data-type="text" data-slug="' . esc_attr($settings['slug']) . '" value="' . esc_attr($value) . '" />';
				$ret .= '<i class="gdlr-core-html-option-datepicker-icon fa fa-calendar" ></i>';
				return $ret;
			}			
			
			// textarea
			static function textarea($settings){
				$value = '';
				if( isset($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}

				$ret = '<textarea class="gdlr-core-html-option-textarea" data-type="textarea" data-slug="' . esc_attr($settings['slug']) . '" >' . esc_textarea($value) . '</textarea>';
	
				return $ret;
			}
			
			// combobox
			static function combobox($settings){
				$value = '';
				$extra_html = '';
				if( isset($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				$ret  = '<div class="gdlr-core-custom-combobox" >';
				$ret .= '<select class="gdlr-core-html-option-combobox" data-type="combobox" data-slug="' . esc_attr($settings['slug']) . '" >';
				if( !empty($settings['options']) ){
					if( $settings['options'] == 'sidebar' ){
						$settings['options'] = gdlr_core_sidebar_generator::get_sidebars();
					}else if( $settings['options'] == 'thumbnail-size' ){
						$settings['options'] = gdlr_core_get_thumbnail_list();
					}else if( $settings['options'] == 'skin' ){
						$settings['options'] = gdlr_core_skin_settings::get_skins();
					}else if( $settings['options'] == 'post_type' ){
						$settings['options'] = gdlr_core_get_post_list($settings['options-data']);
					}else if( $settings['options'] == 'tax_id' ){
						$settings['options'] = gdlr_core_get_term_list_id($settings['options-data']);
					}
					
					if( !empty($settings['with-default']) ){
						$settings['options'] = array(
							'default' => esc_html__('Default', 'goodlayers-core')
						) + $settings['options'];
					}

					foreach($settings['options'] as $option_key => $option_value ){
						$ret .= '<option value="' . esc_attr($option_key) . '" ' . selected($value, $option_key, false) . ' >' . gdlr_core_escape_content($option_value) . '</option>';
					}
				}
				$ret .= '</select>';
				$ret .= '</div>';
				
				return $ret;
			}
			
			// multi_combobox
			static function multi_combobox($settings){
				$value = array();
				if( isset($settings['value']) ){
					$value = empty($settings['value'])? array(): $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				$ret  = '<select class="gdlr-core-html-option-multi-combobox" data-type="multi-combobox" data-slug="' . esc_attr($settings['slug']) . '" multiple >';
				if( !empty($settings['options']) ){
					foreach($settings['options'] as $option_key => $option_value ){
						$ret .= '<option value="' . esc_attr($option_key) . '" ' . ($value == 'all' || in_array($option_key, $value)? 'selected': '') . ' >' . gdlr_core_escape_content($option_value) . '</option>';
					}
				}
				$ret .= '</select>';
				
				return $ret;
			}			
			
			// checkbox
			static function checkbox($settings){
				$value = '';
				if( isset($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}else{
					$value = 'enable';
				}
				
				$ret  = '<label>';
				$ret .= '<input type="checkbox" class="gdlr-core-html-option-checkbox" data-type="checkbox" data-slug="' . esc_attr($settings['slug']) . '" ' . checked($value, 'enable', false) . ' />';
				$ret .= '<div class="gdlr-core-html-option-checkbox-appearance gdlr-core-noselect">';
				$ret .= '<span class="gdlr-core-checkbox-button gdlr-core-on">' . esc_html__('On', 'goodlayers-core') . '</span>';
				$ret .= '<span class="gdlr-core-checkbox-separator"></span>';
				$ret .= '<span class="gdlr-core-checkbox-button gdlr-core-off">' . esc_html__('Off', 'goodlayers-core') . '</span>';
				$ret .= '</div>';
				$ret .= '</label>';
				
				return $ret;
			}		
			
			// radioimage
			static function radioimage($settings){

				if( $settings['options'] == 'text-align' ){
					$settings['options'] = array(
						'left' => GDLR_CORE_URL . '/include/images/text-align/left.png',
						'center' => GDLR_CORE_URL . '/include/images/text-align/center.png',
						'right' => GDLR_CORE_URL . '/include/images/text-align/right.png'
					);
					$settings['max-width'] = '61px';
					$settings['type'] = 'radioimage-frame';

					if( !empty($settings['with-default']) ){
						$settings['options'] = array_merge(array(
							'default' => GDLR_CORE_URL . '/include/images/text-align/default.jpg',
						), $settings['options']);
					}
				}else if( $settings['options'] == 'sidebar' ){
					$settings['options'] = array(
						'none' => GDLR_CORE_URL . '/include/images/sidebar/none.jpg',
						'left' => GDLR_CORE_URL . '/include/images/sidebar/left.jpg',
						'right' => GDLR_CORE_URL . '/include/images/sidebar/right.jpg',
						'both' => GDLR_CORE_URL . '/include/images/sidebar/both.jpg',
					);

					if( !empty($settings['with-default']) ){
						$settings['options'] = array_merge(array(
							'default' => GDLR_CORE_URL . '/include/images/sidebar/default.jpg',
						), $settings['options']);
					}
					if( !empty($settings['without-none']) ){
						unset($settings['options']['none']);
					}
				}else if( $settings['options'] == 'pattern' ){
					$settings['options'] = array(
						'pattern-1' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-1.png',
						'pattern-2' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-2.png',
						'pattern-3' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-3.png',
						'pattern-4' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-4.png',
						'pattern-5' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-5.png',
						'pattern-6' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-6.png',
						'pattern-7' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-7.png',
						'pattern-8' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-8.png',
						'pattern-9' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-9.png',
						'pattern-10' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-10.png',
						'pattern-11' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-11.png',
						'pattern-12' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-12.png',
						'pattern-13' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-13.png',
						'pattern-14' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-14.png',
						'pattern-15' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-15.png',
						'pattern-16' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-16.png',
						'pattern-17' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-17.png',
						'pattern-18' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-18.png',
						'pattern-19' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-19.png',
						'pattern-20' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-20.png',
						'pattern-21' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-21.png',
						'pattern-22' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-22.png',
						'pattern-23' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-23.png',
						'pattern-24' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-24.png',
						'pattern-25' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-25.png',
						'pattern-26' => GDLR_CORE_URL . '/include/images/pattern/thumbnail/pattern-26.png'
					);
				}else if( $settings['options'] == 'hover-icon-link' ){
					$settings['options'] = array(
						'arrow_right-up' => GDLR_CORE_URL . '/include/images/hover-icon/link/arrow_right-up.jpg',
						'fa fa-external-link' => GDLR_CORE_URL . '/include/images/hover-icon/link/fa-external-link.jpg',
						'fa fa-external-link-square' => GDLR_CORE_URL . '/include/images/hover-icon/link/fa-external-link-square.jpg',
						'fa fa-link' => GDLR_CORE_URL . '/include/images/hover-icon/link/fa-link.jpg',
						'icon_link' => GDLR_CORE_URL . '/include/images/hover-icon/link/icon_link.jpg',
						'icon_link_alt' => GDLR_CORE_URL . '/include/images/hover-icon/link/icon_link_alt.jpg'
					);
					$settings['max-width'] = '30px';
					$settings['type'] = 'radioimage-frame';
				}else if( $settings['options'] == 'hover-icon-image' ){
					$settings['options'] = array(
						'arrow_expand' => GDLR_CORE_URL . '/include/images/hover-icon/image/arrow_expand.jpg',
						'fa fa-expand' => GDLR_CORE_URL . '/include/images/hover-icon/image/fa-expand.jpg',
						'fa fa-picture-o' => GDLR_CORE_URL . '/include/images/hover-icon/image/fa-picture-o.jpg',
						'fa fa-plus' => GDLR_CORE_URL . '/include/images/hover-icon/image/fa-plus.jpg',
						'fa fa-plus-circle' => GDLR_CORE_URL . '/include/images/hover-icon/image/fa-plus-circle.jpg',
						'fa fa-search' => GDLR_CORE_URL . '/include/images/hover-icon/image/fa-search.jpg',
						'fa fa-search-plus' => GDLR_CORE_URL . '/include/images/hover-icon/image/fa-search-plus.jpg',
						'icon_plus' => GDLR_CORE_URL . '/include/images/hover-icon/image/icon_plus.jpg',
						'icon_plus_alt2' => GDLR_CORE_URL . '/include/images/hover-icon/image/icon_plus_alt2.jpg',
						'icon_search' => GDLR_CORE_URL . '/include/images/hover-icon/image/icon_search.jpg',
						'icon_zoom-in_alt' => GDLR_CORE_URL . '/include/images/hover-icon/image/icon_zoom-in_alt.jpg',
					);
					$settings['max-width'] = '30px';
					$settings['type'] = 'radioimage-frame';
				}else if( $settings['options'] == 'hover-icon-video' ){
					$settings['options'] = array(
						'fa fa-file-video-o' => GDLR_CORE_URL . '/include/images/hover-icon/video/fa-file-video-o.jpg',
						'fa fa-film' => GDLR_CORE_URL . '/include/images/hover-icon/video/fa-film.jpg',
						'fa fa-play' => GDLR_CORE_URL . '/include/images/hover-icon/video/fa-play.jpg',
						'fa fa-play-circle' => GDLR_CORE_URL . '/include/images/hover-icon/video/fa-play-circle.jpg',
						'fa fa-play-circle-o' => GDLR_CORE_URL . '/include/images/hover-icon/video/fa-play-circle-o.jpg',
						'fa fa-video-camera' => GDLR_CORE_URL . '/include/images/hover-icon/video/fa-video-camera.jpg',
						'icon_film' => GDLR_CORE_URL . '/include/images/hover-icon/video/icon_film.jpg',
					);
					$settings['max-width'] = '30px';
					$settings['type'] = 'radioimage-frame';
				}

				$value = '';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}else{
					reset($settings['options']);
					$value = key($settings['options']);
				}
				
				$max_width = empty($settings['max-width'])? '': gdlr_core_format_datatype($settings['max-width'], 'pixel');
				$ret = '';
				foreach( $settings['options'] as $option_key => $option_url ){
					$ret .= '<label ' . gdlr_core_esc_style(array('max-width'=> $max_width)) . ' >';
					$ret .= '<input class="gdlr-core-html-option-radioimage" type="radio" name="' . esc_attr($settings['slug']) . '" data-type="radioimage" data-slug="' . esc_attr($settings['slug']) . '" value="' . esc_attr($option_key) . '" ' . checked($value, $option_key, false) . '/>';
					if( $settings['type'] == 'radioimage-frame' ){
						$ret .= '<div class="gdlr-core-radioimage-frame" ></div>';
					}else{
						$ret .= '<div class="gdlr-core-radioimage-checked" ></div>';
					}
					$ret .= '<img src="' . esc_url($option_url) . '" alt="' . esc_attr($option_key) . '" />';
					$ret .= '</label>';
				}
				
				return $ret;
			}
			
			// upload
			static function upload($settings){
				$value = '';
				if( isset($settings['value']) ){
					$value = $settings['value'];
				}
				
				$ret  = '<div class="gdlr-core-html-option-upload-appearance ' . (empty($value)? '': 'gdlr-core-active') . '" >';
				$ret .= '<input type="hidden" class="gdlr-core-html-option-upload" data-type="upload" data-slug="' . esc_attr($settings['slug']) . '" value="' . esc_attr($value) . '" ';
				$ret .= (!empty($settings['with-name']))? ' name="' . esc_attr($settings['slug']) . '" ': '';
				$ret .= ' />';
				
				$ret .= '<div class="gdlr-core-upload-image-container" style="' . (empty($value)? '': 'background-image: url(\'' . esc_url(wp_get_attachment_url($value)) . '\');') . '" ></div>';
				
				$ret .= '<div class="gdlr-core-upload-image-overlay" >';
				$ret .= '<div class="gdlr-core-upload-image-button-hover">';
				$ret .= '<span class="gdlr-core-upload-image-button gdlr-core-upload-image-add"><i class="icon_plus" ></i></span>';
				$ret .= '<span class="gdlr-core-upload-image-button gdlr-core-upload-image-remove"><i class="icon_minus-06" ></i></span>';
				$ret .= '</div>'; // gdlr-core-upload-image-hover
				$ret .= '</div>'; // gdlr-core-upload-image-overlay
				$ret .= '</div>'; // gdlr-core-html-option-upload-appearance
				
				return $ret;
			}
			
			// colorpicker
			static function colorpicker($settings){
				$value = ''; $default = '';
				if( !empty($settings['default']) ){
					$default = $settings['default'];
				}
				
				if( isset($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($default) ){
					$value = $default;
				}
				
				$ret = '<input type="text" class="gdlr-core-html-option-colorpicker" data-type="colorpicker" data-slug="' . esc_attr($settings['slug']) . '" value="' . esc_attr($value) . '" data-default-color="' . esc_attr($default) . '" />';
	
				return $ret;
			}
			
			// font
			static function font($settings){
				$value = '';
				if( isset($settings['value']) ){
					$value = $settings['value'];
				}else{
					$value = empty($settings['default'])? 'Helvetica, sans-serif': $settings['default'];
				}
				
				// init the font if not exists
				global $gdlr_core_font_loader;
				if( empty($gdlr_core_font_loader) ){
					$gdlr_core_font_loader = new gdlr_core_font_loader();
				}

				$base_url = gdlr_core_get_font_display_page();
				$display_url = add_query_arg(array('font-family'=>$value, 'font-type'=>'none'), $base_url);
				
				$ret  = '<iframe class="gdlr-core-html-option-font-display" src="' . esc_url($display_url) . '" data-base-url="' . esc_attr($base_url) . '" ></iframe>';
				$ret .= '<div class="gdlr-core-custom-combobox" >';
				$ret .= '<select class="gdlr-core-html-option-font" data-type="font" data-slug="' . esc_attr($settings['slug']) . '" >';
				
				$ret .= $gdlr_core_font_loader->get_option_list($value);
				
				$ret .= '</select>';
				$ret .= '</div>';				
				
				return $ret;
			}
			
			// fontslider
			static function fontslider($settings){
				$value = '';
				if( !empty($settings['value']) || (isset($settings['value']) && $settings['value'] === '0') ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}else{
					$value = 0;
				}

				if( !empty($settings['data-type']) && $settings['data-type'] == 'opacity' ){
					$settings['data-min'] = 0;
					$settings['data-max'] = 100;
					$settings['data-suffix'] = 'none';
				}
				
				$ret  = '<input type="text" class="gdlr-core-html-option-fontslider" data-type="text" value="' . esc_attr($value) . '" ';
				$ret .= 'data-slug="' . esc_attr($settings['slug']) . '" ';
				$ret .= isset($settings['data-min'])? 'data-min-value="' . esc_attr($settings['data-min']) . '" ': '';
				$ret .= isset($settings['data-max'])? 'data-max-value="' . esc_attr($settings['data-max']) . '" ': '';
				$ret .= isset($settings['data-suffix'])? ' data-suffix="' . esc_attr($settings['data-suffix']) . '" ': '';
				$ret .= ' />';
				
				return $ret;
			}
			
			// icons
			static function icons($settings){
				$value = '';
				if( isset($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				$font_type = 'font-awesome';
				$font_none_style = '';
				if( !empty($settings['allow-none']) && (empty($value) || $value == 'none') ){
					$font_type = 'none';
					$font_none_style = ' style="display: none;" ';
				}else if( !empty($value) && strpos($value, 'fa ') === false ){
					$font_type = 'elegant-font';
				}
				
				$fa_icons = array('fa-address-book', 'fa-address-book-o', 'fa-address-card', 'fa-address-card-o', 'fa-bandcamp', 'fa-bath', 'fa-bathtub', 'fa-drivers-license', 'fa-drivers-license-o', 'fa-eercast', 'fa-envelope-open', 'fa-envelope-open-o', 'fa-etsy', 'fa-free-code-camp', 'fa-grav', 'fa-handshake-o', 'fa-id-badge', 'fa-id-card', 'fa-id-card-o', 'fa-imdb', 'fa-linode', 'fa-meetup', 'fa-microchip', 'fa-podcast', 'fa-quora', 'fa-ravelry', 'fa-s15', 'fa-shower', 'fa-snowflake-o', 'fa-superpowers', 'fa-telegram', 'fa-thermometer', 'fa-thermometer-0', 'fa-thermometer-1', 'fa-thermometer-2', 'fa-thermometer-3', 'fa-thermometer-4', 'fa-thermometer-empty', 'fa-thermometer-full', 'fa-thermometer-half', 'fa-thermometer-quarter', 'fa-thermometer-three-quarters', 'fa-times-rectangle', 'fa-times-rectangle-o', 'fa-user-circle', 'fa-user-circle-o', 'fa-user-o', 'fa-vcard', 'fa-vcard-o', 'fa-window-close', 'fa-window-close-o', 'fa-window-maximize', 'fa-window-minimize', 'fa-window-restore', 'fa-wpexplorer', 'fa-address-book', 'fa-address-book-o', 'fa-address-card', 'fa-address-card-o', 'fa-adjust', 'fa-american-sign-language-interpreting', 'fa-anchor', 'fa-archive', 'fa-area-chart', 'fa-arrows', 'fa-arrows-h', 'fa-arrows-v', 'fa-asl-interpreting', 'fa-assistive-listening-systems', 'fa-asterisk', 'fa-at', 'fa-audio-description', 'fa-automobile', 'fa-balance-scale', 'fa-ban', 'fa-bank', 'fa-bar-chart', 'fa-bar-chart-o', 'fa-barcode', 'fa-bars', 'fa-bath', 'fa-bathtub', 'fa-battery', 'fa-battery-0', 'fa-battery-1', 'fa-battery-2', 'fa-battery-3', 'fa-battery-4', 'fa-battery-empty', 'fa-battery-full', 'fa-battery-half', 'fa-battery-quarter', 'fa-battery-three-quarters', 'fa-bed', 'fa-beer', 'fa-bell', 'fa-bell-o', 'fa-bell-slash', 'fa-bell-slash-o', 'fa-bicycle', 'fa-binoculars', 'fa-birthday-cake', 'fa-blind', 'fa-bluetooth', 'fa-bluetooth-b', 'fa-bolt', 'fa-bomb', 'fa-book', 'fa-bookmark', 'fa-bookmark-o', 'fa-braille', 'fa-briefcase', 'fa-bug', 'fa-building', 'fa-building-o', 'fa-bullhorn', 'fa-bullseye', 'fa-bus', 'fa-cab', 'fa-calculator', 'fa-calendar', 'fa-calendar-check-o', 'fa-calendar-minus-o', 'fa-calendar-o', 'fa-calendar-plus-o', 'fa-calendar-times-o', 'fa-camera', 'fa-camera-retro', 'fa-car', 'fa-caret-square-o-down', 'fa-caret-square-o-left', 'fa-caret-square-o-right', 'fa-caret-square-o-up', 'fa-cart-arrow-down', 'fa-cart-plus', 'fa-cc', 'fa-certificate', 'fa-check', 'fa-check-circle', 'fa-check-circle-o', 'fa-check-square', 'fa-check-square-o', 'fa-child', 'fa-circle', 'fa-circle-o', 'fa-circle-o-notch', 'fa-circle-thin', 'fa-clock-o', 'fa-clone', 'fa-close', 'fa-cloud', 'fa-cloud-download', 'fa-cloud-upload', 'fa-code', 'fa-code-fork', 'fa-coffee', 'fa-cog', 'fa-cogs', 'fa-comment', 'fa-comment-o', 'fa-commenting', 'fa-commenting-o', 'fa-comments', 'fa-comments-o', 'fa-compass', 'fa-copyright', 'fa-creative-commons', 'fa-credit-card', 'fa-credit-card-alt', 'fa-crop', 'fa-crosshairs', 'fa-cube', 'fa-cubes', 'fa-cutlery', 'fa-dashboard', 'fa-database', 'fa-deaf', 'fa-deafness', 'fa-desktop', 'fa-diamond', 'fa-dot-circle-o', 'fa-download', 'fa-drivers-license', 'fa-drivers-license-o', 'fa-edit', 'fa-ellipsis-h', 'fa-ellipsis-v', 'fa-envelope', 'fa-envelope-o', 'fa-envelope-open', 'fa-envelope-open-o', 'fa-envelope-square', 'fa-eraser', 'fa-exchange', 'fa-exclamation', 'fa-exclamation-circle', 'fa-exclamation-triangle', 'fa-external-link', 'fa-external-link-square', 'fa-eye', 'fa-eye-slash', 'fa-eyedropper', 'fa-fax', 'fa-feed', 'fa-female', 'fa-fighter-jet', 'fa-file-archive-o', 'fa-file-audio-o', 'fa-file-code-o', 'fa-file-excel-o', 'fa-file-image-o', 'fa-file-movie-o', 'fa-file-pdf-o', 'fa-file-photo-o', 'fa-file-picture-o', 'fa-file-powerpoint-o', 'fa-file-sound-o', 'fa-file-video-o', 'fa-file-word-o', 'fa-file-zip-o', 'fa-film', 'fa-filter', 'fa-fire', 'fa-fire-extinguisher', 'fa-flag', 'fa-flag-checkered', 'fa-flag-o', 'fa-flash', 'fa-flask', 'fa-folder', 'fa-folder-o', 'fa-folder-open', 'fa-folder-open-o', 'fa-frown-o', 'fa-futbol-o', 'fa-gamepad', 'fa-gavel', 'fa-gear', 'fa-gears', 'fa-gift', 'fa-glass', 'fa-globe', 'fa-graduation-cap', 'fa-group', 'fa-hand-grab-o', 'fa-hand-lizard-o', 'fa-hand-paper-o', 'fa-hand-peace-o', 'fa-hand-pointer-o', 'fa-hand-rock-o', 'fa-hand-scissors-o', 'fa-hand-spock-o', 'fa-hand-stop-o', 'fa-handshake-o', 'fa-hard-of-hearing', 'fa-hashtag', 'fa-hdd-o', 'fa-headphones', 'fa-heart', 'fa-heart-o', 'fa-heartbeat', 'fa-history', 'fa-home', 'fa-hotel', 'fa-hourglass', 'fa-hourglass-1', 'fa-hourglass-2', 'fa-hourglass-3', 'fa-hourglass-end', 'fa-hourglass-half', 'fa-hourglass-o', 'fa-hourglass-start', 'fa-i-cursor', 'fa-id-badge', 'fa-id-card', 'fa-id-card-o', 'fa-image', 'fa-inbox', 'fa-industry', 'fa-info', 'fa-info-circle', 'fa-institution', 'fa-key', 'fa-keyboard-o', 'fa-language', 'fa-laptop', 'fa-leaf', 'fa-legal', 'fa-lemon-o', 'fa-level-down', 'fa-level-up', 'fa-life-bouy', 'fa-life-buoy', 'fa-life-ring', 'fa-life-saver', 'fa-lightbulb-o', 'fa-line-chart', 'fa-location-arrow', 'fa-lock', 'fa-low-vision', 'fa-magic', 'fa-magnet', 'fa-mail-forward', 'fa-mail-reply', 'fa-mail-reply-all', 'fa-male', 'fa-map', 'fa-map-marker', 'fa-map-o', 'fa-map-pin', 'fa-map-signs', 'fa-meh-o', 'fa-microchip', 'fa-microphone', 'fa-microphone-slash', 'fa-minus', 'fa-minus-circle', 'fa-minus-square', 'fa-minus-square-o', 'fa-mobile', 'fa-mobile-phone', 'fa-money', 'fa-moon-o', 'fa-mortar-board', 'fa-motorcycle', 'fa-mouse-pointer', 'fa-music', 'fa-navicon', 'fa-newspaper-o', 'fa-object-group', 'fa-object-ungroup', 'fa-paint-brush', 'fa-paper-plane', 'fa-paper-plane-o', 'fa-paw', 'fa-pencil', 'fa-pencil-square', 'fa-pencil-square-o', 'fa-percent', 'fa-phone', 'fa-phone-square', 'fa-photo', 'fa-picture-o', 'fa-pie-chart', 'fa-plane', 'fa-plug', 'fa-plus', 'fa-plus-circle', 'fa-plus-square', 'fa-plus-square-o', 'fa-podcast', 'fa-power-off', 'fa-print', 'fa-puzzle-piece', 'fa-qrcode', 'fa-question', 'fa-question-circle', 'fa-question-circle-o', 'fa-quote-left', 'fa-quote-right', 'fa-random', 'fa-recycle', 'fa-refresh', 'fa-registered', 'fa-remove', 'fa-reorder', 'fa-reply', 'fa-reply-all', 'fa-retweet', 'fa-road', 'fa-rocket', 'fa-rss', 'fa-rss-square', 'fa-s15', 'fa-search', 'fa-search-minus', 'fa-search-plus', 'fa-send', 'fa-send-o', 'fa-server', 'fa-share', 'fa-share-alt', 'fa-share-alt-square', 'fa-share-square', 'fa-share-square-o', 'fa-shield', 'fa-ship', 'fa-shopping-bag', 'fa-shopping-basket', 'fa-shopping-cart', 'fa-shower', 'fa-sign-in', 'fa-sign-language', 'fa-sign-out', 'fa-signal', 'fa-signing', 'fa-sitemap', 'fa-sliders', 'fa-smile-o', 'fa-snowflake-o', 'fa-soccer-ball-o', 'fa-sort', 'fa-sort-alpha-asc', 'fa-sort-alpha-desc', 'fa-sort-amount-asc', 'fa-sort-amount-desc', 'fa-sort-asc', 'fa-sort-desc', 'fa-sort-down', 'fa-sort-numeric-asc', 'fa-sort-numeric-desc', 'fa-sort-up', 'fa-space-shuttle', 'fa-spinner', 'fa-spoon', 'fa-square', 'fa-square-o', 'fa-star', 'fa-star-half', 'fa-star-half-empty', 'fa-star-half-full', 'fa-star-half-o', 'fa-star-o', 'fa-sticky-note', 'fa-sticky-note-o', 'fa-street-view', 'fa-suitcase', 'fa-sun-o', 'fa-support', 'fa-tablet', 'fa-tachometer', 'fa-tag', 'fa-tags', 'fa-tasks', 'fa-taxi', 'fa-television', 'fa-terminal', 'fa-thermometer', 'fa-thermometer-0', 'fa-thermometer-1', 'fa-thermometer-2', 'fa-thermometer-3', 'fa-thermometer-4', 'fa-thermometer-empty', 'fa-thermometer-full', 'fa-thermometer-half', 'fa-thermometer-quarter', 'fa-thermometer-three-quarters', 'fa-thumb-tack', 'fa-thumbs-down', 'fa-thumbs-o-down', 'fa-thumbs-o-up', 'fa-thumbs-up', 'fa-ticket', 'fa-times', 'fa-times-circle', 'fa-times-circle-o', 'fa-times-rectangle', 'fa-times-rectangle-o', 'fa-tint', 'fa-toggle-down', 'fa-toggle-left', 'fa-toggle-off', 'fa-toggle-on', 'fa-toggle-right', 'fa-toggle-up', 'fa-trademark', 'fa-trash', 'fa-trash-o', 'fa-tree', 'fa-trophy', 'fa-truck', 'fa-tty', 'fa-tv', 'fa-umbrella', 'fa-universal-access', 'fa-university', 'fa-unlock', 'fa-unlock-alt', 'fa-unsorted', 'fa-upload', 'fa-user', 'fa-user-circle', 'fa-user-circle-o', 'fa-user-o', 'fa-user-plus', 'fa-user-secret', 'fa-user-times', 'fa-users', 'fa-vcard', 'fa-vcard-o', 'fa-video-camera', 'fa-volume-control-phone', 'fa-volume-down', 'fa-volume-off', 'fa-volume-up', 'fa-warning', 'fa-wheelchair', 'fa-wheelchair-alt', 'fa-wifi', 'fa-window-close', 'fa-window-close-o', 'fa-window-maximize', 'fa-window-minimize', 'fa-window-restore', 'fa-wrench', 'fa-american-sign-language-interpreting', 'fa-asl-interpreting', 'fa-assistive-listening-systems', 'fa-audio-description', 'fa-blind', 'fa-braille', 'fa-cc', 'fa-deaf', 'fa-deafness', 'fa-hard-of-hearing', 'fa-low-vision', 'fa-question-circle-o', 'fa-sign-language', 'fa-signing', 'fa-tty', 'fa-universal-access', 'fa-volume-control-phone', 'fa-wheelchair', 'fa-wheelchair-alt', 'fa-hand-grab-o', 'fa-hand-lizard-o', 'fa-hand-o-down', 'fa-hand-o-left', 'fa-hand-o-right', 'fa-hand-o-up', 'fa-hand-paper-o', 'fa-hand-peace-o', 'fa-hand-pointer-o', 'fa-hand-rock-o', 'fa-hand-scissors-o', 'fa-hand-spock-o', 'fa-hand-stop-o', 'fa-thumbs-down', 'fa-thumbs-o-down', 'fa-thumbs-o-up', 'fa-thumbs-up', 'fa-ambulance', 'fa-automobile', 'fa-bicycle', 'fa-bus', 'fa-cab', 'fa-car', 'fa-fighter-jet', 'fa-motorcycle', 'fa-plane', 'fa-rocket', 'fa-ship', 'fa-space-shuttle', 'fa-subway', 'fa-taxi', 'fa-train', 'fa-truck', 'fa-wheelchair', 'fa-wheelchair-alt', 'fa-genderless', 'fa-intersex', 'fa-mars', 'fa-mars-double', 'fa-mars-stroke', 'fa-mars-stroke-h', 'fa-mars-stroke-v', 'fa-mercury', 'fa-neuter', 'fa-transgender', 'fa-transgender-alt', 'fa-venus', 'fa-venus-double', 'fa-venus-mars', 'fa-file', 'fa-file-archive-o', 'fa-file-audio-o', 'fa-file-code-o', 'fa-file-excel-o', 'fa-file-image-o', 'fa-file-movie-o', 'fa-file-o', 'fa-file-pdf-o', 'fa-file-photo-o', 'fa-file-picture-o', 'fa-file-powerpoint-o', 'fa-file-sound-o', 'fa-file-text', 'fa-file-text-o', 'fa-file-video-o', 'fa-file-word-o', 'fa-file-zip-o', 'fa-circle-o-notch', 'fa-cog', 'fa-gear', 'fa-refresh', 'fa-spinner', 'fa-check-square', 'fa-check-square-o', 'fa-circle', 'fa-circle-o', 'fa-dot-circle-o', 'fa-minus-square', 'fa-minus-square-o', 'fa-plus-square', 'fa-plus-square-o', 'fa-square', 'fa-square-o', 'fa-cc-amex', 'fa-cc-diners-club', 'fa-cc-discover', 'fa-cc-jcb', 'fa-cc-mastercard', 'fa-cc-paypal', 'fa-cc-stripe', 'fa-cc-visa', 'fa-credit-card', 'fa-credit-card-alt', 'fa-google-wallet', 'fa-paypal', 'fa-area-chart', 'fa-bar-chart', 'fa-bar-chart-o', 'fa-line-chart', 'fa-pie-chart', 'fa-bitcoin', 'fa-btc', 'fa-cny', 'fa-dollar', 'fa-eur', 'fa-euro', 'fa-gbp', 'fa-gg', 'fa-gg-circle', 'fa-ils', 'fa-inr', 'fa-jpy', 'fa-krw', 'fa-money', 'fa-rmb', 'fa-rouble', 'fa-rub', 'fa-ruble', 'fa-rupee', 'fa-shekel', 'fa-sheqel', 'fa-try', 'fa-turkish-lira', 'fa-usd', 'fa-won', 'fa-yen', 'fa-align-center', 'fa-align-justify', 'fa-align-left', 'fa-align-right', 'fa-bold', 'fa-chain', 'fa-chain-broken', 'fa-clipboard', 'fa-columns', 'fa-copy', 'fa-cut', 'fa-dedent', 'fa-eraser', 'fa-file', 'fa-file-o', 'fa-file-text', 'fa-file-text-o', 'fa-files-o', 'fa-floppy-o', 'fa-font', 'fa-header', 'fa-indent', 'fa-italic', 'fa-link', 'fa-list', 'fa-list-alt', 'fa-list-ol', 'fa-list-ul', 'fa-outdent', 'fa-paperclip', 'fa-paragraph', 'fa-paste', 'fa-repeat', 'fa-rotate-left', 'fa-rotate-right', 'fa-save', 'fa-scissors', 'fa-strikethrough', 'fa-subscript', 'fa-superscript', 'fa-table', 'fa-text-height', 'fa-text-width', 'fa-th', 'fa-th-large', 'fa-th-list', 'fa-underline', 'fa-undo', 'fa-unlink', 'fa-angle-double-down', 'fa-angle-double-left', 'fa-angle-double-right', 'fa-angle-double-up', 'fa-angle-down', 'fa-angle-left', 'fa-angle-right', 'fa-angle-up', 'fa-arrow-circle-down', 'fa-arrow-circle-left', 'fa-arrow-circle-o-down', 'fa-arrow-circle-o-left', 'fa-arrow-circle-o-right', 'fa-arrow-circle-o-up', 'fa-arrow-circle-right', 'fa-arrow-circle-up', 'fa-arrow-down', 'fa-arrow-left', 'fa-arrow-right', 'fa-arrow-up', 'fa-arrows', 'fa-arrows-alt', 'fa-arrows-h', 'fa-arrows-v', 'fa-caret-down', 'fa-caret-left', 'fa-caret-right', 'fa-caret-square-o-down', 'fa-caret-square-o-left', 'fa-caret-square-o-right', 'fa-caret-square-o-up', 'fa-caret-up', 'fa-chevron-circle-down', 'fa-chevron-circle-left', 'fa-chevron-circle-right', 'fa-chevron-circle-up', 'fa-chevron-down', 'fa-chevron-left', 'fa-chevron-right', 'fa-chevron-up', 'fa-exchange', 'fa-hand-o-down', 'fa-hand-o-left', 'fa-hand-o-right', 'fa-hand-o-up', 'fa-long-arrow-down', 'fa-long-arrow-left', 'fa-long-arrow-right', 'fa-long-arrow-up', 'fa-toggle-down', 'fa-toggle-left', 'fa-toggle-right', 'fa-toggle-up', 'fa-arrows-alt', 'fa-backward', 'fa-compress', 'fa-eject', 'fa-expand', 'fa-fast-backward', 'fa-fast-forward', 'fa-forward', 'fa-pause', 'fa-pause-circle', 'fa-pause-circle-o', 'fa-play', 'fa-play-circle', 'fa-play-circle-o', 'fa-random', 'fa-step-backward', 'fa-step-forward', 'fa-stop', 'fa-stop-circle', 'fa-stop-circle-o', 'fa-youtube-play', 'fa-500px', 'fa-adn', 'fa-amazon', 'fa-android', 'fa-angellist', 'fa-apple', 'fa-bandcamp', 'fa-behance', 'fa-behance-square', 'fa-bitbucket', 'fa-bitbucket-square', 'fa-bitcoin', 'fa-black-tie', 'fa-bluetooth', 'fa-bluetooth-b', 'fa-btc', 'fa-buysellads', 'fa-cc-amex', 'fa-cc-diners-club', 'fa-cc-discover', 'fa-cc-jcb', 'fa-cc-mastercard', 'fa-cc-paypal', 'fa-cc-stripe', 'fa-cc-visa', 'fa-chrome', 'fa-codepen', 'fa-codiepie', 'fa-connectdevelop', 'fa-contao', 'fa-css3', 'fa-dashcube', 'fa-delicious', 'fa-deviantart', 'fa-digg', 'fa-dribbble', 'fa-dropbox', 'fa-drupal', 'fa-edge', 'fa-eercast', 'fa-empire', 'fa-envira', 'fa-etsy', 'fa-expeditedssl', 'fa-fa', 'fa-facebook', 'fa-facebook-f', 'fa-facebook-official', 'fa-facebook-square', 'fa-firefox', 'fa-first-order', 'fa-flickr', 'fa-font-awesome', 'fa-fonticons', 'fa-fort-awesome', 'fa-forumbee', 'fa-foursquare', 'fa-free-code-camp', 'fa-ge', 'fa-get-pocket', 'fa-gg', 'fa-gg-circle', 'fa-git', 'fa-git-square', 'fa-github', 'fa-github-alt', 'fa-github-square', 'fa-gitlab', 'fa-gittip', 'fa-glide', 'fa-glide-g', 'fa-google', 'fa-google-plus', 'fa-google-plus-circle', 'fa-google-plus-official', 'fa-google-plus-square', 'fa-google-wallet', 'fa-gratipay', 'fa-grav', 'fa-hacker-news', 'fa-houzz', 'fa-html5', 'fa-imdb', 'fa-instagram', 'fa-internet-explorer', 'fa-ioxhost', 'fa-joomla', 'fa-jsfiddle', 'fa-lastfm', 'fa-lastfm-square', 'fa-leanpub', 'fa-linkedin', 'fa-linkedin-square', 'fa-linode', 'fa-linux', 'fa-maxcdn', 'fa-meanpath', 'fa-medium', 'fa-meetup', 'fa-mixcloud', 'fa-modx', 'fa-odnoklassniki', 'fa-odnoklassniki-square', 'fa-opencart', 'fa-openid', 'fa-opera', 'fa-optin-monster', 'fa-pagelines', 'fa-paypal', 'fa-pied-piper', 'fa-pied-piper-alt', 'fa-pied-piper-pp', 'fa-pinterest', 'fa-pinterest-p', 'fa-pinterest-square', 'fa-product-hunt', 'fa-qq', 'fa-quora', 'fa-ra', 'fa-ravelry', 'fa-rebel', 'fa-reddit', 'fa-reddit-alien', 'fa-reddit-square', 'fa-renren', 'fa-resistance', 'fa-safari', 'fa-scribd', 'fa-sellsy', 'fa-share-alt', 'fa-share-alt-square', 'fa-shirtsinbulk', 'fa-simplybuilt', 'fa-skyatlas', 'fa-skype', 'fa-slack', 'fa-slideshare', 'fa-snapchat', 'fa-snapchat-ghost', 'fa-snapchat-square', 'fa-soundcloud', 'fa-spotify', 'fa-stack-exchange', 'fa-stack-overflow', 'fa-steam', 'fa-steam-square', 'fa-stumbleupon', 'fa-stumbleupon-circle', 'fa-superpowers', 'fa-telegram', 'fa-tencent-weibo', 'fa-themeisle', 'fa-trello', 'fa-tripadvisor', 'fa-tumblr', 'fa-tumblr-square', 'fa-twitch', 'fa-twitter', 'fa-twitter-square', 'fa-usb', 'fa-viacoin', 'fa-viadeo', 'fa-viadeo-square', 'fa-vimeo', 'fa-vimeo-square', 'fa-vine', 'fa-vk', 'fa-wechat', 'fa-weibo', 'fa-weixin', 'fa-whatsapp', 'fa-wikipedia-w', 'fa-windows', 'fa-wordpress', 'fa-wpbeginner', 'fa-wpexplorer', 'fa-wpforms', 'fa-xing', 'fa-xing-square', 'fa-y-combinator', 'fa-y-combinator-square', 'fa-yahoo', 'fa-yc', 'fa-yc-square', 'fa-yelp', 'fa-yoast', 'fa-youtube', 'fa-youtube-play', 'fa-youtube-square');
				$elegant_icons = array('arrow_up', 'arrow_down', 'arrow_left', 'arrow_right', 'arrow_left-up', 'arrow_right-up', 'arrow_right-down', 'arrow_left-down', 'arrow-up-down', 'arrow_up-down_alt', 'arrow_left-right_alt', 'arrow_left-right', 'arrow_expand_alt2', 'arrow_expand_alt', 'arrow_condense', 'arrow_expand', 'arrow_move', 'arrow_carrot-up', 'arrow_carrot-down', 'arrow_carrot-left', 'arrow_carrot-right', 'arrow_carrot-2up', 'arrow_carrot-2down', 'arrow_carrot-2left', 'arrow_carrot-2right', 'arrow_carrot-up_alt2', 'arrow_carrot-down_alt2', 'arrow_carrot-left_alt2', 'arrow_carrot-right_alt2', 'arrow_carrot-2up_alt2', 'arrow_carrot-2down_alt2', 'arrow_carrot-2left_alt2', 'arrow_carrot-2right_alt2', 'arrow_triangle-up', 'arrow_triangle-down', 'arrow_triangle-left', 'arrow_triangle-right', 'arrow_triangle-up_alt2', 'arrow_triangle-down_alt2', 'arrow_triangle-left_alt2', 'arrow_triangle-right_alt2', 'arrow_back', 'icon_minus-06', 'icon_plus', 'icon_close', 'icon_check', 'icon_minus_alt2', 'icon_plus_alt2', 'icon_close_alt2', 'icon_check_alt2', 'icon_zoom-out_alt', 'icon_zoom-in_alt', 'icon_search', 'icon_box-empty', 'icon_box-selected', 'icon_minus-box', 'icon_plus-box', 'icon_box-checked', 'icon_circle-empty', 'icon_circle-slelected', 'icon_stop_alt2', 'icon_stop', 'icon_pause_alt2', 'icon_pause', 'icon_menu', 'icon_menu-square_alt2', 'icon_menu-circle_alt2', 'icon_ul', 'icon_ol', 'icon_adjust-horiz', 'icon_adjust-vert', 'icon_document_alt', 'icon_documents_alt', 'icon_pencil', 'icon_pencil-edit_alt', 'icon_pencil-edit', 'icon_folder-alt', 'icon_folder-open_alt', 'icon_folder-add_alt', 'icon_info_alt', 'icon_error-oct_alt', 'icon_error-circle_alt', 'icon_error-triangle_alt', 'icon_question_alt2', 'icon_question', 'icon_comment_alt', 'icon_chat_alt', 'icon_vol-mute_alt', 'icon_volume-low_alt', 'icon_volume-high_alt', 'icon_quotations', 'icon_quotations_alt2', 'icon_clock_alt', 'icon_lock_alt', 'icon_lock-open_alt', 'icon_key_alt', 'icon_cloud_alt', 'icon_cloud-upload_alt', 'icon_cloud-download_alt', 'icon_image', 'icon_images', 'icon_lightbulb_alt', 'icon_gift_alt', 'icon_house_alt', 'icon_genius', 'icon_mobile', 'icon_tablet', 'icon_laptop', 'icon_desktop', 'icon_camera_alt', 'icon_mail_alt', 'icon_cone_alt', 'icon_ribbon_alt', 'icon_bag_alt', 'icon_creditcard', 'icon_cart_alt', 'icon_paperclip', 'icon_tag_alt', 'icon_tags_alt', 'icon_trash_alt', 'icon_cursor_alt', 'icon_mic_alt', 'icon_compass_alt', 'icon_pin_alt', 'icon_pushpin_alt', 'icon_map_alt', 'icon_drawer_alt', 'icon_toolbox_alt', 'icon_book_alt', 'icon_calendar', 'icon_film', 'icon_table', 'icon_contacts_alt', 'icon_headphones', 'icon_lifesaver', 'icon_piechart', 'icon_refresh', 'icon_link_alt', 'icon_link', 'icon_loading', 'icon_blocked', 'icon_archive_alt', 'icon_heart_alt', 'icon_printer', 'icon_calulator', 'icon_building', 'icon_floppy', 'icon_drive', 'icon_search-2', 'icon_id', 'icon_id-2', 'icon_puzzle', 'icon_like', 'icon_dislike', 'icon_mug', 'icon_currency', 'icon_wallet', 'icon_pens', 'icon_easel', 'icon_flowchart', 'icon_datareport', 'icon_briefcase', 'icon_shield', 'icon_percent', 'icon_globe', 'icon_globe-2', 'icon_target', 'icon_hourglass', 'icon_balance', 'icon_star_alt', 'icon_star-half_alt', 'icon_star', 'icon_star-half', 'icon_tools', 'icon_tool', 'icon_cog', 'icon_cogs', 'arrow_up_alt', 'arrow_down_alt', 'arrow_left_alt', 'arrow_right_alt', 'arrow_left-up_alt', 'arrow_right-up_alt', 'arrow_right-down_alt', 'arrow_left-down_alt', 'arrow_condense_alt', 'arrow_expand_alt3', 'arrow_carrot_up_alt', 'arrow_carrot-down_alt', 'arrow_carrot-left_alt', 'arrow_carrot-right_alt', 'arrow_carrot-2up_alt', 'arrow_carrot-2dwnn_alt', 'arrow_carrot-2left_alt', 'arrow_carrot-2right_alt', 'arrow_triangle-up_alt', 'arrow_triangle-down_alt', 'arrow_triangle-left_alt', 'arrow_triangle-right_alt', 'icon_minus_alt', 'icon_plus_alt', 'icon_close_alt', 'icon_check_alt', 'icon_zoom-out', 'icon_zoom-in', 'icon_stop_alt', 'icon_menu-square_alt', 'icon_menu-circle_alt', 'icon_document', 'icon_documents', 'icon_pencil_alt', 'icon_folder', 'icon_folder-open', 'icon_folder-add', 'icon_folder_upload', 'icon_folder_download', 'icon_info', 'icon_error-circle', 'icon_error-oct', 'icon_error-triangle', 'icon_question_alt', 'icon_comment', 'icon_chat', 'icon_vol-mute', 'icon_volume-low', 'icon_volume-high', 'icon_quotations_alt', 'icon_clock', 'icon_lock', 'icon_lock-open', 'icon_key', 'icon_cloud', 'icon_cloud-upload', 'icon_cloud-download', 'icon_lightbulb', 'icon_gift', 'icon_house', 'icon_camera', 'icon_mail', 'icon_cone', 'icon_ribbon', 'icon_bag', 'icon_cart', 'icon_tag', 'icon_tags', 'icon_trash', 'icon_cursor', 'icon_mic', 'icon_compass', 'icon_pin', 'icon_pushpin', 'icon_map', 'icon_drawer', 'icon_toolbox', 'icon_book', 'icon_contacts', 'icon_archive', 'icon_heart', 'icon_profile', 'icon_group', 'icon_grid-2x2', 'icon_grid-3x3', 'icon_music', 'icon_pause_alt', 'icon_phone', 'icon_upload', 'icon_download', 'icon_rook', 'icon_printer-alt', 'icon_calculator_alt', 'icon_building_alt', 'icon_floppy_alt', 'icon_drive_alt', 'icon_search_alt', 'icon_id_alt', 'icon_id-2_alt', 'icon_puzzle_alt', 'icon_like_alt', 'icon_dislike_alt', 'icon_mug_alt', 'icon_currency_alt', 'icon_wallet_alt', 'icon_pens_alt', 'icon_easel_alt', 'icon_flowchart_alt', 'icon_datareport_alt', 'icon_briefcase_alt', 'icon_shield_alt', 'icon_percent_alt', 'icon_globe_alt', 'icon_clipboard', 'social_facebook', 'social_twitter', 'social_pinterest', 'social_googleplus', 'social_tumblr', 'social_tumbleupon', 'social_wordpress', 'social_instagram', 'social_dribbble', 'social_vimeo', 'social_linkedin', 'social_rss', 'social_deviantart', 'social_share', 'social_myspace', 'social_skype', 'social_youtube', 'social_picassa', 'social_googledrive', 'social_flickr', 'social_blogger', 'social_spotify', 'social_delicious', 'social_facebook_circle', 'social_twitter_circle', 'social_pinterest_circle', 'social_googleplus_circle', 'social_tumblr_circle', 'social_stumbleupon_circle', 'social_wordpress_circle', 'social_instagram_circle', 'social_dribbble_circle', 'social_vimeo_circle', 'social_linkedin_circle', 'social_rss_circle', 'social_deviantart_circle', 'social_share_circle', 'social_myspace_circle', 'social_skype_circle', 'social_youtube_circle', 'social_picassa_circle', 'social_googledrive_alt2', 'social_flickr_circle', 'social_blogger_circle', 'social_spotify_circle', 'social_delicious_circle', 'social_facebook_square', 'social_twitter_square', 'social_pinterest_square', 'social_googleplus_square', 'social_tumblr_square', 'social_stumbleupon_square', 'social_wordpress_square', 'social_instagram_square', 'social_dribbble_square', 'social_vimeo_square', 'social_linkedin_square', 'social_rss_square', 'social_deviantart_square', 'social_share_square', 'social_myspace_square', 'social_skype_square', 'social_youtube_square', 'social_picassa_square', 'social_googledrive_square', 'social_flickr_square', 'social_blogger_square', 'social_spotify_square', 'social_delicious_square');
				
				$ret  = '<div class="gdlr-core-custom-combobox gdlr-core-html-option-icons-type-combobox" >';
				$ret .= '<select class="gdlr-core-html-option-combobox gdlr-core-html-option-icons-type-select" >';
				if( !empty($settings['allow-none']) ){
					$ret .= '<option value="none" ' . ($font_type == 'none'? 'selected': '') . ' >' . esc_html__('None', 'goodlayers-core') . '</option>';
				}
				$ret .= '<option value="font-awesome" ' . ($font_type == 'font-awesome'? 'selected': '') . ' >' . esc_html__('Font Awesome', 'goodlayers-core') . '</option>';
				$ret .= '<option value="elegant-font" ' . ($font_type == 'elegant-font'? 'selected': '') . ' >' . esc_html__('Elegant Font', 'goodlayers-core') . '</option>';
				$ret .= '</select>';
				$ret .= '</div>';
				
				$ret .= '<input type="text" class="gdlr-core-html-option-text gdlr-core-html-option-icons-search" placeholder="' . esc_html__('Search Icons', 'goodlayers-core') . '" ' . gdlr_core_escape_content($font_none_style) . ' />';

				$ret .= '<div class="gdlr-core-html-option-icons-type-wrapper" ' . gdlr_core_escape_content($font_none_style) . ' >';
				$ret .= '<div class="gdlr-core-html-option-icons-type' . ($font_type == 'font-awesome'? ' gdlr-core-active': '') . '" data-icon-type="font-awesome" >';
				foreach( $fa_icons as $icon ){
					$icon = 'fa ' . $icon;
					$ret .= '<i class="' . esc_attr($icon) . ($value == $icon? ' gdlr-core-active': '') . '" ></i>';
				}
				$ret .= '</div>';
				$ret .= '<div class="gdlr-core-html-option-icons-type' . ($font_type == 'elegant-font'? ' gdlr-core-active': '') . '" data-icon-type="elegant-font" >';
				foreach( $elegant_icons as $icon ){
					$ret .= '<i class="' . esc_attr($icon) . ($value == $icon? ' gdlr-core-active': '') . '" ></i>';
				}
				$ret .= '</div>';
				$ret .= '</div>'; // gdlr-core-html-option-icon-type-wrapper
				
				$ret .= '<input type="hidden" value="' . esc_attr($value) . '" data-type="text" data-slug="' . esc_attr($settings['slug']) . '" />';

				return $ret;
			}
			
			// custom
			static function custom($settings){
				$value = '';
				if( isset($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}

				$ret  = '<div class="gdlr-core-html-option-custom" data-type="custom" data-item-type="' . esc_attr($settings['item-type']) . '" data-slug="' . esc_attr($settings['slug']) . '" ';
				$ret .= empty($settings['data-input-type'])? '': ' data-input-type="' . esc_attr($settings['data-input-type']) . '" ';
				$ret .= '>';
				if( !empty($settings['options']) ){
					$ret .= '<span class="gdlr-core-html-option-custom-options" data-value="' . esc_attr(json_encode($settings['options'])) . '" ></span>';
				}
				if( !empty($value) ){
					$ret .= '<span class="gdlr-core-html-option-custom-value" data-value="' . esc_attr(json_encode($value)) . '" ></span>';
				}
				$ret .= '</div>';
	
				return $ret;
			}	

			// import
			static function import($settings){

				$ret  = '<div class="gdlr-core-html-option-import" data-action="' . esc_attr($settings['action']) . '" >';
				$ret .= '<form method="post" enctype="multipart/form-data" >';
				$ret .= '<input class="gdlr-core-html-option-import-file" type="file" name="gdlr-core-import" >';
				$ret .= '<div class="gdlr-core-html-option-import-button" >' . esc_html__('Import', 'goodlayers-core') . '</div>';
				$ret .= '</form>';
				$ret .= '</div>';
	
				return $ret;
			}

			// export
			static function export($settings){

				$ret  = '<div class="gdlr-core-html-option-export" data-action="' . esc_attr($settings['action']) . '" >';
				if( !empty($settings['options']) ){
					$ret .= '<div class="gdlr-core-custom-combobox" >';
					$ret .= '<select class="gdlr-core-html-option-export-option gdlr-core-html-option-combobox" data-type="combobox" >';
					if( !empty($settings['options']) ){
						foreach($settings['options'] as $option_key => $option_value ){
							$ret .= '<option value="' . esc_attr($option_key) . '" >' . gdlr_core_escape_content($option_value) . '</option>';
						}
					}
					$ret .= '</select>';
					$ret .= '</div>';
				}
				$ret .= '<div class="gdlr-core-html-option-export-button" >' . esc_html__('Export', 'goodlayers-core') . '</div>';
				$ret .= '</div>';
	
				return $ret;
			}
			
			//////////////////////////////////////////////
			// tinymce
			// ref: wp-includes/class-wp-editor.php
			//////////////////////////////////////////////
			static function tinymce($settings){
				$value = '';
				if( isset($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}

				$ret  = '<div class="gdlr-core-html-option-tinymce" data-type="tinymce" data-slug="' . esc_attr($settings['slug']) . '" >';
				$ret .= gdlr_core_escape_content($value);
				$ret .= '</div>';
	
				return $ret;
			}		
			static function tmce_init(){
				
				if( !class_exists('_WP_Editors', false) ){
					require( ABSPATH . WPINC . '/class-wp-editor.php' );
				}
				
				$editor_id = 'gdlr_core_tmce';
				$set = _WP_Editors::parse_settings($editor_id, array());
				$set['editor_class'] .= ' wp-editor-area';
				$set['media_buttons'] = current_user_can('upload_files')? true: false;
				$set['default_editor'] = (wp_default_editor() == 'html')? 'html': 'tinymce';
				$set['switch_button'] = user_can_richedit();
				$set['switch_class'] = ($set['default_editor'] == 'tinymce' &&  $set['switch_button'])? 'tmce-active': 'html-active';
				
				$pb_tmce  = '<div id="wp-' . esc_attr($editor_id) . '-wrap" class="wp-core-ui wp-editor-wrap ' . esc_attr($set['switch_class']) . '">';
				$pb_tmce .= empty($set['editor_css'])? '': $set['editor_css']; 
				if( !empty($set['switch_button']) || !empty($set['media_buttons']) ){
					$pb_tmce .= '<div id="wp-' . esc_attr($editor_id) . '-editor-tools" class="wp-editor-tools hide-if-no-js">';
					if( !empty($set['media_buttons']) ){
						$pb_tmce .= '<div id="wp-' . esc_attr($editor_id) . '-media-buttons" class="wp-media-buttons">';
						
						if( !function_exists('media_buttons') ){
							include(ABSPATH . 'wp-admin/includes/media.php');
						}
						
						ob_start();
						do_action('media_buttons', $editor_id);
						$pb_tmce .= ob_get_contents();
						ob_end_clean();
						
						$pb_tmce .= '</div>'; // wp-media-buttons
					}
					$pb_tmce .= '<div class="wp-editor-tabs">';
					if( $set['switch_button'] ){
						$pb_tmce .= '<button type="button" id="' . esc_attr($editor_id) . '-tmce" class="wp-switch-editor switch-tmce" data-wp-editor-id="' . esc_attr($editor_id) . '">Visual</button>';
						$pb_tmce .= '<button type="button" id="' . esc_attr($editor_id) . '-html" class="wp-switch-editor switch-html" data-wp-editor-id="' . esc_attr($editor_id) . '">Text</button>';
					}
					$pb_tmce .= '</div>'; // wp-editor-tabs
					$pb_tmce .= '</div>'; // wp-editor-tools
				}
				
				// content editor area
				$pb_tmce_content  = '<div id="wp-' . esc_attr($editor_id) . '-editor-container" class="wp-editor-container">';
				$pb_tmce_content .= '<div id="qt_' . esc_attr($editor_id) . '_toolbar" class="quicktags-toolbar"></div>';
				$pb_tmce_content .= '<textarea style="height:300px;" class="' . esc_attr($set['editor_class']) . '" autocomplete="off" cols="40" name="' . esc_attr($set['textarea_name']) . '" id="' . esc_attr($editor_id) . '"></textarea>';
				$pb_tmce_content .= '</div>'; // wp-editor-container
				
				$pb_tmce .= apply_filters('the_editor', $pb_tmce_content);
				$pb_tmce .= '</div>'; // wp-wrap
				
				// remove the fullscreen tmce plugin
				add_filter('tiny_mce_plugins', 'gdlr_core_html_option::tmce_init_plugin', 10, 2);
				
				// action for editor style
				wp_print_styles('editor-buttons');
				_WP_Editors::editor_settings($editor_id, $set);

				$pb_tmce = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $pb_tmce);
				return $pb_tmce;
			} // tmce_init
			static function tmce_init_plugin($plugins){
				// remove fullscreen option
				if( ($key = array_search('fullscreen', $plugins)) !== false ){
					unset($plugins[$key]);
				}
				return $plugins;
			} // tmce_init_plugin
			
			//////////////////////////////////////////////
			// ajax action
			//////////////////////////////////////////////
			
			static function get_gallery_options(){
				
				if( !check_ajax_referer('gdlr_core_html_option', 'security', false) ){
					die(json_encode(array(
						'status' => 'failed',
						'head' => esc_html__('Invalid Nonce', 'goodlayers-core'),
						'message'=> esc_html__('Please refresh the page and try again.' ,'goodlayers-core')
					)));
				}
				
				if( empty($_POST['options']) ){
					die(json_encode(array(
						'status' => 'failed',
						'head' => esc_html__('An Error Occurs', 'goodlayers-core'),
						'message'=> esc_html__('No options defined.' ,'goodlayers-core')
					)));
				}else{
					$_POST['options'] = empty($_POST['options'])? array(): gdlr_core_process_post_data($_POST['options']);
					$_POST['value'] = empty($_POST['value'])? array(): gdlr_core_process_post_data($_POST['value']);
					
					$content  = '<div class="gdlr-core-gallery-lb-options" >';
					$content .= '<div class="gdlr-core-gallery-lb-head" >';
					$content .= '<i class="fa fa-save"></i>';
					$content .= '<span class="gdlr-core-head">' . esc_html__('Gallery Image Options', 'goodlayers-core') . '</span>';
					$content .= '<div class="gdlr-core-gallery-lb-head-close" id="gdlr-core-gallery-lb-head-close" ></div>';
					$content .= '</div>'; // gdlr-core-gallery-lb-head
					
					$content .= '<div class="gdlr-core-gallery-lb-options" >';
					foreach( $_POST['options'] as $option_slug => $option_val ){
						$option_val['slug'] = $option_slug;
						if( !empty($_POST['value'][$option_slug]) ){
							$option_val['value'] = $_POST['value'][$option_slug];
						}
						$content .= gdlr_core_html_option::get_element($option_val);	
					}
					$content .= '</div>'; // gdlr-core-gallery-lb-content
					
					$content .= '<div class="gdlr-core-gallery-lb-options-save" id="gdlr-core-gallery-lb-options-save" >';
					$content .= '<i class="fa fa-save"></i>' . esc_html__('Save Options', 'goodlayers-core');
					$content .= '</div>';
					$content .= '</div>'; // gdlr-core-gallery-lb-options
					
				}
				
				die( json_encode(array(
					'status' => 'success',
					'option_content' => $content
				)) ); 
				
			}
			
		} // gdlr_core_html_option
	
	} // class_exists