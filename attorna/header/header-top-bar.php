<?php
	/* a template for displaying the top bar */

	if( attorna_get_option('general', 'enable-top-bar', 'enable') == 'enable' ){

		$top_bar_width = attorna_get_option('general', 'top-bar-width', 'boxed');
		$top_bar_container_class = '';

		if( $top_bar_width == 'boxed' ){
			$top_bar_container_class = 'attorna-container ';
		}else if( $top_bar_width == 'custom' ){
			$top_bar_container_class = 'attorna-top-bar-custom-container ';
		}else{
			$top_bar_container_class = 'attorna-top-bar-full ';
		}

		$top_bar_menu = attorna_get_option('general', 'top-bar-menu-position', 'none');

		echo '<div class="attorna-top-bar" >';
		echo '<div class="attorna-top-bar-background" ></div>';
		echo '<div class="attorna-top-bar-container ' . esc_attr($top_bar_container_class) . '" >';
		echo '<div class="attorna-top-bar-container-inner clearfix" >';

		$language_flag = attorna_get_wpml_flag();
		$left_text = attorna_get_option('general', 'top-bar-left-text', '');
		if( !empty($left_text) || !empty($language_flag) || 
			($top_bar_menu == 'left' && has_nav_menu('top_bar_menu')) ){

			echo '<div class="attorna-top-bar-left attorna-item-pdlr">';
			if( $top_bar_menu == 'left' ){
				attorna_get_top_bar_menu('left');
			}
			echo gdlr_core_escape_content($language_flag);
			echo gdlr_core_escape_content(gdlr_core_text_filter($left_text));
			echo '</div>';
		}

		$right_button_icon = attorna_get_option('general', 'top-bar-right-button-icon-class', '');
		$right_button_text = attorna_get_option('general', 'top-bar-right-button-text', '');
		$right_button_link = attorna_get_option('general', 'top-bar-right-button-link', '');
		if( (!empty($right_button_text) && !empty($right_button_link)) ){
			$right_button_target = attorna_get_option('general', 'top-bar-right-button-target', '_self');

			echo '<a class="attorna-top-bar-right-button" ';
			echo 'href="' . esc_url($right_button_link) . '" ';
			echo 'target="' . esc_attr($right_button_target) . '" ';
			echo ' >';
			if( !empty($right_button_icon) ){
				echo '<i class="' . esc_attr($right_button_icon) . '" ></i>';
			} 
			echo gdlr_core_text_filter($right_button_text);
			echo '</a>';
		}
		
		$right_text = attorna_get_option('general', 'top-bar-right-text', '');
		$top_bar_social = attorna_get_option('general', 'enable-top-bar-social', 'enable');
		if( !empty($right_text) || $top_bar_social == 'enable' || 
			($top_bar_menu == 'right' && has_nav_menu('top_bar_menu')) ){
			echo '<div class="attorna-top-bar-right attorna-item-pdlr">';
			if( $top_bar_menu == 'right' ){
				attorna_get_top_bar_menu('right');
			}

			if( !empty($right_text) ){
				echo '<div class="attorna-top-bar-right-text">';
				echo gdlr_core_escape_content(gdlr_core_text_filter($right_text));
				echo '</div>';
			}

			if( $top_bar_social == 'enable' ){
				echo '<div class="attorna-top-bar-right-social" >';
				get_template_part('header/header', 'social');
				echo '</div>';	
			}
			echo '</div>';	
		}
		echo '</div>'; // attorna-top-bar-container-inner
		echo '</div>'; // attorna-top-bar-container
		echo '</div>'; // attorna-top-bar

	}  // top bar
?>