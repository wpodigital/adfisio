<?php
$producto_url    = get_post_meta( get_the_ID(), 'producto_url', true );
$producto_rating = get_post_meta( get_the_ID(), 'producto_rating', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="producto-card-inner">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="producto-thumb">
				<?php if ( ! empty( $producto_url ) ) : ?>
					<a href="<?php echo esc_url( $producto_url ); ?>" target="_blank" rel="nofollow sponsored noopener">
						<?php the_post_thumbnail( 'medium_large' ); ?>
					</a>
				<?php else : ?>
					<?php the_post_thumbnail( 'medium_large' ); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="producto-content">
			<h2 class="entry-title producto-title">
				<?php if ( ! empty( $producto_url ) ) : ?>
					<a href="<?php echo esc_url( $producto_url ); ?>" target="_blank" rel="nofollow sponsored noopener">
						<?php the_title(); ?>
					</a>
				<?php else : ?>
					<?php the_title(); ?>
				<?php endif; ?>
			</h2>

			<?php if ( ! empty( $producto_rating ) ) : ?>
				<div class="producto-rating" aria-label="Puntuación: <?php echo esc_attr( $producto_rating ); ?> de 5">
					<?php
					$rating = (int) $producto_rating;
					for ( $i = 1; $i <= 5; $i++ ) {
						echo $i <= $rating
							? '<span class="star filled">★</span>'
							: '<span class="star empty">☆</span>';
					}
					?>
				</div>
			<?php endif; ?>

			<div class="producto-description">
				<?php
				if ( has_excerpt() ) {
					the_excerpt();
				} else {
					echo wp_kses_post( wp_trim_words( get_the_content(), 22 ) );
				}
				?>
			</div>

			<?php if ( ! empty( $producto_url ) ) : ?>
				<div class="producto-link">
					<a href="<?php echo esc_url( $producto_url ); ?>" target="_blank" rel="nofollow sponsored noopener" class="producto-button">
						Ver producto
					</a>
				</div>
			<?php endif; ?>
		</div>

	</div>
</article>