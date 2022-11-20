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
	$title = ucfirst( strtolower( get_the_title() ) );

	if ( 'archives' === $pagename ) {
		$title = esc_html__( 'Archives', 'wporg' );
	} elseif ( is_search() ) {
		$title = esc_html__( 'Results', 'wporg' );
	} elseif ( is_category() ) {
		$title = esc_html__( 'Categories', 'wporg' );
	} elseif ( is_tag() ) {
		$title = esc_html__( 'Tags', 'wporg' );
	}

	$wrapper_attributes = get_block_wrapper_attributes();
	return sprintf(
		'<div %s><div><a href="%s">%s</a><div>%s</div></div></div>',
		$wrapper_attributes,
		get_site_url(),
		esc_html__( 'Showcase', 'wporg' ),
		$title
	);
}
