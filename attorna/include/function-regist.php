<?php 
	/*	
	*	Goodlayers Function Inclusion File
	*	---------------------------------------------------------------------
	*	This file contains the script to includes necessary function to the theme
	*	---------------------------------------------------------------------
	*/

	// Set the content width based on the theme's design and stylesheet.
	if( !isset($content_width) ){
		$content_width = str_replace('px', '', '1150px'); 
	}

	// Add body class for page builder
	add_filter('body_class', 'attorna_body_class');
	if( !function_exists('attorna_body_class') ){
		function attorna_body_class( $classes ) {
			$classes[] = 'attorna-body';
			$classes[] = 'attorna-body-front';

			// layout class
			$layout = attorna_get_option('general', 'layout', 'full');
			if( $layout == 'boxed' ){
			 	$classes[] = 'attorna-boxed';

			 	$border = attorna_get_option('general', 'enable-boxed-border', 'disable');
			 	if( $border == 'enable' ){
			 		$classes[] = 'attorna-boxed-border';
			 	}
			}else{
				$classes[] = 'attorna-full';
			}

			// background class
			if( $layout == 'boxed' ){
				$post_option = attorna_get_post_option(get_the_ID());
				if( empty($post_option['body-background-type']) || $post_option['body-background-type'] == 'default' ){
					$background = attorna_get_option('general', 'background-type', 'color');
				 	if( $background == 'pattern' ){
				 		$classes[] = 'attorna-background-pattern';
				 	}
				}
			}

			// header style
			$header_style = attorna_get_option('general', 'header-style', 'plain');
			if( !in_array($header_style, array('side', 'side-toggle')) ){
				if( is_page() ){
					$post_option = attorna_get_post_option(get_the_ID());
				}

				if( empty($post_option['sticky-navigation']) || $post_option['sticky-navigation'] == 'default' ){
					$sticky_menu = attorna_get_option('general', 'enable-main-navigation-sticky', 'enable');
				}else{
					$sticky_menu = $post_option['sticky-navigation'];
				}
				if( $sticky_menu == 'enable' ){
					$classes[] = ' attorna-with-sticky-navigation';
					
					$sticky_menu_logo = attorna_get_option('general', 'enable-logo-on-main-navigation-sticky', 'enable');
					if( $sticky_menu_logo == 'disable' ){
						$classes[] = ' attorna-sticky-navigation-no-logo';
					}
				}
			}

			// blog style
			if( is_single() && get_post_type() == 'post' ){
				$blog_style = attorna_get_option('general', 'blog-style', 'style-1');
				$classes[] = ' attorna-blog-' . $blog_style;
			}

			// blockquote style
			$blockquote_style = attorna_get_option('general', 'blockquote-style', 'style-1');
			$classes[] = ' attorna-blockquote-' . $blockquote_style;
			
			return $classes;
		}
	}

	// Set the neccessary function to be used in the theme
	add_action('after_setup_theme', 'attorna_theme_setup');
	if( !function_exists( 'attorna_theme_setup' ) ){
		function attorna_theme_setup(){
			
			// define textdomain for translation
			load_theme_textdomain('attorna', get_template_directory() . '/languages');

			// add default posts and comments RSS feed links to head.
			add_theme_support('automatic-feed-links');

			// declare that this theme does not use a hard-coded <title> tag in <head>
			add_theme_support('title-tag');

			// tmce editor stylesheet
			add_editor_style('/css/editor-style.css');

			// define menu locations
			register_nav_menus(array(
				'main_menu' => esc_html__('Primary Menu', 'attorna'),
				'right_menu' => esc_html__('Secondary Menu', 'attorna'),
				'top_bar_menu' => esc_html__('Top Bar Menu', 'attorna'),
				'mobile_menu' => esc_html__('Mobile Menu', 'attorna'),
			));

			// enable support for post formats / thumbnail
			add_theme_support('post-thumbnails');
			add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio')); // 'status', 'chat'
			
			// switch default core markup
			add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
			
			// add custom image size
			$thumbnail_sizes = attorna_get_option('plugin', 'thumbnail-sizing');
			if( !empty($thumbnail_sizes) ){
				foreach( $thumbnail_sizes as $thumbnail_size ){
					add_image_size($thumbnail_size['name'], $thumbnail_size['width'], $thumbnail_size['height'], true);
				}
			}

		}
	}

	// turn the page comment off by default
	add_filter( 'wp_insert_post_data', 'attorna_page_default_comments_off' );
	if( !function_exists('attorna_page_default_comments_off') ){
		function attorna_page_default_comments_off( $data ) {
			if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' ) {
				$data['comment_status'] = 0;
			} 

			return $data;
		}
	}

	// top bar menu
	if( !function_exists('attorna_get_top_bar_menu') ){
		function attorna_get_top_bar_menu($position = 'left'){
			if( has_nav_menu('top_bar_menu') ){
				wp_nav_menu(array(
					'menu_id' => 'attorna-top-bar-menu',
					'theme_location'=>'top_bar_menu', 
					'container'=> '', 
					'menu_class'=> 'sf-menu attorna-top-bar-menu attorna-top-bar-' . esc_attr($position) . '-menu',
					'walker' => new attorna_menu_walker()
				));
			}
		}
	}

	// logo displaying
	if( !function_exists('attorna_get_logo') ){
		function attorna_get_logo($settings = array()){

			$extra_class  = (isset($settings['padding']) && $settings['padding'] === false)? '': ' attorna-item-pdlr';
			$extra_class .= empty($settings['wrapper-class'])? '': ' ' . $settings['wrapper-class'];
			
			$ret  = '<div class="attorna-logo ' . esc_attr($extra_class) . '">';
			$ret .= '<div class="attorna-logo-inner">';
		
			// fixed nav logo
			$orig_logo_class = ''; 
			if( empty($settings['mobile']) ){
				$enable_fixed_nav = attorna_get_option('general', 'enable-main-navigation-sticky', 'enable');
				$fixed_nav_sticky = attorna_get_option('general', 'enable-logo-on-main-navigation-sticky', 'enable');
				$fixed_nav_logo = attorna_get_option('general', 'fixed-navigation-bar-logo', '');
				if( $enable_fixed_nav == 'enable' && $fixed_nav_sticky == 'enable' && !empty($fixed_nav_logo) ){
					$ret .= '<a class="attorna-fixed-nav-logo" href="' . esc_url(home_url('/')) . '" >';
					$ret .= gdlr_core_get_image($fixed_nav_logo);
					$ret .= '</a>';

					$orig_logo_class = ' attorna-orig-logo'; 
				}
			}
		
			// print logo / mobile logo
			if( !empty($settings['mobile']) ){
				$logo_id = attorna_get_option('general', 'mobile-logo');
			} 
			if( empty($logo_id) ){
				$logo_id = attorna_get_option('general', 'logo');
			}
			if( is_numeric($logo_id) && !wp_attachment_is_image($logo_id) ){
				$logo_id = '';
			}
			$ret .= '<a class="' . esc_attr($orig_logo_class) . '" href="' . esc_url(home_url('/')) . '" >';
			if( empty($logo_id) ){
				if( !empty($settings['mobile']) && file_exists(get_template_directory() . '/images/logo-mobile.png') ){
					$ret .= gdlr_core_get_image(get_template_directory_uri() . '/images/logo-mobile.png');
				}else{
					$ret .= gdlr_core_get_image(get_template_directory_uri() . '/images/logo.png');
				}
			}else{
				$ret .= gdlr_core_get_image($logo_id);
			}
			$ret .= '</a>';

			$ret .= '</div>';
			$ret .= '</div>';

			return $ret;
		}	
	}

	// set anchor color
	add_action('wp_enqueue_scripts', 'attorna_set_anchor_color', 12);
	if( !function_exists('attorna_set_anchor_color') ){
		function attorna_set_anchor_color(){
			$post_option = attorna_get_post_option(get_the_ID());

			$anchor_css = '';
			if( !empty($post_option['bullet-anchor']) ){
				foreach( $post_option['bullet-anchor'] as $anchor ){
					if( !empty($anchor['title']) ){
						$anchor_section = str_replace('#', '', $anchor['title']);

						if( !empty($anchor['anchor-color']) ){
							$anchor_css .= '.attorna-bullet-anchor[data-anchor-section="' . esc_attr($anchor_section) . '"] a:before{ background-color: ' . esc_html($anchor['anchor-color']) . '; }';
						}
						if( !empty($anchor['anchor-hover-color']) ){
							$anchor_css .= '.attorna-bullet-anchor[data-anchor-section="' . esc_attr($anchor_section) . '"] a:hover, ';
							$anchor_css .= '.attorna-bullet-anchor[data-anchor-section="' . esc_attr($anchor_section) . '"] a.current-menu-item{ border-color: ' . esc_html($anchor['anchor-hover-color']) . '; }';
							$anchor_css .= '.attorna-bullet-anchor[data-anchor-section="' . esc_attr($anchor_section) . '"] a:hover:before, ';
							$anchor_css .= '.attorna-bullet-anchor[data-anchor-section="' . esc_attr($anchor_section) . '"] a.current-menu-item:before{ background: ' . esc_html($anchor['anchor-hover-color']) . '; }';
						}
					}
				}
			}

			if( !empty($anchor_css) ){
				wp_add_inline_style('attorna-style-core', $anchor_css);
			}
		}
	}

	// remove id from nav menu item
	add_filter('nav_menu_item_id', 'attorna_nav_menu_item_id', 10, 4);
	if( !function_exists('attorna_nav_menu_item_id') ){
		function attorna_nav_menu_item_id( $id, $item, $args, $depth ){
			return '';
		}
	}

	// add additional script
	add_action('wp_head', 'attorna_header_script', 99);
	if( !function_exists('attorna_header_script') ){
		function attorna_header_script(){
			$header_script = attorna_get_option('plugin', 'additional-head-script', '');
			if( !empty($header_script) ){
				echo '<script>' . $header_script . '</script>';
			}

			$header_script2 = attorna_get_option('plugin', 'additional-head-script2', '');
			if( !empty($header_script2) ){
				echo gdlr_core_text_filter($header_script2);
			}

		}
	}
	add_action('wp_footer', 'attorna_footer_script');
	if( !function_exists('attorna_footer_script') ){
		function attorna_footer_script(){
			$footer_script = attorna_get_option('plugin', 'additional-script', '');
			if( !empty($footer_script) ){
				echo '<script>' . $footer_script . '</script>';
			}

		}
	}

	remove_action('tgmpa_register', 'newsletter_register_required_plugins');