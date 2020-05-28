<?php
	/*	
	*	Goodlayers Item For Page Builder
	*/
	
	add_action('plugins_loaded', 'gdlr_core_personnel_add_pb_element');
	if( !function_exists('gdlr_core_personnel_add_pb_element') ){
		function gdlr_core_personnel_add_pb_element(){

			if( class_exists('gdlr_core_page_builder_element') ){
				gdlr_core_page_builder_element::add_element('personnel', 'gdlr_core_pb_element_personnel'); 
			}
			
		}
	}
	
	if( !class_exists('gdlr_core_pb_element_personnel') ){
		class gdlr_core_pb_element_personnel{
			
			// get the element settings
			static function get_settings(){
				return array(
					'icon' => 'fa-outdent',
					'title' => esc_html__('Personnel', 'goodlayers-core-personnel')
				);
			}
			
			// return the element options
			static function get_options(){
				global $gdlr_core_item_pdb;
				
				return array(					
					'general' => array(
						'title' => esc_html__('General', 'goodlayers-core-personnel'),
						'options' => array(
							'category' => array(
								'title' => esc_html__('Category', 'goodlayers-core-personnel'),
								'type' => 'multi-combobox',
								'options' => gdlr_core_get_term_list('personnel_category'),
								'description' => esc_html__('You can use Ctrl/Command button to select multiple items or remove the selected item. Leave this field blank to select all items in the list.', 'goodlayers-core-personnel'),
							),
							'num-fetch' => array(
								'title' => esc_html__('Num Fetch', 'goodlayers-core-personnel'),
								'type' => 'text',
								'default' => 9,
								'data-input-type' => 'number',
								'description' => esc_html__('The number of posts showing on the personnel item', 'goodlayers-core-personnel')
							),
							'orderby' => array(
								'title' => esc_html__('Order By', 'goodlayers-core-personnel'),
								'type' => 'combobox',
								'options' => array(
									'date' => esc_html__('Publish Date', 'goodlayers-core-personnel'), 
									'title' => esc_html__('Title', 'goodlayers-core-personnel'), 
									'rand' => esc_html__('Random', 'goodlayers-core-personnel'), 
									'menu_order' => esc_html__('Menu Order', 'goodlayers-core-personnel'), 
								)
							),
							'order' => array(
								'title' => esc_html__('Order', 'goodlayers-core-personnel'),
								'type' => 'combobox',
								'options' => array(
									'desc'=>esc_html__('Descending Order', 'goodlayers-core-personnel'), 
									'asc'=> esc_html__('Ascending Order', 'goodlayers-core-personnel'), 
								)
							),
						),
					),				
					'settings' => array(
						'title' => esc_html__('Style', 'goodlayers-core-personnel'),
						'options' => array(
							'text-align' => array(
								'title' => esc_html__('Text Align', 'goodlayers-core-personnel'),
								'type' => 'radioimage',
								'options' => 'text-align',
								'default' => 'left',
							),
							'personnel-style' => array(
								'title' => esc_html__('Personnel Style', 'goodlayers-core-personnel'),
								'type' => 'radioimage',
								'options' => array(
									'grid' => plugins_url('', __FILE__) . '/images/grid.png',
									'grid-no-space' => plugins_url('', __FILE__) . '/images/grid-no-space.png',
									'grid-with-background' => plugins_url('', __FILE__) . '/images/grid-with-background.png',
									'grid-feature' => plugins_url('', __FILE__) . '/images/grid-feature.png',
									'modern' => plugins_url('', __FILE__) . '/images/modern.png',
									'modern-no-space' => plugins_url('', __FILE__) . '/images/modern-no-space.png',
									'medium' => plugins_url('', __FILE__) . '/images/medium.png',
								),
								'default' => 'blog-full',
								'wrapper-class' => 'gdlr-core-fullsize'
							),
							'enable-position' => array(
								'title' => esc_html__('Enable Position', 'goodlayers-core-personnel'),
								'type' => 'checkbox',
								'default' => 'enable',
							),
							'disable-link' => array(
								'title' => esc_html__('Disable Link To Single Personnel', 'goodlayers-core-personnel'),
								'type' => 'checkbox',
								'default' => 'disable'
							),
							'enable-divider' => array(
								'title' => esc_html__('Enable Divider', 'goodlayers-core-personnel'),
								'type' => 'checkbox',
								'default' => 'enable',
								'condition' => array('personnel-style' => array('grid', 'grid-no-space', 'grid-with-background', 'medium'))
							),
							'enable-excerpt' => array(
								'title' => esc_html__('Enable Excerpt', 'goodlayers-core-personnel'),
								'type' => 'checkbox',
								'default' => 'enable',
								'condition' => array('personnel-style' => array('grid', 'grid-no-space', 'grid-with-background', 'medium'))
							),
							'enable-social-shortcode' => array(
								'title' => esc_html__('Enable Social Shortcode', 'goodlayers-core-personnel'),
								'type' => 'checkbox',
								'default' => 'enable',
							),
							'column-size' => array(
								'title' => esc_html__('Column Size', 'goodlayers-core-personnel'),
								'type' => 'combobox',
								'options' => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5 ),
								'default' => 3,
								'condition' => array('personnel-style' => array('grid', 'grid-no-space', 'grid-with-background', 'grid-feature', 'modern', 'modern-no-space'))
							),
							'thumbnail-size' => array(
								'title' => esc_html__('Thumbnail Size', 'goodlayers-core-personnel'),
								'type' => 'combobox',
								'options' => 'thumbnail-size'
							),
							'enable-thumbnail-opacity-on-hover' => array(
								'title' => esc_html__('Thumbnail Opacity on Hover', 'goodlayers-core-personnel'),
								'type' => 'checkbox',
								'default' => 'enable',
							),
							'thumbnail-opacity-background' => array(
								'title' => esc_html__('Thumbnail Opacity Background', 'goodlayers-core-personnel'),
								'type' => 'colorpicker',
								'condition' => array( 'enable-thumbnail-opacity-on-hover' => 'enable' )
							),
							'enable-thumbnail-zoom-on-hover' => array(
								'title' => esc_html__('Thumbnail Zoom on Hover', 'goodlayers-core-personnel'),
								'type' => 'checkbox',
								'default' => 'enable',
							),
							'enable-thumbnail-grayscale-effect' => array(
								'title' => esc_html__('Enable Thumbnail Grayscale Effect', 'goodlayers-core-personnel'),
								'type' => 'checkbox',
								'default' => 'disable',
								'description' => esc_html__('Only works with browser that supports css3 filter ( http://caniuse.com/#feat=css-filters ).', 'goodlayers-core-personnel')
							),
							'carousel' => array(
								'title' => esc_html__('Enable Carousel', 'goodlayers-core-personnel'),
								'type' => 'checkbox',
								'default' => 'disable',
								'condition' => array('personnel-style' => array('grid', 'grid-no-space', 'grid-with-background', 'modern', 'modern-no-space'))
							),
							'carousel-autoslide' => array(
								'title' => esc_html__('Autoslide Carousel', 'goodlayers-core-personnel'),
								'type' => 'checkbox',
								'default' => 'enable',
								'condition' => array( 'carousel' => 'enable', 'personnel-style' => array('grid', 'grid-no-space', 'grid-with-background', 'modern', 'modern-no-space') )
							),
							'carousel-scrolling-item-amount' => array(
								'title' => esc_html__('Carousel Scrolling Item Amount', 'goodlayers-core'),
								'type' => 'text',
								'default' => '1',
								'condition' => array( 'carousel' => 'enable', 'personnel-style' => array('grid', 'grid-no-space', 'grid-with-background', 'modern', 'modern-no-space') )
							),
							'carousel-navigation' => array(
								'title' => esc_html__('Carousel Navigation', 'goodlayers-core-personnel'),
								'type' => 'combobox',
								'options' => array(
									'none' => esc_html__('None', 'goodlayers-core-personnel'),
									'navigation' => esc_html__('Only Navigation', 'goodlayers-core-personnel'),
									'navigation-bottom' => esc_html__('Only Navigation Bottom', 'goodlayers-core-personnel'),
									'bullet' => esc_html__('Only Bullet', 'goodlayers-core-personnel'),
									'both' => esc_html__('Both Navigation and Bullet', 'goodlayers-core-personnel'),
								),
								'default' => 'navigation',
								'condition' => array( 'carousel' => 'enable', 'personnel-style' => array('grid', 'grid-no-space', 'grid-with-background', 'modern', 'modern-no-space') )
							),
							'carousel-bullet-style' => array(
								'title' => esc_html__('Carousel Bullet Style', 'goodlayers-core-personnel'),
								'type' => 'combobox',
								'options' => array(
									'default' => esc_html__('Default', 'goodlayers-core-personnel'),
									'cylinder' => esc_html__('Cylinder', 'goodlayers-core-personnel'),
								),
								'condition' => array( 'carousel' => 'enable', 'carousel-navigation' => array('bullet','both'), 'personnel-style' => array('grid', 'grid-no-space', 'grid-with-background', 'modern', 'modern-no-space') )
							),
						)
					),
					'typography' => array(
						'title' => esc_html__('Typography', 'goodlayers-core-personnel'),
						'options' => array(
							'personnel-title-font-size' => array(
								'title' => esc_html__('Personnel Title Font Size', 'goodlayers-core-personnel'),
								'type' => 'text',
								'data-input-type' => 'pixel',
							),
							'personnel-title-font-weight' => array(
								'title' => esc_html__('Personnel Title Font Weight', 'goodlayers-core-personnel'),
								'type' => 'text',
								'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800', 'goodlayers-core-personnel')
							),
							'personnel-title-letter-spacing' => array(
								'title' => esc_html__('Personnel Title Letter Spacing', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
							),
							'personnel-title-text-transform' => array(
								'title' => esc_html__('Personnel Title Text Transform', 'goodlayers-core-personnel'),
								'type' => 'combobox',
								'data-type' => 'text',
								'options' => array(
									'none' => esc_html__('None', 'goodlayers-core-personnel'),
									'uppercase' => esc_html__('Uppercase', 'goodlayers-core-personnel'),
									'lowercase' => esc_html__('Lowercase', 'goodlayers-core-personnel'),
									'capitalize' => esc_html__('Capitalize', 'goodlayers-core-personnel'),
								),
								'default' => 'uppercase'
							),
							'personnel-position-font-size' => array(
								'title' => esc_html__('Personnel Position Font Size', 'goodlayers-core-personnel'),
								'type' => 'text',
								'data-input-type' => 'pixel',
							),
							'personnel-position-font-weight' => array(
								'title' => esc_html__('Personnel Position Font Weight', 'goodlayers-core-personnel'),
								'type' => 'text',
								'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800', 'goodlayers-core-personnel')
							),
							'personnel-position-font-style' => array(
								'title' => esc_html__('Personnel Position Font Style', 'goodlayers-core'),
								'type' => 'combobox',
								'options' => array(
									'normal' => esc_html__('Normal', 'goodlayers-core'),
									'italic' => esc_html__('Italic', 'goodlayers-core'),
								),
								'default' => 'normal'
							),
							'personnel-position-letter-spacing' => array(
								'title' => esc_html__('Personnel Position Letter Spacing', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
							),
							'personnel-position-text-transform' => array(
								'title' => esc_html__('Personnel Position Text Transform', 'goodlayers-core-personnel'),
								'type' => 'combobox',
								'data-type' => 'text',
								'options' => array(
									'none' => esc_html__('None', 'goodlayers-core-personnel'),
									'uppercase' => esc_html__('Uppercase', 'goodlayers-core-personnel'),
									'lowercase' => esc_html__('Lowercase', 'goodlayers-core-personnel'),
									'capitalize' => esc_html__('Capitalize', 'goodlayers-core-personnel'),
								),
								'default' => 'none'
							),
						)
					),
					'shadow' => array(
						'title' => esc_html__('Shadow', 'goodlayers-core-personnel'),
						'options' => array(
							'shadow-size' => array(
								'title' => esc_html__('Shadow Size ( Thumbnail, Frame Style )', 'goodlayers-core-personnel'),
								'type' => 'custom',
								'item-type' => 'padding',
								'options' => array('x', 'y', 'size'),
								'data-input-type' => 'pixel',
							),
							'shadow-color' => array(
								'title' => esc_html__('Shadow Color ( Thumbnail, Frame Style )', 'goodlayers-core-personnel'),
								'type' => 'colorpicker'
							),
							'shadow-opacity' => array(
								'title' => esc_html__('Shadow Opacity ( Thumbnail, Frame Style )', 'goodlayers-core-personnel'),
								'type' => 'text',
								'default' => '0.2',
								'description' => esc_html__('Fill the number between 0.01 to 1', 'goodlayers-core-personnel')
							),
						)
					),
					'spacing' => array(
						'title' => esc_html__('Spacing', 'goodlayers-core-personnel'),
						'options' => array(
							'personnel-border-radius' => array(
								'title' => esc_html__('Personnel Frame/Thumbnail Border Radius', 'goodlayers-core'),
								'type' => 'text',
								'data-input-type' => 'pixel',
							),
							'personnel-thumbnail-bottom-margin' => array(
								'title' => esc_html__('Personnel Thumbnail Bottom ( Frame Top ) Margin', 'goodlayers-core-personnel'),
								'type' => 'text',
								'data-input-type' => 'pixel'
							),
							'personnel-modern-content-bottom' => array(
								'title' => esc_html__('Personnel Content Bottom Spaces ( For Image/Frame Style )', 'goodlayers-core-personnel'),
								'type' => 'text',
								'data-input-type' => 'pixel'
							),
							'personnel-title-bottom-margin' => array(
								'title' => esc_html__('Personnel Title Bottom Margin', 'goodlayers-core-personnel'),
								'type' => 'text',
								'data-input-type' => 'pixel'
							),
							'list-margin-bottom' => array(
								'title' => esc_html__('Margin Bottom ( List )', 'goodlayers-core-personnel'),
								'type' => 'text',
								'data-input-type' => 'pixel'
							),
							'padding-bottom' => array(
								'title' => esc_html__('Padding Bottom ( Item )', 'goodlayers-core-personnel'),
								'type' => 'text',
								'data-input-type' => 'pixel',
								'default' => $gdlr_core_item_pdb
							)
						)
					),
					'item-title' => array(
						'title' => esc_html__('Item Title', 'goodlayers-core-personnel'),
						'options' => gdlr_core_block_item_option()
					),	
				);
			}

			// get the preview for page builder
			static function get_preview( $settings = array() ){
				$content  = self::get_content($settings);
				$id = mt_rand(0, 9999);
				
				ob_start();
?><script type="text/javascript" id="gdlr-core-preview-personnel-<?php echo esc_attr($id); ?>" >
if( document.readyState == 'complete' ){
	jQuery(document).ready(function(){
		jQuery('#gdlr-core-preview-personnel-<?php echo esc_attr($id); ?>').parent().gdlr_core_flexslider();
	});
}else{
	jQuery(window).load(function(){
		jQuery('#gdlr-core-preview-personnel-<?php echo esc_attr($id); ?>').parent().gdlr_core_flexslider();
	});
}
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
						'category' => '', 'num-fetch' => 9, 'thumbnail-size' => 'full', 'orderby' => 'date', 'order' => 'asc',
						'personnel-style' => 'grid', 'column-size' => 3, 'text-align' => 'left', 'carousel' => 'disable',
						'padding-bottom' => $gdlr_core_item_pdb
					);
				}
				
				// default value
				$settings['personnel-style'] = empty($settings['personnel-style'])? 'grid': $settings['personnel-style'];
				if( in_array($settings['personnel-style'], array('grid', 'grid-no-space', 'grid-with-background')) ){
					$settings['style'] = 'grid';
				}else if( in_array($settings['personnel-style'], array('modern', 'modern-no-space')) ){
					$settings['style'] = 'modern';
				}else{
					$settings['style'] = $settings['personnel-style'];
				}
				$settings['carousel'] = empty($settings['carousel'])? 'disable': $settings['carousel'];
				$settings['disable-link'] = empty($settings['disable-link'])? 'disable': $settings['disable-link'];
				$with_space = !in_array($settings['personnel-style'], array('grid-no-space', 'modern-no-space'));

				// query
				$args = array( 'post_type' => 'personnel', 'suppress_filters' => false );

				if( !empty($settings['category']) ){
					$args['tax_query'] = array(array('terms'=>$settings['category'], 'taxonomy'=>'personnel_category', 'field'=>'slug'));
				}

				$args['posts_per_page'] = $settings['num-fetch'];
				$args['orderby'] = $settings['orderby'];
				$args['order'] = $settings['order'];	

				$args['paged'] = (get_query_var('paged'))? get_query_var('paged') : get_query_var('page');
				$args['paged'] = empty($args['paged'])? 1: $args['paged'];

				$query = new WP_Query( $args );

				// start printing item
				$extra_class  = ' gdlr-core-' . (empty($settings['text-align'])? 'left': $settings['text-align']) . '-align';
				$extra_class .= ' gdlr-core-personnel-item-style-' . $settings['personnel-style'];
				$extra_class .= ' gdlr-core-personnel-style-' . $settings['style'];
				$extra_class .= ($settings['personnel-style'] == 'grid-with-background')? ' gdlr-core-with-background': '';
				$extra_class .= (empty($settings['enable-divider']) || $settings['enable-divider'] == 'enable')? ' gdlr-core-with-divider ': '';

				$title_settings = $settings;
				if( empty($with_space) || $settings['carousel'] == 'enable' ){
					$title_settings['pdlr'] = false;
					$extra_class .= ' gdlr-core-item-pdlr';
				}

				if( !empty($settings['column-size']) ){
					gdlr_core_set_container_multiplier(1 / intval($settings['column-size']), false);
				}

				$ret  = '<div class="gdlr-core-personnel-item gdlr-core-item-pdb clearfix ' . esc_attr($extra_class) . '" ';
				if( !empty($settings['padding-bottom']) && $settings['padding-bottom'] != $gdlr_core_item_pdb ){
					$ret .= gdlr_core_esc_style(array('padding-bottom'=>$settings['padding-bottom']));
				}
				if( !empty($settings['id']) ){
					$ret .= ' id="' . esc_attr($settings['id']) . '" ';
				}
				$ret .= ' >';

				// print title
				$ret .= gdlr_core_block_item_title($title_settings);
				
				// print grid item
				if( $query->have_posts() ){
					if( $settings['carousel'] == 'disable' || $settings['style'] == 'medium' ){

						if( $query->have_posts() ){
							$p_column_count = 0;
							if( $settings['style'] == 'medium' ){
								$p_column = 60;
							}else{
								$p_column = 60 / intval($settings['column-size']);
							}
							
							gdlr_core_setup_admin_postdata();
							while( $query->have_posts() ){ $query->the_post();
								$column_class  = ' gdlr-core-column-' . $p_column;
								$column_class .= ($p_column_count % 60 == 0)? ' gdlr-core-column-first': '';
								$column_class .= empty($with_space)? '': ' gdlr-core-item-pdlr';
								$column_class .= ($settings['style'] == 'modern' && !empty($with_space))? ' gdlr-core-item-mgb': '';

								$ret .= '<div class="gdlr-core-personnel-list-column ' . esc_attr($column_class) . '" ' . gdlr_core_esc_style(array(
									'margin-bottom' => empty($settings['list-margin-bottom'])? '': $settings['list-margin-bottom']
								)) . ' >';
								$ret .= self::get_tab_item($settings);
								$ret .= '</div>';

								$p_column_count += $p_column;
							}
							wp_reset_postdata();
							gdlr_core_reset_admin_postdata();
						}

					// print carousel item
					}else{

						$slides = array();
						$flex_atts = array(
							'carousel' => true,
							'column' => empty($settings['column-size'])? '3': $settings['column-size'],
							'move' => empty($settings['carousel-scrolling-item-amount'])? '': $settings['carousel-scrolling-item-amount'],
							'navigation' => empty($settings['carousel-navigation'])? 'navigation': $settings['carousel-navigation'],
							'bullet-style' => empty($settings['carousel-bullet-style'])? '': $settings['carousel-bullet-style'],
							'nav-parent' => 'gdlr-core-personnel-item',
							'disable-autoslide' => (empty($settings['carousel-autoslide']) || $settings['carousel-autoslide'] == 'enable')? '': true,
						);
						if( empty($with_space) ){
							$flex_atts['mglr'] = false;
						}

						while( $query->have_posts() ){ $query->the_post();
							$slides[] = self::get_tab_item($settings);
						}

						$ret .= gdlr_core_get_flexslider($slides, $flex_atts);
					}
				}else{
					$ret .= '<div class="gdlr-core-external-plugin-message">' . esc_html__('No personnel found, please create the personnel post to use the item.', 'goodlayers-core-personnel') . '</div>';
				}

				$ret .= '</div>'; // gdlr-core-blog-item
				
				gdlr_core_set_container_multiplier(1, false);

				return $ret;
			}

			static function get_tab_item( $settings = array() ){ 

				$post_meta = get_post_meta(get_the_ID(), 'gdlr-core-page-option', true);

				
				if( in_array($settings['personnel-style'], array('grid-with-background', 'modern', 'modern-no-space')) ){
					
					$item_css = array();

					if( !empty($settings['shadow-size']['size']) && !empty($settings['shadow-color']) && !empty($settings['shadow-opacity']) ){
						$item_css['background-shadow-size'] = empty($settings['shadow-size'])? '': $settings['shadow-size'];
						$item_css['background-shadow-color'] = empty($settings['shadow-color'])? '': $settings['shadow-color'];
						$item_css['background-shadow-opacity'] = empty($settings['shadow-opacity'])? '': $settings['shadow-opacity'];
					}
					if( !empty($settings['personnel-border-radius']) ){
						$item_css['border-radius'] = empty($settings['personnel-border-radius'])? '': $settings['personnel-border-radius'];
					}

					$ret  = '<div class="gdlr-core-personnel-list clearfix';
					if( !empty($item_css) ){
						$ret .= 'gdlr-core-outer-frame-element" ' . gdlr_core_esc_style($item_css) . ' >';
					}else{
						$ret .= '" >';
					}
				}else{
					$ret  = '<div class="gdlr-core-personnel-list clearfix" >';
				}
				
				$thumbnail_id = get_post_thumbnail_id();
				if( !empty($thumbnail_id) ){
					$thumbnail_size = empty($settings['thumbnail-size'])? 'full': $settings['thumbnail-size'];

					$additional_class  = '';
					if( empty($settings['enable-thumbnail-opacity-on-hover']) || $settings['enable-thumbnail-opacity-on-hover'] == 'enable' ){
						$additional_class .= ' gdlr-core-opacity-on-hover';
					}
					if( empty($settings['enable-thumbnail-zoom-on-hover']) || $settings['enable-thumbnail-zoom-on-hover'] == 'enable' ){
						$additional_class .= ' gdlr-core-zoom-on-hover';
					}
					if( !empty($settings['enable-thumbnail-grayscale-effect']) && $settings['enable-thumbnail-grayscale-effect'] == 'enable' ){
						$additional_class .= ' gdlr-core-grayscale-effect';
					}

					$css_atts = array(
						'background' => empty($settings['thumbnail-opacity-background'])? '': $settings['thumbnail-opacity-background']
					);
					if( in_array($settings['personnel-style'], array('grid', 'grid-no-space', 'grid-feature', 'medium')) ){
						$css_atts['border-radius'] = empty($settings['personnel-border-radius'])? '': $settings['personnel-border-radius'];
					}
					$ret .= '<div class="gdlr-core-personnel-list-image gdlr-core-media-image ' . esc_attr($additional_class) . '" ' . gdlr_core_esc_style($css_atts) . ' >';
					if( $settings['disable-link'] == 'enable' ){
						$ret .= gdlr_core_get_image($thumbnail_id, $thumbnail_size);
					}else{
						$ret .= '<a href="' . get_permalink() . '" >' . gdlr_core_get_image($thumbnail_id, $thumbnail_size) .  '</a>';
					}
					$ret .= '</div>';
				}

				$title_atts = array(
					'font-size' => empty($settings['personnel-title-font-size'])? '': $settings['personnel-title-font-size'],
					'font-weight' => empty($settings['personnel-title-font-weight'])? '': $settings['personnel-title-font-weight'],
					'letter-spacing' => empty($settings['personnel-title-letter-spacing'])? '': $settings['personnel-title-letter-spacing'],
					'text-transform' => (empty($settings['personnel-title-text-transform']) || $settings['personnel-title-text-transform'] == 'uppercase')? '': $settings['personnel-title-text-transform'],
					'margin-bottom' => empty($settings['personnel-title-bottom-margin'])? '': $settings['personnel-title-bottom-margin'],
				);
				$position_atts = array(
					'font-size' => empty($settings['personnel-position-font-size'])? '': $settings['personnel-position-font-size'],
					'font-weight' => empty($settings['personnel-position-font-weight'])? '': $settings['personnel-position-font-weight'],
					'font-style' => (empty($settings['personnel-position-font-style']) || $settings['personnel-position-font-style'] == 'italic')? '': $settings['personnel-position-font-style'],
					'letter-spacing' => empty($settings['personnel-position-letter-spacing'])? '': $settings['personnel-position-letter-spacing'],
					'text-transform' => (empty($settings['personnel-position-text-transform']) || $settings['personnel-position-text-transform'] == 'none')? '': $settings['personnel-position-text-transform'],
				);

				$content_css = array(
					'padding-top' => empty($settings['personnel-thumbnail-bottom-margin'])? '': $settings['personnel-thumbnail-bottom-margin']
				);
				if( $settings['personnel-style'] == 'grid-with-background' ){
					$content_css['padding-bottom'] = empty($settings['personnel-modern-content-bottom'])? '': $settings['personnel-modern-content-bottom'];
				}else if( in_array($settings['personnel-style'], array('modern', 'modern-no-space')) ){
					$content_css['bottom'] = empty($settings['personnel-modern-content-bottom'])? '': $settings['personnel-modern-content-bottom'];
				}
				$ret .= '<div class="gdlr-core-personnel-list-content-wrap" ' . gdlr_core_esc_style($content_css) . ' >';
				if( in_array($settings['style'], array('grid', 'medium')) ){
					$ret .= '<h3 class="gdlr-core-personnel-list-title" ' . gdlr_core_esc_style($title_atts) . ' >';
					if( $settings['disable-link'] == 'enable' ){
						$ret .= get_the_title();
					}else{
						$ret .= '<a href="' . get_permalink() . '" >' . get_the_title() . '</a>';
					}
					$ret .= '</h3>';
					if( (empty($settings['enable-position']) || $settings['enable-position'] == 'enable') && !empty($post_meta['position']) ){
						$ret .= '<div class="gdlr-core-personnel-list-position gdlr-core-info-font gdlr-core-skin-caption" ' . gdlr_core_esc_style($position_atts) . ' >' . gdlr_core_text_filter($post_meta['position']) . '</div>';
					}
					if( empty($settings['enable-divider']) || $settings['enable-divider'] == 'enable' ){
						$ret .= '<div class="gdlr-core-personnel-list-divider gdlr-core-skin-divider" ></div>';
					}
					if( (empty($settings['enable-excerpt']) || $settings['enable-excerpt'] == 'enable') && !empty($post_meta['excerpt']) ){
						$ret .= '<div class="gdlr-core-personnel-list-content" >' . gdlr_core_content_filter($post_meta['excerpt']) . '</div>';
					}
					if( (empty($settings['enable-social-shortcode']) || $settings['enable-social-shortcode'] == 'enable') && !empty($post_meta['social-shortcode']) ){
						$ret .= '<div class="gdlr-core-personnel-list-social" >' . gdlr_core_content_filter($post_meta['social-shortcode']) . '</div>';
					}
				}else{
					$ret .= '<div class="gdlr-core-personnel-list-title gdlr-core-title-font" ' . gdlr_core_esc_style($title_atts) . ' >';
					if( $settings['disable-link'] == 'enable' ){
						$ret .= get_the_title();
					}else{
						$ret .= '<a href="' . get_permalink() . '" >' . get_the_title() . '</a>';
					}
					$ret .= '</div>';
					$ret .= ($settings['style'] == 'grid-feature')? '<div class="gdlr-core-personnel-list-info-wrap" >': '';
					if( (empty($settings['enable-position']) || $settings['enable-position'] == 'enable') && !empty($post_meta['position']) ){
						$ret .= '<div class="gdlr-core-personnel-list-position gdlr-core-info-font" ' . gdlr_core_esc_style($position_atts) . ' >' . gdlr_core_text_filter($post_meta['position']) . '</div>';
					}
					if( (empty($settings['enable-social-shortcode']) || $settings['enable-social-shortcode'] == 'enable') && !empty($post_meta['social-shortcode']) ){
						$ret .= '<div class="gdlr-core-personnel-list-social" >' . gdlr_core_content_filter($post_meta['social-shortcode']) . '</div>';
					}
					$ret .= ($settings['style'] == 'grid-feature')? '</div>': '';
				}
				$ret .= '</div>'; // gdlr-core-personnel-list-content-wrap

				$ret .= '</div>'; // gdlr-core-personnel-list

				return $ret;
			}
			
		} // gdlr_core_pb_element_personnel
	} // class_exists	