<?php
/**
 * ac_tk functions and definitions
 *
 * @package ac_tk
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( 'ac_tk_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function ac_tk_setup() {
	global $cap, $content_width;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	*/
	function ac_tk_custom_background() {
	// $background is the saved custom image, or the default image.
		$background = set_url_scheme( get_background_image() );

		// $color is the saved custom color.
		// A default has to be specified in style.css. It will not be printed here.
		$color = get_background_color();

		if ( $color === get_theme_support( 'custom-background', 'default-color' ) ) {
			$color = false;
		}

		if ( ! $background && ! $color )
			return;

		$style = $color ? "background-color: #$color;" : '';

		if ( $background ) {
			$image = " background-image: url('$background');";
			$size = " background-size: cover;";
			$position = " background-position: center center;";

			$style .= $image . $size . $position ;
		}
	?>
	<style type="text/css" id="custom-background-css">
		body.custom-background .background-layer{ <?php echo trim( $style ); ?> }
		li.active a .icon-wrap,
		li:hover a .icon-wrap {
			border-color: #<?php echo trim( $color ); ?>;
			background-color: #<?php echo trim( $color ); ?>;
		}
		.tabbed-cont h6:after {
			border-left-color: #<?php echo trim( $color ); ?>;
		}
		.tabbed-cont svg path {
		    fill: #<?php echo trim( $color ); ?>;
		}
		a {
			color: #<?php echo trim( $color ); ?>;
		}
		.btn-primary {
			background-color: #<?php echo trim( $color ); ?>;
    		border-color: #<?php echo trim( $color ); ?>;
		}
		.default-post-listing h3 {
			border-top-color: #<?php echo trim( $color ); ?>;
		}
		.default-post-listing h3 i {
			color: #<?php echo trim( $color ); ?>;
		}
		.search-header {
			background: #<?php echo trim( $color ); ?>;
		}
		.the-map, .bordered {
			border-bottom-color: #<?php echo trim( $color ); ?>;
		}
		.copyright {
			background-color: #<?php echo trim( $color ); ?>;
		}
	</style>
	<?php
        };
	
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
		'default-image' => '',
		'wp-head-callback' => 'ac_tk_custom_background'
	) );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on ac_tk, use a find and replace
	 * to change 'ac_tk' to the name of your theme in all the template files
	*/
	load_theme_textdomain( 'ac_tk', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Main Site Menu', 'ac_tk' ),
	) );

	register_nav_menus( array(
		'secondary'  => __( 'Secondary Menu', 'ac_tk' ),
	) );

	register_nav_menus( array(
		'footer'  => __( 'Footer Menu', 'ac_tk' ),
	) );

}
endif; // ac_tk_setup
add_action( 'after_setup_theme', 'ac_tk_setup' );

/* custom post search template */

function custom_search($template)   
{    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == 'clima' )   
  {
    return locate_template('search-custom.php');  //  redirect to search-custom.php
  }   
  return $template;   
}
add_filter('template_include', 'custom_search');


/**
 * Register widgetized area and update sidebar with default widgets
 */
function ac_tk_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ac_tk' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer', 'ac_tk' ),
		'id'            => 'footer-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ac_tk_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function ac_tk_scripts() {

	// Import the necessary TK Bootstrap WP CSS additions
	wp_enqueue_style( 'ac_tk-bootstrap-wp', get_template_directory_uri() . '/includes/css/bootstrap-wp.css' );

	// load bootstrap css
	wp_enqueue_style( 'ac_tk-bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.min.css' );

	// load Font Awesome css
	wp_enqueue_style( 'ac_tk-font-awesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css', false, '4.1.0' );

	// load ac_tk styles
	wp_enqueue_style( 'ac_tk-style', get_stylesheet_uri() );

	// load bootstrap js
	wp_enqueue_script('ac_tk-bootstrapjs', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.min.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( 'ac_tk-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( 'ac_tk-scripts', get_template_directory_uri() . '/includes/js/scripts.js', array('jquery') );

	wp_enqueue_script( 'ac_tk-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'ac_tk-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', 'ac_tk_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';

/** Custom Post Types **/

add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		"name" => "projects",
		"singular_name" => "project",
		"menu_name" => "Proyectos",
		"all_items" => "Todos los proyectos",
		);

	$args = array(
		"labels" => $labels,
		"description" => "Post type proyectos",
		"public" => true,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "project", "with_front" => true ),
		"query_var" => true,
				
		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),		
	);
	register_post_type( "project", $args );

	$labels = array(
		"name" => "Climas",
		"singular_name" => "Clima",
		"menu_name" => "Climas",
		"all_items" => "Todos los climas",
		);

	$args = array(
		"labels" => $labels,
		"description" => "Post Climas",
		"public" => true,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "clima", "with_front" => false ),
		"query_var" => true,
				
		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),		
		"taxonomies" => array( "post_tag" )
	);
	register_post_type( "clima", $args );

	$labels = array(
		"name" => "Logos footer",
		"singular_name" => "Logo footer",
		"menu_name" => "Logos footer",
		"all_items" => "Todos los logos",
		);

	$args = array(
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "footerslider", "with_front" => true ),
		"query_var" => true,
				
		"supports" => array( "title", "thumbnail" ),		
	);
	register_post_type( "footerslider", $args );

// End of cptui_register_my_cpts()
}
/** Advanced Custom Fields **/

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_clima-fields',
		'title' => 'Clima Fields',
		'fields' => array (
			array (
				'key' => 'field_568d62222eda4',
				'label' => 'tab button 1',
				'name' => 'tab_button_1',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d62952eda6',
				'label' => 'tab button 2',
				'name' => 'tab_button_2',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d629b2eda7',
				'label' => 'tab button 3',
				'name' => 'tab_button_3',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d62a12eda8',
				'label' => 'tab button 4',
				'name' => 'tab_button_4',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d62a82eda9',
				'label' => 'Mapa',
				'name' => 'map_field',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d6e04ef87b',
				'label' => 'Visualizar',
				'name' => 'visualizar',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'http://',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_568d6e8fef87c',
				'label' => 'Meta Data',
				'name' => 'meta_data',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'http://',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_568d6c2eef87a',
				'label' => 'Descargar SHP',
				'name' => 'descargar_shp',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'http://',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_568d62d42edaa',
				'label' => 'Info Productor',
				'name' => 'info_productor',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d62e92edab',
				'label' => 'Youtube Video ID',
				'name' => 'cvideo',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'clima',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_pagina-principal',
		'title' => 'Pagina Principal',
		'fields' => array (
			array (
				'key' => 'field_568d502131265',
				'label' => 'tab button 1',
				'name' => 'tab_button_1',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d506531269',
				'label' => 'tab menu 1',
				'name' => 'tab_menu_1',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d50b63126d',
				'label' => 'tab content 1',
				'name' => 'tab_content_1',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d503c31266',
				'label' => 'tab button 2',
				'name' => 'tab_button_2',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d50863126a',
				'label' => 'tab menu 2',
				'name' => 'tab_menu_2',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d50cf3126e',
				'label' => 'tab content 2',
				'name' => 'tab_content_2',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d504631267',
				'label' => 'tab button 3',
				'name' => 'tab_button_3',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d50923126b',
				'label' => 'tab menu 3',
				'name' => 'tab_menu_3',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d50d53126f',
				'label' => 'tab content 3',
				'name' => 'tab_content_3',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d504d31268',
				'label' => 'tab button 4',
				'name' => 'tab_button_4',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d50993126c',
				'label' => 'tab menu 4',
				'name' => 'tab_menu_4',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d50e131270',
				'label' => 'tab content 4',
				'name' => 'tab_content_4',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'home.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_paises-disponibles',
		'title' => 'Paises Disponibles',
		'fields' => array (
			array (
				'key' => 'field_568d7662425d4',
				'label' => 'Paises',
				'name' => 'paises',
				'type' => 'checkbox',
				'choices' => array (
					'belice' => 'Belice',
					'costarica' => 'Costa Rica',
					'elsalvador' => 'El Salvador',
					'guatemala' => 'Guatemala',
					'honduras' => 'Honduras',
					'nicaragua' => 'Nicaragua',
					'panama' => 'Panama',
				),
				'default_value' => '',
				'layout' => 'vertical',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'clima',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_portal-home',
		'title' => 'Portal Home',
		'fields' => array (
			array (
				'key' => 'field_568d8ace77401',
				'label' => 'tab button 1',
				'name' => 'tab_button_1',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d8b2177402',
				'label' => 'tab button 2',
				'name' => 'tab_button_2',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d8b3c77403',
				'label' => 'tab button 3',
				'name' => 'tab_button_3',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_568d8b4077404',
				'label' => 'tab button 4',
				'name' => 'tab_button_4',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'home-secondary.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_video-posts',
		'title' => 'Video Posts',
		'fields' => array (
			array (
				'key' => 'field_568d8b7b788b6',
				'label' => 'Youtube Video ID',
				'name' => 'video_id',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_568d8bac788b7',
				'label' => 'Video Description',
				'name' => 'video_desc',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
