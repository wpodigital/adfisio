<?php if (block_field('activate-url', false)) : ?>
	<li class="service-item">
		<a target="_self" aria-label="<?php block_field('title'); ?>" href="<?php block_field('url'); ?>">
			<img class="service-image" src="<?php block_field('image'); ?>" alt="<?php block_field('title'); ?>"/>
			<h3><?php block_field('title'); ?></h3>
		</a>
	</li>
<?php else : ?>
	<li class="service-item">
		<img class="service-image" src="<?php block_field('image'); ?>" alt="<?php block_field('title'); ?>"/>
		<h3><?php block_field('title'); ?></h3>
	</li>
<?php endif; ?>