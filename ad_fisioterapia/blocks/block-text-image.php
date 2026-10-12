<?php if (block_field('activation', false)) : ?>
	<section class="max-container text-image">
		<div class="row">
			<div class="col-12 col-lg-6 col-md-7 text-content">
				<h2><?php block_field('title'); ?></h2>
				<?php if (block_field('text', false)) : ?>
					<blockquote class="text">
						<p>
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
			<div class="col-12 col-lg-6 col-md-5 image-container">
				<div class="image-content">
					<img class="block-image" src="<?php block_field('image'); ?>" alt="<?php block_field('image-alt'); ?>"/>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>