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
	// We point directly to the block.json file to ensure WP finds it correctly in all environments
	register_block_type( FJP_THEME_DIR . '/blocks/fjp-hero/block.json' );
	register_block_type( FJP_THEME_DIR . '/blocks/fjp-news-grid/block.json' );
	register_block_type( FJP_THEME_DIR . '/blocks/fjp-testimonials/block.json' );
	register_block_type( FJP_THEME_DIR . '/blocks/fjp-volunteer-cta/block.json' );
}
add_action( 'init', 'fjp_register_acf_blocks' );
