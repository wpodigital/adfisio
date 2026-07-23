<?php get_header(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content" itemprop="mainContentOfPage">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) ); } ?>
				<?php the_content(); ?>
				<div class="entry-links"><?php wp_link_pages(); ?></div>
			</div>
		</article>
		
		<div id="request-btn" class="display-responsive button-home-request noshow">
			<a class="btn btn-request" href="https://www.doctoralia.es/clinicas/ad-mas-salud"><i class="bi bi-calendar2-check"></i> Reservar Cita</a>
		</div>
		
	<?php endwhile; endif; ?>
<?php get_footer(); ?>