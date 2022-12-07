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
function render( $attributes ) {
	global $wp_query;

	if ( is_search() ) {
		$posts_count = number_format_i18n( $wp_query->found_posts );
		$content     = $posts_count > 0
			? sprintf(
				/* translators: %1$s number of results; %2$s keyword. */
				_n(
					'We found <b>%1$s</b> result for <b>%2$s</b>',
					'We found <b>%1$s</b> results for <b>%2$s</b>',
					$wp_query->found_posts,
					'wporg'
				),
				number_format_i18n( $posts_count ),
				esc_html( $wp_query->query['s'] )
			)
			: sprintf(
				/* translators: %s keyword */
				__( "We couldn't find sites that match your search term: <b>%s</b>", 'wporg' ),
				esc_html( $wp_query->query['s'] )
			);
	} elseif ( is_tag() ) {
		$content = sprintf(
			/* translators: %1$s number of results; %2$s tag. */
			_n(
				'There is <b>%1$s</b> site tagged with <b>%2$s</b>',
				'There are <b>%1$s</b> sites tagged with <b>%2$s</b>',
				$wp_query->found_posts,
				'wporg'
			),
			number_format_i18n( $wp_query->found_posts ),
			esc_html( get_queried_object()->name )
		);
	} elseif ( is_category() ) {
		$content = sprintf(
			/* translators: %1$s number of results; %2$s category. */
			_n(
				'There is <b>%1$s</b> site categorized as <b>%2$s</b>',
				'There are <b>%1$s</b> sites categorized as <b>%2$s</b>',
				$wp_query->found_posts,
				'wporg'
			),
			number_format_i18n( $wp_query->found_posts ),
			esc_html( get_queried_object()->name )
		);
	} else {
		$content = sprintf(
			/* translators: %1$s number of results */
			_n(
				'There is <b>%1$s</b> site in the archive',
				'There are <b>%1$s</b> sites in the archive',
				$wp_query->found_posts,
				'wporg'
			),
			number_format_i18n( $wp_query->found_posts )
		);
	}

	$wrapper_attributes = get_block_wrapper_attributes();

	return sprintf(
		'<%1$s %2$s>%3$s</%1$s>',
		esc_attr( $attributes['tagName'] ),
		$wrapper_attributes,
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
		dirname( dirname( __DIR__ ) ) . '/build/archive-results-context',
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}
