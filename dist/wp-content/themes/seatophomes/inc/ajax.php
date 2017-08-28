<?php
add_action('wp_ajax_test', 'test_ajax');
add_action('wp_ajax_nopriv_test', 'test_ajax');
function test_ajax() {

	$ajax_page = $_GET['page'];
	define( 'TEMPLATEPATH', get_template_directory_uri() );
	$url = TEMPLATEPATH . '/contents/content';
	if ($ajax_page === 'index') {
		$url .= '-home';
	} elseif($ajax_page === 'portfolio_index') {
		$url .= '-portfolio';
	} elseif(is_numeric($ajax_page)) {
		$url .= '-portfolioss';
	} elseif($ajax_page === 'portfolio' || $ajax_page === 'team' ||
		$ajax_page === 'contacts' || $ajax_page === 'blog') {
		$url .= '-'.$ajax_page;
	}
	$url .= '.php';

	ob_start();
	if(is_numeric($ajax_page)) {
		$post = $ajax_page;
	}
	require_once($url);
	$content_page = ob_get_contents();
	ob_end_clean();
	echo $content_page;

	exit;
}