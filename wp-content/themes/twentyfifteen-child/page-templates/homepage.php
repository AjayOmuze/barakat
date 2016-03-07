<?php
/**
 * Template Name: Home Page
 */
get_header();
?>

<?php if (have_posts()): ?>
  <style type="text/css">
    .owl-carousel{display: block !important;}

  </style>
  <?php $args = array('post_type' => 'slider', 'posts_per_page' => 10); ?>

  <?php $slides = get_posts($args); ?>

  <?php if (is_array($slides) && count($slides) > 0): ?>
    <div class="clearfix"></div>
    <!-- slide section -->
    <section class="slider_section">
      <div class="slider_sec" style="max-width: 100% !important;overflow: hidden !important;">

        <div class="owl-carousel owls-slider-homepage">           
          <?php $i = 0; ?>
          <?php foreach ($slides as $post): setup_postdata($post); ?>
            <div class="item">
              <?php if (get_field('url') != ""): ?>  
                <a href="<?php echo get_field('url'); ?>">
                  <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                </a>  
              <?php else: ?>  
                <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
              <?php endif; ?>  
              <?php $i++; ?>
            </div>    
          <?php endforeach; ?>                
          <?php wp_reset_query(); ?>          
        </div>    

        <div class="clearfix"></div>  
      </div>
    </section>

  <?php endif; ?>


  <!-- Section -->
  <section>
    <!-- Blog Sec -->
    <div class="blog_sec">

      <div class="container">


        <?php the_post(); ?>
        <?php the_content(); ?>


      </div>
    </div>
  </section>

<?php endif; ?>

<?php
//get_sidebar();
get_footer();
