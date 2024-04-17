<?php
	/* a template for displaying the header social network */

	$post_option = attorna_get_post_option(get_the_ID());
	if( !empty($post_option['bullet-anchor']) ){

		echo '<div class="attorna-bullet-anchor" id="attorna-bullet-anchor" >';
		echo '<a class="attorna-bullet-anchor-link current-menu-item" href="' . get_permalink() . '" ></a>';
		foreach( $post_option['bullet-anchor'] as $anchor ){
			echo '<a class="attorna-bullet-anchor-link" href="' . esc_url($anchor['title']) . '" ></a>';
		}
		echo '</div>';
	}