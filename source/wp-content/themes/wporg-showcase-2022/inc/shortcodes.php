<?php
namespace WordPressdotorg\Theme\Showcase_2022;

/**
 * Shortcode to display the associated 'domain' custom field.
 */
add_shortcode(
	'domain',
	function() {

		$values = get_post_custom_values( 'domain', get_the_ID() );

		if ( empty( $values ) ) {
			return '';
		}

		return $values[0];
	}
);

/**
 * Shortcode to display a pretty version of the associated 'domain' custom field.
 */
add_shortcode(
	'pretty_domain',
	function() {

		$values = get_post_custom_values( 'domain', get_the_ID() );

		if ( empty( $values ) ) {
			return '';
		}

		// This won't work for subdomains but we'll want to show subdomains if they exists.
		return str_replace( 'www.', '', parse_url( $values[0], PHP_URL_HOST ) );
	}
);

/**
 * Returns the number of published posts.
 */
add_shortcode(
	'sites_in_archive_count',
	function() {
		return wp_count_posts()->publish;
	}
);
