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
			<a class="btn btn-request" href="https://www.doctoralia.es/clinicas/ad-mas-salud"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zm-2.5 4a.5.5 0 0 0-.5.5V10h-.5a.5.5 0 0 0 0 1h.5v.5a.5.5 0 0 0 1 0V11h.5a.5.5 0 0 0 0-1H13v-.5a.5.5 0 0 0-.5-.5"/></svg> Reservar Cita</a>
		</div>
		
	<?php endwhile; endif; ?>
<?php get_footer(); ?>