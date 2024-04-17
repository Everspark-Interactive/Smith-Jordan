<?php

	// declare woocommerce support
	add_action('after_setup_theme', 'attorna_woocommerce_support');
	if( !function_exists( 'attorna_woocommerce_support' ) ){
		function attorna_woocommerce_support(){
			add_theme_support( 'woocommerce', array(
			    'gallery_thumbnail_image_width' => 150,
			) );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		}
	}	

	// modify woocommerce wrapper
	remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	add_action('woocommerce_before_main_content', 'attorna_woocommerce_wrapper_start', 10);
	if( !function_exists( 'attorna_woocommerce_wrapper_start' ) ){
		function attorna_woocommerce_wrapper_start(){
			echo '<div class="attorna-content-container attorna-container">';
			echo '<div class="attorna-content-area attorna-item-pdlr attorna-sidebar-style-none clearfix" >';
		}
	}

	add_action('woocommerce_after_main_content', 'attorna_woocomemrce_wrapper_end', 10);
	if( !function_exists( 'attorna_woocomemrce_wrapper_end' ) ){
		function attorna_woocomemrce_wrapper_end(){
			echo '</div>'; // attorna-content-area
			echo '</div>'; // attorna-content-container
		}
	}

	// remove breadcrumbs on single product
	add_action('wp', 'attorna_init_woocommerce_hook');
	if( !function_exists( 'attorna_init_woocommerce_hook' ) ){
		function attorna_init_woocommerce_hook(){
			if( is_single() && get_post_type() == 'product' ){ 
				add_filter('woocommerce_product_description_heading', 'attorna_remove_woocommerce_tab_heading');
				add_filter('woocommerce_product_additional_information_heading', 'attorna_remove_woocommerce_tab_heading');

				remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
				remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
				remove_action('woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10);

				add_action('woocommerce_review_after_comment_text', 'woocommerce_review_display_rating', 10);
			}
		}
	}
	
	if( !function_exists( 'attorna_remove_woocommerce_tab_heading' ) ){
		function attorna_remove_woocommerce_tab_heading( $title ){
			return '';
		}
	}

	add_filter('woocommerce_review_gravatar_size', 'attorna_woocommerce_review_gravatar_size');
	if( !function_exists( 'attorna_woocommerce_review_gravatar_size' ) ){
		function attorna_woocommerce_review_gravatar_size( $size ){
			return 120;
		}
	}

	if( !function_exists('attorna_get_woocommerce_cart_title') ){
		function attorna_get_woocommerce_cart_title( $items = '' ){
			if( empty($items) ){
				global $woocommerce;
				$items = $woocommerce->cart->cart_contents_count;
			}

			$ret  = '<div class="attorna-top-cart-title" >' . esc_html__('You have', 'attorna') . ' ';
			if( $items == 1 ){
				$ret .= '<span class="attorna-highlight" >' . sprintf(esc_html__('%d item', 'attorna'), $items) . '</span>';
			}else{
				$ret .= '<span class="attorna-highlight" >' . sprintf(esc_html__('%d items', 'attorna'), $items) . '</span>';
			}
			$ret .= ' ' . esc_html__('in your cart', 'attorna');
			$ret .= '</div>'; // attorna-top-cart-title

			return $ret;
		}
	}
	if( !function_exists('attorna_get_woocommerce_cart_items') ){
		function attorna_get_woocommerce_cart_items(){
			global $woocommerce;

			$ret = '';
			$cart_items = $woocommerce->cart->get_cart();

			if( sizeOf($cart_items) > 0 ){

				$ret .= '<div class="attorna-top-cart-item-wrap" >';
				foreach( $cart_items as $cart_item_key => $cart_item ){

					$product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
					$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

					$product_name = apply_filters('woocommerce_cart_item_name', $product->get_title(), $cart_item, $cart_item_key);
					$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $product->get_image('thumbnail'), $cart_item, $cart_item_key);
					$product_quantity = apply_filters('woocommerce_widget_cart_item_quantity', $cart_item['quantity'], $cart_item, $cart_item_key);
					$product_price = apply_filters('woocommerce_cart_item_price', $woocommerce->cart->get_product_price($product), $cart_item, $cart_item_key);

					$ret .= '<div class="attorna-top-cart-item clearfix" >';
					$ret .= '<div class="attorna-top-cart-item-thumbnail attorna-media-image" ><a href="' . esc_url(get_permalink($product_id)) . '" >' . $thumbnail . '</a></div>';
					
					$ret .= '<div class="attorna-top-cart-item-content" >';
					$ret .= '<div class="attorna-top-cart-item-title" ><a href="' . esc_url(get_permalink($product_id)) . '" >' . $product_name . '</a></div>'; 
					$ret .= '<div class="attorna-top-cart-item-info" >' . $product_quantity . ' x ' . $product_price . '</div>'; 
					
					$ret .= apply_filters('woocommerce_cart_item_remove_link', sprintf(
						'<a href="%s" class="attorna-top-cart-item-remove" data-product_id="%s" data-product_sku="%s"><i class="fa fa-trash" ></i></a>',
						wc_get_cart_remove_url($cart_item_key), $product_id, $product->get_sku()
					), $cart_item_key);
					$ret .= '</div>';
					$ret .= '</div>';
				}

				$total_price = $woocommerce->cart->get_cart_total();
				$ret .= '<div class="attorna-top-cart-price-wrap" >';
				$ret .= '<span class="attorna-head" >' . esc_html__('Sub Total :', 'attorna') . '</span>';
				$ret .= '<span class="attorna-tail" >' . $total_price . '</span>';
				$ret .= '</div>'; // attorna-top-cart-price-wrap
				$ret .= '<div class="attorna-top-cart-item-divider" ></div>';

				$ret .= '<div class="attorna-top-cart-button-wrap attorna-center-align" >';
				$ret .= '<a class="attorna-top-cart-button attorna-button" href="' . esc_url(wc_get_cart_url()) . '" >';
				$ret .= esc_html__('View Cart', 'attorna');
				$ret .= '</a>';

				$ret .= '<a class="attorna-top-cart-button-2 attorna-button" href="' . esc_url(wc_get_checkout_url()) . '" >';
				$ret .= esc_html__('Check Out', 'attorna');
				$ret .= '</a>';
				$ret .= '</div>';
				$ret .= '</div>'; // attorna-top-cart-item-wrap
			}else{

				$ret .= '<div class="attorna-top-cart-item-wrap" >';
				$ret .= '<div class="attorna-top-cart-item-divider" ></div>';

				$ret .= '<div class="attorna-top-cart-button-wrap attorna-center-align" >';
				$ret .= '<a class="attorna-top-cart-button-2 attorna-button" href="' . esc_url(get_permalink(wc_get_page_id('shop'))) . '" >';
				$ret .= esc_html__('Go To Shopping', 'attorna');
				$ret .= '</a>';
				$ret .= '</div>';

				$ret .= '</div>';
			}


			return $ret;
		}
	}
	if( !function_exists('attorna_get_woocommerce_cart_size') ){
		function attorna_get_woocommerce_cart_size(){
			global $woocommerce;
			return sizeOf($woocommerce->cart->get_cart());
		}
	}
	if( !function_exists('attorna_get_woocommerce_bar') ){
		function attorna_get_woocommerce_bar(){

			global $woocommerce;
			
			if(!empty($woocommerce)){
				$items = $woocommerce->cart->cart_contents_count;

				echo '<span class="attorna-top-cart-count" >' . $items . '</span>';

				echo '<div class="attorna-lightbox-content-wrap attorna-top-cart-content-wrap" data-attorna-lb-id="top-bar" >';
				echo '<i class="icon_close attorna-lightbox-close" ></i>';
				echo attorna_get_woocommerce_cart_title($items);

				echo attorna_get_woocommerce_cart_items();

				echo '</div>'; // attorna-lightbox-content-wrap 
			}
		}
	}

	add_filter('woocommerce_add_to_cart_fragments', 'attorna_woocommerce_cart_ajax');
	if( !function_exists('attorna_woocommerce_cart_ajax') ){
		function attorna_woocommerce_cart_ajax($fragments){
			global $woocommerce;

			$fragments['span.attorna-top-cart-count'] = '<span class="attorna-top-cart-count">' . $woocommerce->cart->cart_contents_count . '</span>'; 
			
			return $fragments;
		}
	}	

	add_action('wp_ajax_top_bar_woocommerce_cart', 'attorna_top_bar_woocommerce_cart_ajax');
	add_action('wp_ajax_nopriv_top_bar_woocommerce_cart', 'attorna_top_bar_woocommerce_cart_ajax');
	if( !function_exists('attorna_top_bar_woocommerce_cart_ajax') ){
		function attorna_top_bar_woocommerce_cart_ajax(){
			die(json_encode(array(
				'title' => attorna_get_woocommerce_cart_title(),
				'cart-items' => attorna_get_woocommerce_cart_items()
			)));
		}
		
	}

	add_filter('woocommerce_output_related_products_args', 'attorna_related_products_args');
	if( !function_exists('attorna_related_products_args') ){
		function attorna_related_products_args($args){
			if( class_exists('gdlr_core_pb_element_product') ){
				$num_fetch = attorna_get_option('general', 'woocommerce-related-product-num-fetch', '4');
				$args['posts_per_page'] = $num_fetch;
			}
			
			return $args;
		}
	}