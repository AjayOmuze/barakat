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
global $wp_query;

if ( ! woocommerce_products_will_display() )
	return;
?>

<div class="row" style="margin-bottom: 10px !important;">
    <div class="col-md-10">
        <form class="woocommerce-ordering" method="get" style="float: none;">
        <table class="table table-no-margin">
            <tr>
                <td width="20%">
                    <label id="orderby-label">
                    <b>    
                <!--<p class="woocommerce-result-count">-->
                        <?php
                        $paged    = max( 1, $wp_query->get( 'paged' ) );
                        $per_page = $wp_query->get( 'posts_per_page' );
                        $total    = $wp_query->found_posts;
                        $first    = ( $per_page * $paged ) - $per_page + 1;
                        $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

                        if ( 1 == $total ) {
                                _e( 'Showing the single result', 'woocommerce' );
                        } elseif ( $total <= $per_page || -1 == $per_page ) {
                                printf( __( '%d Item(s)', 'woocommerce' ), $total );
                        } else {
                                printf( _x( 'Showing %1$d&ndash;%2$d of %3$d', '%1$d = first, %2$d = last, %3$d = total', 'woocommerce' ), $first, $last, $total );
                        }
                        ?>
                    </b>
                    </label>                    
                    
                </td>
<td width="40%">
        <label id="orderby-label">Sort By</label>
        <select name="orderby" class="orderby custom-select">
            <?php foreach ($catalog_orderby_options as $id => $name) : ?>
                <option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?php echo esc_html($name); ?></option>
            <?php endforeach; ?>
        </select>        
        <?php if((isset($_REQUEST['order']) && $_REQUEST['order']== 'ASC')):?>
            <a class="btn change-order" style="color: #000;">
                <i class="fa fa-long-arrow-up"></i>
            </a>        
            <a title="Set Desceding Direction" class="btn btn-theme change-order-2" data-val="DESC" style="padding: 5px 7px !important;display: none;">                
                <i class="fa fa-long-arrow-down"></i>
            </a>                
        <?php else:?>
            <a class="btn change-order" style="color: #000;">
                <i class="fa fa-long-arrow-down"></i>
            </a>        
            <a title="Set Ascending Direction" class="btn btn-theme change-order-2" data-val="ASC" style="padding: 5px 7px !important;display: none;">
                <i class="fa fa-long-arrow-up"></i>
            </a>        
        <?php endif;?>
</td>
<td width="40%">
        <label id="orderby-label">Show</label>
        <select name="posts_per_page" class="orderby custom-select">		
            <option value="12" <?php echo (isset($_GET['posts_per_page']) && $_GET['posts_per_page'] == 12) ? 'selected' : ''; ?>>12</option>
            <option value="25" <?php echo (isset($_GET['posts_per_page']) && $_GET['posts_per_page'] == 25) ? 'selected' : ''; ?>>25</option>		
            <option value="50" <?php echo (isset($_GET['posts_per_page']) && $_GET['posts_per_page'] == 50) ? 'selected' : ''; ?>>50</option>		
            <option value="100" <?php echo (isset($_GET['posts_per_page']) && $_GET['posts_per_page'] == 100) ? 'selected' : ''; ?>>100</option>		
            <option value="200" <?php echo (isset($_GET['posts_per_page']) && $_GET['posts_per_page'] == 200) ? 'selected' : ''; ?>>200</option>		
            <option value="-1" <?php echo (isset($_GET['posts_per_page']) && $_GET['posts_per_page'] == -1) ? 'selected' : ''; ?>>All</option>		
        </select>     
        <label id="orderby-label">Per page</label>
            <select name="order" class="orderby orderby-select" style="display: none;">  
                <option value="ASC" <?php echo (isset($_GET['order']) && $_GET['order']== 'ASC')? 'selected' : '';?>>ASC</option>
                <option value="DESC" <?php echo (isset($_GET['order']) && $_GET['order']== 'DESC')? 'selected' : '';?>>DESC</option>  
            </select>                                           
            <?php
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
    
</td>        
            </tr>        
        </table>
        </form>   
    </div>
	
	<div class="clearfix"></div>
	
	<div class="col-md-12">
	
		<?php global $wp_query;

		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}
		?>
		<nav class="woocommerce-pagination">
			Page : <?php
				echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
					'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
					'format'       => '',
					'add_args'     => '',
					'current'      => max( 1, get_query_var( 'paged' ) ),
					'total'        => $wp_query->max_num_pages,
					'prev_text'    => '<i class="fa fa-angle-left"></i>',
					'next_text'    => '<i class="fa fa-angle-right"></i>',
					'type'         => 'list',
					'end_size'     => 3,
					'mid_size'     => 3
				) ) );
			?>
		</nav>

	</div>
	
	<div class="clearfix">&nbsp;</div>
	
</div>
