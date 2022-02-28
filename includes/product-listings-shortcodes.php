<?php
add_action('init', 'wcpp_product_shortcode');

function wcpp_product_shortcode() {
	add_shortcode('shop-page', 'wcpp_shop_page_shortcode');
}

function wcpp_shop_page_shortcode($atts, $content = '') {
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
	$content .= '<div class="product-section">
					<div class="two">
						<h1 class="text-capitalize">Products List
					    	<span>Explore!</span>
					  	</h1>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="panel panel-info">
  								<div class="panel-heading">Panel heading</div>
  								<ul class="list-group">
  									<button class="btn btn-link filter-button active w-100 text-left" data-filter="all">All</button>';
  								foreach($categories as $category) {									$content .= '<button class="btn btn-link filter-button active w-100 text-left" data-filter="' . ($category->slug). '">'.$category->name.'</button>';
								}
  								$content .= '</ul>
							</div>
						</div>';

					if($query->have_posts()) {
					$content .= '<div class="col-md-8">
							<div class="row">';
								while($query->have_posts()) {
									$query->the_post();
									$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail' );
									$termsArray = get_the_terms($post->ID, 'product-categories');
									$termsSlug = "";
									foreach($termsArray as $term) {
										$termsSlug .= $term->slug." ";
									}
									$content .= '<div class="col-md-6">
													<div class="product filter '.$termsSlug.'">
													    <div class="image-box">
													      	<img class="images" src="'.$image[0].'"/>
													    </div>
													    <div class="text-box">
													      <h2 class="item">'. get_the_title() .'</h2>
													      <h3 class="price">'.get_post_meta( get_the_ID(), '_price', true ).'</h3>
													      <p class="description">'.get_the_content() .'</p>
													      <a thref="" class="btn btn-primary w-100">Details</a>
													    </div>
				  									</div>
												</div>';
								}
								wp_reset_postdata();
							$content .= '</div>';
								if($atts['posts_per_page'] > 0 ) {
									$content .= '<div class="product-pagination">';
									$content .= get_next_posts_link('Older Product', $query->max_num_pages);
									$content .= get_previous_posts_link('Newer Product', $query->max_num_pages);
									$content .= '</div>';
								}
							$content .= '</div>';
					} else {
						$content .= '<div class="col-md-8">
										<div class="row">
											<div class="text-center alert alert-info" role="alert">
													No Products Found!
											</div>
										</div>
									</div>';
					}
	$content .=	'</div> 
			</div>';

	// if($query->have_posts()) {
	// 	$content .= '<div class="row product-section">
	// 						<div class="two">
	// 							<h1 class="text-capitalize">Products List
	// 						    	<span>Explore!</span>
	// 						  	</h1>
	// 						</div>
	//   						<div class="col-md-4">.col-md-4</div>
	//   						<div class="col-md-8">
	//   							<div class="row">
	//   								';
	// 										while($query->have_posts()) {
	// 											$query->the_post();
	// 											$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail' );
	// 											$content .= '<div class="col-md-4 product-card">
	// 						  									<div class="listing-section">
	// 						  										<div class="product '.get_the_ID().'">
	// 															    <div class="image-box">
	// 															      <img class="images" src="'.$image[0].'"/>
	// 															    </div>
	// 															    <div class="text-box">
	// 															      <h2 class="item">'. get_the_title() .'</h2>
	// 															      <h3 class="price">'.get_post_meta( get_the_ID(), '_price', true ).'</h3>
	// 															      <p class="description">'.substr(get_the_content(), 0, 40) . '...'.'</p>
	// 															      <a thref="" class="btn btn-primary w-100">Details</a>
	// 															    </div>
	// 															    </div>
	// 															  </div>
	// 														</div></div>';
	// 											$content .= '';
	// 										}
	// 										wp_reset_postdata();
	// 										if($atts['posts_per_page'] > 0 ) {
	// 											$content .= get_next_posts_link('Older Product', $query->max_num_pages);
	// 											$content .= get_previous_posts_link('Newer Product', $query->max_num_pages);
	// 										}
	// 								$content .= '
	//   							</div>
	//   						</div>
	// 					</div>
	// 				</div>';
	// } else {
	// 	$content .= '<p>No Product Fount</p>';
	// }

	return $content;
 
}