<?php

// Remove dashboard menu items
function mitlibnews_remove_dashboard_menu_items() {
	if (!current_user_can('add_users')) {
		remove_menu_page('edit-comments.php');
		remove_menu_page('tools.php');
	}
}

add_action('admin_menu', 'mitlibnews_remove_dashboard_menu_items');

// Remove unneeded dashboard widgets
function mitlibnews_remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Quickpress widget
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // Wordpress news
	if (!current_user_can('add_users')) {
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // "At a glance" widget
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal'); // Activity widget
	}
} 

add_action('do_meta_boxes', 'mitlibnews_remove_dashboard_widgets' );

// Register the custom post types
function mitlibnews_register_news_posts() {
	$supports_default = array(
		'title',
		'editor',
		'thumbnail',
		'excerpt'
	);

	// Bibliotech
	$labelsFeatures = array(
		'name' => 'Bibliotech',
		'singular_name' => 'Bibliotech',
		'menu_name' => 'Bibliotech',
		'name_admin_bar' => 'Bibliotech',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Bibliotech',
		'new_item' => 'New Bibliotech',
		'edit_item' => 'Edit Bibliotech',
		'view_item' => 'View Bibliotech',
		'all_items' => 'All Bibliotech',
		'search_items' => 'Search Bibliotech',
		'parent_item_colon' => 'Parent Bibliotech:',
		'not_found' => 'No Bibliotech found.',
		'not_found_in_trash' => 'No Bibliotech found in Trash.'
	);
	$argsFeatures = array(
		'labels'  => $labelsFeatures,
		'public' => true,
		'menu_position' => 5,
		'supports' => $supports_default,
		'taxonomies' => array('category'),
		'has_archive' => true
	);
	register_post_type('bibliotech', $argsFeatures);

	// Spotlights
	$labelsFeatures = array(
		'name' => 'Spotlights',
		'singular_name' => 'Spotlight',
		'menu_name' => 'Spotlights',
		'name_admin_bar' => 'Spotlight',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Spotlight',
		'new_item' => 'New Spotlight',
		'edit_item' => 'Edit Spotlight',
		'view_item' => 'View Spotlight',
		'all_items' => 'All Spotlights',
		'search_items' => 'Search Spotlights',
		'parent_item_colon' => 'Parent Spotlights:',
		'not_found' => 'No Spotlights found.',
		'not_found_in_trash' => 'No Spotlights found in Trash.'
	);
	$argsFeatures = array(
		'labels'  => $labelsFeatures,
		'public' => true,
		'menu_position' => 5,
		'supports' => $supports_default,
		'taxonomies' => array('category'),
		'has_archive' => true
	);
	register_post_type('spotlights', $argsFeatures);
}

add_action('init', 'mitlibnews_register_news_posts');

// Remove tags support from posts
function mitlibnews_unregister_tags() {
	unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'mitlibnews_unregister_tags');

// Disable admin color scheme
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

// function wp_api_encode_acf($data,$post,$context){
// 	$data['meta'] = array_merge($data['meta'],get_fields($post['ID']));
// 	return $data;
// }
 
// if( function_exists('get_fields') ){
// 	add_filter('json_prepare_post', 'wp_api_encode_acf', 10, 3);
// }