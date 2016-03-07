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

	
$file = ABSPATH."data.csv";
$fObj = fopen($file, "r");
$count = 0;
$newOrderArray = array();
$i = 0;
$main_sku = "";
$counter1 = 0;
while (!feof($fObj)) 
{
    $array = fgetcsv($fObj);
    if($count > 3000 && $count < 4001)
    {
        $sku_id = trim($array[0]);
		$image_url = trim($array[97]);
		$image_position = (isset($array[99]) && $array[99] > 1)? $array[99] : '1';
        
        if($main_sku != $sku_id && $sku_id != "")
        {
            $main_sku = $sku_id;
            
        }  
		
		if($sku_id == "" && $image_url !="" && $image_position > 1)
		{
			
			$product = $wpdb->get_results( "SELECT post_id FROM $wpdb->postmeta WHERE  meta_key = '_sku' AND meta_value = '{$main_sku}'", ARRAY_A );	
			
			if(isset($product[0]['post_id']) && $product[0]['post_id'] > 0){
				
				$post_id = $product[0]['post_id'];
				$live_image_url = 'http://store.barakatgallery.com/media/catalog/product'.$image_url;
				
				//echo $post_id."--->";
				//echo "<br/>".$live_image_url;
								
				$imageID = 0;
				
				$tmp = download_url( $live_image_url );
				if( !is_wp_error( $tmp ) ){
						
					$desc = "";
					$file_array = array();
							
					// Set variables for storage
					// fix file filename for query strings
					preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $live_image_url, $matches);
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
				}
				
				if($imageID > 0){
						
					$old_ids = get_post_meta($post_id, '_product_image_gallery', true);
					
					$new_ids = $old_ids.','.$imageID;
					
					$new_ids = ltrim($new_ids, ',');
					
					$new_ids = rtrim($new_ids, ',');
					
					//echo "<br>".$new_ids;
					
					update_post_meta($post_id, '_product_image_gallery', $new_ids);
				}	
				//break;
				
			}
			
		}
		
       echo $count."<br/>";
	   
    }    
    $count++;
	
}*/
echo "Run Successfully...";
	
?>
		

    </div>
  </div>
</section>

<?php
//get_sidebar();
get_footer();
