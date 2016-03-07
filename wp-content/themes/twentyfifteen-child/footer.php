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
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_custom_sharing"></div>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56a15d71051dc48b"></script>



<?php wp_footer(); ?>

<div id="inline1" class="popup_box" style="display: none;">
  <h4>Welcome to the Barakat Gallery</h4>
  <p>
    <?php do_shortcode('[simplenewsletter]') ?>
  </p>
  <p><i>Sign-up to become a member of the Barakat Gallery. You will receive exclusive promotions, collection highlights and exhibition news.</i></p>
</div>


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
        <a href="<?php echo kc_get_option('social', 'social-media-settings', 'ebay'); ?>"><i><img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/eba.png" alt=""></i></a>
        <a href="<?php echo kc_get_option('social', 'social-media-settings', 'google_plus'); ?>"><i class="fa fa-google-plus"></i></a>
      </div>
    </div>
  </div>
</footer>


<script>
  jQuery(function () {
      
      
    jQuery(".wp-signup-form").submit(function(){
        
        $reg_retype_password = jQuery('.wp-signup-form #reg_retype_password').val();
        $reg_password = jQuery('.wp-signup-form #reg_password').val();
        $reg_email = jQuery('.wp-signup-form #reg_email').val();
        $reg_firstname = jQuery('.wp-signup-form #reg_firstname').val();
        $reg_lastname = jQuery('.wp-signup-form #reg_lastname').val();
        
        jQuery('.wp-signup-form .error-msg').hide();       
        jQuery('.wp-signup-form .required-input').removeClass('error');

        if(jQuery.trim($reg_firstname) == "")
        {            
            jQuery('#reg_firstname').addClass('error');
            jQuery('#reg_firstname').next('.error-msg').text("This valus is required.");
            jQuery('#reg_firstname').next('.error-msg').show();                    
        }
        else if(jQuery.trim($reg_lastname) == "")
        {            
            jQuery('#reg_lastname').addClass('error');
            jQuery('#reg_lastname').next('.error-msg').text("This valus is required.");
            jQuery('#reg_lastname').next('.error-msg').show();                    
        }
        else if(jQuery.trim($reg_email) == "")
        {            
            jQuery('#reg_email').addClass('error');
            jQuery('#reg_email').next('.error-msg').text("This valus is required.");
            jQuery('#reg_email').next('.error-msg').show();                    
        }
        else if(jQuery.trim($reg_password) == "")
        {            
            jQuery('#reg_password').addClass('error');
            jQuery('#reg_password').next('.error-msg').text("This valus is required.");
            jQuery('#reg_password').next('.error-msg').show();                    
        }
        else if(jQuery.trim($reg_retype_password) == "")
        {
            jQuery('#reg_retype_password').addClass('error');
            jQuery('#reg_password').next('.error-msg').text("This valus is required.");
            jQuery('#reg_retype_password').next('.error-msg').show();                                
        }
        else if(jQuery.trim($reg_password) != jQuery.trim($reg_retype_password))
        {
            jQuery('#reg_password').addClass('error');
            jQuery('#reg_password').next('.error-msg').text("Password and confirm password not matched.");
            jQuery('#reg_password').next('.error-msg').show();                                
        }
        else
        {
            return true;
        }
        return false;
    });  
      
    

    jQuery(".change-order")
            .on("mouseenter", function () {
              jQuery('.change-order').hide();
              jQuery('.change-order-2').show();
            })
            .on("mouseleave", function () {
            });

    jQuery(".change-order-2")
            .on("mouseenter", function () {
            })
            .on("mouseleave", function () {
              jQuery('.change-order').show();
              jQuery('.change-order-2').hide();
            });


    jQuery(".change-order-2").click(function () {
      $val = jQuery(this).data('val');
      jQuery('.orderby-select').val($val);
      jQuery('.orderby-select').trigger('change');
    });

	if(jQuery('.owl-carousel-upsells-products').size() > 0){
		jQuery('.related-product-section').hide();
	}

<?php if (is_front_page()): ?>
      //alert ('test');
      jQuery('.join_email').fancybox().trigger('click');
<?php endif; ?>


    if (jQuery('.gallery_item_fancybox').size() > 0) {
      jQuery('.gallery_item_fancybox').fancybox();
    }
	
    var zoom_link = 0;

    jQuery(".owl-carousel-thumnails").owlCarousel({
      loop: false,
      dots: true,
      nav: true,
      items: 4,
      responsive: {
        0: {
          items: 2
        },
        480: {
          items: 2
        },
        767: {
          items: 3
        },
        992: {
          items: 4
        },
        1000: {
          items: 4,
        }
      }
    });

    /*
    setTimeout(function () {
      var viewport = jQuery(window).width();

      if (viewport >= 1000 && jQuery(".owl-carousel-thumnails .item").size() <= 4)
      {
        jQuery(".owl-carousel-thumnails .owl-controls").hide();
      }
      else if (viewport > 767 && jQuery(".owl-carousel-thumnails .item").size() <= 3)
      {
        jQuery(".owl-carousel-thumnails .owl-controls").hide();
      }
      else if (viewport <= 766 && jQuery(".owl-carousel-thumnails .item").size() <= 2)
      {
        jQuery(".owl-carousel-thumnails .owl-controls").hide();
      }
    }, 1200); */

    jQuery(".owls-slider-homepage").owlCarousel({
      singleItem: true,
      slideSpeed: 300,
      paginationSpeed: 500,
      autoplay: true,
      loop: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      stopOnHover: true,
      rewindNav: true,
      rewindSpeed: 600,
      autoHeight: true,
      transitionStyle: 'fade',
      nav: true,
      navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
      items: 1,
      responsive: {
        0: {
          items: 1
        },
        480: {
          items: 1
        },
        767: {
          items: 1
        },
        992: {
          items: 1
        },
        1000: {
          items: 1,
        }
      }

    });
    
    


    jQuery(document).on('click', '.upsells-arrow', function () {
      $className = jQuery(this).data('class');
      jQuery('.owl-carousel-upsells-products .' + $className).trigger('click');
    })

    jQuery(document).on('click', '.related-arrow', function () {
      $className = jQuery(this).data('class');
      jQuery('.owl-carousel-related-products .' + $className).trigger('click');
    })

    jQuery(document).on('click', '.thumnails-left-arrow, .thumnails-right-arrow', function () {
      $className = jQuery(this).data('class');
      jQuery('.owl-carousel-thumnails .' + $className).trigger('click');
    })


    jQuery(".owl-carousel-related-products").owlCarousel({
      loop: true,
      dots: true,
      nav: true,
      items: 6,
      responsive: {
        0: {
          items: 2
        },
        480: {
          items: 3
        },
        767: {
          items: 4
        },
        992: {
          items: 6
        },
        1000: {
          items: 6,
        },
        1900: {
          items: 6,
        }
      }
    });
    
    jQuery(".owl-carousel-upsells-products").owlCarousel({
      loop: true,
      dots: true,
      nav: true,
      items: 6,
      responsive: {
        0: {
          items: 2
        },
        480: {
          items: 3
        },
        767: {
          items: 4
        },
        992: {
          items: 6
        },
        1000: {
          items: 6,
        },
        1900: {
          items: 6,
        }
      }
    });
    
    
    setTimeout(function () {
      var viewport = jQuery(window).width();

      if (viewport >= 1000 && jQuery(".owl-carousel-thumnails .item").size() <= 4)
      {
        jQuery(".thumnails-arrow").hide();
      }
      else if (viewport > 767 && jQuery(".owl-carousel-thumnails .item").size() <= 3)
      {
        jQuery(".thumnails-arrow").hide();
      }
      else if (viewport <= 766 && jQuery(".owl-carousel-thumnails .item").size() <= 2)
      {
        jQuery(".thumnails-arrow").hide();
      }
    }, 1200);    

    jQuery(".dropdown").hover(
            function () {
              jQuery(this).addClass('open')
            },
            function () {
              jQuery(this).removeClass('open')
            }
    );

    /*$('.navbar-nav').find('li').addClass('dropdown yamm-fw');
     $('.navbar-nav').find('li').find('a').addClass('dropdown-toggle');
     $('.navbar-nav').find('li').find('ul').addClass('dropdown-menu');*/


    // added by ajay
    //$('#menu-header li:first').addClass('yamm-fw');
    //alert ('test');



    jQuery('.fancybox').fancybox();

    jQuery('#product_name').val("<?php echo get_the_title(); ?>");
    jQuery('#product_name').css("display", 'none');
    /*
     jQuery('#zoom_01').elevateZoom({
     zoomType: "inner",
     cursor: "crosshair",
     zoomWindowFadeIn: 500,
     zoomWindowFadeOut: 750
     }); 
     
     jQuery('.single_thumb_src').on('click', function(event){
     $('#zoom_01').attr('src', $(this).attr('href'));
     //alert($('#zoom_01').attr('src'));
     });
     */

    // equal height 

//equalHeight(jQuery('.search_block'));

    jQuery(window).load(function () {
      equalHeight(jQuery('.search_block'));
      equalHeight(jQuery('.press_pd'));
      
    })


    function equalHeight(group) {
      tallest = 0;
      group.each(function () {
        thisHeight = jQuery(this).height();
        if (thisHeight > tallest) {
          tallest = thisHeight;
        }
      });
      group.height(tallest);
    }


    // Instantiate EasyZoom instances
    var easyzoom = jQuery('.easyzoom').easyZoom();

    // Setup thumbnails example
    var api1 = easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

    jQuery('.thumbnails').on('click', 'a', function (e) {
      var $this = jQuery(this);

      e.preventDefault();
      zoom_link = jQuery(this).closest('.owl-item').index();
      // Use EasyZoom's `swap` method
      api1.swap($this.data('standard'), $this.attr('href'));

    });

    jQuery('.zoom_image').find('a').click(function () {
      jQuery('.fancy_thumb:eq(' + zoom_link + ')').trigger('click');
    });

	<?php if(is_product()): ?>
	
	<?php global $product; ?>
		
		/*if(jQuery('#product_inq_recipient').size() > 0){
			jQuery('#product_inq_recipient').val("<?php echo get_the_author_email(); ?>");		
			jQuery('#product_inq_recipient').css('display', 'none !important');
			jQuery('#product_inq_recipient').hide();			
		}*/
		
		// for offer contact form
		if(jQuery('#offer_product_name').size() > 0){
			jQuery('#offer_product_name').val("<?php echo get_the_title(); ?>");		
		}

		if(jQuery('#offer_product_url').size() > 0){
			jQuery('#offer_product_url').val("<?php echo get_the_permalink(); ?>");		
		}

		if(jQuery('#offer_product_sku').size() > 0){
			jQuery('#offer_product_sku').val("<?php echo $product->get_sku(); ?>");		
		}
		
		// for purchase contact form
		if(jQuery('#purchase_product_name').size() > 0){
			jQuery('#purchase_product_name').val("<?php echo get_the_title(); ?>");		
		}

		if(jQuery('#purchase_product_url').size() > 0){
			jQuery('#purchase_product_url').val("<?php echo get_the_permalink(); ?>");		
		}

		if(jQuery('#purchase_product_sku').size() > 0){
			jQuery('#purchase_product_sku').val("<?php echo $product->get_sku(); ?>");		
		}

	<?php endif; ?>
	
  });
</script>


</body>
</html>