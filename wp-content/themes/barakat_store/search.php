<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<!-- Section -->
<section>
<!-- Blog Sec -->
<div class="blog_sec">
	<div class="container">
	<?php if ( have_posts() ) : ?>
	
    	<h1><?php printf( __( 'Search Results for: %s', 'twentyfifteen' ), get_search_query() ); ?></h1>
        <div class="row">
		
			<?php $i=1; while ( have_posts() ) : the_post(); ?>
			
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="blog_block">
						<figure>
						
							<?php if(has_post_thumbnail()): ?>
								
								<a href="<?php the_permalink(); ?>">
								
									<?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive')); ?>
									
								</a>
								
							<?php else: ?>
							  
							  <a href="<?php the_permalink(); ?>">
								<img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" class="img-responsive" alt="No image." />
							  </a>
							  
							<?php endif; ?>
							
						</figure>
						
						<div class="date">
							<ul>
								<li><i class="fa fa-calendar"></i> Jul 3, 2015</li>
								<li><i class="fa fa-user"></i> Harvard</li>
							</ul>
						</div>
						
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<p><?php echo substr(strip_tags(get_the_excerpt()), 0,150)." ..."; ?></p>
						<a href="<?php the_permalink(); ?>" class="readmore">Read more</a>
					</div>
				</div>        
			
			<?php if($i%4 == 0){ echo '</div><div class="row">'; } $i++; endwhile; ?>
			
			<div class="pagination_sec">
				<?php the_posts_pagination( array(
					'prev_text'          => __( 'PREV', 'twentyfifteen' ),
					'next_text'          => __( 'NEXT', 'twentyfifteen' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '', 'twentyfifteen' ) . ' </span>',
				) ); ?>
			</div>
			
		</div>

	<?php endif; ?>
    
    </div>
</div>
</section>

<?php get_footer(); ?>
