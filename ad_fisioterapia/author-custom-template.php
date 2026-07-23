<?php
// No permitir el acceso directo a este archivo
if (!defined('ABSPATH')) {
	exit;
}

// Obtener la biografía del autor
$author_bio = get_the_author_meta('description', get_query_var('author'));
?>

<div class="author-custom-profile max-container">
	<div class="row">
		<div class="col-12 col-lg-6 col-md-12">
			<div class="author-info">
				<?php echo get_avatar(get_the_author_meta('ID'), 611); ?>
				<div class="author-social">
					<h4 class="author-name"><?php echo get_the_author(); ?></h4>
					<?php if (!empty($facebook)) : ?>
						<p class="author-social-item"><a href="<?php echo esc_url($facebook); ?>" target="_blank"><i class="bi bi-facebook"></i></a></p>
					<?php endif; ?>
					<?php if (!empty($twitter)) : ?>
						<p  class="author-social-item"><a href="<?php echo esc_url($twitter); ?>" target="_blank"><i class="bi bi-twitter-x"></i></a></p>
					<?php endif; ?>
					<?php if (!empty($instagram)) : ?>
						<p  class="author-social-item"><a href="<?php echo esc_url($instagram); ?>" target="_blank"><i class="bi bi-instagram"></i></a></p>
					<?php endif; ?>
					<?php if (!empty($linkedin)) : ?>
						<p  class="author-social-item"><a href="<?php echo esc_url($linkedin); ?>" target="_blank"><i class="bi bi-linkedin"></i></a></p>
					<?php endif; ?>
				</div>
				<?php if (!empty($cargo)) : ?>
					<p  class="author-cargo"><?php echo esc_html($cargo); ?></p>
				<?php endif; ?>
				<?php if (!empty($colegiado)) : ?>
					<p  class="author-cole"><span><?php _e('Nº colegiado:', 'ad_fisioterapia'); ?></span> <?php echo esc_html($colegiado); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-12 col-lg-6 col-md-12 author-data">
			<h3><?php _e('Especialidades:', 'ad_fisioterapia'); ?></h3>
			<div><?php echo wpautop($especialidades); ?></div>
			<h3><?php _e('Experiencia Laboral:', 'ad_fisioterapia'); ?></h3>
			<div><?php echo wpautop($experiencia_laboral); ?></div>
			<h3><?php _e('Biografía:', 'ad_fisioterapia'); ?></h3>
			<?php
			// Mostrar la biografía del autor después de la experiencia laboral
			if (!empty($author_bio)) {
				echo '<div class="author-bio">' . wpautop(esc_html($author_bio)) . '</div>';
			}
			?>
		</div>
	</div>
</div>
<div class="container-fluid reviews-container">
	<div class="row">
		<div class="col-12">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('last-reviews') ) : ?><?php endif; ?>
		</div>
	</div>
</div>
<div class="max-container">
	<div class="row">
		<div class="col-12">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('last-news') ) : ?><?php endif; ?>
		</div>
	</div>
</div>