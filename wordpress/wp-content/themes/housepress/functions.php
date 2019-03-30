<?php
/**
 * housepress functions and definitions
 *
 * @package housepress
 */

if ( ! function_exists( 'housepress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function housepress_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on housepress, use a find and replace
	 * to change 'housepress' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'housepress', get_template_directory() . '/languages' );

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
	 // set_post_thumbnail_size( 571, 373, true );
	 // add_image_size( 'slider-thumb', 492, 318, array( 'center', 'center') ); // Homepage blog Images
	 // add_image_size( 'home-thumb', 360, 240, array( 'center', 'center') ); // Homepage blog Images
	 // add_image_size( 'portfolio-thumb', 860, 620, false ); // Archive Pages
	 // add_image_size( 'single-thumb', 860, 620, false ); // Single Pages


	

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'housepress' ),
		'secondary' => esc_html__( 'Footer Menu', 'housepress' ),
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

	/*
	 * Set Up Custom Logo
	 */
	add_theme_support( 'custom-logo', array(
	  'height'      => 50,
	  'width'       => 285,
	  'flex-height' => true,
	  'flex-width'  => true,  
	 ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'housepress_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( "custom-header", 
		array(
		'default-color' => 'ffffff',
		'default-image' => '',
			)  
		);
	/*
	 * Enable support for Selective Refresh for Widgets.
	 * See https://make.wordpress.org/core/2016/11/10/visible-edit-shortcuts-in-the-customizer-preview/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_editor_style() ;
}
endif; // housepress_setup
add_action( 'after_setup_theme', 'housepress_setup' );




/**
 * Enqueue scripts and styles.
 */
function housepress_scripts() {
	wp_enqueue_style( 'housepress-bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css' );	
	wp_enqueue_style( 'housepress-style', get_stylesheet_uri() );
	$query_args = array('family' => 'Droid+Serif:400,700');
	wp_register_style( 'housepress-google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
	wp_enqueue_style( 'housepress-google-fonts' );

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'housepress-nav', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0.0', true );
	wp_enqueue_script( 'housepress-bootstrap-min', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'housepress-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '1.0.0', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'housepress_scripts' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! isset( $content_width ) ) $content_width = 900;
function housepress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'housepress_content_width', 640 );

}
add_action( 'after_setup_theme', 'housepress_content_width', 0 );


function housepress_filter_front_page_template( $template ) {
    return is_home() ? '' : $template;
}
add_filter( 'front_page_template', 'housepress_filter_front_page_template' );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function housepress_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'housepress' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'housepress_widgets_init' );



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
 * Custom Header.
 */
require get_template_directory() . '/inc/custom-header.php';

/**  
 * Load TGM plugin 
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';


 /* Recommended plugin using TGM */
add_action( 'tgmpa_register', 'housepress_register_plugins');
if( !function_exists('housepress_register_plugins') ) {
	function housepress_register_plugins() {
       /**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
 			array(
				'name'     => 'One Click Demo Import', // The plugin name.
				'slug'     => 'one-click-demo-import', // The plugin slug (typically the folder name).
				'required' => false, // If false, the plugin is only 'recommended' instead of required.
			),
			array(
				'name'               => 'Contact Form 7', // The plugin name.
				'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
				'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			),
		);
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'tgmpa',
			// Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',
			// Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins',
			// Menu slug.
			'parent_slug'  => 'themes.php',
			// Parent menu slug.
			'capability'   => 'edit_theme_options',
			// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,
			// Show admin notices or not.
			'dismissable'  => true,
			// If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',
			// If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,
			// Automatically activate plugins after installation or not.
			'message'      => '',
			// Message to output right before the plugins table.
		);
 		tgmpa( $plugins, $config );
	}
}


/* housepress Demo importer */
add_filter( 'pt-ocdi/import_files', 'housepress_import_demo_data' );
if ( ! function_exists( 'housepress_import_demo_data' ) ) {
	function housepress_import_demo_data() {
	  return array(
	    array(   
			'import_file_name'             => __('Default Demo','housepress'),
			'categories'                   => array( 'Default', 'Blog' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo/default/demo-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo/default/widgets.json',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo/default/customizer.dat',
			'import_preview_image_url'     => 'https://phantomthemes.com/demo/housepress/wp-content/themes/housepress/screenshot.png',
			'preview_url'                  => 'https://phantomthemes.com/view?theme=HousePress',
		),
	  ); 
	}
}
 add_action( 'pt-ocdi/after_import', 'housepress_after_import' );
if ( ! function_exists( 'housepress_after_import' ) ) {
	function housepress_after_import( $selected_import ) { 
		$importer_name  = __('Default Demo','housepress');
	 
	    if ( $importer_name === $selected_import['import_file_name'] ) {
	        //Set Menu
			$top_menu = get_term_by('name', 'Primary Menu', 'nav_menu'); 
			$footer_menu= get_term_by('name', 'Footer Menu', 'nav_menu');
	        set_theme_mod( 'nav_menu_locations' , array( 				  
				'primary' => $top_menu->term_id,
				'secondary' => $footer_menu->term_id,				
	             ) 
			);
			
			//Set Front page
		    if( get_option('page_on_front') === '0' && get_option('page_for_posts') === '0' ) {
				$page = get_page_by_title( 'Home');
				//$blog = get_page_by_title( 'Blog');
				if ( isset( $page->ID ) ) {
						update_option( 'show_on_front', 'page' );
					 update_option( 'page_on_front', $page->ID );
					 //update_option('page_for_posts', $blog->ID);
				}
			 }
	    }
	     
	}
}
 add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

 // Menu Fallback
function housepress_wp_nav_default_primary_menu() {
	get_template_part( 'template-parts/default-primary-menu' );
}
function housepress_wp_nav_default_secondary_menu() {
   get_template_part( 'template-parts/default-secondary-menu' );
}