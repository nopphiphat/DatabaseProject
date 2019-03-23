<?php
/**
 * plugin Name: My-GOOD-EXAMPLE
 * Description: This is just an example plugin
 */

 function my_good_example_function()
 {
    $information = "Hello Word";
    return $information;
 }
 add_shortcode('example','my_good_example_function');

 

 //track the script in the path
 //plugin_dir_path(__FILE__).'js/script.js';
 //refer an image
 //<img src="'.plugins_url('images/icon.png',__FILE__).'">';

 //set default option
 //register_activation_hook(__FILE__,'INIT_FUNCTION');
 //INIT DATABASE

 //deaction
 //register_deactivation_hook($file,$function);

 add_action( 'plugins_loaded', 'boj_footer_message_plugin_setup' );
 function boj_footer_message_plugin_setup() {
 /* Add the footer message action. */
 add_action( 'wp_footer', 'boj_example_footer_message', 100 );
 }
 function boj_example_footer_message() {

 echo 'This site is built using < a href=”http://wordpress.org”
 title=”WordPress publishing platform” > WordPress < /a > .';
 }


 add_action( 'init', 'boj_add_excerpts_to_pages' );
function boj_add_excerpts_to_pages() {
add_post_type_support( 'page', array( 'excerpt' ) );
}

add_action( 'admin_menu', 'boj_admin_settings_page' );
function boj_admin_settings_page() {
add_options_page(
'BOJ Settings',
'BOJ Settings',
'manage_options',
'boj_admin_settings',
'boj_admin_settings_page'
);
}

?>

