<?php
/**
 * The template for displaying archive not found
 */

	echo '<div class="attorna-not-found-wrap" id="attorna-full-no-header-wrap" >';
	echo '<div class="attorna-not-found-background" ></div>';
	echo '<div class="attorna-not-found-container attorna-container">';
	echo '<div class="attorna-header-transparent-substitute" ></div>';
	
	echo '<div class="attorna-not-found-content attorna-item-pdlr">';
	echo '<h1 class="attorna-not-found-head" >' . esc_html__('Not Found', 'attorna') . '</h1>';
	echo '<div class="attorna-not-found-caption" >' . esc_html__('Nothing matched your search criteria. Please try again with different keywords.', 'attorna') . '</div>';

	echo '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">';
	echo '<input type="text" class="search-field attorna-title-font" placeholder="' . esc_attr__('Type Keywords...', 'attorna') . '" value="" name="s">';
	echo '<div class="attorna-top-search-submit"><i class="fa fa-search" ></i></div>';
	echo '<input type="submit" class="search-submit" value="Search">';
	echo '</form>';
	echo '<div class="attorna-not-found-back-to-home" ><a href="' . esc_url(home_url('/')) . '" >' . esc_html__('Or Back To Homepage', 'attorna') . '</a></div>';
	echo '</div>'; // attorna-not-found-content

	echo '</div>'; // attorna-not-found-container
	echo '</div>'; // attorna-not-found-wrap