<?php
	// mobile menu template
	echo '<div class="attorna-mobile-header-wrap" >';

	// top bar
	$top_bar = attorna_get_option('general', 'enable-top-bar-on-mobile', 'disable');
	if( $top_bar == 'enable' ){
		get_template_part('header/header', 'top-bar');
	}

	// header
	$logo_position = attorna_get_option('general', 'mobile-logo-position', 'logo-left');
	$sticky_mobile_nav = attorna_get_option('general', 'enable-mobile-navigation-sticky', 'enable');
	echo '<div class="attorna-mobile-header attorna-header-background attorna-style-slide ';
	if($sticky_mobile_nav == 'enable'){
		echo 'attorna-sticky-mobile-navigation ';
	}
	echo '" id="attorna-mobile-header" >';
	echo '<div class="attorna-mobile-header-container attorna-container clearfix" >';
	echo attorna_get_logo(array(
		'mobile' => true,
		'wrapper-class' => ($logo_position == 'logo-center'? 'attorna-mobile-logo-center': '')
	));

	echo '<div class="attorna-mobile-menu-right" >';

	// search icon
	$enable_search = (attorna_get_option('general', 'enable-main-navigation-search', 'enable') == 'enable')? true: false;
	if( $enable_search ){
		echo '<div class="attorna-main-menu-search" id="attorna-mobile-top-search" >';
		echo '<i class="fa fa-search" ></i>';
		echo '</div>';
		attorna_get_top_search();
	}

	// cart icon
	$enable_cart = (attorna_get_option('general', 'enable-main-navigation-cart', 'enable') == 'enable' && class_exists('WooCommerce'))? true: false;
	if( $enable_cart ){
		echo '<div class="attorna-main-menu-cart" id="attorna-mobile-menu-cart" >';
		echo '<i class="fa fa-shopping-cart" data-attorna-lb="top-bar" ></i>';
		attorna_get_woocommerce_bar();
		echo '</div>';
	}

	if( $logo_position == 'logo-center' ){
		echo '</div>';
		echo '<div class="attorna-mobile-menu-left" >';
	}

	// mobile menu
	if( has_nav_menu('mobile_menu') ){
		attorna_get_custom_menu(array(
			'type' => attorna_get_option('general', 'right-menu-type', 'right'),
			'container-class' => 'attorna-mobile-menu',
			'button-class' => 'attorna-mobile-menu-button',
			'icon-class' => 'fa fa-bars',
			'id' => 'attorna-mobile-menu',
			'theme-location' => 'mobile_menu'
		));
	}
	echo '</div>'; // attorna-mobile-menu-right/left
	echo '</div>'; // attorna-mobile-header-container
	echo '</div>'; // attorna-mobile-header

	echo '</div>'; // attorna-mobile-header-wrap