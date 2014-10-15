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
} 

add_action('do_meta_boxes', 'mitlibnews_remove_dashboard_widgets' );

// Add dashboard widgets
function mitlibnews_add_dashboard_widgets() {
	// Add an urgent posts dashboard widget
	wp_add_dashboard_widget(
		'mitlibnews_urgent_dashboard_widget',
		'Urgent posts',
		'mitlibnews_urgent_dashboard_widget_function'
	);
}

add_action( 'wp_dashboard_setup', 'mitlibnews_add_dashboard_widgets' );

// Build Urgent posts dashboard widget
function mitlibnews_urgent_dashboard_widget_function() {

	$args = array(
	  'post_type' => 'post',
	  'orderby'   => 'title',
	  'order'     => 'ASC',
	  'posts_per_page' => 5,
	  'meta_key'		=> 'urgent',
		'meta_value'		=> true
	);

	$urgent_posts = new WP_Query( $args );

	// The Loop
	if ( $urgent_posts->have_posts() ) {
		echo  '<table class="widefat">' .
						'<thead>' .
							'<tr class="form-invalid">' .
								'<th class="row-title">Post title</th>' .
								'<th>Post author</th>' .
							'</tr>' .
						'</thead>' .
						'<tbody>';
		while ( $urgent_posts->have_posts() ) {
			$urgent_posts->the_post();
			echo  '<tr>' .
							'<td class="row-title"><a href="' . get_edit_post_link() . '">' . get_the_title() . '</a></td>' .
							'<td>' . get_the_author() . '</td>' .
						'</tr>';
		}
		echo    '</tbody>' .
					'</table>';
	} else {
		echo 'There are no urgent posts.';
	}

	wp_reset_postdata();
	
}

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
		'taxonomies' => array('category')
	);
	register_post_type('Bibliotech', $argsFeatures);

	// Features
	$labelsFeatures = array(
		'name' => 'Features',
		'singular_name' => 'Feature',
		'menu_name' => 'Features',
		'name_admin_bar' => 'Feature',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Feature',
		'new_item' => 'New Feature',
		'edit_item' => 'Edit Feature',
		'view_item' => 'View Feature',
		'all_items' => 'All Features',
		'search_items' => 'Search Features',
		'parent_item_colon' => 'Parent Features:',
		'not_found' => 'No Features found.',
		'not_found_in_trash' => 'No Features found in Trash.'
	);
	$argsFeatures = array(
		'labels'  => $labelsFeatures,
		'public' => true,
		'menu_position' => 5,
		'supports' => $supports_default,
		'taxonomies' => array('category')
	);
	register_post_type('Features', $argsFeatures);

	// Exhibits
	$labelsExhibits = array(
		'name' => 'Exhibits',
		'singular_name' => 'Exhibit',
		'menu_name' => 'Exhibits',
		'name_admin_bar' => 'Exhibit',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Exhibit',
		'new_item' => 'New Exhibit',
		'edit_item' => 'Edit Exhibit',
		'view_item' => 'View Exhibit',
		'all_items' => 'All Exhibits',
		'search_items' => 'Search Exhibits',
		'parent_item_colon' => 'Parent Exhibits:',
		'not_found' => 'No Exhibits found.',
		'not_found_in_trash' => 'No Exhibits found in Trash.'
	);
	$argsExhibits = array(
		'labels'  => $labelsExhibits,
		'public' => true,
		'menu_position' => 5,
		'supports' => $supports_default,
		'taxonomies' => array('category')
	);
	register_post_type('Exhibits', $argsExhibits);

	// Tips
	$labelsTips = array(
		'name' => 'Tips',
		'singular_name' => 'Tip',
		'menu_name' => 'Tips',
		'name_admin_bar' => 'Tip',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Tip',
		'new_item' => 'New Tip',
		'edit_item' => 'Edit Tip',
		'view_item' => 'View Tip',
		'all_items' => 'All Tips',
		'search_items' => 'Search Tips',
		'parent_item_colon' => 'Parent Tips:',
		'not_found' => 'No Tips found.',
		'not_found_in_trash' => 'No Tips found in Trash.'
	);
	$argsTips = array(
		'labels'  => $labelsTips,
		'public' => true,
		'menu_position' => 5,
		'supports' => $supports_default,
		'taxonomies' => array('category')
	);
	register_post_type('Tips', $argsTips);

	// Facts
	$labelsFacts = array(
		'name' => 'Facts',
		'singular_name' => 'Fact',
		'menu_name' => 'Facts',
		'name_admin_bar' => 'Fact',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Fact',
		'new_item' => 'New Fact',
		'edit_item' => 'Edit Fact',
		'view_item' => 'View Fact',
		'all_items' => 'All Facts',
		'search_items' => 'Search Facts',
		'parent_item_colon' => 'Parent Facts:',
		'not_found' => 'No Facts found.',
		'not_found_in_trash' => 'No Facts found in Trash.'
	);
	$argsFacts = array(
		'labels'  => $labelsFacts,
		'public' => true,
		'menu_position' => 5,
		'supports' => $supports_default,
		'taxonomies' => array('category')
	);
	register_post_type('Facts', $argsFacts);

	// Updates
	$labelsUpdates = array(
		'name' => 'Updates',
		'singular_name' => 'Update',
		'menu_name' => 'Updates',
		'name_admin_bar' => 'Update',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Update',
		'new_item' => 'New Update',
		'edit_item' => 'Edit Update',
		'view_item' => 'View Update',
		'all_items' => 'All Updates',
		'search_items' => 'Search Updates',
		'parent_item_colon' => 'Parent Updates:',
		'not_found' => 'No Updates found.',
		'not_found_in_trash' => 'No Updates found in Trash.'
	);
	$argsUpdates = array(
		'labels'  => $labelsUpdates,
		'public' => true,
		'menu_position' => 5,
		'supports' => $supports_default,
		'taxonomies' => array('category')
	);
	register_post_type('Updates', $argsUpdates);
}

add_action('init', 'mitlibnews_register_news_posts');

// Remove tags support from posts
function mitlibnews_unregister_tags() {
	unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'mitlibnews_unregister_tags');


// function wp_api_encode_acf($data,$post,$context){
// 	$data['meta'] = array_merge($data['meta'],get_fields($post['ID']));
// 	return $data;
// }
 
// if( function_exists('get_fields') ){
// 	add_filter('json_prepare_post', 'wp_api_encode_acf', 10, 3);
// }