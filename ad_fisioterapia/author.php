<?php get_header(); ?>
<header class="header header-author max-container">
	<div class="header-content">
		<?php the_post(); ?>
		<h1 class="entry-title author" itemprop="name"><?php the_author_link(); ?></h1>
		<div class="archive-meta" itemprop="description">
			<?php
			$author_cargo = get_the_author_meta('cargo');
			if ($author_cargo) {
				echo esc_html($author_cargo);
			}
			?>
		</div>
		<?php rewind_posts(); ?>
	</div>
</header>

<?php
	if (have_posts()) :
		// Obtener el ID del autor
		$author_id = get_the_author_meta('ID');
	
		// Mostrar los campos personalizados
		author_custom_display_user_meta($author_id);
	
		// El resto del contenido del autor
	endif;
?>

<?php while ( have_posts() ) : the_post(); ?>
<?php //get_template_part( 'entry' ); ?>

<?php endwhile; ?>
<?php //get_template_part( 'nav', 'below' ); ?>
<?php get_footer(); ?>