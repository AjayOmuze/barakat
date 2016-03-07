<?php
/**
 * Template Name: Member Profile
 */

get_header(); ?>

<?php if(have_posts()): ?>

<!-- Section -->
<section>

<div class="blog_sec">
	<div class="container">
    	
		<div class="row">
			
			<?php while( have_posts() ): the_post(); ?>
			
				<?php the_content(); ?>
				
			<?php endwhile; ?>
			
		</div>
		
    </div>
</div>
</section>

<?php endif; ?>

<?php
//get_sidebar();
get_footer();
