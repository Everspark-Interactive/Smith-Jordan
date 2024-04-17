<?php
/**
 * The template for displaying 404 pages (not found)
 */

	get_header();
	
	?>
	<div class="attorna-not-found-wrap" id="attorna-full-no-header-wrap" >
		<div class="attorna-not-found-background" ></div>
		<div class="attorna-not-found-container attorna-container">
			<div class="attorna-header-transparent-substitute" ></div>
	
			<div class="attorna-not-found-content attorna-item-pdlr">
			<?php
				echo '<h1 class="attorna-not-found-head" >' . esc_html__('404', 'attorna') . '</h1>';
				echo '<h3 class="attorna-not-found-title attorna-content-font" >' . esc_html__('Page Not Found', 'attorna') . '</h3>';
				echo '<div class="attorna-not-found-caption" >' . esc_html__('Sorry, we couldn\'t find the page you\'re looking for.', 'attorna') . '</div>';

				echo '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">';
				echo '<input type="text" class="search-field attorna-title-font" placeholder="' . esc_attr__('Type Keywords...', 'attorna') . '" value="" name="s">';
				echo '<div class="attorna-top-search-submit"><i class="fa fa-search" ></i></div>';
				echo '<input type="submit" class="search-submit" value="Search">';
				echo '</form>';
				echo '<div class="attorna-not-found-back-to-home" ><a href="' . esc_url(home_url('/')) . '" >' . esc_html__('Or Back To Homepage', 'attorna') . '</a></div>';
			?>
			</div>
		</div>
	</div>
	<?php

	get_footer(); 
