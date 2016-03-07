<?php
/**
 * Template Name: Import product Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header();
global $wpdb;
$product_importer = 0;
?>

<!-- Section -->
<section>
  <!-- Blog Sec -->
  <div class="blog_sec">
    <div class="container">
		
		<?php
		/*
				
		
			
				// Need to require these files
		if ( !function_exists('media_handle_upload') ) {
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		}
		
		
		/*
	$user = $wpdb->get_results( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id = 308", ARRAY_A );

	echo "<pre>";
		print_r($user);
	echo "</pre>";
*/
	/*
	
$file = ABSPATH."data.csv";
$fObj = fopen($file, "r");
$count = 0;
$newOrderArray = array();
$i = 0;

while (!feof($fObj)) 
{
	if($i==0){ $i++; continue; }
	
    $array = fgetcsv($fObj);
    	
	if($array[0] != ""){
	  if($count >= 700 && $count < 750){
				
			$product = array();
			
			$product['sku'] = $array[0];
			$product['name'] = $array[7];
			$product['description'] = $array[8];
			$product['short_description'] = $array[9];		
			$product['_price'] = $array[10];
			$product['_regular_price'] = $array[10];
			$product['_sale_price'] = $array[11];
			$product['_weight'] = $array[15];
			$product['image'] = 'http://store.barakatgallery.com/media/catalog/product'.$array[20];
			//$product['media_gallery'] = $array[23];
			$product['circa'] = $array[52];
			$product['dimensions'] = $array[53];
			$product['medium'] = $array[54];
			$product['origin'] = $array[55];
			$product['location'] = $array[56];
			$product['qty'] = $array[59];	

			
			$post = array(
			 'post_content' => $product['description'],
			 'post_excerpt' => $product['short_description'],
			 'post_status' => "publish",
			 'post_title' => $product['name'],
			 'post_parent' => '',
			 'post_type' => "product",

			);
			 
			//Create product
			$post_id = wp_insert_post( $post, $wp_error );
			
			if($post_id){
				
				$thedata = array(
						'pa_circa'=> array(
										'name'=>'pa_circa',
										'value'=>$product['circa'],
										'is_visible' => '1',
										'is_variation' => '1',
										'is_taxonomy' => '1'
										),
						'pa_dimensions'=> array(
										'name'=>'pa_dimensions',
										'value'=>$product['dimensions'],
										'is_visible' => '1',
										'is_variation' => '1',
										'is_taxonomy' => '1'
										),
						'pa_medium'=> array(
										'name'=>'pa_medium',
										'value'=>$product['medium'],
										'is_visible' => '1',
										'is_variation' => '1',
										'is_taxonomy' => '1'
										),
						'pa_origin'=> array(
										'name'=>'pa_origin',
										'value'=>$product['origin'],
										'is_visible' => '1',
										'is_variation' => '1',
										'is_taxonomy' => '1'
										),
						'pa_gallery-location'=> array(
										'name'=>'pa_gallery-location',
										'value'=>$product['location'],
										'is_visible' => '1',
										'is_variation' => '1',
										'is_taxonomy' => '1'
										)
				);
				
				$avail_attributes_pa_circa = array($product['circa']);
				$avail_attributes_pa_dimensions = array($product['dimensions']);		
				$avail_attributes_pa_origin = array($product['origin']);
				$avail_attributes_pa_gallery_location = array($product['location']);
				$avail_attributes_pa_medium = array($product['medium']);
				
				
				wp_set_object_terms($post_id, 'simple', 'product_type');
				
				//wp_set_object_terms($post_id, 'Benin', 'product_cat' );		
				wp_set_object_terms( $post_id, $avail_attributes_pa_circa, 'pa_circa' );
				wp_set_object_terms( $post_id, $avail_attributes_pa_dimensions, 'pa_dimensions' );
				wp_set_object_terms( $post_id, $avail_attributes_pa_medium, 'pa_medium' );
				wp_set_object_terms( $post_id, $avail_attributes_pa_origin, 'pa_origin' );
				wp_set_object_terms( $post_id, $avail_attributes_pa_gallery_location, 'pa_gallery-location' );
				
				
				 update_post_meta( $post_id,'_product_attributes',$thedata);
				
				 update_post_meta( $post_id, '_visibility', 'visible' );
				 update_post_meta( $post_id, '_stock_status', 'instock');
				 update_post_meta( $post_id, 'total_sales', '0');
				 update_post_meta( $post_id, '_downloadable', 'no');
				 update_post_meta( $post_id, '_virtual', 'no');
				 update_post_meta( $post_id, '_regular_price', $product['_price'] );
				 update_post_meta( $post_id, '_sale_price', $product['_sale_price'] );
				 update_post_meta( $post_id, '_purchase_note', "" );
				 update_post_meta( $post_id, '_featured', "no" );
				 update_post_meta( $post_id, '_weight', $product['_weight'] );
				 update_post_meta( $post_id, '_length', "" );
				 update_post_meta( $post_id, '_width', "" );
				 update_post_meta( $post_id, '_height', "" );
				 update_post_meta($post_id, '_sku', $product['sku']);			 
				 update_post_meta( $post_id, '_sale_price_dates_from', "" );
				 update_post_meta( $post_id, '_sale_price_dates_to', "" );
				 update_post_meta( $post_id, '_price', $product['_price'] );
				 update_post_meta( $post_id, '_sold_individually', "" );
				 update_post_meta( $post_id, '_manage_stock', "yes" );
				 update_post_meta( $post_id, '_backorders', "no" );
				 update_post_meta( $post_id, '_stock', $product['qty'] );		
				 
				$url = $product['image'];
				$tmp = download_url( $url );
				if( !is_wp_error( $tmp ) ){
						
					$desc = "";
					$file_array = array();
							
					// Set variables for storage
					// fix file filename for query strings
					preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
					$file_array['name'] = basename($matches[0]);
					$file_array['tmp_name'] = $tmp;
								
					// If error storing temporarily, unlink
					if ( is_wp_error( $tmp ) ) {
						@unlink($file_array['tmp_name']);
						$file_array['tmp_name'] = '';
					}

					// do the validation and storage stuff
					$imageID = media_handle_sideload( $file_array, $post_id, $desc );
					
					// If error storing permanently, unlink
					if ( is_wp_error($imageID) ) {
						@unlink($file_array['tmp_name']);
						return $imageID;
					}

					$src = wp_get_attachment_url( $imageID );
					
					set_post_thumbnail($post_id, $imageID);
				}
				 
				$product_importer++;			
				echo $count."->";
			}
	  }
    
	$count++;
	
	}	

}
	echo "<h3>imported product = $product_importer </h3>";
	*/	
	
?>
		

    </div>
  </div>
</section>

<?php
//get_sidebar();
get_footer();
