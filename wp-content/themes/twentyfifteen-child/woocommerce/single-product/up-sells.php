<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if (sizeof($upsells) == 0) {
  return;
}

$meta_query = WC()->query->get_meta_query();

$args = array(
    'post_type' => 'product',
    'ignore_sticky_posts' => 1,
    'no_found_rows' => 1,
    'posts_per_page' => $posts_per_page,
    'orderby' => $orderby,
    'post__in' => $upsells,
    'post__not_in' => array($product->id),
    'meta_query' => $meta_query
);

$products = new WP_Query($args);

$woocommerce_loop['columns'] = $columns;

if ($products->have_posts()) :
  ?>
	<div class="clearfix">&nbsp;</div>
	
  <div class="upsells products container">

	<h2 class="related-header-title">
        <?php _e('You may also like&hellip;', 'woocommerce') ?>
        <div class="upsells-arrow-area">                            
			<div class="upsells-arrow" data-class="owl-prev"><i class="fa fa-angle-left"></i></div>                
			<div class="upsells-arrow leftMargin" data-class="owl-next"><i class="fa fa-angle-right"></i></div>  
        </div>
    </h2>

	<div style="max-width: 100% !important;overflow: hidden !important;">
	
		<div class="owl-carousel owl-carousel-upsells-products">

		<?php while ($products->have_posts()) : $products->the_post(); ?>

				<div class="item">
					
					<?php if(has_post_thumbnail()): ?>
						
						<a title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>">
							<?php the_post_thumbnail('thumbnail'); ?>                                    
						</a>
					
					<?php endif; ?>
					
					<div class="clearfix">&nbsp;</div>
					
					<a title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>" class="related-title">
						<?php the_title(); ?>
					</a>
				</div>

		<?php endwhile; // end of the loop. ?>
		
		</div>
	
	</div>
  </div>

<?php
endif;

wp_reset_postdata();
