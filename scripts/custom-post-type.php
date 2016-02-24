<?php 
// Register Custom Portfolio Post Type
function portfolio_post_type() {
	$labels = array(
		'name'                  => _x( 'Portfolios', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Portfolio', 'text_domain' ),
		'name_admin_bar'        => __( 'Portfolio', 'text_domain' ),
		'archives'              => __( 'Portfolio Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Portfolio:', 'text_domain' ),
		'all_items'             => __( 'All Portfolios', 'text_domain' ),
		'add_new_item'          => __( 'Add New Portfolio', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Portfolio', 'text_domain' ),
		'edit_item'             => __( 'Edit Portfolio', 'text_domain' ),
		'update_item'           => __( 'Update Portfolio', 'text_domain' ),
		'view_item'             => __( 'View Portfolio', 'text_domain' ),
		'search_items'          => __( 'Search Portfolio', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Portfolios list', 'text_domain' ),
		'items_list_navigation' => __( 'Portfolios list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'text_domain' ),
		'description'           => __( 'Portfolios for users.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
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
		'capability_type'       => 'page',
	);
	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'portfolio_post_type', 0 );
// Query Custom Post Type
function query_portfolio_posts(){
	// WP_Query arguments
	$args = array (
		'post_type'              => array( 'portfolio' ),
		'post_status'            => array( 'publish' ),
		'posts_per_page'         => '12',
		'order'                  => 'DESC',
	);
	// The Query
	$query = new WP_Query( $args );
}
// Add Shortcode
function portfolio_shortcode( $atts ) {
	// Attributes
	extract( shortcode_atts(
		array(
			'count' => '6',
		), $atts )
	);
}
add_shortcode( 'get-portfolios', 'portfolio_shortcode' );

// Change Dash Icon
// https://developer.wordpress.org/resource/dashicons/#edit
function add_menu_icons_styles(){ ?>
	<style>#adminmenu .menu-icon-portfolio div.wp-menu-image:before { content: '\f133';}</style><?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );





