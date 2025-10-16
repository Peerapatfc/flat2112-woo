<?php
/**
 * Flat2112 Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function flat2112_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'flat2112'),
    ));
}
add_action('after_setup_theme', 'flat2112_setup');

/**
 * Enqueue scripts and styles
 */
function flat2112_scripts() {
    wp_enqueue_style('flat2112-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Add custom fonts
    wp_enqueue_style('flat2112-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    
    // Enqueue JavaScript if needed
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'flat2112_scripts');

/**
 * Register widget areas
 */
function flat2112_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'flat2112'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'flat2112'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'flat2112_widgets_init');

/**
 * Custom excerpt length
 */
function flat2112_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'flat2112_excerpt_length');

/**
 * Custom excerpt more
 */
function flat2112_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'flat2112_excerpt_more');

/**
 * Add custom CSS for admin
 */
function flat2112_admin_style() {
    echo '<style>
        .login h1 a {
            background-image: none !important;
            background-color: #667eea;
            color: white;
            text-decoration: none;
            width: auto !important;
            height: auto !important;
            padding: 20px;
            border-radius: 5px;
        }
        .login h1 a:before {
            content: "Flat2112";
            font-size: 24px;
            font-weight: bold;
        }
    </style>';
}
add_action('login_head', 'flat2112_admin_style');

/**
 * Customize login page
 */
function flat2112_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'flat2112_login_logo_url');

function flat2112_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertitle', 'flat2112_login_logo_url_title');

/**
 * Add custom dashboard widget
 */
function flat2112_dashboard_widget() {
    echo '<div style="padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 5px; margin-bottom: 20px;">';
    echo '<h3 style="margin-top: 0; color: white;">Welcome to Flat2112!</h3>';
    echo '<p>Your WordPress site is successfully deployed on Render. Start creating amazing content!</p>';
    echo '<p><strong>Quick Tips:</strong></p>';
    echo '<ul>';
    echo '<li>Create your first post to see the theme in action</li>';
    echo '<li>Customize your site in Appearance → Customize</li>';
    echo '<li>Add widgets to the sidebar in Appearance → Widgets</li>';
    echo '</ul>';
    echo '</div>';
}

function flat2112_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'flat2112_dashboard_widget',
        'Flat2112 Welcome',
        'flat2112_dashboard_widget'
    );
}
add_action('wp_dashboard_setup', 'flat2112_add_dashboard_widget');

/**
 * Security enhancements
 */
// Remove WordPress version from head
remove_action('wp_head', 'wp_generator');

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Remove unnecessary head links
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

/**
 * Performance optimizations
 */
// Remove emoji scripts
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Disable embeds
function flat2112_disable_embeds() {
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'flat2112_disable_embeds');

/**
 * Custom post types (example)
 */
function flat2112_custom_post_types() {
    // You can add custom post types here if needed
    // Example: Portfolio, Testimonials, etc.
}
add_action('init', 'flat2112_custom_post_types');