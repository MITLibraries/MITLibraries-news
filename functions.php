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

	

	// spotlight
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
		'supports' => array('title'),
		'taxonomies' => array('category')
		
	);
	register_post_type('spotlights', $argsFeatures);
	
		
add_filter('apto_object_taxonomies', 'theme_apto_object_taxonomies', 10, 2);
function theme_apto_object_taxonomies($object_taxonomies, $post_type)
    {
        if($post_type == 'spotlight')
            {
                if (array_search('Events', $object_taxonomies) !== FALSE)
                    unset($object_taxonomies[array_search('Events', $object_taxonomies)]);
            }
        return $object_taxonomies;
    }
	
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
		'not_found_in_trash' => 'No Bibliotech found in Trash.',
		'taxonomies' => array('category')
		

	);
	$argsFeatures = array(
		'labels'  => $labelsFeatures,
		'public' => true,
		'menu_position' => 5,
		'supports' => $supports_default,
		'taxonomies' => array('category'),
		'capabilities' => array(
        'publish_posts' => 'Admin',
        'edit_posts' => 'Admin',
        'edit_others_posts' => 'Admin',
        'delete_posts' => 'Admin',
        'delete_others_posts' => 'Admin',
        'read_private_posts' => 'Admin',
        'edit_post' => 'Admin',
        'delete_post' => 'Admin',
        'read_post' => 'Admin'
		)
	);
	register_post_type('bibliotech', $argsFeatures);

	// Exhibits
	//$labelsExhibits = array(
	//	'name' => 'Spotlights - Exhibits',
	//	'singular_name' => 'Spotlights - Exhibit',
	//	'menu_name' => 'Spotlights - Exhibits',
	//	'name_admin_bar' => 'Spotlights - Exhibit',
	//	'add_new' => 'Add New',
	//	'add_new_item' => 'Add New Spotlights - Exhibit',
	//	'new_item' => 'New Spotlights - Exhibit',
	//	'edit_item' => 'Edit Spotlights - Exhibit',
	//	'view_item' => 'View Spotlights - Exhibit',
	//	'all_items' => 'All Spotlights - Exhibits',
	//	'search_items' => 'Search Spotlights - Exhibits',
	//	'parent_item_colon' => 'Parent Spotlights - Exhibits:',
	//	'not_found' => 'No Spotlights - Exhibits found.',
	//	'not_found_in_trash' => 'No Spotlights - Exhibits found in Trash.'
	//);
	//$argsExhibits = array(
	//	'labels'  => $labelsExhibits,
	//	'public' => true,
	//	'menu_position' => 5,
	//	'supports' => $supports_default,
	//	'taxonomies' => array('category')
	//);
	//register_post_type('exhibits', $argsExhibits);

	//// Tips
	//$labelsTips = array(
	//	'name' => 'Spotlights - Tips',
	//	'singular_name' => 'Spotlights - Tip',
	//	'menu_name' => 'Spotlights - Tips',
	//	'name_admin_bar' => 'Spotlights - Tip',
	//	'add_new' => 'Add New',
	//	'add_new_item' => 'Add New Spotlights - Tip',
	//	'new_item' => 'New Spotlights - Tip',
	//	'edit_item' => 'Edit Spotlights - Tip',
	//	'view_item' => 'View Spotlights - Tip',
	//	'all_items' => 'All Spotlights - Tips',
	//	'search_items' => 'Search Spotlights - Tips',
	//	'parent_item_colon' => 'Parent Spotlights - Tips:',
	//	'not_found' => 'No Spotlights - Tips found.',
	//	'not_found_in_trash' => 'No Spotlights - Tips found in Trash.'
	//);
	//$argsTips = array(
	//	'labels'  => $labelsTips,
	//	'public' => true,
	//	'menu_position' => 5,
	//	'supports' => $supports_default,
	//	'taxonomies' => array('category')
	//);
	//register_post_type('tips', $argsTips);

	// Facts
	//$labelsFacts = array(
		//'name' => 'Spotlights - Facts',
		//'singular_name' => 'Spotlights - Fact',
		//'menu_name' => 'Spotlights - Facts',
		//'name_admin_bar' => 'Spotlights - Fact',
		//'add_new' => 'Add New',
		//'add_new_item' => 'Add New Spotlights - Fact',
		//'new_item' => 'New Spotlights - Fact',
		//'edit_item' => 'Edit Spotlights - Fact',
		//'view_item' => 'View Spotlights - Fact',
		//'all_items' => 'All Spotlights - Facts',
		//'search_items' => 'Search Spotlights - Facts',
		//'parent_item_colon' => 'Parent Spotlights - Facts:',
		//'not_found' => 'No Spotlights - Facts found.',
		//'not_found_in_trash' => 'No Spotlights - Facts found in Trash.'
//	);
//	$argsFacts = array(
		//'labels'  => $labelsFacts,
		//'public' => true,
		//'menu_position' => 5,
		//'supports' => $supports_default,
		//'taxonomies' => array('category')
	//);
	//register_post_type('facts', $argsFacts);

	// Updates
	//$labelsUpdates = array(
	//	'name' => 'Spotlights - Updates',
	//	'singular_name' => 'Spotlights - Update',
	//	'menu_name' => 'Spotlights - Updates',
	//	'name_admin_bar' => 'Spotlights - Update',
	//	'add_new' => 'Add New',
	//	'add_new_item' => 'Add New Spotlights - Update',
	//	'new_item' => 'New Spotlights - Update',
	//	'edit_item' => 'Edit Spotlights - Update',
	//	'view_item' => 'View Spotlights - Update',
	//	'all_items' => 'All Spotlights - Updates',
	//	'search_items' => 'Search Spotlights - Updates',
	//	'parent_item_colon' => 'Parent Spotlights - Updates:',
	//	'not_found' => 'No Spotlights - Updates found.',
	//	'not_found_in_trash' => 'No Spotlights - Updates found in Trash.'
	//);
	//$argsUpdates = array(
	//	'labels'  => $labelsUpdates,
	//	'public' => true,
	//	'menu_position' => 5,
	//	'supports' => $supports_default,
	//	'taxonomies' => array('category')
	//);
	//register_post_type('updates', $argsUpdates);
}	//

add_action('init', 'mitlibnews_register_news_posts');

// Remove tags support from posts !!!PUT BACK
//function mitlibnews_unregister_tags() {
//	unregister_taxonomy_for_object_type('post_tag', 'post');
//}
//add_action('init', 'mitlibnews_unregister_tags');

// Disable admin color scheme
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );


// function wp_api_encode_acf($data,$post,$context){
// 	$data['meta'] = array_merge($data['meta'],get_fields($post['ID']));
// 	return $data;
// }
 
// if( function_exists('get_fields') ){
// 	add_filter('json_prepare_post', 'wp_api_encode_acf', 10, 3);
// }









//custom images for the news
add_theme_support( 'post-thumbnails' );
add_image_size( 'news-home', 111, 206, true ); // Hard Crop Mode
add_image_size( 'news-listing', 323, 111, true ); // Hard Crop Mode
add_image_size( 'news-feature', 657, 256, true ); /// Hard Crop Mode
add_image_size( 'news-single', 451,'651', true ); /// Hard Crop Mode


function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

if ( current_user_can('contributor') && !current_user_can('upload_files') )
	add_action('admin_init', 'allow_contributor_uploads');

function allow_contributor_uploads() {
	$contributor = get_role('contributor');
	$contributor->add_cap('upload_files');
}



function init_category($request) {
	$vars = $request->query_vars;
	if (is_category() && !is_category('bibliotech') && !array_key_exists('post_type', $vars)) :
		$vars = array_merge(
			$vars,
			array('post_type' => 'any')
		);
		$request->query_vars = $vars;
	endif;
	return $request;
}
add_filter('pre_get_posts', 'init_category');


////remove no longer used categories
//function wpse_77670_filterGetTermArgs($args, $taxonomies) {
//    global $typenow;
//
//    if ($typenow == 'tsv_userpost') {
//        // check whether we're currently filtering selected taxonomy
//        if (implode('', $taxonomies) == 'category') {
//            $cats = array(73, 74,); // as an array
//
//            if (empty($cats))
//                $args['include'] = array(99999999); // no available categories
//            else
//                $args['include'] = $cats;
//        }
//    }
//
//    return $args;
//}
//
//if (is_admin()) {
//    add_filter('get_terms_args', 'wpse_77670_filterGetTermArgs', 10, 2);
//}


//Event RSS feed

add_action('init', 'eventRSS');
function eventRSS(){
        add_feed('event', 'eventRSSFunc');
}

function eventRSSFunc(){
        get_template_part('rss', 'event');
}

//removes plugins tools users
function remove_menu_items() {
  global $menu;
  $restricted = array(__('Links'), __('Comments')/*, __('Media')*/,
  /*__('Plugins'), __('Tools'),*/ __('Users'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
  }

add_action('admin_menu', 'remove_menu_items');


function remove_submenus() {
  global $submenu;
  unset($submenu['index.php'][10]); // Removes 'Updates'.
  unset($submenu['themes.php'][5]); // Removes 'Themes'.

  unset($submenu['options-general.php'][25]); // Removes 'Discussion'.
 
}

add_action('admin_menu', 'remove_submenus');

function remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}

add_action('_admin_menu', 'remove_editor_menu', 1);


function customize_meta_boxes() {
  /* Removes meta boxes from Posts */
 // remove_meta_box('postcustom','post','normal');
  remove_meta_box('trackbacksdiv','post','normal');
  remove_meta_box('commentstatusdiv','post','normal');
  remove_meta_box('commentsdiv','post','normal');
  //remove_meta_box('tagsdiv-post_tag','post','normal');
  remove_meta_box('postexcerpt','post','normal');
   
  /* Removes meta boxes from pages */
 // remove_meta_box('postcustom','page','normal');
  remove_meta_box('trackbacksdiv','page','normal');
  remove_meta_box('commentstatusdiv','page','normal');
  remove_meta_box('commentsdiv','page','normal');  
  
}
add_action('admin_init','customize_meta_boxes');


function custom_favorite_actions($actions) {
  unset($actions['edit-comments.php']);
  return $actions;
}
add_filter('favorite_actions', 'custom_favorite_actions');


function remove_thumbnail_box() {
    remove_meta_box( 'postimagediv','post','side' );
}
add_action('do_meta_boxes', 'remove_thumbnail_box');

//function hide_all_slugs() {
//global $post;
//$hide_slugs = "<style type=\"text/css\"> #slugdiv, #edit-slug-box { display: none; }</style>";
//print($hide_slugs);
//}
//add_action( 'admin_head', 'hide_all_slugs'  );
//remove parent bibliotech menu
add_action('admin_head', 'removeBiblioSelect');
function registerCustomAdminCss(){
$src = "/wp-content/themes/mit-libraries-news/custom-admin-css.css";
$handle = "customAdminCss";
wp_register_script($handle, $src);
wp_enqueue_style($handle, $src, array(), false, false);
    }
    add_action('admin_head', 'registerCustomAdminCss');
if ( ! function_exists( 'biblio_taxonomy' ) ) {

// Register Custom Taxonomy
function biblio_taxonomy() {

	$labels = array(
		'name'                       => _x( 'bibliotechs', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'bibliotech', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Bibliotech Issues', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		
	);
	register_taxonomy( 'bibliotech_issues', array( 'bibliotech' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'biblio_taxonomy', 0 );


}

wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.css', 'false', '', false);
wp_enqueue_style( 'newsmobile', get_stylesheet_directory_uri() . '/css/newsmobile.css', 'false', '', false);
wp_enqueue_script( 'bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js', array( 'jquery' ), '3.3.1', true);
wp_enqueue_script( 'lazyload', get_stylesheet_directory_uri() . '/js/lazyload.js', array( 'jquery' ), '', true);
wp_enqueue_script( 'myScripts', get_stylesheet_directory_uri() . '/js/myScripts.js', array( 'lazyload' ), '', true );

function remove_scripts(){
	wp_deregister_script('tabletop' );
	//wp_deregister_script('productionJS');
	wp_deregister_script('underscore');
	wp_deregister_script('lib-hours');
}
add_action( 'wp_enqueue_scripts', 'remove_scripts', 100 ); 

//new admin ui page for whats in the news?
add_action( 'admin_menu', 'register_my_custom_menu_page' );

function register_my_custom_menu_page(){
	add_menu_page( 'custom menu title', 'custom menu', 'manage_options', 'custompage', 'my_custom_menu_page', plugins_url( 'myplugin/images/icon.png' ), 6 ); 
}

function my_custom_menu_page(){
	
echo "hello";
	
}




?>