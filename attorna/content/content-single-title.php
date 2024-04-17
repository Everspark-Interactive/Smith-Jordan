<?php
/**
 * The template part for displaying single post title
 */

	$blog_date = attorna_get_option('general', 'blog-date-feature', '');
	$blog_style = attorna_get_option('general', 'blog-style', 'style-1');
	
	$blog_info_atts = array( 'wrapper' => true );
	$blog_info_atts['display'] = attorna_get_option('general', 'meta-option', '');
	if( empty($blog_date) && empty($blog_info_atts['display']) ){
		$blog_info_atts['display'] = array('author', 'category', 'tag', 'comment-number');
	}

	echo '<header class="attorna-single-article-head clearfix" >';
	if( in_array($blog_style, array('style-1', 'magazine')) && (empty($blog_date) || $blog_date == 'enable') ){
		echo '<div class="attorna-single-article-date-wrapper  post-date updated">';
		echo '<div class="attorna-single-article-date-day">' .  get_the_time('d') . '</div>';
		echo '<div class="attorna-single-article-date-month">' . get_the_time('M') . '</div>';

		$blog_date_year = attorna_get_option('general', 'blog-date-feature-year', '');
		if( !empty($blog_date_year) && $blog_date_year == 'enable' ){
			echo '<div class="attorna-single-article-date-year">' . get_the_time('Y') . '</div>';
		} 
		echo '</div>';
	}else if( $blog_style == 'style-2' ){
		$blog_info_atts['separator'] = '•';
		echo attorna_get_blog_info($blog_info_atts);
	}

	echo '<div class="attorna-single-article-head-right">';
	if( is_single() ){
		echo '<h1 class="attorna-single-article-title">' . get_the_title() . '</h1>';
	}else{
		echo '<h3 class="attorna-single-article-title"><a href="' . get_permalink() . '" >' . get_the_title() . '</a></h3>';
	}

	if( in_array($blog_style, array('style-1', 'style-3', 'magazine')) ){
		echo attorna_get_blog_info($blog_info_atts);
	}else if( $blog_style == 'style-4' ){
		$blog_info_atts['separator'] = '•';
		echo attorna_get_blog_info($blog_info_atts);
	}
	echo '</div>';
	echo '</header>';