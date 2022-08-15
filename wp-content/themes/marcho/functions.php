<?php
// Version
if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

// Setup
if (! function_exists('prodev_setup')) {
    function prodev_setup() {
        load_theme_textdomain( 'prodev', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        // add_image_size( 'thumbnails_testimonial', 225, 231, true );
        // add_image_size( 'vertical_testimonial', 225, 332, true );
        // add_image_size( 'thumbnails_feature', 438, 455, true );
        // add_image_size('news-thumb', 733, 9999, false);

        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        add_theme_support(
            'custom-background',
            apply_filters(
                'custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );
    
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Support Custom Logo
        add_theme_support('custom-logo', [
            'height'      => 30,
			'width'       => 183,
			'flex-width'  => false,
			'flex-height' => false,
			'header-text' => '',
			'unlink-homepage-logo' => false, // WP 5.5
        ]);

        // WooCommerce Support Function
	    //add_theme_support( 'woocommerce' );
    }
}
add_action('after_setup_theme', 'prodev_setup');

// Enqueue scripts and styles.
function prodev_scripts() {
	wp_enqueue_style( 'prodev-style', get_stylesheet_uri(), array(), _S_VERSION );
	// Our Styles
	wp_enqueue_style( 'prodev-main', get_template_directory_uri() . '/assets/scss/style.scss', array(), _S_VERSION );

	//JQuery
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js' );
	wp_enqueue_script( 'jquery');
	// Our Scripts
	wp_enqueue_script( 'prodev-common', get_template_directory_uri() . '/assets/js/common.min.js', array(), _S_VERSION, true );
	// Scripts AJAX WooCommerce Filter
    /*
	wp_register_script( 'prodev-woo-filter', get_template_directory_uri() . '/assets/js/woo_filter.js', array( 'jquery' ), '', true );
    wp_localize_script( 'prodev-woo-filter', 'prodev_settings', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script( 'prodev-woo-filter' );
    */
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'prodev_scripts' );

/* ACF Options page in admin panel */
function prodev_acf_init() {
    if( function_exists('acf_add_options_page') ) {
        $option_page = acf_add_options_page(array(
            'page_title' 	=> esc_html__('Theme General Settings', 'prodev'),
            'menu_title' 	=> esc_html__('Theme Settings', 'prodev'),
            'menu_slug' 	=> 'theme-general-settings',
            'capability' 	=> 'edit_posts',
            'redirect' 	=> false
        ));
        acf_add_options_sub_page(array(
            'page_title' 	=> esc_html__('Footer Settings', 'prodev'),
            'menu_title'	=> esc_html__('Footer Settings', 'prodev'),
            'parent_slug'	=> 'theme-general-settings',
        ));
    }
}
add_action('acf/init', 'prodev_acf_init');

// Register menus
register_nav_menus(
	array(
		'menu-header' => esc_html__( 'Header navigation', 'prodev' ),
		'menu-footer' => esc_html__( 'Footer navigation', 'prodev' ),
		// 'menu-footer_2' => esc_html__( 'Footer services', 'prodev' ),
	)
);