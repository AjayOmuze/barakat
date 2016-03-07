<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( ); ?>

<!-- Section -->
<section>

<div class="blog_sec">
	<div class="container">
    	
		<div class="row">
				
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); global $post, $woocommerce, $product; ?>
		
		<div class="col-md-6">		
			
			<div class="images">

				<?php
					if ( has_post_thumbnail() ) {

						$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
						$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
						$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
						$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
							'title'	=> $image_title,
							'alt'	=> $image_title
							) );

						$attachment_count = count( $product->get_gallery_attachment_ids() );

						if ( $attachment_count > 0 ) {
							$gallery = '[product-gallery]';
						} else {
							$gallery = '';
						}

						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );

					} else {

						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

					}
				?>
				<div class="clearfix">&nbsp;</div>
				
				<?php do_action( 'woocommerce_product_thumbnails' ); ?>

			</div>
		
		</div>
		
		<div class="col-md-6">
		
			<h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>
			
			<?php $product->list_attributes(); ?>
			
			<?php the_content(); ?>
			
			<div class="clearfix">&nbsp;</div>
			
			
			<?php if(is_user_logged_in()): ?>
			
				<h3 class="price"><?php echo $product->get_price_html(); ?></h3>
			
				<div class="clearfix">&nbsp;</div>
			
			
				<a class="btn btn-theme" data-toggle="modal" data-target="#myOfferModal">Make an Offer</a> &nbsp;&nbsp;&nbsp;  <a href="<?php echo site_url(); ?>/contact-us" class="btn btn-theme">Contact Purchase</a> &nbsp;&nbsp;&nbsp; 
			
				<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
								
			<?php else: ?>
				
				<a href="<?php echo site_url(); ?>/my-account" class="btn btn-theme">Login to view price</a> &nbsp;&nbsp;&nbsp;
				<a href="<?php echo site_url(); ?>/my-account" class="btn btn-theme">Add To WIshlist</a>
			
			<?php endif; ?>
			
		</div>
			

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>

		</div>		
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="myOfferModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title">Price Offer Form</h4></center>
        </div>
        <div class="modal-body">
          <?php echo do_shortcode('[contact-form-7 id="304" title="Offer Form"]'); ?>
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></center>
        </div>
      </div>
      
    </div>
  </div>
  
</section>
	
<?php get_footer( ); ?>

