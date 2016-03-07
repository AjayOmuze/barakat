<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ($attachment_ids) {
  $loop = 0;
  $columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
  ?>
  <div class="thumbnails <?php echo 'columns-' . $columns; ?>">

    <div class="owl-carousel owl-carousel-thumnails mtop30">    

		<?php $main_thumbnail_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail'); ?>
		<?php $main_large_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
		<?php $main_shop_single_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'product_shop_single'); ?>
		
		<?php if(isset($main_thumbnail_image[0])): $main_thumbnail_image = $main_thumbnail_image[0] ?>
			<div class="item">    
				
				<a href="<?php echo $main_large_image[0]; ?>" data-standard="<?php echo $main_shop_single_image[0]; ?>">
					<img class="img-responsive" src="<?php echo $main_thumbnail_image; ?>" />
				</a>			
				
			</div>
			
		<?php endif; ?>	
		
      <?php
      foreach ($attachment_ids as $attachment_id) {
        ?>
        <div class="item">    
          <?php
          $classes = array('zoom', 'img-responsive');

          if ($loop == 0 || $loop % $columns == 0)
            $classes[] = 'first';

          if (( $loop + 1 ) % $columns == 0)
            $classes[] = 'last';

          $large_image = wp_get_attachment_image_src($attachment_id, 'full');
          $standard_image = wp_get_attachment_image_src($attachment_id, 'product_shop_single');
          $image_link = wp_get_attachment_url($attachment_id);

          if (!$image_link)
            continue;

          $image_title = esc_attr(get_the_title($attachment_id));
          $image_caption = esc_attr(get_post_field('post_excerpt', $attachment_id));

          $image = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'), 0, $attr = array(
              'title' => $image_title,
              'alt' => $image_title,
              'class' => 'img-responsive'
          ));

          $image_class = esc_attr(implode(' ', $classes));

          echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<a href="%s" data-standard="%s">%s</a><a class="fancybox fancy_thumb" rel="group" href="%s"></a>', $large_image[0], $standard_image[0], $image, $large_image[0]), $attachment_id, $post->ID, $image_class);

          $loop++;
          ?>
        </div>
        <?php
      }
      ?>
    </div>  

 
  </div>
    <div class="thumnails-arrow">                            
      <div class="thumnails-left-arrow" data-class="owl-prev"><i class="fa fa-angle-left"></i></div>                
      <div class="thumnails-right-arrow" data-class="owl-next"><i class="fa fa-angle-right"></i></div>  
    </div>
    
  <?php
}
