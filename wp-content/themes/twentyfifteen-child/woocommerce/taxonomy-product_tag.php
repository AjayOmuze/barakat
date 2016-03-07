<?php
/**
 * The Template for displaying products in a product tag. Simply includes the archive template.
 *
 * Override this template by copying it to yourtheme/woocommerce/taxonomy-product_tag.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$taxonomy_product_tag = get_queried_object();
	
	get_header(); 
	
?>		
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
					//do_action( 'woocommerce_before_main_content' );
				?>
			<div class="col-lg-3 col-md-3 col-sm-5 page-detail leftside">
			
				<?php  $product_terms = get_terms('product_tag'); ?>
				
				<?php if(is_array($product_terms) && count($product_terms) > 0): ?>
					
					<h4>Shop by other terms :</h4>
					
					<ul>
						<?php foreach($product_terms as $terms): $active_class=''; ?>
							
							<?php if($taxonomy_product_tag->term_id == $terms->term_id){ $active_class='active'; } ?>
							
							<li class="<?php echo $active_class; ?>"><a href="<?php echo get_term_link($terms->term_id); ?>"><?php echo $terms->name; ?></a></li>
						
						<?php endforeach; ?>
						
						
					</ul>
				
				<?php endif; ?>
				
				<?php  $product_attr = get_terms('pa_medium'); ?>
				
				<?php if(is_array($product_attr) && count($product_attr) > 0): ?>
					
					<div class="clearfix"><hr/></div>
					
					<h4>Medium :</h4>
					
					<ul>
						<?php foreach($product_attr as $terms): ?>
							
							<li><a href="#"><?php echo $terms->name; ?></a></li>
						
						<?php endforeach; ?>
						
						
					</ul>
				
				<?php endif; ?>
				
			</div>
			
			<div class="col-lg-9 col-md-9 col-sm-7">
								
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

					<h1 class="page-title">Results for '<?php woocommerce_page_title(); ?>' term.</h1>

				<?php endif; ?>

				<?php
					/**
					 * woocommerce_archive_description hook
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					do_action( 'woocommerce_archive_description' );
				?>

				<?php if ( have_posts() ) : ?>

					<?php
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						 
						do_action( 'woocommerce_before_shop_loop' );
					?>

					<?php woocommerce_product_loop_start(); ?>
						
						<?php woocommerce_product_subcategories(); ?>

						<?php while ( have_posts() ) :  the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>
					
					<?php woocommerce_product_loop_end(); ?>

					<?php
						/**
						 * woocommerce_after_shop_loop hook
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					?>

				<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

					<?php wc_get_template( 'loop/no-products-found.php' ); ?>

				<?php endif; ?>
			
			</div>
			
			<?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				//do_action( 'woocommerce_after_main_content' );
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
		</section>

		
		<?php get_footer();
