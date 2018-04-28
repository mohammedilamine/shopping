<?php
/**
 *
 * Kuteshop products
 *
 */
if ( !class_exists( 'Products_Widget' ) ) {
	class Products_Widget extends WP_Widget
	{
		function __construct()
		{
			$widget_ops = array(
				'classname'   => 'widget-products',
				'description' => 'Widget products.',
			);
			parent::__construct( 'widget_products', '1 - Kuteshop Products', $widget_ops );
		}

		function widget( $args, $instance )
		{
			extract( $args );
			echo $args['before_widget'];
			if ( !empty( $instance['title'] ) ) {
				echo $args['before_title'] . $instance['title'] . $args['after_title'];
			}
			$product_item_class   = array( 'product-item' );
			$product_item_class[] = 'style-9';
			$product_item_class[] = 'rows-space-0';
			$product_item_class[] = 'col-bg-12';
			$product_item_class[] = 'col-lg-12';
			$product_item_class[] = 'col-md-12';
			$product_item_class[] = 'col-sm-12';
			$product_item_class[] = 'col-xs-12';
			$product_item_class[] = 'col-ts-12';
			add_filter( 'kuteshop_shop_pruduct_thumb_width', create_function( '', 'return ' . 110 . ';' ) );
			add_filter( 'kuteshop_shop_pruduct_thumb_height', create_function( '', 'return ' . 110 . ';' ) );
			$products = apply_filters( 'getProducts', $instance );
			?>
            <div class="kuteshop-products style-9">
				<?php if ( $products->have_posts() ): ?>
                    <ul class="product-list-grid row auto-clear equal-container better-height">
						<?php while ( $products->have_posts() ) : $products->the_post(); ?>
                            <li <?php post_class( $product_item_class ); ?>>
								<?php get_template_part( 'woo-templates/product-styles/content-product-style', '9' ); ?>
                            </li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
                    </ul>
                    <div class="more-items">
                        <a href="<?php echo get_page_link( get_page_by_title( 'shop' )->ID ); ?>"
                           class=" cp-button button-block button-larger">
							<?php echo esc_html__( 'More items', 'kuteshop-toolkit' ); ?>
                        </a>
                    </div>
				<?php else: ?>
                    <p>
                        <strong><?php esc_html_e( 'No Product', 'kuteshop-toolkit' ); ?></strong>
                    </p>
				<?php endif; ?>
            </div>
			<?php
			echo $args['after_widget'];
		}

		function update( $new_instance, $old_instance )
		{
			$instance             = $old_instance;
			$instance['title']    = $new_instance['title'];
			$instance['per_page'] = $new_instance['per_page'];
			$instance['order']    = $new_instance['order'];
			$instance['orderby']  = $new_instance['orderby'];
			$instance['target']   = $new_instance['target'];

			return $instance;
		}

		function form( $instance )
		{
			//
			// set defaults
			// -------------------------------------------------
			$instance = wp_parse_args(
				$instance,
				array(
					'title'    => '',
					'per_page' => '4',
					'order'    => 'DESC',
					'orderby'  => 'date',
					'target'   => 'recent-product',
				)
			);
			$title_value = $instance['title'];
			$title_field = array(
				'id'    => $this->get_field_name( 'title' ),
				'name'  => $this->get_field_name( 'title' ),
				'type'  => 'text',
				'title' => esc_html__( 'Title', 'kuteshop-toolkit' ),
			);
			echo cs_add_element( $title_field, $title_value );
			$target_value = $instance['target'];
			$target_field = array(
				'id'         => $this->get_field_name( 'target' ),
				'name'       => $this->get_field_name( 'target' ),
				'type'       => 'select',
				'options'    => array(
					'best-selling'      => esc_html__( 'Best Selling Products', 'kuteshop-toolkit' ),
					'top-rated'         => esc_html__( 'Top Rated Products', 'kuteshop-toolkit' ),
					'recent-product'    => esc_html__( 'Recent Products', 'kuteshop-toolkit' ),
					'featured_products' => esc_html__( 'Featured Products', 'kuteshop-toolkit' ),
					'on_sale'           => esc_html__( 'On Sale', 'kuteshop-toolkit' ),
					'on_new'            => esc_html__( 'On New', 'kuteshop-toolkit' ),
				),
				'attributes' => array(
					'data-depend-id' => 'target',
					'style'          => 'width: 100%;',
				),
				'title'      => esc_html__( 'Choose Target', 'kuteshop-toolkit' ),
			);
			echo cs_add_element( $target_field, $target_value );
			$orderby_value = $instance['orderby'];
			$orderby_field = array(
				'id'         => $this->get_field_name( 'orderby' ),
				'name'       => $this->get_field_name( 'orderby' ),
				'type'       => 'select',
				'options'    => array(
					'date'          => esc_html__( 'Date', 'kuteshop-toolkit' ),
					'ID'            => esc_html__( 'ID', 'kuteshop-toolkit' ),
					'author'        => esc_html__( 'Author', 'kuteshop-toolkit' ),
					'title'         => esc_html__( 'Title', 'kuteshop-toolkit' ),
					'modified'      => esc_html__( 'Modified', 'kuteshop-toolkit' ),
					'rand'          => esc_html__( 'Random', 'kuteshop-toolkit' ),
					'comment_count' => esc_html__( 'Comment count', 'kuteshop-toolkit' ),
					'menu_order'    => esc_html__( 'Menu order', 'kuteshop-toolkit' ),
					'_sale_price'   => esc_html__( 'Sale price', 'kuteshop-toolkit' ),
				),
				'attributes' => array(
					'style' => 'width: 100%;',
				),
				'title'      => esc_html__( 'Order By', 'kuteshop-toolkit' ),
			);
			echo cs_add_element( $orderby_field, $orderby_value );
			$order_value = $instance['order'];
			$order_field = array(
				'id'         => $this->get_field_name( 'order' ),
				'name'       => $this->get_field_name( 'order' ),
				'type'       => 'select',
				'options'    => array(
					'ASC'  => esc_html__( 'ASC', 'kuteshop-toolkit' ),
					'DESC' => esc_html__( 'DESC', 'kuteshop-toolkit' ),
				),
				'attributes' => array(
					'style' => 'width: 100%;',
				),
				'title'      => esc_html__( 'Order', 'kuteshop-toolkit' ),
			);
			echo cs_add_element( $order_field, $order_value );
			$per_page_value = $instance['per_page'];
			$per_page_field = array(
				'id'    => $this->get_field_name( 'per_page' ),
				'name'  => $this->get_field_name( 'per_page' ),
				'type'  => 'number',
				'title' => esc_html__( 'Product per page', 'kuteshop-toolkit' ),
			);
			echo cs_add_element( $per_page_field, $per_page_value );
		}
	}
}
if ( !function_exists( 'Products_Widget_init' ) ) {
	function Products_Widget_init()
	{
		register_widget( 'Products_Widget' );
	}

	add_action( 'widgets_init', 'Products_Widget_init', 2 );
}