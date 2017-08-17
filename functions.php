<?php
/**
 * magazine-prime functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package magazine-prime
 */

if ( ! function_exists( 'magazine_prime_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function magazine_prime_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on magazine-prime, use a find and replace
	 * to change 'magazine-prime' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'magazine-prime');

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
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array(
	   'header-text' => array( 'site-title', 'site-description' ),
	) );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'magazine-prime-1200-800', 1000, 600, true );
	add_image_size( 'magazine-prime-400-505', 500, 600, true );
	add_image_size( 'magazine-prime-400-580', 400, 585, true );
	add_image_size( 'magazine-prime-900-600', 900, 600, true );


	// Set up the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'magazine_prime_custom_header_args', array(
			'width'         => 1400,
			'height'        => 380,
			'flex-height'   => true,
			'header-text'   => false,
			'default-text-color' => '000',
			'default-image' => get_template_directory_uri() . '/images/banner-image.jpg',
	) ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'magazine-prime' ),
		'top'   => esc_html__( 'Top Menu', 'magazine-prime' ),
		'social'   => esc_html__( 'Social Menu', 'magazine-prime' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'magazine_prime_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	 * Load Init for Hook files.
	 */
	require get_template_directory() . '/inc/hooks/hooks-init.php';

}
endif;
add_action( 'after_setup_theme', 'magazine_prime_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function magazine_prime_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'magazine_prime_content_width', 640 );
}
add_action( 'after_setup_theme', 'magazine_prime_content_width', 0 );

/**
* function for google fonts
*/
if ( ! function_exists( 'magazine_prime_fonts_url' ) ) :

	/**
	 * Return fonts URL.
	 *
	 * @since 1.0.0
	 * @return string Fonts URL.
	 */
	function magazine_prime_fonts_url() {

		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'magazine-prime' ) ) {
			$fonts[] = 'Roboto:100,300,400,400i,500,700';
		}

		/* translators: If there are characters in your language that are not supported by Oswald, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'magazine-prime' ) ) {
			$fonts[] = 'Poppins:300,400,500,600,700';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}
		return $fonts_url;
	}
endif;
/**
 * Enqueue scripts and styles.
 */
function magazine_prime_scripts() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_enqueue_style('jquery-slick', get_template_directory_uri() . '/assets/libraries/slick/css/slick' . $min . '.css');
	wp_enqueue_style('ionicons', get_template_directory_uri() . '/assets/libraries/ionicons/css/ionicons' . $min . '.css');
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/libraries/bootstrap/css/bootstrap' . $min . '.css');
	wp_enqueue_style( 'magazine-prime-style', get_stylesheet_uri() );
	/*inline style*/
	wp_add_inline_style( 'magazine-prime-style', magazine_prime_trigger_custom_css_action() );

	$fonts_url = magazine_prime_fonts_url();
	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'magazine-prime-google-fonts', $fonts_url, array(), null );
	}
	wp_enqueue_script( 'magazine-prime-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'magazine-prime-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script('jquery-slick', get_template_directory_uri() . '/assets/libraries/slick/js/slick' . $min . '.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-bootstrap', get_template_directory_uri() . '/assets/libraries/bootstrap/js/bootstrap' . $min . '.js', array('jquery'), '', true);

	wp_enqueue_script('magazine-prime-script', get_template_directory_uri() . '/assets/twp/js/custom-script.js', array('jquery'), '', 1);
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'magazine_prime_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function magazine_prime_admin_scripts( $hook ) {
	if ( 'widgets.php' === $hook ) {
	    wp_enqueue_media();
		wp_enqueue_script( 'magazine-prime-custom-widgets', get_template_directory_uri() . '/assets/twp/js/widgets.js', array( 'jquery' ), '1.0.0', true );
	}

}
add_action( 'admin_enqueue_scripts', 'magazine_prime_admin_scripts' );

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
 * Customizer control scripts and styles.
 *
 * @since 1.0.5
 */
function magazine_prime_customizer_control_scripts() {

	wp_enqueue_style( 'magazine-prime-customize-controls', get_template_directory_uri() . '/assets/twp/css/customize-controls.css' );

}

add_action( 'customize_controls_enqueue_scripts', 'magazine_prime_customizer_control_scripts', 0 );