<?php

add_action('admin_init', 'wcpp_admin_scripts');

function wcpp_admin_scripts() {

	if ( is_admin() ) {

		wp_enqueue_style('wcpp-bootstrap-css', plugin_dir_url( __FILE__ ). '../assets/plugin/bootstrap/css/bootstrap.css');
		wp_enqueue_style('wcpp-custom-style', plugin_dir_url( __FILE__ ). '../assets/css/style.css');
		wp_enqueue_script('wcpp-bootstrap-js', plugin_dir_url( __FILE__ ). '../assets/plugin/bootstrap/js/bootstrap.js');
	}
}