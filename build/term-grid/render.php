<?php
/**
 * Render the taxonomy terms grid.
 */

$args = array(
	'taxonomy' => $attributes['term'],
	'hierarchical' => false,
	'orderby' => 'name',
	'order' => 'ASC',
	'show_count' => ! empty( $attributes['showPostCounts'] ),
);

$terms = get_categories( $args );

?>
<div
	<?php echo get_block_wrapper_attributes(); // phpcs:ignore ?>
>
	<ul>
	<?php foreach ( $terms as $_term ) : ?>
		<li>
			<a href="<?php echo esc_url( get_term_link( $_term ) ); ?>">
				<?php echo esc_html( $_term->name ); ?>
				<?php if ( ! empty( $attributes['showPostCounts'] ) ) : ?>
					<span>(<?php echo esc_html( $_term->category_count ); ?>)</span>
				<?php endif; ?>
			</a>
		</li>
	<?php endforeach; ?>
	</ul>
</div> <!-- /.wp-block-wporg-term-grid -->
