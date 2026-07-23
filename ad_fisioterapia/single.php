<?php get_header(); ?>
<div class="blog-post max-container">
	<div class="row">
		<div class="col-12 col-lg-8 col-md-12">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
			<?php if ( comments_open() && !post_password_required() ) { comments_template( '', true ); } ?>
			<?php endwhile; endif; ?>
		</div>
		<div class="col-12 col-lg-4 col-md-4">
			<?php get_sidebar(); ?>
		</div>
		<div class="col-12">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('last-news') ) : ?><?php endif; ?>
		</div>
	</div>
</div>
<footer class="footer">
	<div class="max-container">
		<?php get_template_part( 'nav', 'below-single' ); ?>
	</div>
</footer>
<?php get_footer(); ?>