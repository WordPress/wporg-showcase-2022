<?php
/**
 * Block Name: Link Wrap
 * Description: Wraps children in an anchor tag.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Site_Post_Template_Wrap;

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

	$wrapper_attributes = get_block_wrapper_attributes();
	return sprintf(
		'<a %1$s href="%2$s">%3$s</a>',
		$wrapper_attributes,
		get_permalink( $post ),
		$content
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
		dirname( dirname( __DIR__ ) ) . '/build/site-post-template-wrap',
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}