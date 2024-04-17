<?php
	/**
	 * The template part for displaying single posts style 1
	 */

	// print header title
	if( get_post_type() == 'post' ){
		get_template_part('header/header', 'title-blog');
	}

	$post_option = attorna_get_post_option(get_the_ID());
	$post_option = empty($post_option)? array(): $post_option;
	$post_option['show-content'] = empty($post_option['show-content'])? 'enable': $post_option['show-content']; 

	if( empty($post_option['sidebar']) || $post_option['sidebar'] == 'default' ){
		$sidebar_type = attorna_get_option('general', 'blog-sidebar', 'none');
		$sidebar_left = attorna_get_option('general', 'blog-sidebar-left');
		$sidebar_right = attorna_get_option('general', 'blog-sidebar-right');
	}else{
		$sidebar_type = empty($post_option['sidebar'])? 'none': $post_option['sidebar'];
		$sidebar_left = empty($post_option['sidebar-left'])? '': $post_option['sidebar-left'];
		$sidebar_right = empty($post_option['sidebar-right'])? '': $post_option['sidebar-right'];
	}

	if( $sidebar_type != 'none' || $post_option['show-content'] == 'enable' ){
		echo '<div class="attorna-content-container attorna-container">';
		echo '<div class="' . esc_attr(attorna_get_sidebar_wrap_class($sidebar_type)) . '" >';

		// sidebar content
		echo '<div class="' . esc_attr(attorna_get_sidebar_class(array('sidebar-type'=>$sidebar_type, 'section'=>'center'))) . '" >';
		echo '<div class="attorna-content-wrap attorna-item-pdlr clearfix" >';

		// single content
		if( $post_option['show-content'] == 'enable' ){
			echo '<div class="attorna-content-area" >';
			if( in_array(get_post_format(), array('aside', 'quote', 'link')) ){
				get_template_part('content/content', get_post_format());
			}else{
				get_template_part('content/content', 'single');
			}
			echo '</div>';
		}
	}

	if( !post_password_required() ){
		if( $sidebar_type != 'none' ){
			echo '<div class="attorna-page-builder-wrap attorna-item-rvpdlr" >';
			do_action('gdlr_core_print_page_builder');
			echo '</div>';

		// sidebar == 'none'
		}else{
			ob_start();
			do_action('gdlr_core_print_page_builder');
			$pb_content = ob_get_contents();
			ob_end_clean();

			if( !empty($pb_content) ){
				if( $post_option['show-content'] == 'enable' ){
					echo '</div>'; // attorna-content-area
					echo '</div>'; // attorna_get_sidebar_class
					echo '</div>'; // attorna_get_sidebar_wrap_class
					echo '</div>'; // attorna_content_container
				}
				echo gdlr_core_escape_content($pb_content);
				echo '<div class="attorna-bottom-page-builder-container attorna-container" >'; // attorna-content-area
				echo '<div class="attorna-bottom-page-builder-sidebar-wrap attorna-sidebar-style-none" >'; // attorna_get_sidebar_class
				echo '<div class="attorna-bottom-page-builder-sidebar-class" >'; // attorna_get_sidebar_wrap_class
				echo '<div class="attorna-bottom-page-builder-content attorna-item-pdlr" >'; // attorna_content_container
			}
		}
	}

	// social share
	if( attorna_get_option('general', 'blog-social-share', 'enable') == 'enable' ){
		if( class_exists('gdlr_core_pb_element_social_share') ){
			$share_count = (attorna_get_option('general', 'blog-social-share-count', 'enable') == 'enable')? 'counter': 'none';

			echo '<div class="attorna-single-social-share attorna-item-rvpdlr" >';
			echo gdlr_core_pb_element_social_share::get_content(array(
				'social-head' => $share_count,
				'style'=>'color',
				'layout'=>'right-text', 
				'text-align'=>'left',
				'facebook'=>attorna_get_option('general', 'blog-social-facebook', 'enable'),
				'linkedin'=>attorna_get_option('general', 'blog-social-linkedin', 'enable'),
				'google-plus'=>attorna_get_option('general', 'blog-social-google-plus', 'enable'),
				'pinterest'=>attorna_get_option('general', 'blog-social-pinterest', 'enable'),
				'stumbleupon'=>attorna_get_option('general', 'blog-social-stumbleupon', 'enable'),
				'twitter'=>attorna_get_option('general', 'blog-social-twitter', 'enable'),
				'email'=>attorna_get_option('general', 'blog-social-email', 'enable'),
				'padding-bottom'=>'0px'
			));
			echo '</div>';
		}
	}

	// tag for blog style 2
	echo '<div class="attorna-single-magazine-author-tags clearfix" >';
	echo get_the_term_list(get_the_ID(), 'post_tag', '', '' , '');
	echo '</div>';

	// prev - next post navigation
	if( attorna_get_option('general', 'blog-navigation', 'enable') == 'enable' ){
		$prev_post = get_previous_post();
		$prev_post_html = '';
		if( !empty($prev_post) ){
			$prev_post_html = get_previous_post_link(
				'<span class="attorna-single-nav attorna-single-nav-left">' . 
				'<span class="attorna-text attorna-title-font" >' . esc_html__( 'Previous Post', 'attorna' ) . '</span>' .
				'%link' . 
				'</span>',
				'<span class="attorna-single-nav-title attorna-title-font" >%title</span>'
				
			);
		}
		$next_post = get_next_post(); 
		$next_post_html = '';
		if( !empty($next_post) ){
			$next_post_html = get_next_post_link( 
				'<span class="attorna-single-nav attorna-single-nav-right">' . 
				'<span class="attorna-text attorna-title-font" >' . esc_html__( 'Next Post', 'attorna' ) . '</span>' . 
				'%link' . 
				'</span>',
				'<span class="attorna-single-nav-title attorna-title-font" >%title</span>'
			);
		}

		if( !empty($prev_post_html) || !empty($next_post_html) ){
			echo '<div class="attorna-single-nav-area clearfix" >' . $prev_post_html . $next_post_html . '<div class="attorna-single-nav-area-divider" ></div></div>';
		}
	}

	// author section
	$author_desc = get_the_author_meta('description');
	if( !empty($author_desc) && attorna_get_option('general', 'blog-author', 'enable') == 'enable' ){
		echo '<div class="attorna-single-author clearfix" >';
		echo '<div class="attorna-single-author-wrap" >';
		echo '<div class="attorna-single-author-avartar attorna-media-image">' . get_avatar(get_the_author_meta('ID'), 90) . '</div>';
		
		echo '<div class="attorna-single-author-content-wrap" >';
		echo '<div class="attorna-single-author-caption attorna-info-font" >' . esc_html__('About the author', 'attorna') . '</div>';
		echo '<h4 class="attorna-single-author-title">';
		the_author_posts_link();
		echo '</h4>';

		echo '<div class="attorna-single-author-description" >' . gdlr_core_escape_content(gdlr_core_text_filter($author_desc)) . '</div>';
		echo '</div>'; // attorna-single-author-content-wrap
		echo '</div>'; // attorna-single-author-wrap
		echo '</div>'; // attorna-single-author
	}

	// related post
	$enable_related_post = attorna_get_option('general', 'enable-related-post', 'enable');
	if( $enable_related_post == 'enable' && class_exists('gdlr_core_blog_style') ){
		
		$related_post_args = array(
			'blog-style' => attorna_get_option('general', 'related-post-blog-style', 'blog-column-with-frame'), // grid-with-frame
			'blog-column-style' => attorna_get_option('general', 'related-post-blog-column-style', 'style-2'), // grid-with-frame
			'thumbnail-size' => attorna_get_option('general', 'related-post-thumbnail-size', 'full'),
			'column-size' => attorna_get_option('general', 'related-post-column-size', '20'),
			'num-fetch' => attorna_get_option('general', 'related-post-num-fetch', '3'),
			'layout' => 'fitrows',
			'excerpt' => 'specify-number',
			'excerpt-number' => attorna_get_option('general', 'related-post-excerpt-number', '0'),
			'meta-option' => attorna_get_option('general', 'related-post-meta-option', array()),
			'frame-shadow-size' => array('x'=>'0', 'y'=>'0', 'size'=>'60px'),
			'frame-shadow-opacity' => '0.1',
			'frame-shadow-color' => '#000',
			'blog-title-font-size' => '14px'
		);

		// query related post
		$args = array('post_type' => 'post', 'suppress_filters' => false);
		$args['posts_per_page'] = $related_post_args['num-fetch'];
		$args['post__not_in'] = array(get_the_ID());
		$args['ignore_sticky_posts'] = 1;
		
		$related_terms = get_the_terms(get_the_ID(), 'post_tag');
		$related_tags = array();
		if( !empty($related_terms) ){
			foreach( $related_terms as $term ){
				$related_tags[] = $term->term_id;
			}
			$args['tax_query'] = array(array('terms'=>$related_tags, 'taxonomy'=>'post_tag', 'field'=>'id'));
		} 
		$query = new WP_Query($args);

		// print item
		if( $query->have_posts() ){

			$blog_style = new gdlr_core_blog_style();

			echo '<div class="attorna-single-related-post-wrap attorna-item-rvpdlr" >';
			echo '<h3 class="attorna-single-related-post-title attorna-item-mglr" >' . esc_html__('Related Posts', 'attorna') . '</h3>';
			
			$column_sum = 0;
			echo '<div class="gdlr-core-blog-item-holder clearfix" >';
			while( $query->have_posts() ){ $query->the_post();
				$additional_class  = ' gdlr-core-item-pdlr';
				$additional_class .= ' gdlr-core-column-' . $related_post_args['column-size'];

				if( $column_sum == 0 || $column_sum + intval($related_post_args['column-size']) > 60 ){
					$column_sum = intval($related_post_args['column-size']);
					$additional_class .= ' gdlr-core-column-first';
				}else{
					$column_sum += intval($related_post_args['column-size']);
				}
				echo '<div class="gdlr-core-item-list ' . esc_attr($additional_class) . '" >' . $blog_style->get_content($related_post_args) . '</div>';
			}
			echo '</div>'; // blog-item-holder
			echo '</div>'; // attorna-single-related-post-wrap

			wp_reset_postdata();
		}
	}

	// comments template
	if( comments_open() || get_comments_number() ){
		echo '<div class="attorna-comment-wrapper">';
		comments_template();
		echo '</div>';
	}	

	echo '</div>'; // attorna-content-area
	echo '</div>'; // attorna-get-sidebar-class

	// sidebar left
	if( $sidebar_type == 'left' || $sidebar_type == 'both' ){
		echo attorna_get_sidebar($sidebar_type, 'left', $sidebar_left);
	}

	// sidebar right
	if( $sidebar_type == 'right' || $sidebar_type == 'both' ){
		echo attorna_get_sidebar($sidebar_type, 'right', $sidebar_right);
	}

	echo '</div>'; // attorna-get-sidebar-wrap-class
 	echo '</div>'; // attorna-content-container

?>