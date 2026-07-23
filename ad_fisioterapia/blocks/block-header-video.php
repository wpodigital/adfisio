<?php if (block_field('activation', false)) : ?>
	<section class="large-container header-video">
		<div class="video-container">
			<video autoplay loop muted loading="lazy" poster="<?php block_field('video-poster'); ?>" preload="metadata" src="<?php block_field('video'); ?>"></video>
		</div>
		<?php if (block_field('active-header-text', false)) : ?>
			<div class="header-text">
				<h1><?php block_field('title'); ?></h1>
				<p class="description"><?php block_field('description'); ?></p>
				<?php if (block_field('button-url', false)) : ?>
					<div class="block-actions">
						<a class="btn btn-secondary" target="<?php block_field('target-url'); ?>" href="<?php block_field('button-url'); ?>">
							<?php block_field('text-url'); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</section>
<?php endif; ?>