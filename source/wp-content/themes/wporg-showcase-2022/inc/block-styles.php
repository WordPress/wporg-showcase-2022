<?php
/**
 * Block Styles & Variations
 *
 * Load the CSS, JS, and register custom styles.
 */

namespace WordPressdotorg\Theme\Showcase_2022\Block_Styles;

defined( 'WPINC' ) || die();

const STYLE_HANDLE = 'wporg-showcase-block-styles';

/**
 * Actions and filters.
 */
add_action( 'init', __NAMESPACE__ . '\setup_block_styles' );

/**
 * Add our custom block styles & class names.
 */
function setup_block_styles() {
	register_block_style(
		'core/search',
		array(
			'name'         => 'secondary-search-control',
			'label'        => __( 'Secondary', 'wporg' ),
			'style_handle' => STYLE_HANDLE,
		)
	);
}
