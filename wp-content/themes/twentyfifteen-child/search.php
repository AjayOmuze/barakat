<?php
/**
 * The template for displaying search results pages.
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
      <?php if (have_posts()) : ?>

        <h1><?php printf(__('Search Results for: %s', 'twentyfifteen'), get_search_query()); ?></h1>
	
		<?php if(isset($_REQUEST['item_description']) && $_REQUEST['item_description'] !=""){ echo "<br/><h4>Description: ".$_REQUEST['item_description']."</h4>"; } ?>		
		<?php if(isset($_REQUEST['item_sku']) && $_REQUEST['item_sku'] !=""){ echo "<br/><h4>SKU: ".$_REQUEST['item_sku']."</h4>"; } ?>		
		<?php if(isset($_REQUEST['item_price']) && $_REQUEST['item_price'] !=""){ echo "<br/><h4>Price: ".$_REQUEST['item_price']."</h4>"; } ?>					
		
        <div class="row">
			
          <?php
          $i = 1;
          while (have_posts()) : the_post();
            ?>

            <div class="col-lg-3 col-sm-6 col-xs-12 pd_sec">
              <div class="blog_block search_block product_box">
                <a href="<?php the_permalink(); ?>">
                  <figure>
                    <?php if (has_post_thumbnail()): ?>
                      <?php the_post_thumbnail('ProductThumbImage', array('class' => 'img-responsive')); ?>
                    <?php else: ?>
                      <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" class="img-responsive" alt="No image." />
                    <?php endif; ?>
                  </figure>
                  <h3><?php the_title(); ?></h3>
                </a>
                <?php /* <p><?php echo substr(strip_tags(get_the_excerpt()), 0, 150) . " ..."; ?></p> 
                  <a href="<?php the_permalink(); ?>" class="readmore">Read more</a> */ ?>
              </div>
            </div>        

            <?php
            if ($i % 4 == 0) {
              echo '</div><div class="row">';
            } $i++;
          endwhile;
          ?>

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

      <?php else: ?>
	  
		<?php echo "<h1>No result found...</h1>"; ?>
		
      <?php endif; ?>

    </div>
  </div>
</section>

<?php get_footer(); ?>
