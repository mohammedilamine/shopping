<?php
/**
 * Name: Product style 12
 * Slug: content-product-style-12
 **/
?>
<?php
remove_action( 'woocommerce_before_shop_loop_item_title', array( Kuteshop_Woo_Functions::get_instance(), 'kuteshop_group_flash' ), 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 20 );
?>
<div class="product-inner">
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>
    <div class="product-thumb">
        <?php
        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>
    </div>
    <div class="product-info equal-elem">
		<?php
		/**
		 * woocommerce_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );
		/**
		 * woocommerce_after_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
        <div class="product-button">
            <div class="add-to-cart">
				<?php
				/**
				 * woocommerce_after_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_close - 5
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item' );
				?>
            </div>
			<?php
			do_action( 'kuteshop_function_shop_loop_item_wishlist' );
			do_action( 'kuteshop_function_shop_loop_item_compare' );
			do_action( 'kuteshop_function_shop_loop_item_quickview' );
			?>
        </div>
    </div>
</div>
<?php
add_action( 'woocommerce_before_shop_loop_item_title', array( Kuteshop_Woo_Functions::get_instance(), 'kuteshop_group_flash' ), 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 20 );
?>