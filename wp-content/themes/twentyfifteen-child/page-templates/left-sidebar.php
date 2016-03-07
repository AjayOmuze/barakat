<?php
/**
 * Template Name: Left Sidebar Page
 */
get_header();
?>

<?php $feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
<?php if ($feat_image != ''): ?>

  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="<?php echo $feat_image ?>" alt="...">
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


          <?php $galleryObj = get_field('gallery', get_the_ID()); ?>
          <?php
          /* echo '<pre>';
            print_r($galleryObj);
            echo '</pre>'; */
          ?>

          <?php if (is_array($galleryObj) && count($galleryObj) > 0): ?>
            <div class="row page_simple_gallery">
              <?php foreach ($galleryObj as $image): ?>
                <div class="col-md-2 col-sm-2 col-xs-4 item">
                  <a class="fancybox" href="<?php echo $image['url'] ?>" data-fancybox-group="gallery">
                    <img src="<?php echo $image['sizes']['thumbnail'] ?>" title="<?php echo $image['title'] ?>" alt="<?php echo $image['title'] ?>" class="img-responsive" />
                  </a>
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
