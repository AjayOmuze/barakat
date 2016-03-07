<?php

// remove extra p tags
remove_filter('the_content', 'wpautop');



/* add stylesheets and javascript to child theme [start] */
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');

function enqueue_parent_styles() {

  wp_enqueue_style('example-style', get_stylesheet_directory_uri() . '/css/example.css');
  wp_enqueue_style('easyzoom-style', get_stylesheet_directory_uri() . '/css/easyzoom.css');
  wp_enqueue_style('bootstrap-style', get_stylesheet_directory_uri() . '/css/bootstrap.css');
  wp_enqueue_style('main-style', get_stylesheet_directory_uri() . '/css/style.css');
  wp_enqueue_style('custom-responsive-style', get_stylesheet_directory_uri() . '/css/custom.css');
  wp_enqueue_style('font-awesome-style', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
  wp_enqueue_style('yamm-style', get_stylesheet_directory_uri() . '/css/yamm.css');
  wp_enqueue_style('fancybox-style', get_stylesheet_directory_uri() . '/js/fancybox/jquery.fancybox.css');
  wp_enqueue_style('menu-style', get_stylesheet_directory_uri() . '/css/menu-styles.css');
  wp_enqueue_style('owl-style', get_stylesheet_directory_uri() . '/js/owl/owl.carousel.css');
  wp_enqueue_style('owl-theme', get_stylesheet_directory_uri() . '/js/owl/owl.theme.css');

  /* adding js */

  wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'));
  wp_enqueue_script('fancybox-js', get_stylesheet_directory_uri() . '/js/fancybox/jquery.fancybox.js', array('jquery'));
  wp_enqueue_script('script-js', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'));
  //wp_enqueue_script('easy-zoom-js', get_stylesheet_directory_uri() . '/js/jquery.elevatezoom.js', array( 'jquery' ) );
  wp_enqueue_script('easyzoom-js', get_stylesheet_directory_uri() . '/js/easyzoom.js', array('jquery'));
  wp_enqueue_script('owl-js', get_stylesheet_directory_uri() . '/js/owl/owl.carousel.js', array('jquery'));
  wp_enqueue_script('owl-js', get_stylesheet_directory_uri() . '/js/owl/owl.carousel.js', array('jquery'));
}

/* add stylesheets and javascript to child theme [end] */


/* add file for custom post type & sidebar [start] */

require "acf-gallery/acf-gallery.php";
require "custom-post-type.php";

add_sidebar('Footer Block 1', 'footer_block_1');
add_sidebar('Footer Block 2', 'footer_block_2');
add_sidebar('Footer Block 3', 'footer_block_3');

/* add file for custom post type & sidebar [end] */


// thumbnail support
add_action('after_setup_theme', 'setup');

function setup() {
  add_theme_support('post-thumbnails'); // This feature enables post-thumbnail support for a theme
  add_image_size('post_thumb_image', 370, 240, true); // thumb image	
  add_image_size('product_shop_single', 400, 400, true); // product shop main image	

  add_image_size('ProductThumbImage', 270, 270, true);
  //the_post_thumbnail('ProductThumbImage');
}

// order by filter logic
add_filter('woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args');

function custom_woocommerce_get_catalog_ordering_args($args) {
  $orderby_value = isset($_GET['orderby']) ? woocommerce_clean($_GET['orderby']) : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

  $args['order'] = (isset($_GET['order']) && $_GET['order'] == 'DESC') ? 'DESC' : 'ASC';

  if (isset($_GET['posts_per_page']) && $_GET['posts_per_page'] != "") {
    $args['posts_per_page'] = $_GET['posts_per_page'];
    global $wp_query;
    $wp_query->set('posts_per_page', $_GET['posts_per_page']);
  }

  if ('name' == $orderby_value) {
    $args['orderby'] = 'title';
    $args['meta_key'] = '';
  } elseif ('price' == $orderby_value) {
    $args['orderby'] = 'price';
    $args['meta_key'] = '';
  } elseif ('position' == $orderby_value) {
    $args['orderby'] = 'position';
    $args['meta_key'] = '';
  }

  //echo "<pre>";
  //print_r($args);
  //echo "</pre>";

  return $args;
}

add_filter('woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby');
add_filter('woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby');

function custom_woocommerce_catalog_orderby($sortby) {
  $sortby = array();
  $sortby['name'] = 'Name';
  $sortby['price'] = 'Price';
  $sortby['position'] = 'Position';

  //echo "<pre>";
  //print_r($sortby);
  //echo "</pre>";

  return $sortby;
}

/* shop page sidebar logic */

function check_for_child($term_id) {

  $child = get_term_children($term_id, 'product_cat');

  if (is_array($child) && (count($child) > 0)) {
    return true;
  } else {
    return false;
  }
}

function get_parent_terms($term) {
  if ($term->parent > 0) {
    $term = get_term_by("id", $term->parent, "product_cat");
    if ($term->parent > 0) {
      get_parent_terms($term);
    } else
      return $term;
  } else
    return $term;
}

// wishlist short description code
function wishlist_get_the_excerpt($post_id) {
  global $post;
  $save_post = $post;
  $post = get_post($post_id);
  $output = get_the_excerpt();
  $post = $save_post;
  return $output;
}

// register add extra fields [start]
add_filter( 'woocommerce_register_form_start', 'adding_custom_registration_fields' );
function adding_custom_registration_fields( ) {
	
	echo '<h2>Personal Information</h2><div class="row"><div class="col-md-3"><p class="form-row form-row-wide"><label for="reg_firstname">'.__('First Name', 'woocommerce').' <span class="required">*</span></label>
<input type="text" class="input-text required-input" name="firstname" id="reg_firstname" size="30" value="'.esc_attr($_POST['firstname']).'"/><span class="error-msg">This value is required</span></p></div>';

	echo '<div class="col-md-3"><p class="form-row form-row-wide"><label for="reg_lastname">'.__('Last Name', 'woocommerce').' <span class="required">*</span></label>
<input type="text" class="input-text required-input" name="lastname" id="reg_lastname" size="30" value="'.esc_attr($_POST['lastname']).'"/><span class="error-msg">This value is required</span></p></div></div>';

}

//Validation registration form  after submission using the filter registration_errors
add_filter('registration_errors', 'registration_errors_validation', 10,3);
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
		global $woocommerce;
		extract($_POST); // extracting $_POST into separate variables
		
		if($firstname == '' ) {
			$woocommerce->add_error( __( 'Please, fill in all the required fields.', 'woocommerce' ) );
		}
		if($lastname == '' ) {
			$woocommerce->add_error( __( 'Please, fill in all the required fields.', 'woocommerce' ) );
		}
		
		return $reg_errors;
}

//Updating use meta after registration successful registration
add_action('woocommerce_created_customer','adding_extra_reg_fields');

function adding_extra_reg_fields($user_id) {
	extract($_POST);
	update_user_meta($user_id, 'first_name', $firstname);

        // can also do multiple fields like that
        update_user_meta($user_id, 'last_name', $lastname);
}

// register add extra fields end //


function AdvanceSearchFilter($query) {
	
	if(isset($_REQUEST['submit_query']) && $_REQUEST['submit_query'] =="Search"){
		
		$query->set('post_type', 'product');
		
		//alter meta query
		$meta_query = $query->get('meta_query');
		
		$meta_query['relation'] = 'OR';
			
		if(isset($_REQUEST['item_price']) && $_REQUEST['item_price'] !=""){

			$arrayObj = array(
				'key' => '_price',
				'value' => $_REQUEST['item_price'],
				'compare' => 'LIKE',				
			);
			
			array_push($meta_query, $arrayObj);
		}
		
		if(isset($_REQUEST['_sku']) && $_REQUEST['_sku'] !=""){
			$arrayObj = array(
				'key' => '_sku',
				'value' => $_REQUEST['_sku'],
				'compare' => 'LIKE',
			);
			
			array_push($meta_query, $arrayObj);		
		}
		
		if(isset($_REQUEST['item_description']) && $_REQUEST['item_description'] !=""){
			$arrayObj = array(
				'key' => 'description',
				'value' => $_REQUEST['_sku'],
				'compare' => 'LIKE',
			);
			
			array_push($meta_query, $arrayObj);		
		}		
		
		$query->set('meta_query', $meta_query);
		
		if(isset($_REQUEST['item_category']) && $_REQUEST['item_category'] !=""){
			/* meta query */
			$taxquery = array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'id',
						'terms' => array( $_REQUEST['item_category'] ),
						'operator'=> 'IN'
					)
				);
			
			$query->set( 'tax_query', $taxquery );			
		}
		
	}
	
	return $query;
}
add_filter('pre_get_posts','AdvanceSearchFilter');
