<?php
/**
 * Awaken Theme Customizer
 *
 * @package Awaken
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function awaken_customize_register( $wp_customize ) {

	require( get_template_directory() . '/inc/customizer/custom-controls/control-category-dropdown.php' );
	require( get_template_directory() . '/inc/customizer/custom-controls/control-custom-content.php' );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_section( 'static_front_page' )->panel 	= 'awaken_home_settings';
    $wp_customize->get_section( 'background_image' )->panel 	= 'awaken_styling';
    $wp_customize->get_section( 'colors' )->panel 				= 'awaken_styling';
    


	/**
	 * Header Settings Panel
	 */
	$wp_customize->add_panel( 
		'awaken_header_settings', 
		array(
			'title' => __( 'Header Settings', 'awaken' ),
			'description' => __( 'Use this panel to set your header settings', 'awaken' ),
			'priority' => 25, 
		) 
	);


	// Logo image
    $wp_customize->add_setting(
        'site_logo',
        array(
            'sanitize_callback' => 'awaken_sanitize_image'
        ) 
    ); 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
                'label'         => __( 'Site Logo', 'awaken' ),
                'section'       => 'title_tagline',
                'settings'      => 'site_logo',
                'description' 	=> __( 'Upload a logo for your website. Recommended height for your logo is 135px.', 'awaken' ),
            )
        )
    );

    // Logo, title and description chooser
    $wp_customize->add_setting(
        'site_title_option',
        array (
            'default'           => 'text-only',
            'sanitize_callback' => 'awaken_sanitize_logo_title_select',
            'transport'         => 'refresh'
        )
    );
    $wp_customize->add_control(
        'site_title_option',
        array(
            'label'     	=> __( 'Display site title / logo.', 'awaken' ),
            'section'   	=> 'title_tagline',
            'type'      	=> 'radio',
            'description'	=> __( 'Choose your preferred option.', 'awaken' ),
            'choices'   => array (
                'text-only' 	=> __( 'Display site title and tagline only.', 'awaken' ),
                'logo-only'     => __( 'Display site logo image only.', 'awaken' ),
                'text-logo'		=> __( 'Display both site title and logo image.', 'awaken' ),
                'display-none'	=> __( 'Display none', 'awaken' )
            )
        )
    );

    // Site favicon
	$wp_customize->add_setting(
        'site_favicon',
        array(
            'sanitize_callback' => 'awaken_sanitize_image'
        ) 
    ); 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
                'label'         => __( 'Upload a favicon', 'awaken' ),
                'section'       => 'title_tagline',
                'settings'      => 'site_favicon',
                'description' 	=> __( 'Upload a favicon for your website.', 'awaken' ),
            )
        )
    );

    // Display site favicon?
    $wp_customize->add_setting(
		'display_site_favicon',
		array(
			'default'			=> false,
			'sanitize_callback'	=> 'awaken_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_site_favicon',
		array(
			'settings'		=> 'display_site_favicon',
			'section'		=> 'title_tagline',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display site favicon?', 'awaken' ),
		)
	);


    /**
     * General settings section.
     */
    $wp_customize->add_section( 
    	'awaken_general_settings', 
    	array(
			'title' => __( 'General Settings', 'awaken' ),
			'description' => __( 'Use this section to set general settings of the site.', 'awaken' ),
			'priority' => 30,
		) 
	);

    $wp_customize->add_setting(
		'show_search_box',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'awaken_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'show_search_box',
		array(
			'section'		=> 'awaken_general_settings',
			'type'			=> 'checkbox',
			'label'			=> __( 'Show search box on navigation?', 'awaken' ),
		)
	);

	// Read more text.
	$wp_customize->add_setting(
		'read_more_text',
		array(
			'default'			=> '[...]',
			'sanitize_callback'	=> 'awaken_sanitize_html'
		)
	);
	$wp_customize->add_control(
		'read_more_text',
		array(
			'settings'		=> 'read_more_text',
			'section'		=> 'awaken_general_settings',
			'type'			=> 'textarea',
			'label'			=> __( 'Read more text', 'awaken' ),
			'description'	=> __( 'Give a read more text for posts. HTML allowed.', 'awaken' )
		)
	);


	// Footer copyright text.
	$wp_customize->add_setting(
		'footer_copyright_text',
		array(
			'default'			=> sprintf( __( 'Copyright %s. All rights reserved.', 'awaken' ), esc_html( get_bloginfo( 'name' ) ) ),
			'sanitize_callback'	=> 'awaken_sanitize_html'
		)
	);
	$wp_customize->add_control(
		'footer_copyright_text',
		array(
			'settings'		=> 'footer_copyright_text',
			'section'		=> 'awaken_general_settings',
			'type'			=> 'textarea',
			'label'			=> __( 'Footer copyright text', 'awaken' ),
			'description'	=> __( 'Copyright or other text to be displayed in the site footer. HTML allowed.', 'awaken' )
		)
	);


    /**
     * Home Settings section.
     */
    $wp_customize->add_panel( 
		'awaken_home_settings', 
		array(
			'title' => __( 'Homepage Settings', 'awaken' ),
			'description' => __( 'Use this panel to set your home page settings', 'awaken' ),
			'priority' => 31, 
		) 
	);

	/**
     * Slider Section.
     */
    $wp_customize->add_section( 
    	'awaken_slider', 
    	array(
			'title' => __( 'Feartured Slider', 'awaken' ),
			'description' => __( 'Use this section to setup the homepage slider and featured posts.', 'awaken' ),
			'panel' => 'awaken_home_settings'
		) 
	);

    // Display slider?
    $wp_customize->add_setting(
		'display_slider',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'awaken_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_slider',
		array(
			'settings'		=> 'display_slider',
			'section'		=> 'awaken_slider',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display slider on homepage ?', 'awaken' )
		)
	);

	$wp_customize->add_setting(
		'slider_category',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_sanitize_category_dropdown'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Category_Control( 
			$wp_customize,
			'slider_category', 
			array(
			    'label'   		=> __( 'Select the category for slider.', 'awaken' ),
			    'description'	=> __( 'Featured images of the posts from selected category will be displayed in the slider', 'awaken' ),
			    'section' 		=> 'awaken_slider',
			    'settings'  	=> 'slider_category',
			) 
		) 
	);

	$wp_customize->add_setting(
		'fposts_display_method',
		array(
			'default'			=> 'category',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'awaken_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'fposts_display_method',
		array(
			'section'		=> 'awaken_slider',
			'type'			=> 'radio',
			'label'			=> __( 'Select featured posts display method.', 'awaken' ),
			'description'	=> __( 'Featured posts are the two posts just next to the slider.', 'awaken' ),
			'choices'		=> array(
				'category' 	=> __( 'Display posts from a selected category', 'awaken' ),
				'sticky' 	=> __( 'Display sticky posts.', 'awaken' )
			)
		)
	);


	$wp_customize->add_setting(
		'featured_posts_category',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_sanitize_category_dropdown'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Category_Control( 
			$wp_customize,
			'featured_posts_category', 
			array(
			    'label'   			=> __( 'Select the category for featured posts.', 'awaken' ),
			    'description'		=> __( 'Featured images of the posts from selected category will be displayed in the slider', 'awaken' ),
			    'section' 			=> 'awaken_slider',
			    'settings'  		=> 'featured_posts_category',
			    'active_callback' 	=> 'choice_category_callback'
			) 
		) 
	);

	/**
     * Post / Page settings
     */
    $wp_customize->add_section( 
    	'awaken_post_page_settings', 
    	array(
			'title' 		=> __( 'Post / Page Settings', 'awaken' ),
			'priority'		=> 32
		) 
	);

    // Show comments on posts.
    $wp_customize->add_setting(
		'display_post_comments',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'awaken_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_post_comments',
		array(
			'settings'		=> 'display_post_comments',
			'section'		=> 'awaken_post_page_settings',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display post comments.', 'awaken' ),
			'description'	=> __( 'Mark the checkbox if you want to display comments on post articles.', 'awaken' )
		)
	);	

    // Show comments on pages.
    $wp_customize->add_setting(
		'display_page_comments',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'awaken_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_page_comments',
		array(
			'settings'		=> 'display_page_comments',
			'section'		=> 'awaken_post_page_settings',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display page comments.', 'awaken' ),
			'description'	=> __( 'Mark the checkbox if you want to display comments on pages.', 'awaken' )
		)
	);		


    // Show featured image in single posts.
    $wp_customize->add_setting(
		'show_article_featured_image',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'awaken_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'show_article_featured_image',
		array(
			'settings'		=> 'show_article_featured_image',
			'section'		=> 'awaken_post_page_settings',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display featured image inside the single post article.', 'awaken' ),
			'description'	=> __( 'Mark the checkbox if you want to show featured image on single post article.', 'awaken' )
		)
	);	

	/**
     * Styling Options.
     */
	$wp_customize->add_panel( 
		'awaken_styling', 
		array(
			'title' 		=> __( 'Site Styling', 'awaken' ),
			'description' 	=> __( 'Use this section to setup the homepage slider and featured posts.', 'awaken' ),
			'priority' 		=> 33, 
		) 
	);

	/**
     * Custom CSS section
     */
    $wp_customize->add_section( 
    	'awaken_custom_css', 
    	array(
			'title' 		=> __( 'Custom CSS', 'awaken' ),
			'panel' 		=> 'awaken_styling',
			'priority'		=> 50
		) 
	);

	$wp_customize->add_setting(
		'custom_css',
		array(
			'default'			=> '',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'awaken_sanitize_css'
		)
	);
	$wp_customize->add_control(
		'custom_css',
		array(
			'settings'		=> 'custom_css',
			'section'		=> 'awaken_custom_css',
			'type'			=> 'textarea',
			'label'			=> __( 'Custom CSS', 'awaken' ),
			'description'	=> __( 'Define custom CSS be used for your site. Do not enclose in script tags.', 'awaken' ),
		)
	);

	/**
     * Social Media
     */
    $wp_customize->add_section( 
    	'awaken_social_media', 
    	array(
			'title' 		=> __( 'Social Media', 'awaken' ),
			'priority'		=> 34
		) 
	);

	$wp_customize->add_setting(
		'display_social_icons',
		array(
			'default'			=> false,
			'sanitize_callback'	=> 'awaken_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'display_social_icons',
		array(
			'settings'		=> 'display_social_icons',
			'section'		=> 'awaken_social_media',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display social icons?', 'awaken' ),
		)
	);

	$wp_customize->add_setting(
		'facebook_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'facebook_url',
		array(
			'settings'		=> 'facebook_url',
			'section'		=> 'awaken_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Facebook URL', 'awaken' ),
		)
	);

	$wp_customize->add_setting(
		'twitter_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'twitter_url',
		array(
			'settings'		=> 'twitter_url',
			'section'		=> 'awaken_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Twitter URL', 'awaken' ),
		)
	);

	$wp_customize->add_setting(
		'google_plus_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'google_plus_url',
		array(
			'settings'		=> 'google_plus_url',
			'section'		=> 'awaken_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Google Plus URL', 'awaken' ),
		)
	);

	$wp_customize->add_setting(
		'linkedin_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'linkedin_url',
		array(
			'settings'		=> 'linkedin_url',
			'section'		=> 'awaken_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Linkedin URL', 'awaken' ),
		)
	);

	$wp_customize->add_setting(
		'rss_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'rss_url',
		array(
			'settings'		=> 'rss_url',
			'section'		=> 'awaken_social_media',
			'type'			=> 'url',
			'label'			=> __( 'RSS URL', 'awaken' ),
		)
	);

	$wp_customize->add_setting(
		'instagram_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'instagram_url',
		array(
			'settings'		=> 'instagram_url',
			'section'		=> 'awaken_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Instagram URL', 'awaken' ),
		)
	);	

	$wp_customize->add_setting(
		'flickr_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'flickr_url',
		array(
			'settings'		=> 'flickr_url',
			'section'		=> 'awaken_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Flickr URL', 'awaken' ),
		)
	);	

	$wp_customize->add_setting(
		'youtube_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'youtube_url',
		array(
			'settings'		=> 'youtube_url',
			'section'		=> 'awaken_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Youtube URL', 'awaken' ),
		)
	);	

    $wp_customize->add_section( 
    	'awaken_pro_details', 
    	array(
			'title' 		=> __( 'Awaken Pro', 'awaken' ),
			'priority'		=> 120
		) 
	);

	$wp_customize->add_setting( 
		'awaken_pro_desc', 
		array(
			'sanitize_callback'	=> 'awaken_sanitize_html'
		) 
	);

	$wp_customize->add_control( 
		new Awaken_Pro_Custom_Content( 
			$wp_customize, 
			'awaken_pro_desc', 
			array(
				'section' 		=> 'awaken_pro_details',
				'priority' 		=> 20,
				'label' 		=> __( 'Do you want more features?', 'awaken' ),
				'content' 		=> __( 'Then consider buying <a href="http://themezhut.com/themes/awaken-pro/" target="_blank">Awaken Pro.</a><h4>Awaken Pro Features.</h4><ol><li>Ajaxified Post Widgets.</li><li>Google Fonts.</li><li>Unlimited Colors.</li><li>Boxed and Wide Layouts.</li><li>More Customizer Options.</li><li>Custom slider.</li><li>Different sidebars for articles and pages.</li><li>Released under GPL.</li></ol>And more..<p><a class="button" href="http://themezhut.com/demo/awaken-pro/" target="_blank">Awaken Pro Demo</a><a class="button button-primary" href="http://themezhut.com/themes/awaken-pro/" target="_blank">Awaken Pro Details</a></p>', 'awaken' ) . '</p>',
				//'description' 	=> __( 'Optional: Example Description.', 'awaken' ),
			) 
		) 
	);

}
add_action( 'customize_register', 'awaken_customize_register' );

/**
 * Image sanitization.
 * 
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */

function awaken_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}

/**
 * Sanitize the logo title select option.
 *
 * @param string $logo_option.
 * @return string (text-description-only|site-logo-only|site-logo-text-desc|display-none).
 */
function awaken_sanitize_logo_title_select( $logo_option ) {
	if ( ! in_array( $logo_option, array( 'text-only', 'logo-only', 'text-logo', 'display-none' ) ) ) {
        $logo_option = 'text-description-only';
    } 

    return $logo_option;
}

/**
 * Checkbox sanitization.
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function awaken_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * HTML sanitization 
 *
 * @see wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
 *
 * @param string $html HTML to sanitize.
 * @return string Sanitized HTML.
 */
function awaken_sanitize_html( $html ) {
	return wp_filter_post_kses( $html );
}

/**
 * CSS sanitization.
 * 
 * @see wp_strip_all_tags() https://developer.wordpress.org/reference/functions/wp_strip_all_tags/
 *
 * @param string $css CSS to sanitize.
 * @return string Sanitized CSS.
 */
function awaken_sanitize_css( $css ) {
	return wp_strip_all_tags( $css );
}


/**
 * URL sanitization.
 * 
 * @see esc_url_raw() https://developer.wordpress.org/reference/functions/esc_url_raw/
 *
 * @param string $url URL to sanitize.
 * @return string Sanitized URL.
 */
function awaken_sanitize_url( $url ) {
	return esc_url_raw( $url );
}


/**
 * Category dropdown sanitization.
 *
 * @param int $catid to sanitize.
 * @return int $cat_id.
 */
function awaken_sanitize_category_dropdown( $catid ) {
	// Ensure $catid is an absolute integer.
	return $cat_id = absint( $catid );
	
}

/**
 * Select sanitization.
 *
 * - Sanitization: select
 * - Control: select, radio
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function awaken_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Featured posts category select callback.
 */
function choice_category_callback( $control ) {
    if ( $control->manager->get_setting('fposts_display_method')->value() == 'category' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function awaken_customize_preview_js() {
	wp_enqueue_script( 'awaken_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'awaken_customize_preview_js' );



/**
 * Enqueue the customizer stylesheet.
 */
function awaken_enqueue_customizer_stylesheets() {

    wp_register_style( 'awaken-customizer-css', get_template_directory_uri() . '/inc/customizer/assets/customizer.css', NULL, NULL, 'all' );
    wp_enqueue_style( 'awaken-customizer-css' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.4.0' );

}
add_action( 'customize_controls_print_styles', 'awaken_enqueue_customizer_stylesheets' );
