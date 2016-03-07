<?php
/**
 * Template Name: Blogs Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header();
?>

<!-- Section -->
<section>
  <!-- Blog Sec -->
  <div class="blog_sec">
    <div class="container">

      <?php
      if (function_exists(simple_breadcrumb)) {
        simple_breadcrumb();
      }
      ?>

		  <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 page-detail">
			  
			  <h1><?php the_title() ?></h1>
			  <?php the_post(); ?>
			  <?php the_content(); ?>
			  
			  <div class="clearfix"></div>
			</div>
		  </div>
		  
		  <?php $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; ?>
		  
		  <?php $args = array('post_type' => 'post', 'posts_per_page' => 20, 'paged' => $paged); ?>
		  
		  <?php query_posts($args); ?>
		  
		  <?php if (have_posts()) : ?>

			<div class="row">
			  <?php $counter = 0; ?>
			  <?php while (have_posts()) : the_post(); ?>

				<div class="col-lg-4 col-sm-6 col-xs-12">
				  <div class="blog_block">
					<figure>
					
					  <a href="<?php the_permalink() ?>">
						<?php if (has_post_thumbnail()): ?>
						  <?php the_post_thumbnail('post_thumb_image', array('class' => 'img-responsive')); ?>
						<?php else: ?>
						  <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" class="img-responsive" alt="">
						<?php endif; ?>
					  </a>
					  
					  <div class="caption">
						<ul class="left">						  
						  <!--<li><i class="fa fa-thumbs-up"></i> 64</li>
						  <li><i class="fa fa-thumbs-down"></i> 42</li>-->
						</ul>
						
						<ul class="right">
						  <li><i class="fa fa-comments"></i> 
								<?php $comment = wp_count_comments(get_the_ID());
									echo $comment->approved; 
								?>
						  </li>
						  <li><i class="fa fa-eye"></i> <?php echo_views(get_the_ID()); ?></li>
						  
						</ul>
						
					  </div>
					</figure>
					
					<div class="date">
					  <ul>
						<li><i class="fa fa-calendar"></i> <?php echo get_the_date('M d, Y'); ?></li>
						<li class="pull-right"><i class="fa fa-user"></i> <?php echo ucfirst(get_the_author()); ?></li>
						<!--<li class="pull-right">
						  <?php
						  $categories = wp_get_post_categories(get_the_ID());
						  foreach ($categories as $cat) {
							echo "<a href='" . get_category_link($cat) . "'>" . get_cat_name($cat) . "</a> ";
						  }
						  ?>								
						</li>-->
					  </ul>
					</div>
					
					<h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
					<p><?php the_field('short_description', get_the_ID()) ?></p>
					<a href="<?php the_permalink() ?>" class="readmore">Read more</a>
				  </div>
				</div>

				<?php $counter++; ?>
				
				<?php if ($counter % 3 == 0): ?>
					</div><div class="row">
				<?php endif; ?>

			<?php endwhile; ?>

			<?php global $wp_query; if($wp_query->found_posts > 19): ?>
			
			  <!-- Pagination -->
			  <div class="pagination_sec">
				<?php
				the_posts_pagination(array(
					'prev_text' => __('PREV', 'twentyfifteen'),
					'next_text' => __('NEXT', 'twentyfifteen'),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('', 'twentyfifteen') . ' </span>',
				));
				?>					
			  </div>
			
			<?php endif; ?>
			
			</div>
	
		  <?php endif; ?>


    </div>
  </div>
</section>

<?php
//get_sidebar();
get_footer();
