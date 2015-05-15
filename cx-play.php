<?php
/*
Plugin Name: CX Play
Plugin URI: http://www.ablewild.com
Description: Add custom post type for showing experiments.
Version: 1.1
Author: Pete Clark
Author URI: http://twitter.com/clarkcx
Licence: GPL2
*/

//////////////////////////////////////////////////////
///* CREATE CUSTOM POST TYPE: PLAY *///////////
//////////////////////////////////////////////////////

add_action('init', 'Play_register');
 
function Play_register() {
	$labels = array(
		'name' => _x('Play', 'post type general name'),
		'singular_name' => _x('Thing', 'post type singular name'),
		'add_new' => _x('Add New', 'Thing'),
		'add_new_item' => __('Add New Thing'),
		'edit_item' => __('Edit Thing'),
		'new_item' => __('New Thing'),
		'view_item' => __('View Thing'),
		'search_items' => __('Search Play'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/tiny_icon_play.png',
		'rewrite' => array("slug" => "play", 'with_front'=> false), // Permalinks format
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail'),
		'taxonomies' => array(''),
//		'register_meta_box_cb' => 'add_play_metaboxes',
		'has_archive' => true
	  ); 
 
	register_post_type( 'Play' , $args );
}

// This next thang creates a custom Taxonomy for us to use with the Play post type

function theme_init() {
	// create a new taxonomy
	register_taxonomy(
		'theme',
		'play',
		array(
			'hierarchical' => true,
			'label' => __( 'Theme' ),
			'rewrite' => array( 'slug' => 'theme' )
		)
	);
}
add_action( 'init', 'theme_init' );

function medium_init() {
	// create a new taxonomy
	register_taxonomy(
		'medium',
		'play',
		array(
			'hierarchical' => false,
			'label' => __( 'Medium' ),
			'rewrite' => array( 'slug' => 'medium' )
		)
	);
}
add_action( 'init', 'medium_init' );

// This next bit allows us to display the archive with a template file included in the plugin. Woot. 

add_filter('template_include', 'play_template');

function play_template( $template ) {
  if ( is_post_type_archive('play') ) {
    $theme_files = array('archive-play.php', 'cx_play/archive-play.php');
    $exists_in_theme = locate_template($theme_files, false);
    if ( $exists_in_theme != '' ) {
      return $exists_in_theme;
    } else {
      return plugin_dir_path(__FILE__) . 'archive-play.php';
    }
  }
  return $template;
}

?>