/**
 * Customizer custom js
 */

jQuery(document).ready(function() {
   jQuery('.wp-full-overlay-sidebar-content').prepend('<div class="housepress-ads"> <a href="http://phantomthemes.com/downloads/housepress-pro-wordpress-theme" class="button" target="_blank">{pro}</a></div>'.replace('{pro}',housepress_customizer_js_obj.pro));
});