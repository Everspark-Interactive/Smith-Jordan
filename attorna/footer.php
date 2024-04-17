<?php
/**
 * The template for displaying the footer
 */
	
	$post_option = attorna_get_post_option(get_the_ID());
	if( empty($post_option['enable-footer']) || $post_option['enable-footer'] == 'default' ){
		$enable_footer = attorna_get_option('general', 'enable-footer', 'enable');
	}else{
		$enable_footer = $post_option['enable-footer'];
	}	
	if( empty($post_option['enable-copyright']) || $post_option['enable-copyright'] == 'default' ){
		$enable_copyright = attorna_get_option('general', 'enable-copyright', 'enable');
	}else{
		$enable_copyright = $post_option['enable-copyright'];
	}

	$fixed_footer = attorna_get_option('general', 'fixed-footer', 'disable');
	echo '</div>'; // attorna-page-wrapper

	if( $enable_footer == 'enable' || $enable_copyright == 'enable' ){

		if( $fixed_footer == 'enable' ){
			echo '</div>'; // attorna-body-wrapper

			echo '<footer class="attorna-fixed-footer" id="attorna-fixed-footer" >';
		}else{
			echo '<footer>';
		}

		if( $enable_footer == 'enable' ){

			$attorna_footer_layout = array(
				'footer-1'=>array('attorna-column-60'),
				'footer-2'=>array('attorna-column-15', 'attorna-column-15', 'attorna-column-15', 'attorna-column-15'),
				'footer-3'=>array('attorna-column-15', 'attorna-column-15', 'attorna-column-30',),
				'footer-4'=>array('attorna-column-20', 'attorna-column-20', 'attorna-column-20'),
				'footer-5'=>array('attorna-column-20', 'attorna-column-40'),
				'footer-6'=>array('attorna-column-40', 'attorna-column-20'),
			);
			$footer_style = attorna_get_option('general', 'footer-style');
			$footer_style = empty($footer_style)? 'footer-2': $footer_style;

			$count = 0;
			$has_widget = false;
			foreach( $attorna_footer_layout[$footer_style] as $layout ){ $count++;
				if( is_active_sidebar('footer-' . $count) ){ $has_widget = true; }
			}

			if( $has_widget ){ 	

				$footer_column_divider = attorna_get_option('general', 'enable-footer-column-divider', 'enable');
				$extra_class  = ($footer_column_divider == 'enable')? ' attorna-with-column-divider': '';

				echo '<div class="attorna-footer-wrapper ' . esc_attr($extra_class) . '" >';
				echo '<div class="attorna-footer-container attorna-container clearfix" >';
				
				$count = 0;
				foreach( $attorna_footer_layout[$footer_style] as $layout ){ $count++;
					echo '<div class="attorna-footer-column attorna-item-pdlr ' . esc_attr($layout) . '" >';
					if( is_active_sidebar('footer-' . $count) ){
						dynamic_sidebar('footer-' . $count); 
					}
					echo '</div>';
				}
				
				echo '</div>'; // attorna-footer-container
				echo '</div>'; // attorna-footer-wrapper 
			}
		} // enable footer

		if( $enable_copyright == 'enable' ){
			$copyright_style = attorna_get_option('general', 'copyright-style', 'center');
			
			if( $copyright_style == 'center' ){
				$copyright_text = attorna_get_option('general', 'copyright-text');

				if( !empty($copyright_text) ){
					echo '<div class="attorna-copyright-wrapper" >';
					echo '<div class="attorna-copyright-container attorna-container">';
					echo '<div class="attorna-copyright-text attorna-item-pdlr">';
					echo gdlr_core_escape_content(gdlr_core_text_filter($copyright_text));
					echo '</div>';
					echo '</div>';
					echo '</div>'; // attorna-copyright-wrapper
				}
			}else if( $copyright_style == 'left-right' ){
				$copyright_left = attorna_get_option('general', 'copyright-left');
				$copyright_right = attorna_get_option('general', 'copyright-right');

				if( !empty($copyright_left) || !empty($copyright_right) ){
					echo '<div class="attorna-copyright-wrapper" >';
					echo '<div class="attorna-copyright-container attorna-container clearfix">';
					if( !empty($copyright_left) ){
						echo '<div class="attorna-copyright-left attorna-item-pdlr">';
						echo gdlr_core_escape_content(gdlr_core_text_filter($copyright_left));
						echo '</div>';
					}

					if( !empty($copyright_right) ){
						echo '<div class="attorna-copyright-right attorna-item-pdlr">';
						echo gdlr_core_escape_content(gdlr_core_text_filter($copyright_right));
						echo '</div>';
					}
					echo '</div>';
					echo '</div>'; // attorna-copyright-wrapper
				}
			}
		}

		echo '</footer>';

		if( $fixed_footer == 'disable' ){
			echo '</div>'; // attorna-body-wrapper
		}
		echo '</div>'; // attorna-body-outer-wrapper

	// disable footer	
	}else{
		echo '</div>'; // attorna-body-wrapper
		echo '</div>'; // attorna-body-outer-wrapper
	}

	$header_style = attorna_get_option('general', 'header-style', 'plain');
	
	if( $header_style == 'side' || $header_style == 'side-toggle' ){
		echo '</div>'; // attorna-header-side-nav-content
	}

	$back_to_top = attorna_get_option('general', 'enable-back-to-top', 'disable');
	if( $back_to_top == 'enable' ){
		echo '<a href="#attorna-top-anchor" class="attorna-footer-back-to-top-button" id="attorna-footer-back-to-top-button"><i class="fa fa-angle-up" ></i></a>';
	}
?>

<?php wp_footer(); ?>

</body>
</html>