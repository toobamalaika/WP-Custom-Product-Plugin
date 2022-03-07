<?php
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
		  								if(isset($categories)) {
		  									foreach($categories as $category) {
			  									$content .= '<button class="btn btn-link filter-button active w-100 text-left" data-filter="' . $category['slug']. '">'.$category->name.'</button>';
											}
		  								}
		  								
										// $get_prices = get_post_meta();
		  								$content .= '<select class="form-control filter-select" id="filter-select">
		  															<option selected >Select Price</option>
		  															</select></ul>
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
															<div class="product filter '.$termsSlug.get_post_meta( get_the_ID(), '_price', true ).'">
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