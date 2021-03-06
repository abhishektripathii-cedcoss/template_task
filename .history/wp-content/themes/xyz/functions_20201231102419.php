<?php
/**
 * XYZ functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package xyz
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'xyz_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function xyz_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on xyz, use a find and replace
		 * to change 'xyz' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'xyz', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'xyz' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'xyz_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'xyz_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function xyz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'xyz_content_width', 640 );
}
add_action( 'after_setup_theme', 'xyz_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function xyz_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar-1', 'xyz' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'xyz' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'xyz_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function xyz_scripts() {
	wp_enqueue_style( 'xyz-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'xyz-template-a', get_template_directory_uri() . '/assets/css/owl.css', array(), _S_VERSION );
	wp_enqueue_style( 'xyz-template-b', get_template_directory_uri() . '/assets/css/flex-slider.css', array(), _S_VERSION );
	wp_enqueue_style( 'xyz-template-c', get_template_directory_uri() . '/assets/css/fontawesome.css', array(), _S_VERSION );
	wp_enqueue_style( 'xyz-template-d', get_template_directory_uri() . '/assets/css/templatemo-stand-blog.css', array(), _S_VERSION );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), _S_VERSION );
	wp_style_add_data( 'xyz-style', 'rtl', 'replace' );

	wp_enqueue_script( 'xyz-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'javascript-one', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'javascript-two', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'javascript-three', get_template_directory_uri() . '/assets/js/accordions.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'javascript-four', get_template_directory_uri() . '/assets/js/custom.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'javascript-five', get_template_directory_uri() . '/assets/js/customizer.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'javascript-six', get_template_directory_uri() . '/assets/js/isotope.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'javascript-seven', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'javascript-eight', get_template_directory_uri() . '/assets/js/owl.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'javascript-nine', get_template_directory_uri() . '/assets/js/slick.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'xyz_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* file inclusion*/
require get_template_directory() . '/classes/class-xyz-widget-categories.php';


/** 
 * Function for home.php (blog entries) */	
function wpdocs_five_posts_on_homepage( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 5 );
	}
}
// add_action( 'pre_get_posts', 'wpdocs_five_posts_on_homepage' );

/* sidebar placeholder text for search box */

function wpforo_search_form( $html ) {

	$html = str_replace( 'placeholder="Search ', 'placeholder="TYPE TO SEARCH ', $html );

	return $html;
}
add_filter( 'get_search_form', 'wpforo_search_form' );




