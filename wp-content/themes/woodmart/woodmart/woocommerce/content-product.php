<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

$is_slider 		   = woodmart_loop_prop( 'is_slider' );
$is_shortcode 	   = woodmart_loop_prop( 'is_shortcode' );
$different_sizes   = woodmart_loop_prop( 'products_different_sizes' );
$hover 			   = woodmart_loop_prop( 'product_hover' );
$current_view      = woodmart_loop_prop( 'products_view' );
$shop_view 		   = woodmart_get_opt( 'shop_view' );
$xs_columns 	   = (int) woodmart_get_opt( 'products_columns_mobile' );

// Ensure visibility
if ( ! $product || ( ! $is_slider && ! $product->is_visible() ) ) return;

// Increase loop count
woodmart_set_loop_prop( 'woocommerce_loop', woodmart_loop_prop( 'woocommerce_loop' ) + 1 );
$woocommerce_loop = woodmart_loop_prop( 'woocommerce_loop' );

// Swatches
woodmart_set_loop_prop( 'swatches', woodmart_swatches_list() );

// Extra post classes
$classes = array( 'product-grid-item' );

//Label classes
if ( get_post_meta( $product->get_id(), '_woodmart_new_label', true ) && woodmart_get_opt( 'new_label' ) ) $classes[] = 'new-label'; 
if ( woodmart_get_product_attributes_label() ) $classes[] = 'attributes-label'; 

$classes[] = 'product'; 
$classes[] = ( get_option( 'woocommerce_enable_review_rating' ) == 'yes' && $product->get_rating_count() > 0 ) ? 'has-stars' : 'without-stars'; 
$classes[] = ( ! woodmart_loop_prop( 'swatches' ) ) ? 'product-no-swatches' : 'product-with-swatches';

//Quick shop class
if( woodmart_get_opt( 'quick_shop_variable' ) ) $classes[] = 'quick-shop-on'; 

//Quick view class
if ( woodmart_get_opt( 'quick_view' ) ) {
	$classes[] = 'quick-view-on'; 
}else{
	$classes[] = 'quick-view-off'; 
}

//Grid or list style
if ( $shop_view == 'grid' || $shop_view == 'list' )	$current_view = $shop_view;

if ( $is_slider ) $current_view = 'grid';

if ( $is_shortcode ) $current_view = woodmart_loop_prop( 'products_view' );

if( $current_view == 'list' ){
	$hover = 'list';
	woodmart_set_loop_prop( 'products_columns', 1 );
	$classes[] = 'product-list-item'; 
}else{
	$classes[] = 'woodmart-hover-' . $hover; 
}

$xs_size = 12 / $xs_columns;

$products_columns = woodmart_loop_prop( 'products_columns' );

if ( $products_columns == 1 ) $xs_size = 12;

if( $different_sizes && in_array( $woocommerce_loop, woodmart_get_wide_items_array( $different_sizes ) ) ) woodmart_set_loop_prop( 'double_size', true );

if( ! $is_slider ){
	$classes[] = woodmart_get_grid_el_class( $woocommerce_loop , $products_columns, $different_sizes, $xs_size );
}else{
	$classes[] = 'product-in-carousel';
}

?>
	<div <?php post_class( $classes ); ?> data-loop="<?php echo esc_attr( $woocommerce_loop ); ?>" data-id="<?php echo esc_attr( $product->get_id() ); ?>">

		<?php wc_get_template_part( 'content', 'product-' . $hover ); ?>

	</div>
<?php 


if( ! $is_slider && ! woodmart_loop_prop( 'products_masonry' ) && $current_view != 'list' ){
	echo woodmart_get_grid_clear( $woocommerce_loop, $products_columns, $xs_columns );
} 