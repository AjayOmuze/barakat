<?php
/**
 * Template Name: Exhibition List With Left Sidebar
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
        <div class="col-lg-3 col-md-3 col-sm-3 page-detail leftside">
			<h4>About</h4>
          <?php wp_nav_menu(array('menu_name' => 'About Menu')); ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 page-detail">
          <h1><?php the_title() ?></h1>
          <?php the_post(); ?>
          <?php the_content(); ?>
          <div class="clearfix"></div>

          <?php $presses = get_posts(array('post_type' => 'exhibition', 'numberofposts' => 0)); ?>

          <?php if (is_array($presses) && count($presses) > 0): ?>

            <?php foreach ($presses as $post): setup_postdata($post); ?>
              <div class="row">
                <div class="col-md-3 col-sm-4">
                  <?php $feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                  <?php if ($feat_image != ''): ?>
                    <a href="<?php the_field('url', get_the_ID()) ?>" target="_blank">
                      <img class="img-responsive" width="100%" src="<?php echo $feat_image ?>" alt="<?php the_title() ?>">
                    </a>
                  <?php endif; ?>
                </div>
                <div class="col-md-9 col-sm-8 exhibitions">
                    <a href="<?php the_field('url', get_the_ID()) ?>" target="_blank">
                      <h5><?php the_title() ?></h5>
                      <p><?php the_content() ?></p>
                    </a>
                </div>
              </div>
              <br/>
              <div class="clearfix"></div>
            <?php endforeach; ?>

          <?php endif; ?>

        </div>
      </div>


    </div>
  </div>
</section>

<?php
//get_sidebar();
get_footer();
