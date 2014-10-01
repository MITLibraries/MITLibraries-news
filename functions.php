<?php 

// Register the custom post types
function register_news_posts() {
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
		'taxonomies' => 'feature-categories'
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
		'menu_position' => 5
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
		'menu_position' => 5
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
		'menu_position' => 5
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
		'menu_position' => 5
	);
	register_post_type('Updates', $argsUpdates);
}

add_action('init', 'register_news_posts');

function register_news_taxonomies() {
	// create a new taxonomy
	register_taxonomy(
		'feature-categories',
		'features',
		array(
			'label' => __( 'Feature Categories' ),
			'rewrite' => array( 'slug' => 'feature-categories' )
		)
	);
}
add_action( 'init', 'register_news_taxonomies' );
