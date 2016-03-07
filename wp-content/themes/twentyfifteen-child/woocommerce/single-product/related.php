<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$posts_per_page = 6;

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'post_status' => array('publish'),
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

        <div class="clearfix">&nbsp;</div>
	<div class="container related-product-section">
		<h2 class="related-header-title">
                    <?php _e( 'You may also be interested in the following artifacts', 'woocommerce' ); ?>
        <div class="related-arrow-area">                            
                    <div class="related-arrow" data-class="owl-prev"><i class="fa fa-angle-left"></i></div>                
                    <div class="related-arrow leftMargin" data-class="owl-next"><i class="fa fa-angle-right"></i></div>  
        </div>
                </h2>
                
                <div style="max-width: 100% !important;overflow: hidden !important;">
                    <div id="owl-demo" class="owl-carousel owl-carousel-related-products"> 

                            <?php //woocommerce_product_loop_start(); ?>

                            <?php while ($products->have_posts()) : $products->the_post(); ?>

                                <div class="item">
                                    <a title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>">
                                        <?php the_post_thumbnail('thumbnail'); ?>                                    
                                    </a>
                                    <div class="clearfix">&nbsp;</div>
                                    <a title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>" class="related-title">
                                            <?php the_title(); ?>
                                    </a>
                                </div>

                            <?php endwhile; // end of the loop. ?>

                            <?php //woocommerce_product_loop_end(); ?>

                        </div>                    
                </div>		 		
	</div>
<?php endif;

wp_reset_postdata();
