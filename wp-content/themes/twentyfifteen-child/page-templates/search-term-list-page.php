<?php
/**
 * Template Name: Search Term List
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
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
        <div class="col-lg-12 col-md-12 col-sm-12 page-detail">
          <h1><?php the_title() ?></h1>
          <?php the_post(); ?>
          
		  <?php $args = array(
					'smallest'                  => 8, 
					'largest'                   => 16,
					'unit'                      => 'pt', 
					'number'                    => 45,  
					'format'                    => 'flat',
					'separator'                 => "\n",
					'orderby'                   => 'name', 
					'order'                     => 'ASC',
					'exclude'                   => null, 
					'include'                   => null, 
					'topic_count_text_callback' => default_topic_count_text,
					'link'                      => 'view', 
					'taxonomy'                  => 'product_tag', 
					'echo'                      => true,
					'child_of'                  => null, // see Note!
				); ?>
				
				
		<?php wp_tag_cloud( $args ); ?>
		  
          <div class="clearfix"></div>
        </div>
      </div>


    </div>
  </div>
</section>

<?php
//get_sidebar();
get_footer();
