<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	
	<!-- Bootstrap -->
	<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.css" rel="stylesheet">
	<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/custom.css" rel="stylesheet">
	<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/font-awesome.min.css" rel="stylesheet">
	<!--[if lt IE 9]>
		  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5shiv.js"></script>
		  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/respond.min.js"></script>
		<![endif]-->
	<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/yamm.css" rel="stylesheet">    
  
  <!-- fancybox -->
  <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/js/fancybox/jquery.fancybox.css" rel="stylesheet">
  <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/menu-styles.css" rel="stylesheet">

</head>

<body <?php body_class(); ?>>


<!-- Header -->
<header>
<!-- Top Part -->
<div class="top_part">
	<!-- Top Link -->
    <div class="top_link">
    	<div class="container">
    		<div class="left">
                <ul>
                    <li><a href="#">Join Our Email List</a></li>
                    <li><a href="<?php echo site_url(); ?>/contact-us/">Contact Us</a></li>
					
					<?php if(is_user_logged_in()): $current_user = wp_get_current_user(); ?>
					
					<li><a href="<?php echo site_url(); ?>/my-account/">Welcome, <?php echo $current_user->user_login; ?></a></li>
						
					<?php endif; ?>
					
                </ul>
            </div>
            
            <div class="currency_btn">
            	<div class="btn-group">
                  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Currency: USD <span class="caret"></span></button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="#">GBP - British Pound Sterling</a></li>
                        <li><a href="#">EUR - Euro</a></li>
                        <li><a href="#">USD - US Dollar</a></li>
                        <li><a href="#">AED - United Arab Emirates Dirham</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Logo Sec -->
    <div class="logo_sec">
    	<div class="container">
        	<!-- Logo -->
    		<div class="logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.jpg" alt=""></a></div>
            
            <!-- Right Block -->
            <div class="right_block">
            	<!-- Menu -->
                <ul class="right_menu">
                	<li><a href="<?php echo site_url(); ?>/my-account/">Account</a></li>
                    <li><a href="<?php echo site_url(); ?>/auction/">Auction</a></li>
					
					<?php if(is_user_logged_in()): $wishlist_product_count = yith_wcwl_count_products();?>
					
						<li><a href="<?php echo site_url(); ?>/wishlist/">Wishlist <?php if($wishlist_product_count > 0): echo '('.$wishlist_product_count.')'; endif; ?></a></li>
						<li><a href="<?php echo site_url(); ?>/my-account/customer-logout/">Logout</a></li>
					
					<?php else: ?>
					
						<li><a href="<?php echo site_url(); ?>/my-account/">Wishlist</a></li>
						<li><a href="<?php echo site_url(); ?>/my-account/">Login</a></li>
					<?php endif; ?>
					
                    <li><a href="<?php echo site_url(); ?>/my-account/">Sign Up</a></li>
                </ul>
                <form action="<?php echo site_url(); ?>" method="GET">
				
					<!-- Search Sec -->
					<div class="search_sec">
						<div class="search">
							<div class="input-group">
									
								  <input type="text" name="s" class="form-control" placeholder="Search Entire store here...">
								  <span class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
								  </span>
								
							</div>
						</div>
						<div class="advanced"><a href="<?php echo site_url(); ?>/advanced-search/">Advanced Search</a></div>
					</div>
					
				</form>
            </div>
        </div>
    </div>
</div>

<!-- Nav Sec -->
      <div class="nav_sec">
        <div class="container">
          <nav class="navbar yamm navbar-default" role="navigation">
            <div id="cssmenu">
				
				<?php
				  $defaults = array(
					  'theme_location' => 'primary',
					  'container' => false,
					  'menu_class' => 'dropdown-menu',
					  'menu_id' => 'menu-header',
					  'echo' => true,
					  'fallback_cb' => 'wp_page_menu',
					  'items_wrap' => '<ul class="has-sub" id="%1$s">%3$s</ul>',
					  'depth' => 5,
				  );
				  wp_nav_menu($defaults);
				?>
				
			</div>
			
          </nav>
        </div>
      </div>  
	  
</header>

