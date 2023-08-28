<?php
/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once get_theme_file_path( $understrap_inc_dir . $file );
}

/*******************************/
/* Parameters via url */
/*******************************/
function add_query_vars($aVars) {
    $aVars[] = "word";
    $aVars[] = "letter";
    $aVars[] = "dict";
    $aVars[] = "letter-page";
    return $aVars;
}

// hook add_query_vars function into query_vars
add_filter('query_vars', 'add_query_vars');

function add_rewrite_rules($aRules) {
    $aNewRules = array(
        'viet-anh/([^/]+)_trong-tieng-anh-la-gi/?$' => 'index.php?pagename=viet-anh&word=$matches[1]',
        'anh-viet/([^/]+)_trong-tieng-viet-la-gi/?$' => 'index.php?pagename=anh-viet&word=$matches[1]',
        'phap-viet/([^/]+)_trong-tieng-viet-la-gi/?$' => 'index.php?pagename=phap-viet&word=$matches[1]',
        'viet-phap/([^/]+)_trong-tieng-phap-la-gi/?$' => 'index.php?pagename=viet-phap&word=$matches[1]',
        'duc-viet/([^/]+)_trong-tieng-viet-la-gi/?$' => 'index.php?pagename=duc-viet&word=$matches[1]',
        'viet-duc/([^/]+)_trong-tieng-duc-la-gi/?$' => 'index.php?pagename=viet-duc&word=$matches[1]',
        'y-viet/([^/]+)_trong-tieng-viet-la-gi/?$' => 'index.php?pagename=y-viet&word=$matches[1]',
        'viet-viet/([^/]+)_trong-tieng-viet-la-gi/?$' => 'index.php?pagename=viet-viet&word=$matches[1]',
        'danh-sach-tu/([^/]+)/([^/]+)/?$' => 'index.php?pagename=danh-sach-tu&dict=$matches[1]&letter=$matches[2]',
        'danh-sach-tu/([^/]+)/([^/]+)/([^/]+)/?$' => 'index.php?pagename=danh-sach-tu&dict=$matches[1]&letter=$matches[2]&letter-page=$matches[3]',
    );

    $aRules = $aNewRules + $aRules;
    return $aRules;
}

// hook add_rewrite_rules function into rewrite_rules_array
add_filter('rewrite_rules_array', 'add_rewrite_rules');
/*******************************/
/* End Parameters via url */
/*******************************/

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version

remove_action( 'wp_head','rest_output_link_wp_head');
remove_action( 'wp_head','wp_oembed_add_discovery_links');
remove_action( 'template_redirect','rest_output_link_header', 11);

add_filter('after_setup_theme', 'gomaya_remove_shortlink');
function gomaya_remove_shortlink() {
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    remove_action( 'template_redirect', 'wp_shortlink_header', 11);
}

add_filter('pre_get_document_title', 'change_404_title');
function change_404_title($title) {
    global $word;
    global $post;
    global $dictTables;
    $dict = get_query_var('dict');
    $letter = strtoupper(get_query_var('letter'));
    $letterPage = get_query_var('letter-page') ? get_query_var('letter-page') : 1;
    $target = ucwords($dictTables[$dict]['target']);

    if ($word) {
        return "\"$word\" là gì? Nghĩa của từ $word trong tiếng $target";
    }

    if ($post->post_name == 'danh-sach-tu') {
        return "Danh sách từ ngữ " . $dictTables[$dict]['title'] . " theo vần $letter - Trang $letterPage";
    }

    return $title;
}

include("includes/common.php");
include("vendor/autoload.php");