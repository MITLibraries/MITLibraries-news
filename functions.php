<?php
/**
 * News theme functions and definitions
 *
 * @package MITLibraries-News
 * @since Twenty Twelve 1.0
 */

// Adds auto-loader for lib content
$siteRoot = $_SERVER['DOCUMENT_ROOT'];
foreach (glob( $siteRoot . '/wp-content/themes/mit-libraries-news/lib/*.php' ) as $file) require_once( $file );

/**
 * Add Bootstrap and mobile CSS for non-admin users
 */
function not_admin() {
	wp_enqueue_style( 'bootstrapCSS', get_stylesheet_directory_uri() . '/css/bootstrap.css', 'false', '', false );
	wp_enqueue_style( 'newsmobile', get_stylesheet_directory_uri() . '/css/newsmobile.css', 'false', '', false );
	wp_enqueue_script( 'bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js', array( 'jquery' ), '3.3.1', true );
}
if ( ! is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'not_admin' );
}

/**
 * Add LazyLoad and MyScripts for all users
 */
function add_scripts() {
	wp_enqueue_script( 'lazyload', get_stylesheet_directory_uri() . '/js/lazyload.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'myScripts', get_stylesheet_directory_uri() . '/js/myScripts.js', array( 'lazyload' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'add_scripts' );

/**
 * This de-registers scripts from the parent theme, but they don't seem to actually be used?
 */
function remove_scripts(){
	// wp_deregister_script('tabletop' );
	// wp_deregister_script('productionJS');
	// wp_deregister_script('underscore');
	// wp_deregister_script('lib-hours');
}
add_action( 'wp_enqueue_scripts', 'remove_scripts', 100 );

/**
 * Remove dashboard menu items
 */
function mitlibnews_remove_dashboard_menu_items() {
	if ( ! current_user_can( 'add_users' ) ) {
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'edit.php?post_type=html_snippet' );
	}
}
add_action( 'admin_menu', 'mitlibnews_remove_dashboard_menu_items' );

/**
 * Remove unneeded dashboard widgets
 */
function mitlibnews_remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Quickpress widget
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // Wordpress news
	if ( ! current_user_can( 'add_users' ) ) {
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // "At a glance" widget
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Activity widget
	}
}
add_action( 'do_meta_boxes', 'mitlibnews_remove_dashboard_widgets' );

/**
 * Hide addthis widget from non-admins on dashboard
 */
function hide_addthis() {
	global $user_level;
	if ( $user_level != '10' ) {
	   echo '<style type="text/css">
		   #at_widget,
		   .metabox-prefs label:nth-child(13) {
			   display: none;
			   }
		 </style>';
	}
}
add_action( 'admin_head', 'hide_addthis' );

/**
 * Register the custom post types
 */
function mitlibnews_register_news_posts() {
	$supports_default = array(
		'title',
		'editor',
		'thumbnail',
		'excerpt',
	);
	// spotlight
	$labelsFeatures = array(
		'name' => 'Spotlights',
		'singular_name' => 'Spotlight',
		'menu_name' => 'Spotlights',
		'name_admin_bar' => 'Spotlight',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Spotlight - should be about 60 characters',
		'new_item' => 'New Spotlight',
		'edit_item' => 'Edit Spotlight',
		'view_item' => 'View Spotlight',
		'all_items' => 'All Spotlights',
		'search_items' => 'Search Spotlights',
		'parent_item_colon' => 'Parent Spotlights:',
		'not_found' => 'No Spotlights found.',
		'not_found_in_trash' => 'No Spotlights found in Trash.',
	);
	$argsFeatures = array(
		'labels'  => $labelsFeatures,
		'public' => true,
		'menu_position' => 5,
		'supports' => array( 'title' ),
		'taxonomies' => array( 'category' ),

	);
	register_post_type( 'spotlights', $argsFeatures );

	/**
	 * Unknown function that does not seem to be used.
	 *
	 * @param object $object_taxonomies A set of taxonomies.
	 * @param string $post_type The type of a given post.
	 */
	function theme_apto_object_taxonomies( $object_taxonomies, $post_type ) {
		if ( $post_type == 'spotlight' ) {
				if (array_search( 'Events', $object_taxonomies ) !== FALSE)
					unset( $object_taxonomies[ array_search( 'Events', $object_taxonomies ) ] );
			}
		return $object_taxonomies;
	}
	add_filter( 'apto_object_taxonomies', 'theme_apto_object_taxonomies', 10, 2 );

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
		'taxonomies' => array( 'category' ),

	);
	$argsFeatures = array(
		'labels'  => $labelsFeatures,
		'public' => true,
		'menu_position' => 5,
		'supports' => $supports_default,
		'taxonomies' => array( 'category' ),
	);
	register_post_type( 'bibliotech', $argsFeatures );

}

/*
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
*/

add_action( 'init', 'mitlibnews_register_news_posts' );

// Disable admin color scheme
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

// custom images for the news
add_theme_support( 'post-thumbnails' );
add_image_size( 'news-home', 111, 206, true ); // Hard Crop Mode
add_image_size( 'news-listing', 323, 111, true ); // Hard Crop Mode
add_image_size( 'news-feature', 657, 256, true ); // Hard Crop Mode
add_image_size( 'news-single', 451,'651', true ); // Hard Crop Mode

/**
 * This function trims a WP excerpt at a word limit defined by $limit. If no
 * limit (or a negative number) is received, the entire excerpt is returned.
 *
 * @param int $limit The number of words requested.
 */
function excerpt( $limit = 0 ) {
	$excerpt = get_the_excerpt();
	if ( $limit > 0 ) {
		$excerpt = explode( ' ', get_the_excerpt(), $limit );
		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$excerpt = implode( ' ',$excerpt ) . '...';
		} else {
			$excerpt = implode( ' ',$excerpt );
		}
	}
	$excerpt = preg_replace( '`\[[^\]]*\]`','',$excerpt );
	return $excerpt;
}

/**
 * This function trims a WP post content at a word limit defined by $limit. If
 * no limit (or a negaive number) is received, the entire content is returned.
 *
 * @param int $limit The number of words requested.
 */
function content( $limit = 0 ) {
	$content = get_the_content();
	if ( $limit > 0 ) {
		$content = explode( ' ', get_the_content(), $limit );
		if ( count( $content ) >= $limit ) {
			array_pop( $content );
			$content = implode( ' ',$content ) . '...';
		} else {
			$content = implode( ' ',$content );
		}
	}
	$content = preg_replace( '/\[.+\]/','', $content );
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	return $content;
}

/**
 * Allows contributor to upload images
 */
function allow_contributor_uploads() {
	$contributor = get_role( 'contributor' );
	$contributor->add_cap( 'upload_files' );
}
if ( current_user_can( 'contributor' ) && ! current_user_can( 'upload_files' ) )
	add_action( 'admin_init', 'allow_contributor_uploads' );

/**
 * Replaces category page # with category name
 *
 * @param object $request A request object.
 */
function init_category( $request ) {
	$vars = $request->query_vars;
	if ( is_category() && ! is_category( 'bibliotech' ) && ! array_key_exists( 'post_type', $vars ) ) :
		$vars = array_merge(
			$vars,
			array( 'post_type' => 'any' )
		);
		$request->query_vars = $vars;
	endif;
	return $request;
}
add_filter( 'pre_get_posts', 'init_category' );


/**
 * Event RSS feed
 */
function eventRSS(){
		add_feed( 'event', 'eventRSSFunc' );
}
add_action( 'init', 'eventRSS' );

/**
 * Event RSS Function
 */
function eventRSSFunc(){
		get_template_part( 'rss', 'event' );
}

// removes plugins tools users
// function remove_menu_items() {
// global $menu;
// $restricted = array(__('Links'), __('Comments')/*, __('Media')*/,
// *__('Plugins'), __('Tools'),*/ __('Users'));
// end ($menu);
// while (prev($menu)){
// $value = explode(' ',$menu[key($menu)][0]);
// if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
// unset($menu[key($menu)]);}
// }
// }
//
// add_action('admin_menu', 'remove_menu_items');
/**
 * Customize meta boxes on admin interface
 */
function customize_meta_boxes() {
	/*
	 Removes meta boxes from Posts */
	// remove_meta_box('postcustom','post','normal');
	remove_meta_box( 'trackbacksdiv','post','normal' );
	remove_meta_box( 'commentstatusdiv','post','normal' );
	remove_meta_box( 'commentsdiv','post','normal' );
	// remove_meta_box('tagsdiv-post_tag','post','normal');
	remove_meta_box( 'postexcerpt','post','normal' );

	/*
	 Removes meta boxes from pages */
	// remove_meta_box('postcustom','page','normal');
	remove_meta_box( 'trackbacksdiv','page','normal' );
	remove_meta_box( 'commentstatusdiv','page','normal' );
	remove_meta_box( 'commentsdiv','page','normal' );

}
add_action( 'admin_init','customize_meta_boxes' );

/**
 * Removes edit-comments.php file
 *
 * @param object $actions An object.
 */
function custom_favorite_actions( $actions ) {
	unset( $actions['edit-comments.php'] );
	return $actions;
}
add_filter( 'favorite_actions', 'custom_favorite_actions' );

/**
 * Removes featured-image option for posts
 */
function remove_thumbnail_box() {
	remove_meta_box( 'postimagediv','post','side' );
}
add_action( 'do_meta_boxes', 'remove_thumbnail_box' );

/**
 * Registers custom css file for admin dashboard
 */
function registerCustomAdminCss(){
$src = '/wp-content/themes/mit-libraries-news/custom-admin-css.css';
$handle = 'customAdminCss';
wp_register_script( $handle, $src );
wp_enqueue_style( $handle, $src, array(), false, false );
	}
	add_action( 'admin_head', 'registerCustomAdminCss' );
if ( ! function_exists( 'biblio_taxonomy' ) ) {

	/**
	 * Register Custom Taxonomy
	 */
	function biblio_taxonomy() {

		$labels = array(
			'name'                       => _x( 'bibliotechs', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'bibliotech', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Create issue', 'text_domain' ),
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

/**
 * Registers news sidebar
 */
function news_sidebar_widget() {

	register_sidebar( array(
		'name'          => 'subscribe',
		'id'            => 'subscribe',
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget' => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'news_sidebar_widget' );


/**
 * Lets the user search relevant post types
 *
 * @param object $query A query object.
 */
function SearchFilter( $query ) {
if ( $query->is_search ) {
$query->set( 'post_type', array( 'post', 'Bibliotech', 'Spotlights' ) );
}
return $query;
}
add_filter( 'pre_get_posts','SearchFilter' );

?>
