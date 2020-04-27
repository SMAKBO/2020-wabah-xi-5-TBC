<?php

/**
 * Awaken info page
 *
 * @package Awaken
 */


add_action('admin_menu', 'awaken_theme_info');

function awaken_theme_info() {
	add_theme_page('Awaken WordPress Theme Information', 'Awaken Theme Info', 'edit_theme_options', 'awaken-info', 'awaken_info_display_content');
}


function awaken_info_display_content() { ?>
	
	<div class="awaken-theme-info">
		<?php 
			$awaken_details = wp_get_theme();
			$version = $awaken_details->get( 'Version' ); 
			$name = $awaken_details->get( 'Name' ); 
			$description = $awaken_details->get( 'Description' ); 
		?>
		<div class="awaken-info-header">
			<h1 class="awaken-info-title">
				<?php echo strtoupper( $name ) . ' ' . $version; ?>
			</h1>
		</div>
		<div class="awaken-info-body">
			<div class="awaken-theme-description">
				<p>
					<?php echo $description; ?>
				</p>
			</div>
			<div class="awaken-info-blocks">
				<div class="awaken-info-block aw-n-margin">
					<span class="dashicons dashicons-visibility"></span>
					<a href="<?php echo esc_url('http://themezhut.com/demo/awaken/'); ?>" target="_blank"><?php _e( 'View Demo', 'awaken' ); ?></a>
				</div>
				<div class="awaken-info-block">
					<span class="dashicons dashicons-book-alt"></span>
					<a href="<?php echo esc_url('http://themezhut.com/awaken-wordpress-theme-documentation/'); ?>" target="_blank"><?php _e( 'Documentation', 'awaken' ); ?></a>
				</div>
				<div class="awaken-info-block">
					<span class="dashicons dashicons-businessman"></span>
					<a href="<?php echo esc_url('https://wordpress.org/support/theme/awaken'); ?>" target="_blank"><?php _e( 'Get Support', 'awaken' ); ?></a>
				</div>
				<div class="awaken-info-block aw-n-margin">
					<span class="dashicons dashicons-admin-generic"></span>
					<a href="<?php echo admin_url('customize.php'); ?>"><?php _e( 'Customize Site', 'awaken' ); ?></a>
				</div>
				<div class="awaken-info-block">
					<span class="dashicons dashicons-awards"></span>
					<a href="<?php echo esc_url('http://themezhut.com/themes/awaken-pro/'); ?>" target="_blank"><?php _e( 'Awaken Pro', 'awaken' ); ?></a>
				</div>
				<div class="awaken-info-block">
					<span class="dashicons dashicons-search"></span>
					<a href="<?php echo esc_url('http://themezhut.com/demo/awaken-pro/'); ?>" target="_blank"><?php _e( 'Awaken Pro Demo', 'awaken' ); ?></a>
				</div>

				<h4 class="awaken-notice">Rate / Review Awaken Theme </h4>
				<p><?php _e( 'Do you love awaken theme? Were you using it for a while? Then please just take 5 minutes to review it. It will be a very big help for us and it will be a very nice incentive for its further development, if you can give it a <b><u>Five Star</u></b> rating. If you have any problem with it please contact us. We will be happy to help you.', 'awaken' ); ?></p>
				<a href="<?php echo esc_url('https://wordpress.org/support/view/theme-reviews/awaken#postform'); ?>" target="_blank"><?php _e( 'Click here to go to add your review.', 'awaken' ); ?></a>

			</div>
		</div>
	</div>

<?php }