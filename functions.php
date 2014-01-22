<?php
/**
 * Valley View Tractor functions and definitions
 *
 * @package Valley View Tractor
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'vvt_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vvt_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Valley View Tractor, use a find and replace
	 * to change 'vvt' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'vvt', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'vvt' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'vvt_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // vvt_setup
add_action( 'after_setup_theme', 'vvt_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function vvt_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'vvt' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	//Placeholder for probably a dozen more sidebars (footer and home page)
}
add_action( 'widgets_init', 'vvt_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function vvt_scripts() {
	$scheme = is_ssl() ? 'https://' : 'http://';

	/* Google Font Styles */
    wp_enqueue_style( 'google-font-archivo', $scheme . 'fonts.googleapis.com/css?family=Archivo+Narrow:700' );
    wp_enqueue_style( 'google-font-droid-sans', $scheme . 'fonts.googleapis.com/css?family=Droid+Sans' );
    wp_enqueue_style( 'google-font-courgette', $scheme . 'fonts.googleapis.com/css?family=Courgette' );

    /* Template Styles */
	wp_enqueue_style( 'vvt-bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'vvt-default', get_template_directory_uri() . '/css/default.css' );
	wp_enqueue_style( 'vvt-template', get_template_directory_uri() . '/css/template.css' );
	wp_enqueue_style( 'vvt-touch-gallery', get_template_directory_uri() . '/css/touch.gallery.css' );
	wp_enqueue_style( 'vvt-responsive', get_template_directory_uri() . '/css/responsive.css' );
	wp_enqueue_style( 'vvt-layout', get_template_directory_uri() . '/css/layout.css' );
	wp_enqueue_style( 'vvt-camera', get_template_directory_uri() . '/css/camera.css' );
	wp_enqueue_style( 'vvt-superfish', get_template_directory_uri() . '/css/superfish.css' );

	/* Joomla Comment Extension (Can probably remove) */
	wp_enqueue_style( 'vvt-komento', get_template_directory_uri() . '/css/komento.css' );

	/* Our Style */
	wp_enqueue_style( 'vvt-style', get_stylesheet_uri() );

	wp_enqueue_script( 'vvt-mootools', get_template_directory_uri() . '/js/mootools.js', array(), '20120206', true );
	wp_enqueue_script( 'vvt-bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array(), '20120206', true );
	wp_enqueue_script( 'vvt-easing', get_template_directory_uri() . '/js/jquery.easing.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'vvt-isotope', get_template_directory_uri() . '/js/isotope.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'vvt-gallery', get_template_directory_uri() . '/js/touch.gallery.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'vvt-base', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'vvt-camera', get_template_directory_uri() . '/js/camera.js', array( 'jquery' ), '20120206', true );

	if ( wp_is_mobile() ) {
		wp_enqueue_script( 'vvt-mobile', get_template_directory_uri() . '/js/mobile.js', array( 'jquery' ), '20120206', true );
		wp_enqueue_script( 'vvt-mobile-menu', get_template_directory_uri() . '/js/mobile-menu.js', array( 'jquery' ), '20120206', true );
	}

	wp_enqueue_script( 'vvt-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'vvt-hover-intent', get_template_directory_uri() . '/js/hover-intent.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'vvt-super-subs', get_template_directory_uri() . '/js/super-subs.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'vvt-touch-screen', get_template_directory_uri() . '/js/touch-screen.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'vvt-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'vvt-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'vvt_scripts' );

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
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
