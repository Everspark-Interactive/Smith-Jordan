<?php

	add_filter('gdlr_core_enable_header_post_type', 'attorna_gdlr_core_enable_header_post_type');
	if( !function_exists('attorna_gdlr_core_enable_header_post_type') ){
		function attorna_gdlr_core_enable_header_post_type( $args ){
			return true;
		}
	}
	
	add_filter('gdlr_core_header_options', 'attorna_gdlr_core_header_options', 10, 2);
	if( !function_exists('attorna_gdlr_core_header_options') ){
		function attorna_gdlr_core_header_options( $options, $with_default = true ){

			// get option
			$options = array(
				'top-bar' => attorna_top_bar_options(),
				'top-bar-social' => attorna_top_bar_social_options(),			
				'header' => attorna_header_options(),
				'logo' => attorna_logo_options(),
				'navigation' => attorna_navigation_options(), 
				'fixed-navigation' => attorna_fixed_navigation_options(),
			);

			// set default
			if( $with_default ){
				foreach( $options as $slug => $option ){
					foreach( $option['options'] as $key => $value ){
						$options[$slug]['options'][$key]['default'] = attorna_get_option('general', $key);
					}
				}
			} 
			
			return $options;
		}
	}
	
	add_filter('gdlr_core_header_color_options', 'attorna_gdlr_core_header_color_options', 10, 2);
	if( !function_exists('attorna_gdlr_core_header_color_options') ){
		function attorna_gdlr_core_header_color_options( $options, $with_default = true ){

			$options = array(
				'header-color' => attorna_header_color_options(), 
				'navigation-menu-color' => attorna_navigation_color_options(), 		
				'navigation-right-color' => attorna_navigation_right_color_options(),
			);

			// set default
			if( $with_default ){
				foreach( $options as $slug => $option ){
					foreach( $option['options'] as $key => $value ){
						$options[$slug]['options'][$key]['default'] = attorna_get_option('color', $key);
					}
				}
			}

			return $options;
		}
	}

	add_action('wp_head', 'attorna_set_custom_header');
	if( !function_exists('attorna_set_custom_header') ){
		function attorna_set_custom_header(){
			attorna_get_option('general', 'layout', '');
			
			$header_id = get_post_meta(get_the_ID(), 'gdlr_core_custom_header_id', true);
			if( empty($header_id) ){
				$header_id = attorna_get_option('general', 'custom-header', '');
			}

			if( !empty($header_id) ){
				$option = 'attorna_general';
				$header_options = get_post_meta($header_id, 'gdlr-core-header-settings', true);

				if( !empty($header_options) ){
					foreach( $header_options as $key => $value ){
						$GLOBALS[$option][$key] = $value;
					}
				}

				$header_css = get_post_meta($header_id, 'gdlr-core-custom-header-css', true);
				if( !empty($header_css) ){
					if( get_post_type() == 'page' ){
						$header_css = str_replace('.gdlr-core-page-id', '.page-id-' . get_the_ID(), $header_css);
					}else{
						$header_css = str_replace('.gdlr-core-page-id', '.postid-' . get_the_ID(), $header_css);
					}
					echo '<style type="text/css" >' . $header_css . '</style>';
				}
				

			}
		} // attorna_set_custom_header
	}

	// override menu on page option
	add_filter('wp_nav_menu_args', 'attorna_wp_nav_menu_args');
	if( !function_exists('attorna_wp_nav_menu_args') ){
		function attorna_wp_nav_menu_args($args){

			$attorna_locations = array('main_menu', 'right_menu', 'top_bar_menu', 'mobile_menu');
			if( !empty($args['theme_location']) && in_array($args['theme_location'], $attorna_locations) ){
				$menu_id = get_post_meta(get_the_ID(), 'gdlr-core-location-' . $args['theme_location'], true);
				
				if( !empty($menu_id) ){
					$args['menu'] = $menu_id;
					$args['theme_location'] = '';
				}
			}

			return $args;
		}
	}

	if( !function_exists('attorna_top_bar_options') ){
		function attorna_top_bar_options(){
			return array(
				'title' => esc_html__('Top Bar', 'attorna'),
				'options' => array(

					'enable-top-bar' => array(
						'title' => esc_html__('Enable Top Bar', 'attorna'),
						'type' => 'checkbox',
					),
					'enable-top-bar-on-mobile' => array(
						'title' => esc_html__('Enable Top Bar On Mobile', 'attorna'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
					'top-bar-width' => array(
						'title' => esc_html__('Top Bar Width', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'boxed' => esc_html__('Boxed ( Within Container )', 'attorna'),
							'full' => esc_html__('Full', 'attorna'),
							'custom' => esc_html__('Custom', 'attorna'),
						),
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-width-pixel' => array(
						'title' => esc_html__('Top Bar Width Pixel', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'default' => '1140px',
						'condition' => array( 'enable-top-bar' => 'enable', 'top-bar-width' => 'custom' ),
						'selector' => '.attorna-top-bar-container.attorna-top-bar-custom-container{ max-width: #gdlr#; }'
					),
					'top-bar-full-side-padding' => array(
						'title' => esc_html__('Top Bar Full ( Left/Right ) Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.attorna-top-bar-container.attorna-top-bar-full{ padding-right: #gdlr#; padding-left: #gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable', 'top-bar-width' => 'full' )
					),
					'top-bar-menu-position' => array(
						'title' => esc_html__('Top Bar Menu Position', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'none' => esc_html__('None', 'attorna'),
							'left' => esc_html__('Left', 'attorna'),
							'right' => esc_html__('Right', 'attorna'),
						),
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-left-text' => array(
						'title' => esc_html__('Top Bar Left Text', 'attorna'),
						'type' => 'textarea',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-right-text' => array(
						'title' => esc_html__('Top Bar Right Text', 'attorna'),
						'type' => 'textarea',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-right-button-icon-class' => array(
						'title' => esc_html__('Top Bar Right Button Icon Class', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),	
					'top-bar-right-button-text' => array(
						'title' => esc_html__('Top Bar Right Button Text', 'attorna'),
						'type' => 'text',
						'default' => esc_html__('Get A Quote', 'attorna'),
						'condition' => array( 'enable-top-bar' => 'enable' )
					),	
					'top-bar-right-button-link' => array(
						'title' => esc_html__('Top Bar Right Button Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),	
					'top-bar-right-button-link-target' => array(
						'title' => esc_html__('Top Bar Right Button Text', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'_self' => esc_html__('Current Screen', 'attorna'),
							'_blank' => esc_html__('New Window', 'attorna'),
						),
						'condition' => array( 'enable-top-bar' => 'enable' )
					),	
					'top-bar-top-padding' => array(
						'title' => esc_html__('Top Bar Top Padding', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
 						'default' => '10px',
						'selector' => '.attorna-top-bar{ padding-top: #gdlr#; }'  . 
							'.attorna-top-bar-right-button{ padding-top: #gdlr#; padding-top: calc(#gdlr# - 1px); margin-top: -#gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-bottom-padding' => array(
						'title' => esc_html__('Top Bar Bottom Padding', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '10px',
						'selector' => '.attorna-top-bar{ padding-bottom: #gdlr#; }' .
							'.attorna-top-bar .attorna-top-bar-menu > li > a{ padding-bottom: #gdlr#; }' .  
							'.sf-menu.attorna-top-bar-menu > .attorna-mega-menu .sf-mega, .sf-menu.attorna-top-bar-menu > .attorna-normal-menu ul{ margin-top: #gdlr#; }'  . 
							'.attorna-top-bar-right-button{ padding-bottom: #gdlr#; padding-bottom: calc(#gdlr# + 1px); margin-bottom: -#gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-text-size' => array(
						'title' => esc_html__('Top Bar Text Size', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.attorna-top-bar{ font-size: #gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-bottom-border' => array(
						'title' => esc_html__('Top Bar Bottom Border', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '10',
						'default' => '0',
						'selector' => '.attorna-top-bar{ border-bottom-width: #gdlr#; }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-shadow-size' => array(
						'title' => esc_html__('Top Bar Shadow Size', 'attorna'),
						'type' => 'text',
						'data-input-type' => 'pixel',
						'condition' => array( 'enable-top-bar' => 'enable' )
					),
					'top-bar-shadow-color' => array(
						'title' => esc_html__('Top Bar Shadow Color', 'attorna'),
						'type' => 'colorpicker',
						'data-type' => 'rgba',
						'default' => '#000',
						'selector-extra' => true,
						'selector' => '.attorna-top-bar{ ' . 
							'box-shadow: 0px 0px <top-bar-shadow-size>t rgba(#gdlra#, 0.1); ' . 
							'-webkit-box-shadow: 0px 0px <top-bar-shadow-size>t rgba(#gdlra#, 0.1); ' . 
							'-moz-box-shadow: 0px 0px <top-bar-shadow-size>t rgba(#gdlra#, 0.1); }',
						'condition' => array( 'enable-top-bar' => 'enable' )
					)
				)
			);
		}
	}

	if( !function_exists('attorna_top_bar_social_options') ){
		function attorna_top_bar_social_options(){
			return array(
				'title' => esc_html__('Top Bar Social', 'attorna'),
				'options' => array(
					'enable-top-bar-social' => array(
						'title' => esc_html__('Enable Top Bar Social', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'top-bar-social-delicious' => array(
						'title' => esc_html__('Top Bar Social Delicious Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-email' => array(
						'title' => esc_html__('Top Bar Social Email Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-deviantart' => array(
						'title' => esc_html__('Top Bar Social Deviantart Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-digg' => array(
						'title' => esc_html__('Top Bar Social Digg Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-facebook' => array(
						'title' => esc_html__('Top Bar Social Facebook Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-flickr' => array(
						'title' => esc_html__('Top Bar Social Flickr Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-google-plus' => array(
						'title' => esc_html__('Top Bar Social Google Plus Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-lastfm' => array(
						'title' => esc_html__('Top Bar Social Lastfm Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-linkedin' => array(
						'title' => esc_html__('Top Bar Social Linkedin Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-pinterest' => array(
						'title' => esc_html__('Top Bar Social Pinterest Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-rss' => array(
						'title' => esc_html__('Top Bar Social RSS Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-skype' => array(
						'title' => esc_html__('Top Bar Social Skype Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-stumbleupon' => array(
						'title' => esc_html__('Top Bar Social Stumbleupon Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-tumblr' => array(
						'title' => esc_html__('Top Bar Social Tumblr Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-twitter' => array(
						'title' => esc_html__('Top Bar Social Twitter Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-vimeo' => array(
						'title' => esc_html__('Top Bar Social Vimeo Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-youtube' => array(
						'title' => esc_html__('Top Bar Social Youtube Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-instagram' => array(
						'title' => esc_html__('Top Bar Social Instagram Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),
					'top-bar-social-snapchat' => array(
						'title' => esc_html__('Top Bar Social Snapchat Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-top-bar-social' => 'enable' )
					),

				)
			);
		}
	}

	if( !function_exists('attorna_header_options') ){
		function attorna_header_options(){
			return array(
				'title' => esc_html__('Header', 'attorna'),
				'options' => array(

					'header-style' => array(
						'title' => esc_html__('Header Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'plain' => esc_html__('Plain', 'attorna'),
							'bar' => esc_html__('Bar', 'attorna'),
							'bar2' => esc_html__('Navigation Boxed', 'attorna'),
							'boxed' => esc_html__('Boxed', 'attorna'),
							'side' => esc_html__('Side Menu', 'attorna'),
							'side-toggle' => esc_html__('Side Menu Toggle', 'attorna'),
						),
						'default' => 'plain',
					),
					'header-plain-style' => array(
						'title' => esc_html__('Header Plain Style', 'attorna'),
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
					'header-plain-bottom-border' => array(
						'title' => esc_html__('Plain Header Bottom Border', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '10',
						'default' => '0',
						'selector' => '.attorna-header-style-plain{ border-bottom-width: #gdlr#; }',
						'condition' => array( 'header-style' => array('plain') )
					),
					'header-bar-navigation-align' => array(
						'title' => esc_html__('Header Bar Style', 'attorna'),
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
					'header-bar2-navigation-align' => array(
						'title' => esc_html__('Header Bar 2 Style', 'attorna'),
						'type' => 'radioimage',
						'options' => array(
							'left' => get_template_directory_uri() . '/images/header/bar2-left.jpg',
							'center' => get_template_directory_uri() . '/images/header/bar2-center.jpg',
							'center-logo' => get_template_directory_uri() . '/images/header/bar2-center-logo.jpg',
						),
						'default' => 'center',
						'condition' => array( 'header-style' => 'bar2' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'header-background-style' => array(
						'title' => esc_html__('Header/Navigation Background Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'solid' => esc_html__('Solid', 'attorna'),
							'transparent' => esc_html__('Transparent', 'attorna'),
						),
						'default' => 'solid',
						'condition' => array( 'header-style' => array('plain', 'bar', 'bar2') )
					),
					'top-bar-background-opacity' => array(
						'title' => esc_html__('Top Bar Background Opacity', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '50',
						'condition' => array( 'header-style' => array('plain', 'bar2'), 'header-background-style' => 'transparent' ),
						'selector' => '.attorna-header-background-transparent .attorna-top-bar-background{ opacity: #gdlr#; }'
					),
					'header-background-opacity' => array(
						'title' => esc_html__('Header Background Opacity', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '50',
						'condition' => array( 'header-style' => array('plain', 'bar2'), 'header-background-style' => 'transparent' ),
						'selector' => '.attorna-header-background-transparent .attorna-header-background{ opacity: #gdlr#; }'
					),
					'navigation-background-opacity' => array(
						'title' => esc_html__('Navigation Background Opacity', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '50',
						'condition' => array( 'header-style' => array('bar', 'bar2'), 'header-background-style' => 'transparent' ),
						'selector' => '.attorna-navigation-bar-wrap.attorna-style-transparent .attorna-navigation-background{ opacity: #gdlr#; }' .
							'.attorna-navigation-header-style-bar.attorna-style-2 .attorna-navigation-background{ opacity: #gdlr#; }'
					),
					'header-boxed-style' => array(
						'title' => esc_html__('Header Boxed Style', 'attorna'),
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
						'title' => esc_html__('Top Bar Background Opacity', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '0',
						'condition' => array( 'header-style' => 'boxed' ),
						'selector' => '.attorna-header-boxed-wrap .attorna-top-bar-background{ opacity: #gdlr#; }'
					),
					'boxed-top-bar-background-extend' => array(
						'title' => esc_html__('Top Bar Background Extend ( Bottom )', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0px',
						'data-max' => '200px',
						'default' => '0px',
						'condition' => array( 'header-style' => 'boxed' ),
						'selector' => '.attorna-header-boxed-wrap .attorna-top-bar-background{ margin-bottom: -#gdlr#; }'
					),
					'boxed-header-top-margin' => array(
						'title' => esc_html__('Header Top Margin', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0px',
						'data-max' => '200px',
						'default' => '0px',
						'condition' => array( 'header-style' => 'boxed' ),
						'selector' => '.attorna-header-style-boxed{ margin-top: #gdlr#; }'
					),
					'header-side-style' => array(
						'title' => esc_html__('Header Side Style', 'attorna'),
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
						'title' => esc_html__('Header Side Text Align', 'attorna'),
						'type' => 'radioimage',
						'options' => 'text-align',
						'default' => 'left',
						'condition' => array( 'header-style' => 'side' )
					),
					'header-side-toggle-style' => array(
						'title' => esc_html__('Header Side Toggle Style', 'attorna'),
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
						'title' => esc_html__('Header Side Toggle Menu Type', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'left' => esc_html__('Left Slide Menu', 'attorna'),
							'right' => esc_html__('Right Slide Menu', 'attorna'),
							'overlay' => esc_html__('Overlay Menu', 'attorna'),
						),
						'default' => 'overlay',
						'condition' => array( 'header-style' => 'side-toggle' )
					),
					'header-side-toggle-display-logo' => array(
						'title' => esc_html__('Display Logo', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'header-style' => 'side-toggle' )
					),
					'header-width' => array(
						'title' => esc_html__('Header Width', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'boxed' => esc_html__('Boxed ( Within Container )', 'attorna'),
							'full' => esc_html__('Full', 'attorna'),
							'custom' => esc_html__('Custom', 'attorna'),
						),
						'condition' => array('header-style'=> array('plain', 'bar', 'bar2', 'boxed'))
					),
					'header-width-pixel' => array(
						'title' => esc_html__('Header Width Pixel', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'default' => '1140px',
						'condition' => array('header-style'=> array('plain', 'bar', 'bar2', 'boxed'), 'header-width' => 'custom'),
						'selector' => '.attorna-header-container.attorna-header-custom-container{ max-width: #gdlr#; }'
					),
					'header-full-side-padding' => array(
						'title' => esc_html__('Header Full ( Left/Right ) Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.attorna-header-container.attorna-header-full{ padding-right: #gdlr#; padding-left: #gdlr#; }',
						'condition' => array('header-style'=> array('plain', 'bar', 'bar2', 'boxed'), 'header-width'=>'full')
					),
					'boxed-header-frame-radius' => array(
						'title' => esc_html__('Header Frame Radius', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '3px',
						'condition' => array( 'header-style' => 'boxed' ),
						'selector' => '.attorna-header-boxed-wrap .attorna-header-background{ border-radius: #gdlr#; -moz-border-radius: #gdlr#; -webkit-border-radius: #gdlr#; }'
					),
					'boxed-header-content-padding' => array(
						'title' => esc_html__('Header Content ( Left/Right ) Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '30px',
						'selector' => '.attorna-header-style-boxed .attorna-header-container-item{ padding-left: #gdlr#; padding-right: #gdlr#; }' . 
							'.attorna-navigation-right{ right: #gdlr#; } .attorna-navigation-left{ left: #gdlr#; }',
						'condition' => array( 'header-style' => 'boxed' )
					),
					'navigation-text-top-margin' => array(
						'title' => esc_html__('Navigation Text Top Padding', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '0px',
						'condition' => array( 'header-style' => 'plain', 'header-plain-style' => 'splitted-menu' ),
						'selector' => '.attorna-header-style-plain.attorna-style-splitted-menu .attorna-navigation .sf-menu > li > a{ padding-top: #gdlr#; } ' .
							'.attorna-header-style-plain.attorna-style-splitted-menu .attorna-main-menu-left-wrap,' .
							'.attorna-header-style-plain.attorna-style-splitted-menu .attorna-main-menu-right-wrap{ padding-top: #gdlr#; }'
					),
					'navigation-text-top-margin-boxed' => array(
						'title' => esc_html__('Navigation Text Top Padding', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '0px',
						'condition' => array( 'header-style' => 'boxed', 'header-boxed-style' => 'splitted-menu' ),
						'selector' => '.attorna-header-style-boxed.attorna-style-splitted-menu .attorna-navigation .sf-menu > li > a{ padding-top: #gdlr#; } ' .
							'.attorna-header-style-boxed.attorna-style-splitted-menu .attorna-main-menu-left-wrap,' .
							'.attorna-header-style-boxed.attorna-style-splitted-menu .attorna-main-menu-right-wrap{ padding-top: #gdlr#; }'
					),
					'navigation-text-side-spacing' => array(
						'title' => esc_html__('Navigation Text Side ( Left / Right ) Spaces', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '30',
						'data-type' => 'pixel',
						'default' => '13px',
						'selector' => '.attorna-navigation .sf-menu > li{ padding-left: #gdlr#; padding-right: #gdlr#; }',
						'condition' => array( 'header-style' => array('plain', 'bar', 'bar2', 'boxed') )
					),
					'navigation-left-offset' => array(
						'title' => esc_html__('Navigation Left Offset Spaces', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '0',
						'selector' => '.attorna-navigation .attorna-main-menu{ margin-left: #gdlr#; }'
					),
					'navigation-slide-bar' => array(
						'title' => esc_html__('Navigation Slide Bar', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'header-style' => array('plain', 'bar', 'bar2', 'boxed') )
					),
					'navigation-slide-bar-top-margin' => array(
						'title' => esc_html__('Navigation Slide Bar Top Margin', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '-28px',
						'selector' => '.attorna-navigation .attorna-navigation-slide-bar{ margin-top: #gdlr#; }',
						'condition' => array( 'header-style' => array('plain', 'bar', 'bar2', 'boxed'), 'navigation-slide-bar' => 'enable' )
					),
					'side-header-width-pixel' => array(
						'title' => esc_html__('Header Width Pixel', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '600',
						'default' => '340px',
						'condition' => array('header-style' => array('side', 'side-toggle')),
						'selector' => '.attorna-header-side-nav{ width: #gdlr#; }' . 
							'.attorna-header-side-content.attorna-style-left{ margin-left: #gdlr#; }' .
							'.attorna-header-side-content.attorna-style-right{ margin-right: #gdlr#; }'
					),
					'side-header-side-padding' => array(
						'title' => esc_html__('Header Side Padding', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '70px',
						'condition' => array('header-style' => 'side'),
						'selector' => '.attorna-header-side-nav.attorna-style-side{ padding-left: #gdlr#; padding-right: #gdlr#; }' . 
							'.attorna-header-side-nav.attorna-style-left .sf-vertical > li > ul.sub-menu{ padding-left: #gdlr#; }' .
							'.attorna-header-side-nav.attorna-style-right .sf-vertical > li > ul.sub-menu{ padding-right: #gdlr#; }'
					),
					'navigation-text-top-spacing' => array(
						'title' => esc_html__('Navigation Text Top / Bottom Spaces', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '40',
						'data-type' => 'pixel',
						'default' => '16px',
						'selector' => ' .attorna-navigation .sf-vertical > li{ padding-top: #gdlr#; padding-bottom: #gdlr#; }',
						'condition' => array( 'header-style' => array('side') )
					),
					'logo-right-box1-icon' => array(
						'title' => esc_html__('Header Right Box 1 Icon', 'attorna'),
						'type' => 'text',
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-box1-title' => array(
						'title' => esc_html__('Header Right Box 1 Title', 'attorna'),
						'type' => 'text',
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-box1-caption' => array(
						'title' => esc_html__('Header Right Box 1 Caption', 'attorna'),
						'type' => 'text',
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-box2-icon' => array(
						'title' => esc_html__('Header Right Box 2 Icon', 'attorna'),
						'type' => 'text',
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-box2-title' => array(
						'title' => esc_html__('Header Right Box 2 Title', 'attorna'),
						'type' => 'text',
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-box2-caption' => array(
						'title' => esc_html__('Header Right Box 2 Caption', 'attorna'),
						'type' => 'text',
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-box3-icon' => array(
						'title' => esc_html__('Header Right Box 3 Icon', 'attorna'),
						'type' => 'text',
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-box3-title' => array(
						'title' => esc_html__('Header Right Box 3 Title', 'attorna'),
						'type' => 'text',
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-box3-caption' => array(
						'title' => esc_html__('Header Right Box 3 Caption', 'attorna'),
						'type' => 'text',
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-text' => array(
						'title' => esc_html__('Header Right Text', 'attorna'),
						'type' => 'textarea',
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-text-top-padding' => array(
						'title' => esc_html__('Header Right Text Top Padding', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '30px',
						'condition' => array('header-style' => array('bar', 'bar2')),
						'selector' => '.attorna-header-style-bar .attorna-logo-right-text{ padding-top: #gdlr#; }'
					),
					'logo-right-button-icon' => array(
						'title' => esc_html__('Logo Right Button Icon', 'attorna'),
						'type' => 'text',
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-button-text' => array(
						'title' => esc_html__('Logo Right Button Text', 'attorna'),
						'type' => 'text',
						'default' => esc_html__('Buy Now', 'attorna'),
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-button-link' => array(
						'title' => esc_html__('Logo Right Button Link', 'attorna'),
						'type' => 'text',
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-button-link-target' => array(
						'title' => esc_html__('Logo Right Button Link Target', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'_self' => esc_html__('Current Screen', 'attorna'),
							'_blank' => esc_html__('New Window', 'attorna'),
						),
						'condition' => array('header-style' => array('bar', 'bar2')),
					),
					'logo-right-button-top-margin' => array(
						'title' => esc_html__('Logo Right Button Top Margin', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '0px',
						'condition' => array('header-style' => array('bar', 'bar2')),
						'selector' => '.attorna-header-style-bar .attorna-logo-right-button{ margin-top: #gdlr#; }'
					),
					'header-shadow-size' => array(
						'title' => esc_html__('Header Shadow Size', 'attorna'),
						'type' => 'text',
						'data-input-type' => 'pixel',
						'condition' => array( 'header-style' => array('plain') )
					),
					'header-shadow-color' => array(
						'title' => esc_html__('Header Shadow Color', 'attorna'),
						'type' => 'colorpicker',
						'data-type' => 'rgba',
						'default' => '#000',
						'selector-extra' => true,
						'selector' => '.attorna-header-style-plain{ ' . 
							'box-shadow: 0px 0px <header-shadow-size>t rgba(#gdlra#, 0.1); ' . 
							'-webkit-box-shadow: 0px 0px <header-shadow-size>t rgba(#gdlra#, 0.1); ' . 
							'-moz-box-shadow: 0px 0px <header-shadow-size>t rgba(#gdlra#, 0.1); }',
						'condition' => array( 'header-style'=> array('plain') )
					),
					'header-bar-shadow-size' => array(
						'title' => esc_html__('Header Shadow Size', 'attorna'),
						'type' => 'text',
						'data-input-type' => 'pixel',
						'condition' => array( 'header-style' => array('bar') )
					),
					'header-bar-shadow-color' => array(
						'title' => esc_html__('Header Shadow Color', 'attorna'),
						'type' => 'colorpicker',
						'data-type' => 'rgba',
						'default' => '#000',
						'selector-extra' => true,
						'selector' => '.attorna-navigation-header-style-bar{ ' . 
							'box-shadow: 0px 0px <header-shadow-size>t rgba(#gdlra#, 0.1); ' . 
							'-webkit-box-shadow: 0px 0px <header-shadow-size>t rgba(#gdlra#, 0.1); ' . 
							'-moz-box-shadow: 0px 0px <header-shadow-size>t rgba(#gdlra#, 0.1); }' . 
							'.attorna-navigation-header-style-bar{ position: relative; z-index: 1; } .attorna-header-style-bar { position: relative; z-index: 2; }',
						'condition' => array( 'header-style'=> array('bar') )
					)

				)
			);
		}
	}

	if( !function_exists('attorna_logo_options') ){
		function attorna_logo_options(){
			return array(
				'title' => esc_html__('Logo', 'attorna'),
				'options' => array(
					'enable-logo' => array(
						'title' => esc_html__('Enable Logo', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'logo' => array(
						'title' => esc_html__('Logo', 'attorna'),
						'type' => 'upload'
					),
					'logo-top-padding' => array(
						'title' => esc_html__('Logo Top Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '20px',
						'selector' => '.attorna-logo{ padding-top: #gdlr#; }',
						'description' => esc_html__('This option will be omitted on splitted menu option.', 'attorna'),
					),
					'logo-bottom-padding' => array(
						'title' => esc_html__('Logo Bottom Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '20px',
						'selector' => '.attorna-logo{ padding-bottom: #gdlr#; }',
						'description' => esc_html__('This option will be omitted on splitted menu option.', 'attorna'),
					),
					'logo-left-padding' => array(
						'title' => esc_html__('Logo Left Padding', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.attorna-logo.attorna-item-pdlr{ padding-left: #gdlr#; }',
						'description' => esc_html__('Leave this field blank for default value.', 'attorna'),
					),
					'max-logo-width' => array(
						'title' => esc_html__('Max Logo Width', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '200px',
						'selector' => '.attorna-logo-inner{ max-width: #gdlr#; }'
					),

					'mobile-logo' => array(
						'title' => esc_html__('Mobile/Tablet Logo', 'attorna'),
						'type' => 'upload',
						'description' => esc_html__('Leave this option blank to use the same logo.', 'attorna'),
					),
					'max-tablet-logo-width' => array(
						'title' => esc_html__('Max Tablet Logo Width', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '@media only screen and (max-width: 999px){ .attorna-mobile-header .attorna-logo-inner{ max-width: #gdlr#; } }'
					),
					'max-mobile-logo-width' => array(
						'title' => esc_html__('Max Mobile Logo Width', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '@media only screen and (max-width: 767px){ .attorna-mobile-header .attorna-logo-inner{ max-width: #gdlr#; } }'
					),
					'mobile-logo-position' => array(
						'title' => esc_html__('Mobile Logo Position', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'logo-left' => esc_html__('Logo Left', 'attorna'),
							'logo-center' => esc_html__('Logo Center', 'attorna'),
							'logo-right' => esc_html__('Logo Right', 'attorna'),
						)
					),
				
				)
			);
		}
	}

	if( !function_exists('attorna_navigation_options') ){
		function attorna_navigation_options(){
			return array(
				'title' => esc_html__('Navigation', 'attorna'),
				'options' => array(
					'main-navigation-top-padding' => array(
						'title' => esc_html__('Main Navigation Top Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '25px',
						'selector' => '.attorna-navigation{ padding-top: #gdlr#; }' . 
							'.attorna-navigation-top{ top: #gdlr#; }'
					),
					'main-navigation-bottom-padding' => array(
						'title' => esc_html__('Main Navigation Bottom Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '20px',
						'selector' => '.attorna-navigation .sf-menu > li > a{ padding-bottom: #gdlr#; }'
					),
					'main-navigation-item-right-padding' => array(
						'title' => esc_html__('Main Navigation Item Right Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '200',
						'data-type' => 'pixel',
						'default' => '0px',
						'selector' => '.attorna-navigation .attorna-main-menu{ padding-right: #gdlr#; }'
					),
					'main-navigation-right-padding' => array(
						'title' => esc_html__('Main Navigation Wrap Right Padding', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'selector' => '.attorna-navigation.attorna-item-pdlr{ padding-right: #gdlr#; }',
						'description' => esc_html__('Leave this field blank for default value.', 'attorna'),
					),
					'enable-main-navigation-submenu-indicator' => array(
						'title' => esc_html__('Enable Main Navigation Submenu Indicator', 'attorna'),
						'type' => 'checkbox',
						'default' => 'disable',
					),
					'navigation-right-top-margin' => array(
						'title' => esc_html__('Navigation Right ( search/cart/button ) Top Margin ', 'attorna'),
						'type' => 'text',
						'data-input-type' => 'pixel',
						'data-type' => 'pixel',
						'selector' => '.attorna-main-menu-right-wrap{ margin-top: #gdlr#; }'
					),
					'enable-main-navigation-search' => array(
						'title' => esc_html__('Enable Main Navigation Search', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
					),
					'enable-main-navigation-cart' => array(
						'title' => esc_html__('Enable Main Navigation Cart ( Woocommerce )', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
						'description' => esc_html__('The icon only shows if the woocommerce plugin is activated', 'attorna')
					),
					'enable-main-navigation-right-button' => array(
						'title' => esc_html__('Enable Main Navigation Right Button', 'attorna'),
						'type' => 'checkbox',
						'default' => 'disable',
						'description' => esc_html__('This option will be ignored on header side style', 'attorna')
					),
					'main-navigation-right-button-style' => array(
						'title' => esc_html__('Main Navigation Right Button Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'default' => esc_html__('Default', 'attorna'),
							'round' => esc_html__('Round', 'attorna'),
							'round-with-shadow' => esc_html__('Round With Shadow', 'attorna'),
						),
						'condition' => array( 'enable-main-navigation-right-button' => 'enable' ) 
					),
					'main-navigation-right-button-text' => array(
						'title' => esc_html__('Main Navigation Right Button Text', 'attorna'),
						'type' => 'text',
						'default' => esc_html__('Buy Now', 'attorna'),
						'condition' => array( 'enable-main-navigation-right-button' => 'enable' ) 
					),
					'main-navigation-right-button-link' => array(
						'title' => esc_html__('Main Navigation Right Button Link', 'attorna'),
						'type' => 'text',
						'condition' => array( 'enable-main-navigation-right-button' => 'enable' ) 
					),
					'main-navigation-right-button-link-target' => array(
						'title' => esc_html__('Main Navigation Right Button Link Target', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'_self' => esc_html__('Current Screen', 'attorna'),
							'_blank' => esc_html__('New Window', 'attorna'),
						),
						'condition' => array( 'enable-main-navigation-right-button' => 'enable' ) 
					),
					'right-menu-type' => array(
						'title' => esc_html__('Secondary/Mobile Menu Type', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'left' => esc_html__('Left Slide Menu', 'attorna'),
							'right' => esc_html__('Right Slide Menu', 'attorna'),
							'overlay' => esc_html__('Overlay Menu', 'attorna'),
						),
						'default' => 'right'
					),
					'right-menu-style' => array(
						'title' => esc_html__('Secondary/Mobile Menu Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'hamburger-with-border' => esc_html__('Hamburger With Border', 'attorna'),
							'hamburger' => esc_html__('Hamburger', 'attorna'),
						),
						'default' => 'hamburger-with-border'
					),
					
				) // logo-options
			);
		}
	}

	if( !function_exists('attorna_fixed_navigation_options') ){
		function attorna_fixed_navigation_options(){
			return array(
				'title' => esc_html__('Fixed Navigation', 'attorna'),
				'options' => array(

					'enable-main-navigation-sticky' => array(
						'title' => esc_html__('Enable Fixed Navigation Bar', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
					),
					'enable-logo-on-main-navigation-sticky' => array(
						'title' => esc_html__('Enable Logo on Fixed Navigation Bar', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' )
					),
					'fixed-navigation-bar-logo' => array(
						'title' => esc_html__('Fixed Navigation Bar Logo', 'attorna'),
						'type' => 'upload',
						'description' => esc_html__('Leave blank to show default logo', 'attorna'),
						'condition' => array( 'enable-main-navigation-sticky' => 'enable', 'enable-logo-on-main-navigation-sticky' => 'enable' )
					),
					'fixed-navigation-max-logo-width' => array(
						'title' => esc_html__('Fixed Navigation Max Logo Width', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' ),
						'selector' => '.attorna-fixed-navigation.attorna-style-slide .attorna-logo-inner img{ max-height: none !important; }' .
							'.attorna-animate-fixed-navigation.attorna-header-style-plain .attorna-logo-inner, ' . 
							'.attorna-animate-fixed-navigation.attorna-header-style-boxed .attorna-logo-inner{ max-width: #gdlr#; }'
					),
					'fixed-navigation-logo-top-padding' => array(
						'title' => esc_html__('Fixed Navigation Logo Top Padding', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '20px',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' ),
						'selector' => '.attorna-animate-fixed-navigation.attorna-header-style-plain .attorna-logo, ' . 
							'.attorna-animate-fixed-navigation.attorna-header-style-boxed .attorna-logo{ padding-top: #gdlr#; }'
					),
					'fixed-navigation-logo-bottom-padding' => array(
						'title' => esc_html__('Fixed Navigation Logo Bottom Padding', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '20px',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' ),
						'selector' => '.attorna-animate-fixed-navigation.attorna-header-style-plain .attorna-logo, ' . 
							'.attorna-animate-fixed-navigation.attorna-header-style-boxed .attorna-logo{ padding-bottom: #gdlr#; }'
					),
					'fixed-navigation-top-padding' => array(
						'title' => esc_html__('Fixed Navigation Top Padding', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '30px',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' ),
						'selector' => '.attorna-animate-fixed-navigation.attorna-header-style-plain .attorna-navigation, ' . 
							'.attorna-animate-fixed-navigation.attorna-header-style-boxed .attorna-navigation{ padding-top: #gdlr#; }' . 
							'.attorna-animate-fixed-navigation.attorna-header-style-plain .attorna-navigation-top, ' . 
							'.attorna-animate-fixed-navigation.attorna-header-style-boxed .attorna-navigation-top{ top: #gdlr#; }'
					),
					'fixed-navigation-bottom-padding' => array(
						'title' => esc_html__('Fixed Navigation Bottom Padding', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '25px',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' ),
						'selector' => '.attorna-animate-fixed-navigation.attorna-header-style-plain .attorna-navigation .sf-menu > li > a, ' . 
							'.attorna-animate-fixed-navigation.attorna-header-style-boxed .attorna-navigation .sf-menu > li > a{ padding-bottom: #gdlr#; }'
					),
					'fixed-navigation-anchor-offset' => array(
						'title' => esc_html__('Fixed Navigation Anchor Offset ( Fixed Navigation Height )', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '75px',
						'condition' => array( 'enable-main-navigation-sticky' => 'enable' ),
					),
					'enable-mobile-navigation-sticky' => array(
						'title' => esc_html__('Enable Mobile Fixed Navigation Bar', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
					),

				)
			);
		}
	}

	if( !function_exists('attorna_header_color_options') ){
		function attorna_header_color_options(){

			return array(
				'title' => esc_html__('Header', 'attorna'),
				'options' => array(
					
					'top-bar-background-color' => array(
						'title' => esc_html__('Top Bar Background Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#222222',
						'selector' => '.attorna-top-bar-background{ background-color: #gdlr#; }'
					),
					'top-bar-bottom-border-color' => array(
						'title' => esc_html__('Top Bar Bottom Border Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector' => '.attorna-body .attorna-top-bar{ border-bottom-color: #gdlr#; }'
					),
					'top-bar-text-color' => array(
						'title' => esc_html__('Top Bar Text Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector' => '.attorna-top-bar{ color: #gdlr#; }'
					),
					'top-bar-link-color' => array(
						'title' => esc_html__('Top Bar Link Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector' => '.attorna-body .attorna-top-bar a{ color: #gdlr#; }'
					),
					'top-bar-link-hover-color' => array(
						'title' => esc_html__('Top Bar Link Hover Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector' => '.attorna-body .attorna-top-bar a:hover{ color: #gdlr#; }'
					),
					'top-bar-social-color' => array(
						'title' => esc_html__('Top Bar Social Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector' => '.attorna-top-bar .attorna-top-bar-right-social a{ color: #gdlr#; }'
					),
					'top-bar-social-hover-color' => array(
						'title' => esc_html__('Top Bar Social Hover Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#e44444',
						'selector' => '.attorna-top-bar .attorna-top-bar-right-social a:hover{ color: #gdlr#; }'
					),
					'top-bar-right-button-background' => array(
						'title' => esc_html__('Top Bar Right Button Background', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#b1976b',
						'selector' => '.attorna-body .attorna-top-bar .attorna-top-bar-right-button{ background: #gdlr#; }'
					),
					'header-background-color' => array(
						'title' => esc_html__('Header Background Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector' => '.attorna-header-background, .attorna-sticky-menu-placeholder, .attorna-header-style-boxed.attorna-fixed-navigation{ background-color: #gdlr#; }'
					),
					'header-plain-bottom-border-color' => array(
						'title' => esc_html__('Header Bottom Border Color ( Header Plain Style )', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#e8e8e8',
						'selector' => '.attorna-header-wrap.attorna-header-style-plain{ border-color: #gdlr#; }'
					),
					'logo-right-box-icon-color' => array(
						'title' => esc_html__('Logo Right Box icon Color ( Header Bar Style )', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#888888',
						'selector' => '.attorna-logo-right-box-wrap .attorna-logo-right-box-icon{ color: #gdlr#; }'
					),
					'logo-right-box-title-color' => array(
						'title' => esc_html__('Logo Right Box Title Color ( Header Bar Style )', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#333333',
						'selector' => '.attorna-logo-right-box-wrap .attorna-logo-right-box-title{ color: #gdlr#; }'
					),
					'logo-right-box-caption-color' => array(
						'title' => esc_html__('Logo Right Box Caption Color ( Header Bar Style )', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#888888',
						'selector' => '.attorna-logo-right-box-wrap .attorna-logo-right-box-caption{ color: #gdlr#; }'
					),
					'logo-right-button-text-color' => array(
						'title' => esc_html__('Logo Right Button Text Color ( Header Bar Style )', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector' => '.attorna-header-style-bar .attorna-logo-right-button, .attorna-header-style-bar .attorna-logo-right-button:hover{ color: #gdlr#; }'
					),
					'logo-right-button-background-color' => array(
						'title' => esc_html__('Logo Right Button Background Color ( Header Bar Style )', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#8f4646',
						'selector' => '.attorna-header-style-bar .attorna-logo-right-button{ background-color: #gdlr#; }'
					),
					'logo-background-color' => array(
						'title' => esc_html__('Logo Background Color ( Header Side Menu Toggle Style )', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector' => '.attorna-header-side-nav.attorna-style-side-toggle .attorna-logo{ background-color: #gdlr#; }'
					),
					'secondary-menu-icon-color' => array(
						'title' => esc_html__('Secondary Menu Icon Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#383838',
						'selector'=> '.attorna-top-menu-button i, .attorna-mobile-menu-button i{ color: #gdlr#; }' . 
							'.attorna-mobile-button-hamburger:before, ' . 
							'.attorna-mobile-button-hamburger:after, ' . 
							'.attorna-mobile-button-hamburger span{ background: #gdlr#; }'
					),
					'secondary-menu-border-color' => array(
						'title' => esc_html__('Secondary Menu Border Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#dddddd',
						'selector'=> '.attorna-main-menu-right .attorna-top-menu-button, .attorna-mobile-menu .attorna-mobile-menu-button{ border-color: #gdlr#; }'
					),
					'search-overlay-background-color' => array(
						'title' => esc_html__('Search Overlay Background Color', 'attorna'),
						'type' => 'colorpicker',
						'data-type' => 'rgba',
						'default' => '#000000',
						'selector'=> '.attorna-top-search-wrap{ background-color: #gdlr#; background-color: rgba(#gdlra#, 0.88); }'
					),
					'top-cart-background-color' => array(
						'title' => esc_html__('Top Cart Background Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector'=> '.attorna-top-cart-content-wrap .attorna-top-cart-content{ background-color: #gdlr#; }'
					),
					'top-cart-title-color' => array(
						'title' => esc_html__('Top Cart Title Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#000000',
						'selector'=> '.attorna-top-cart-content-wrap .attorna-top-cart-title, .attorna-top-cart-item .attorna-top-cart-item-title, ' . 
							'.attorna-top-cart-item .attorna-top-cart-item-remove{ color: #gdlr#; }'
					),
					'top-cart-info-color' => array(
						'title' => esc_html__('Top Cart Info Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#6c6c6c',
						'selector'=> '.attorna-top-cart-content-wrap .woocommerce-Price-amount.amount{ color: #gdlr#; }'
					),
					'top-cart-view-cart-color' => array(
						'title' => esc_html__('Top Cart : View Cart Text Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#323232',
						'selector'=> '.attorna-body .attorna-top-cart-button-wrap .attorna-top-cart-button{ color: #gdlr#; }'
					),
					'top-cart-view-cart-background-color' => array(
						'title' => esc_html__('Top Cart : View Cart Background Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#f4f4f4',
						'selector'=> '.attorna-body .attorna-top-cart-button-wrap .attorna-top-cart-button{ background-color: #gdlr#; }'
					),
					'top-cart-checkout-color' => array(
						'title' => esc_html__('Top Cart : Checkout Text Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector'=> '.attorna-body .attorna-top-cart-button-wrap .attorna-top-cart-button-2{ color: #gdlr#; }'
					),
					'top-cart-checkout-background-color' => array(
						'title' => esc_html__('Top Cart : Checkout Background Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#000000',
						'selector'=> '.attorna-body .attorna-top-cart-button-wrap .attorna-top-cart-button-2{ background-color: #gdlr#; }'
					),
					'breadcrumbs-text-color' => array(
						'title' => esc_html__('Breadcrumbs ( Plugin ) Text Color', 'attorna'),
						'type' => 'colorpicker',
						'data-type' => 'rgba',
						'default' => '#c0c0c0',
						'selector'=> '.attorna-body .attorna-breadcrumbs, .attorna-body .attorna-breadcrumbs a span, ' . 
							'.gdlr-core-breadcrumbs-item, .gdlr-core-breadcrumbs-item a span{ color: #gdlr#; }'
					),
					'breadcrumbs-text-active-color' => array(
						'title' => esc_html__('Breadcrumbs ( Plugin ) Text Active Color', 'attorna'),
						'type' => 'colorpicker',
						'data-type' => 'rgba',
						'default' => '#777777',
						'selector'=> '.attorna-body .attorna-breadcrumbs span, .attorna-body .attorna-breadcrumbs a:hover span, ' . 
							'.gdlr-core-breadcrumbs-item span, .gdlr-core-breadcrumbs-item a:hover span{ color: #gdlr#; }'
					),

				) // header-options
			);

		}
	}

	if( !function_exists('attorna_navigation_color_options') ){
		function attorna_navigation_color_options(){

			return array(
				'title' => esc_html__('Menu', 'attorna'),
				'options' => array(

					'navigation-bar-background-color' => array(
						'title' => esc_html__('Navigation Bar Background Color ( Header Bar Style )', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#f4f4f4',
						'selector' => '.attorna-navigation-background{ background-color: #gdlr#; }'
					),
					'navigation-bar-top-border-color' => array(
						'title' => esc_html__('Navigation Bar Top Border Color ( Header Bar Style )', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#e8e8e8',
						'selector' => '.attorna-body .attorna-navigation-bar-wrap{ border-color: #gdlr#; }'
					),
					'navigation-slide-bar-color' => array(
						'title' => esc_html__('Navigation Slide Bar Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#2d9bea',
						'selector' => '.attorna-navigation .attorna-navigation-slide-bar{ border-color: #gdlr#; }' . 
							'.attorna-navigation .attorna-navigation-slide-bar:before{ border-bottom-color: #gdlr#; }'
					),
					'main-menu-text-color' => array(
						'title' => esc_html__('Main Menu Text Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#999999',
						'selector' => '.sf-menu > li > a, .sf-vertical > li > a{ color: #gdlr#; }'
					),
					'main-menu-text-hover-color' => array(
						'title' => esc_html__('Main Menu Text Hover Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#333333',
						'selector' => '.sf-menu > li > a:hover, ' . 
							'.sf-menu > li.current-menu-item > a, ' .
							'.sf-menu > li.current-menu-ancestor > a, ' .
							'.sf-vertical > li > a:hover, ' . 
							'.sf-vertical > li.current-menu-item > a, ' .
							'.sf-vertical > li.current-menu-ancestor > a{ color: #gdlr#; }'
					),
					'sub-menu-background-color' => array(
						'title' => esc_html__('Sub Menu Background Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#2e2e2e',
						'selector'=> '.sf-menu > .attorna-normal-menu li, .sf-menu > .attorna-mega-menu > .sf-mega, ' . 
							'.sf-vertical ul.sub-menu li, ul.sf-menu > .menu-item-language li{ background-color: #gdlr#; }'
					),
					'sub-menu-text-color' => array(
						'title' => esc_html__('Sub Menu Text Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#bebebe',
						'selector'=> '.sf-menu > li > .sub-menu a, .sf-menu > .attorna-mega-menu > .sf-mega a, ' . 
							'.sf-vertical ul.sub-menu li a{ color: #gdlr#; }'
					),
					'sub-menu-text-hover-color' => array(
						'title' => esc_html__('Sub Menu Text Hover Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector'=> '.sf-menu > li > .sub-menu a:hover, ' . 
							'.sf-menu > li > .sub-menu .current-menu-item > a, ' . 
							'.sf-menu > li > .sub-menu .current-menu-ancestor > a, '.
							'.sf-menu > .attorna-mega-menu > .sf-mega a:hover, '.
							'.sf-menu > .attorna-mega-menu > .sf-mega .current-menu-item > a, '.
							'.sf-vertical > li > .sub-menu a:hover, ' . 
							'.sf-vertical > li > .sub-menu .current-menu-item > a, ' . 
							'.sf-vertical > li > .sub-menu .current-menu-ancestor > a{ color: #gdlr#; }'
					),
					'sub-menu-text-hover-background-color' => array(
						'title' => esc_html__('Sub Menu Text Hover Background', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#393939',
						'selector'=> '.sf-menu > li > .sub-menu a:hover, ' . 
							'.sf-menu > li > .sub-menu .current-menu-item > a, ' . 
							'.sf-menu > li > .sub-menu .current-menu-ancestor > a, '.
							'.sf-menu > .attorna-mega-menu > .sf-mega a:hover, '.
							'.sf-menu > .attorna-mega-menu > .sf-mega .current-menu-item > a, '.
							'.sf-vertical > li > .sub-menu a:hover, ' . 
							'.sf-vertical > li > .sub-menu .current-menu-item > a, ' . 
							'.sf-vertical > li > .sub-menu .current-menu-ancestor > a{ background-color: #gdlr#; }'
					),
					'sub-mega-menu-title-color' => array(
						'title' => esc_html__('Sub Mega Menu Title Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector'=> '.attorna-navigation .sf-menu > .attorna-mega-menu .sf-mega-section-inner > a{ color: #gdlr#; }'
					),
					'sub-mega-menu-divider-color' => array(
						'title' => esc_html__('Sub Mega Menu Divider Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#424242',
						'selector'=> '.attorna-navigation .sf-menu > .attorna-mega-menu .sf-mega-section{ border-color: #gdlr#; }'
					),
					'side-menu-text-color' => array(
						'title' => esc_html__('Side Menu Text Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#979797',
						'selector'=> '.mm-navbar .mm-title, .mm-navbar .mm-btn, ul.mm-listview li > a, ul.mm-listview li > span{ color: #gdlr#; }' . 
							'ul.mm-listview li a{ border-color: #gdlr#; }' .
							'.mm-arrow:after, .mm-next:after, .mm-prev:before{ border-color: #gdlr#; }'
					),
					'side-menu-text-hover-color' => array(
						'title' => esc_html__('Side Menu Text Hover Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector'=> '.mm-navbar .mm-title:hover, .mm-navbar .mm-btn:hover, ' .
							'ul.mm-listview li a:hover, ul.mm-listview li > span:hover, ' . 
							'ul.mm-listview li.current-menu-item > a, ul.mm-listview li.current-menu-ancestor > a, ul.mm-listview li.current-menu-ancestor > span{ color: #gdlr#; }'
					),
					'side-menu-background-color' => array(
						'title' => esc_html__('Side Menu Background Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#1f1f1f',
						'selector'=> '.mm-menu{ background-color: #gdlr#; }'
					),
					'side-menu-border-color' => array(
						'title' => esc_html__('Side Menu Border Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#626262',
						'selector'=> 'ul.mm-listview li{ border-color: #gdlr#; }'
					),
					'overlay-menu-background-color' => array(
						'title' => esc_html__('Overlay Menu Background Color', 'attorna'),
						'type' => 'colorpicker',
						'data-type' => 'rgba',
						'default' => '#000000',
						'selector'=> '.attorna-overlay-menu-content{ background-color: #gdlr#; background-color: rgba(#gdlra#, 0.88); }'
					),
					'overlay-menu-border-color' => array(
						'title' => esc_html__('Overlay Menu Border Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#424242',
						'selector'=> '.attorna-overlay-menu-content ul.menu > li, .attorna-overlay-menu-content ul.sub-menu ul.sub-menu{ border-color: #gdlr#; }'
					),
					'overlay-menu-text-color' => array(
						'title' => esc_html__('Overlay Menu Text Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector'=> '.attorna-overlay-menu-content ul li a, .attorna-overlay-menu-content .attorna-overlay-menu-close{ color: #gdlr#; }'
					),
					'overlay-menu-text-hover-color' => array(
						'title' => esc_html__('Overlay Menu Text Hover Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#a8a8a8',
						'selector'=> '.attorna-overlay-menu-content ul li a:hover{ color: #gdlr#; }'
					),
					'anchor-bullet-background-color' => array(
						'title' => esc_html__('Anchor Bullet Background', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#777777',
						'selector'=> '.attorna-bullet-anchor a:before{ background-color: #gdlr#; }'
					),
					'anchor-bullet-background-active-color' => array(
						'title' => esc_html__('Anchor Bullet Background Active', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector'=> '.attorna-bullet-anchor a:hover, .attorna-bullet-anchor a.current-menu-item{ border-color: #gdlr#; }' .
							'.attorna-bullet-anchor a:hover:before, .attorna-bullet-anchor a.current-menu-item:before{ background: #gdlr#; }'
					),
					
										
				) // navigation-menu-options
			);	

		} // attorna_navigation_color_options
	}

	if( !function_exists('attorna_navigation_right_color_options') ){
		function attorna_navigation_right_color_options(){

			return array(
				'title' => esc_html__('Navigation Right', 'attorna'),
				'options' => array(

					'navigation-bar-right-icon-color' => array(
						'title' => esc_html__('Navigation Bar Right Icon Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#383838',
						'selector'=> '.attorna-main-menu-search i, .attorna-main-menu-cart i{ color: #gdlr#; }'
					),
					'woocommerce-cart-icon-number-background' => array(
						'title' => esc_html__('Woocommmerce Cart\'s Icon Number Background', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#bd584e',
						'selector'=> '.attorna-main-menu-cart > .attorna-top-cart-count{ background-color: #gdlr#; }'
					),
					'woocommerce-cart-icon-number-color' => array(
						'title' => esc_html__('Woocommmerce Cart\'s Icon Number Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#ffffff',
						'selector'=> '.attorna-main-menu-cart > .attorna-top-cart-count{ color: #gdlr#; }'
					),
					'navigation-right-button-text-color' => array(
						'title' => esc_html__('Navigation Right Button Text Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#333333',
						'selector'=> '.attorna-body .attorna-main-menu-right-button{ color: #gdlr#; }'
					),
					'navigation-right-button-text-hover-color' => array(
						'title' => esc_html__('Navigation Right Button Text Hover Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#555555',
						'selector'=> '.attorna-body .attorna-main-menu-right-button:hover{ color: #gdlr#; }'
					),
					'navigation-right-button-background-color' => array(
						'title' => esc_html__('Navigation Right Button Background Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '',
						'selector'=> '.attorna-body .attorna-main-menu-right-button{ background-color: #gdlr#; }'
					),
					'navigation-right-button-background-hover-color' => array(
						'title' => esc_html__('Navigation Right Button Background Hover Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '',
						'selector'=> '.attorna-body .attorna-main-menu-right-button:hover{ background-color: #gdlr#; }'
					),
					'navigation-right-button-border-color' => array(
						'title' => esc_html__('Navigation Right Button Border Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#333333',
						'selector'=> '.attorna-body .attorna-main-menu-right-button{ border-color: #gdlr#; }'
					),
					'navigation-right-button-border-hover-color' => array(
						'title' => esc_html__('Navigation Right Button Border Hover Color', 'attorna'),
						'type' => 'colorpicker',
						'default' => '#555555',
						'selector'=> '.attorna-body .attorna-main-menu-right-button:hover{ border-color: #gdlr#; }'
					),

				)
			);

		} // attorna_navigation_right_color_options
	}