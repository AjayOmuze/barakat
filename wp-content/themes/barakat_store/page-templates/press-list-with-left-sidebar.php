<?php
/**
 * Template Name: Press List With Left Sidebar
 */
get_header();
?>

<?php $feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
<?php if ($feat_image != ''): ?>

  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="<?php echo $feat_image ?>" alt="<?php the_title() ?>">
      </div>
    </div>
  </div>

<?php endif; ?>

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
        <div class="col-lg-3 col-md-3 col-sm-3">
          <?php wp_nav_menu(array('menu_name' => 'About Menu')); ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 page-detail">
          <h1><?php the_title() ?></h1>
          <?php the_post(); ?>
          <?php the_content(); ?>
          <div class="clearfix"></div>

          <?php $presses = get_posts(array('post_type' => 'press', 'numberofposts' => 0)); ?>

          <?php if (is_array($presses) && count($presses) > 0): ?>
            <div class="row">
              <?php foreach ($presses as $post): setup_postdata($post); ?>
                <div class="col-md-3 col-sm-4">
                  <?php $feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                  <?php if ($feat_image != ''): ?>
                    <a href="<?php the_field('pdf', get_the_ID()) ?>" target="_blank">
                      <img src="<?php echo $feat_image ?>" alt="<?php the_title() ?>">
                    </a>
                  <?php endif; ?>
                  <h5><a href="<?php the_field('pdf', get_the_ID()) ?>" target="_blank"><?php the_title() ?></a></h5>
                  <p><?php the_field('release_info', get_the_ID()) ?></p>

                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </div>
      </div>


    </div>
  </div>
</section>

<?php
//get_sidebar();
get_footer();
