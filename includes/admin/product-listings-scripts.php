<?php

add_action('init', 'wcpp_admin_scripts');

function wcpp_admin_scripts() {

	if ( is_admin() ) {

		wp_enqueue_style('wcpp-bootstrap-css', plugin_dir_url( __FILE__ ). '../assets/plugin/bootstrap/css/bootstrap.css');
		wp_enqueue_style('wcpp-custom-style', plugin_dir_url( __FILE__ ). '../assets/css/admin-style.css');
		wp_enqueue_script('wcpp-bootstrap-js', plugin_dir_url( __FILE__ ). '../assets/plugin/bootstrap/js/bootstrap.js');
	} else {

		wp_enqueue_style('wcpp-bootstrap-css', plugin_dir_url( __FILE__ ). '../assets/plugin/bootstrap/css/bootstrap.css');
		wp_enqueue_style('wcpp-fontawsome-css', plugin_dir_url( __FILE__ ). '../assets/plugin/fontawesome/css/all.css');
		wp_enqueue_style('wcpp-custom-style', plugin_dir_url( __FILE__ ). '../assets/css/style.css');

		wp_enqueue_script('wcpp-bootstrap-js', plugin_dir_url( __FILE__ ). '../assets/plugin/bootstrap/js/bootstrap.js', [ 'jquery' ]);

		wp_enqueue_script('wcpp-functioanl-js', plugin_dir_url( __FILE__ ). '../assets/js/main.js', [ 'jquery' ]);
	}
}