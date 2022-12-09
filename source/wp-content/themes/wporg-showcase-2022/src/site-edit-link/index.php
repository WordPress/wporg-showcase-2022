<?php
/**
 * Block Name: Site Edit Link
 * Description: Displays a link to edit the site in the admin.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Site_Edit_link;

add_action( 'init', __NAMESPACE__ . '\init' );

/**
 * Render the block content.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string Returns the block markup.
 */
function render( $attributes, $content, $block ) {
	if ( ! isset( $block->context['postId'] ) ) {
		return '';
	}

	$post = get_post( $block->context['postId'] );

	return sprintf(
		'<a %s href="%s" target="_blank" rel="noreferrer noopener">%s</a>',
		get_block_wrapper_attributes(),
		esc_url( get_edit_post_link( $post ) ),
		esc_html__( 'Edit site', 'wporg' )
	);
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function init() {
	register_block_type(
		dirname( dirname( __DIR__ ) ) . '/build/site-edit-link',
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}
