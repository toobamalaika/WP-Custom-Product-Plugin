<?php

if(!class_exists('Wcpp_Shortcode')) {
	
	class Wcpp_Shortcode {

		public function __construct() {
			add_action('init', [ $this, 'wcpp_product_shortcode']);
		}

		// add shortcode functionality
		public function wcpp_product_shortcode() {
			add_shortcode('shop-page', [ $this, 'wcpp_shop_page_shortcode']);
		}

		// callback function for shortcode attributes
		public function wcpp_shop_page_shortcode($atts, $content = '') {
			global $post;
			$atts = shortcode_atts(array(
				'title' => 'Latest Product',
				'count' => 12,
				'pagination' => 'off',
				'posts_per_page' => -1
			), 
			$atts, 'shop-page');

			$pagination = $atts['pagination'] == 'on' ? false : true ;
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;

			$args = array(
				'post_type' => 'products',
				'post_status' => 'publish',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'not_found_rows' => $pagination,
				'posts_per_page' => $atts['count'],
				'paged' => $paged,
				'posts_per_page' => $atts['posts_per_page']
			);

			$query = new WP_Query($args);
			$categories = get_terms('product-categories', 'orderby=none&hide_empty');

			// load front shop page for view
			include WCPP_PATH . "/views/front/shop-page.php";

			return $content;
		 
		}

	}
}

new Wcpp_Shortcode();