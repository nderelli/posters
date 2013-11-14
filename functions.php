<?

// Define own Jquery file and enqueue in footer
function klas_scripts_init() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js','','',true);
    wp_enqueue_script( 'jquery' );
}

add_action('wp_enqueue_scripts', 'klas_scripts_init');

// Add custom navigation to theme and adds Primary Navigation menu
function klas_menus_init() {
	register_nav_menus(
		array(
				'primary-header-menu' => __( 'Primary Header Menu' )
			)
	);
	wp_create_nav_menu( 'Primary Navigation', array( 'slug' => 'primary-nav' ) );
}
add_action( 'init', 'klas_menus_init' );
add_action( 'init', 'create_post_types');

function create_post_types() {

	$posterLabels = array( 
        'name' => __( 'Posters', 'poster' ),
        'singular_name' => __( 'Poster', 'poster' ),
        'add_new' => __( 'Add New', 'poster' ),
        'add_new_item' => __( 'Add New Poster', 'poster' ),
        'edit_item' => __( 'Edit Poster', 'poster' ),
        'new_item' => __( 'New Poster', 'poster' ),
        'view_item' => __( 'View Poster', 'poster' ),
        'search_items' => __( 'Search Posters', 'poster' ),
        'not_found' => __( 'No posters found', 'poster' ),
        'not_found_in_trash' => __( 'No posters found in Trash', 'poster' ),
        'parent_item_colon' => __( 'Parent Poster:', 'poster' ),
        'menu_name' => __( 'Posters', 'poster' ),
    );

    $clockLabels = array( 
        'name' => __( 'Clocks', 'clock' ),
        'singular_name' => __( 'Clock', 'clock' ),
        'add_new' => __( 'Add New', 'clock' ),
        'add_new_item' => __( 'Add New Clock', 'clock' ),
        'edit_item' => __( 'Edit Clock', 'clock' ),
        'new_item' => __( 'New Clock', 'clock' ),
        'view_item' => __( 'View Clock', 'clock' ),
        'search_items' => __( 'Search Clocks', 'clock' ),
        'not_found' => __( 'No clocks found', 'clock' ),
        'not_found_in_trash' => __( 'No clocks found in Trash', 'clock' ),
        'parent_item_colon' => __( 'Parent Clock:', 'clock' ),
        'menu_name' => __( 'Clocks', 'clock' ),
    );

    $posterArgs = array( 
        'labels' => $posterLabels,
        'hierarchical' => false,
        'description' => 'Posters that will be featured at the show.',
        'supports' => array( 'title', 'editor' ),
        'taxonomies' => array( 'category', 'live_auction', 'silent_auction' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'posters'),
        );

    $clockArgs = array(
		'labels' => $clockLabels,
		'hierarchical' => false,
		'description' => 'Clocks designed and produced by the Senior Class.',
		'public' => true,
		'rewrite' => array('slug' => 'clocks'),
		'show_ui' => true,
        'show_in_menu' => true,      
        'show_in_nav_menus' => true,
        'has_archive' => true,
		);


	register_post_type( 'poster', $posterArgs );
	register_post_type( 'clock', $clockArgs );
}

// Registers Editor Styles
add_editor_style( 'css/editor-style.css' );

// Remove theme/plugin editor
define( 'DISALLOW_FILE_EDIT', true );

// Add custom logo to Wordpress Login page(s). Logo should be no bigger than 323 pixels wide by 67 pixels high
function klas_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background: url('<?php bloginfo( 'template_directory' ) ?>/img/wp-login-logo-klas.png') no-repeat 0 0;
			margin: 0 0 0 23px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'klas_login_logo' );

// Register theme support for post thumbnails/featured images + example
add_theme_support( 'post-thumbnails' );
//add_image_size( $name, $width, $height, $hard_crop[boolean] );


// remove <p></p> around posts
remove_filter( 'the_content', 'wpautop' );
?>
