<?php

add_action('init', 'wcpp_product_post');

function wcpp_product_post() {

	$labels = array(
		'name' => 'Products List',
		'singular_name' => 'Product List',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Product List',
		'edit' => 'Edit',
		'edit_item' => 'Edit Product List',
		'new_item' => 'New Product List',
		'view' => 'View',
		'view_item' => 'View Product List',
		'search_items' => 'Search Products List',
		'not_found' => 'No Products List Found',
		'not_found_in_trash' => 'No Products List Found',
		'parent_item_colon' => 'Parent Product List',
		'menu_name' => 'Products List'
	);
	register_post_type('products', array(

		'label' => 'Product',
		'labels' => $labels,
		'public' => true,
		'description' => 'Description for products',
		'supports' => ['title', 'editor', 'thumbnail', ],
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'menu_icon'             => 'dashicons-welcome-widgets-menus',
	) );
}