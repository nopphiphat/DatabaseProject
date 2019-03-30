<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package housepress
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses housepress_header_style()
 * @uses housepress_admin_header_style()
 * @uses housepress_admin_header_image()
 */
function housepress_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'housepress_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 1920,
		'height'                 => 80,
		'flex-height'            => true,
		'wp-head-callback'       => 'housepress_header_style',
		'admin-head-callback'    => 'housepress_admin_header_style',
		'admin-preview-callback' => 'housepress_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'housepress_custom_header_setup' );

if ( ! function_exists( 'housepress_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see housepress_custom_header_setup().
 */
function housepress_header_style() {
	$header_text_color = get_header_textcolor();


	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description,.main-navigation ul>li>a {
			color: #<?php echo esc_attr( $header_text_color ); ?> !important
			;
		}
	<?php endif; ?>
	<?php if ( get_header_image()): ?>
		.site-header{
		background:url(<?php header_image(); ?>);
		}
		.main-navigation ul>li>a{
		background:transparent;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;

if ( ! function_exists( 'housepress_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see housepress_custom_header_setup().
 */
function housepress_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // housepress_admin_header_style

