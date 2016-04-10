<?php 
// Register Custom Project Post Type
function project_post_type() {
	$labels = array(
		'name'                  => _x( 'Projects', 'Post Type General Name', 'wpx' ),
		'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'wpx' ),
		'menu_name'             => __( 'Project', 'wpx' ),
		'name_admin_bar'        => __( 'Project', 'wpx' ),
		'archives'              => __( 'Project Archives', 'wpx' ),
		'parent_item_colon'     => __( 'Parent Project:', 'wpx' ),
		'all_items'             => __( 'All Projects', 'wpx' ),
		'add_new_item'          => __( 'Add New Project', 'wpx' ),
		'add_new'               => __( 'Add New', 'wpx' ),
		'new_item'              => __( 'New Project', 'wpx' ),
		'edit_item'             => __( 'Edit Project', 'wpx' ),
		'update_item'           => __( 'Update Project', 'wpx' ),
		'view_item'             => __( 'View Project', 'wpx' ),
		'search_items'          => __( 'Search Project', 'wpx' ),
		'not_found'             => __( 'Not found', 'wpx' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wpx' ),
		'featured_image'        => __( 'Featured Image', 'wpx' ),
		'set_featured_image'    => __( 'Set featured image', 'wpx' ),
		'remove_featured_image' => __( 'Remove featured image', 'wpx' ),
		'use_featured_image'    => __( 'Use as featured image', 'wpx' ),
		'insert_into_item'      => __( 'Insert into item', 'wpx' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'wpx' ),
		'items_list'            => __( 'Projects list', 'wpx' ),
		'items_list_navigation' => __( 'Projects list navigation', 'wpx' ),
		'filter_items_list'     => __( 'Filter items list', 'wpx' ),
	);
	$args = array(
		'label'                 => __( 'Project', 'wpx' ),
		'description'           => __( 'Projects for users.', 'wpx' ),
		'labels'                => $labels,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'page-attributes' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_icon' => '',
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'project', $args );
}
add_action( 'init', 'project_post_type', 0 );
// Query Custom Post Type
function query_project_posts(){
	// WP_Query arguments
	$args = array (
		'post_type'              => array( 'project' ),
		'post_status'            => array( 'publish' ),
		'posts_per_page'         => '12',
		'order'                  => 'DESC',
	);
	// The Query
	$query = new WP_Query( $args );
}
// Add Shortcode
function project_shortcode( $atts ) {
	// Attributes
	extract( shortcode_atts(
		array(
			'count' => '6',
		), $atts )
	);
}
add_shortcode( 'get-projects', 'project_shortcode' );

// Change Dash Icon
// https://developer.wordpress.org/resource/dashicons/#edit
function add_menu_icons_styles(){ ?>
	<style>#adminmenu .menu-icon-project div.wp-menu-image:before { content: '\f133';}</style><?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );





