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
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>

  </head>

  <body <?php body_class(); ?>>
	<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-61912116-1', 'auto');
      ga('send', 'pageview');
    </script>
    <!-- Header -->
    <header>
      <!-- Top Part -->
      <div class="top_part">
        <!-- Top Link -->
        <div class="top_link">
          <div class="container">
            <div class="left">
              <ul>
                <li><a href="#inline1" class="fancybox join_email">Join Our Email List</a></li>
                <li><a href="<?php echo site_url(); ?>/contact-us/">Contact Us</a></li>

                <?php if (is_user_logged_in()): $current_user = wp_get_current_user(); ?>

                  <li><a href="<?php echo site_url(); ?>/my-account/">Welcome, <?php echo $current_user->user_login; ?></a></li>

                <?php endif; ?>

              </ul>
            </div>

          </div>
        </div>

        <!-- Logo Sec -->
        <div class="logo_sec">
          <div class="container">
            <!-- Logo -->
            <div class="logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/logo.jpg" alt=""></a></div>

            <!-- Right Block -->
            <div class="right_block">
              <!-- Menu -->
              <ul class="right_menu">
                <li><a href="<?php echo site_url(); ?>/my-account/">Account</a></li>
                <li><a href="<?php echo site_url(); ?>/auction/">Auction</a></li>

                <?php if (is_user_logged_in()): $wishlist_product_count = yith_wcwl_count_products(); ?>

                  <li><a href="<?php echo site_url(); ?>/wishlist/">Wishlist <?php
                      if ($wishlist_product_count > 0): echo '(' . $wishlist_product_count . ')';
                      endif;
                      ?></a></li>
                  <li><a href="<?php echo site_url(); ?>/my-account/customer-logout/">Logout</a></li>

<?php else: ?>

                  <li><a href="<?php echo site_url(); ?>/my-account/">Wishlist</a></li>
                  <li><a href="<?php echo site_url(); ?>/my-account/">Login</a></li>
<?php endif; ?>

                <li><a href="<?php echo site_url(); ?>/create-account/">Sign Up</a></li>
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