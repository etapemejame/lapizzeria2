<?php

//Link or Import the database.php file(this contains SQL structure)
require get_template_directory() . '/inc/database.php';

//Handles submission to the database
require get_template_directory() . '/inc/reservations.php';

//Creates option pages for the theme
require get_template_directory() . '/inc/options.php';

function lapizzeria1_setup() {
  add_theme_support('post-thumbnails');

  add_image_size( 'boxes', 437, 291, true );
  add_image_size( 'specialties', 768, 515, true);
  add_image_size( 'specialty-portrait', 435, 530, true);

  update_option('thumbnail_size_w', 253);
  update_option('thumbnail_size_h', 164);
}
add_action('after_setup_theme', 'lapizzeria1_setup');

function lapizzeria1_styles() {

  // Adding stylesheets
  wp_register_style( 'googlefont', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Raleway:400,700,900', array(), '1.0.0');
  wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '8.0.0' );
  wp_register_style('fluidboxcss', get_template_directory_uri() . '/css/fluidbox.min.css', array(), '' );
  wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0.0' );
  wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.7.0' );

// Enqueue the style
  wp_enqueue_style('fluidboxcss');
  wp_enqueue_style('normalize');
  wp_enqueue_style('fontawesome');
  wp_enqueue_style('googlefont');
  wp_enqueue_style('style');

$apikey = esc_html(get_option( 'lapizzeria1_gmap_apikey'));
wp_register_script( 'fluidboxjs', get_template_directory_uri() . '/js/jquery.fluidbox.min.js', array('jquery'), '1.0.0', true);
wp_register_script( 'googlemaps', 'https://maps.googleapis.com/maps/api/js?key='. $apikey .'&callback=initMap', array(), '', true);
wp_register_script( 'script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true);

//Add JavaScript to wordpress.

wp_enqueue_script('jquery');
wp_enqueue_script('fluidboxjs');
wp_enqueue_script('googlemaps');
wp_enqueue_script('script');

wp_localize_script(
    'script',
    'options',
    array(
      'latitude' => esc_html(get_option( 'lapizzeria1_gmap_latitude')),
      'longitude' => esc_html(get_option('lapizzeria1_gmap_longitude')),
    'zoom' => esc_html(get_option('lapizzeria1_gmap_zoom'))
  )
);

}
add_action('wp_enqueue_scripts', 'lapizzeria1_styles');

// Add menus

function lapizzeria1_menus(){

  register_nav_menus(array(

    'header-menu' => __('Header Menu', 'lapizzeria1'),
    'social-menu' => __( 'Social Menu', 'lapizzeria1')
  ) );
}
add_action( 'init', 'lapizzeria1_menus' );


function lapizzeria1_specialties() {
	$labels = array(
		'name'               => _x( 'Pizzas', 'lapizzeria1' ),
		'singular_name'      => _x( 'Pizza', 'post type singular name', 'lapizzeria1' ),
		'menu_name'          => _x( 'Pizzas', 'admin menu', 'lapizzeria1' ),
		'name_admin_bar'     => _x( 'Pizzas', 'add new on admin bar', 'lapizzeria1' ),
		'add_new'            => _x( 'Add New', 'book', 'lapizzeria1' ),
		'add_new_item'       => __( 'Add New Pizza', 'lapizzeria1' ),
		'new_item'           => __( 'New Pizzas', 'lapizzeria1' ),
		'edit_item'          => __( 'Edit Pizzas', 'lapizzeria1' ),
		'view_item'          => __( 'View Pizzas', 'lapizzeria1' ),
		'all_items'          => __( 'All Pizzas', 'lapizzeria1' ),
		'search_items'       => __( 'Search Pizzas', 'lapizzeria1' ),
		'parent_item_colon'  => __( 'Parent Pizzas:', 'lapizzeria1' ),
		'not_found'          => __( 'No Pizzas found.', 'lapizzeria1' ),
		'not_found_in_trash' => __( 'No Pizzas found in Trash.', 'lapizzeria1' )
	);

	$args = array(
		'labels'             => $labels,
    'description'        => __( 'Description.', 'lapizzeria1' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'specialties' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
    'taxonomies'          => array( 'category' ),
	);

	register_post_type( 'specialties', $args );
}

add_action( 'init', 'lapizzeria1_specialties' );

//Widget Zone

function lapizzeria1_widgets() {
  register_sidebar(array(
    'name' => 'Blog Sidebar',
    'id' => 'blog_sidebar',
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ) );

}
add_action( 'widgets_init', 'lapizzeria1_widgets' );

function add_async_defer($tag, $handle){
  if ('googlemaps' !== $handle) {
    return $tag;
  }
  return str_replace('src', 'async="async" defer="defer" src', $tag);
}
add_filter('script_loader_tag', 'add_async_defer', 10, 2);
