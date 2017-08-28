<?php
//required actions
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'wlwmanifest_link');
// close required actions

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'signuppageheaders');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
// Отключаем сам REST API
add_filter('rest_enabled', '__return_false');

// Отключаем фильтры REST API
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('wp_head', 'rest_output_link_wp_head', 10, 0);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('auth_cookie_malformed', 'rest_cookie_collect_status');
remove_action('auth_cookie_expired', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_username', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_hash', 'rest_cookie_collect_status');
remove_action('auth_cookie_valid', 'rest_cookie_collect_status');
remove_filter('rest_authentication_errors', 'rest_cookie_check_errors', 100);

// Отключаем события REST API
remove_action('init', 'rest_api_init');
remove_action('rest_api_init', 'rest_api_default_filters', 10, 1);
remove_action('parse_request', 'rest_api_loaded');

// Отключаем Embeds связанные с REST API
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);

remove_action('wp_head', 'wp_oembed_add_discovery_links');
// если собираетесь выводить вставки из других сайтов на своем, то закомментируйте след. строку.
//remove_action('wp_head', 'wp_oembed_add_host_js');
add_filter('the_content', 'do_shortcode');
add_filter('wpcf7_form_elements', 'do_shortcode');


function custom_clean_head() {
	remove_action('wp_head', 'wp_print_scripts');
	remove_action('wp_head', 'wp_print_head_scripts', 9);
	remove_action('wp_head', 'wp_enqueue_scripts', 1);
}
add_action( 'wp_enqueue_scripts', 'custom_clean_head' );

add_action('wp_enqueue_scripts', 'add_js');
/* styles and scripts*/
function add_js() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/assets/js/vendors/jquery-2.2.1.min.js', false, filemtime(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . '/assets/js/vendors/jquery-2.2.1.min.js'), true);
	wp_register_script('index', get_template_directory_uri() . '/assets/js/index.min.js', false, filemtime(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . '/assets/js/index.min.js'), true);
	wp_register_script('maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAD3D50PWmODs12Xm6DYXUiox28DmF2dE8', false, null, true);

	wp_register_style('style', get_stylesheet_uri(), false, filemtime(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/style.css'));
	wp_register_style('index', get_template_directory_uri() . '/assets/css/index.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/index.css'));

	wp_enqueue_script('maps');
	wp_enqueue_script('jquery');
	wp_enqueue_script('index');

	wp_enqueue_style('index');
	wp_enqueue_style('style');
}

if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'post-thumbnails' );

register_nav_menus( array(
    'menu' => 'menu'
) );

add_filter( 'upload_size_limit', 'PBP_increase_upload' );
function PBP_increase_upload( $bytes ) {
	return 400000000;
}

function remove_menus(){
	if (current_user_can('administrator')) {
		remove_submenu_page('themes.php', 'themes.php');
		remove_submenu_page('themes.php','customize.php?return=%2Fwp-admin%2Ftheme-editor.php');
		remove_submenu_page('themes.php','theme-editor.php');
	}else {
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'edit.php?post_type=tehnology' );
		remove_menu_page( 'edit.php?post_type=project' );
		remove_menu_page( 'admin.php?page=wpcf7' );
	}

}
add_action('admin_menu', 'remove_menus');

remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );
wp_clear_scheduled_hook( 'wp_update_plugins' );

add_action('admin_print_footer_scripts', 'hide_tax_metabox_tabs_admin_styles', 99);
function hide_tax_metabox_tabs_admin_styles(){
	$cs = get_current_screen();
	if( $cs->base !== 'post' || empty($cs->post_type) ) return; // не страница редактирования записи
	?>
	<style>
		.postbox div.tabs-panel { max-height:1200px; border:0; }
		.category-tabs { display:none; }
	</style>
	<?php
}

function my_custom_login_logo(){
	echo '<style type="text/css">	h1 a { background-image:url('.get_template_directory_uri().'/assets/img/logo.svg) !important;background-size: 90% !important; }
	</style>';
}
add_action('login_head', 'my_custom_login_logo');

## Изменение внутреннего логотипа админки. Для версий с dashicons
add_action('add_admin_bar_menus', 'reset_admin_wplogo');
function reset_admin_wplogo(  ){
	remove_action( 'admin_bar_menu', 'wp_admin_bar_wp_menu', 10 ); // удаляем стандартную панель (логотип)

	add_action( 'admin_bar_menu', 'my_admin_bar_wp_menu', 10 ); // добавляем свою
}
function my_admin_bar_wp_menu( $wp_admin_bar ) {
	$wp_admin_bar->add_menu( array(
		'id'    => 'wp-logo',
		'title' => '<img style="width:auto;height:100%;" src="'.get_template_directory_uri().'/assets/img/logo.svg" alt="" >',
		'href'  => home_url('/about/'),
		'meta'  => array(
			'title' => 'Websrers',
		),
	) );
}

add_filter( 'the_content', 'wpautop' );
?>