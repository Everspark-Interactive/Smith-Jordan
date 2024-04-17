<?php
	/*	
	*	Goodlayers Utility File
	*	---------------------------------------------------------------------
	*	This file contains utility function in the theme
	*	---------------------------------------------------------------------
	*/
	
	// a comment callback function to create comment list
	if ( !function_exists('attorna_comment_list') ){
		function attorna_comment_list( $comment, $args, $depth ){

			$GLOBALS['comment'] = $comment;

			if ( 'div' == $args['style'] ) {
			    $tag = 'div';
			    $add_below = 'comment';
			} else {
			    $tag = 'li';
			    $add_below = 'div-comment';
			}

?>
<<?php echo esc_html($tag); ?> <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<article id="comment-<?php comment_ID(); ?>" class="comment-article">
		<div class="comment-avatar"><?php echo get_avatar( $comment, 90 ); ?></div>
		<div class="comment-body">
			<header class="comment-meta">
				<div class="comment-author attorna-title-font"><?php echo get_comment_author_link(); ?></div>
				<div class="comment-time attorna-info-font">
					<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
						<time datetime="<?php echo get_comment_time('c'); ?>">
							<?php echo get_comment_date() . ' ' . esc_html__('at', 'attorna') . ' ' . get_comment_time(); ?>
						</time>
					</a>
				</div>
			<div class="comment-reply">
				<?php comment_reply_link(array_merge($args, array(
					'reply_text' => esc_html__('Reply', 'attorna'), 
					'depth' => $depth, 
					'max_depth' => $args['max_depth'])
				)); ?>
			</div><!-- reply -->					
			</header>

			<?php if( '0' == $comment->comment_approved ){ ?>
				<p class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'attorna' ); ?></p>
			<?php } ?>

			<section class="comment-content">
				<?php comment_text(); ?>
				<?php edit_comment_link( esc_html__( 'Edit', 'attorna' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- comment-content -->

		</div><!-- comment-body -->
	</article><!-- comment-article -->
<?php

		}
	}
	
	// use to clear an option for customize page
	if( !function_exists('attorna_clear_option') ){
		function attorna_clear_option(){
			$options = array('general', 'typography', 'color', 'plugin');

			foreach( $options as $option ){
				unset($GLOBALS['attorna_' . $option]);
			}
			
		}
	}
	
	// get option for uses
	if( !function_exists('attorna_get_option') ){
		function attorna_get_option($option, $key = '', $default = ''){
			$option = 'attorna_' . $option;
			
			if( empty($GLOBALS[$option]) ){
				$GLOBALS[$option] = get_option($option, '');
			}
				
			if( !empty($key) ){
				if( !empty($GLOBALS[$option][$key]) || (isset($GLOBALS[$option][$key]) && $GLOBALS[$option][$key] === '0') ){
					return $GLOBALS[$option][$key];
				}else{
					return $default;
				}
			}else{
				return $GLOBALS[$option];
			}
		}
	}

	// set option for temporary uses
	if( !function_exists('attorna_set_option') ){
		function attorna_set_option($option, $key = '', $value = ''){
			$option = 'attorna_' . $option;
			
			if( empty($GLOBALS[$option]) ){
				$GLOBALS[$option] = get_option($option, '');
			}
				
			if( !empty($key) ){
				if( !empty($GLOBALS[$option][$key]) ){
					$GLOBALS[$option][$key] = $value;
				}
			}
		}
	}

	// get post option for uses
	if( !function_exists('attorna_get_post_option') ){
		function attorna_get_post_option( $post_id, $key = 'gdlr-core-page-option' ){

			global $attorna_post_option;

			if( empty($attorna_post_option['id']) || $attorna_post_option['id'] != $post_id || 
				empty($attorna_post_option['key']) || $attorna_post_option['key'] != $key ){

				$attorna_post_option = array(
					'id' => $post_id,
					'key' => $key,
					'option' => get_post_meta($post_id, $key, true)
				);
			}

			return empty($attorna_post_option['option'])? array(): $attorna_post_option['option'];
		}
	}

	// get blog info :: originate from gdlr core plugin
	if( !function_exists('attorna_get_blog_info') ){
		function attorna_get_blog_info($args){
			
			$blog_info_prefix = array(
				'date' => '<i class="icon_clock_alt" ></i>',
				'tag' => '<i class="icon_tags_alt" ></i>',
				'category' => '<i class="icon_folder-alt" ></i>',
				'comment' => '<i class="icon_comment_alt" ></i>',
				'like' => '<i class="icon_heart_alt" ></i>',
				'author' => '<i class="icon_documents_alt" ></i>',
				'comment-number' => '<i class="icon_comment_alt" ></i>',
			);

			$ret = '';
			
			if( !empty($args['display']) ){
				foreach( $args['display'] as $blog_info ){
					
					$ret_temp = '';
					
					switch( $blog_info ){
						case 'date':
							$ret_temp .= '<a href="' . get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')) . '">';
							$ret_temp .= get_the_date();
							$ret_temp .= '</a>';
							break;
							
						case 'tag':
							$ret_temp .= get_the_term_list(get_the_ID(), 'post_tag', '', '<span class="gdlr-core-sep">,</span> ' , '');							
							break;
							
						case 'category':
							$ret_temp .= get_the_term_list(get_the_ID(), 'category', '', '<span class="gdlr-core-sep">,</span> ' , '' );;					
							break;
							
						case 'comment-number':
							$ret_temp .= get_comments_number() . ' ';
							break;
						
						case 'comment':
							ob_start();
							comments_number(
								esc_html__('no comments', 'attorna'), 
								esc_html__('one comment', 'attorna'), 
								esc_html__('% comments', 'attorna') 
							);
							$ret_temp .= '<a href="' . get_permalink() . '#respond" >';
							$ret_temp .= ob_get_contents();
							$ret_temp .= '</a>';
							ob_end_clean();								
							break;
							
						case 'author':
							ob_start();
							echo '<span class="fn" >';
							the_author_posts_link();
							echo '</span>';
							$ret_temp .= ob_get_contents();
							ob_end_clean();					
							break;
					} // switch
					
					if( !empty($ret_temp) ){
						
						$ret .= '<div class="attorna-blog-info attorna-blog-info-font'; 
						$ret .= ' attorna-blog-info-' . esc_attr($blog_info); 
						if( $blog_info == 'date' ){
							$ret .= ' post-date updated';
						}else if( $blog_info == 'author' ){
							$ret .= ' vcard author post-author';
						}
						$ret .= ' ">';
						if( !empty($args['separator']) ){
							$ret .= '<span class="attorna-blog-info-sep" >' . $args['separator'] . '</span>';
						}
						if( (!isset($args['icon']) || $args['icon'] !== false) && !empty($blog_info_prefix[$blog_info]) ){
							$ret .= '<span class="attorna-head" >' . $blog_info_prefix[$blog_info] . '</span>';
						}
						$ret .= $ret_temp;
						$ret .= '</div>';
					}
					
				} // foreach
			} // $args['display']
			
			if( !empty($ret) && !empty($args['wrapper']) ){
				$ret = '<div class="attorna-blog-info-wrapper" >' . $ret . '</div>';
			}
			return $ret;
		}
	}

	// get the sidebar
	if( !function_exists('attorna_get_sidebar_wrap_class') ){
		function attorna_get_sidebar_wrap_class($sidebar_type){
			return ' attorna-sidebar-wrap clearfix attorna-line-height-0 attorna-sidebar-style-' . $sidebar_type;
		}
	}
	if( !function_exists('attorna_get_sidebar_class') ){
		function attorna_get_sidebar_class($args){

			// set default column
			if( empty($args['column']) ){
				if( $args['sidebar-type'] == 'both' ){
					$args['column'] = attorna_get_option('general', 'both-sidebar-width', 15);
				}else if( $args['sidebar-type'] == 'left' || $args['sidebar-type'] == 'right' ){
					$args['column'] = attorna_get_option('general', 'sidebar-width', 20);
				}else{
					$args['column'] = 60;
				}
			}

			// if center section
			if( $args['section'] == 'center' ){
				if( $args['sidebar-type'] == 'both' ){
					$args['column'] = 60 - (2 * intval($args['column']));
				}else if( $args['sidebar-type'] == 'left' || $args['sidebar-type'] == 'right' ){
					$args['column'] = 60 - intval($args['column']);
				}
			}

			$sidebar_class  = ' attorna-sidebar-' . $args['section'];
			$sidebar_class .= ' attorna-column-' . $args['column'];
			$sidebar_class .= ' attorna-line-height';

			return $sidebar_class; 
		}
	}
	if( !function_exists('attorna_get_sidebar') ){
		function attorna_get_sidebar($sidebar_type, $section, $sidebar_id){

			echo '<div class="' . esc_attr(attorna_get_sidebar_class(array('sidebar-type'=>$sidebar_type, 'section'=>$section))) . ' attorna-line-height" >';
			echo '<div class="attorna-sidebar-area attorna-item-pdlr" >';
			if( is_active_sidebar($sidebar_id) ){ 
				dynamic_sidebar($sidebar_id); 
			}
			echo '</div>';
			echo '</div>';

		}
	}

	// overlay menu
	if( !function_exists('attorna_is_top_search') ){
		function attorna_is_top_search(){
			global $is_top_search;
			return empty($is_top_search)? false: true;
		}
	}
	if( !function_exists('attorna_get_top_search') ){
		function attorna_get_top_search(){
			global $is_top_search;
			$is_top_search = true;
?>
<div class="attorna-top-search-wrap" >
	<div class="attorna-top-search-close" ></div>

	<div class="attorna-top-search-row" >
		<div class="attorna-top-search-cell" >
			<?php get_search_form() ?>
		</div>
	</div>

</div>
<?php
			$is_top_search = false;
		}
	}