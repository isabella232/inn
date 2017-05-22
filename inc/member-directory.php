<?php
// Register Custom Post Type
function inn_member_directory() {

	$labels = array(
		'name'                  => _x( 'Members', 'Post Type General Name', 'inn' ),
		'singular_name'         => _x( 'Member', 'Post Type Singular Name', 'inn' ),
		'menu_name'             => __( 'INN Members', 'inn' ),
		'name_admin_bar'        => __( 'INN Members', 'inn' ),
		'archives'              => __( 'INN Member Archives', 'inn' ),
		'attributes'            => __( 'INN Member Attributes', 'inn' ),
		'parent_item_colon'     => __( '', 'inn' ),
		'all_items'             => __( 'All Members', 'inn' ),
		'add_new_item'          => __( 'Add New Member', 'inn' ),
		'add_new'               => __( 'Add New', 'inn' ),
		'new_item'              => __( 'New Item', 'inn' ),
		'edit_item'             => __( 'Edit Item', 'inn' ),
		'update_item'           => __( 'Update Item', 'inn' ),
		'view_item'             => __( 'View Item', 'inn' ),
		'view_items'            => __( 'View Items', 'inn' ),
		'search_items'          => __( 'Search Item', 'inn' ),
		'not_found'             => __( 'Not found', 'inn' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'inn' ),
		'featured_image'        => __( 'Featured Image', 'inn' ),
		'set_featured_image'    => __( 'Set featured image', 'inn' ),
		'remove_featured_image' => __( 'Remove featured image', 'inn' ),
		'use_featured_image'    => __( 'Use as featured image', 'inn' ),
		'insert_into_item'      => __( 'Insert into item', 'inn' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'inn' ),
		'items_list'            => __( 'Items list', 'inn' ),
		'items_list_navigation' => __( 'Items list navigation', 'inn' ),
		'filter_items_list'     => __( 'Filter items list', 'inn' ),
	);
	$args = array(
		'label'                 => __( 'Member', 'inn' ),
		'description'           => __( 'INN Member Directory', 'inn' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-users',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'member_directory', $args );

}
add_action( 'init', 'inn_member_directory', 0 );

function member_focus_areas() {

	$labels = array(
		'name'                       => _x( 'Focus Areas', 'Taxonomy General Name', 'inn' ),
		'singular_name'              => _x( 'Focus Area', 'Taxonomy Singular Name', 'inn' ),
		'menu_name'                  => __( 'Focus Areas', 'inn' ),
		'all_items'                  => __( 'All Focus Areas', 'inn' ),
		'parent_item'                => __( 'Parent Item', 'inn' ),
		'parent_item_colon'          => __( 'Parent Item:', 'inn' ),
		'new_item_name'              => __( 'New Focus Area', 'inn' ),
		'add_new_item'               => __( 'Add New Focus Area', 'inn' ),
		'edit_item'                  => __( 'Edit Focus Area', 'inn' ),
		'update_item'                => __( 'Update Focus Area', 'inn' ),
		'view_item'                  => __( 'View Focus Area', 'inn' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'inn' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'inn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'inn' ),
		'popular_items'              => __( 'Popular Items', 'inn' ),
		'search_items'               => __( 'Search Items', 'inn' ),
		'not_found'                  => __( 'Not Found', 'inn' ),
		'no_terms'                   => __( 'No items', 'inn' ),
		'items_list'                 => __( 'Items list', 'inn' ),
		'items_list_navigation'      => __( 'Items list navigation', 'inn' ),
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
	register_taxonomy( 'member_focus_areas', array( 'member_directory' ), $args );

}
add_action( 'init', 'member_focus_areas', 0 );

add_action( 'cmb2_admin_init', 'inn_member_info' );
function inn_member_info() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_';

	/**
	 * Initiate the metabox
	 */
	$member_info = new_cmb2_box( array(
		'id'            => 'member_info',
		'title'         => __( 'Member Info', 'cmb2' ),
		'object_types'  => array( 'member_directory', ), // Post type
		'context'       => 'normal',
		'priority'      => 'low',
		'show_names'    => true, // Show field names on the left
	) );

	$member_info->add_field( array(
		'name'       => __( 'Year Founded', 'cmb2' ),
		'desc'       => __( '', 'cmb2' ),
		'id'         => $prefix . 'year_founded',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	$member_info->add_field( array(
		'name'       => __( 'INN Member Since', 'cmb2' ),
		'desc'       => __( '', 'cmb2' ),
		'id'         => $prefix . 'inn_join_year',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	// Email text field
	$member_info->add_field( array(
		'name' => __( 'Contact Email', 'cmb2' ),
		'desc' => __( '', 'cmb2' ),
		'id'   => $prefix . 'email',
		'type' => 'text_email',
	) );

	$member_info->add_field( array(
		'name' => __( 'Website URL', 'cmb2' ),
		'desc' => __( '', 'cmb2' ),
		'id'   => $prefix . 'url',
		'type' => 'text_url',
		'protocols' => array( 'http', 'https' ), // Array of allowed protocols
	) );

	$member_info->add_field( array(
		'name' => __( 'Donate URL', 'cmb2' ),
		'desc' => __( '', 'cmb2' ),
		'id'   => $prefix . 'donate_url',
		'type' => 'text_url',
		'protocols' => array( 'http', 'https' ), // Array of allowed protocols
	) );

	$member_info->add_field( array(
		'name' => __( 'RSS Feed', 'cmb2' ),
		'desc' => __( '', 'cmb2' ),
		'id'   => $prefix . 'rss_feed',
		'type' => 'text_url',
		'protocols' => array( 'http', 'https' ), // Array of allowed protocols
	) );

	$member_info->add_field( array(
		'name' => __( 'Twitter Profile', 'cmb2' ),
		'desc' => __( '', 'cmb2' ),
		'id'   => $prefix . 'twitter_url',
		'type' => 'text_url',
		'protocols' => array( 'http', 'https' ), // Array of allowed protocols
	) );

	$member_info->add_field( array(
		'name' => __( 'Facebook Page', 'cmb2' ),
		'desc' => __( '', 'cmb2' ),
		'id'   => $prefix . 'facebook_url',
		'type' => 'text_url',
		'protocols' => array( 'http', 'https' ), // Array of allowed protocols
	) );

	$member_info->add_field( array(
		'name' => __( 'Google+ URL', 'cmb2' ),
		'desc' => __( '', 'cmb2' ),
		'id'   => $prefix . 'google_plus_url',
		'type' => 'text_url',
		'protocols' => array( 'http', 'https' ), // Array of allowed protocols
	) );

	$member_info->add_field( array(
		'name' => __( 'Youtube URL', 'cmb2' ),
		'desc' => __( '', 'cmb2' ),
		'id'   => $prefix . 'youtube_url',
		'type' => 'text_url',
		'protocols' => array( 'http', 'https' ), // Array of allowed protocols
	) );
}
