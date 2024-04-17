<?php
	/*	
	*	Goodlayers Option
	*	---------------------------------------------------------------------
	*	This file store an array of theme options
	*	---------------------------------------------------------------------
	*/	

	// add custom css for theme option
	add_filter('gdlr_core_theme_option_top_file_write', 'attorna_gdlr_core_theme_option_top_file_write', 10, 2);
	if( !function_exists('attorna_gdlr_core_theme_option_top_file_write') ){
		function attorna_gdlr_core_theme_option_top_file_write( $css, $option_slug ){
			if( $option_slug != 'goodlayers_main_menu' ) return;

			ob_start();
?>
.attorna-body h1, .attorna-body h2, .attorna-body h3, .attorna-body h4, .attorna-body h5, .attorna-body h6{ margin-top: 0px; margin-bottom: 20px; line-height: 1.2; font-weight: 700; }
#poststuff .gdlr-core-page-builder-body h2{ padding: 0px; margin-bottom: 20px; line-height: 1.2; font-weight: 700; }
#poststuff .gdlr-core-page-builder-body h1{ padding: 0px; font-weight: 700; }

.gdlr-core-testimonial-item .gdlr-core-testimonial-author-image{ width: 70px; }
.gdlr-core-testimonial-style-center .gdlr-core-testimonial-author-image{ margin-right: 25px; }
.gdlr-core-testimonial-style-center .gdlr-core-testimonial-quote{ font-size: 200px; line-height: 160px; height: 120px; }

ul.gdlr-core-custom-menu-widget.gdlr-core-menu-style-list li:before{ border-left-width: 3px; border-left-style: solid; 
	height: 1.75em; content: " "; display: inline-block; vertical-align: middle; 
	transition: border-color 300ms; -moz-transition: border-color 300ms; -o-transition: border-color 300ms; -webkit-transition: border-color 300ms; }
ul.gdlr-core-custom-menu-widget.gdlr-core-menu-style-list li a{ border-left: 0px; vertical-align: middle; }

.gdlr-core-accordion-style-icon .gdlr-core-accordion-item-tab,
.gdlr-core-toggle-box-style-icon .gdlr-core-toggle-box-item-tab{ border-bottom-width: 1px; border-bottom-style: solid; margin-bottom: 17px; }

.gdlr-core-blog-full .gdlr-core-excerpt-read-more.gdlr-core-plain-text{ border-bottom-width: 3px; border-bottom-style: solid; }

/* custom */
.single .wp-block-image .alignleft{ padding-right: 25px; }
.single figure.wp-block-embed-youtube{ margin-bottom: 25px; }
.wp-block-image figcaption{ margin-bottom: 0em; }
.gdlr-core-skill-bar-item.gdlr-core-size-small .gdlr-core-skill-bar-head{ font-size: 15px; }
.gdlr-core-skill-bar-item .gdlr-core-skill-bar-title{ text-transform: none; letter-spacing: 0; }
.gdlr-core-skill-bar-item .gdlr-core-skill-bar-right{ font-weight: 600; }
.gdlr-core-widget-box-shortcode .gdlr-core-widget-box-shortcode-title{ font-size: 19px; }
.gdlr-core-widget-box-shortcode{ font-size: 14px; }
ul.gdlr-core-custom-menu-widget.gdlr-core-menu-style-list{ font-size: 15px; }
ul.gdlr-core-custom-menu-widget.gdlr-core-menu-style-list li{ padding: 14px 0px; }
.gdlr-core-portfolio-medium .gdlr-core-portfolio-content-wrap .gdlr-core-portfolio-info{ font-size: 15px; }
.gdlr-core-input-wrap.gdlr-core-large input:not([type="button"]):not([type="submit"]):not([type="file"]){ font-size: 15px; padding: 19px 22px 21px; }
.gdlr-core-input-wrap.gdlr-core-large textarea{ height: 155px; }
.gdlr-core-input-wrap input[type="button"], 
.gdlr-core-input-wrap input[type="submit"], 
.gdlr-core-input-wrap input[type="reset"],
.gdlr-core-input-wrap select{ font-size: 14px; padding: 20px 33px; }
.gdlr-core-personnel-style-grid .gdlr-core-personnel-list-social{ margin-top: 13px; }
.gdlr-core-flexslider.gdlr-core-bottom-nav-1 .flex-nav-next a{ padding: 20px 27px 20px 20px; }
.gdlr-core-recent-post-widget-wrap.gdlr-core-style-1 .gdlr-core-recent-post-widget-title{ font-size: 15px; margin-bottom: 4px; margin-top: -5px; }
.gdlr-core-recent-post-widget-wrap.gdlr-core-style-1 .gdlr-core-recent-post-widget{ margin-bottom: 30px; }
.gdlr-core-testimonial-item.gdlr-core-testimonial-style-center .gdlr-core-testimonial-author-content{ padding-top: 0px; }
.gdlr-core-testimonial-item .gdlr-core-testimonial-title{ text-transform: none; letter-spacing: 0px; margin-bottom: 0px; }
.gdlr-core-testimonial-item .gdlr-core-testimonial-position{ font-style: normal; }
.gdlr-core-testimonial-item .gdlr-core-testimonial-author-image{ width: 62px; }
.gdlr-core-newsletter-item.gdlr-core-style-rectangle .gdlr-core-newsletter-email input[type="email"]{ padding: 16px 20px 20px; height: 63px; }
.gdlr-core-newsletter-item.gdlr-core-style-rectangle .gdlr-core-newsletter-submit input[type="submit"]{ font-size: 14px; letter-spacing: 2px; line-height: 20px; padding: 17px 0px 20px; height: 63px; }
.gdlr-core-newsletter-item.gdlr-core-style-rectangle .gdlr-core-newsletter-form{ max-width: 555px; }
.gdlr-core-social-share-item a{ margin: 0px 11px; }
.gdlr-core-blog-widget.gdlr-core-style-large .gdlr-core-blog-thumbnail{ max-width: 93px; }
.gdlr-core-blog-widget.gdlr-core-style-large{ margin-bottom: 26px; padding-top: 26px; }
.gdlr-core-product-grid-2{ margin-bottom: 40px; }

.gdlr-core-blog-grid .gdlr-core-blog-title{ margin-bottom: 13px; }
.gdlr-core-accordion-style-icon .gdlr-core-accordion-item-tab, 
.gdlr-core-toggle-box-style-icon .gdlr-core-toggle-box-item-tab{  margin-bottom: 19px; }
.gdlr-core-accordion-style-icon .gdlr-core-accordion-item-title{ margin-bottom: 24px; line-height: 24px; }
.gdlr-core-blog-info-wrapper .gdlr-core-head i{ font-size: 13px; }
.gdlr-core-blog-info-wrapper .gdlr-core-head{ margin-right: 10px; }
.gdlr-core-blog-info-wrapper .gdlr-core-blog-info{ font-size: 12px; font-weight: 600; letter-spacing: 2px; }

.gdlr-core-blog-full.gdlr-core-style-3 .gdlr-core-blog-info-wrapper .gdlr-core-blog-info{ font-size: 15px; }
.gdlr-core-blog-full .gdlr-core-excerpt-read-more{ margin-top: 28px; }
a.gdlr-core-excerpt-read-more.gdlr-core-button.gdlr-core-rectangle{ font-size: 12px; letter-spacing: 2px; padding: 13px 23px 14px; border-radius: 2px; -moz-border-radius: 2px; -webkit-border-radius: 2px; }
.gdlr-core-blog-full .gdlr-core-blog-thumbnail{ margin-bottom: 39px; }
.gdlr-core-style-blog-full-with-frame .gdlr-core-blog-thumbnail{ margin-bottom: 0px; }
.gdlr-core-input-wrap.gdlr-core-large input:not([type="button"]):not([type="submit"]):not([type="file"]), 
.gdlr-core-input-wrap.gdlr-core-large select{ font-size: 15px; padding: 20px 22px; border-radius: 0; }
.gdlr-core-testimonial-style-center .gdlr-core-testimonial-quote{ height: 95px; }
.gdlr-core-blog-grid .gdlr-core-blog-title{ margin-bottom: 20px; }
.gdlr-core-blog-grid .gdlr-core-blog-thumbnail{ margin-bottom: 30px; }
.gdlr-core-blog-grid-with-frame .gdlr-core-blog-thumbnail{ margin-bottom: 0px; }
.comment-form-cookies-consent label { font-size: 14px; margin-left: 8px; }
.gdlr-core-social-share-item .gdlr-core-social-share-count .gdlr-core-suffix{ letter-spacing: 3px; }
.gdlr-core-recent-post-widget-wrap.gdlr-core-style-1 .gdlr-core-blog-info i{ font-size: 13px; }
.gdlr-core-recent-post-widget-wrap.gdlr-core-style-1 .gdlr-core-blog-info{ font-size: 12px; font-weight: 500; letter-spacing: 1px; }
.gdlr-core-pagination.gdlr-core-style-circle a, .gdlr-core-pagination.gdlr-core-style-circle span{ margin-right: 2px; }
.gdlr-core-portfolio-thumbnail.gdlr-core-style-title-tag .gdlr-core-portfolio-info{ margin-top: 10px; }
.attorna-single-related-post-wrap .gdlr-core-blog-grid .gdlr-core-blog-thumbnail { margin-bottom: 22px; }
.attorna-single-related-post-wrap .gdlr-core-blog-grid .gdlr-core-blog-title { margin-bottom: 10px; }
.attorna-single-related-post-wrap .gdlr-core-blog-grid .gdlr-core-blog-title { font-weight: 700; }
<?php
			$css .= ob_get_contents();
			ob_end_clean(); 

			return $css;
		}
	}
	add_filter('gdlr_core_theme_option_bottom_file_write', 'attorna_gdlr_core_theme_option_bottom_file_write', 10, 2);
	if( !function_exists('attorna_gdlr_core_theme_option_bottom_file_write') ){
		function attorna_gdlr_core_theme_option_bottom_file_write( $css, $option_slug ){
			if( $option_slug != 'goodlayers_main_menu' ) return;

			$general = get_option('attorna_general');

			if( !empty($general['item-padding']) ){
				$margin = 2 * intval(str_replace('px', '', $general['item-padding']));
				if( !empty($margin) && is_numeric($margin) ){
					$css .= '.attorna-item-mgb, .gdlr-core-item-mgb{ margin-bottom: ' . $margin . 'px; }';
				}
			}

			if( !empty($general['mobile-logo-position']) && $general['mobile-logo-position'] == 'logo-right' ){
				$css .= '.attorna-mobile-header .attorna-logo-inner{ margin-right: 0px; margin-left: 80px; float: right; }';	
				$css .= '.attorna-mobile-header .attorna-mobile-menu-right{ left: 30px; right: auto; }';	
				$css .= '.attorna-mobile-header .attorna-main-menu-search{ float: right; margin-left: 0px; margin-right: 25px; }';	
				$css .= '.attorna-mobile-header .attorna-mobile-menu{ float: right; margin-left: 0px; margin-right: 30px; }';	
				$css .= '.attorna-mobile-header .attorna-main-menu-cart{ float: right; margin-left: 0px; margin-right: 20px; padding-left: 0px; padding-right: 5px; }';	
				$css .= '.attorna-mobile-header .attorna-top-cart-content-wrap{ left: 0px; }';
			}

			return $css;
		}
	}

	$attorna_admin_option->add_element(array(
	
		// general head section
		'title' => esc_html__('General', 'attorna'),
		'slug' => 'attorna_general',
		'icon' => get_template_directory_uri() . '/include/options/images/general.png',
		'options' => array(
		
			'layout' => array(
				'title' => esc_html__('Layout', 'attorna'),
				'options' => array(
					
					'custom-header' => array(
						'title' => esc_html__('Select Custom Header As Default Header', 'attorna'),
						'type' => 'combobox',
						'single' => 'gdlr_core_custom_header_id',
						'options' => array('' => esc_html__('None', 'attorna')) + gdlr_core_get_post_list('gdlr_core_header'),
						'description' => esc_html__('Any settings you set at the theme option will be ignored', 'attorna')
					),
					'layout' => array(
						'title' => esc_html__('Layout', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'full' => esc_html__('Full', 'attorna'),
							'boxed' => esc_html__('Boxed', 'attorna'),
						)
					),
					'boxed-layout-top-margin' => array(
						'title' => esc_html__('Box Layout Top/Bottom Margin', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '150',
						'data-type' => 'pixel',
						'default' => '0px',
						'selector' => 'body.attorna-boxed .attorna-body-wrapper{ margin-top: #gdlr#; margin-bottom: #gdlr#; }',
						'condition' => array( 'layout' => 'boxed' ) 
					),
					'body-margin' => array(
						'title' => esc_html__('Body Margin ( Frame Spaces )', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '0px',
						'selector' => '.attorna-body-wrapper.attorna-with-frame, body.attorna-full .attorna-fixed-footer{ margin: #gdlr#; }',
						'condition' => array( 'layout' => 'full' ),
						'description' => esc_html__('This value will be automatically omitted for side header style.', 'attorna'),
					),
					'background-type' => array(
						'title' => esc_html__('Background Type', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'color' => esc_html__('Color', 'attorna'),
							'image' => esc_html__('Image', 'attorna'),
							'pattern' => esc_html__('Pattern', 'attorna'),
						),
						'condition' => array( 'layout' => 'boxed' )
					),
					'background-image' => array(
						'title' => esc_html__('Background Image', 'attorna'),
						'type' => 'upload',
						'data-type' => 'file', 
						'selector' => '.attorna-body-background{ background-image: url(#gdlr#); }',
						'condition' => array( 'layout' => 'boxed', 'background-type' => 'image' )
					),
					'background-image-opacity' => array(
						'title' => esc_html__('Background Image Opacity', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '100',
						'condition' => array( 'layout' => 'boxed', 'background-type' => 'image' ),
						'selector' => '.attorna-body-background{ opacity: #gdlr#; }'
					),
					'background-pattern' => array(
						'title' => esc_html__('Background Type', 'attorna'),
						'type' => 'radioimage',
						'data-type' => 'text',
						'options' => 'pattern', 
						'selector' => '.attorna-background-pattern .attorna-body-outer-wrapper{ background-image: url(' . GDLR_CORE_URL . '/include/images/pattern/#gdlr#.png); }',
						'condition' => array( 'layout' => 'boxed', 'background-type' => 'pattern' ),
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'enable-boxed-border' => array(
						'title' => esc_html__('Enable Boxed Border', 'attorna'),
						'type' => 'checkbox',
						'default' => 'disable',
						'condition' => array( 'layout' => 'boxed', 'background-type' => 'pattern' ),
					),
					'item-padding' => array(
						'title' => esc_html__('Item Left/Right Spaces', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '40',
						'data-type' => 'pixel',
						'default' => '15px',
						'description' => 'Space between each page items',
						'selector' => '.attorna-item-pdlr, .gdlr-core-item-pdlr{ padding-left: #gdlr#; padding-right: #gdlr#; }' . 
							'.attorna-item-rvpdlr, .gdlr-core-item-rvpdlr{ margin-left: -#gdlr#; margin-right: -#gdlr#; }' .
							'.gdlr-core-metro-rvpdlr{ margin-top: -#gdlr#; margin-right: -#gdlr#; margin-bottom: -#gdlr#; margin-left: -#gdlr#; }' .
							'.attorna-item-mglr, .gdlr-core-item-mglr, .attorna-navigation .sf-menu > .attorna-mega-menu .sf-mega,' . 
							'.sf-menu.attorna-top-bar-menu > .attorna-mega-menu .sf-mega{ margin-left: #gdlr#; margin-right: #gdlr#; }' .
							'.attorna-body .gdlr-core-portfolio-item .gdlr-core-flexslider.gdlr-core-with-outer-frame-element .flex-viewport, ' . 
							'.attorna-body .gdlr-core-personnel-item .gdlr-core-flexslider.gdlr-core-with-outer-frame-element .flex-viewport, ' . 
							'.attorna-body .gdlr-core-hover-box-item .gdlr-core-flexslider.gdlr-core-with-outer-frame-element .flex-viewport,' . 
							'.attorna-body .gdlr-core-blog-item .gdlr-core-flexslider.gdlr-core-with-outer-frame-element .flex-viewport{ padding-top: 40px; margin-top: -40px; padding-right: 40px; margin-right: -40px; padding-left: 40px; margin-left: -40px; padding-bottom: 40px; margin-bottom: -40px; }' . 
							'.gdlr-core-pbf-wrapper-container-inner{ width: calc(100% - #gdlr# - #gdlr#); }'
					
					),
					'container-width' => array(
						'title' => esc_html__('Container Width', 'attorna'),
						'type' => 'text',
						'data-type' => 'pixel',
						'data-input-type' => 'pixel',
						'default' => '1180px',
						'selector' => '.attorna-container, .gdlr-core-container, body.attorna-boxed .attorna-body-wrapper, ' . 
							'body.attorna-boxed .attorna-fixed-footer .attorna-footer-wrapper, body.attorna-boxed .attorna-fixed-footer .attorna-copyright-wrapper{ max-width: #gdlr#; }' 
					),
					'container-padding' => array(
						'title' => esc_html__('Container Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '100',
						'data-type' => 'pixel',
						'default' => '15px',
						'selector' => '.attorna-body-front .gdlr-core-container, .attorna-body-front .attorna-container{ padding-left: #gdlr#; padding-right: #gdlr#; }'  . 
							'.attorna-body-front .attorna-container .attorna-container, .attorna-body-front .attorna-container .gdlr-core-container, '.
							'.attorna-body-front .gdlr-core-container .gdlr-core-container{ padding-left: 0px; padding-right: 0px; }' .
							'.attorna-navigation-header-style-bar.attorna-style-2 .attorna-navigation-background{ left: #gdlr#; right: #gdlr#; }'
					),
					'sidebar-title-divider' => array(
						'title' => esc_html__('Sidebar Title Divider', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
					),
					'sidebar-width' => array(
						'title' => esc_html__('Sidebar Width', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'30' => '50%', '20' => '33.33%', '15' => '25%', '12' => '20%', '10' => '16.67%'
						),
						'default' => 20,
					),
					'both-sidebar-width' => array(
						'title' => esc_html__('Both Sidebar Width', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'30' => '50%', '20' => '33.33%', '15' => '25%', '12' => '20%', '10' => '16.67%'
						),
						'default' => 15,
					),
					
				) // header-options
			), // header-nav	
			
			'top-bar' => attorna_top_bar_options(), // top bar

			'top-bar-social' => attorna_top_bar_social_options(),			

			'header' => attorna_header_options(), // header
			
			'logo' => attorna_logo_options(),

			'navigation' => attorna_navigation_options(), // logo-navigation			
			
			'fixed-navigation' => attorna_fixed_navigation_options(),

			'title-style' => array(
				'title' => esc_html__('Page Title Style', 'attorna'),
				'options' => array(

					'default-title-style' => array(
						'title' => esc_html__('Default Page Title Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'small' => esc_html__('Small', 'attorna'),
							'medium' => esc_html__('Medium', 'attorna'),
							'large' => esc_html__('Large', 'attorna'),
							'custom' => esc_html__('Custom', 'attorna'),
						),
						'default' => 'small'
					),
					'default-title-align' => array(
						'title' => esc_html__('Default Page Title Alignment', 'attorna'),
						'type' => 'radioimage',
						'options' => 'text-align',
						'default' => 'left'
					),
					'default-title-top-padding' => array(
						'title' => esc_html__('Default Page Title Top Padding', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '350',
						'default' => '93px',
						'selector' => '.attorna-page-title-wrap.attorna-style-custom .attorna-page-title-content{ padding-top: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-title-bottom-padding' => array(
						'title' => esc_html__('Default Page Title Bottom Padding', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '350',
						'default' => '87px',
						'selector' => '.attorna-page-title-wrap.attorna-style-custom .attorna-page-title-content{ padding-bottom: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-page-caption-top-margin' => array(
						'title' => esc_html__('Default Page Caption Top Margin', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '200',
						'default' => '13px',						
						'selector' => '.attorna-page-title-wrap.attorna-style-custom .attorna-page-caption{ margin-top: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-title-font-transform' => array(
						'title' => esc_html__('Default Page Title Font Transform', 'attorna'),
						'type' => 'combobox',
						'data-type' => 'text',
						'options' => array(
							'' => esc_html__('Default', 'attorna'),
							'none' => esc_html__('None', 'attorna'),
							'uppercase' => esc_html__('Uppercase', 'attorna'),
							'lowercase' => esc_html__('Lowercase', 'attorna'),
							'capitalize' => esc_html__('Capitalize', 'attorna'),
						),
						'default' => 'default',
						'selector' => '.attorna-page-title-wrap .attorna-page-title{ text-transform: #gdlr#; }'
					),
					'default-title-font-size' => array(
						'title' => esc_html__('Default Page Title Font Size', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '37px',
						'selector' => '.attorna-page-title-wrap.attorna-style-custom .attorna-page-title{ font-size: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-title-font-weight' => array(
						'title' => esc_html__('Default Page Title Font Weight', 'attorna'),
						'type' => 'text',
						'data-type' => 'text',
						'selector' => '.attorna-page-title-wrap .attorna-page-title{ font-weight: #gdlr#; }',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800. Leave this field blank for default value (700).', 'attorna')					
					),
					'default-title-letter-spacing' => array(
						'title' => esc_html__('Default Page Title Letter Spacing', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '20',
						'default' => '0px',
						'selector' => '.attorna-page-title-wrap.attorna-style-custom .attorna-page-title{ letter-spacing: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-caption-font-transform' => array(
						'title' => esc_html__('Default Page Caption Font Transform', 'attorna'),
						'type' => 'combobox',
						'data-type' => 'text',
						'options' => array(
							'' => esc_html__('Default', 'attorna'),
							'none' => esc_html__('None', 'attorna'),
							'uppercase' => esc_html__('Uppercase', 'attorna'),
							'lowercase' => esc_html__('Lowercase', 'attorna'),
							'capitalize' => esc_html__('Capitalize', 'attorna'),
						),
						'default' => 'default',
						'selector' => '.attorna-page-title-wrap .attorna-page-caption{ text-transform: #gdlr#; }'
					),
					'default-caption-font-size' => array(
						'title' => esc_html__('Default Page Caption Font Size', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '16px',
						'selector' => '.attorna-page-title-wrap.attorna-style-custom .attorna-page-caption{ font-size: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'default-caption-font-weight' => array(
						'title' => esc_html__('Default Page Caption Font Weight', 'attorna'),
						'type' => 'text',
						'data-type' => 'text',
						'selector' => '.attorna-page-title-wrap .attorna-page-caption{ font-weight: #gdlr#; }',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800. Leave this field blank for default value (400).', 'attorna')					
					),
					'default-caption-letter-spacing' => array(
						'title' => esc_html__('Default Page Caption Letter Spacing', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '20',
						'default' => '0px',
						'selector' => '.attorna-page-title-wrap.attorna-style-custom .attorna-page-caption{ letter-spacing: #gdlr#; }',
						'condition' => array( 'default-title-style' => 'custom' )
					),
					'page-title-top-bottom-gradient' => array(
						'title' => esc_html__('Default Page Title Top/Bottom Gradient', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'both' => esc_html__('Both', 'attorna'),
							'top' => esc_html__('Top', 'attorna'),
							'bottom' => esc_html__('Bottom', 'attorna'),
							'none' => esc_html__('None', 'attorna'),
						),
						'default' => 'none',
					),
					'page-title-top-gradient-size' => array(
						'title' => esc_html__('Default Page Title Top Gradient Size', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '1000',
 						'default' => '413px',
						'selector' => '.attorna-page-title-wrap .attorna-page-title-top-gradient{ height: #gdlr#; }',
					),
					'page-title-bottom-gradient-size' => array(
						'title' => esc_html__('Default Page Title Bottom Gradient Size', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '1000',
 						'default' => '413px',
						'selector' => '.attorna-page-title-wrap .attorna-page-title-bottom-gradient{ height: #gdlr#; }',
					),
					'default-title-background-overlay-opacity' => array(
						'title' => esc_html__('Default Page Title Background Overlay Opacity', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '80',
						'selector' => '.attorna-page-title-wrap .attorna-page-title-overlay{ opacity: #gdlr#; }'
					),
				) 
			), // title style

			'title-background' => array(
				'title' => esc_html__('Page Title Background', 'attorna'),
				'options' => array(

					'default-title-background' => array(
						'title' => esc_html__('Default Page Title Background', 'attorna'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => '.attorna-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-portfolio-title-background' => array(
						'title' => esc_html__('Default Portfolio Title Background', 'attorna'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.single-portfolio .attorna-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-personnel-title-background' => array(
						'title' => esc_html__('Default Personnel Title Background', 'attorna'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.single-personnel .attorna-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-search-title-background' => array(
						'title' => esc_html__('Default Search Title Background', 'attorna'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.search .attorna-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-archive-title-background' => array(
						'title' => esc_html__('Default Archive Title Background', 'attorna'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => 'body.archive .attorna-page-title-wrap{ background-image: url(#gdlr#); }'
					),
					'default-404-background' => array(
						'title' => esc_html__('Default 404 Background', 'attorna'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => '.attorna-not-found-wrap .attorna-not-found-background{ background-image: url(#gdlr#); }'
					),
					'default-404-background-opacity' => array(
						'title' => esc_html__('Default 404 Background Opacity', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '27',
						'selector' => '.attorna-not-found-wrap .attorna-not-found-background{ opacity: #gdlr#; }'
					),

				) 
			), // title background

			'blog-title-style' => array(
				'title' => esc_html__('Blog Title Style', 'attorna'),
				'options' => array(

					'default-blog-title-style' => array(
						'title' => esc_html__('Default Blog Title Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'small' => esc_html__('Small', 'attorna'),
							'large' => esc_html__('Large', 'attorna'),
							'custom' => esc_html__('Custom', 'attorna'),
							'inside-content' => esc_html__('Inside Content', 'attorna'),
							'none' => esc_html__('None', 'attorna'),
						),
						'default' => 'small'
					),
					'default-blog-title-top-padding' => array(
						'title' => esc_html__('Default Blog Title Top Padding', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '400',
						'default' => '93px',
						'selector' => '.attorna-blog-title-wrap.attorna-style-custom .attorna-blog-title-content{ padding-top: #gdlr#; }',
						'condition' => array( 'default-blog-title-style' => 'custom' )
					),
					'default-blog-title-bottom-padding' => array(
						'title' => esc_html__('Default Blog Title Bottom Padding', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '400',
						'default' => '87px',
						'selector' => '.attorna-blog-title-wrap.attorna-style-custom .attorna-blog-title-content{ padding-bottom: #gdlr#; }',
						'condition' => array( 'default-blog-title-style' => 'custom' )
					),
					'default-blog-feature-image' => array(
						'title' => esc_html__('Default Blog Feature Image Location', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'content' => esc_html__('Inside Content', 'attorna'),
							'title-background' => esc_html__('Title Background', 'attorna'),
							'none' => esc_html__('None', 'attorna'),
						),
						'default' => 'content',
						'condition' => array( 'default-blog-title-style' => array('small', 'large', 'custom') )
					),
					'default-blog-title-background-image' => array(
						'title' => esc_html__('Default Blog Title Background Image', 'attorna'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => '.attorna-blog-title-wrap{ background-image: url(#gdlr#); }',
						'condition' => array( 'default-blog-title-style' => array('small', 'large', 'custom') )
					),
					'default-blog-top-bottom-gradient' => array(
						'title' => esc_html__('Default Blog ( Feature Image ) Title Top/Bottom Gradient', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'enable' => esc_html__('Both', 'attorna'),
							'top' => esc_html__('Top', 'attorna'),
							'bottom' => esc_html__('Bottom', 'attorna'),
							'disable' => esc_html__('None', 'attorna'),
						),
						'default' => 'enable',
					),
					'single-blog-title-top-gradient-size' => array(
						'title' => esc_html__('Single Blog Title Top Gradient Size', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '1000',
 						'default' => '413px',
						'selector' => '.attorna-blog-title-wrap.attorna-feature-image .attorna-blog-title-top-overlay{ height: #gdlr#; }',
					),
					'single-blog-title-bottom-gradient-size' => array(
						'title' => esc_html__('Single Blog Title Bottom Gradient Size', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'data-min' => '0',
						'data-max' => '1000',
 						'default' => '413px',
						'selector' => '.attorna-blog-title-wrap.attorna-feature-image .attorna-blog-title-bottom-overlay{ height: #gdlr#; }',
					),
					'default-blog-title-background-overlay-opacity' => array(
						'title' => esc_html__('Default Blog Title Background Overlay Opacity', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'opacity',
						'default' => '80',
						'selector' => '.attorna-blog-title-wrap .attorna-blog-title-overlay{ opacity: #gdlr#; }',
						'condition' => array( 'default-blog-title-style' => array('small', 'large', 'custom') )
					),

				) 
			), // post title style			

			'blog-style' => array(
				'title' => esc_html__('Blog Style', 'attorna'),
				'options' => array(
					'blog-style' => array(
						'title' => esc_html__('Single Blog Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'attorna'),
							'style-2' => esc_html__('Style 2', 'attorna'),
							'style-3' => esc_html__('Style 3', 'attorna'),
							'style-4' => esc_html__('Style 4', 'attorna'),
							'magazine' => esc_html__('Magazine', 'attorna')
						),
						'default' => 'style-1'
					),
					'blockquote-style' => array(
						'title' => esc_html__('Blockquote Style ( <blockquote> tag )', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'attorna'),
							'style-2' => esc_html__('Style 2', 'attorna')
						),
						'default' => 'style-1'
					),
					'blog-sidebar' => array(
						'title' => esc_html__('Single Blog Sidebar ( Default )', 'attorna'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'none',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'blog-sidebar-left' => array(
						'title' => esc_html__('Single Blog Sidebar Left ( Default )', 'attorna'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'blog-sidebar'=>array('left', 'both') )
					),
					'blog-sidebar-right' => array(
						'title' => esc_html__('Single Blog Sidebar Right ( Default )', 'attorna'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'blog-sidebar'=>array('right', 'both') )
					),
					'blog-max-content-width' => array(
						'title' => esc_html__('Single Blog Max Content Width ( No sidebar layout )', 'attorna'),
						'type' => 'text',
						'data-type' => 'text',
						'data-input-type' => 'pixel',
						'default' => '900px',
						'selector' => 'body.single-post .attorna-sidebar-style-none, body.blog .attorna-sidebar-style-none, ' . 
							'.attorna-blog-style-2 .attorna-comment-content{ max-width: #gdlr#; }'
					),
					'blog-thumbnail-size' => array(
						'title' => esc_html__('Single Blog Thumbnail Size', 'attorna'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'default' => 'full'
					),
					'blog-date-feature' => array(
						'title' => esc_html__('Enable Blog Date Feature', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'blog-style' => 'style-1' )
					),
					'blog-date-feature-year' => array(
						'title' => esc_html__('Enable Year on Blog Date Feature', 'attorna'),
						'type' => 'checkbox',
						'default' => 'disable',
						'condition' => array( 'blog-style' => 'style-1', 'blog-date-feature' => 'enable' )
					),
					'meta-option' => array(
						'title' => esc_html__('Meta Option', 'attorna'),
						'type' => 'multi-combobox',
						'options' => array( 
							'date' => esc_html__('Date', 'attorna'),
							'author' => esc_html__('Author', 'attorna'),
							'category' => esc_html__('Category', 'attorna'),
							'tag' => esc_html__('Tag', 'attorna'),
							'comment' => esc_html__('Comment', 'attorna'),
							'comment-number' => esc_html__('Comment Number', 'attorna'),
						),
						'default' => array('author', 'category', 'tag', 'comment-number')
					),
					'blog-author' => array(
						'title' => esc_html__('Enable Single Blog Author', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'blog-navigation' => array(
						'title' => esc_html__('Enable Single Blog Navigation', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'pagination-style' => array(
						'title' => esc_html__('Pagination Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'plain' => esc_html__('Plain', 'attorna'),
							'rectangle' => esc_html__('Rectangle', 'attorna'),
							'rectangle-border' => esc_html__('Rectangle Border', 'attorna'),
							'round' => esc_html__('Round', 'attorna'),
							'round-border' => esc_html__('Round Border', 'attorna'),
							'circle' => esc_html__('Circle', 'attorna'),
							'circle-border' => esc_html__('Circle Border', 'attorna'),
						),
						'default' => 'round'
					),
					'pagination-align' => array(
						'title' => esc_html__('Pagination Alignment', 'attorna'),
						'type' => 'radioimage',
						'options' => 'text-align',
						'default' => 'right'
					),
					'enable-related-post' => array(
						'title' => esc_html__('Enable Related Post', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array('blog-style' => array('style-2', 'style-3', 'style-4', 'magazine'))
					),
					'related-post-blog-style' => array(
						'title' => esc_html__('Related Post Blog Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'blog-column' => esc_html__('Blog Column', 'attorna'), 
							'blog-column-with-frame' => esc_html__('Blog Column With Frame', 'attorna'), 
						),
						'default' => 'blog-column-with-frame',
						'condition' => array('blog-style' => array('style-2', 'style-3', 'style-4', 'magazine'), 'enable-related-post'=>'enable')
					),
					'related-post-blog-column-style' => array(
						'title' => esc_html__('Related Post Blog Column Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'attorna'), 
							'style-2' => esc_html__('Style 2', 'attorna'), 
							'style-3' => esc_html__('Style 3', 'attorna'), 
						),
						'default' => 'blog-column-with-frame',
						'condition' => array('blog-style' => array('style-2', 'style-3', 'style-4', 'magazine'), 'enable-related-post'=>'enable')
					),
					'related-post-column-size' => array(
						'title' => esc_html__('Related Post Column Size', 'attorna'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5 ),
						'default' => '20',
						'condition' => array('blog-style' => array('style-2', 'style-3', 'style-4', 'magazine'), 'enable-related-post'=>'enable')
					),
					'related-post-meta-option' => array(
						'title' => esc_html__('Related Post Meta Option', 'attorna'),
						'type' => 'multi-combobox',
						'options' => array(
							'date' => esc_html__('Date', 'attorna'),
							'author' => esc_html__('Author', 'attorna'),
							'category' => esc_html__('Category', 'attorna'),
							'tag' => esc_html__('Tag', 'attorna'),
							'comment' => esc_html__('Comment', 'attorna'),
							'comment-number' => esc_html__('Comment Number', 'attorna'),
						),
						'default' => array('date', 'author', 'category', 'comment-number'),
						'condition' => array('blog-style' => array('style-2', 'style-3', 'style-4', 'magazine'), 'enable-related-post'=>'enable')
					),
					'related-post-thumbnail-size' => array(
						'title' => esc_html__('Related Post Blog Thumbnail Size', 'attorna'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'default' => 'full',
						'condition' => array('blog-style' => array('style-2', 'style-3', 'style-4', 'magazine'), 'enable-related-post'=>'enable')
					),
					'related-post-num-fetch' => array(
						'title' => esc_html__('Related Post Num Fetch', 'attorna'),
						'type' => 'text',
						'default' => '3',
						'condition' => array('blog-style' => array('style-2', 'style-3', 'style-4', 'magazine'), 'enable-related-post'=>'enable')
					),
					'related-post-excerpt-number' => array(
						'title' => esc_html__('Related Post Excerpt Number', 'attorna'),
						'type' => 'text',
						'default' => '0',
						'condition' => array('blog-style' => array('style-2', 'style-3', 'style-4', 'magazine'), 'enable-related-post'=>'enable')
					),
				) // blog-style-options
			), // blog-style-nav

			'blog-social-share' => array(
				'title' => esc_html__('Blog Social Share', 'attorna'),
				'options' => array(
					'blog-social-share' => array(
						'title' => esc_html__('Enable Single Blog Share', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'blog-social-share-count' => array(
						'title' => esc_html__('Enable Single Blog Share Count', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'blog-social-facebook' => array(
						'title' => esc_html__('Facebook', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),			
					'blog-social-linkedin' => array(
						'title' => esc_html__('Linkedin', 'attorna'),
						'type' => 'checkbox',
						'default' => 'disable'
					),			
					'blog-social-google-plus' => array(
						'title' => esc_html__('Google Plus', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),			
					'blog-social-pinterest' => array(
						'title' => esc_html__('Pinterest', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),			
					'blog-social-stumbleupon' => array(
						'title' => esc_html__('Stumbleupon', 'attorna'),
						'type' => 'checkbox',
						'default' => 'disable'
					),			
					'blog-social-twitter' => array(
						'title' => esc_html__('Twitter', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),			
					'blog-social-email' => array(
						'title' => esc_html__('Email', 'attorna'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
				) // blog-style-options
			), // blog-style-nav
			
			'search-archive' => array(
				'title' => esc_html__('Search/Archive', 'attorna'),
				'options' => array(
					'archive-blog-sidebar' => array(
						'title' => esc_html__('Archive Blog Sidebar', 'attorna'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'right',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'archive-blog-sidebar-left' => array(
						'title' => esc_html__('Archive Blog Sidebar Left', 'attorna'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'archive-blog-sidebar'=>array('left', 'both') )
					),
					'archive-blog-sidebar-right' => array(
						'title' => esc_html__('Archive Blog Sidebar Right', 'attorna'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'archive-blog-sidebar'=>array('right', 'both') )
					),
					'archive-blog-style' => array(
						'title' => esc_html__('Archive Blog Style', 'attorna'),
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
						'title' => esc_html__('Blog Full Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'attorna'),
							'style-2' => esc_html__('Style 2', 'attorna'),
						),
						'condition' => array( 'archive-blog-style'=>array('blog-full', 'blog-full-with-frame') )
					),
					'archive-blog-side-thumbnail-style' => array(
						'title' => esc_html__('Blog Side Thumbnail Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'attorna'),
							'style-1-large' => esc_html__('Style 1 Large Thumbnail', 'attorna'),
							'style-2' => esc_html__('Style 2', 'attorna'),
							'style-2-large' => esc_html__('Style 2 Large Thumbnail', 'attorna'),
						),
						'condition' => array( 'archive-blog-style'=>array('blog-left-thumbnail', 'blog-right-thumbnail') )
					),
					'archive-blog-column-style' => array(
						'title' => esc_html__('Blog Column Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'attorna'),
							'style-2' => esc_html__('Style 2', 'attorna'),
						),
						'condition' => array( 'archive-blog-style'=>array('blog-column', 'blog-column-with-frame', 'blog-column-no-space') )
					),
					'archive-blog-image-style' => array(
						'title' => esc_html__('Blog Image Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'style-1' => esc_html__('Style 1', 'attorna'),
							'style-2' => esc_html__('Style 2', 'attorna'),
						),
						'condition' => array( 'archive-blog-style'=>array('blog-image', 'blog-image-no-space') )
					),
					'archive-blog-full-alignment' => array(
						'title' => esc_html__('Archive Blog Full Alignment', 'attorna'),
						'type' => 'combobox',
						'default' => 'enable',
						'options' => array(
							'left' => esc_html__('Left', 'attorna'),
							'center' => esc_html__('Center', 'attorna'),
						),
						'condition' => array( 'archive-blog-style' => array('blog-full', 'blog-full-with-frame') )
					),
					'archive-thumbnail-size' => array(
						'title' => esc_html__('Archive Thumbnail Size', 'attorna'),
						'type' => 'combobox',
						'options' => 'thumbnail-size'
					),
					'archive-show-thumbnail' => array(
						'title' => esc_html__('Archive Show Thumbnail', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-column', 'blog-column-with-frame', 'blog-column-no-space', 'blog-left-thumbnail', 'blog-right-thumbnail') )
					),
					'archive-column-size' => array(
						'title' => esc_html__('Archive Column Size', 'attorna'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5 ),
						'default' => 20,
						'condition' => array( 'archive-blog-style' => array('blog-column', 'blog-column-with-frame', 'blog-column-no-space', 'blog-image', 'blog-image-no-space') )
					),
					'archive-excerpt' => array(
						'title' => esc_html__('Archive Excerpt Type', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'specify-number' => esc_html__('Specify Number', 'attorna'),
							'show-all' => esc_html__('Show All ( use <!--more--> tag to cut the content )', 'attorna'),
						),
						'default' => 'specify-number',
						'condition' => array('archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-column', 'blog-column-with-frame', 'blog-column-no-space', 'blog-left-thumbnail', 'blog-right-thumbnail'))
					),
					'archive-excerpt-number' => array(
						'title' => esc_html__('Archive Excerpt Number', 'attorna'),
						'type' => 'text',
						'default' => 55,
						'data-input-type' => 'number',
						'condition' => array('archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-column', 'blog-column-with-frame', 'blog-column-no-space', 'blog-left-thumbnail', 'blog-right-thumbnail'), 'archive-excerpt' => 'specify-number')
					),
					'archive-date-feature' => array(
						'title' => esc_html__('Enable Blog Date Feature', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-left-thumbnail', 'blog-right-thumbnail') )
					),
					'archive-meta-option' => array(
						'title' => esc_html__('Archive Meta Option', 'attorna'),
						'type' => 'multi-combobox',
						'options' => array( 
							'date' => esc_html__('Date', 'attorna'),
							'author' => esc_html__('Author', 'attorna'),
							'category' => esc_html__('Category', 'attorna'),
							'tag' => esc_html__('Tag', 'attorna'),
							'comment' => esc_html__('Comment', 'attorna'),
							'comment-number' => esc_html__('Comment Number', 'attorna'),
						),
						'default' => array('date', 'author', 'category')
					),
					'archive-show-read-more' => array(
						'title' => esc_html__('Archive Show Read More Button', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array('archive-blog-style' => array('blog-full', 'blog-full-with-frame', 'blog-left-thumbnail', 'blog-right-thumbnail'),)
					),
					'archive-blog-title-font-size' => array(
						'title' => esc_html__('Blog Title Font Size', 'attorna'),
						'type' => 'text',
						'data-input-type' => 'pixel',
					),
					'archive-blog-title-font-weight' => array(
						'title' => esc_html__('Blog Title Font Weight', 'attorna'),
						'type' => 'text',
						'description' => esc_html__('Eg. lighter, bold, normal, 300, 400, 600, 700, 800', 'attorna')
					),
					'archive-blog-title-letter-spacing' => array(
						'title' => esc_html__('Blog Title Letter Spacing', 'attorna'),
						'type' => 'text',
						'data-input-type' => 'pixel',
					),
					'archive-blog-title-text-transform' => array(
						'title' => esc_html__('Blog Title Text Transform', 'attorna'),
						'type' => 'combobox',
						'data-type' => 'text',
						'options' => array(
							'none' => esc_html__('None', 'attorna'),
							'uppercase' => esc_html__('Uppercase', 'attorna'),
							'lowercase' => esc_html__('Lowercase', 'attorna'),
							'capitalize' => esc_html__('Capitalize', 'attorna'),
						),
						'default' => 'none'
					),
				)
			),

			'woocommerce-style' => array(
				'title' => esc_html__('Woocommerce Style', 'attorna'),
				'options' => array(

					'woocommerce-archive-sidebar' => array(
						'title' => esc_html__('Woocommerce Archive Sidebar', 'attorna'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'right',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'woocommerce-archive-sidebar-left' => array(
						'title' => esc_html__('Woocommerce Archive Sidebar Left', 'attorna'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'woocommerce-archive-sidebar'=>array('left', 'both') )
					),
					'woocommerce-archive-sidebar-right' => array(
						'title' => esc_html__('Woocommerce Archive Sidebar Right', 'attorna'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'woocommerce-archive-sidebar'=>array('right', 'both') )
					),
					'woocommerce-archive-product-style' => array(
						'title' => esc_html__('Woocommerce Archive Product Style', 'attorna'),
						'type' => 'combobox',
						'options' => array( 
							'grid' => esc_html__('Grid', 'attorna'),
							'grid-2' => esc_html__('Grid 2', 'attorna'),
						),
						'default' => 'grid'
					),
					'woocommerce-archive-column-size' => array(
						'title' => esc_html__('Woocommerce Archive Column Size', 'attorna'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5, 10 => 6, ),
						'default' => 15
					),
					'woocommerce-archive-thumbnail' => array(
						'title' => esc_html__('Woocommerce Archive Thumbnail Size', 'attorna'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'default' => 'full'
					),
					'woocommerce-related-product-column-size' => array(
						'title' => esc_html__('Woocommerce Related Product Column Size', 'attorna'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5, 10 => 6, ),
						'default' => 15
					),
					'woocommerce-related-product-num-fetch' => array(
						'title' => esc_html__('Woocommerce Related Product Num Fetch', 'attorna'),
						'type' => 'text',
						'default' => 4,
						'data-input-type' => 'number'
					),
					'woocommerce-related-product-thumbnail' => array(
						'title' => esc_html__('Woocommerce Related Product Thumbnail Size', 'attorna'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'default' => 'full'
					),
				)
			),

			'portfolio-style' => array(
				'title' => esc_html__('Portfolio Style', 'attorna'),
				'options' => array(
					'portfolio-slug' => array(
						'title' => esc_html__('Portfolio Slug (Permalink)', 'attorna'),
						'type' => 'text',
						'default' => 'portfolio',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'attorna')
					),
					'portfolio-category-slug' => array(
						'title' => esc_html__('Portfolio Category Slug (Permalink)', 'attorna'),
						'type' => 'text',
						'default' => 'portfolio_category',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'attorna')
					),
					'portfolio-tag-slug' => array(
						'title' => esc_html__('Portfolio Tag Slug (Permalink)', 'attorna'),
						'type' => 'text',
						'default' => 'portfolio_tag',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'attorna')
					),
					'enable-single-portfolio-navigation' => array(
						'title' => esc_html__('Enable Single Portfolio Navigation', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'enable-single-portfolio-navigation-in-same-tag' => array(
						'title' => esc_html__('Enable Single Portfolio Navigation Within Same Tag', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'enable-single-portfolio-navigation' => 'enable' )
					),
					'portfolio-icon-hover-link' => array(
						'title' => esc_html__('Portfolio Hover Icon (Link)', 'attorna'),
						'type' => 'radioimage',
						'options' => 'hover-icon-link',
						'default' => 'icon_link_alt'
					),
					'portfolio-icon-hover-video' => array(
						'title' => esc_html__('Portfolio Hover Icon (Video)', 'attorna'),
						'type' => 'radioimage',
						'options' => 'hover-icon-video',
						'default' => 'icon_film'
					),
					'portfolio-icon-hover-image' => array(
						'title' => esc_html__('Portfolio Hover Icon (Image)', 'attorna'),
						'type' => 'radioimage',
						'options' => 'hover-icon-image',
						'default' => 'icon_zoom-in_alt'
					),
					'portfolio-icon-hover-size' => array(
						'title' => esc_html__('Portfolio Hover Icon Size', 'attorna'),
						'type' => 'fontslider',
						'data-type' => 'pixel',
						'default' => '22px',
						'selector' => '.gdlr-core-portfolio-thumbnail .gdlr-core-portfolio-icon{ font-size: #gdlr#; }' 
					),
					'enable-related-portfolio' => array(
						'title' => esc_html__('Enable Related Portfolio', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'related-portfolio-style' => array(
						'title' => esc_html__('Related Portfolio Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'grid' => esc_html__('Grid', 'attorna'),
							'modern' => esc_html__('Modern', 'attorna'),
						),
						'condition' => array('enable-related-portfolio'=>'enable')
					),
					'related-portfolio-column-size' => array(
						'title' => esc_html__('Related Portfolio Column Size', 'attorna'),
						'type' => 'combobox',
						'options' => array( 60 => 1, 30 => 2, 20 => 3, 15 => 4, 12 => 5, 10 => 6, ),
						'default' => 15,
						'condition' => array('enable-related-portfolio'=>'enable')
					),
					'related-portfolio-num-fetch' => array(
						'title' => esc_html__('Related Portfolio Num Fetch', 'attorna'),
						'type' => 'text',
						'default' => 4,
						'data-input-type' => 'number',
						'condition' => array('enable-related-portfolio'=>'enable')
					),
					'related-portfolio-thumbnail-size' => array(
						'title' => esc_html__('Related Portfolio Thumbnail Size', 'attorna'),
						'type' => 'combobox',
						'options' => 'thumbnail-size',
						'condition' => array('enable-related-portfolio'=>'enable'),
						'default' => 'medium'
					),
					'related-portfolio-num-excerpt' => array(
						'title' => esc_html__('Related Portfolio Num Excerpt', 'attorna'),
						'type' => 'text',
						'default' => 20,
						'data-input-type' => 'number',
						'condition' => array('enable-related-portfolio'=>'enable', 'related-portfolio-style'=>'grid')
					),
				)
			),

			'portfolio-archive' => array(
				'title' => esc_html__('Portfolio Archive', 'attorna'),
				'options' => array(
					'archive-portfolio-sidebar' => array(
						'title' => esc_html__('Archive Portfolio Sidebar', 'attorna'),
						'type' => 'radioimage',
						'options' => 'sidebar',
						'default' => 'none',
						'wrapper-class' => 'gdlr-core-fullsize'
					),
					'archive-portfolio-sidebar-left' => array(
						'title' => esc_html__('Archive Portfolio Sidebar Left', 'attorna'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'archive-portfolio-sidebar'=>array('left', 'both') )
					),
					'archive-portfolio-sidebar-right' => array(
						'title' => esc_html__('Archive Portfolio Sidebar Right', 'attorna'),
						'type' => 'combobox',
						'options' => 'sidebar',
						'default' => 'none',
						'condition' => array( 'archive-portfolio-sidebar'=>array('right', 'both') )
					),
					'archive-portfolio-style' => array(
						'title' => esc_html__('Archive Portfolio Style', 'attorna'),
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
						'title' => esc_html__('Archive Portfolio Thumbnail Size', 'attorna'),
						'type' => 'combobox',
						'options' => 'thumbnail-size'
					),
					'archive-portfolio-grid-text-align' => array(
						'title' => esc_html__('Archive Portfolio Grid Text Align', 'attorna'),
						'type' => 'radioimage',
						'options' => 'text-align',
						'default' => 'left',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space' ) )
					),
					'archive-portfolio-grid-style' => array(
						'title' => esc_html__('Archive Portfolio Grid Content Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'normal' => esc_html__('Normal', 'attorna'),
							'with-frame' => esc_html__('With Frame', 'attorna'),
							'with-bottom-border' => esc_html__('With Bottom Border', 'attorna'),
						),
						'default' => 'normal',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space' ) )
					),
					'archive-enable-portfolio-tag' => array(
						'title' => esc_html__('Archive Enable Portfolio Tag', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space', 'modern-desc', 'modern-desc-no-space', 'medium' ) )
					),
					'archive-portfolio-medium-size' => array(
						'title' => esc_html__('Archive Portfolio Medium Thumbnail Size', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'small' => esc_html__('Small', 'attorna'),
							'large' => esc_html__('Large', 'attorna'),
						),
						'condition' => array( 'archive-portfolio-style' => 'medium' )
					),
					'archive-portfolio-medium-style' => array(
						'title' => esc_html__('Archive Portfolio Medium Thumbnail Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'left' => esc_html__('Left', 'attorna'),
							'right' => esc_html__('Right', 'attorna'),
							'switch' => esc_html__('Switch ( Between Left and Right )', 'attorna'),
						),
						'default' => 'switch',
						'condition' => array( 'archive-portfolio-style' => 'medium' )
					),
					'archive-portfolio-hover' => array(
						'title' => esc_html__('Archive Portfolio Hover Style', 'attorna'),
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
						'title' => esc_html__('Archive Portfolio Column Size', 'attorna'),
						'type' => 'combobox',
						'options' => array( 60=>1, 30=>2, 20=>3, 15=>4, 12=>5 ),
						'default' => 20,
						'condition' => array( 'archive-portfolio-style' => array('modern', 'modern-no-space', 'grid', 'grid-no-space', 'modern-desc', 'modern-desc-no-space') )
					),
					'archive-portfolio-excerpt' => array(
						'title' => esc_html__('Archive Portfolio Excerpt Type', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'specify-number' => esc_html__('Specify Number', 'attorna'),
							'show-all' => esc_html__('Show All ( use <!--more--> tag to cut the content )', 'attorna'),
							'none' => esc_html__('Disable Exceprt', 'attorna'),
						),
						'default' => 'specify-number',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space', 'modern-desc', 'modern-desc-no-space', 'medium' ) )
					),
					'archive-portfolio-excerpt-number' => array(
						'title' => esc_html__('Archive Portfolio Excerpt Number', 'attorna'),
						'type' => 'text',
						'default' => 55,
						'data-input-type' => 'number',
						'condition' => array( 'archive-portfolio-style' => array( 'grid', 'grid-no-space', 'modern-desc', 'modern-desc-no-space', 'medium' ), 'archive-portfolio-excerpt' => 'specify-number' )
					),

				)
			),

			'personnel-style' => array(
				'title' => esc_html__('Personnel Style', 'attorna'),
				'options' => array(
					'personnel-slug' => array(
						'title' => esc_html__('Personnel Slug (Permalink)', 'attorna'),
						'type' => 'text',
						'default' => 'personnel',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'attorna')
					),
					'personnel-category-slug' => array(
						'title' => esc_html__('Personnel Category Slug (Permalink)', 'attorna'),
						'type' => 'text',
						'default' => 'personnel_category',
						'description' => esc_html__('Please save the "Settings > Permalink" area once after made a changes to this field.', 'attorna')
					),
				)
			),

			'footer' => array(
				'title' => esc_html__('Footer/Copyright', 'attorna'),
				'options' => array(

					'fixed-footer' => array(
						'title' => esc_html__('Fixed Footer', 'attorna'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
					'enable-footer' => array(
						'title' => esc_html__('Enable Footer', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'footer-background' => array(
						'title' => esc_html__('Footer Background', 'attorna'),
						'type' => 'upload',
						'data-type' => 'file',
						'selector' => '.attorna-footer-wrapper{ background-image: url(#gdlr#); background-size: cover; }',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'enable-footer-column-divider' => array(
						'title' => esc_html__('Enable Footer Column Divider', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'footer-top-padding' => array(
						'title' => esc_html__('Footer Top Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '300',
						'data-type' => 'pixel',
						'default' => '70px',
						'selector' => '.attorna-footer-wrapper{ padding-top: #gdlr#; }',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'footer-bottom-padding' => array(
						'title' => esc_html__('Footer Bottom Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '300',
						'data-type' => 'pixel',
						'default' => '50px',
						'selector' => '.attorna-footer-wrapper{ padding-bottom: #gdlr#; }',
						'condition' => array( 'enable-footer' => 'enable' )
					),
					'footer-style' => array(
						'title' => esc_html__('Footer Style', 'attorna'),
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
						'title' => esc_html__('Enable Copyright', 'attorna'),
						'type' => 'checkbox',
						'default' => 'enable'
					),
					'copyright-style' => array(
						'title' => esc_html__('Copyright Style', 'attorna'),
						'type' => 'combobox',
						'options' => array(
							'center' => esc_html__('Center', 'attorna'),
							'left-right' => esc_html__('Left & Right', 'attorna'),
						),
						'condition' => array( 'enable-copyright' => 'enable' )
					),
					'copyright-top-padding' => array(
						'title' => esc_html__('Copyright Top Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '300',
						'data-type' => 'pixel',
						'default' => '38px',
						'selector' => '.attorna-copyright-container{ padding-top: #gdlr#; }',
						'condition' => array( 'enable-copyright' => 'enable' )
					),
					'copyright-bottom-padding' => array(
						'title' => esc_html__('Copyright Bottom Padding', 'attorna'),
						'type' => 'fontslider',
						'data-min' => '0',
						'data-max' => '300',
						'data-type' => 'pixel',
						'default' => '38px',
						'selector' => '.attorna-copyright-container{ padding-bottom: #gdlr#; }',
						'condition' => array( 'enable-copyright' => 'enable' )
					),	
					'copyright-text' => array(
						'title' => esc_html__('Copyright Text', 'attorna'),
						'type' => 'textarea',
						'wrapper-class' => 'gdlr-core-fullsize',
						'condition' => array( 'enable-copyright' => 'enable' )
					),
					'copyright-left' => array(
						'title' => esc_html__('Copyright Left', 'attorna'),
						'type' => 'textarea',
						'wrapper-class' => 'gdlr-core-fullsize',
						'condition' => array( 'enable-copyright' => 'enable', 'copyright-style' => 'left-right' )
					),
					'copyright-right' => array(
						'title' => esc_html__('Copyright Right', 'attorna'),
						'type' => 'textarea',
						'wrapper-class' => 'gdlr-core-fullsize',
						'condition' => array( 'enable-copyright' => 'enable', 'copyright-style' => 'left-right' )
					),
					'enable-back-to-top' => array(
						'title' => esc_html__('Enable Back To Top Button', 'attorna'),
						'type' => 'checkbox',
						'default' => 'disable'
					),
				) // footer-options
			), // footer-nav	
		
		) // general-options
		
	), 2);