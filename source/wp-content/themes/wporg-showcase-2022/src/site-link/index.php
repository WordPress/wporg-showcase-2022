<?php
/**
 * Block Name: Site Link
 * Description: Displays a pretty link to the site.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Site_Link;

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

	$post_id = $block->context['postId'];
	$domain = get_post_meta( $post_id, 'domain', true );
	if ( ! $domain ) {
		return '';
	}

	$pretty_domain = str_replace( 'www.', '', parse_url( $domain, PHP_URL_HOST ) );
	// If the entered URL has a path, that should be included.
	$path = parse_url( $domain, PHP_URL_PATH );
	if ( '/' !== $path ) {
		$pretty_domain .= $path;
	}

	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'external-link' ) );
	return sprintf(
		'<p %1$s><a href="%2$s" target="_blank" rel="noopener noreferrer">%3$s</a></p>',
		$wrapper_attributes,
		esc_url( $domain ),
		esc_html( $pretty_domain )
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
		dirname( dirname( __DIR__ ) ) . '/build/site-link',
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}
