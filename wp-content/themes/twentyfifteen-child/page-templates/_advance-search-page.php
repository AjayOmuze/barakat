<?php
/**
 * Template Name: Advance Search
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header();
global $wpdb;

	/*$user = $wpdb->get_results( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id = 34", ARRAY_A );

	echo "<pre>";
		print_r($user);
	echo "</pre>";
	*/
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
      /*if (function_exists(simple_breadcrumb)) {
        simple_breadcrumb();
      }*/
      ?>

      <div class="row">
	  
		<?php while(have_posts()): the_post(); ?>
		
		  <h1><?php the_title() ?></h1>
          <?php the_post(); ?>
          <?php the_content(); ?>
		
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
					
				  <select name="item_medium" class="form-control">
				  
					<?php $mediums = get_terms('pa_medium'); ?>
					
					<?php $i=0; foreach($mediums as $term): ?>
						<?php if($i==0){ echo "<option>Select Medium</option>";	$i++; continue; } ?>
						<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
					
					<?php $i++; endforeach; ?>
				  
				  </select>
				  
			</div>
			
			<div class="form-group">
				<label for="Search by Category:">Search by Category:</label>
				<select name="item_category" class="form-control">
					
					<?php $i=0; $categories = get_terms('product_cat'); ?>
					
					<?php foreach($categories as $category): ?>
						<?php if($i==0){ echo "<option>Select Category</option>"; } ?>
						<option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
					
					<?php $i++; endforeach; ?>
					
				</select>
			</div>
			
			<div class="form-group">				
				<input name="submit" value="Search" type="submit" class="form-control button" />				
			</div>
			
		  </form>
          <div class="clearfix"></div>
        </div>
      
		<div class="col-lg-9 col-md-6 col-sm-12">			
			
			<?php if(is_array($_POST) && isset($_POST['submit']) && $_POST['submit'] == 'Search'): ?>
			
				<?php extract($_POST); echo $item_category; ?>
				
				<?php $args = array('post_type' => 'product',
									'post_status' => 'publish',
									'posts_per_page' => '10',
									'tax_query' => array(
										'relation' => 'OR',
										/*array(
											'taxonomy' => 'product_cat',
											'field'    => 'term_id',
											'terms'    => $item_category,
										),*/
										array(
											'taxonomy' => 'pa_medium',
											'field'    => 'term_id',
											'terms'    => array( $item_medium ),
											'operator' => 'IN',
										),
									),
									/*'meta_query' => array(
										
										array(
											'key' => '_price',
											'value' => '12000',
											'compare' => '='
										)
									),*/
								); ?>
				
				<?php $items = get_posts($args); ?>
				
				<?php foreach($items as $post): setup_postdata($post); ?>
				
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
