<?php


function awaken_socialmedia() {

if ( get_theme_mod( 'display_social_icons', false ) ) : ?>

	<div class="asocial-area">
	<?php if ( get_theme_mod( 'facebook_url', '' ) ) : ?>
		<span class="asocial-icon facebook"><a href="<?php echo esc_url ( get_theme_mod( 'facebook_url', '' ) ) ?>" target="_blank"><i class="fa fa-facebook"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'twitter_url', '' ) ) : ?>
		<span class="asocial-icon twitter"><a href="<?php echo esc_url ( get_theme_mod( 'twitter_url', '' ) ) ?>" target="_blank"><i class="fa fa-twitter"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'google_plus_url', '' ) ) : ?>
		<span class="asocial-icon googleplus"><a href="<?php echo esc_url ( get_theme_mod( 'google_plus_url', '' ) ) ?>" target="_blank"><i class="fa fa-google-plus"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'linkedin_url', '' ) ) : ?>
		<span class="asocial-icon linkedin"><a href="<?php echo esc_url ( get_theme_mod( 'linkedin_url', '' ) ) ?>" target="_blank"><i class="fa fa-linkedin"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'youtube_url', '' ) ) : ?>
		<span class="asocial-icon youtube"><a href="<?php echo esc_url ( get_theme_mod( 'youtube_url', '' ) ) ?>" target="_blank"><i class="fa fa-youtube"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'rss_url', '' ) ) : ?>
		<span class="asocial-icon rss"><a href="<?php echo esc_url ( get_theme_mod( 'rss_url', '' ) ) ?>" target="_blank"><i class="fa fa-rss"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'instagram_url', '' ) ) : ?>
		<span class="asocial-icon instagram"><a href="<?php echo esc_url ( get_theme_mod( 'instagram_url', '' ) ) ?>" target="_blank"><i class="fa fa-instagram"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'flickr_url', '' ) ) : ?>
		<span class="asocial-icon flickr"><a href="<?php echo esc_url ( get_theme_mod( 'flickr_url', '' ) ) ?>" target="_blank"><i class="fa fa-flickr"></i></a></span>
	<?php endif; ?>
	</div>
	
<?php endif;

}