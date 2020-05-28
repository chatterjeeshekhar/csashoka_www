<?php
	/*
	*	Goodlayers Item For Page Builder
	*/

	gdlr_core_page_builder_element::add_element('price-table', 'gdlr_core_pb_element_price_table');

	if( !class_exists('gdlr_core_pb_element_price_table') ){
		class gdlr_core_pb_element_price_table{

			// get the element settings
			static function get_settings(){
				return array(
					'icon' => 'fa-dollar',
					'title' => esc_html__('Price Table', 'goodlayers-core')
				);
			}

			// return the element options
			static function get_options(){
				global $gdlr_core_item_pdb;

				$default_price_list  = '[gdlr_core_price_list icon="fa fa-check" ]<ul>'. "\n";
				$default_price_list .= '<li>' . esc_html__('Price default list', 'goodlayers-core') . '</li>' . "\n";
				$default_price_list .= '<li>' . esc_html__('Price default list', 'goodlayers-core') . '</li>' . "\n";
				$default_price_list .= '<li>' . esc_html__('Price default list', 'goodlayers-core') . '</li>' . "\n";
				$default_price_list .= '<li>' . esc_html__('Price default list', 'goodlayers-core') . '</li>' . "\n";
				$default_price_list .= '</ul>[/gdlr_core_price_list]';

				return array(
					'general' => array(
						'title' => esc_html__('General', 'goodlayers-core'),
						'options' => array(
							'tabs' => array(
								'title' => esc_html__('Add New Price', 'goodlayers-core'),
								'type' => 'custom',
								'item-type' => 'tabs',
								'wrapper-class' => 'gdlr-core-fullsize',
								'options' => array(
									'icon' => array(
										'title' => esc_html__('Icon', 'goodlayers-core'),
										'type' => 'text'
									),
									'image' => array(
										'title' => esc_html__('Image ( Icon will be omitted )', 'goodlayers-core'),
										'type' => 'upload'
									),
									'title' => array(
										'title' => esc_html__('Title', 'goodlayers-core'),
										'type' => 'text'
									),
									'caption' => array(
										'title' => esc_html__('Caption', 'goodlayers-core'),
										'type' => 'text'
									),
									'price' => array(
										'title' => esc_html__('Price', 'goodlayers-core'),
										'type' => 'text'
									),
									'content' => array(
										'title' => esc_html__('Content', 'goodlayers-core'),
										'type' => 'textarea'
									),
									'button-text' => array(
										'title' => esc_html__('Button Text', 'goodlayers-core'),
										'type' => 'text',
									),
									'button-link' => array(
										'title' => esc_html__('Button Link', 'goodlayers-core'),
										'type' => 'text'
									),
									'button-link-target' => array(
										'title' => esc_html__('Button Link Target', 'goodlayers-core'),
										'type' => 'combobox',
										'options' => array(
											'_self' => esc_html__('Current Screen', 'goodlayers-core'),
											'_blank' => esc_html__('New Window', 'goodlayers-core'),
										)
									),
									'feature-price' => array(
										'title' => esc_html__('Feature Price', 'goodlayers-core'),
										'type' => 'checkbox'
									),
								),
								'default' => array(
									array(
										'icon' => 'fa fa-star-o',
										'title' => esc_html__('Price Default Title', 'goodlayers-core'),
										'caption' => esc_html__('Price default caption', 'goodlayers-core'),
										'price' => '10',
										'content' => $default_price_list,
										'button-text' => esc_html__('Learn More', 'goodlayers-core'),
										'button-link' => '#',
										'button-link-target' => '_self',
										'feature-price' => 'disable'
									),
									array(
										'icon' => 'fa fa-star-o',
										'title' => esc_html__('Price Default Title', 'goodlayers-core'),
										'caption' => esc_html__('Price default caption', 'goodlayers-core'),
										'price' => '49',
										'content' => $default_price_list,
										'button-text' => esc_html__('Learn More', 'goodlayers-core'),
										'button-link' => '#',
										'button-link-target' => '_self',
										'feature-price' => 'enable'
									),
									array(
										'icon' => 'fa fa-star-o',
										'title' => esc_html__('Price Default Title', 'goodlayers-core'),
										'caption' => esc_html__('Price default caption', 'goodlayers-core'),
										'price' => '99',
										'content' => $default_price_list,
										'button-text' => esc_html__('Learn More', 'goodlayers-core'),
										'button-link' => '#',
										'button-link-target' => '_self',
										'feature-price' => 'disable'
									),
									array(
										'icon' => 'fa fa-star-o',
										'title' => esc_html__('Price Default Title', 'goodlayers-core'),
										'caption' => esc_html__('Price default caption', 'goodlayers-core'),
										'price' => '149',
										'content' => $default_price_list,
										'button-text' => esc_html__('Learn More', 'goodlayers-core'),
										'button-link' => '#',
										'button-link-target' => '_self',
										'feature-price' => 'disable'
									),
								)
							),
							'price-prefix' => array(
								'title' => esc_html__('Price Prefix', 'goodlayers-core'),
								'type' => 'text',
								'default' => '$'
							),
							'price-suffix' => array(
								'title' => esc_html__('Price Suffix', 'goodlayers-core'),
								'type' => 'text',
								'default' => esc_html__('/ MO', 'goodlayers-core')
							)
						),
					),
					'style' => array(
						'title' => esc_html__('Color', 'goodlayers-core'),
						'options' => array(
							'header-color' => array(
								'title' => esc_html__('Header Background Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'header-gradient-color' => array(
								'title' => esc_html__('Header Background (Top Gradient) Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							), 
							'icon-color' => array(
								'title' => esc_html__('Icon Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'title-color' => array(
								'title' => esc_html__('Title Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'caption-color' => array(
								'title' => esc_html__('Caption Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'price-background-color' => array(
								'title' => esc_html__('Price Background Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'price-prefix-color' => array(
								'title' => esc_html__('Price Prefix Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'price-text-color' => array(
								'title' => esc_html__('Price Text Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'price-suffix-color' => array(
								'title' => esc_html__('Price Suffix Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							), 
							'content-background-color' => array(
								'title' => esc_html__('Content Background Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'content-color' => array(
								'title' => esc_html__('Content Text Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'content-border-color' => array(
								'title' => esc_html__('Content Border Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'button-text-color' => array(
								'title' => esc_html__('Button Text Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'button-background-color' => array(
								'title' => esc_html__('Button Background Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'button-background-gradient-color' => array(
								'title' => esc_html__('Button Background (Top Gradient) Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
						),
					),
					'a-style' => array(
						'title' => esc_html__('Color (Feature)', 'goodlayers-core'),
						'options' => array(
							'a-header-color' => array(
								'title' => esc_html__('Header Background Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-header-gradient-color' => array(
								'title' => esc_html__('Header Background (Top Gradient) Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-icon-color' => array(
								'title' => esc_html__('Icon Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-title-color' => array(
								'title' => esc_html__('Title Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-caption-color' => array(
								'title' => esc_html__('Caption Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-price-background-color' => array(
								'title' => esc_html__('Price Background Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-price-prefix-color' => array(
								'title' => esc_html__('Price Prefix Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-price-text-color' => array(
								'title' => esc_html__('Price Text Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-price-suffix-color' => array(
								'title' => esc_html__('Price Suffix Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-content-background-color' => array(
								'title' => esc_html__('Content Background Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-content-color' => array(
								'title' => esc_html__('Content Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-content-border-color' => array(
								'title' => esc_html__('Content Border Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-button-text-color' => array(
								'title' => esc_html__('Button Text Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-button-background-color' => array(
								'title' => esc_html__('Button Background Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
							'a-button-background-gradient-color' => array(
								'title' => esc_html__('Button Background (Top Gradient) Color', 'goodlayers-core'),
								'type' => 'colorpicker'
							),
						),
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
				$content  = self::get_content($settings, true);
				$id = mt_rand(0, 9999);

				ob_start();
?><script id="gdlr-core-preview-accordion-<?php echo esc_attr($id); ?>" >
jQuery(document).ready(function(){
	jQuery('#gdlr-core-preview-accordion-<?php echo esc_attr($id); ?>').parent().gdlr_core_tab();
});
</script><?php
				$content .= ob_get_contents();
				ob_end_clean();

				return $content;
			}

			// get the content from settings
			static function get_content( $settings = array(), $preview = false ){
				global $gdlr_core_item_pdb;

				// default variable
				if( empty($settings) ){

					$default_price_list  = '[gdlr_core_price_list icon="fa fa-check" ]<ul>'. "\n";
					$default_price_list .= '<li>' . esc_html__('Price default list', 'goodlayers-core') . '</li>' . "\n";
					$default_price_list .= '<li>' . esc_html__('Price default list', 'goodlayers-core') . '</li>' . "\n";
					$default_price_list .= '<li>' . esc_html__('Price default list', 'goodlayers-core') . '</li>' . "\n";
					$default_price_list .= '<li>' . esc_html__('Price default list', 'goodlayers-core') . '</li>' . "\n";
					$default_price_list .= '</ul>[/gdlr_core_price_list]';

					$settings = array(
						'tabs' => array(
							array(
								'icon' => 'fa fa-star-o',
								'title' => esc_html__('Price Default Title', 'goodlayers-core'),
								'caption' => esc_html__('Price default caption', 'goodlayers-core'),
								'price' => '10',
								'content' => $default_price_list,
								'button-text' => esc_html__('Learn More', 'goodlayers-core'),
								'button-link' => '#',
								'button-link-target' => '_self',
								'feature-price' => 'disable'
							),
							array(
								'icon' => 'fa fa-star-o',
								'title' => esc_html__('Price Default Title', 'goodlayers-core'),
								'caption' => esc_html__('Price default caption', 'goodlayers-core'),
								'price' => '49',
								'content' => $default_price_list,
								'button-text' => esc_html__('Learn More', 'goodlayers-core'),
								'button-link' => '#',
								'button-link-target' => '_self',
								'feature-price' => 'enable'
							),
							array(
								'icon' => 'fa fa-star-o',
								'title' => esc_html__('Price Default Title', 'goodlayers-core'),
								'caption' => esc_html__('Price default caption', 'goodlayers-core'),
								'price' => '99',
								'content' => $default_price_list,
								'button-text' => esc_html__('Learn More', 'goodlayers-core'),
								'button-link' => '#',
								'button-link-target' => '_self',
								'feature-price' => 'disable'
							),
							array(
								'icon' => 'fa fa-star-o',
								'title' => esc_html__('Price Default Title', 'goodlayers-core'),
								'caption' => esc_html__('Price default caption', 'goodlayers-core'),
								'price' => '149',
								'content' => $default_price_list,
								'button-text' => esc_html__('Learn More', 'goodlayers-core'),
								'button-link' => '#',
								'button-link-target' => '_self',
								'feature-price' => 'disable'
							),
						),
						'price-prefix' => '$',
						'price-suffix' => esc_html__('/ MO', 'goodlayers-core'),
						'padding-bottom' => $gdlr_core_item_pdb
					);
				}

				// custom style
				$custom_style  = '';
				$custom_style .= empty($settings['icon-color'])? '': " #custom_style_id .gdlr-core-price-table .gdlr-core-price-table-icon{ color: {$settings['icon-color']}; }";
				$custom_style .= empty($settings['title-color'])? '': " #custom_style_id .gdlr-core-price-table .gdlr-core-price-table-title{ color: {$settings['title-color']}; }";
				$custom_style .= empty($settings['caption-color'])? '': " #custom_style_id .gdlr-core-price-table .gdlr-core-price-table-caption{ color: {$settings['caption-color']}; }";
				$custom_style .= empty($settings['price-background-color'])? '': " #custom_style_id .gdlr-core-price-table .gdlr-core-price-table-price{ background-color: {$settings['price-background-color']}; }";
				$custom_style .= empty($settings['price-prefix-color'])? '': " #custom_style_id .gdlr-core-price-table .gdlr-core-price-prefix{ color: {$settings['price-prefix-color']}; }";
				$custom_style .= empty($settings['price-text-color'])? '': " #custom_style_id .gdlr-core-price-table .gdlr-core-price-table-price-number{ color: {$settings['price-text-color']}; }";
				$custom_style .= empty($settings['price-suffix-color'])? '': " #custom_style_id .gdlr-core-price-table .gdlr-core-price-suffix{ color: {$settings['price-suffix-color']}; }";
				$custom_style .= empty($settings['content-background-color'])? '': " #custom_style_id .gdlr-core-price-table{ background-color: {$settings['content-background-color']}; }";
				$custom_style .= empty($settings['content-color'])? '': " #custom_style_id .gdlr-core-price-table .gdlr-core-price-table-content{ color: {$settings['content-color']}; }";
				$custom_style .= empty($settings['content-border-color'])? '': " #custom_style_id .gdlr-core-price-table .gdlr-core-price-table-content *{ border-color: {$settings['content-border-color']}; }";
				if( !empty($settings['header-color']) ){
					$custom_style .= " #custom_style_id .gdlr-core-price-table .gdlr-core-price-table-head{ background: {$settings['header-color']};";
					if( !empty($settings['header-gradient-color']) ){
						$custom_style .= "background: -webkit-linear-gradient({$settings['header-gradient-color']}, {$settings['header-color']});";
						$custom_style .= "background: -o-linear-gradient({$settings['header-gradient-color']}, {$settings['header-color']});";
						$custom_style .= "background: -moz-linear-gradient({$settings['header-gradient-color']}, {$settings['header-color']});";
						$custom_style .= "background: linear-gradient({$settings['header-gradient-color']}, {$settings['header-color']});";
					}
					$custom_style .= "}";
				}
				if( !empty($settings['button-text-color']) || !empty($settings['button-background-color']) ){
					$custom_style .= ' #custom_style_id .gdlr-core-price-table .gdlr-core-price-table-button, #custom_style_id .gdlr-core-price-table .gdlr-core-price-table-button:hover{';
					$custom_style .= empty($settings['button-background-color'])? '': "background: {$settings['button-background-color']};";
					$custom_style .= empty($settings['button-text-color'])? '': "color: {$settings['button-text-color']};";
					if( !empty($settings['button-background-gradient-color']) ){
						$custom_style .= "background: -webkit-linear-gradient({$settings['button-background-gradient-color']}, {$settings['button-background-color']});";
						$custom_style .= "background: -o-linear-gradient({$settings['button-background-gradient-color']}, {$settings['button-background-color']});";
						$custom_style .= "background: -moz-linear-gradient({$settings['button-background-gradient-color']}, {$settings['button-background-color']});";
						$custom_style .= "background: linear-gradient({$settings['button-background-gradient-color']}, {$settings['button-background-color']});";
					}
					$custom_style .= '}';
				}

				// active state
				$custom_style .= empty($settings['a-icon-color'])? '': " #custom_style_id .gdlr-core-price-table.gdlr-core-active .gdlr-core-price-table-icon{ color: {$settings['a-icon-color']}; }";
				$custom_style .= empty($settings['a-title-color'])? '': " #custom_style_id .gdlr-core-price-table.gdlr-core-active .gdlr-core-price-table-title{ color: {$settings['a-title-color']}; }";
				$custom_style .= empty($settings['a-caption-color'])? '': " #custom_style_id .gdlr-core-price-table.gdlr-core-active .gdlr-core-price-table-caption{ color: {$settings['a-caption-color']}; }";
				$custom_style .= empty($settings['a-price-background-color'])? '': " #custom_style_id .gdlr-core-price-table.gdlr-core-active .gdlr-core-price-table-price{ background-color: {$settings['a-price-background-color']}; }";
				$custom_style .= empty($settings['a-price-prefix-color'])? '': " #custom_style_id .gdlr-core-price-table.gdlr-core-active .gdlr-core-price-prefix{ color: {$settings['a-price-prefix-color']}; }";
				$custom_style .= empty($settings['a-price-text-color'])? '': " #custom_style_id .gdlr-core-price-table.gdlr-core-active .gdlr-core-price-table-price-number{ color: {$settings['a-price-text-color']}; }";
				$custom_style .= empty($settings['a-price-suffix-color'])? '': " #custom_style_id .gdlr-core-price-table.gdlr-core-active .gdlr-core-price-suffix{ color: {$settings['a-price-suffix-color']}; }";
				$custom_style .= empty($settings['a-content-background-color'])? '': " #custom_style_id .gdlr-core-price-table.gdlr-core-active{ background-color: {$settings['a-content-background-color']}; }";
				$custom_style .= empty($settings['a-content-color'])? '': " #custom_style_id .gdlr-core-price-table.gdlr-core-active .gdlr-core-price-table-content{ color: {$settings['a-content-color']}; }";
				$custom_style .= empty($settings['a-content-border-color'])? '': " #custom_style_id .gdlr-core-price-table.gdlr-core-active .gdlr-core-price-table-content *{ border-color: {$settings['a-content-border-color']}; }";
				if( !empty($settings['a-header-color']) ){
					$custom_style .= " #custom_style_id .gdlr-core-price-table.gdlr-core-active .gdlr-core-price-table-head{ background: {$settings['a-header-color']};";
					if( !empty($settings['a-header-gradient-color']) ){
						$custom_style .= "background: -webkit-linear-gradient({$settings['a-header-gradient-color']}, {$settings['a-header-color']});";
						$custom_style .= "background: -o-linear-gradient({$settings['a-header-gradient-color']}, {$settings['a-header-color']});";
						$custom_style .= "background: -moz-linear-gradient({$settings['a-header-gradient-color']}, {$settings['a-header-color']});";
						$custom_style .= "background: linear-gradient({$settings['a-header-gradient-color']}, {$settings['a-header-color']});";
					}
					$custom_style .= "}";
				}
				if( !empty($settings['a-button-text-color']) || !empty($settings['a-button-background-color']) ){
					$custom_style .= ' #custom_style_id .gdlr-core-price-table.gdlr-core-active .gdlr-core-price-table-button, #custom_style_id .gdlr-core-price-table.gdlr-core-active .gdlr-core-price-table-button:hover{';
					$custom_style .= empty($settings['a-button-background-color'])? '': "background: {$settings['a-button-background-color']};";
					$custom_style .= empty($settings['a-button-text-color'])? '': "color: {$settings['a-button-text-color']};";
					if( !empty($settings['button-background-gradient-color']) ){
						$custom_style .= "background: -webkit-linear-gradient({$settings['a-button-background-gradient-color']}, {$settings['a-button-background-color']});";
						$custom_style .= "background: -o-linear-gradient({$settings['a-button-background-gradient-color']}, {$settings['a-button-background-color']});";
						$custom_style .= "background: -moz-linear-gradient({$settings['a-button-background-gradient-color']}, {$settings['a-button-background-color']});";
						$custom_style .= "background: linear-gradient({$settings['a-button-background-gradient-color']}, {$settings['a-button-background-color']});";
					}
					$custom_style .= '}';
				}

				// wrap
				if( !empty($custom_style) ){
					if( empty($settings['id']) ){
						global $gdlr_core_price_table_id; 
						$gdlr_core_price_table_id = empty($gdlr_core_price_table_id)? array(): $gdlr_core_price_table_id;
						
						// generate unique id so it does not get overwritten in admin area
						$rnd_price_table_id = mt_rand(0, 99999);
						while( in_array($rnd_price_table_id, $gdlr_core_price_table_id) ){
							$rnd_price_table_id = mt_rand(0, 99999);
						}
						$gdlr_core_price_table_id[] = $rnd_price_table_id;
						$settings['id'] = 'gdlr-core-price-table-' . $rnd_price_table_id;
					}
					$custom_style = str_replace('custom_style_id', $settings['id'], $custom_style); 

					if( $preview ){
						$custom_style = '<style>' . $custom_style . '</style>';
					}else{
						gdlr_core_add_inline_style($custom_style);
						$custom_style = '';
					}
				}

				// start printing item
				$extra_class  = empty($settings['class'])? '': $settings['class'];
				$ret  = '<div class="gdlr-core-price-table-item gdlr-core-item-pdlr gdlr-core-item-pdb clearfix ' . esc_attr($extra_class) . '" ';
				if( !empty($settings['padding-bottom']) && $settings['padding-bottom'] != $gdlr_core_item_pdb ){
					$ret .= gdlr_core_esc_style(array('padding-bottom'=>$settings['padding-bottom']));
				}
				if( !empty($settings['id']) ){
					$ret .= ' id="' . esc_attr($settings['id']) . '" ';
				}
				$ret .= ' >';

				if( !empty($settings['tabs']) ){
					$price_size = sizeOf($settings['tabs']) > 6? 6: sizeOf($settings['tabs']);
					$price_column = intval(60 / $price_size);

					foreach( $settings['tabs'] as $tab ){
						$ret .= '<div class="gdlr-core-price-table-column gdlr-core-column-' . esc_attr($price_column) . '" >';
						$ret .= '<div class="gdlr-core-price-table ' . ((!empty($tab['feature-price']) && $tab['feature-price'] == 'enable')? 'gdlr-core-active': '') . '" >';

						$ret .= '<div class="gdlr-core-price-table-head" >';
						if( !empty($tab['image']) ){
							$ret .= '<div class="gdlr-core-price-table-image" >' . gdlr_core_get_image($tab['image']) . '</div>';
						}else if( !empty($tab['icon']) ){
							$ret .= '<div class="gdlr-core-price-table-icon" ><i class="' . esc_attr($tab['icon']) . '" ></i></div>';
						}
						if( !empty($tab['title']) ){
							$ret .= '<h3 class="gdlr-core-price-table-title" >' . gdlr_core_text_filter($tab['title']) . '</h3>';
						}
						if( !empty($tab['caption']) ){
							$ret .= '<div class="gdlr-core-price-table-caption" >' . gdlr_core_text_filter($tab['caption']) . '</div>';
						}
						$ret .= '</div>';
						if( !empty($tab['price']) ){
							$ret .= '<div class="gdlr-core-price-table-price gdlr-core-title-font" >';
							$ret .= empty($settings['price-prefix'])? '': '<span class="gdlr-core-price-prefix">' . gdlr_core_text_filter($settings['price-prefix']) . '</span>';
							$ret .= '<span class="gdlr-core-price-table-price-number">' . gdlr_core_text_filter($tab['price']) . '</span>';
							$ret .= empty($settings['price-suffix'])? '': '<span class="gdlr-core-price-suffix">' . gdlr_core_text_filter($settings['price-suffix']) . '</span>';
							$ret .= '</div>';
						}
						$ret .= '<div class="gdlr-core-price-table-content-wrap" >';
						if( !empty($tab['content']) ){
							$ret .= '<div class="gdlr-core-price-table-content" >' . gdlr_core_text_filter($tab['content']) . '</div>';
						}
						if( !empty($tab['button-text']) && !empty($tab['button-link']) ){
							$ret .= '<a class="gdlr-core-price-table-button gdlr-core-button" ';
							$ret .= 'href="' . esc_attr($tab['button-link']) . '" ';
							$ret .= 'target="' . (empty($tab['button-link-target'])? '_self': $tab['button-link-target']) . '" ';
							$ret .= ' >' . gdlr_core_text_filter($tab['button-text']) . '</a>';
						}

						$ret .= '</div>'; // gdlr-core-price-table-content-wrap
						$ret .= '</div>'; // gdlr-core-price-table
						$ret .= '</div>'; // gdlr-core-price-table-column
					}
				}

				$ret .= '</div>'; // gdlr-core-price-table-item
				$ret .= $custom_style;

				return $ret;
			}

		} // gdlr_core_pb_element_price_table
	} // class_exists
	
	// price list shortcode
	add_shortcode('gdlr_core_price_list', 'gdlr_core_price_list_shortcode');
	if( !function_exists('gdlr_core_price_list_shortcode') ){
		function gdlr_core_price_list_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts(array(
				'icon' => 'fa fa-check',
			), $atts, 'gdlr_core_price_list');

			$ret  = '<div class="gdlr-core-price-list-shortcode" >';
			$ret .= str_replace('<li>', '<li><i class="' . esc_attr($atts['icon']) . '" ></i>', $content);
			$ret .= '</div>';

			return $ret;
		}
	}
