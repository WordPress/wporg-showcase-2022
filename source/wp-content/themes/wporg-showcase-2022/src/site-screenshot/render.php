<?php
/**
 * Display the screenshot, using the Interactivity API to load if mshots.
 */

namespace WordPressdotorg\Theme\Showcase_2022\Site_Screenshot;

if ( ! isset( $block->context['postId'] ) ) {
	return '';
}

$current_post = get_post( $block->context['postId'] );
$has_link = isset( $attributes['isLink'] ) && true == $attributes['isLink'];
$is_lazyload = isset( $attributes['lazyLoad'] ) && true === $attributes['lazyLoad'];

$img_size = ( 'desktop' === $attributes['type'] ) ? 'screenshot-desktop' : 'screenshot-mobile';
$screenshot = get_site_screenshot_src( $current_post, $attributes['type'], $img_size );
$is_mshots = str_contains( $screenshot, 'mshots' );

$classname = 'is-size-' . esc_attr( $attributes['type'] );
if ( $has_link ) {
	$classname .= ' is-linked-image';
}

// Initial state to pass to Interactivity API.
// This handles the image data (used to load image from mshots) and current
// state information (like errors).
$init_state = [
	'isMShots' => $is_mshots,
	'isLazyLoad' => $is_lazyload,
	'attempts' => 0,
	'base64Image' => '',
	'hasError' => false,
	'src' => esc_url( $screenshot ),
	'alt' => the_title_attribute( array( 'echo' => false ) ),
];
$encoded_state = wp_json_encode( [ 'wporg' => [ 'showcase' => [ 'screenshot' => $init_state ] ] ] );

?>
<div
	<?php echo get_block_wrapper_attributes( array( 'class' => $classname ) ); // phpcs:ignore ?>
	data-wp-interactive
	data-wp-context="<?php echo esc_attr( $encoded_state ); ?>"
>
	<?php if ( $has_link ) : ?>
	<a href="<?php echo esc_url( get_permalink( $current_post ) ); ?>">
	<?php endif; ?>

	<?php if ( $is_mshots ) : ?>
		<div
			class="wporg-site-screenshot__mshot-container"
			data-wp-init="effects.wporg.showcase.screenshot.init"
			data-wp-effect="effects.wporg.showcase.screenshot.update"
		>
			<div class="wporg-site-screenshot__loader"></div>
		</div>
	<?php else : ?>
		<img
			src="<?php echo esc_url( $screenshot ); ?>"
			alt="<?php echo the_title_attribute( array( 'echo' => false ) ); ?>"
			loading="<?php echo $is_lazyload ? 'lazy' : 'eager'; ?>"
		/>
	<?php endif; ?>

	<?php if ( $has_link ) : ?>
	</a>
	<?php endif; ?>
</div>
