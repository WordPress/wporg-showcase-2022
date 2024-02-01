<?php
/**
 * Render the post tags list by initial letter.
 */

$args = array(
	'taxonomy' => 'post_tag',
	'hierarchical' => false,
	'orderby' => 'name',
	'order' => 'ASC',
);

$terms = get_categories( $args );

$by_alphabet = array();
foreach ( $terms as $_term ) {
	$initial_char = strtolower( mb_substr( $_term->name, 0, 1 ) );
	if ( isset( $by_alphabet[ $initial_char ] ) ) {
		$by_alphabet[ $initial_char ][] = $_term;
	} else {
		$by_alphabet[ $initial_char ] = [ $_term ];
	}
}

$alphabet = array_keys( $by_alphabet );
sort( $alphabet );

?>
<div
	<?php echo get_block_wrapper_attributes(); // phpcs:ignore ?>
>
<?php foreach ( $alphabet as $letter ) : ?>
	<div class="wporg-tags-archive__row">
		<h3 class="wporg-tags-archive__letter"><?php echo esc_html( $letter ); ?></h3>
		<ul class="wporg-tags-archive__list">
		<?php foreach ( $by_alphabet[ $letter ] as $_term ) : ?>
			<li>
				<a href="<?php echo esc_url( get_term_link( $_term ) ); ?>">
					<?php echo esc_html( $_term->name ); ?>
				</a>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
<?php endforeach; ?>
</div> <!-- /.wp-block-wporg-tags-archive -->
