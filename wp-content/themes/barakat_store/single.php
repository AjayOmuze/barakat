<?php
/**
 * The template for displaying all single posts and attachments
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
  <div class="blog_sec blog_detail">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
          
		  <?php if (have_posts()) : ?>
            <?php while (have_posts()): the_post(); ?>
              
			  <div class="blog_detail_wrapper">
				
				<?php if(has_post_thumbnail()): ?>
				
					<figure> 
						<a href="#">
							<?php the_post_thumbnail("full", array("class" => "img-responsive")); ?>
						</a>
					</figure>
					
				<?php endif; ?>
				
                <div class="caption clearfix">

                  <ul class="left">  
					<li><?php echo do_shortcode('[likebtn]'); ?></li>
                    <!--<li><i class="fa fa-thumbs-up"></i> 64</li>
                    <li><i class="fa fa-thumbs-down"></i> 42</li>-->
                  </ul>
				  
                  <ul class="right">
                    <li><i class="fa fa-comments"></i> <?php
                      $comment = wp_count_comments(get_the_ID());
                      echo $comment->approved;
                      ?></li>
                    <li><i class="fa fa-eye"></i> <?php echo_views(get_the_ID()); ?></li>
                  </ul>
				  
                </div>
				
                <div class="date">
                  <ul>
                    <li><i class="fa fa-calendar"></i> <?php echo get_the_date('M d, Y'); ?></li>
                    <li class="pull-right"><i class="fa fa-user"></i> <?php echo ucfirst(get_the_author(get_the_ID())); ?></li>
                  </ul>
                </div>
				
                <h2><?php the_title(); ?></h2>
                <div class="detail_txt">
                  <?php the_content(); ?>
                </div>
              </div>
              <!-- comments -->
              <?php comments_template(); ?>

            <?php endwhile; ?>  
          <?php endif; ?>  
        </div>


        <div class="col-lg-4 col-md-4 col-sm-4 rightbelt">
          <div class="top_search">
            <form action="<?php echo site_url(); ?>">
              <input type="text" class="" name="s">
              <button><i class="glyphicon glyphicon-search"></i> </button>
            </form>
          </div>
          <div class="social">
            <h3>Follow Us On</h3>
            <ul>
              <li><a href="<?php echo kc_get_option("social", "social-media-settings", "facebook"); ?>"><i class="fa fa-facebook"></i></a></li>
              <li><a href="<?php echo kc_get_option("social", "social-media-settings", "twitter"); ?>"><i class="fa fa-twitter"></i></a></li>
              <li><a href="<?php echo kc_get_option("social", "social-media-settings", "pinterest"); ?>"><i class="fa fa-pinterest"></i></a></li>
              <li><a href="<?php echo kc_get_option("social", "social-media-settings", "youtube"); ?>"><i class="fa fa-youtube"></i></a></li>
              <li><a href="<?php echo kc_get_option("social", "social-media-settings", "tumblr"); ?>"><i class="fa fa-tumblr"></i></a></li>
            </ul>
          </div>

          <div class="recent_post_wrapper">

            <?php $args = array("post_type" => "post", "post_per_page" => 6); ?>
            <?php $postlist = get_posts($args); ?>
            <?php foreach ($postlist as $post) : setup_postdata($post); ?>

              <div class="recent_post clearfix">
                <figure>
					<a class="" href="<?php the_permalink(); ?>">
						
						<?php if(has_post_thumbnail()): ?>
						
							<?php the_post_thumbnail("post_recent_image", array("class" => "img-responsive", "width" => "50px")); ?> 
						
						<?php else: ?>
						
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-image.jpg" class="img-responsive" />
						
						<?php endif; ?>
				
					</a>
				</figure>
				
                <div class="right">
                  <h4><a class="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  <div class="datetime">
                    <ul>
                      <li><i class="fa fa-calendar"></i><?php echo get_the_date('M d, Y'); ?></li>
                      <li><i class="fa fa-user"></i><?php echo ucfirst(get_the_author()); ?></li>
                    </ul>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          </div>


          <div class="archieve">
            <h3>Archive</h3>

            <ul>
              <?php
              $args = array(
                  'type' => 'monthly',
                  'limit' => '5',
                  'format' => 'html',
                  'before' => '',
                  'after' => '',
                  'show_post_count' => true,
                  'echo' => 1,
                  'order' => 'DESC'
              );
              wp_get_archives($args);
              ?>
            </ul>
          </div>


        </div>
      </div>
    </div>
  </div>
</section>


<?php get_footer(); ?>
