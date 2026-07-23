<div class="entry-meta">
	<span class="author vcard"<?php if ( is_single() ) { echo ' itemprop="author" itemscope itemtype="https://schema.org/Person"><span itemprop="name">'; } else { echo '><span>'; } ?>
		<?php 
			echo get_avatar( get_the_author_meta( 'ID' ), 56 );
			the_author_posts_link(); 
			$author_cargo = get_the_author_meta( 'cargo' ); 
			if ( $author_cargo ) {
				echo '<div class="author-cargo">' . esc_html( $author_cargo ) . '</div>';
			}
		?>
	</span>
</div>