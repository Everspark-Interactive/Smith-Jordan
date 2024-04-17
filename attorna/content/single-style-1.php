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
	
	if( $sidebar_type == 'left' && !is_active_sidebar($sidebar_left) ){
		$sidebar_type = 'none';
	}
	if( $sidebar_type == 'right' && !is_active_sidebar($sidebar_right) ){
		$sidebar_type = 'none';
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
				'layout'=>'left-text', 
				'text-align'=>'center',
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

	// author section
	$author_desc = get_the_author_meta('description');
	if( !empty($author_desc) && attorna_get_option('general', 'blog-author', 'enable') == 'enable' ){
		echo '<div class="clear"></div>';
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

	// prev - next post navigation
	if( attorna_get_option('general', 'blog-navigation', 'enable') == 'enable' ){
		$prev_post = get_previous_post_link(
			'<span class="attorna-single-nav attorna-single-nav-left">%link</span>',
			'<i class="arrow_left" ></i><span class="attorna-text" >' . esc_html__( 'Prev', 'attorna' ) . '</span>'
		);
		$next_post = get_next_post_link(
			'<span class="attorna-single-nav attorna-single-nav-right">%link</span>',
			'<span class="attorna-text" >' . esc_html__( 'Next', 'attorna' ) . '</span><i class="arrow_right" ></i>'
		);
		if( !empty($prev_post) || !empty($next_post) ){
			echo '<div class="attorna-single-nav-area clearfix" >' . $prev_post . $next_post . '</div>';
		}
	}

	// comments template
	if( comments_open() || get_comments_number() ){
		comments_template();
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