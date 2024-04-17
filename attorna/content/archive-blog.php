<?php
/**
 * The template part for displaying blog archive
 */

	global $wp_query;

	$settings = array(
		'query' => $wp_query,
		'blog-style' => attorna_get_option('general', 'archive-blog-style', 'blog-full'),
		'blog-full-style' => attorna_get_option('general', 'archive-blog-full-style', 'style-1'),
		'blog-side-thumbnail-style' => attorna_get_option('general', 'archive-blog-side-thumbnail-style', 'style-1'),
		'blog-column-style' => attorna_get_option('general', 'archive-blog-column-style', 'style-1'),
		'blog-image-style' => attorna_get_option('general', 'archive-blog-image-style', 'style-1'),
		'blog-full-alignment' => attorna_get_option('general', 'archive-blog-full-alignment', 'left'),
		'thumbnail-size' => attorna_get_option('general', 'archive-thumbnail-size', 'full'),
		'show-thumbnail' => attorna_get_option('general', 'archive-show-thumbnail', 'enable'),
		'column-size' => attorna_get_option('general', 'archive-column-size', 20),
		'excerpt' => attorna_get_option('general', 'archive-excerpt', 'specify-number'),
		'excerpt-number' => attorna_get_option('general', 'archive-excerpt-number', 55),
		'blog-date-feature' => attorna_get_option('general', 'archive-date-feature', 'enable'),
		'meta-option' => attorna_get_option('general', 'archive-meta-option', array()),
		'show-read-more' => attorna_get_option('general', 'archive-show-read-more', 'enable'),

		'blog-title-font-size' => attorna_get_option('general', 'archive-blog-title-font-size', ''),
		'blog-title-font-weight' => attorna_get_option('general', 'archive-blog-title-font-weight', ''),
		'blog-title-letter-spacing' => attorna_get_option('general', 'archive-blog-title-letter-spacing', ''),
		'blog-title-text-transform' => attorna_get_option('general', 'archive-blog-title-text-transform', ''),

		'paged' => (get_query_var('paged'))? get_query_var('paged') : 1,
		'pagination' => 'page',
		'pagination-style' => attorna_get_option('general', 'pagination-style', 'round'),
		'pagination-align' => attorna_get_option('general', 'pagination-align', 'right'),

	);

	echo '<div class="attorna-content-area" >';
	if( is_category() ){
		$tax_description = category_description();
		if( !empty($tax_description) ){
			echo '<div class="attorna-archive-taxonomy-description attorna-item-pdlr" >' . $tax_description . '</div>';
		}
	}else if( is_tag() ){
		$tax_description = term_description(NULL, 'post_tag');
		if( !empty($tax_description) ){
			echo '<div class="attorna-archive-taxonomy-description attorna-item-pdlr" >' . $tax_description . '</div>';
		}
	}

	echo gdlr_core_pb_element_blog::get_content($settings);
	echo '</div>'; // attorna-content-area