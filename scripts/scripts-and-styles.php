<?php  

// Proper way to enqueue scripts and styles
function add_scripts_and_styles() {
	wp_enqueue_style( 'google-styles','https://fonts.googleapis.com/icon?family=Material+Icons' );
	wp_enqueue_style( 'font-awesome-css','https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'bootstrap-min-css',get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'style-css',get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_script( 'jquery-script', get_template_directory_uri() . '/js/jquery.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'mdb-script', get_template_directory_uri() . '/js/mdb.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'add_scripts_and_styles' );

?>
