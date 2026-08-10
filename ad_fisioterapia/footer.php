</main>
	
</div>
<footer id="footer" role="contentinfo">
	<div class="max-container business_content">
		<div class="row">
			<div class="col-12 col-lg-4 col-md-12 foo_ad_logo">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_logo') ) : ?><?php endif; ?>
			</div>
			<div class="col-12 col-lg-5 col-md-12 foo_ad_menu">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_menu') ) : ?><?php endif; ?>
			</div>
			<div class="col-12 col-lg-3 col-md-12 foo_ad_contact">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_contact') ) : ?><?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-lg-4 col-md-12 foo_ad_kit">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_kit') ) : ?><?php endif; ?>
			</div>
		</div>
	</div>
	<div class="container-fluid legal-content">
		<div class="max-container">
			<div class="row">
				<div class="col-12 col-lg-3 col-md-6 foo_ad_copy">
					<div id="copyright">
						&copy; <?php echo esc_html( date_i18n( __( 'Y', 'blankslate' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
					</div>
				</div>
				<div class="col-12 col-lg-6 col-md-12 foo_ad_legal">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_legal') ) : ?><?php endif; ?>
				</div>
				<div class="col-12 col-lg-3 col-md-6 foo_ad_developer">
					<div class="designedby">
						Diseño y desarrollo: <a href="https://www.acceseo.com/" target="_blank">acceseo</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>