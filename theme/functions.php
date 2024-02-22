<?php
/**
 * SEED3 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SEED3
 */

if (!defined('SEED_VERSION')) {
    /*
     * Set the theme’s version number.
     *
     * This is used primarily for cache busting. If you use `npm run bundle`
     * to create your production build, the value below will be replaced in the
     * generated zip file with a timestamp, converted to base 36.
     */
    define('SEED_VERSION', '0.1.0');
}

if (!defined('SEED_TYPOGRAPHY_CLASSES')) {
    /*
     * Set Tailwind Typography classes for the front end, block editor and
     * classic editor using the constant below.
     *
     * For the front end, these classes are added by the `seed_content_class`
     * function. You will see that function used everywhere an `entry-content`
     * or `page-content` class has been added to a wrapper element.
     *
     * For the block editor, these classes are converted to a JavaScript array
     * and then used by the `./javascript/block-editor.js` file, which adds
     * them to the appropriate elements in the block editor (and adds them
     * again when they’re removed.)
     *
     * For the classic editor (and anything using TinyMCE, like Advanced Custom
     * Fields), these classes are added to TinyMCE’s body class when it
     * initializes.
     */
    define(
        'SEED_TYPOGRAPHY_CLASSES',
        'prose prose-neutral max-w-none prose-a:text-primary'
    );
}

if (!function_exists('seed_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function seed_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on SEED3, use a find and replace
         * to change 'seed3' to the name of your theme in all the template files.
         */
        load_theme_textdomain('seed3', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            array(
                'menu-1' => __('Primary', 'seed3'),
                'menu-2' => __('Footer Menu', 'seed3'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
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

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Enqueue editor styles.
        add_editor_style('style-editor.css');
        add_editor_style('style-editor-extra.css');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        add_theme_support('custom-spacing');

        // Remove support for block templates.
        remove_theme_support('block-templates');
    }
endif;
add_action('after_setup_theme', 'seed_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function seed_widgets_init()
{
    register_sidebar(
        array(
            'name'          => __('Footer', 'seed3'),
            'id'            => 'sidebar-1',
            'description'   => __('Add widgets here to appear in your footer.', 'seed3'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'seed_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function seed_scripts()
{
    wp_enqueue_style('seed3-style', get_stylesheet_uri(), array(), SEED_VERSION);
    wp_enqueue_script('seed3-script', get_template_directory_uri() . '/js/script.min.js', array(), SEED_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'seed_scripts');

/**
 * Enqueue the block editor script.
 */
function seed_enqueue_block_editor_script()
{
    wp_enqueue_script(
        'seed3-editor',
        get_template_directory_uri() . '/js/block-editor.min.js',
        array(
            'wp-blocks',
            'wp-edit-post',
        ),
        SEED_VERSION,
        true
    );
}
add_action('enqueue_block_editor_assets', 'seed_enqueue_block_editor_script');

/**
 * Enqueue the script necessary to support Tailwind Typography in the block
 * editor, using an inline script to create a JavaScript array containing the
 * Tailwind Typography classes from SEED_TYPOGRAPHY_CLASSES.
 */
function seed_enqueue_typography_script()
{
    if (is_admin()) {
        wp_enqueue_script(
            'seed3-typography',
            get_template_directory_uri() . '/js/tailwind-typography-classes.min.js',
            array(
                'wp-blocks',
                'wp-edit-post',
            ),
            SEED_VERSION,
            true
        );
        wp_add_inline_script('seed3-typography', "tailwindTypographyClasses = '" . esc_attr(SEED_TYPOGRAPHY_CLASSES) . "'.split(' ');", 'before');
    }
}
add_action('enqueue_block_assets', 'seed_enqueue_typography_script');

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function seed_tinymce_add_class($settings)
{
    $settings['body_class'] = SEED_TYPOGRAPHY_CLASSES;
    return $settings;
}
add_filter('tiny_mce_before_init', 'seed_tinymce_add_class');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Hide admin bar
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Auto create home page
 */
add_action('after_switch_theme', 'seed_create_home_page');
function seed_create_home_page()
{
    if (get_option('page_on_front') != '0') {
        exit;
    }
    $qr_slug = get_posts(['post_type' => 'page', 'name' => 'home', 'post_status' => 'all']);
    if (!$qr_slug) {
        $qr_title = get_posts(['post_type' => 'page', 'title' => 'Home', 'post_status' => 'all']);
        if (!$qr_title) {
            $content = '<!-- wp:group {"className":"text-center","layout":{"type":"constrained"}} -->
            <div class="wp-block-group text-center"><!-- wp:spacer {"height":"60px"} -->
            <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->
            
            <!-- wp:heading {"level":1,"className":"is-style-lead"} -->
            <h1 class="wp-block-heading is-style-lead">SEED 3 THEME</h1>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph -->
            <p>WordPress starter theme optimized for modern development<br>with Tailwind CSS, Tailwind Typography and the WordPress editor. <br>Created by <a href="https://seedwebs.com/" target="_blank" rel="noreferrer noopener">Seed Webs</a>, built on <a href="https://underscoretw.com/" target="_blank" rel="noreferrer noopener">_tw</a></p>
            <!-- /wp:paragraph -->
            
            <!-- wp:paragraph -->
            <p>This website is coming soon.</p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:group -->';
            $homepage = array(
                'post_title'   => 'Home',
                'post_content' => $content,
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_type'    => 'page',
            );
            $homepage_id = wp_insert_post($homepage);
            update_option('show_on_front', 'page');
            update_option('page_on_front', $homepage_id);
        }
    }
}
