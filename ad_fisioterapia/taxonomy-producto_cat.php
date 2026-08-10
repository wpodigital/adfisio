<?php get_header(); ?>

<header class="header">
	<h1 class="entry-title" itemprop="name"><?php single_term_title(); ?></h1>
	<div class="archive-meta" itemprop="description">
		<?php
		$descripcion = term_description();
		if ( ! empty( $descripcion ) ) {
			echo wp_kses_post( $descripcion );
		}
		?>
	</div>
</header>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'entry', 'producto' ); ?>
	<?php endwhile; ?>
<?php else : ?>
	<article id="post-0" class="producto no-results not-found">
		<header class="header">
			<h2 class="entry-title">No hay productos en esta categoría</h2>
		</header>
		<div class="entry-content">
			<p>Todavía no hay productos publicados asignados a esta categoría.</p>
		</div>
	</article>
<?php endif; ?>

<?php get_template_part( 'nav', 'below' ); ?>
<?php get_footer(); ?>