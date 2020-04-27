<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Awaken
 */
?>
		</div><!-- container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="footer-widget-area">
					<div class="col-md-4">
						<div class="left-footer">
							<div class="widget-area" role="complementary">
								<?php if ( ! dynamic_sidebar( 'footer-left' ) ) : ?>

								<?php endif; // end sidebar widget area ?>
							</div><!-- .widget-area -->
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="mid-footer">
							<div class="widget-area" role="complementary">
								<?php if ( ! dynamic_sidebar( 'footer-mid' ) ) : ?>

								<?php endif; // end sidebar widget area ?>
							</div><!-- .widget-area -->						
						</div>
					</div>

					<div class="col-md-4">
						<div class="right-footer">
							<div class="widget-area" role="complementary">
								<?php if ( ! dynamic_sidebar( 'footer-right' ) ) : ?>

								<?php endif; // end sidebar widget area ?>
							</div><!-- .widget-area -->				
						</div>
					</div>						
				</div><!-- .footer-widget-area -->
			</div><!-- .row -->
		</div><!-- .container -->	

		<div class="footer-site-info">	
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-6 col-sm-6 awfl">
						<?php $footer_copyright_text = get_theme_mod( 'footer_copyright_text', '' );
						if( ! empty( $footer_copyright_text ) ) {
							echo wp_kses_post( $footer_copyright_text ); 
						} else {
							$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" >' . get_bloginfo( 'name' ) . '</a>';

							printf( __( 'Copyright &#169; %1$s %2$s.', 'awaken' ), date_i18n( 'Y' ), $site_link );
						} ?>
					</div>
					<div class="col-xs-12 col-md-6 col-sm-6 awfr">
						<div class="th-copyright">
							<?php
								$wp_link = '<a href="http://wordpress.org" target="_blank" title="' . esc_attr__( 'WordPress', 'awaken' ) . '">' . __( 'WordPress', 'awaken' ) . '</a>'; 
								printf( esc_html__( 'Proudly powered by %s.', 'awaken' ), $wp_link );
							?>
							<span class="sep"> | </span>
							<?php 
								$th_link = '<a href="http://themezhut.com/themes/awaken" target="_blank" rel="designer">ThemezHut</a>';
								printf( esc_html__( 'Theme: %1$s by %2$s.', 'awaken' ), 'Awaken', $th_link ); 
							?>
						</div>
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>