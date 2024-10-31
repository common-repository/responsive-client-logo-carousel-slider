<?php 
/*
 * Plugin Name: Logo Carousel
 * Plugin URI:  http://bplugins.com
 * Description: Add scrolling logo carosel to wordpress website. display your client logo in a nice way.
 * Version: 1.3.0
 * Author: bPlugins LLC
 * Author URI: http://bplugins.com
 * License: GPLv3
 * Text Domain:  logo-carousel
 * Domain Path:  /languages
 */

 //temp
 require_once 'inc/import-meta.php';
 
 /*Some Set-up*/
define('SLC_PLUGIN_DIR', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' ); 
define('SLC_IMPORT_VER', '1.0.0' ); 

/* Latest jQuery of wordpress */
if ( ! function_exists( 'slc_add_jquery' ) ){
    function slc_add_jquery(){
        wp_enqueue_script('jquery');
    }
    add_action('init', 'slc_add_jquery');
}


/* Carousel JS*/
if ( ! function_exists( 'slc_get_script' ) ){
    function slc_get_script(){    
        wp_enqueue_script( 'ppm-customscrollbar-js', plugin_dir_url( __FILE__ ) . 'js/crawler.js', array('jquery'), '20120206', false );
    }
    add_action('wp_enqueue_scripts', 'slc_get_script');
}


/*-------------------------------------------------------------------------------*/
/*  Metabox
/*-------------------------------------------------------------------------------*/			
//include the main class file

// CSF
include_once('metabox/csf/codestar-framework.php');
include_once('metabox/csf/metabox-options.php');

require_once 'shortcode.php';
require_once 'post_type.php';
		

/**
 * Review Request Text
 * @return string
 */
add_filter( 'admin_footer_text','slc_admin_footer');	 
function slc_admin_footer( $text ) {
    if ( 'scrollingcarousel' == get_post_type() ) {
        $url = 'https://wordpress.org/support/plugin/responsive-client-logo-carousel-slider/reviews/?filter=5#new-post';
        $text = sprintf( __( 'If you like <strong>Responsive Client Logo Carousel</strong> please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'post-carousel' ), $url );
    }

    return $text;
}


/**
 * Add a new menu item called 'Import Data' to the plugin action (plugins.php)
 */
function slc_plugin_settings_link($links) {
    $settings_link = '<a href="plugins.php?logo-carousel-import=true" class="slc_import_data">Import Data</a>';
    array_unshift($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'slc_plugin_settings_link');


/**
 * Import data on click 'import data' button
 */
add_action('admin_init', function(){
    if(isset($_GET['logo-carousel-import']) && $_GET['logo-carousel-import'] == 'true'){
        eov_import_meta();
    }

    if(get_option('slc_imported', false) !== 'imported'){
        eov_import_meta();
        update_option('slc_imported', 'imported');
    }
});

