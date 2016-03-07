<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

global $product;

$productID = get_the_ID();
$has_row = false;
$alt = 1;
$attributes = $product->get_attributes();

$temp_attributes = '';

asort($attributes);

if (isset($attributes['pa_gallery-location'])) {
  $temp_attributes = $attributes['pa_gallery-location'];
  unset($attributes['pa_gallery-location']);
  $attributes['pa_gallery-location'] = $temp_attributes;
}
ob_start();
?>
<table class="shop_attributes">

  <tr class="alt sku">
    <th><?php _e('SKU', 'woocommerce') ?></th>
    <td class="product_sku"><?php echo $product->get_sku(); ?></td>
  </tr>

  <?php if ($product->enable_dimensions_display()) : ?>

    <?php if ($product->has_weight()) : $has_row = true; ?>
      <?php /*
        <tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
        <th><?php _e( 'Weight', 'woocommerce' ) ?></th>
        <td class="product_weight"><?php echo $product->get_weight() . ' ' . esc_attr( get_option( 'woocommerce_weight_unit' ) ); ?></td>
        </tr> */ ?>
    <?php endif; ?>

    <?php if ($product->has_dimensions()) : $has_row = true; ?>
      <tr class="<?php if (( $alt = $alt * -1 ) == 1) echo 'alt'; ?>">
        <th><?php _e('Dimensions', 'woocommerce') ?></th>
        <td class="product_dimensions"><?php echo $product->get_dimensions(); ?></td>
      </tr>
    <?php endif; ?>

  <?php endif; ?>

  <?php
  foreach ($attributes as $attribute) :
    if (empty($attribute['is_visible']) || ( $attribute['is_taxonomy'] && !taxonomy_exists($attribute['name']) )) {
      continue;
    } else {
      $has_row = true;
    }
    ?>
    <tr class="<?php if (( $alt = $alt * -1 ) == 1) echo 'alt'; ?>">
      <th><?php echo wc_attribute_label($attribute['name']); ?></th>
      <td><?php
        if ($attribute['is_taxonomy']) {

          $values = wc_get_product_terms($product->id, $attribute['name'], array('fields' => 'names'));
          echo apply_filters('woocommerce_attribute', wpautop(wptexturize(implode(', ', $values))), $attribute, $values);
        } else {

          // Convert pipes to commas and display values
          $values = array_map('trim', explode(WC_DELIMITER, $attribute['value']));
          echo apply_filters('woocommerce_attribute', wpautop(wptexturize(implode(', ', $values))), $attribute, $values);
        }
        ?></td>
    </tr>
  <?php endforeach; ?>

</table>
<hr/>
<?php
if ($has_row) {
  echo ob_get_clean();
} else {
  ob_end_clean();
}


global $post;
?>


<?php if (is_user_logged_in()): ?>

  <div itemprop="description">
    <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt) ?>
  </div>

  <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

    <div class="clearfix">&nbsp;</div>

    <a class="btn btn-theme offers_button" data-toggle="modal" data-target="#myOfferModal">Make an Offer</a>
    <div class="clearfix">&nbsp;</div>
	
	<?php $price = $product->price;
		if(floatval($price) <= 25000): ?>
		
		<p class="price"><?php echo $product->get_price_html(); ?></p>
		<div class="clearfix">&nbsp;</div>
		
		<?php else: ?>
		
		<h1 class="price_on_request">Price available on request</h1>
		<div class="clearfix">&nbsp;</div>
		
	<?php endif; ?>
	
	<a class="btn btn-theme contact_purchase" data-toggle="modal" data-target="#contactToPurchaseModal">Contact Us</a>
	<div class="clearfix">&nbsp;</div>
  <!-- Modal -->
  <div class="modal" id="contactToPurchaseModal" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title">Contact Us</h4></center>
        </div>
        <div class="modal-body">
          <?php echo do_shortcode('[contact-form-7 id="2899" title="Contact To Purchase"]'); ?>        
        </div>
      </div>
    </div>
  </div>
        
	
	<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
	
    <meta itemprop="price" content="<?php echo esc_attr($product->get_price()); ?>" />
    <meta itemprop="priceCurrency" content="<?php echo esc_attr(get_woocommerce_currency()); ?>" />
    <link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />	
	
  </div>

<?php else: ?>

  <div itemprop="description">

    <div class="clearfix">&nbsp;</div>

    <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt) ?>
	
	<a href="<?php echo site_url(); ?>/my-account" class="btn btn-theme">Login to view price</a> &nbsp;&nbsp;&nbsp;

    <div class="clearfix">&nbsp;</div>
	
	
	<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
	
  </div>

<?php endif; ?>