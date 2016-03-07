<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template.
 *
 * Override this template by copying it to yourtheme/woocommerce/taxonomy-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$taxonomy_product_category = get_queried_object();

if($taxonomy_product_category->term_id != "" && $taxonomy_product_category->term_id > 0){
	
	if(check_for_child($taxonomy_product_category->term_id)){
	
		get_header();
		
		$thumbnail_id = get_woocommerce_term_meta( $taxonomy_product_category->term_id, 'thumbnail_id', true );
	    
		$image = wp_get_attachment_url( $thumbnail_id );
		
			if ( $image ): ?>
		
			  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
				  <div class="item active">
					<img src="<?php echo $image ?>" alt="...">
				  </div>
				</div>
			  </div>

		<?php endif; ?>

	
			<section>
			  <!-- Blog Sec -->
			  <div class="blog_sec">
				<div class="container">

				<div class="row">
					
					<div class="col-lg-3 col-md-3 col-sm-5 page-detail leftside">
						
						<h4>Other in <?php echo $taxonomy_product_category->name; ?> :</h4>
						<ul>
						<?php $child_term = get_term_children($taxonomy_product_category->term_id, 'product_cat'); ?>
						
						<?php foreach($child_term as $child): ?>
						
							<?php $child_term_by_id = get_term_by('id', $child, 'product_cat')?>
								<?php if($child_term_by_id->parent == $taxonomy_product_category->term_id): ?>
								
									<li><a href="<?php echo get_term_link( $child_term_by_id ); ?>"><?php echo $child_term_by_id->name; ?></a></li>
								
								<?php endif; ?>
								
						<?php endforeach; ?>
						</ul>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-7 page-detail">
					  
					  <h1><?php echo $taxonomy_product_category->name; ?></h1>
					  <p><?php echo $taxonomy_product_category->description; ?></p>
					  
					  <div class="clearfix"></div>
					</div>
					
				  </div>


				</div>
			  </div>
			</section>

	
	<?php	get_footer();	
	}else { 
	
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
					do_action( 'woocommerce_before_main_content' );
				?>
				
					<?php if(($taxonomy_product_category->parent !="") && ($taxonomy_product_category->parent > 0)): ?>
												
						<div class="col-lg-3 col-md-3 col-sm-5 page-detail leftside">
							<?php $parent_term_by_id = get_term_by('id', $taxonomy_product_category->parent, 'product_cat'); ?>
							<h4>Other in <?php echo $parent_term_by_id->name; ?> :</h4>
							<ul>
							<?php $child_term = get_term_children($taxonomy_product_category->parent, 'product_cat'); ?>
							
							<?php foreach($child_term as $child): ?>
							
								<?php $child_term_by_id = get_term_by('id', $child, 'product_cat'); ?>
									<?php if($child_term_by_id->parent == $taxonomy_product_category->parent): ?>
									
										<?php $child_class = ($taxonomy_product_category->term_id == $child_term_by_id->term_id)? 'active' : ''; ?>
										
										<li class="<?php echo $child_class; ?>"><a href="<?php echo get_term_link( $child_term_by_id ); ?>"><?php echo $child_term_by_id->name; ?></a></li>
									
									<?php endif; ?>
									
							<?php endforeach; ?>
							</ul>
						</div>
						
					<?php endif; ?>
			
			<div class="col-lg-9 col-md-9 col-sm-7">
								
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

					<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

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
		</section>

		
		<?php get_footer();
		
	//wc_get_template( 'archive-product.php' );	} 
	}
}