<?php
/**
 * Block Name: Archive Results Context
 * Description: Displays context information for archive or search results.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Archive_Results_Context;

add_action( 'init', __NAMESPACE__ . '\init' );

/**
 * Render the block content.
 *
 * @return string Returns the block markup.
 */
function render() {
	global $wp_query;

	if ( is_search() ) {
		return sprintf(
			/* translators: %1$s number of results; %2$s keyword. */
			_n(
				'<p>We found <b>%1$s</b> result for <b>%2$s</b></p>',
				'<p>We found <b>%1$s</b> results for <b>%2$s</b></p>',
				$wp_query->found_posts,
				'wporg'
			),
			number_format_i18n( $wp_query->found_posts ),
			esc_html( $wp_query->query['s'] )
		);
	}

	if ( is_tag() ) {
		return sprintf(
			/* translators: %1$s number of results; %2$s tag/category. */
			_n(
				'<p>There is <b>%1$s</b> site tagged with <b>%2$s</b></p>',
				'<p>There are <b>%1$s</b> sites tagged with <b>%2$s</b></p>',
				$wp_query->found_posts,
				'wporg'
			),
			number_format_i18n( $wp_query->found_posts ),
			esc_html( get_queried_object()->name )
		);
	}

	return sprintf(
		/* translators: %1$s number of results */
		_n(
			'<p>There is <b>%1$s</b> site in the archive</p>',
			'<p>There are <b>%1$s</b> sites in the archive</p>',
			$wp_query->found_posts,
			'wporg'
		),
		number_format_i18n( $wp_query->found_posts )
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
		dirname( dirname( __DIR__ ) ) . '/build/archive-results-context',
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}
