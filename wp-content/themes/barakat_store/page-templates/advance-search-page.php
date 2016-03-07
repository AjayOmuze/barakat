<?php
/**
 * Template Name: Advance Search
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
      /* if (function_exists(simple_breadcrumb)) {
        simple_breadcrumb();
        } */
      ?>

      <div class="row">

        <?php while (have_posts()): the_post(); ?>

          <div class="col-md-12">
            <h1><?php the_title() ?></h1>
            <?php the_post(); ?>
            <?php the_content(); ?>
          </div>

        <?php endwhile; ?>

        <div class="col-lg-3 col-md-6 col-sm-12 page-detail">

          <form role="form" method="post">

            <div class="form-group">
              <label for="Name">Name:</label>
              <input type="text" name="item_name" class="form-control" />
            </div>

            <div class="form-group">
              <label for="Description">Description</label>
              <input type="text" name="item_description" class="form-control" />
            </div>

            <div class="form-group">
              <label for="Short Description">Short Description</label>
              <input type="text" name="item_short_description" class="form-control" />
            </div>

            <div class="form-group">
              <label for="Item SKU">SKU</label>
              <input type="text" name="item_sku" class="form-control" />
            </div>

            <div class="form-group">
              <label for="Item Price">Price</label>
              <input type="text" name="item_price" class="form-control" />				
            </div>

            <div class="form-group">
              <label for="Item Dimensions">Dimensions</label>
              <input type="text" name="item_dimensions" class="form-control" />				
            </div>

            <div class="form-group">
              <label for="Item Medium">Medium</label>
              <input type="text" name="item_medium" class="form-control" />				
            </div>

            <div class="form-group">
              <label for="Item Medium">Medium</label>
              <input type="text" name="item_medium" class="form-control" />				
            </div>

            <div class="form-group">
              <label for="Search by Category:">Search by Category:</label>
              <select name="item_category" class="form-control">
                <option value="african">African</option>
                <option value="benin">Benin</option>
                <option value="asian">Asian</option>
              </select>
            </div>

            <div class="form-group">				
              <input name="submit" value="Search" type="submit" class="form-control button" />				
            </div>

          </form>
          <div class="clearfix"></div>
        </div>

        <div class="col-lg-9 col-md-6 col-sm-12">			

          <?php if (is_array($_POST) && isset($_POST['submit']) && $_POST['submit'] == 'Search'): ?>

            <?php
            extract($_POST);
            echo $item_category;
            ?>

            <?php
            $args = array('post_type' => 'product',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => $item_category,
                    ),
                ),
            );
            ?>

            <?php $items = get_posts($args); ?>

            <?php foreach ($items as $post): setup_postdata($post); ?>

              <div class="col-md-4">
                <?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive')); ?>
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
              </div>

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
