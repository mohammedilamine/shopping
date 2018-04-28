<?php
/**
 * The Header template for our theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'woodmart_after_body_open' ); ?>
	
	<div class="website-wrapper">

		<?php $header = apply_filters( 'woodmart_header_design', woodmart_get_opt( 'header' ) );?>

		<?php if ( woodmart_needs_header() ): ?>

			<?php if( ! whb_is_enabled() ) get_template_part( 'top-bar' ); ?>
			
			<!-- HEADER -->
			<header <?php woodmart_get_header_classes( $header ); // location: inc/functions.php ?>>

				<?php 
					if( whb_is_enabled() ) {
						whb_generate_header();
					} else {
						woodmart_generate_header( $header );
					}
				 ?>

			</header><!--END MAIN HEADER-->

			<div class="clear"></div>
			
			<?php woodmart_page_top_part(); ?>

		<?php endif ?>
