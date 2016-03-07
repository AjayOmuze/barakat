<?php
/**
 * Template Name: Home Page
 */

get_header(); ?>

<?php if(have_posts()): ?>

<?php $args = array('post_type' => 'slider', 'posts_per_page' => 10); ?>

<?php $slides = get_posts($args); ?>

<?php if(is_array($slides) && count($slides) > 0): ?>

<!-- slide section -->
<section class="slider_section">
	<div class="slider_sec">
	
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		  
		  <?php $i=0; foreach($slides as $slide): ?>
		  
			<li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php if($i == 0){ echo 'class="active"'; } ?>></li>
		  
		  <?php $i++; endforeach; ?>

		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		
			<?php $i=0; foreach($slides as $post): setup_postdata($post); ?>
				
				<div class="item <?php if($i==0){ echo 'active'; } ?>">
				  <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
				</div>
				
			<?php $i++; endforeach; wp_reset_query(); ?>
			
		  </div>

		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>
		</div>

	</div>
</section>

<?php endif; ?>


<!-- Section -->
<section>
<!-- Blog Sec -->
<div class="blog_sec">
		
	<div class="container">
		
		<div class="row welcome_home_text">
			
			<?php while(have_posts()): the_post(); ?>
				
				<div class="col-md-10 col-md-offset-1 text-center">
					<?php the_content(); ?>
				</div>
				
			<?php endwhile; ?>
		
		</div>
				
		<div class="clearfix">&nbsp;</div>
		
		<?php $ancient_art_id = 18; ?>
		
		<?php $child_terms_by_id = get_term_children($ancient_art_id, 'product_cat'); ?>
		
		<?php //echo "<pre>"; print_r($child_terms_by_id); echo "</pre>"; ?>
		
		<?php if(is_array($child_terms_by_id) && count($child_terms_by_id) > 0): ?>
		
			<div class="row">
			
			<?php foreach($child_terms_by_id as $child_term_id): ?>
			
							
				<?php $child = get_term_by('id', $child_term_id, 'product_cat'); ?>
				
				<?php if($child->parent == $ancient_art_id): ?>
				
						<div class="col-lg-3 col-sm-4 col-xs-6">
							<div class="blog_block">
							
								<?php 
									$image = get_field('category_image_for_thumb', 'product_cat_'.$child->term_id);
									if ( $image ):	?>
							
								<figure>								
									
									<img src="<?php echo $image; ?>" alt="" class="img-responsive">
									
									<a href="<?php echo get_term_link( $child ); ?>">
										
										<div class="caption text-center">
											<h3><?php echo $child->name; ?></h3>
										</div>
										
									</a>
							    </figure>
								
								<?php endif; ?>
								
							</div>
						</div>
					
				<?php endif; ?>
				
				
				
			<?php endforeach; ?>
			
			</div>
			
		<?php endif; ?>
		
    </div>
</div>
</section>

<?php endif; ?>

<?php
//get_sidebar();
get_footer();
