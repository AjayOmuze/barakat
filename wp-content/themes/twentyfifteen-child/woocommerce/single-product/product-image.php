<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;
$large_image = array();
?>
<div class="images main_image">
  <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">

    <?php
    if (has_post_thumbnail()) {

      $large_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
      $image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
      $image_caption = get_post(get_post_thumbnail_id())->post_excerpt;
      $image_link = wp_get_attachment_url(get_post_thumbnail_id());
      $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'product_shop_single');

      $attachment_count = count($product->get_gallery_attachment_ids());

      if ($attachment_count > 0) 
      {
        $gallery = '[product-gallery]';
      } 
      else 
      {
        $gallery = '';
      }
      echo apply_filters('woocommerce_single_product_image_html', sprintf('<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"' . $gallery . '"><img src="%s" class="img-responsive" /></a>', $large_image[0], $image_caption, $image[0]), $post->ID);      
    } 
    else 
    {

      echo apply_filters('woocommerce_single_product_image_html', sprintf('<img src="%s" alt="%s" />', wc_placeholder_img_src(), __('Placeholder', 'woocommerce')), $post->ID);
    }
    ?>

    <div class="zoom_image"><a href="#">Zoom</a></div>
	
  </div>

	  <?php if(isset($large_image[0])): ?>
	  
		<a class="fancybox fancy_thumb" rel="group" href="<?php echo $large_image[0]; ?>"></a>

	  <?php endif; ?>
	  
  <?php do_action('woocommerce_product_thumbnails'); ?>

</div>
