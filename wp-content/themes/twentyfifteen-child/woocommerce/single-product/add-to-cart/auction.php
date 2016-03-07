<?php
/**
 * Auction product add to cart
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post;
if ( ! $product->is_purchasable() OR ! $product->is_sold_individually() OR ! $product->is_in_stock() OR $product->is_closed() ) return;

if(is_user_logged_in()):
?>

<?php do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="buy-now cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>">
	<?php 
	    
	    do_action('woocommerce_before_add_to_cart_button');
        
	 	if ( ! $product->is_sold_individually() )
	 			woocommerce_quantity_input( array(
	 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
	 			) );
	 ?>

 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text',sprintf(__( 'Buy now for %s', 'wc_simple_auctions' ),woocommerce_price($product->regular_price)), $product->product_type); ?></button>
	
	<div>
		<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
		<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
	</div>

	<?php do_action('woocommerce_after_add_to_cart_button'); ?>

</form>

<?php do_action('woocommerce_after_add_to_cart_form'); endif; ?>