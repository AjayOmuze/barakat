<?php
/**
 * Template Name: New user signup
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header();
?>

<!-- Section -->
<section>
    <!-- Blog Sec -->
    <div class="blog_sec">
        <div class="container">

            <?php wc_print_notices(); ?>


            <h3 class="create_title"><?php _e('Create an Account', 'woocommerce'); ?></h3>

            <form method="post" class="register wp-signup-form" onsubmit="">

                <?php do_action('woocommerce_register_form_start'); ?>

                <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

                    <p class="form-row form-row-wide">
                        <label for="reg_username"><?php _e('Username', 'woocommerce'); ?> <span class="required">*</span></label>
                        <input type="text" class="input-text" name="username" id="reg_username" value="<?php if (!empty($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
                    </p>

                <?php endif; ?>
                <div class="row">
                    <div class="col-md-3">

                        <p class="form-row form-row-wide">
                            <label for="reg_email"><?php _e('Email address', 'woocommerce'); ?> <span class="required">*</span></label>
                            <input type="text" class="input-text required-input" name="email" id="reg_email" value="<?php if (!empty($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
                            <span class="error-msg">This value is required</span>
                        </p>

                    </div>
                </div>

                <div class="row">
                    <div class="clearfix">&nbsp;</div>
                    <div class="col-md-12"><h2>Login Information</h2></div>
                    <div class="clearfix"></div>
                    <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                        <div class="col-md-3">					
                            <p class="form-row form-row-wide">
                                <label for="reg_password"><?php _e('Password', 'woocommerce'); ?> <span class="required">*</span></label>
                                <input type="password" class="input-text required-input" name="password" id="reg_password" />                                
                                <span class="error-msg">This value is required</span>
                            </p>						
                        </div>						
                    <?php endif; ?>
                    <div class="col-md-3">					
                        <p class="form-row form-row-wide">
                            <label for="reg_password"><?php _e('Confirm Password', 'woocommerce'); ?> <span class="required">*</span></label>                            
                            <input type="password" class="input-text required-input" id="reg_retype_password" />
                            <span class="error-msg">This value is required</span>
                        </p>
                    </div>

                </div>

                <!-- Spam Trap -->
                <div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e('Anti-spam', 'woocommerce'); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

                <?php do_action('woocommerce_register_form'); ?>
                <?php do_action('register_form'); ?>

                <p class="form-row">
                    <?php wp_nonce_field('woocommerce-register'); ?>
                    <a class="back-link btn btn-theme pull-left" href="/my-account/"><small>« </small>Back</a>
                    <input type="submit" class="button btn btn-theme pull-right" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>" />
                </p>

                <?php do_action('woocommerce_register_form_end'); ?>

            </form>


        </div>
    </div>
</section>

<?php
//get_sidebar();
get_footer();

