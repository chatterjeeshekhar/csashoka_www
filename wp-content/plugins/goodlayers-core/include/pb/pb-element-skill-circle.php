<?php
	/*	
	*	Goodlayers Item For Page Builder
	*/
	
	gdlr_core_page_builder_element::add_element('skill-circle', 'gdlr_core_pb_element_skill_circle_item'); 
	
	if( !class_exists('gdlr_core_pb_element_skill_circle_item') ){
		class gdlr_core_pb_element_skill_circle_item{
			
			// get the element settings
			static function get_settings(){
				return array(
					'icon' => 'icon_piechart',
					'title' => esc_html__('Skill Circle', 'goodlayers-core')
				);
			}
			
			// return the element options
			static function get_options(){
				global $gdlr_core_item_pdb;
				
				return array(
					'general' => array(
						'title' => esc_html__('General', 'goodlayers-core'),
						'options' => array(
							'item-size' => array(
								'title' => esc_html__('Item Size', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'small' => esc_html__('Small', 'goodlayers-core'),
									'large' => esc_html__('Large', 'goodlayers-core'),
								),
								'default' => 'large'
							),
							'heading-text' => array(
								'title' => esc_html__('Heading Text', 'goodlayers-core'),
								'type' => 'text'
							), 
							'percent' => array(
								'title' => esc_html__('Percent', 'goodlayers-core'),
								'type' => 'text',
								'default' => 80,
								'data-input-type' => 'number',
								'description' => esc_html__('Only fill the number here', 'goodlayers-core'),
							), 
							'bar-text' => array(
								'title' => esc_html__('Bar Text', 'goodlayers-core'),
								'type' => 'text',
								'default' => esc_html__('Skill Circle', 'goodlayers-core'),
							), 
						),
					),
					'style' => array(
						'title' => esc_html__('Style', 'goodlayers-core'),
						'options' => array(
							'item-align' => array(
								'title' => esc_html__('Item Alignment', 'goodlayers-core'),
								'type' => 'radioimage',
								'options' => 'text-align',
								'default' => 'center'
							)
						)
					),					
					'color' => array(
						'title' => esc_html__('Color', 'goodlayers-core'),
						'options' => array(
							'heading-text-color' => array(
								'title' => esc_html__('Heading Text Color', 'goodlayers-core'),
								'type' => 'colorpicker',
								'default' => '#2d2d2d'
							),
							'text-color' => array(
								'title' => esc_html__('Text Color', 'goodlayers-core'),
								'type' => 'colorpicker',
								'default' => '#2d2d2d'
							),
							'bar-filled-color' => array(
								'title' => esc_html__('Bar Filled Color', 'goodlayers-core'),
								'type' => 'colorpicker',
								'default' => '#2d9bea'
							),
							'bar-background-color' => array(
								'title' => esc_html__('Bar Background Color', 'goodlayers-core'),
								'type' => 'colorpicker',
								'default' => '#dcdcdc'
							),
							'circle-background-color' => array(
								'title' => esc_html__('Circle Background Color', 'goodlayers-core'),
								'type' => 'colorpicker',
							)
						)
					),
					'spacing' => array(
						'title' => esc_html__('Spacing', 'goodlayers-core'),
						'options' => array(
							'padding-bottom' => array(
								'title' => esc_html__('Padding Bottom ( Item )', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => $gdlr_core_item_pdb
							)
						)
					)
					
				);
			}

			// get the preview for page builder
			static function get_preview( $settings = array() ){
				$content  = self::get_content($settings);
				$id = mt_rand(0, 9999);
				
				ob_start();
?><script id="gdlr-core-preview-skill-circle-<?php echo esc_attr($id); ?>" >
jQuery(document).ready(function(){
	jQuery('#gdlr-core-preview-skill-circle-<?php echo esc_attr($id); ?>').parent().gdlr_core_skill_circle();
});
</script><?php	
				$content .= ob_get_contents();
				ob_end_clean();				
				return $content;
			}		
			
			// get the content from settings
			static function get_content( $settings = array() ){
				global $gdlr_core_item_pdb;
				
				// default variable
				if( empty($settings) ){
					$settings = array(
						'item-size' => 'large', 'percent' => 80, 'heading-text' => '', 'item-align' => 'center',
						'bar-text'=>esc_html__('Skill Circle', 'goodlayers-core'),
						'padding-bottom' => $gdlr_core_item_pdb
					);
				}

				// default size
				$settings['top-icon-size'] = (empty($settings['top-icon-size']) || $settings['top-icon-size'] == '30px')? '': $settings['top-icon-size'];
				$settings['top-text-size'] = (empty($settings['top-text-size']) || $settings['top-text-size'] == '16px')? '': $settings['top-text-size'];
				$settings['number-size'] = (empty($settings['number-size']) || $settings['number-size'] == '59px')? '': $settings['number-size'];
				$settings['bottom-text-size'] = (empty($settings['bottom-text-size']) || $settings['bottom-text-size'] == '16px')? '': $settings['bottom-text-size'];
				$settings['item-align'] = empty($settings['item-align'])? 'center': $settings['item-align'];
				$settings['item-size'] = empty($settings['item-size'])? 'large': $settings['item-size'];
				
				if( $settings['item-size'] == 'small' ){
					$max_width = '165px';
					$bar_width = 4;
				}else if( $settings['item-size'] == 'large' ){
					$max_width = '265px';
					$bar_width = 6;
				}
				
				// start printing item
				$extra_class  = empty($settings['class'])? '': $settings['class'];
				$ret  = '<div class="gdlr-core-skill-circle-item gdlr-core-item-pdlr gdlr-core-item-pdb ' . esc_attr($extra_class) . '" ';
				if( !empty($settings['padding-bottom']) && $settings['padding-bottom'] != $gdlr_core_item_pdb ){
					$ret .= gdlr_core_esc_style(array('padding-bottom'=>$settings['padding-bottom']));
				}
				if( !empty($settings['id']) ){
					$ret .= ' id="' . esc_attr($settings['id']) . '" ';
				}
				$ret .= ' >';
				
				$item_class  = ' gdlr-core-skill-circle gdlr-core-js';
				$item_class .= ' gdlr-core-skill-circle-align-' . esc_attr($settings['item-align']);
				$item_class .= ' gdlr-core-skill-circle-size-' . esc_attr($settings['item-size']);
				
				$ret .= '<div class="' . esc_attr($item_class) . '" ';
				$ret .= 'data-percent="' . esc_attr($settings['percent']) . '" ';
				$ret .= 'data-width="' . esc_attr($max_width) . '" ';
				$ret .= 'data-duration="1200" ';
				$ret .= 'data-line-width="' . esc_attr($bar_width) . '" ';
				$ret .= 'data-filled-color="' . (empty($settings['bar-filled-color'])? '#2d9bea': esc_attr($settings['bar-filled-color'])) . '" '; 
				$ret .= 'data-filled-background="' . (empty($settings['bar-background-color'])? '#dcdcdc': esc_attr($settings['bar-background-color'])) . '" '; 
				$ret .= gdlr_core_esc_style(array(
					'width' => $max_width, 
					'height' => $max_width,
					'border-color' => empty($settings['bar-background-color'])? '': $settings['bar-background-color'],	
					'background-color' => empty($settings['circle-background-color'])? '': $settings['circle-background-color']
				)) . ' >'; 
				$ret .= '<div class="gdlr-core-skill-circle-content gdlr-core-title-font" >';
				$ret .= '<div class="gdlr-core-skill-circle-head" ' . gdlr_core_esc_style(array(
					'color' => empty($settings['heading-text-color'])? '#2d2d2d': $settings['heading-text-color']
				)) . ' >';
				if( !empty($settings['heading-text']) ){
					$ret .= gdlr_core_escape_content($settings['heading-text']);
				}else{
					$ret .= $settings['percent'] . '%';
				}
				$ret .= '</div>'; // gdlr-core-skill-circle-head
				
				if( !empty($settings['bar-text']) ){
					$ret .= '<div class="gdlr-core-skill-circle-caption" ' . gdlr_core_esc_style(array(
						'color' => empty($settings['text-color'])? '#2d2d2d': $settings['text-color']
					)) . ' >';
					$ret .= gdlr_core_escape_content($settings['bar-text']);
					$ret .= '</div>';
				}
				$ret .= '</div>'; // gdlr-core-skill-circle-content
				$ret .= '</div>'; // gdlr-core-skill-circle

				// 'heading-text' => '', 'percent'
				
				$ret .= '</div>'; // gdlr-core-skill-bar-item
				
				return $ret;
			}			
			
		} // gdlr_core_pb_element_skill_circle_item
	} // class_exists	