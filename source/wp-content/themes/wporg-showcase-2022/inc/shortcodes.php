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
 * Shortcode to get site archive list.
 */
add_shortcode(
	'site_terms_list',
	function() {
		$tags = get_the_terms( get_the_ID(), 'post_tag' );
		$category = get_the_terms( get_the_ID(), 'category' );
		$terms = array_merge( $tags, $category );
		$links  = array();

		foreach ( $terms as $value ) {
			$links[] = "<a href='" . get_term_link( $value->term_id, $value->taxonomy ) . "'>" . $value->name . '</a>';
		}

		if ( empty( $tags ) ) {
			return '';
		}

		return join( ', ', $links );
	}
);
