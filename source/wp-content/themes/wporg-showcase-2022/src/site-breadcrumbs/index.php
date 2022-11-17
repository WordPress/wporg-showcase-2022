<?php
/**
 * Block Name: Site Breadcrumbs
 * Description: Display breadcrumbs of the site.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Site_Breadcrumbs;

add_action( 'init', __NAMESPACE__ . '\init' );

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function init() {
	register_block_type(
		dirname( dirname( __DIR__ ) ) . '/build/site-breadcrumbs',
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}

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

	global $pagename;
	$post_ID = $block->context['postId'];
	$post = get_post( $post_ID );

	$title = $post->post_title;
	if ( $pagename ) {
		$title = ucfirst( strtolower( $pagename ) );
	} elseif ( is_search() ) {
		$title = 'Results';
	} elseif ( is_category() ) {
		$title = 'Categories';
	} elseif ( is_tag() ) {
		$title = 'Tags';
	}

	$wrapper_attributes = get_block_wrapper_attributes();
	return sprintf(
		'<div %s><div><a href="https://wordpress.org/showcase">%s</a><div>%s</div></div></div>',
		$wrapper_attributes,
		esc_html( 'Showcase' ),
		$title
	);
}
