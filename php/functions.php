<?php
/**
 * Awaken functions and definitions
 *
 * @package Awaken
 */

if ( ! function_exists( 'awaken_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function awaken_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Awaken, use a find and replace
	 * to change 'awaken' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'awaken', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured-slider', 752, 440, true );
	add_image_size( 'featured', 388, 220, true );
	add_image_size( 'small-thumb', 120,85, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main_navigation' => __( 'Main Navigation', 'awaken' ),
	) );
	register_nav_menus( array(
		'top_navigation' => __( 'Top Navigation', 'awaken' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	add_editor_style( array( 'editor-style.css', awaken_fonts_url() ) );

	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

 	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'awaken_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 747; /* pixels */
	}	

	// Declare WooCommerce support.
	add_theme_support( 'woocommerce' );	
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Widgets refresh on customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			'sidebar-1' => array(
				'search',
				'text_about',
				'recent-posts',
			),

			'footer-left' => array(
				'text_business_info',
			),
			
			'footer-mid' => array(
				'text_about',
			),

			'footer-right' => array(
				'recent-posts',
				'search',
			),
		),

		'posts' => array(
			'home' => array(
				'template' => 'layouts/magazine.php'
			),
			'blog',				
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set up nav menus for each of the three areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "main menu" location.
			'main_navigation' => array(
				'name' => esc_html__( 'Main Menu', 'awaken' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_blog',
				),
			),

			// Assign a menu to the "top menu" location.
			'top_navigation' => array(
				'name' => esc_html__( 'Top Menu', 'awaken' ),
				'items' => array(
					'link_home',
					'page_blog',
				),
			),
		),
	);

	$starter_content = apply_filters( 'awaken_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );

}
endif; // awaken_setup
add_action( 'after_setup_theme', 'awaken_setup' ); 

/**
 * This function Contains All The scripts that Will be Loaded in the Theme Header including Custom Javascript, Custom CSS, etc.
 */
function awaken_initialize_header() {
	
	//CSS Begins
	echo "<style>";
		echo get_theme_mod( 'custom_css', '' );	
	echo "</style>";
	//CSS Ends
	
}
add_action('wp_head', 'awaken_initialize_header');

/**
 * Removes the [...] text.
 */
function awaken_excerpt_more($more) {
	return ' ';
}
add_filter('excerpt_more', 'awaken_excerpt_more');

/**
 * Adds a custom excerpt with a user defined link text.
 */
function awaken_custom_excerpt($text) {
    $excerpt = '' . strip_tags($text) . '<a class="moretag" href="'. get_permalink() . '"> ' . wp_kses_post( get_theme_mod( 'read_more_text', '[...]' ) ) . '</a>';
   	return $excerpt;
}
add_filter('the_excerpt', 'awaken_custom_excerpt');

/**
 * Sets the post excerpt length to 70 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function awaken_excerpt_length( $length ) {
	return 23;
}
add_filter( 'excerpt_length', 'awaken_excerpt_length' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function awaken_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'awaken' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title-container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Magazine 1', 'awaken' ),
		'id'            => 'magazine-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="awt-container"><h3 class="awt-title">',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Magazine 2', 'awaken' ),
		'id'            => 'magazine-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="awt-container"><h3 class="awt-title">',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Header Ad Area', 'awaken' ),
		'id'            => 'header-ad',
		'description'   => __( '728px x 90px Ad area. Use default text widget to put ad codes like google.', 'awaken' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="awt-container"><h3 class="awt-title">',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Left Sidebar', 'awaken' ),
		'id'            => 'footer-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Footer Mid Sidebar', 'awaken' ),
		'id'            => 'footer-mid',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Footer Right Sidebar', 'awaken' ),
		'id'            => 'footer-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'awaken' ),
		'id'            => 'awaken-woocommerce-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );	
}
add_action( 'widgets_init', 'awaken_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function awaken_scripts() {
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.4.0' );

	wp_enqueue_style( 'bootstrap.css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), 'all' );
	
	wp_enqueue_style( 'awaken-style', get_stylesheet_uri() );

	wp_enqueue_script( 'awaken-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js',array( 'jquery' ),'', true );	

	wp_enqueue_script( 'awaken-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );

    wp_enqueue_script( 'respond', get_template_directory_uri().'/js/respond.min.js' );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
 
    wp_enqueue_script( 'html5shiv',get_template_directory_uri().'/js/html5shiv.js');
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'awaken-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'awaken_scripts' );

/**
 * Load Google Fonts
 */
function awaken_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'awaken' );

    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $ubuntu = _x( 'on', 'Ubuntu font: on or off', 'awaken' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $roboto = _x( 'on', 'Roboto Condensed font: on or off', 'awaken' );
 
    if ( 'off' !== $source_sans_pro || 'off' !== $ubuntu || 'off' !== $roboto ) {
        $font_families = array();
 
        if ( 'off' !== $ubuntu ) {
            $font_families[] = 'Ubuntu:400,500';
        }

        if ( 'off' !== $source_sans_pro ) {
            $font_families[] = 'Source Sans Pro:400,600,700,400italic';
        }
 
        if ( 'off' !== $roboto ) {
            $font_families[] = 'Roboto Condensed:400italic,700,400';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}
/**
* Enqueue Google fonts.
*/
function awaken_font_styles() {
    wp_enqueue_style( 'awaken-fonts', awaken_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'awaken_font_styles' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Awaken 2.2.0
 */
function awaken_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'awaken-block-editor-style', get_template_directory_uri() . '/css/editor-blocks.css' );
	// Add custom fonts.
	wp_enqueue_style( 'awaken-fonts', awaken_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'awaken_block_editor_styles' );

/**
* Enqueue awaken options panel custom css.
*/
function awaken_option_panel_style() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/admin.css', false );
}
add_action( 'admin_enqueue_scripts', 'awaken_option_panel_style' );


/**
 * Activate a favicon for the website.
 */
function awaken_favicon() {

	if ( get_theme_mod( 'display_site_favicon', false ) ) {
		$favicon = get_theme_mod( 'site_favicon', '' );
		$awaken_favicon_output = '';
		if ( !empty( $favicon ) ) {
			$awaken_favicon_output .= '<link rel="shortcut icon" href="'.esc_url( $favicon ).'" type="image/x-icon" />';
		}
		echo $awaken_favicon_output;
	}
}
add_action( 'admin_head', 'awaken_favicon' );
add_action( 'wp_head', 'awaken_favicon' );

/**
* Add flex slider.
*/
function awaken_flex_scripts() {
    
    wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), false, true );
    wp_register_script( 'add-awaken-flex-js', get_template_directory_uri() . '/js/awaken.slider.js', array(), '', true );
	wp_enqueue_script( 'add-awaken-flex-js' );    
    wp_register_style( 'add-flex-css', get_template_directory_uri() . '/css/flexslider.css','','', 'screen' );
    wp_enqueue_style( 'add-flex-css' );

}
add_action( 'wp_enqueue_scripts', 'awaken_flex_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Theme info page.
 */
require get_template_directory() . '/inc/theme-info.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Widget files
 */
require get_template_directory() . '/inc/widgets/three-block-posts.php';
require get_template_directory() . '/inc/widgets/single-category.php';
require get_template_directory() . '/inc/widgets/dual-category.php';
require get_template_directory() . '/inc/widgets/medium-rectangle.php';
require get_template_directory() . '/inc/widgets/popular-tags-comments.php';
require get_template_directory() . '/inc/widgets/video-widget.php';

/* Load slider */
require get_template_directory() . '/inc/functions/slider.php';
/* Social Media Icons */
require get_template_directory() . '/inc/functions/socialmedia.php';