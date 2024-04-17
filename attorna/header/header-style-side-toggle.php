<?php
	/* a template for displaying the header area */
?>	
<header class="attorna-header-wrap attorna-header-style-side-toggle" >
	<?php
		$display_logo = attorna_get_option('general', 'header-side-toggle-display-logo', 'enable');
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
			if( $display_logo == 'enable' ){
				echo attorna_get_logo(array('padding' => false));
			}
		}

		$navigation_class = '';
		if( attorna_get_option('general', 'enable-main-navigation-submenu-indicator', 'disable') == 'enable' ){
			$navigation_class = 'attorna-navigation-submenu-indicator ';
		}
	?>
	<div class="attorna-navigation clearfix <?php echo esc_attr($navigation_class); ?>" >
	<?php
		// print main menu
		if( has_nav_menu('main_menu') ){
			attorna_get_custom_menu(array(
				'container-class' => 'attorna-main-menu',
				'button-class' => 'attorna-side-menu-icon',
				'icon-class' => 'fa fa-bars',
				'id' => 'attorna-main-menu',
				'theme-location' => 'main_menu',
				'type' => attorna_get_option('general', 'header-side-toggle-menu-type', 'overlay')
			));
		}
	?>
	</div><!-- attorna-navigation -->
	<?php

		// menu right side
		$enable_search = (attorna_get_option('general', 'enable-main-navigation-search', 'enable') == 'enable')? true: false;
		$enable_cart = (attorna_get_option('general', 'enable-main-navigation-cart', 'enable') == 'enable' && class_exists('WooCommerce'))? true: false;
		if( $enable_search || $enable_cart ){ 
			echo '<div class="attorna-header-icon attorna-pos-bottom" >';

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
</header><!-- header -->