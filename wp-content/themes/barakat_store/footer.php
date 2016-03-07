<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<?php wp_footer(); ?>

<!-- Footer -->
<footer>
  <div class="footer_detail">
    <!-- Detail 1 -->
    <div class="detail_1">
      <div class="container">
        <ul>

          <?php
          $menu = 'Footer Menu';
          $args = array(
              'order' => 'ASC',
              'orderby' => 'menu_order',
              'post_type' => 'nav_menu_item',
              'post_status' => 'publish',
              'output' => ARRAY_A,
              'output_key' => 'menu_order',
              'nopaging' => true,
              'update_post_term_cache' => false);
          $items = wp_get_nav_menu_items($menu, $args);

          foreach ($items as $item):
            ?>

            <li><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a></li>

          <?php endforeach; ?>

        </ul>
      </div>
    </div>
    <!-- Detail 2 -->
    <div class="detail_2">
      <div class="container">
        <div class="inner">
          <div class="row">
            <div class="col-lg-3 col-sm-3 col-xs-12">
              <?php dynamic_sidebar('footer_block_1'); ?>
            </div>
            <div class="col-lg-5 col-sm-5 col-xs-12">
              <?php dynamic_sidebar('footer_block_2'); ?>
            </div>
            <div class="col-lg-4 col-sm-4 col-xs-12">
              <?php dynamic_sidebar('footer_block_3'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Detail 3 -->    
    <div class="social_block">
      <div class="container">
        <a href="<?php echo kc_get_option('social', 'social-media-settings', 'facebook'); ?>"><i class="fa fa-facebook"></i></a>
        <a href="<?php echo kc_get_option('social', 'social-media-settings', 'twitter'); ?>"><i class="fa fa-twitter"></i></a>
        <a href="<?php echo kc_get_option('social', 'social-media-settings', 'tumblr'); ?>"><i class="fa fa-tumblr"></i></a>
        <a href="<?php echo kc_get_option('social', 'social-media-settings', 'youtube'); ?>"><i class="fa fa-youtube"></i></a>
        <a href="<?php echo kc_get_option('social', 'social-media-settings', 'pinterest'); ?>"><i class="fa fa-pinterest-p"></i></a>
        <a href="<?php echo kc_get_option('social', 'social-media-settings', 'ebay'); ?>"><i><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/eba.png" alt=""></i></a>
      </div>
    </div>
  </div>
</footer>


<!-- Js -->
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/jquery.min.js"></script>
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/bootstrap.min.js"></script>  

<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/fancybox/jquery.fancybox.js"></script>  
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/script.js"></script>  
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/jquery.elevatezoom.js"></script>  

<script>
  $(function () {
    $(".dropdown").hover(
            function () {
              $(this).addClass('open')
            },
            function () {
              $(this).removeClass('open')
            }
    );

    /*$('.navbar-nav').find('li').addClass('dropdown yamm-fw');
     $('.navbar-nav').find('li').find('a').addClass('dropdown-toggle');
     $('.navbar-nav').find('li').find('ul').addClass('dropdown-menu');*/


    // added by ajay
    //$('#menu-header li:first').addClass('yamm-fw');
    //alert ('test');

    $(".dropdown").hover(
            function () {
              $(this).addClass('open')
            },
            function () {
              $(this).removeClass('open')
            }
    );

    $('.fancybox').fancybox();
	
	$('#product_name').val("<?php echo get_the_title(); ?>");
	$('#product_name').css("display", 'none');
	
	    $('#zoom_01').elevateZoom({
			zoomType: "inner",
			cursor: "crosshair",
			zoomWindowFadeIn: 500,
			zoomWindowFadeOut: 750
		}); 
		
		$('.single_thumb_src').on('click', function(event){
			$('#zoom_01').attr('src', $(this).attr('href'));
			//alert($('#zoom_01').attr('src'));
		});
	
			// equal height 
		equalHeight($('.blog_block'));
		function equalHeight(group) {
		  tallest = 0;
		  group.each(function () {
			thisHeight = $(this).height();
			if (thisHeight > tallest) {
			  tallest = thisHeight;
			}
		  });
		  group.height(tallest);
		}
		
  });
</script>

</body>
</html>
