<?php
if(!class_exists('Wcpp_Field')) {
	
	class Wcpp_Field {
		public function __construct() {

			add_action('save_post', [ $this, 'wcpp_save_product']);
			add_action('admin_init', [ $this, 'wcpp_add_metabox']);

		}

		public function wcpp_add_metabox() {
			// add price sku fields for custom post type
			add_meta_box('product_metabox', 'Product Other Field', [ $this, 'wcpp_product_metabox'], ['products']);
		}

		// callback funcion for add meta box
		public function wcpp_product_metabox($post) { 

			$_price = get_post_meta($post->ID, '_price', true) ? get_post_meta($post->ID, '_price', true) : '' ;
			$_sku = get_post_meta($post->ID, '_sku', true) ? get_post_meta($post->ID, '_sku', true) : '' ;
			?>
			<form>

				<div class="form-group">
			    	<label for="_price">Product Price</label>
			    	<input required name="_price" type="text" class="form-control" id="_price" placeholder="Enter Price" value="<?php echo $_price; ?>">
			  	</div>

			  	<div class="form-group">
			    	<label for="_sku">Product SKU</label>
			    	<input required name="_sku" type="text" class="form-control" id="_sku" placeholder="Enter SKU" value="<?php echo $_sku; ?>">
			  	</div>

			</form>

			<?php
		}

		public function wcpp_save_product($post_id) {

			if( array_key_exists('_price', $_POST) && array_key_exists('_sku', $_POST) ) {
				update_post_meta($post_id, '_price', $_POST['_price']);
				update_post_meta($post_id, '_sku', $_POST['_sku']);
			}
		}

	}
}

new Wcpp_Field();