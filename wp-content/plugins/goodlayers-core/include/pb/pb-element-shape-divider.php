<?php
	/*	
	*	Goodlayers Item For Page Builder
	*/
	
	gdlr_core_page_builder_element::add_element('shape-divider', 'gdlr_core_pb_element_shape_divider'); 
	
	if( !class_exists('gdlr_core_pb_element_shape_divider') ){
		class gdlr_core_pb_element_shape_divider{
			
			// get the element settings
			static function get_settings(){
				return array(
					'icon' => 'fa-align-justify',
					'title' => esc_html__('Shape Divider', 'goodlayers-core')
				);
			}
			
			// return the element options
			static function get_options(){
				global $gdlr_core_item_pdb;
				
				return array(
					'general' => array(
						'title' => esc_html__('General', 'goodlayers-core'),
						'options' => array(
							'position' => array(
								'title' => esc_html__('Position', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'top' => esc_html__('Top', 'goodlayers-core'),
									'bottom' => esc_html__('Bottom', 'goodlayers-core')
								)
							),
							'shape' => array(
								'title' => esc_html__('Shape', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'book' => esc_html__('Book', 'goodlayers-core'),
									'curve-asymmetrical' => esc_html__('Curve Asymmetrical', 'goodlayers-core'),
									'fan-opacity' => esc_html__('Fan Opacity', 'goodlayers-core'),
									'mountains' => esc_html__('Mountains', 'goodlayers-core'),
									'pyramids' => esc_html__('Pyramids', 'goodlayers-core'),
									'tilt' => esc_html__('Tilt', 'goodlayers-core'),
									'tilt-opacity' => esc_html__('Tilt Opacity', 'goodlayers-core'),
									'triangle' => esc_html__('Triangle', 'goodlayers-core'),
									'triangle-asymmetrical' => esc_html__('Triangle Asymmetrical', 'goodlayers-core'),
									'waves' => esc_html__('Waves', 'goodlayers-core'),
									'waves-pattern' => esc_html__('Waves Pattern', 'goodlayers-core'),
									'zig-zag' => esc_html__('Zig Zag', 'goodlayers-core'),
								)
							),
							'inverted' => array(
								'title' => esc_html__('Inverted', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'disable',
								'condition' => array( 'shape' => array('book', 'curve-asymmetrical', 'pyramids', 'triangle', 'triangle-asymmetrical', 'waves') )
							),
							'flip' => array(
								'title' => esc_html__('Flip', 'goodlayers-core'),
								'type' => 'checkbox',
								'default' => 'disable'
							),
							'opacity' => array(
								'title' => esc_html__('Opacity', 'goodlayers-core'),
								'type' => 'text',
								'description' => esc_html__('Fill the number between 0.01 to 1', 'goodlayers-core')
							), 
							'color' => array(
								'title' => esc_html__('Color', 'goodlayers-core'),
								'type' => 'colorpicker',
							),
							'width' => array(
								'title' => esc_html__('Width % ( Min value is 100 )', 'goodlayers-core'),
								'type' => 'text',
							),
							'height' => array(
								'title' => esc_html__('Height', 'goodlayers-core'),
								'data-input-type' => 'pixel',
								'type' => 'text',
							),
							'hide-this-item-in' => array(
								'title' => esc_html__('Hide This Item In', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'none' => esc_html__('None', 'goodlayers-core'),
									'desktop' => esc_html__('Desktop', 'goodlayers-core'),
									'desktop-tablet' => esc_html__('Desktop & Tablet', 'goodlayers-core'),
									'tablet' => esc_html__('Tablet', 'goodlayers-core'),
									'tablet-mobile' => esc_html__('Tablet & Mobile', 'goodlayers-core'),
									'mobile' => esc_html__('Mobile', 'goodlayers-core'),
								)
							), 
						)
					),
				);
			}
			
			// get the preview for page builder
			static function get_preview( $settings = array() ){
				$content  = self::get_content($settings, true);
				$id = mt_rand(0, 9999);
				
				ob_start();
?><script id="gdlr-core-preview-shape-divider-<?php echo esc_attr($id); ?>" >
jQuery(document).ready(function(){
	jQuery('#gdlr-core-preview-shape-divider-<?php echo esc_attr($id); ?>').parent();
});
</script><?php	
				$content .= ob_get_contents();
				ob_end_clean();
				
				return $content;
			}			
			
			// get the content from settings
			static function get_content( $settings = array(), $preview = false ){
				// default variable
				if( empty($settings) ){
					$settings = array();
				}

				$settings['shape'] = empty($settings['shape'])? 'book': $settings['shape'];
				$settings['position'] = empty($settings['position'])? 'top': $settings['position'];
				$settings['inverted'] = empty($settings['inverted'])? 'disable': $settings['inverted'];
				$settings['flip'] = empty($settings['flip'])? 'disable': $settings['flip'];

				$custom_css = '';
				if( !empty($settings['color']) ){
					$custom_css .= '#id svg path{ fill: ' . $settings['color'] . '; }';
				}
				if( !empty($settings['opacity']) ){
					$custom_css .= '#id svg path{ opacity: ' . $settings['opacity'] . '; }';
				}
				if( !empty($settings['width']) ){
					$width = intval($settings['width']);
					if( $width > 100 ){
						$custom_css .= '#id svg{ width: ' . $width . '%; }';
					}
				}
				if( !empty($settings['height']) ){
					$custom_css .= '#id svg{ height: ' . $settings['height'] . '; }';
				}

				if( !empty($custom_css) && empty($settings['id']) ){
					global $gdlr_core_shape_divider_id; 
					$gdlr_core_shape_divider_id = empty($gdlr_core_shape_divider_id)? array(): $gdlr_core_shape_divider_id;
					
					// generate unique id so it does not get overwritten in admin area
					$rnd_id = mt_rand(0, 99999);
					while( in_array($rnd_id, $gdlr_core_shape_divider_id) ){
						$rnd_id = mt_rand(0, 99999);
					}
					$gdlr_core_shape_divider_id[] = $rnd_id;
					$settings['id'] = 'gdlr-core-shape-divider-' . $rnd_id;

					$custom_css = str_replace('#id', '#' . $settings['id'], $custom_css);
				}

				$additional_class  = ' gdlr-core-pos-' . $settings['position'];
				$additional_class .= ($preview)? ' gdlr-core-preview': '';
				$additional_class .= ($settings['flip'] == 'enable')? ' gdlr-core-flip': '';
				if( !empty($settings['hide-this-item-in']) && $settings['hide-this-item-in'] != 'none' ){
					$additional_class .= ' gdlr-core-hide-in-' . $settings['hide-this-item-in'];
				}

				if( $settings['inverted'] == 'enable' ){
					if( in_array($settings['shape'], array('book', 'curve-asymmetrical', 'pyramids', 'triangle', 'triangle-asymmetrical', 'waves')) ){
						$settings['shape'] .= '-negative';
						$additional_class .= ' gdlr-core-inverted';
					}else{
						$settings['inverted'] = 'disable';
					}
				}

				// start printing item
				$ret = '';
				if( !empty($custom_css) ){
					$ret .= '<style>' . $custom_css . '</style>';
				}

				$ret .= '<div class="gdlr-core-shape-divider-item" ';
				if( !empty($settings['id']) ){
					$ret .= ' id="' . esc_attr($settings['id']) . '" ';
				}
				$ret .= ' >';

				if( $preview && $settings['position'] == 'top' ){
					$ret .= '<div class="gdlr-core-preview-text" >';
					$ret .= esc_html__('This item will shows at the very top of the section on front end of the site.', 'goodlayers-core');
					$ret .= '</div>';
				}

				$ret .= '<div class="gdlr-core-shape-divider-wrap ' . esc_attr($additional_class) . '" >';
				$ret .= self::get_shape_content($settings['shape']);
				$ret .= '</div>';

				if( $preview && $settings['position'] == 'bottom' ){
					$ret .= '<div class="gdlr-core-preview-text" >';
					$ret .= esc_html__('This item will shows at the very bottom of the section on front end of the site.', 'goodlayers-core');
					$ret .= '</div>';
				}

				$ret .= '</div>';
				
				return $ret;
			}

			static function get_shape_content($shape){

				ob_start();
				include GDLR_CORE_LOCAL . '/include/css/shapes/' . $shape . '.svg';
				$ret = ob_get_contents();
				ob_end_clean();

				return $ret;
			}
			
		} // gdlr_core_pb_element_shape_divider
	} // class_exists	