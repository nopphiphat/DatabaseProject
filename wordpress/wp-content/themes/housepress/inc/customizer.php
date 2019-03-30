<?php
/**
 * housepress Theme Customizer
 *
 * @package housepress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function housepress_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'refresh';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'refresh';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
          'selector'        => '.site-title',
          'render_callback' => 'housepress_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
          'selector'        => '.site-description',
          'render_callback' => 'housepress_customize_partial_blogdescription',
        ) );
      }
      $wp_customize->add_panel( 'theme_option', array(
        'priority' => 200,
        'title' => __( 'HousePress Options', 'housepress' ),
        'description' => __( 'HousePress Options', 'housepress' ),
      ));

    /**********************************************/
    /*************** Default Post THumbnail ***************/
    /**********************************************/
    $wp_customize->add_section('default_thumbnail_section', array(
        'priority' => 75,
        "title" => 'Default Post Thumbnail',
        "description" => __('Set default post thumbnail', 'housepress'),
        'panel' => 'theme_option'
    ));
    $wp_customize->add_setting('default_thumbnail', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control($wp_customize, 'default_thumbnail', array(
        'label' => __('Default Post Thumbnail', 'housepress'),
        'section' => 'default_thumbnail_section',
        'settings' => 'default_thumbnail',
        ))
    );
}
add_action( 'customize_register', 'housepress_customize_register' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function housepress_customize_partial_blogname() {
	bloginfo( 'name' );
}
/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function housepress_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Enqueue scripts for customizer
 */
function housepress_customizer_js() {
    wp_enqueue_script('housepress-customizer', get_template_directory_uri() . '/assets/js/housepress-customizer.js', array('jquery'), '1.3.0', true);

    wp_localize_script( 'housepress-customizer', 'housepress_customizer_js_obj', array(
        'pro' => __('Upgrade To Housepress Pro','housepress')
    ) );
    wp_enqueue_style( 'housepress-customizer', get_template_directory_uri() . '/assets/css/housepress-customizer.css');
}
add_action( 'customize_controls_enqueue_scripts', 'housepress_customizer_js' );

