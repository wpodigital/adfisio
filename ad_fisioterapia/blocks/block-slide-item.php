<li class="slide-item">
	<div class="row">
		<div class="col-12 col-lg-4 col-md-12">
			<div class="image-container">
				<img class="slide-image" src="<?php block_field('image'); ?>" alt="<?php block_field('image-alt'); ?>"/>
			</div>
		</div>
		<div class="col-12 col-lg-7 col-md-12">
			<div class="text-container">
				<?php if (block_field('prefix', false)) : ?>
					<p class="slide-prefix"><?php block_field('prefix'); ?></p>
				<?php endif; ?>
				<?php if (block_field('title', false)) : ?>
					<h3 class="slide-title"><?php block_field('title'); ?></h3>
				<?php endif; ?>
				<?php if (block_field('text', false)) : ?>
					<blockquote class="text">
						<p class="slide-description">
							<?php
								$myVariable = block_value('text');
				
								if (preg_match_all('/\[(.*?)\]/', $myVariable, $matches)) {
									$textInBracketsArray = $matches[1];
									$newText = $myVariable;
									
									foreach ($textInBracketsArray as $textInBrackets) {
										$newText = str_replace("[$textInBrackets]", "<span>$textInBrackets</span>", $newText);
									}
									
									$text = $newText;
								} else {
									$text = $myVariable;
								}
							?>
							<?=$text?>
						</p>
					</blockquote>
				<?php endif; ?>
			</div>
		</div>
	</div>
</li>