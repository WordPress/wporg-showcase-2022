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
		$domain = get_post_meta( get_the_ID(), 'domain', true );
		if ( ! $domain ) {
			return '';
		}

		$pretty_domain = str_replace( 'www.', '', parse_url( $domain, PHP_URL_HOST ) );
		// If the entered URL has a path, that should be included.
		$path = parse_url( $domain, PHP_URL_PATH );
		if ( '/' !== $path ) {
			$pretty_domain .= $path;
		}
		return $pretty_domain;

	}
);
