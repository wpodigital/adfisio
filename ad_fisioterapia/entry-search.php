<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-3 col-md-12 entry-image">
				<div class="entry-image-container">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="entry-thumbnail">
							<a href="<?php the_permalink(); ?>" rel="bookmark">
								<?php the_post_thumbnail('medium'); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-12 col-lg-9 col-md-12 entry-extract">
				<header class="entry-header">
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
				</header>
				<div class="entry-summary">
					<?php
						$excerpt = get_the_excerpt();
						echo $excerpt . '...';
					?>
				</div>
			</div>
		</div>
	</div>
</article>