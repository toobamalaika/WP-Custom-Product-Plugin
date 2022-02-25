<?php

add_action('init', 'wcpp_product_post');

function wcpp_product_post() {

	// register post for product
	$labels_post = array(
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
		'labels' => $labels_post,
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

	// register taxonomy for category of products

	$taxonomies = array(
		array(
			'slug'         => 'product-categories',
			'single_name'  => 'Category',
			'plural_name'  => 'Categories',
			'post_type'    => 'products',
			'rewrite'      => array( 'slug' => 'categories' ),
		),
		array(
			'slug'         => 'product-tags',
			'single_name'  => 'Tag',
			'plural_name'  => 'Tags',
			'post_type'    => 'products',
			'rewrite'      => array( 'slug' => 'tags' ),
		),
	);

	foreach( $taxonomies as $taxonomy ) {
		$labels = array(
			'name' => $taxonomy['plural_name'],
			'singular_name' => $taxonomy['single_name'],
			'search_items' =>  'Search ' . $taxonomy['plural_name'],
			'all_items' => 'All ' . $taxonomy['plural_name'],
			'parent_item' => 'Parent ' . $taxonomy['single_name'],
			'parent_item_colon' => 'Parent ' . $taxonomy['single_name'] . ':',
			'edit_item' => 'Edit ' . $taxonomy['single_name'],
			'update_item' => 'Update ' . $taxonomy['single_name'],
			'add_new_item' => 'Add New ' . $taxonomy['single_name'],
			'new_item_name' => 'New ' . $taxonomy['single_name'] . ' Name',
			'menu_name' => $taxonomy['plural_name']
		);
		
		$rewrite = isset( $taxonomy['rewrite'] ) ? $taxonomy['rewrite'] : array( 'slug' => $taxonomy['slug'] );
		$hierarchical = isset( $taxonomy['hierarchical'] ) ? $taxonomy['hierarchical'] : true;

		$labels_taxonomy = array(
			'hierarchical' => $hierarchical,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => $rewrite,
			'public' => true,
		);
	
		register_taxonomy($taxonomy['slug'], $taxonomy['post_type'], $labels_taxonomy);
	}
}