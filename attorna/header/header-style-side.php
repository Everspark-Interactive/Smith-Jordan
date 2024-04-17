<?php
	/* a template for displaying the header area */

	$header_side_style = attorna_get_option('general', 'header-side-style', 'top-left');
	$header_class = 'attorna-' . attorna_get_option('general', 'header-side-align', 'left') . '-align';
?>	
<header class="attorna-header-wrap attorna-header-style-side <?php echo esc_attr($header_class); ?>" >
	<?php

		$logo_wrap_class = '';
		$navigation_class = '';
		if( attorna_get_option('general', 'enable-main-navigation-submenu-indicator', 'disable') == 'enable' ){
			$navigation_class .= 'attorna-navigation-submenu-indicator ';
		}
		if( in_array($header_side_style, array('middle-left-2', 'middle-right-2')) ){
			$logo_wrap_class .= 'attorna-pos-middle ';
		}else if( in_array($header_side_style, array('middle-left', 'middle-right')) ){
			$navigation_class .= 'attorna-pos-middle ';
		} 

		if( is_page() ){
			$post_option = attorna_get_post_option(get_the_ID());
		}
		if( empty($post_option['enable-logo']) ){
			$enable_logo = attorna_get_option('general', 'enable-logo', 'enable');
		}else if( $post_option['enable-logo'] == 'disable' ){
			$enable_logo = 'disable';
		}else{
			$enable_logo = 'enable';
		}
		if( $enable_logo == 'enable' ){
			echo attorna_get_logo(array('padding' => false, 'wrapper-class' => $logo_wrap_class));
		}
	?>
	<div class="attorna-navigation clearfix <?php echo esc_attr($navigation_class); ?>" >
	<?php
		// print main menu
		if( has_nav_menu('main_menu') ){
			echo '<div class="attorna-main-menu" id="attorna-main-menu" >';
			wp_nav_menu(array(
				'theme_location'=>'main_menu', 
				'container'=> '', 
				'menu_class'=> 'sf-vertical'
			));
			echo '</div>';
		}

		// menu right side
		$enable_search = (attorna_get_option('general', 'enable-main-navigation-search', 'enable') == 'enable')? true: false;
		$enable_cart = (attorna_get_option('general', 'enable-main-navigation-cart', 'enable') == 'enable' && class_exists('WooCommerce'))? true: false;
		if( $enable_search || $enable_cart ){
			echo '<div class="attorna-main-menu-right-wrap clearfix" >';

			// search icon
			if( $enable_search ){
				echo '<div class="attorna-main-menu-search" id="attorna-top-search" >';
				echo '<i class="fa fa-search" ></i>';
				echo '</div>';
				attorna_get_top_search();
			}

			// cart icon
			if( $enable_cart ){
				echo '<div class="attorna-main-menu-cart" id="attorna-main-menu-cart" >';
				echo '<i class="fa fa-shopping-cart" data-attorna-lb="top-bar" ></i>';
				attorna_get_woocommerce_bar();
				echo '</div>';
			}

			echo '</div>'; // attorna-main-menu-right-wrap
		}
	?>
	</div><!-- attorna-navigation -->
	<?php
		// social network
		$top_bar_social = attorna_get_option('general', 'enable-top-bar-social', 'enable');
		if( $top_bar_social == 'enable' ){

			$top_bar_social_class = '';
			if( in_array($header_side_style, array('top-left', 'top-right', 'middle-left', 'middle-right')) ){
				$top_bar_social_class .= 'attorna-pos-bottom ';
			}

			echo '<div class="attorna-header-social ' . esc_attr($top_bar_social_class) . '" >';
			get_template_part('header/header', 'social');
			echo '</div>';
			
			attorna_set_option('general', 'enable-top-bar-social', 'disable');
		}
	?>
</header><!-- header -->