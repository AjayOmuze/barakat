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
		
        <div class="col-md-5 col-sm-12 page-detail">
		  
		  <form role="form" method="GET" action="<?php echo site_url(); ?>">
			
			<div class="row form-group">
				<div class="col-md-4"><label for="Name">Name:</label></div>
				<div class="col-md-8"><input type="text" name="s" class="form-control" /></div>
			</div>
			
			
			<div class="row form-group">
				<div class="col-md-4"><label for="Name">Description:</label></div>
				<div class="col-md-8"><input type="text" name="item_description" class="form-control" /></div>
			</div>
			
			<?php /* 
			<div class="row form-group">
				<div class="col-md-4"><label for="Name">Short Description:</label></div>
				<div class="col-md-8"><input type="text" name="item_short_description" class="form-control" /></div>
			</div>
			*/ ?>
			
			<div class="row form-group">
				<div class="col-md-4"><label for="Name">SKU</label></div>
				<div class="col-md-8"><input type="text" name="item_sku" class="form-control" /></div>
			</div>

			<div class="row form-group">
				<div class="col-md-4"><label for="Name">Price</label></div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-4 col-sm-4"><input type="text" name="item_price" class="form-control" /></div>
						<div class="col-md-4 col-sm-4"><input type="text" class="form-control" /></div>
						<div class="col-md-4 col-sm-4"><label for="Name">(USD)</label></div>
					</div>
				</div>
			</div>			
			
			<?php /*
			<div class="row form-group">
				<div class="col-md-4"><label for="Name">Dimensions</label></div>
				<div class="col-md-8"><input type="text" name="item_dimensions" class="form-control" />	</div>
			</div>		
			*/ ?>
			
			<?php /*
			<div class="row form-group">
				<div class="col-md-4"><label for="Item Medium">Medium</label></div>
				<div class="col-md-8">
					  <select class="form-control" name="item_medium">
					  
						<?php $mediums = get_terms('pa_medium'); ?>
						
						<?php $i=0; foreach($mediums as $term): ?>
							<?php if($i==0){ echo "<option>Select Medium</option>";	$i++; continue; } ?>
							<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
						
						<?php $i++; endforeach; ?>
					  
					  </select>				
				</div>
			</div>		
			*/ ?>
			
			<div class="row form-group">
			  <div class="col-md-4"><label for="Search by Category:">Search by Category:</label></div>
				<div class="col-md-8">
					<select name="item_category" class="form-control">
						
						<?php $i=0; $categories = get_terms('product_cat'); ?>
						
						<?php foreach($categories as $category): ?>
							<?php if($i==0){ echo "<option value=''>Select Category</option>"; } ?>
							<option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
						
						<?php $i++; endforeach; ?>
						
					</select>			
				</div>
			</div>	

			
			<div class="form-group">				
				<input name="submit_query" value="Search" type="submit" class="btn btn-info" />				
			</div>
			
		  </form>
          <div class="clearfix"></div>
        </div>
      
		<div class="col-lg-9 col-md-6 col-sm-12">
			
		</div>
	  
	  </div>


    </div>
  </div>
</section>

<?php
//get_sidebar();
get_footer();
