<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

    <div class="col-md-6">
            <form class="woocommerce-ordering" method="get" style="float: none;">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                              <label>Sort By : </label>
                              <select name="orderby" class="orderby form-control">
                                      <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                                              <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
                                      <?php endforeach; ?>
                              </select>                
                </div>                
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Order : </label>
                    <select name="order" class="orderby form-control">		
                            <option value="ASC" <?php echo (isset($_GET['order']) && $_GET['order']== 'ASC')? 'selected' : '';?>>ASC</option>
                            <option value="DESC" <?php echo (isset($_GET['order']) && $_GET['order']== 'DESC')? 'selected' : '';?>>DESC</option>		
                    </select>                                    
                </div>    
            </div>
            <div class="col-md-4">
                <div class="form-group">
                        <label>Show : per page</label>
                        <select name="posts_per_page" class="orderby form-control">		
                                <option value="12" <?php echo (isset($_GET['posts_per_page']) && $_GET['posts_per_page']== 12)? 'selected' : '';?>>12</option>
                                <option value="25" <?php echo (isset($_GET['posts_per_page']) && $_GET['posts_per_page']== 25)? 'selected' : '';?>>25</option>		
                                <option value="50" <?php echo (isset($_GET['posts_per_page']) && $_GET['posts_per_page']== 50)? 'selected' : '';?>>50</option>		
                                <option value="100" <?php echo (isset($_GET['posts_per_page']) && $_GET['posts_per_page']== 100)? 'selected' : '';?>>100</option>		
                                <option value="200" <?php echo (isset($_GET['posts_per_page']) && $_GET['posts_per_page']== 200)? 'selected' : '';?>>200</option>		
                                <option value="-1" <?php echo (isset($_GET['posts_per_page']) && $_GET['posts_per_page']== -1)? 'selected' : '';?>>All</option>		
                        </select>                    
                </div>   	                
            </div>
        </div>	
	<?php
		// Keep query string vars intact
		
		foreach ( $_GET as $key => $val ) {
			
			if ( 'orderby' === $key || 'submit' === $key || 'order' === $key || 'posts_per_page' === $key ) {
				continue;
			}
			if ( is_array( $val ) ) {
				foreach( $val as $innerVal ) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
			
		}
		
	?>
</form>        
    </div>
</div>
