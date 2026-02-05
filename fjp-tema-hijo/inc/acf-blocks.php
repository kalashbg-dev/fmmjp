<?php
/**
 * FJP ACF Blocks Registration
 *
 * @package FJP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register ACF Blocks via block.json
 */
function fjp_register_acf_blocks() {
	// Check if function exists to avoid fatal errors if WP is outdated
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	// Register Blocks
	register_block_type( FJP_THEME_DIR . '/blocks/fjp-hero' );
	register_block_type( FJP_THEME_DIR . '/blocks/fjp-news-grid' );
	register_block_type( FJP_THEME_DIR . '/blocks/fjp-testimonials' );
	register_block_type( FJP_THEME_DIR . '/blocks/fjp-volunteer-cta' );
}
add_action( 'init', 'fjp_register_acf_blocks' );
