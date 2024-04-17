<?php
	/*	
	*	Goodlayers Function File
	*	---------------------------------------------------------------------
	*	This file include all of important function and features of the theme
	*	---------------------------------------------------------------------
	*/
	
	// goodlayers core plugin function
	include_once(get_template_directory() . '/admin/core/sidebar-generator.php');
	include_once(get_template_directory() . '/admin/core/utility.php');
	include_once(get_template_directory() . '/admin/core/media.php' );
	
	// create admin page
	if( is_admin() ){
		include_once(get_template_directory() . '/admin/tgmpa/class-tgm-plugin-activation.php');
		include_once(get_template_directory() . '/admin/tgmpa/plugin-activation.php');
		include_once(get_template_directory() . '/admin/function/getting-start.php');	
	}
	
	// plugins
	include_once(get_template_directory() . '/plugins/wpml.php');
	include_once(get_template_directory() . '/plugins/revslider.php');
	
	/////////////////////
	// front end script
	/////////////////////
	
	include_once(get_template_directory() . '/include/header-settings.php' );
	include_once(get_template_directory() . '/include/utility.php' );
	include_once(get_template_directory() . '/include/function-regist.php' );
	include_once(get_template_directory() . '/include/navigation-menu.php' );
	include_once(get_template_directory() . '/include/include-script.php' );
	include_once(get_template_directory() . '/include/goodlayers-core-filter.php' );
	include_once(get_template_directory() . '/include/maintenance.php' );
	include_once(get_template_directory() . '/woocommerce/woocommerce-settings.php' );
	
	/////////////////////
	// execute module 
	/////////////////////
	
	// initiate sidebar structure
	$sidebar_atts = array(
		'before_widget' => '<div id="%1$s" class="widget %2$s attorna-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="attorna-widget-title">',
		'after_title'   => '</h3><span class="clear"></span>' );

	if( attorna_get_option('general', 'sidebar-title-divider', 'enable') == 'enable' ){
		$sidebar_atts['before_title'] = '<h3 class="attorna-widget-title"><span class="attorna-widget-head-text">';
		$sidebar_atts['after_title'] = '</span><span class="attorna-widget-head-divider"></span></h3><span class="clear"></span>';
	}
	new gdlr_core_sidebar_generator($sidebar_atts);

	// clear data for wpml translation
	add_action('init', 'attorna_clear_general_option');
	if( !function_exists('attorna_clear_general_option') ){
		function attorna_clear_general_option(){
			unset($GLOBALS['attorna_general']);
		}	
	}	

	// remove the core default action to enqueue the theme script
	remove_action('after_setup_theme', 'gdlr_init_goodlayers_core_elements');
	add_action('after_setup_theme', 'attorna_init_goodlayers_core_elements');
	if( !function_exists('attorna_init_goodlayers_core_elements') ){
		function attorna_init_goodlayers_core_elements(){

			// create an admin option and customizer
			if( (is_admin() || is_customize_preview()) && class_exists('gdlr_core_admin_option') && class_exists('gdlr_core_theme_customizer') ){
				
				$attorna_admin_option = new gdlr_core_admin_option(array(
					'filewrite' => attorna_get_style_custom(true)
				));	
				
				include_once( get_template_directory() . '/include/options/general.php');
				include_once( get_template_directory() . '/include/options/typography.php');
				include_once( get_template_directory() . '/include/options/color.php');
				include_once( get_template_directory() . '/include/options/plugin-settings.php');

				if( is_customize_preview() ){
					new gdlr_core_theme_customizer($attorna_admin_option);
				}

				// clear an option for customize page
				add_action('wp', 'attorna_clear_option');
				
			}
			
			// add the script for page builder / page options / post option
			if( is_admin() ){

				if( class_exists('gdlr_core_revision') ){
					$revision_num = 5;
					new gdlr_core_revision($revision_num);
				}
				
				// create page option
				if( class_exists('gdlr_core_page_option') ){

					// for page post type
					new gdlr_core_page_option(array(
						'post_type' => array('page'),
						'options' => array(
							'layout' => array(
								'title' => esc_html__('Layout', 'attorna'),
								'options' => array(
									'custom-header' => array(
										'title' => esc_html__('Select Custom Header', 'attorna'),
										'type' => 'combobox',
										'single' => 'gdlr_core_custom_header_id',
										'options' => array('' => esc_html__('Default', 'attorna')) + gdlr_core_get_post_list('gdlr_core_header')
									),
									'enable-header-area' => array(
										'title' => esc_html__('Enable Header Area', 'attorna'),
										'type' => 'checkbox',
										'default' => 'enable'
									),
									'enable-logo' => array(
										'title' => esc_html__('Enable Logo', 'attorna'),
										'type' => 'combobox',
										'options' => array(
											'' => esc_html__('Default', 'attorna'),
											'enable' => esc_html__('Enable', 'attorna'),
											'disable' => esc_html__('Disable', 'attorna'),
										),
										'condition' => array( 'enable-header-area' => 'enable' )
									),
									'sticky-navigation' => array(
										'title' => esc_html__('Sticky Navigation', 'attorna'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'attorna'),
											'enable' => esc_html__('Enable', 'attorna'),
											'disable' => esc_html__('Disable', 'attorna'),
										),
										'condition' => array( 'enable-header-area' => 'enable' )
									),
									'enable-page-title' => array(
										'title' => esc_html__('Enable Page Title', 'attorna'),
										'type' => 'checkbox',
										'default' => 'enable',
										'condition' => array( 'enable-header-area' => 'enable' )
									),
									'page-caption' => array(
										'title' => esc_html__('Caption', 'attorna'),
										'type' => 'textarea',
										'condition' => array( 'enable-header-area' => 'enable', 'enable-page-title' => 'enable' )
									),					
									'title-background' => array(
										'title' => esc_html__('Page Title Background', 'attorna'),
										'type' => 'upload',
										'condition' => array( 'enable-header-area' => 'enable', 'enable-page-title' => 'enable' )
									),
									'enable-breadcrumbs' => array(
										'title' => esc_html__('Enable Breadcrumbs', 'attorna'),
										'type' => 'checkbox',
										'default' => 'disable',
										'condition' => array( 'enable-header-area' => 'enable', 'enable-page-title' => 'enable' )
									),
									'body-background-type' => array(
										'title' => esc_html__('Body Background Type', 'attorna'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'attorna'),
											'image' => esc_html__('Image ( Only For Boxed Layout )', 'attorna'),
										)
									),
									'body-background-image' => array(
										'title' => esc_html__('Body Background Image', 'attorna'),
										'type' => 'upload',
										'data-type' => 'file', 
										'condition' => array( 'body-background-type' => 'image' )
									),
									'body-background-image-opacity' => array(
										'title' => esc_html__('Body Background Image Opacity', 'attorna'),
										'type' => 'fontslider',
										'data-type' => 'opacity',
										'default' => '100',
										'condition' => array( 'body-background-type' => 'image' )
									),
									'show-content' => array(
										'title' => esc_html__('Show WordPress Editor Content', 'attorna'),
										'type' => 'checkbox',
										'default' => 'enable',
										'description' => esc_html__('Disable this to hide the content in editor to show only page builder content.', 'attorna'),
									),
									'sidebar' => array(
										'title' => esc_html__('Sidebar', 'attorna'),
										'type' => 'radioimage',
										'options' => 'sidebar',
										'default' => 'none',
										'wrapper-class' => 'gdlr-core-fullsize'
									),
									'sidebar-left' => array(
										'title' => esc_html__('Sidebar Left', 'attorna'),
										'type' => 'combobox',
										'options' => 'sidebar',
										'condition' => array( 'sidebar' => array('left', 'both') )
									),
									'sidebar-right' => array(
										'title' => esc_html__('Sidebar Right', 'attorna'),
										'type' => 'combobox',
										'options' => 'sidebar',
										'condition' => array( 'sidebar' => array('right', 'both') )
									),
									'enable-footer' => array(
										'title' => esc_html__('Enable Footer', 'attorna'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'attorna'),
											'enable' => esc_html__('Enable', 'attorna'),
											'disable' => esc_html__('Disable', 'attorna'),
										)
									),
									'enable-copyright' => array(
										'title' => esc_html__('Enable Copyright', 'attorna'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'attorna'),
											'enable' => esc_html__('Enable', 'attorna'),
											'disable' => esc_html__('Disable', 'attorna'),
										)
									),

								)
							), // layout
							'title' => array(
								'title' => esc_html__('Title Style', 'attorna'),
								'options' => array(

									'title-style' => array(
										'title' => esc_html__('Page Title Style', 'attorna'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'attorna'),
											'small' => esc_html__('Small', 'attorna'),
											'medium' => esc_html__('Medium', 'attorna'),
											'large' => esc_html__('Large', 'attorna'),
											'custom' => esc_html__('Custom', 'attorna'),
										),
										'default' => 'default'
									),
									'title-align' => array(
										'title' => esc_html__('Page Title Alignment', 'attorna'),
										'type' => 'radioimage',
										'options' => 'text-align',
										'with-default' => true,
										'default' => 'default'
									),
									'title-spacing' => array(
										'title' => esc_html__('Page Title Padding', 'attorna'),
										'type' => 'custom',
										'item-type' => 'padding',
										'data-input-type' => 'pixel',
										'options' => array('padding-top', 'padding-bottom', 'caption-top-margin'),
										'wrapper-class' => 'gdlr-core-fullsize gdlr-core-no-link gdlr-core-large',
										'condition' => array( 'title-style' => 'custom' )
									),
									'title-font-size' => array(
										'title' => esc_html__('Page Title Font Size', 'attorna'),
										'type' => 'custom',
										'item-type' => 'padding',
										'data-input-type' => 'pixel',
										'options' => array('title-size', 'title-letter-spacing', 'caption-size', 'caption-letter-spacing'),
										'wrapper-class' => 'gdlr-core-fullsize gdlr-core-no-link gdlr-core-large',
										'condition' => array( 'title-style' => 'custom' )
									),
									'title-font-weight' => array(
										'title' => esc_html__('Page Title Font Weight', 'attorna'),
										'type' => 'custom',
										'item-type' => 'padding',
										'options' => array('title-weight', 'caption-weight'),
										'wrapper-class' => 'gdlr-core-fullsize gdlr-core-no-link gdlr-core-large',
										'condition' => array( 'title-style' => 'custom' )
									),
									'title-font-transform' => array(
										'title' => esc_html__('Page Title Font Transform', 'attorna'),
										'type' => 'combobox',
										'options' => array(
											'none' => esc_html__('None', 'attorna'),
											'uppercase' => esc_html__('Uppercase', 'attorna'),
											'lowercase' => esc_html__('Lowercase', 'attorna'),
											'capitalize' => esc_html__('Capitalize', 'attorna'),
										),
										'default' => 'uppercase',
										'condition' => array( 'title-style' => 'custom' )
									),
									'top-bottom-gradient' => array(
										'title' => esc_html__('Title Top/Bottom Gradient', 'attorna'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'attorna'),
											'both' => esc_html__('Both', 'attorna'),
											'top' => esc_html__('Top', 'attorna'),
											'bottom' => esc_html__('Bottom', 'attorna'),
											'disable' => esc_html__('None', 'attorna'),
										)
									),
									'title-background-overlay-opacity' => array(
										'title' => esc_html__('Page Title Background Overlay Opacity', 'attorna'),
										'type' => 'text',
										'description' => esc_html__('Fill the number between 0.01 - 1 ( Leave Blank For Default Value )', 'attorna'),
										'condition' => array( 'title-style' => 'custom' )
									),
									'title-color' => array(
										'title' => esc_html__('Page Title Color', 'attorna'),
										'type' => 'colorpicker',
									),
									'caption-color' => array(
										'title' => esc_html__('Page Caption Color', 'attorna'),
										'type' => 'colorpicker',
									),
									'title-background-overlay-color' => array(
										'title' => esc_html__('Page Background Overlay Color', 'attorna'),
										'type' => 'colorpicker',
									),

								)
							), // title
							'header' => array(
								'title' => esc_html__('Header', 'attorna'),
								'options' => array(

									'main_menu' => array(
										'title' => esc_html__('Primary Menu', 'infinite'),
										'type' => 'combobox',
										'options' => function_exists('gdlr_core_get_menu_list')? gdlr_core_get_menu_list(): array(),
										'single' => 'gdlr-core-location-main_menu'
									),
									'right_menu' => array(
										'title' => esc_html__('Secondary Menu', 'infinite'),
										'type' => 'combobox',
										'options' => function_exists('gdlr_core_get_menu_list')? gdlr_core_get_menu_list(): array(),
										'single' => 'gdlr-core-location-right_menu'
									),
									'top_bar_menu' => array(
										'title' => esc_html__('Top Bar Menu', 'infinite'),
										'type' => 'combobox',
										'options' => function_exists('gdlr_core_get_menu_list')? gdlr_core_get_menu_list(): array(),
										'single' => 'gdlr-core-location-top_bar_menu'
									),
									'mobile_menu' => array(
										'title' => esc_html__('Mobile Menu', 'infinite'),
										'type' => 'combobox',
										'options' => function_exists('gdlr_core_get_menu_list')? gdlr_core_get_menu_list(): array(),
										'single' => 'gdlr-core-location-mobile_menu'
									),

									'header-slider' => array(
										'title' => esc_html__('Header Slider ( Above Navigation )', 'attorna'),
										'type' => 'combobox',
										'options' => array(
											'none' => esc_html__('None', 'attorna'),
											'layer-slider' => esc_html__('Layer Slider', 'attorna'),
											'master-slider' => esc_html__('Master Slider', 'attorna'),
											'revolution-slider' => esc_html__('Revolution Slider', 'attorna'),
										),
										'description' => esc_html__('For header style plain / bar / boxed', 'attorna'),
									),
									'layer-slider-id' => array(
										'title' => esc_html__('Choose Layer Slider', 'attorna'),
										'type' => 'combobox',
										'options' => gdlr_core_get_layerslider_list(),
										'condition' => array( 'header-slider' => 'layer-slider' )
									),
									'master-slider-id' => array(
										'title' => esc_html__('Choose Master Slider', 'attorna'),
										'type' => 'combobox',
										'options' => gdlr_core_get_masterslider_list(),
										'condition' => array( 'header-slider' => 'master-slider' )
									),
									'revolution-slider-id' => array(
										'title' => esc_html__('Choose Revolution Slider', 'attorna'),
										'type' => 'combobox',
										'options' => gdlr_core_get_revolution_slider_list(),
										'condition' => array( 'header-slider' => 'revolution-slider' )
									),

								) // header options
							), // header
							'bullet-anchor' => array(
								'title' => esc_html__('Bullet Anchor', 'attorna'),
								'options' => array(
									'bullet-anchor-description' => array(
										'type' => 'description',
										'description' => esc_html__('This feature is used for one page navigation. It will appear on the right side of page. You can put the id of element in \'Anchor Link\' field to let the bullet scroll the page to.', 'attorna')
									),
									'bullet-anchor' => array(
										'title' => esc_html__('Add Anchor', 'attorna'),
										'type' => 'custom',
										'item-type' => 'tabs',
										'options' => array(
											'title' => array(
												'title' => esc_html__('Anchor Link', 'attorna'),
												'type' => 'text',
											),
											'anchor-color' => array(
												'title' => esc_html__('Anchor Color', 'attorna'),
												'type' => 'colorpicker',
											),
											'anchor-hover-color' => array(
												'title' => esc_html__('Anchor Hover Color', 'attorna'),
												'type' => 'colorpicker',
											)
										),
										'wrapper-class' => 'gdlr-core-fullsize'
									),
								)
							)
						)
					));

					// for post post type
					new gdlr_core_page_option(array(
						'post_type' => array('post'),
						'options' => array(
							'layout' => array(
								'title' => esc_html__('Layout', 'attorna'),
								'options' => array(

									'show-content' => array(
										'title' => esc_html__('Show WordPress Editor Content', 'attorna'),
										'type' => 'checkbox',
										'default' => 'enable',
										'description' => esc_html__('Disable this to hide the content in editor to show only page builder content.', 'attorna'),
									),
									'sidebar' => array(
										'title' => esc_html__('Sidebar', 'attorna'),
										'type' => 'radioimage',
										'options' => 'sidebar',
										'with-default' => true,
										'default' => 'default',
										'wrapper-class' => 'gdlr-core-fullsize'
									),
									'sidebar-left' => array(
										'title' => esc_html__('Sidebar Left', 'attorna'),
										'type' => 'combobox',
										'options' => 'sidebar',
										'condition' => array( 'sidebar' => array('left', 'both') )
									),
									'sidebar-right' => array(
										'title' => esc_html__('Sidebar Right', 'attorna'),
										'type' => 'combobox',
										'options' => 'sidebar',
										'condition' => array( 'sidebar' => array('right', 'both') )
									),
								)
							),
							'metro-layout' => array(
								'title' => esc_html__('Metro Layout', 'attorna'),
								'options' => array(
									'metro-column-size' => array(
										'title' => esc_html__('Column Size', 'attorna'),
										'type' => 'combobox',
										'options' => array( 'default'=> esc_html__('Default', 'attorna'), 
											60 => '1/1', 30 => '1/2', 20 => '1/3', 40 => '2/3', 
											15 => '1/4', 45 => '3/4', 12 => '1/5', 24 => '2/5', 36 => '3/5', 48 => '4/5',
											10 => '1/6', 50 => '5/6'),
										'default' => 'default',
										'description' => esc_html__('Choosing default will display the value selected by the page builder item.', 'attorna')
									),
									'metro-thumbnail-size' => array(
										'title' => esc_html__('Thumbnail Size', 'attorna'),
										'type' => 'combobox',
										'options' => 'thumbnail-size',
										'with-default' => true,
										'default' => 'default',
										'description' => esc_html__('Choosing default will display the value selected by the page builder item.', 'attorna')
									)
								)
							),						
							'title' => array(
								'title' => esc_html__('Title', 'attorna'),
								'options' => array(

									'blog-title-style' => array(
										'title' => esc_html__('Blog Title Style', 'attorna'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'attorna'),
											'small' => esc_html__('Small', 'attorna'),
											'large' => esc_html__('Large', 'attorna'),
											'custom' => esc_html__('Custom', 'attorna'),
											'inside-content' => esc_html__('Inside Content', 'attorna'),
											'none' => esc_html__('None', 'attorna'),
										),
										'default' => 'default'
									),
									'blog-title-padding' => array(
										'title' => esc_html__('Blog Title Padding', 'attorna'),
										'type' => 'custom',
										'item-type' => 'padding',
										'data-input-type' => 'pixel',
										'options' => array('padding-top', 'padding-bottom'),
										'wrapper-class' => 'gdlr-core-fullsize gdlr-core-no-link gdlr-core-large',
										'condition' => array( 'blog-title-style' => 'custom' )
									),
									'blog-feature-image' => array(
										'title' => esc_html__('Blog Feature Image Location', 'attorna'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'attorna'),
											'content' => esc_html__('Inside Content', 'attorna'),
											'title-background' => esc_html__('Title Background', 'attorna'),
											'none' => esc_html__('None', 'attorna'),
										)
									),
									'blog-title-background-image' => array(
										'title' => esc_html__('Blog Title Background Image', 'attorna'),
										'type' => 'upload',
										'data-type' => 'file',
										'condition' => array( 
											'blog-title-style' => array('default', 'small', 'large', 'custom'),
											'blog-feature-image' => array('default', 'content', 'none')
										),
										'description' => esc_html__('Will be overridden by feature image if selected.', 'attorna'),
									),
									'blog-top-bottom-gradient' => array(
										'title' => esc_html__('Blog ( Feature Image ) Title Top/Bottom Gradient', 'attorna'),
										'type' => 'combobox',
										'options' => array(
											'default' => esc_html__('Default', 'attorna'),
											'enable' => esc_html__('Both', 'attorna'),
											'top' => esc_html__('Top', 'attorna'),
											'bottom' => esc_html__('Bottom', 'attorna'),
											'disable' => esc_html__('None', 'attorna'),
										)
									),
									'blog-title-background-overlay-opacity' => array(
										'title' => esc_html__('Blog Title Background Overlay Opacity', 'attorna'),
										'type' => 'text',
										'description' => esc_html__('Fill the number between 0.01 - 1 ( Leave Blank For Default Value )', 'attorna'),
									),

								) // options
							) // title
						)
					));
				}

			}
			
			// create page builder
			if( class_exists('gdlr_core_page_builder') ){
				new gdlr_core_page_builder(array(
					'style' => array(
						'style-custom' => attorna_get_style_custom()
					)
				));
			}
			
		} // attorna_init_goodlayers_core_elements
	} // function_exists


	add_filter('gdlr_core_portfolio_options', 'attorna_gdlr_core_portfolio_options');
	if( !function_exists('attorna_gdlr_core_portfolio_options') ){
		function attorna_gdlr_core_portfolio_options($options){
			$options['general']['options'] = gdlr_core_array_insert($options['general']['options'], 'title-background', array(
				'enable-breadcrumbs' => array(
					'title' => esc_html__('Enable Breadcrumbs', 'attorna'),
					'type' => 'checkbox',
					'default' => 'disable',
					'condition' => array( 'enable-page-title' => 'enable' )
				),
			));

			return $options;
		}
	}