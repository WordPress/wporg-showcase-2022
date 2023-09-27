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

$has_responsive_images = ! $is_mshots && 'desktop' === $attributes['type'] && ( 'grid' === $attributes['location'] || 'row' === $attributes['location'] );

// If the block needs responsive images, set up more image URLs & sizes attribute.
if ( $has_responsive_images ) {
	$screenshot = get_site_screenshot_src( $current_post, $attributes['type'], 'screenshot-desktop-1100' );
	$screenshot_srcset = get_site_screenshot_src( $current_post, $attributes['type'], 'screenshot-desktop-500' ) . ' 500w, ';
	$screenshot_srcset .= get_site_screenshot_src( $current_post, $attributes['type'], 'screenshot-desktop-800' ) . ' 800w, ';
	$screenshot_srcset .= get_site_screenshot_src( $current_post, $attributes['type'], 'screenshot-desktop-1100' ) . ' 1100w, ';
	$screenshot_srcset .= get_site_screenshot_src( $current_post, $attributes['type'], 'screenshot-desktop-1400' ) . ' 1400w';

	// Set up the sizes attribute. The value here should reflect the width of
	// the column, i.e., the displayed with of the image.
	// On very large screens, columns are a fixed size.
	$sizes = '(min-width: 1920px) 533px,';
	// Handle dynamic column sizes. This math is not really reflective of the
	// layout, but it works well. Real math would be tricky due to the scaling
	// column gap value (--wp--preset--spacing--40).
	// See https://css-tricks.com/a-guide-to-the-responsive-images-syntax-in-html/#aa-being-more-chill-about-sizes
	if ( 'grid' === $attributes['location'] ) {
		$sizes .= '(min-width: 1601px) calc(25vw + 30px),';
		$sizes .= '(min-width: 801px) calc(50vw - 125px),';
	} else {
		// In "row", this stays 3-column until flipping to one-column.
		$sizes .= '(min-width: 801px) calc(25vw + 30px),';
	}
	// One column—this one's actually accurate! At one column, we only need to
	// account for site padding & border width.
	$sizes .= 'calc(100vw - 60px)';
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
			<?php if ( $has_responsive_images ) : ?>
				srcset="<?php echo esc_attr( $screenshot_srcset ); ?>"
				sizes="<?php echo esc_attr( $sizes ); ?>"
			<?php endif; ?>
			alt="<?php echo the_title_attribute( array( 'echo' => false ) ); ?>"
			loading="<?php echo $is_lazyload ? 'lazy' : 'eager'; ?>"
		/>
	<?php endif; ?>

	<?php if ( $has_link ) : ?>
	</a>
	<?php endif; ?>
</div>
