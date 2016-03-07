<?php
$backUrl = $_SERVER['HTTP_REFERER'];
$product_id = isset($_REQUEST['product_id']) ? $_REQUEST['product_id']:0;
$product  = get_post($product_id);
$name = "";
$email = "";

if(is_user_logged_in())
{
    $current_user = wp_get_current_user();        
    
    $array  = get_user_meta($current_user->id, 'first_name');
    
    
    if(is_array($array) && isset($array[0]))
        $name .= $array[0];    
    
    $array  = get_user_meta($current_user->id, 'last_name');
    if(is_array($array) && isset($array[0]))
        $name .= " ".$array[0];    
    
    $email = $current_user->user_email;
    
    if(trim($name) == "")
    $name = $current_user->display_name;
}

if(count($product) > 0)
{
    $foundProduct = 1;
    $backUrl = get_permalink($product);
}   
else
{
    $foundProduct = 0;
}

/**
 * Template Name: Share Product Page
 */
get_header();

?>

<!-- Section -->
<section>
  <!-- Blog Sec -->
  <div class="blog_sec">
    <div class="container">
      <?php
      if (function_exists(simple_breadcrumb)) {
        simple_breadcrumb();
      }
      ?>
      <div class="row share-form-area">
        <div class="col-lg-12">
          <?php if($foundProduct):?>  
            <h1 class="page-title">Share</h1>  
            <h2 class="legend">Sender: </h2>
            <form id="share-form">
                <div class="row mBottom8">
                    <div class="col-md-4">
                        <label class="label-control">Name: <span class="error">*</span></label>
                        <input type="text" class="form-control required-input" name="name" value="<?php echo $name;?>"/>
                        <p class="error-msg">This value is required</p>
                    </div>
                    <div class="col-md-4">
                        <label class="label-control">Email: <span class="error">*</span></label>
                        <input type="text" class="form-control required-input" name="email" value="<?php echo $email;?>"/>                        
                        <p class="error-msg">This value is required</p>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>    
                
                <div class="row mBottom8">
                    <div class="col-md-12">
                        <label class="label-control">Message: <span class="error">*</span></label>
                        <textarea class="form-control required-input" name="message"></textarea>
                        <p class="error-msg">This value is required</p>
                    </div>    
                </div>    
                <h2 class="legend">Recipient: </h2>
                <div class="row mBottom8">
                    <div class="col-md-4">
                        <label class="label-control">Name: <span class="error">*</span></label>
                        <input type="text" class="form-control required-input" name="rec_name[]"/>
                        <p class="error-msg">This value is required</p>
                    </div>
                    <div class="col-md-4">
                        <label class="label-control">Email: <span class="error">*</span></label>
                        <input type="text" class="form-control required-input" name="rec_email[]"/>                        
                        <p class="error-msg">This value is required</p>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>                    
                <div id="add_receipt_area" class="mBottom8">                    
                </div>
                <div class="row mBottom8">
                    <div class="col-md-4">
                        <a class="button" href="<?php echo $backUrl?>"><span><span>Back</span></span></a>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button class="button add-row" type="button"><span><span>Add Recipient</span></span></button>                        
                        <button class="button" type="submit"><span><span>Send Email</span></span></button>                        
                    </div>
                </div>
                <input type="hidden" name="page_url" value="<?php echo get_permalink($product);?>" />
                <input type="hidden" name="page_title" value="<?php echo $product->post_title;?>" />
            </form>
          <?php else: ?>  
            <h3>Product Not Found.</h3>  
          <?php endif;?>  
          <div class="clearfix"></div>          
        </div>
        <div class="col-lg-12"></div>  
      </div>
    </div>
  </div>
</section>
<div id="row_html" style="display: none;">
<div class="row mBottom8">
    <p class="btn-remove-p">
        <a href="javascript:void(0);" class="btn-remove" title="Remove Email" href="delete_email">
            <i class="fa fa-close"></i>
        </a>
    </p>            
    <div class="col-md-4">
        <label class="label-control">Name: <span class="error">*</span></label>
        <input type="text" class="form-control required-input" name="rec_name[]" />
        <p class="error-msg">This value is required</p>
    </div>
    <div class="col-md-4">
        <label class="label-control">Email: <span class="error">*</span></label>
        <input type="text" class="form-control required-input" name="rec_email[]"/>                        
        <p class="error-msg">This value is required</p>
    </div>
    <div class="col-md-4">
    </div>
</div>                    
</div>
<div id="AjaxLoaderDiv" style="display: none;z-index:9999999 !important;">
    <div style="width:100%; height:100%; left:0px; top:0px; position:fixed; opacity:0; filter:alpha(opacity=40); background:#000000;z-index:999999999;">
    </div>
    <div style="float:left;width:100%; left:0px; top:50%; text-align:center; position:fixed; padding:0px; z-index:999999999;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader.gif">
        </center>
    </div>
</div>

<?php
//get_sidebar();
get_footer();
?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.bootstrap-growl.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
   jQuery(document).on('click','.add-row',function(){
       jQuery('#add_receipt_area').append(jQuery('#row_html').html());
   }); 
   jQuery(document).on('click','.btn-remove',function(){
       jQuery(this).parent().parent().remove();
   }); 
   
   jQuery('#share-form').submit(function(){
       
       $flag = 1;
       
       jQuery('#share-form .error-msg').hide();
       
       jQuery('#share-form .required-input').removeClass('error');
       
       jQuery('#share-form .required-input').each(function(){
           
           if(jQuery.trim(jQuery(this).val()) == "")
           {
               jQuery(this).addClass('error');
               jQuery(this).next('.error-msg').show();
               $flag = 0;
           }
       });
       
       if($flag == 1)
       {
           jQuery('#AjaxLoaderDiv').fadeIn('slow');
           
           jQuery.ajax({
                type: 'post',
                url: '<?php echo site_url()."/share_product_email.php"?>',
                data: jQuery(this).serialize(),
                success: function (data) {

                    jQuery('#AjaxLoaderDiv').fadeOut('fast');

                    data = jQuery.parseJSON(data);

                    if (data.status == 1)
                    {
                        jQuery.bootstrapGrowl(data.msg, {type: 'success'});
                        jQuery('.form-control').val('');
                        setTimeout(function(){
                            window.location = '<?php echo $backUrl?>';
                        },1200);
                    }
                    else
                    {
                        jQuery.bootstrapGrowl(data.msg, {type: 'danger'});
                    }
                },
                error: function (e) 
                {
                    jQuery('#AjaxLoaderDiv').fadeOut('fast');
                    jQuery.bootstrapGrowl("Server Error!", {type: 'danger'});
                }
            });
           
       }
       return false; 
   });
});
</script>