<?php
namespace WordPressdotorg\Theme\Showcase_2022;

/**
 * Shortcode to display the number of WordPress plugins.
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
 * Shortcode to display the number of WordPress plugins.
 */
add_shortcode(
	'pretty_domain',
	function() {

		$values = get_post_custom_values( 'domain', get_the_ID() );

		if ( empty( $values ) ) {
			return '';
		}

		// This is an oversimplified version and won't work if websites have subdomains
		return str_replace( 'www.', '', parse_url( $values[0], PHP_URL_HOST ) );
		;
	}
);
