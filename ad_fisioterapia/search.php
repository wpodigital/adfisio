<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<header class="header header-search max-container">
	<h1 class="entry-title" itemprop="name"><?php printf( esc_html__( 'Search Results for: %s', 'blankslate' ), get_search_query() ); ?></h1>
</header>

<div class="search-results max-container">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'entry', 'search' ); ?>
	<?php endwhile; ?>
</div>

<div class="search-pagination max-container">
	<?php get_template_part( 'nav', 'below' ); ?>
</div>
<?php else : ?>
<article id="post-0" class="post no-results not-found max-container">
	<header class="header">
		<h1 class="entry-title" itemprop="name"><?php esc_html_e( 'Nothing Found', 'blankslate' ); ?></h1>
	</header>
	<div class="entry-content" itemprop="mainContentOfPage">
		<p><?php esc_html_e( 'Sorry, nothing matched your search. Please try again.', 'blankslate' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</article>
<?php endif; ?>
<?php get_footer(); ?>