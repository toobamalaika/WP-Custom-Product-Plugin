<?php

defined('ABSPATH') || die ("You can't access this directory!");

if(!class_exists('Wcpp_Load')) {

	class Wcpp_Load {

		public function __construct() {

			if ( is_admin() ) {
				//inluding all admin classes
				include_once 'admin/product-listings-cpt.php';
				include_once 'admin/product-listings-fields.php';
			} else {
				// including all front classes
				include_once 'front/wcpp_product_list.php';
			}
			
			add_action('init', [ $this, 'wcpp_admin_scripts' ]);
        }

        function wcpp_admin_scripts() {

			if ( is_admin() ) {
				// scripts load if user is admin
				wp_enqueue_style('wcpp-bootstrap-css',  WCPP_URL . 'assets/plugin/bootstrap/css/bootstrap.css');
				wp_enqueue_style('wcpp-custom-style', WCPP_URL . 'assets/css/admin-style.css');
				wp_enqueue_script('wcpp-bootstrap-js', WCPP_URL . 'assets/plugin/bootstrap/js/bootstrap.js');
			} else {
				// scripts load without login
				wp_enqueue_style('wcpp-bootstrap-css', WCPP_URL. 'assets/plugin/bootstrap/css/bootstrap.css');
				wp_enqueue_style('wcpp-fontawsome-css', WCPP_URL. 'assets/plugin/fontawesome/css/all.css');
				wp_enqueue_style('wcpp-custom-style', WCPP_URL. 'assets/css/style.css');
				wp_enqueue_script('wcpp-bootstrap-js', WCPP_URL. 'assets/plugin/bootstrap/js/bootstrap.js', [ 'jquery' ]);
				wp_enqueue_script('wcpp-functioanl-js', WCPP_URL. 'assets/js/main.js', [ 'jquery' ]);
			}
		}

	}
}

new Wcpp_Load();