<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Awaken
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function awaken_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'awaken_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function awaken_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'awaken_body_classes' );

/**
 * Add backward compatibility for the title-tag.
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {

function awaken_render_title() { ?>

	<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php }
	
add_action( 'wp_head', 'awaken_render_title' );

}

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function awaken_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'awaken_setup_author' );

/**
 * WooCommerce Support
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'woocommerce_before_main_content', 'awaken_woocommerce_before_main_content', 10 );
add_action( 'woocommerce_after_main_content', 'awaken_woocommerce_after_main_content', 10 );

function awaken_woocommerce_before_main_content() {
	if ( is_active_sidebar( 'awaken-woocommerce-sidebar' ) ) {
		echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-8">';
	}
}

function awaken_woocommerce_after_main_content() {

	if ( ! is_active_sidebar( 'awaken-woocommerce-sidebar' ) ) {
		return;
	}

	echo '</div><!-- .bootstrap-cols -->';

	?>

	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="woocommerce-widget-area">
			<aside class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'awaken-woocommerce-sidebar' ); ?>
			</aside>
		</div><!-- .woocommerce-widget-area -->
	</div><!-- .bootstrap-cols -->

	<?php

	echo '</div><!-- .row-last -->';

}