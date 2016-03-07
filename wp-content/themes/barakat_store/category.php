<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
get_header();
?>

<!-- Section -->
<section>
  <!-- Blog Sec -->
  <div class="blog_sec">
    <div class="container">
      <h1><?php echo single_cat_title('', false); ?></h1>

      <?php if (have_posts()) : ?>
	  
        <div class="row">
          <?php $counter = 0; ?>
          <?php while (have_posts()) : the_post(); ?>

            <div class="col-lg-4 col-sm-6 col-xs-12">
              <div class="blog_block">
                <figure>
                  <a href="<?php the_permalink() ?>">
                    <?php if (has_post_thumbnail()): ?>
                      <?php the_post_thumbnail('post_thumb_image'); ?>
                    <?php else: ?>
                      <img src="<?php echo get_template_directory_uri(); ?>/images/blog_image_1.jpg" alt="">
                    <?php endif; ?>
                  </a>
                  <div class="caption">
                    <ul class="left">
                      <li><i class="fa fa-thumbs-up"></i> 64</li>
                      <li><i class="fa fa-thumbs-down"></i> 42</li>
                    </ul>
                    <ul class="right">
                      <li><i class="fa fa-comments"></i> <?php $comment = wp_count_comments( get_the_ID() ); echo $comment->approved; ?></li>
                      <li><i class="fa fa-eye"></i> <?php echo_views(get_the_ID()); ?></li>
                    </ul>
                  </div>
                </figure>
                <div class="date">
                  <ul>
                    <li><i class="fa fa-calendar"></i> <?php echo get_the_date('M d, Y'); ?></li>
                    <li><i class="fa fa-user"></i> <?php echo ucfirst(get_the_author()); ?></li>				
                  </ul>
                </div>
                <h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
                <p><?php the_field('short_description', get_the_ID()) ?></p>
                <a href="<?php the_permalink() ?>" class="readmore">read more</a>
              </div>
            </div>

            <?php $counter++; ?>
            <?php if ($counter % 3 == 0): ?>
            </div><div class="row">
            <?php endif; ?>

          <?php endwhile; ?>
		  
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
				
        </div>
      <?php else :
		get_template_part( 'content', 'none' );
	  endif; ?>

    </div>
  </div>
</section>

<?php get_footer(); ?>
