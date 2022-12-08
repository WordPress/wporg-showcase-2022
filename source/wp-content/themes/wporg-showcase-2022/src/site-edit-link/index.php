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

	$post_ID = $block->context['postId'];
	$post    = get_post( $post_ID );

	$edit_link = get_edit_post_link( $post );
	$text      = __( 'Edit site', 'wporg' );

	$wrapper_attributes = get_block_wrapper_attributes();
	return sprintf(
		'<a %s href="%s" target="_blank">%s</a>',
		$wrapper_attributes,
		$edit_link,
		$text
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
