<?php
/**
 * Twenty Twenty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Twenty 1.0
 */

if (!function_exists('post_exists')) {
    require_once ABSPATH . 'wp-admin/includes/post.php';
}
function twentytwenty_theme_support()
{

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Custom background color.
    add_theme_support(
        'custom-background',
        array(
            'default-color' => 'f5efe0',
        )
    );

    // Set content-width.
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 580;
    }

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // Set post thumbnail size.
    set_post_thumbnail_size(1200, 9999);

    // Add custom image size used in Cover Template.
    add_image_size('twentytwenty-fullscreen', 1980, 9999);

    // Custom logo.
    $logo_width = 120;
    $logo_height = 90;

    // If the retina setting is active, double the recommended width and height.
    if (get_theme_mod('retina_logo', false)) {
        $logo_width = floor($logo_width * 2);
        $logo_height = floor($logo_height * 2);
    }

    add_theme_support(
        'custom-logo',
        array(
            'height' => $logo_height,
            'width' => $logo_width,
            'flex-height' => true,
            'flex-width' => true,
        )
    );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

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
            'script',
            'style',
            'navigation-widgets',
        )
    );

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Twenty Twenty, use a find and replace
     * to change 'twentytwenty' to the name of your theme in all the template files.
     */
    load_theme_textdomain('twentytwenty');

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    /*
     * Adds starter content to highlight the theme on fresh sites.
     * This is done conditionally to avoid loading the starter content on every
     * page load, as it is a one-off operation only needed once in the customizer.
     */
    if (is_customize_preview()) {
        require get_template_directory() . '/inc/starter-content.php';
        add_theme_support('starter-content', twentytwenty_get_starter_content());
    }

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /*
     * Adds `async` and `defer` support for scripts registered or enqueued
     * by the theme.
     */
    $loader = new TwentyTwenty_Script_Loader();
    add_filter('script_loader_tag', array($loader, 'filter_script_loader_tag'), 10, 2);

}

add_action('after_setup_theme', 'twentytwenty_theme_support');

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-twentytwenty-customize.php';

// Require Separator Control class.
require get_template_directory() . '/classes/class-twentytwenty-separator-control.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-twentytwenty-script-loader.php';

// Non-latin language handling.
require get_template_directory() . '/classes/class-twentytwenty-non-latin-languages.php';

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Register and Enqueue Styles.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_register_styles()
{

    $theme_version = wp_get_theme()->get('Version');

    wp_enqueue_style('twentytwenty-style', get_stylesheet_uri(), array(), $theme_version);
    wp_style_add_data('twentytwenty-style', 'rtl', 'replace');

    // Add output of Customizer settings as inline style.
    wp_add_inline_style('twentytwenty-style', twentytwenty_get_customizer_css('front-end'));

    // Add print CSS.
    wp_enqueue_style('twentytwenty-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print');

}

add_action('wp_enqueue_scripts', 'twentytwenty_register_styles');

/**
 * Register and Enqueue Scripts.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_register_scripts()
{

    $theme_version = wp_get_theme()->get('Version');

    if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('twentytwenty-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false);
    wp_script_add_data('twentytwenty-js', 'async', true);

}

add_action('wp_enqueue_scripts', 'twentytwenty_register_scripts');

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty 1.0
 *
 * @link https://git.io/vWdr2
 */
function twentytwenty_skip_link_focus_fix()
{
    // The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
    ?>
<script>
/(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window
    .addEventListener("hashchange", function() {
        var t, e = location.hash.substring(1);
        /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i
            .test(t.tagName) || (t.tabIndex = -1), t.focus())
    }, !1);
</script>
<?php
}
add_action('wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix');

/**
 * Enqueue non-latin language styles.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_non_latin_languages()
{
    $custom_css = TwentyTwenty_Non_Latin_Languages::get_non_latin_css('front-end');

    if ($custom_css) {
        wp_add_inline_style('twentytwenty-style', $custom_css);
    }
}

add_action('wp_enqueue_scripts', 'twentytwenty_non_latin_languages');

/**
 * Register navigation menus uses wp_nav_menu in five places.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_menus()
{

    $locations = array(
        'primary' => __('Desktop Horizontal Menu', 'twentytwenty'),
        'expanded' => __('Desktop Expanded Menu', 'twentytwenty'),
        'mobile' => __('Mobile Menu', 'twentytwenty'),
        'footer' => __('Footer Menu', 'twentytwenty'),
        'social' => __('Social Menu', 'twentytwenty'),
    );

    register_nav_menus($locations);
}

add_action('init', 'twentytwenty_menus');

/**
 * Get the information about the logo.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 * @return string
 */
function twentytwenty_get_custom_logo($html)
{

    $logo_id = get_theme_mod('custom_logo');

    if (!$logo_id) {
        return $html;
    }

    $logo = wp_get_attachment_image_src($logo_id, 'full');

    if ($logo) {
        // For clarity.
        $logo_width = esc_attr($logo[1]);
        $logo_height = esc_attr($logo[2]);

        // If the retina logo setting is active, reduce the width/height by half.
        if (get_theme_mod('retina_logo', false)) {
            $logo_width = floor($logo_width / 2);
            $logo_height = floor($logo_height / 2);

            $search = array(
                '/width=\"\d+\"/iU',
                '/height=\"\d+\"/iU',
            );

            $replace = array(
                "width=\"{$logo_width}\"",
                "height=\"{$logo_height}\"",
            );

            // Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
            if (strpos($html, ' style=') === false) {
                $search[] = '/(src=)/';
                $replace[] = "style=\"height: {$logo_height}px;\" src=";
            } else {
                $search[] = '/(style="[^"]*)/';
                $replace[] = "$1 height: {$logo_height}px;";
            }

            $html = preg_replace($search, $replace, $html);

        }
    }

    return $html;

}

add_filter('get_custom_logo', 'twentytwenty_get_custom_logo');

if (!function_exists('wp_body_open')) {

    /**
     * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
     *
     * @since Twenty Twenty 1.0
     */
    function wp_body_open()
    {
        /** This action is documented in wp-includes/general-template.php */
        do_action('wp_body_open');
    }
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_skip_link()
{
    echo '<a class="skip-link screen-reader-text" href="#site-content">' . __('Skip to the content', 'twentytwenty') . '</a>';
}

add_action('wp_body_open', 'twentytwenty_skip_link', 5);

/**
 * Register widget areas.
 *
 * @since Twenty Twenty 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentytwenty_sidebar_registration()
{

    // Arguments used in all register_sidebar() calls.
    $shared_args = array(
        'before_title' => '<h2 class="widget-title subheading heading-size-3">',
        'after_title' => '</h2>',
        'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
        'after_widget' => '</div></div>',
    );

    // Footer #1.
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name' => __('Footer #1', 'twentytwenty'),
                'id' => 'sidebar-1',
                'description' => __('Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty'),
            )
        )
    );

    // Footer #2.
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name' => __('Footer #2', 'twentytwenty'),
                'id' => 'sidebar-2',
                'description' => __('Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty'),
            )
        )
    );

}

add_action('widgets_init', 'twentytwenty_sidebar_registration');

/**
 * Enqueue supplemental block editor styles.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_block_editor_styles()
{

    // Enqueue the editor styles.
    wp_enqueue_style('twentytwenty-block-editor-styles', get_theme_file_uri('/assets/css/editor-style-block.css'), array(), wp_get_theme()->get('Version'), 'all');
    wp_style_add_data('twentytwenty-block-editor-styles', 'rtl', 'replace');

    // Add inline style from the Customizer.
    wp_add_inline_style('twentytwenty-block-editor-styles', twentytwenty_get_customizer_css('block-editor'));

    // Add inline style for non-latin fonts.
    wp_add_inline_style('twentytwenty-block-editor-styles', TwentyTwenty_Non_Latin_Languages::get_non_latin_css('block-editor'));

    // Enqueue the editor script.
    wp_enqueue_script('twentytwenty-block-editor-script', get_theme_file_uri('/assets/js/editor-script-block.js'), array('wp-blocks', 'wp-dom'), wp_get_theme()->get('Version'), true);
}

add_action('enqueue_block_editor_assets', 'twentytwenty_block_editor_styles', 1, 1);

/**
 * Enqueue classic editor styles.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_classic_editor_styles()
{

    $classic_editor_styles = array(
        '/assets/css/editor-style-classic.css',
    );

    add_editor_style($classic_editor_styles);

}

add_action('init', 'twentytwenty_classic_editor_styles');

/**
 * Output Customizer settings in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @since Twenty Twenty 1.0
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_customizer_styles($mce_init)
{

    $styles = twentytwenty_get_customizer_css('classic-editor');

    if (!isset($mce_init['content_style'])) {
        $mce_init['content_style'] = $styles . ' ';
    } else {
        $mce_init['content_style'] .= ' ' . $styles . ' ';
    }

    return $mce_init;

}

add_filter('tiny_mce_before_init', 'twentytwenty_add_classic_editor_customizer_styles');

/**
 * Output non-latin font styles in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_non_latin_styles($mce_init)
{

    $styles = TwentyTwenty_Non_Latin_Languages::get_non_latin_css('classic-editor');

    // Return if there are no styles to add.
    if (!$styles) {
        return $mce_init;
    }

    if (!isset($mce_init['content_style'])) {
        $mce_init['content_style'] = $styles . ' ';
    } else {
        $mce_init['content_style'] .= ' ' . $styles . ' ';
    }

    return $mce_init;

}

add_filter('tiny_mce_before_init', 'twentytwenty_add_classic_editor_non_latin_styles');

/**
 * Block Editor Settings.
 * Add custom colors and font sizes to the block editor.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_block_editor_settings()
{

    // Block Editor Palette.
    $editor_color_palette = array(
        array(
            'name' => __('Accent Color', 'twentytwenty'),
            'slug' => 'accent',
            'color' => twentytwenty_get_color_for_area('content', 'accent'),
        ),
        array(
            'name' => _x('Primary', 'color', 'twentytwenty'),
            'slug' => 'primary',
            'color' => twentytwenty_get_color_for_area('content', 'text'),
        ),
        array(
            'name' => _x('Secondary', 'color', 'twentytwenty'),
            'slug' => 'secondary',
            'color' => twentytwenty_get_color_for_area('content', 'secondary'),
        ),
        array(
            'name' => __('Subtle Background', 'twentytwenty'),
            'slug' => 'subtle-background',
            'color' => twentytwenty_get_color_for_area('content', 'borders'),
        ),
    );

    // Add the background option.
    $background_color = get_theme_mod('background_color');
    if (!$background_color) {
        $background_color_arr = get_theme_support('custom-background');
        $background_color = $background_color_arr[0]['default-color'];
    }
    $editor_color_palette[] = array(
        'name' => __('Background Color', 'twentytwenty'),
        'slug' => 'background',
        'color' => '#' . $background_color,
    );

    // If we have accent colors, add them to the block editor palette.
    if ($editor_color_palette) {
        add_theme_support('editor-color-palette', $editor_color_palette);
    }

    // Block Editor Font Sizes.
    add_theme_support(
        'editor-font-sizes',
        array(
            array(
                'name' => _x('Small', 'Name of the small font size in the block editor', 'twentytwenty'),
                'shortName' => _x('S', 'Short name of the small font size in the block editor.', 'twentytwenty'),
                'size' => 18,
                'slug' => 'small',
            ),
            array(
                'name' => _x('Regular', 'Name of the regular font size in the block editor', 'twentytwenty'),
                'shortName' => _x('M', 'Short name of the regular font size in the block editor.', 'twentytwenty'),
                'size' => 21,
                'slug' => 'normal',
            ),
            array(
                'name' => _x('Large', 'Name of the large font size in the block editor', 'twentytwenty'),
                'shortName' => _x('L', 'Short name of the large font size in the block editor.', 'twentytwenty'),
                'size' => 26.25,
                'slug' => 'large',
            ),
            array(
                'name' => _x('Larger', 'Name of the larger font size in the block editor', 'twentytwenty'),
                'shortName' => _x('XL', 'Short name of the larger font size in the block editor.', 'twentytwenty'),
                'size' => 32,
                'slug' => 'larger',
            ),
        )
    );

    add_theme_support('editor-styles');

    // If we have a dark background color then add support for dark editor style.
    // We can determine if the background color is dark by checking if the text-color is white.
    if ('#ffffff' === strtolower(twentytwenty_get_color_for_area('content', 'text'))) {
        add_theme_support('dark-editor-style');
    }

}

add_action('after_setup_theme', 'twentytwenty_block_editor_settings');

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 * @return string
 */
function twentytwenty_read_more_tag($html)
{
    return preg_replace('/<a(.*)>(.*)<\/a>/iU', sprintf('<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title(get_the_ID())), $html);
}

add_filter('the_content_more_link', 'twentytwenty_read_more_tag');

/**
 * Enqueues scripts for customizer controls & settings.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_controls_enqueue_scripts()
{
    $theme_version = wp_get_theme()->get('Version');

    // Add main customizer js file.
    wp_enqueue_script('twentytwenty-customize', get_template_directory_uri() . '/assets/js/customize.js', array('jquery'), $theme_version, false);

    // Add script for color calculations.
    wp_enqueue_script('twentytwenty-color-calculations', get_template_directory_uri() . '/assets/js/color-calculations.js', array('wp-color-picker'), $theme_version, false);

    // Add script for controls.
    wp_enqueue_script('twentytwenty-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array('twentytwenty-color-calculations', 'customize-controls', 'underscore', 'jquery'), $theme_version, false);
    wp_localize_script('twentytwenty-customize-controls', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars());
}

add_action('customize_controls_enqueue_scripts', 'twentytwenty_customize_controls_enqueue_scripts');

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_preview_init()
{
    $theme_version = wp_get_theme()->get('Version');

    wp_enqueue_script('twentytwenty-customize-preview', get_theme_file_uri('/assets/js/customize-preview.js'), array('customize-preview', 'customize-selective-refresh', 'jquery'), $theme_version, true);
    wp_localize_script('twentytwenty-customize-preview', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars());
    wp_localize_script('twentytwenty-customize-preview', 'twentyTwentyPreviewEls', twentytwenty_get_elements_array());

    wp_add_inline_script(
        'twentytwenty-customize-preview',
        sprintf(
            'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
            wp_json_encode('cover_opacity'),
            wp_json_encode(twentytwenty_customize_opacity_range())
        )
    );
}

add_action('customize_preview_init', 'twentytwenty_customize_preview_init');

/**
 * Get accessible color for an area.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $area    The area we want to get the colors for.
 * @param string $context Can be 'text' or 'accent'.
 * @return string Returns a HEX color.
 */
function twentytwenty_get_color_for_area($area = 'content', $context = 'text')
{

    // Get the value from the theme-mod.
    $settings = get_theme_mod(
        'accent_accessible_colors',
        array(
            'content' => array(
                'text' => '#000000',
                'accent' => '#cd2653',
                'secondary' => '#6d6d6d',
                'borders' => '#dcd7ca',
            ),
            'header-footer' => array(
                'text' => '#000000',
                'accent' => '#cd2653',
                'secondary' => '#6d6d6d',
                'borders' => '#dcd7ca',
            ),
        )
    );

    // If we have a value return it.
    if (isset($settings[$area]) && isset($settings[$area][$context])) {
        return $settings[$area][$context];
    }

    // Return false if the option doesn't exist.
    return false;
}

/**
 * Returns an array of variables for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_customizer_color_vars()
{
    $colors = array(
        'content' => array(
            'setting' => 'background_color',
        ),
        'header-footer' => array(
            'setting' => 'header_footer_background_color',
        ),
    );
    return $colors;
}

/**
 * Get an array of elements.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_elements_array()
{

    // The array is formatted like this:
    // [key-in-saved-setting][sub-key-in-setting][css-property] = [elements].
    $elements = array(
        'content' => array(
            'accent' => array(
                'color' => array('.color-accent', '.color-accent-hover:hover', '.color-accent-hover:focus', ':root .has-accent-color', '.has-drop-cap:not(:focus):first-letter', '.wp-block-button.is-style-outline', 'a'),
                'border-color' => array('blockquote', '.border-color-accent', '.border-color-accent-hover:hover', '.border-color-accent-hover:focus'),
                'background-color' => array('button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file .wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.bg-accent', '.bg-accent-hover:hover', '.bg-accent-hover:focus', ':root .has-accent-background-color', '.comment-reply-link'),
                'fill' => array('.fill-children-accent', '.fill-children-accent *'),
            ),
            'background' => array(
                'color' => array(':root .has-background-color', 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.wp-block-button', '.comment-reply-link', '.has-background.has-primary-background-color:not(.has-text-color)', '.has-background.has-primary-background-color *:not(.has-text-color)', '.has-background.has-accent-background-color:not(.has-text-color)', '.has-background.has-accent-background-color *:not(.has-text-color)'),
                'background-color' => array(':root .has-background-background-color'),
            ),
            'text' => array(
                'color' => array('body', '.entry-title a', ':root .has-primary-color'),
                'background-color' => array(':root .has-primary-background-color'),
            ),
            'secondary' => array(
                'color' => array('cite', 'figcaption', '.wp-caption-text', '.post-meta', '.entry-content .wp-block-archives li', '.entry-content .wp-block-categories li', '.entry-content .wp-block-latest-posts li', '.wp-block-latest-comments__comment-date', '.wp-block-latest-posts__post-date', '.wp-block-embed figcaption', '.wp-block-image figcaption', '.wp-block-pullquote cite', '.comment-metadata', '.comment-respond .comment-notes', '.comment-respond .logged-in-as', '.pagination .dots', '.entry-content hr:not(.has-background)', 'hr.styled-separator', ':root .has-secondary-color'),
                'background-color' => array(':root .has-secondary-background-color'),
            ),
            'borders' => array(
                'border-color' => array('pre', 'fieldset', 'input', 'textarea', 'table', 'table *', 'hr'),
                'background-color' => array('caption', 'code', 'code', 'kbd', 'samp', '.wp-block-table.is-style-stripes tbody tr:nth-child(odd)', ':root .has-subtle-background-background-color'),
                'border-bottom-color' => array('.wp-block-table.is-style-stripes'),
                'border-top-color' => array('.wp-block-latest-posts.is-grid li'),
                'color' => array(':root .has-subtle-background-color'),
            ),
        ),
        'header-footer' => array(
            'accent' => array(
                'color' => array('body:not(.overlay-header) .primary-menu > li > a', 'body:not(.overlay-header) .primary-menu > li > .icon', '.modal-menu a', '.footer-menu a, .footer-widgets a', '#site-footer .wp-block-button.is-style-outline', '.wp-block-pullquote:before', '.singular:not(.overlay-header) .entry-header a', '.archive-header a', '.header-footer-group .color-accent', '.header-footer-group .color-accent-hover:hover'),
                'background-color' => array('.social-icons a', '#site-footer button:not(.toggle)', '#site-footer .button', '#site-footer .faux-button', '#site-footer .wp-block-button__link', '#site-footer .wp-block-file__button', '#site-footer input[type="button"]', '#site-footer input[type="reset"]', '#site-footer input[type="submit"]'),
            ),
            'background' => array(
                'color' => array('.social-icons a', 'body:not(.overlay-header) .primary-menu ul', '.header-footer-group button', '.header-footer-group .button', '.header-footer-group .faux-button', '.header-footer-group .wp-block-button:not(.is-style-outline) .wp-block-button__link', '.header-footer-group .wp-block-file__button', '.header-footer-group input[type="button"]', '.header-footer-group input[type="reset"]', '.header-footer-group input[type="submit"]'),
                'background-color' => array('#site-header', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal', '.menu-modal-inner', '.search-modal-inner', '.archive-header', '.singular .entry-header', '.singular .featured-media:before', '.wp-block-pullquote:before'),
            ),
            'text' => array(
                'color' => array('.header-footer-group', 'body:not(.overlay-header) #site-header .toggle', '.menu-modal .toggle'),
                'background-color' => array('body:not(.overlay-header) .primary-menu ul'),
                'border-bottom-color' => array('body:not(.overlay-header) .primary-menu > li > ul:after'),
                'border-left-color' => array('body:not(.overlay-header) .primary-menu ul ul:after'),
            ),
            'secondary' => array(
                'color' => array('.site-description', 'body:not(.overlay-header) .toggle-inner .toggle-text', '.widget .post-date', '.widget .rss-date', '.widget_archive li', '.widget_categories li', '.widget cite', '.widget_pages li', '.widget_meta li', '.widget_nav_menu li', '.powered-by-wordpress', '.to-the-top', '.singular .entry-header .post-meta', '.singular:not(.overlay-header) .entry-header .post-meta a'),
            ),
            'borders' => array(
                'border-color' => array('.header-footer-group pre', '.header-footer-group fieldset', '.header-footer-group input', '.header-footer-group textarea', '.header-footer-group table', '.header-footer-group table *', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal nav *', '.footer-widgets-outer-wrapper', '.footer-top'),
                'background-color' => array('.header-footer-group table caption', 'body:not(.overlay-header) .header-inner .toggle-wrapper::before'),
            ),
        ),
    );

    /**
     * Filters Twenty Twenty theme elements.
     *
     * @since Twenty Twenty 1.0
     *
     * @param array Array of elements.
     */
    return apply_filters('twentytwenty_get_elements_array', $elements);
}

/* function kvcodes_insert_post_hook($ID, $post, $update){
// Here your code.
}
add_action('wp_insert_post', 'kvcodes_insert_post_hook'); */

if (isset($_POST['submit'])) {

    $post_title = $_POST['post_title'];
    $post_content = $_POST['post_content'];
    $image_name = $_FILE['feture_image']['name'];
    $image_url = $_FILE['feture_image']['tmp_name'];

    $new_post = array(
        'post_type' => 'post',
        'post_content' => $post_content,
        'post_title' => $post_title,
        'post_status' => 'pending',
    );

    $post_id = wp_insert_post($new_post);
    $post = get_post($post_id);

    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = basename($image_url);
    if (wp_mkdir_p($upload_dir['path'])) {
        $file = $upload_dir['path'] . '/' . $filename;
    } else {
        $file = $upload_dir['basedir'] . '/' . $filename;
    }

    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'pending',
    );
    $attach_id = wp_insert_attachment($attachment, $file, $post_id);
    require_once ABSPATH . 'wp-admin/includes/image.php';
    $attach_data = wp_generate_attachment_metadata($attach_id, $file);
    $res1 = wp_update_attachment_metadata($attach_id, $attach_data);
    $res2 = set_post_thumbnail($post_id, $attach_id);

}

function my_admin_menu()
{
    add_menu_page(
        __('Post Status', 'my-textdomain'),
        __('Post Approval', 'my-textdomain'),
        'manage_options',
        'post-approval',
        'wp_post_approval_callback',
        'dashicons-schedule',
        3
    );
}

add_action('admin_menu', 'my_admin_menu');

function wp_post_approval_callback()
{
    ?>
<h1>
    <?php esc_html_e('Welcome to my Post Approval Section', 'my-plugin-textdomain');?>
</h1>
<form action="" action="post">
    <input type="text" class="form-control" id="post_id" placeholder="Enter Post Id" name="post_id">

    <input class="btn btn-primary btn-lg" type="submit" name="update_status" value="Update-Post" onclick="insert()" />
</form>
<?php
function insert()
    {
/* if(isset($_POST['update_status'])) { */

        $post_id = $_POST['post_id'];

        $args = array(
            'post_type' => 'post',
            'ID' => 48,
            'post_status' => 'publish',
        );

        wp_update_post($args);

// }
    }
    ?>

<br>
<?php
$args = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'post_status' => 'pending',
        // Several more arguments could go here. Last one without a comma.
    );

    // Query the posts:
    $obituary_query = new WP_Query($args);
    ?>
<table>
    <tr>
        <th>Post Id</th>
        <th>Post Title</th>
        <th>Content</th>
        <th>Post Status</th>
    </tr>

    <?php
// Loop through the obituaries:
    while ($obituary_query->have_posts()): $obituary_query->the_post();
        ?>
										    <style>
										    table {
										        font-family: arial, sans-serif;
										        border-collapse: collapse;
										        width: 100%;
										    }

										    td,
										    th {
										        border: 1px solid #dddddd;
										        text-align: left;
										        padding: 8px;
										    }

										    tr:nth-child(even) {
										        background-color: #dddddd;
										    }
										    </style>
										    <tr>
										        <td><?=get_the_ID();?></td>
										        <td><?=the_title();?></td>
										        <td><?=the_content();?></td>
										        <td><?=get_post_status();?></td>

										    </tr>

										    <?php

    endwhile;
    ?>
</table>
<?php
// Reset Post Data
    wp_reset_postdata();
}

$my_post = array(

    'post_content' => $event_desc,

    'ID' => $post_id,

);

wp_update_post($my_post);

if (isset($_POST['submit_edit'])) {

    $post_id = $_POST['post_id_edit'];
    $post_title_edit = $_POST['post_title_edit'];
    $post_content_edit = $_POST['post_content_edit'];

    $new_post = array(
        'post_type' => 'post',
        'ID' => $post_id,
        'post_content' => $post_content_edit,
        'post_title' => $post_title_edit,
        'post_status' => 'publish',
    );

    $post_id = wp_update_post($new_post);

}

add_action('rest_api_init', 'my_register_route_main');

function my_register_route_main()
{

    register_rest_route('wooproduct', 'list', array(
        'methods' => 'POST',
        'callback' => 'create_woocoomerce_product',
    )
    );

    register_rest_route('wooproduct', 'update', array(
        'methods' => 'POST',
        'callback' => 'update_woocoomerce_product',
    )
    );

    register_rest_route('wooproduct', 'delete/product(?:/(?P<id>\d+))?', array(
        'methods' => 'GET',
        'callback' => 'delete_woocoomerce_product',
    )
    );
    register_rest_route('wooproduct', 'view', array(
        'methods' => 'POST',
        'callback' => 'view_woocoomerce_product',
    )
    );
    register_rest_route('wooproduct', 'bid/product', array(
        'methods' => 'POST',
        'callback' => 'add_to_cart_woocoomerce_product',
    ));

    register_rest_route('wooproduct', 'login', array(
        'methods' => WP_REST_SERVER::CREATABLE,
        'callback' => 'wc_rest_user_login_endpoint',
    ));

    register_rest_route('demo', 'product/extendwarrety', array(
        'methods' => 'POST',
        'callback' => 'extend_product_warrenty_callback',
    ));

    register_rest_route('demo', 'product/extendwarretywithpost', array(
        'methods' => 'POST',
        'callback' => 'extend_product_warrenty_callback_with_post',
    ));

    register_rest_route('demo', 'gst/calculation', array(
        'methods' => 'POST',
        'callback' => 'calculate_simple_gst_cgst_sgst',
    ));

    register_rest_route('rapidapi', 'movie/list', array(
        'methods' => 'POST',
        'callback' => 'calculate_simple_movie_list',
    ));

}

function create_woocoomerce_product($request)
{

    header('Content-Type: application/json');

    $response = array();

    $post_title = sanitize_text_field($request['post_title']);
    $post_content = sanitize_text_field($request['post_content']);
    $post_status = sanitize_text_field($request['post_status']);
    $_price = sanitize_text_field($request['_price']);
    $_featured = sanitize_text_field($request['_featured']);
    $_stock = sanitize_text_field($request['_stock']);
    $_stock_status = sanitize_text_field($request['_stock_status']);
    $_sku = sanitize_text_field($request['_sku']);

    $user_data = array(
        'post_type' => "product",
        'post_title' => $post_title,
        'post_content' => $post_content,
        'post_status' => $post_status,
    );

    $product_id = wp_insert_post($user_data);

    wp_set_object_terms($product_id, 'simple', 'product_type');

    update_post_meta($product_id, '_price', $_price);
    update_post_meta($product_id, '_featured', $_featured);
    update_post_meta($product_id, '_stock', $_stock);
    update_post_meta($product_id, '_stock_status', $_stock_status);
    update_post_meta($product_id, '_sku', $_sku);

    $headers = array('Content-Type: text/html; charset=UTF-8');

    if (!is_wp_error($product_id)) {
        $response['status'] = true;
        $response['code'] = 200;
        $response['Message'] = "Product Created Successfully.";
    } else {
        $response['status'] = false;
        $response['code'] = 404;
        $response['Message'] = $product_id->get_error_message();
    }

    return new WP_REST_Response($response);

}

function update_woocoomerce_product($request)
{

    header('Content-Type: application/json');

    $response = array();

    $ID = sanitize_text_field($request['ID']);
    $post_title = sanitize_text_field($request['post_title']);
    $post_content = sanitize_text_field($request['post_content']);
    $post_status = sanitize_text_field($request['post_status']);
    $_price = sanitize_text_field($request['_price']);
    $_featured = sanitize_text_field($request['_featured']);
    $_stock = sanitize_text_field($request['_stock']);
    $_stock_status = sanitize_text_field($request['_stock_status']);
    $_sku = sanitize_text_field($request['_sku']);

    $user_data = array(
        'post_type' => "product",
        'ID' => $ID,
        'post_title' => $post_title,
        'post_content' => $post_content,
        'post_status' => $post_status,
    );

    $product_id = wp_update_post($user_data);

    wp_set_object_terms($product_id, 'simple', 'product_type');

    update_post_meta($product_id, '_price', $_price);
    update_post_meta($product_id, '_featured', $_featured);
    update_post_meta($product_id, '_stock', $_stock);
    update_post_meta($product_id, '_stock_status', $_stock_status);
    update_post_meta($product_id, '_sku', $_sku);

    $headers = array('Content-Type: text/html; charset=UTF-8');

    if (!is_wp_error($product_id)) {

        $response['status'] = true;
        $response['code'] = 200;
        $response['Message'] = "Product Updated Successfully.";

    } else {

        $response['status'] = false;
        $response['code'] = 404;
        $response['Message'] = $product_id->get_error_message();
    }

    return new WP_REST_Response($response);

}

function view_woocoomerce_product($request)
{

    header('Content-Type: application/json');

    $response = array();

    $ID = sanitize_text_field($request['ID']);

    $product_info = wc_get_product($ID);

    $headers = array('Content-Type: text/html; charset=UTF-8');

    if (!is_wp_error($product_info)) {

        $response['status'] = true;
        $response['code'] = 200;
        $response['Message'] = "Product Updated Successfully.";
        $response['data'] = array(
            'ID' => $product_info->get_id(),
            'Product Type' => $product_info->get_type(),
            'Product Name' => $product_info->get_name(),
            'Date Created' => $product_info->get_date_created(),
            'Date Updated' => $product_info->get_date_modified(),
            'Status' => $product_info->get_status(),
            'Visibility' => $product_info->get_catalog_visibility(),
            'Description' => $product_info->get_description(),
            'Short Description' => $product_info->get_short_description(),
            'Sku' => $product_info->get_sku(),
            'Price' => $product_info->get_price(),
            'URL' => get_permalink($product_info->get_id()),
            'Image' => $product_info->get_image(),

        );

    } else {
        $response['status'] = false;
        $response['code'] = 404;
        $response['Message'] = $product_id->get_error_message();
    }

    return new WP_REST_Response($response);

}

function delete_woocoomerce_product($request)
{
    header('Content-Type: application/json');

    $response = array();

    $product_id = sanitize_text_field($request['id']);

    /* $user_data = array(
    'post_type' => "product",
    'ID' => $ID
    );

    $product_id = wp_delete_post( $user_data );
     */
    $headers = array('Content-Type: text/html; charset=UTF-8');

    if (empty($product_id)) {

        echo json_encode(['status' => 400, 'message' => 'The product is not defined.']);

    } else {

        global $wpdb;
        $deleted_product = wp_trash_post($product_id);

        if (!empty($deleted_product)) {
            // echo json_encode(['status' => 200, 'message' => 'Produktet er slettet.']);

            echo json_encode(['status' => 400, 'message' => 'The product has been deleted.']);

        } else {

            echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);

        }
    }

    /*  if( ! is_wp_error( $product_id ) ) {
    $response['status'] = TRUE;
    $response['code'] = 200;
    $response['Message'] = "Product Removed Successfully.";
    } else {
    $response['status'] = False;
    $response['code'] = 404;
    $response['Message'] = $product_id->get_error_message();
    } */

    return new WP_REST_Response($response);
}

function add_to_cart_woocoomerce_product($request)
{

    header('Content-Type: application/json');

    $response = array();

    $product_id = sanitize_text_field($request['product_id']);

    $error = new WP_Error();

    if (empty($product_id)) {
        // $error->add(400, __("Product is undefind.", 'wp-rest-user'), array('status' => 400));
        $error->add(400, __("Product is undefind.", 'wp-rest-user'), array('status' => 400));
        return $error;
    } elseif (WC()->cart->get_cart_contents_count() == 0) {
        WC()->cart->add_to_cart($product_id);
    }
}

function wc_rest_user_login_endpoint($request)
{
    header('Content-Type: application/json');
    $response = [];
    $creds = array();
    $language = sanitize_text_field($request["language"]);
// print($language);

    $creds['user_login'] = sanitize_text_field($request["email"]);
    $creds['user_password'] = sanitize_text_field($request["password"]);
    $creds['remember'] = true;
    /* $longitude = sanitize_text_field($_POST['longitude']);
    $latitude = sanitize_text_field($_POST['latitude']); */

    $token = ($request['token']) ?? '';

    $error = new WP_Error();

    if (empty($creds['user_login'])) {
        if ($language == 'en') {
            $error->add(401, __("Please enter valid email.", 'wp-rest-user'), array('status' => 400));
        } elseif ($language == 'da') {
            $error->add(401, __("Indtast en gyldig e-mail..", 'wp-rest-user'), array('status' => 400));
        }
        return $error;
    }
    if (empty($creds['user_password'])) {
        if ($language == 'en') {
            $error->add(404, __("Password field is required.", 'wp-rest-user'), array('status' => 400));
        } elseif ($language == 'da') {
            $error->add(404, __("Adgangskodefelt er påkrævet.", 'wp-rest-user'), array('status' => 400));
        }
        return $error;
    }

    $user = wp_signon($creds, false);
    if (is_wp_error($user)) {
        if ($language == 'en') {
            $error->add(400, __("Invalid email address or password.", 'wp-rest-user'), array('status' => 400));
        } elseif ($language == 'da') {
            //   $error->add(400, __("Invalid email address or password.", 'wp-rest-user'), array('status' => 400));
            $error->add(400, __("Ugyldig e-mail-adresse eller adgangskode.", 'wp-rest-user'), array('status' => 400));
        }
        return $error;
    } else {
        wp_set_current_user($user->ID, $user->user_login);
        wp_set_auth_cookie($user->ID);
        do_action('wp_login', $user->user_login, $user);

        //save current user lat-long
        /*     update_user_meta($user->ID, 'user_latitude', $latitude);
        update_user_meta($user->ID, 'user_longitude', $longitude); */

        if ($token) {
            update_user_meta($user->ID, 'device_token', $token);
        }

        //TODO get_user_meta($user->ID, 'device_token', true);
        $userData = [];
        $userData['id'] = $user->ID;
        $userData['first_name'] = get_user_meta($user->ID, 'first_name', true);
        $userData['last_name'] = get_user_meta($user->ID, 'last_name', true);
        $username = $user->data->user_login;
        $userData['username'] = !empty(trim($userData['first_name'] . ' ' . $userData['last_name'])) ? $userData['first_name'] . ' ' . $userData['last_name'] : $username;
        $userData['phone'] = get_user_meta($user->ID, 'billing_phone', true);

        global $wp_roles, $WCFM;
        $user_role = array_shift(wp_get_current_user()->roles);
        $userData['role'] = $wp_roles->roles[$user_role]['name'];

        $imgid = get_user_meta($user->ID, 'wp_user_avatar', true);
        /* if($userData['role'] == 'Store Vendor'){
        $imgid = get_user_meta($user->ID, 'wp_user_avatar', true);
        $userData['avatar'] =  wp_get_attachment_url( $imgid );
        }else{
        $userData['avatar'] = $WCFM->plugin_url . 'assets/images/avatar.png';
        } */

        // $userData['avatar'] =  (wp_get_attachment_url($imgid) == true) ? wp_get_attachment_url($imgid) : $WCFM->plugin_url . 'assets/images/avatar.png';
        $userData['avatar'] = (wp_get_attachment_url($imgid) == true) ? wp_get_attachment_url($imgid) : false;

        $userData['email'] = $user->user_email;

        $response['code'] = 200;
        if ($language == 'en') {
            $response['message'] = __("User Logged in Successfully.", "wp-rest-user");
        } elseif ($language == 'da') {
            $response['message'] = __("Bruger er logget ind.", "wp-rest-user");
        }
        //   $response['message'] = __("User Logged in Successfully.", "wp-rest-user");
        // $response['message'] = __("Bruger er logget ind.", "wp-rest-user");
        $response['data'] = $userData;
    }
    return new WP_REST_Response($response, 200);
}

function extend_product_warrenty_callback_with_post($request)
{
    header('Content-Type: application/json');
    $response = array();

    $product_name = sanitize_text_field($request['service_name']); //Service Name
    $default_warrenty_time = sanitize_text_field($request['start_date_warrenty_time']); //first date of warrenty
    $current_warrenty_date = sanitize_text_field($request['current_warrenty_date']); //current date
    $extend_warrenty_time = sanitize_text_field($request['extend_warrenty_time']); //extend warrenty time

    $oneYearOn = date('Y-m-d', strtotime(date($default_warrenty_time) . " + 1 year")); //Last Day of Warrenty
    $testconvertcurrentdate = strtotime($current_warrenty_date); //convert to time current Date
    $testconvertoneyearon = strtotime($oneYearOn); //convert to time Last Warrenty Date
    $testconvertcurrentdateconvint = (int) $testconvertcurrentdate; // Convert Current Date into String
    $testconvertoneyearonconvint = (int) $testconvertoneyearon; // Convert Last warrenty Date into String
    $datediff = $testconvertoneyearonconvint - $testconvertcurrentdateconvint;

    $gapbetweeendays = round($datediff / (60 * 60 * 24)); //Count Gap Between Last Warrenty Date - Current Days
    $updatedwarrentydate = date('Y-m-d', strtotime($oneYearOn . " + $extend_warrenty_time")); //Update Warrenty Date With Extend warrenty Time
    $post_title = $product_name;

    if (!post_exists($post_title) && $gapbetweeendays <= 10) {
        $post_id = wp_insert_post(array(
            'post_status' => 'publish',
            'post_type' => 'extend_warrenty',
            'post_title' => $post_title,
        ));

        update_post_meta($post_id, 'warrenty_expired_in', $gapbetweeendays . " Days");
        update_post_meta($post_id, 'warrenty_started_on', $default_warrenty_time);
        update_post_meta($post_id, 'warrenty_expired_on', $oneYearOn);
        update_post_meta($post_id, 'todays_date', $current_warrenty_date);
        update_post_meta($post_id, 'extend_warrenty_time', $extend_warrenty_time);
        update_post_meta($post_id, 'updated_last_warrenty_date', $updatedwarrentydate);

        $response['status'] = true;
        $response['code'] = 200;
        $response['Message'] = "Warrenty Extended Successfully.";
        $response['data'] = array(
            'Service Name' => $product_name,
            'Warrenty Expired In' => $gapbetweeendays . " Days",
            'Warrenty Started On' => $default_warrenty_time,
            'Warrenty Expired On' => $oneYearOn,
            'Today`s Date' => $current_warrenty_date,
            'Extend Warrenty Time' => $extend_warrenty_time,
            'Updated Last Warrenty Date' => $updatedwarrentydate,
        );
    } else {
        $response['status'] = false;
        $response['code'] = 404;
        $response['Message'] = "Please Wait Your Warrenty Extend Application is not Applied Due to Gap is More than 10 Days";
        $response['data'] = array(
            'Gap Between Last Warrenty Date' => $gapbetweeendays,
            'Error Message' => "Please Change the Service Name.",
        );
    }

    return new WP_REST_Response($response, 200);
}

function extend_product_warrenty_callback($request)
{
    header('Content-Type: application/json');
    $response = array();

    $product_name = sanitize_text_field($request['service_name']); //Service Name
    $default_warrenty_time = sanitize_text_field($request['start_date_warrenty_time']); //first date of warrenty
    $current_warrenty_date = sanitize_text_field($request['current_warrenty_date']); //current date
    $extend_warrenty_time = sanitize_text_field($request['extend_warrenty_time']); //extend warrenty time

    /* Get Date after the One Year */
    $oneYearOn = date('Y-m-d', strtotime(date($default_warrenty_time) . " + 1 year")); //Last Day of Warrenty
    $testconvertcurrentdate = strtotime($current_warrenty_date); //convert to time current Date
    $testconvertoneyearon = strtotime($oneYearOn); //convert to time Last Warrenty Date
    $testconvertcurrentdateconvint = (int) $testconvertcurrentdate; // Convert Current Date into String
    $testconvertoneyearonconvint = (int) $testconvertoneyearon; // Convert Last warrenty Date into String
    $datediff = $testconvertoneyearonconvint - $testconvertcurrentdateconvint;

    $gapbetweeendays = round($datediff / (60 * 60 * 24)); //Count Gap Between Last Warrenty Date - Current Days
    $updatedwarrentydate = date('Y-m-d', strtotime($oneYearOn . " + $extend_warrenty_time")); //Update Warrenty Date With Extend warrenty Time
    if ($gapbetweeendays <= 10) {

        $response['status'] = true;
        $response['code'] = 200;
        $response['Message'] = "Warrenty Extended Successfully.";
        $response['data'] = array(
            'Service Name' => $product_name,
            'Warrenty Expired In' => $gapbetweeendays . " Days",
            'Warrenty Started On' => $default_warrenty_time,
            'Warrenty Expired On' => $oneYearOn,
            'Today`s Date' => $current_warrenty_date,
            'Extend Warrenty Time' => $extend_warrenty_time,
            'Updated Last Warrenty Date' => $updatedwarrentydate,
        );

    } else {
        $response['status'] = false;
        $response['code'] = 404;
        $response['Message'] = "Please Wait Your Warrenty Extend Application is not Applied Due to Gap is More than 10 Days";
        $response['data'] = array(
            'Gap Between Last Warrenty Date' => $gapbetweeendays,
        );
    }
    return new WP_REST_Response($response, 200);

}

function calculate_simple_gst_cgst_sgst($request)
{
    header('Content-Type: application/json');
    $response = array();

    $Item = sanitize_text_field($request['item']);
    $amount = sanitize_text_field($request['amount']); //Amount Name
    $percent = sanitize_text_field($request['percent']); // GST PERCENTAGE

    // $gst_amount = $amount - ($amount * (100 / (100 + $percent)));

    $gst_amount = ($amount * $percent) / 100;
    $total = number_format($amount + $gst_amount, 2);
    $percentcgst = number_format($gst_amount / 2, 3);
    $percentsgst = number_format($gst_amount / 2, 3);
    $withoutgst = number_format($amount);
    $post_title = $Item;

    if (!post_exists($post_title)) {
        $post_id = wp_insert_post(array(
            'post_status' => 'publish',
            'post_type' => 'gst_calculator',
            'post_title' => $post_title,
        ));

        update_post_meta($post_id, 'amount', $amount);
        update_post_meta($post_id, 'percentage', $percent);
        update_post_meta($post_id, 'amount_without_gst', $withoutgst);
        update_post_meta($post_id, 'gst_amount', number_format($gst_amount, 2));
        update_post_meta($post_id, 'cgst', $percentcgst);
        update_post_meta($post_id, 'sgst', $percentsgst);
        update_post_meta($post_id, 'total', $total);

        $response['status'] = true;
        $response['code'] = 200;
        $response['Message'] = "Calculation Performed Sucessfully.";
        $response['data'] = array(
            'Item' => $Item,
            'Amount' => $amount,
            'Percentage' => $percent . "%",
            'Amount Without GST' => $withoutgst,
            'GST Amount' => number_format($gst_amount, 2),
            'CGST' => $percentcgst,
            'SGST' => $percentsgst,
            'Total' => $total,
        );
    } else {
        $response['status'] = false;
        $response['code'] = 404;
        $response['Message'] = "Please Change the Item name.Already Exist.!!!";
        $response['data'] = array(null);
    }

/*     if (!empty($post_id)) {
$response['status'] = true;
$response['code'] = 200;
$response['Message'] = "Calculation Performed Sucessfully.";
$response['data'] = array(
'Item' => $Item,
'Amount' => $amount,
'Percentage' => $percent . "%",
'Amount Without GST' => $withoutgst,
'GST Amount' => number_format($gst_amount, 2),
'CGST' => $percentcgst,
'SGST' => $percentsgst,
'Total' => $total,
);
} else {
$response['status'] = false;
$response['code'] = 404;
$response['Message'] = "Something is Wrong.";
$response['data'] = array(null);
} */

    // return $display;

    return new WP_REST_Response($response, 200);
}

function calculate_simple_movie_list($request)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://ott-details.p.rapidapi.com/getnew?region=US&page=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: ott-details.p.rapidapi.com",
            "x-rapidapi-key: 7aa9b83a3emshbee8f06084cda5bp1ebba4jsn38a31c1bb5f0",
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}
function my_load_scripts($hook)
{

    //
    ?>
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
<?php
wp_enqueue_script('ajax_post', get_template_directory_uri() . '/assets/js/custom.js', array(), '1.0.0');
    wp_enqueue_script('ajax_cron', get_template_directory_uri() . '/assets/js/customcron.js', array(), '1.0.0');
    wp_enqueue_script('ajax_user', get_template_directory_uri() . '/assets/js/create-user.js', array(), '1.0.0');
    wp_enqueue_script('ajax_push', get_template_directory_uri() . '/assets/js/pushdata.js', array(), '1.0.0');
    wp_enqueue_script('post_filter_wp', get_template_directory_uri() . '/assets/js/post-filter.js', array(), '1.0.0');

}
add_action('wp_enqueue_scripts', 'my_load_scripts');

function addpost()
{
    $array = [];
    wp_parse_str($_POST['addpost'], $array);

    $result = array(
        'post_type' => $array['post_type_ajax'],
        'post_author' => $array['post_id_ajax'],
        'post_title' => $array['post_title_ajax'],
        'post_content' => $array['post_content_ajax'],
        'post_status' => 'publish',
    );

    wp_insert_post($result);

    if ($result > 0) {
        wp_send_json_success("Data Inserted");
    } else {
        wp_send_json_error("Please Try Again!");
    }
}

add_action('wp_ajax_addpost', 'addpost');
add_action('wp_ajax_nopriv_addpost', 'addpost');

add_action('wpcf7_init', 'wpcf7_add_shortcode_text');

function wpcf7_add_shortcode_text()
{
    wpcf7_add_shortcode(
        array('text', 'text*', 'email', 'email*', 'url', 'url*', 'tel', 'tel*'),
        'wpcf7_text_shortcode_handler', true);
}

add_action('wpcf7_init', 'custom_add_shortcode_hello');

function custom_add_shortcode_hello()
{
    wpcf7_add_shortcode('helloworld', 'custom_hello_shortcode_handler'); // "helloworld" is the type of the form-tag
}

function custom_hello_shortcode_handler($tag)
{

    return 'hello world ! ';
}

function custom_post_type()
{

    $labels = array(
        'name' => _x('Post Types', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('Post Type', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => __('Post Types', 'text_domain'),
        'name_admin_bar' => __('Post Type', 'text_domain'),
        'archives' => __('Item Archives', 'text_domain'),
        'attributes' => __('Item Attributes', 'text_domain'),
        'parent_item_colon' => __('Parent Item:', 'text_domain'),
        'all_items' => __('All Items', 'text_domain'),
        'add_new_item' => __('Add New Item', 'text_domain'),
        'add_new' => __('Add New', 'text_domain'),
        'new_item' => __('New Item', 'text_domain'),
        'edit_item' => __('Edit Item', 'text_domain'),
        'update_item' => __('Update Item', 'text_domain'),
        'view_item' => __('View Item', 'text_domain'),
        'view_items' => __('View Items', 'text_domain'),
        'search_items' => __('Search Item', 'text_domain'),
        'not_found' => __('Not found', 'text_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
        'featured_image' => __('Featured Image', 'text_domain'),
        'set_featured_image' => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image' => __('Use as featured image', 'text_domain'),
        'insert_into_item' => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list' => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list' => __('Filter items list', 'text_domain'),
    );
    $args = array(
        'label' => __('Post Type', 'text_domain'),
        'description' => __('Post Type Description', 'text_domain'),
        'labels' => $labels,
        'supports' => false,
        'taxonomies' => array('movies_category', 'post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('movies', $args);

}
add_action('init', 'custom_post_type', 0);

function syb_cron_schedule($schedules)
{
    if (!isset($schedules['every_minute'])) {
        $schedules['every_minute'] = array(
            'interval' => 60,
            'display' => __('Every minute'),
        );
    }
    return $schedules;
}
add_filter('cron_schedules', 'syb_cron_schedule');

function insert_post_via_cron()
{
    $array = [];
    wp_parse_str($_POST['insert_post_via_cron'], $array);

    $result = array(
        'post_type' => 'post',
        'post_title' => $array['post_title_cron'],
        'post_content' => $array['post_content_cron'],
    );

    wp_insert_post($result);

    $to = 'rajan.panchal@creolestudios.com';
    $subject = 'Regarding Post Create Notification from Frontend User';
    $body = '';
    $body .= 'Post Title : ' . $array['post_title_cron'];
    $body .= 'Post Content : ' . $array['post_content_cron'];
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail($to, $subject, $body, $headers);

    if ($result > 0) {
        wp_send_json_success("Data Inserted");
    } else {
        wp_send_json_error("Please Try Again!");
    }
}

add_action('wp_ajax_insert_post_via_cron', 'insert_post_via_cron');
add_action('wp_ajax_nopriv_insert_post_via_cron', 'insert_post_via_cron');

function insert_user_via_ajax()
{
    $array = [];
    wp_parse_str($_POST['insert_user_via_ajax'], $array);

    $result = array(
        'user_pass' => $array['user_pass'],
        'user_login' => $array['user_login'],
        'display_name' => $array['display_name'],
        'first_name' => $array['first_name'],
        'last_name' => $array['last_name'],
        'user_email' => $array['user_email'],
    );

    wp_insert_user($result);

    if ($result > 0) {
        wp_send_json_success("User Created Successfully.");
    } else {
        wp_send_json_error("Please Try Again!");
    }
}

add_action('wp_ajax_insert_user_via_ajax', 'insert_user_via_ajax');
add_action('wp_ajax_nopriv_insert_user_via_ajax', 'insert_user_via_ajax');

function insert_push_value_via_ajax()
{
    $array = [];
    wp_parse_str($_POST['insert_push_value_via_ajax'], $array);
    global $wpdb;
    $tablename = $wpdb->prefix . 'post_job';

    $result = $wpdb->insert($tablename, array(
        'organizationname' => $array['organizationname'],
        'post' => $array['post'],
        'publishfrom' => $array['publishfrom'],
        'publishupto' => $array['publishupto'],
        'qualification1' => $array['qualification1'],
        'qualification2' => $array['qualification2'],
        'qualification3' => $array['qualification3'],
        'qualification4' => $array['qualification4'],
        'experience1' => $array['experience1'],
        'experience2' => $array['experience2'],
        'experience3' => $array['experience3'],
        'training1' => $array['training1'],
        'training2' => $array['training2'],
        'training3' => $array['training3'],
        'training4' => $array['training4'],
        'training5' => $array['training5']),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );

    if ($result > 0) {
        wp_send_json_success("Push Data Inserted Successfully.");
    } else {
        wp_send_json_error("Please Try Again!");
    }
}

add_action('wp_ajax_insert_push_value_via_ajax', 'insert_push_value_via_ajax');
add_action('wp_ajax_nopriv_insert_push_value_via_ajax', 'insert_push_value_via_ajax');

/* End code for user creation */

/*
if( isset( $_POST['submit_push_pop'] ) && !empty($_POST['push_value']) ){

global $wpdb;
$tablename = $wpdb->prefix.'pushpop';

$wpdb->insert( $tablename, array(
'push_value' => $_POST['push_value']),
array( '%s' )
);

} */

if (isset($_POST['insert_user'])) {

    if ($_POST['user_login'] == "") {
        $errorMsg = "Error : You did not enter a User Name.";

    } elseif ($_POST['display_name'] == "") {
        $errorMsg = "Error : You did not enter a Display.";

    } elseif ($_POST['first_name'] == "") {
        $errorMsg = "Error : You did not enter a First Name.";

    } elseif ($_POST['last_name'] == "") {
        $errorMsg = "Error : You did not enter a Last Name.";

    } elseif ($_POST['user_email'] == "") {
        $errorMsg = "Error : You did not enter a User Email.";

    } elseif ($_POST['user_pass'] == "") {
        $errorMsg = "Error : You did not enter a Password.";

    } else {
        $userdata = array(
            'user_login' => $_POST['user_login'],
            'display_name' => $_POST['display_name'],
            'nickname' => $_POST['nickname'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'user_email' => $_POST['user_email'],
            'user_pass' => $_POST['user_pass'],
            'role' => $_POST['role'],
        );

        $user_id = wp_insert_user($userdata);
    }
}

do_action('user_redirect_if_logged_in');

// get_header();
$login = home_url() . "/login-new/";
$dashboard = home_url() . "/dashboard/";

if (isset($_REQUEST['login_user'])) {

    $email = $_POST['user_login'];
    $password = $_POST['user_pass'];
    $creds = array();
    $creds['user_login'] = $_POST['user_login'];
    $creds['user_password'] = $_POST['user_pass'];
    $creds['remember'] = false;
    $user = wp_signon($creds, false);
    //if ( is_wp_error($user) )
    //{
    //   header("location:$login");
    //}
    //else
    //{
    //   header("location:$dashboard");
    //}

    $user = wp_signon($creds);

    if (isset($user->errors)) {
        // if(is_wp_error($user)) {
        echo $user->get_error_message();
        die;
    } else { //successfully logged in
        session_start(); //check for wp_session storage
        $_SESSION["new_dashboard"] = '1'; //if you want to redirect user to a new page or set any conditions on login

        if ($user->is_admin == '1') {
            $dashboard = home_url() . "/?page_id=257";
        } else {
            $dashboard = home_url() . "/?page_id=257";
        }

        //set cookie for remember me //save user login details as cookie if remember me is set, so that if user logs out next time and comes to this log in page, username & password auto fills by checking
        $user_login_details = $email . '_pass_' . $password;
        if (!empty($_POST["remember"])) {
            setcookie("user_login_details", $user_login_details, time() + (10 * 365 * 24 * 60 * 60)); //set cookie time as per you need
        } else { //remove login details from cookie
            if (isset($_COOKIE["user_login_details"])) {
                setcookie("user_login_details", "");
            }
        }
        wp_redirect($dashboard);
        exit;
    }
}

if (isset($_COOKIE["user_login_details"])) {
    $login_details = $_COOKIE["user_login_details"];
    $login_details = explode('_pass_', $login_details);
    $email_set = $login_details[0];
    $pass_set = $login_details[1];
}

function wpdocs_codex_book_init()
{
    $labels = array(
        'name' => _x('Books', 'Post type general name', 'textdomain'),
        'singular_name' => _x('Book', 'Post type singular name', 'textdomain'),
        'menu_name' => _x('Books', 'Admin Menu text', 'textdomain'),
        'name_admin_bar' => _x('Book', 'Add New on Toolbar', 'textdomain'),
        'add_new' => __('Add New', 'textdomain'),
        'add_new_item' => __('Add New Book', 'textdomain'),
        'new_item' => __('New Book', 'textdomain'),
        'edit_item' => __('Edit Book', 'textdomain'),
        'view_item' => __('View Book', 'textdomain'),
        'all_items' => __('All Books', 'textdomain'),
        'search_items' => __('Search Books', 'textdomain'),
        'parent_item_colon' => __('Parent Books:', 'textdomain'),
        'not_found' => __('No books found.', 'textdomain'),
        'not_found_in_trash' => __('No books found in Trash.', 'textdomain'),
        'featured_image' => _x('Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
        'set_featured_image' => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'use_featured_image' => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'archives' => _x('Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
        'insert_into_item' => _x('Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
        'uploaded_to_this_item' => _x('Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
        'filter_items_list' => _x('Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
        'items_list_navigation' => _x('Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain'),
        'items_list' => _x('Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'book'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
    );

    register_post_type('book', $args);
}

add_action('init', 'wpdocs_codex_book_init');

if (!empty($_POST['submit'])) {
    $roll = $_POST['rollno'];
    $fname = $_POST['fname'];
    $sex = $_POST['sex'];
    $sports_game = $_POST['sport_game'];
    $age_group = $_POST['age_group'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    /* print_r($_POST); */
    require "fpdf/fpdf.php";

    $pdf = new FPDF();
    $title = 'Submitted Data';
    $pdf->SetTitle($title);
    $pdf->AddPage();
    $pdf->Image('https://images.ctfassets.net/xct4vv2g1nhc/7BH4pv1iyN6ejBAKlhP5Py/5bb8074bd02c78be27ff06a506df1752/youth-sports-registration-software-he0rM.png', 10, 6, 30);

    /* $pdf->SetFont('Arial','B',15);
    // Move to the right
    $pdf->Cell(80);
    // Title
    $pdf->Cell(30,10,'Title',1,0,'C');
    // Line break
    $pdf->Ln(20);
     */
    global $title;

    // Arial bold 15
    $pdf->SetFont('Arial', 'B', 15);
    // Calculate width of title and position
    $w = $pdf->GetStringWidth($title) + 6;
    $pdf->SetX((210 - $w) / 2);
    // Colors of frame, background and text
    $pdf->SetDrawColor(0, 80, 180);
    $pdf->SetFillColor(230, 230, 0);
    $pdf->SetTextColor(220, 50, 50);
    // Thickness of frame (1 mm)
    $pdf->SetLineWidth(1);
    // Title
    $pdf->Cell($w, 9, $title, 1, 1, 'C', true);
    // Line break
    $pdf->Ln(10);

    // font style,blank,font-size
    $pdf->SetFont("Arial", "", 12);
    /* set full width auto,hieght,Label,Borser,is in new line,content alignCenter-left-right */
    $pdf->Cell(0, 10, "Registration Details", 1, 1, 'C');

    $pdf->Cell(15, 10, "Roll No", 1, 0, 'L');
    $pdf->Cell(25, 10, "First Name", 1, 0, 'C');
    $pdf->Cell(15, 10, "Gendor", 1, 0, 'C');
    $pdf->Cell(35, 10, "Interested Game", 1, 0, 'C');
    $pdf->Cell(22, 10, "Age Group", 1, 0, 'C');
    $pdf->Cell(22, 10, "Last Name", 1, 0, 'C');
    $pdf->Cell(0, 10, "Email ID", 1, 1, 'C');

    $pdf->Cell(15, 10, $roll, 1, 0, 'C');
    $pdf->Cell(25, 10, $fname, 1, 0, 'C');
    $pdf->Cell(15, 10, $sex, 1, 0, 'C');
    $pdf->Cell(35, 10, $sports_game, 1, 0, 'C');
    $pdf->Cell(22, 10, $age_group, 1, 0, 'C');

    $pdf->Cell(22, 10, $lname, 1, 0, 'C');
    $pdf->Cell(0, 10, $email, 1, 0, 'C');

    $pdf->SetY(260);
    // Arial italic 8
    $pdf->AliasNbPages();
    $pdf->Cell(0, 10, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 0, 'C');

    $to = 'rajan.panchal@creolestudios.com';
    $subject = "PDF Attachement";
    $body = "$roll is rollnumber of $fname $lname which sex is $sex & email id is $email. $fname like $sports_game. Age of $fname $lname Between $age_group. ";
    $separator = md5(time());
    $headers = "MIME-Version: 1.0";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"";
    $headers .= "Content-Transfer-Encoding: 7bit";
    $headers .= 'From: <rajan.panchal51196@gmail.com>' . "\r\n";

    $path = '/var/www/html/postapproval/wp-content/themes/twentytwenty/';
    $name = $fname . '' . $lname . '.pdf';
    $conctactpdf = $pdf->Output($path . $name, 'F');

    $attachments = array(WP_CONTENT_DIR . "/themes/twentytwenty/$name");

    wp_mail($to, $subject, $body, $headers, $attachments);

}

add_action('wp_ajax_show_post_filter_result_calculation', 'filter_wp_post_with_different_paramters');
add_action('wp_ajax_nopriv_show_post_filter_result_calculation', 'filter_wp_post_with_different_paramters');
function filter_wp_post_with_different_paramters()
{

    $array = [];
    wp_parse_str($_POST['show_post_filter_result_calculation'], $array);

/*     $result = array(
'post_type' => $array['post_type_ajax'],
'post_author' => $array['post_id_ajax'],
'post_title' => $array['post_title_ajax'],
'post_content' => $array['post_content_ajax'],
'post_status' => 'publish'
);

wp_insert_post( $result ); */

    $starting_date = date('F j, Y', strtotime($array['starting_date']));
    $ending_date = date('F j, Y', strtotime($array['ending_date']));
    $post_status =
    $result = arrray(

    );

    $args = array(
        'post_type' => 'book',
        'posts_per_page' => $array['post_per_page'],
        'order' => 'DESC',
        'post_status' => $array['wp_post_status'],
        'date_query' => array(
            array(
                'after' => $starting_date,
                'before' => $ending_date,
                'inclusive' => true,
            ),
        ),
    );
    $result = new WP_Query($args);

    if ($result->have_posts()) {
        while ($result->have_posts()) {
            $result->the_post();
            ?>
<?php
$id = get_the_ID();
            ?>
<div class="container">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-body">

                <h5 class="card-title"><?php echo get_the_ID(); ?><br><?php echo get_the_title(); ?></h5>
                <p class="card-text"><?php echo the_content(); ?></p>
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" width="300" height="300">
                <p><?php echo get_post_status(); ?></p>


            </div>
        </div>
    </div>


</div>

<?php
}
        ?>
<?php
} else {
        echo "<h2 class='form-signin-heading text-center text-danger'>No Post Found Between $starting_date And $ending_date.</h2>";
    }
    wp_reset_postdata();

    if ($result > 0) {
        wp_send_json_success("Data Fetched");
    } else {
        wp_send_json_error("Please Try Again!");
    }

}

function register_custom_post_type_movie()
{
    $args = array(
        "label" => __("Movies", ""),
        "labels" => array(
            "name" => __("Movies", ""),
            "singular_name" => __("Movie", ""),
            "featured_image" => __("Movie Poster", ""),
            "set_featured_image" => __("Set Movie Poster", ""),
            "remove_featured_image" => __("Remove Movie Poster", ""),
            "use_featured_image" => __("Use Movie Poster", ""),
        ),
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "movie", "with_front" => true),
        "query_var" => true,
        "supports" => array("title", "editor", "thumbnail"),
        "taxonomies" => array("category"),
    );
    register_post_type("movie", $args);
}
add_action('init', 'register_custom_post_type_movie');

function my_ajax_filter_search_scripts()
{
    wp_enqueue_script('my_ajax_filter_search', get_stylesheet_directory_uri() . '/assets/js/script.js', array(), '1.0', true);
    wp_localize_script('my_ajax_filter_search', 'ajax_url', admin_url('admin-ajax.php'));
}
// Shortcode: [my_ajax_filter_search]
function my_ajax_filter_search_shortcode()
{
    my_ajax_filter_search_scripts();
    ob_start();?>

<!-- Test Shortcode Output -->
<!-- FORM CODE WILL GOES HERE -->
<style>
.column-wrap {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin: 20px 0
}

.column-wrap .column {
    width: 49%;
}

.column-wrap .column:last-child {
    float: right;
}

#my-ajax-filter-search label {
    display: block;
    font-weight: bold;
    font-style: italic;
}

#my-ajax-filter-search select {
    width: 100%;
    background-color: #f7f7f7;
    padding: 0.625em 0.4375em;
    border: 1px solid #d1d1d1;
}

#ajax_filter_search_results {
    list-style: none;
    display: flex;
    justify-content: start;
    flex-wrap: wrap;
    margin-top: 30px;
}

#ajax_filter_search_results li {
    width: 23.5%;
    float: left;
    margin-right: 2%;
    overflow: hidden;
    position: relative;
    margin-bottom: 20px;
}

#ajax_filter_search_results li.no-result {
    width: 100%;
    text-align: center;
}

#ajax_filter_search_results li:nth-child(4n+4) {
    margin-right: 0;
}

.movie-info h4 {
    margin-bottom: 10px;
    color: #fff;
}

.movie-info p {
    margin-bottom: 0;
    color: #fff;
    font-size: 13px;
}

.movie-info {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding: 15px;
    background: rgba(0, 0, 0, 0.85);
    opacity: 0;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    transition: all .3s;
}

.movie-info * {
    width: 100%;
    display: block;
}

#ajax_filter_search_results li:hover .movie-info {
    opacity: 1;
}
</style>

<div id="my-ajax-filter-search">
    <form style="border:2px solid;padding: 20px;margin-left:200px;width:1500px;" action="" method="get">
        <h2 class="form-signin-heading">Post filter Using Ajax</h2>
        <input type="text" name="search" id="search" class="form-group" value="" placeholder="Search Here..">

        <div class="column-wrap">
            <div class="column">
                <label for="year">Year</label>
                <input type="number" name="year" class="form-group" id="year">
            </div>
            <div class="column">
                <label for="rating">IMDB Rating</label>
                <select name="rating" id="rating">
                    <option value="">Any Rating</option>
                    <option value="9">At least 9</option>
                    <option value="8">At least 8</option>
                    <option value="7">At least 7</option>
                    <option value="6">At least 6</option>
                    <option value="5">At least 5</option>
                    <option value="4">At least 4</option>
                    <option value="3">At least 3</option>
                    <option value="2">At least 2</option>
                    <option value="1">At least 1</option>
                </select>
            </div>

            <div class="form-group">
                <label for="wp_post_status" class="form-label">Select Post Status: </label>
                <select id="wp_post_status" name="wp_post_status" class="form-control">
                    <option value="publish">Publish</option>
                    <option value="" selected>Select Post Status</option>
                    <option value="pending">Pending</option>
                    <option value="draft">Draft</option>
                    <option value="future">Future</option>
                    <option value="trash">Trash</option>
                    <option value="any">Any</option>
                </select>
            </div>
            <hr />

        </div>
        <div class="column-wrap">
            <div class="column">
                <label for="language">Language</label>
                <select name="language" id="language">
                    <option value="">Any Language</option>
                    <option value="english">English</option>
                    <option value="korean">Korean</option>
                    <option value="hindi">Hindi</option>
                    <option value="serbian">Serbian</option>
                    <option value="malayalam">Malayalam</option>
                </select>
            </div>
            <div class="column">
                <label for="genre">Genre</label>
                <select name="genre" id="genre">
                    <option value="">Any Genre</option>
                    <option value="action">Action</option>
                    <option value="comedy">Comedy</option>
                    <option value="drama">Drama</option>
                    <option value="horror">Horror</option>
                    <option value="romance">Romance</option>
                </select>
            </div>


        </div>
        <button type="submit" class="btn btn-default" id="submit" name="submit" id="btn-submit">
            <span class="glyphicon glyphicon-log-in"></span> Filter Post
        </button>
    </form>
    <ul id="ajax_filter_search_results"></ul>
</div>

<?php
return ob_get_clean();
}

add_shortcode('my_ajax_filter_search', 'my_ajax_filter_search_shortcode');

add_action('wp_ajax_my_ajax_filter_search', 'my_ajax_filter_search_callback');
add_action('wp_ajax_nopriv_my_ajax_filter_search', 'my_ajax_filter_search_callback');

function my_ajax_filter_search_callback()
{

    header("Content-Type: application/json");

    $meta_query = array('relation' => 'AND');

    if (isset($_GET['year'])) {
        $year = sanitize_text_field($_GET['year']);
        $meta_query[] = array(
            'key' => 'year',
            'value' => $year,
            'compare' => '=',
        );
    }

    if (isset($_GET['rating'])) {
        $rating = sanitize_text_field($_GET['rating']);
        $meta_query[] = array(
            'key' => 'rating',
            'value' => $rating,
            'compare' => '>=',
        );
    }

    if (isset($_GET['language'])) {
        $language = sanitize_text_field($_GET['language']);
        $meta_query[] = array(
            'key' => 'language',
            'value' => $language,
            'compare' => '=',
        );
    }

    if (isset($_GET['wp_post_status'])) {
        $wp_post_status[] = sanitize_text_field($_GET['wp_post_status']);
    }

    $tax_query = array();

    if (isset($_GET['genre'])) {
        $genre = sanitize_text_field($_GET['genre']);
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $genre,
        );
    }

    $args = array(
        'post_type' => 'movie',
        'posts_per_page' => -1,
        'post_status' => $wp_post_status,
        'meta_query' => $meta_query,
        'tax_query' => $tax_query,
    );

    if (isset($_GET['search'])) {
        $search = sanitize_text_field($_GET['search']);
        $search_query = new WP_Query(array(
            'post_type' => 'movie',
            'post_status' => $wp_post_status,
            'posts_per_page' => -1,
            'meta_query' => $meta_query,
            'tax_query' => $tax_query,
            's' => $search,
        ));
    } else {
        $search_query = new WP_Query($args);
    }

    if ($search_query->have_posts()) {

        $result = array();

        while ($search_query->have_posts()) {
            $search_query->the_post();

            $cats = strip_tags(get_the_category_list(", "));
            $result[] = array(
                "id" => get_the_ID(),
                "title" => get_the_title(),
                "content" => get_the_content(),
                "permalink" => get_permalink(),
                "year" => get_field('year'),
                "rating" => get_field('rating'),
                "director" => get_field('director'),
                "language" => get_field('language'),
                "genre" => $cats,
                "poster" => wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'full'),
            );
        }
        wp_reset_query();

        echo json_encode($result);

    } else {
        // no posts found
    }
    wp_die();
}

use Dompdf\Dompdf;

if (!empty($_POST['submit_dom'])) {
    $roll = $_POST['rollno'];
    $fname = $_POST['fname'];
    $sex = $_POST['sex'];
    $sports_game = $_POST['sport_game'];
    $age_group = $_POST['age_group'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $saving_amount = $_POST['saving_amount'];
    $retirement_getting_amount = $_POST['retirement_getting_amount'];
    $retirement_monthly_amount = $_POST['retirement_monthly_amount'];
    $currency = $_POST['currency'];
    $current_age = $_POST['current_age'];
    $desired_retirement_age = $_POST['desired_retirement_age'];
    $Current_Retirement_Savings = $_POST['Current_Retirement_Savings'];
    $Monthly_Contribution = $_POST['Monthly_Contribution'];
    $First_Year_of_Retirement_Expenses = $_POST['First_Year_of_Retirement_Expenses'];
    $Expected_Annual_Inflation_Rate = $_POST['Expected_Annual_Inflation_Rate'];
    $PreRetirement_Estimated_Annual_Rate_of_Return = $_POST['PreRetirement_Estimated_Annual_Rate_of_Return'];
    $Post_Retirement_Estimated_Annual_Rate_of_Return = $_POST['Post_Retirement_Estimated_Annual_Rate_of_Return'];
    /* print_r($_POST); */
    $path = '/var/www/html/postapproval/wp-content/themes/twentytwenty/autoreply_logo.png';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    $pathforgroupimage = '/var/www/html/postapproval/wp-content/themes/twentytwenty/pdf_group_image.png';
    $type_second = pathinfo($pathforgroupimage, PATHINFO_EXTENSION);
    $data_second = file_get_contents($pathforgroupimage);
    $base64_group_image = 'data:image/' . $type_second . ';base64,' . base64_encode($data_second);

    $pathforqrcode = '/var/www/html/postapproval/wp-content/themes/twentytwenty/ri_1.png';
    $type_third = pathinfo($pathforqrcode, PATHINFO_EXTENSION);
    $data_third = file_get_contents($pathforqrcode);
    $base64_qrcode = 'data:image/' . $type_second . ';base64,' . base64_encode($data_third);

    $pathforgraph = '/var/www/html/postapproval/wp-content/themes/twentytwenty/recentsubmited.png';
    $type_fourth = pathinfo($pathforgraph, PATHINFO_EXTENSION);
    $data_fourth = file_get_contents($pathforgraph);
    $base64_graph = 'data:image/' . $type_fourth . ';base64,' . base64_encode($data_fourth);

    $table_data['age'] = [21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42];
    $table_data['savings'] = [10000, 11000, 12000, 13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000, 21000, 22000, 23000, 24000, 25000, 26000, 27000, 28000, 29000, 30000, 31000, 32000, 10000, 11000, 12000, 13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000, 21000, 22000, 23000, 24000, 25000, 26000, 27000, 28000, 29000, 30000, 31000, 32000];
    $table_data['expenses'] = [2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 10000, 11000, 12000, 13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000, 21000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 10000, 11000, 12000, 13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000, 21000];

    $html = "<html>
	<head>

	  <style>
		@page { margin: 50px 25px; }
		header { position: fixed; top: -20px; left: 0px; right: 0px; height: 50px; line-height: 0.5; font-weight: bold;}
        .header_text_wrapper {
            display: flex;
            flex-direction: column;
            float: left;
        }
        .h_text1 {
            color: rgb(102, 224, 255);
            float: left;
            margin-bottom: 10px;
        }
        .h_text2 {
            color: rgb(95, 95, 95);
            margin-top: 20px;
            float: left;
        }
        hr {
            clear: both;
        }
        span.cls_002{font-family:Arial,serif;font-size:25.1px;color:rgb(0,176,219);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_002{font-family:Arial,serif;font-size:25.1px;color:rgb(0,176,219);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_003{font-family:Arial,serif;font-size:25.1px;color:rgb(109,110,112);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_003{font-family:Arial,serif;font-size:25.1px;color:rgb(109,110,112);font-weight:normal;font-style:normal;text-decoration: none}
        .h_image {
            float: right;
            width: 250px;
            height: 75px;
			margin-left: 500px;
        }
        .box1 {
            width: 40%;
            height: 200px;
            display: inline-block;
            border: 1.5px solid rgb(0,176,219);
            margin-top: 0px;
			padding: 8px;
        }
		.box2_table {
           font-size: 9px;
       }
        .box2 {
            width: 49.5%;
            height: 200px;
            display: inline-block;
            border: 1.5px solid rgb(175, 175, 175);
            margin-left: 30px;
			background-color: white;
			padding: 8px;
        }
        .container {
            margin-top: 100px;
        }
        .details {
            background-color: #F4F5F6;
            padding: 0px 50px 20px 50px;
        }
        .graph {
            width: 85%;
            height: 250px;
        }
		.graph_image{
			width: 600px;
			height: 250px;
		}
        .graph-table {
            background-color: rgb(255, 255, 255);
            margin-top: 15px;
            padding: 10px;
        }
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        text-align: left;
        padding: 2px;
        }
        th {
            border: 2px solid white;
        }
        .table_row_color:nth-child(even) {
        background-color: #dddddd;
        }
		.details_image {
            background-color: #0D212F;
            padding: 0px 50px 20px 50px;
        }
		.details_image .block1{
			float: left;
		}

		.details_image .block1{
			float: right;
		}

		.g_image{
			float: left;
            width: 290px;
            height: 140px;
			margin-right: 15px;
			background-color: #0D212F ;
			margin-top: 15px;
		}
		.details_image .main_container{
			height: 150px;
		}

		.block2{
			width: 215px;
			margin-left: 340px;
		}
		.block3{
			margin-left: 650px;
			margin-bottom: 50px;
		}
		/* .table tr:nth-child(2n)
        {
            page-break-after: always;
        } */
        .page_break { page-break-before: always; }
        .table2 {
            margin-top: 0px;
        }

	  </style>
	</head>
	<body>
        <header>
        <div style='position:absolute;left:26.87px;top:14.83px' class='cls_002'>
            <span class='cls_002'>RETIREMENT</span>
        </div>
        <div style='position:absolute;left:26.87px;top:40.03px' class='cls_003'>
            <span class='cls_003'>CALCULATOR REPORT</span>
        </div>


            <img class='h_image' src='$base64' alt='test123'>
            <hr style='height: 5px;background: #16243A;'>
        </header>
	  <main>
        <div  class='container'>
                <h4>Find out if you’re on track for retirement</h4>
                <p>The goal of this report is to help you determine the amount of money that you will need to save monthly to fund your retirement
                    financial objectives. Time, your monthly savings amount and the estimated rate of return are very important factors in planning
                    for your future.</p>
        </div>
        <div class='details' >
            <p style='font-size:14px ;font-weight: bold;'>$fname $lname,</p>
			<p style='margin-top: -10px;'>The following results are based on your inputs</p>
            <div  class='box1'>
               <div>
				   <p style='font-size: 12px;margin: 0px;padding: 0px;margin-left: 5px;margin-right: 5px;margin-top: 5px;'>To meet your retirement goals, at the time of retirement you will need a savings of:</p>
				   <p style='font-weight: bold;font-size: 22px;margin: 0px;padding: 0px;color: #3A3A3A;margin-left: 10px;'>$$saving_amount</p>
               </div>
               <hr style='color: #BCBEC0;height: 2px;'>
               <div>
				<p style='font-size: 12px;margin: 0px;padding: 0px;margin-left: 5px;margin-right: 5px;'>With the selected monthly contribution, your savings at retirement will be:</p>
				<p style='font-weight: bold;font-size: 22px;margin: 0px;padding: 0px;color: #3A3A3A;margin-left: 10px;'>$$retirement_getting_amount</p>
               </div>
               <hr style='color: #BCBEC0;height: 2px;'>
               <div>
				<p style='font-size: 12px;margin: 0px;padding: 0px;margin-left: 5px;margin-right: 5px;'>If you start saving now, to meet your retirement goals,your monthly saving should be:</p>
				<p style='font-weight: bold;font-size: 22px;margin: 0px;padding: 0px;color: #22B2DB;margin-left: 10px;'>$$retirement_monthly_amount</p>
               </div>
            </div>
            <div class='box2' >
                <p style='color: rgb(0,176,219); font-size: 15px;'>
                    Your Retirement Plan Inputs
                </p>
                <hr style='color: #BCBEC0;height: 2px;'>
                <table class='box2_table'>
                    <tr>
                        <td>Currency</td>
                        <td>$currency</td>
                    </tr>
                    <tr>
                        <td>Current Age</td>
                        <td>$current_age</td>
                    </tr>
                    <tr>
                        <td>Desired Retirement Age</td>
                        <td>$desired_retirement_age</td>
                    </tr>
                    <tr>
                        <td>Current Retirement Savings</td>
                        <td>$Current_Retirement_Savings</td>
                    </tr>

                    <tr>
                        <td>Monthly Contribution</td>
                        <td>$Monthly_Contribution</td>
                    </tr>
                    <tr>
                        <td>First Year of Retirement Expenses</td>
                        <td>$First_Year_of_Retirement_Expenses</td>
                    </tr>
                    <tr>
                        <td>Expected Annual Inflation Rate</td>
                        <td>$Expected_Annual_Inflation_Rate</td>
                    </tr>
                    <tr>
                        <td>Pre-Retirement Estimated Annual Rate of Return</td>
                        <td>$PreRetirement_Estimated_Annual_Rate_of_Return</td>
                    </tr>
                    <tr>
                        <td>Post Retirement Estimated Annual Rate of Return</td>
                        <td>$Post_Retirement_Estimated_Annual_Rate_of_Return</td>
                    </tr>
                </table>
            </div>
            <div class='graph-table' >
                <span>
                    Retirement Savings Over Time
                </span>

                <div class='graph' >
					<img class='graph_image' src='$base64_graph' alt='test123'>
				</div>

                <div class='table'>

				<table>
                <tr>
                    <th align='center' style='background-color: #317996;color: white;'>Year</th>
                    <th align='center' style='background-color: #265F7D;color: white'>Age</th>
                    <th align='center' style='background-color: #9FB4C0;color: white'>Saving</th>
                    <th align='center' style='background-color: #5E6771;color: white'>Expenses</th>
                </tr>";

    for ($year = 0; $year < 9; $year++) {
        # code...
        $html .=
            '<tr class="table_row_color">
                                <td style="font-size: 11px;padding:0px; margin:0px;" align="center">' . $year . '</td>
                                <td style="font-size: 11px;padding:0px; margin:0px;" align="center">' . $table_data['age'][$year] . '</td>
                                <td style="font-size: 11px;padding:0px; margin:0px;" align="center">' . $table_data['savings'][$year] . '</td>
                                <td style="font-size: 11px;padding:0px; margin:0px;" align="center">' . $table_data['expenses'][$year] . '</td>
                            </tr>';
    }

    $html .= "</table>
                </div>
            </div>
        </div>

            <div class='page_break'></div>
            <div >
                <br>
                <br>
                <br>
                <br>
                <br>
        </div>
            <div class='details' style='margin-top: 15px;'>
                <div class='graph-table' >
                    <p>
                        Retirement Savings Over Time
                    </p>
                    <div class='table'>
					<table>
					<tr>
						<th align='center' style='background-color: #317996;color: white'>Year</th>
						<th align='center' style='background-color: #265F7D;color: white'>Age</th>
						<th align='center' style='background-color: #9FB4C0;color: white'>Saving</th>
						<th align='center' style='background-color: #5E6771;color: white'>Expenses</th>
					</tr>";

    for ($year = 9; $year < 44; $year++) {
        # code...
        $html .=
            '<tr  class="table_row_color">
									<td style="font-size: 11px;padding:0px; margin:0px;" align="center">' . $year . '</td>
									<td style="font-size: 11px;padding:0px; margin:0px;" align="center">' . $table_data['age'][$year] . '</td>
									<td style="font-size: 11px;padding:0px; margin:0px;" align="center">' . $table_data['savings'][$year] . '</td>
									<td style="font-size: 11px;padding:0px; margin:0px;" align="center">' . $table_data['expenses'][$year] . '</td>
								</tr>';
    }

    $html .= "</table>
                    </div>
                </div>
            </div>


			<div class='details_image' style='margin-top: 10px;'>
			<table border='0' class='main_container' style='background-color: #0D212F;'>
				<tr>
					<th class='block1'><img class='g_image' src='$base64_group_image' alt='Start Planning Today'> </th>
					<th class='block2' style='margin-top: 30px;'>
						<p style='color: white;font-size: 16px;font-weight: bold;'>Start Planning Today</p>
						<p style='color: white;font-size: 12px;'>If you're interested in saving for your retirement, find out more about Investors Trust’s Regular Savings Plan by visiting www.investors-trust.com.</p>
					</th>
					<th class='block3' align='right'>
						<img class='qr_image' src='$base64_qrcode' alt='QR Code'>
					</th>
				</tr>
			</table>
			</div>

			<div class='Important_Disclosures' >
				<p style='font-weight: bold;font-size: 12px;'>Important Disclosures</p>
				<p style='font-size: 10px;'>This interactive calculator is for informational purposes only. The rate of returns indicated abvoe are hypotetical and for illustration purposese and are not intended to represent any specific
					investment. The value of any investment and the income from it can fall as well as rise, as a result of market and currency fluctuations and you may not get back the amount orinigally
					invested. Nothing contained in this interactive calculator should be as guidance to the suitability of any investment. Anyone considering investing in these products should seek professional
					guidance.</p>
			</div>

	  </main>
	</body>
	</html>";

/*     $html .= "<h1>$fname</h1>";
$html .= "<h1>$sex</h1>";
$html .= "<h1>$sports_game</h1>";
$html .= "<h1>$age_group</h1>";
$html .= "<h1>$lname</h1>";
$html .= "<h1>$email</h1>"; */

    require_once 'dompdf/autoload.inc.php';

    $dompdf = new Dompdf();
    $dompdf->set_option('enable_html5_parser', true);

    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');
    // Render the HTML as PDF
    $dompdf->render();

    $to = 'rajan.panchal@creolestudios.com';
    $subject = "PDF Attachement";
    $body = "$roll is rollnumber of $fname $lname which sex is $sex & email id is $email. $fname like $sports_game. Age of $fname $lname Between $age_group. ";
    $separator = md5(time());
    $headers = "MIME-Version: 1.0";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"";
    $headers .= "Content-Transfer-Encoding: 7bit";
    $headers .= 'From: <rajan.panchal51196@gmail.com>' . "\r\n";

    $output = $dompdf->output();

    $name = $fname . '' . $lname . '.pdf';

    $roller = file_put_contents("/var/www/html/postapproval/wp-content/themes/twentytwenty/" . $name, $output);

    $attachments = array(WP_CONTENT_DIR . "/themes/twentytwenty/$name");

    wp_mail($to, $subject, $body, $headers, $attachments);

}

if (!empty($_POST['submit_jpgraph'])) {
    $value_1_max = $_POST['value_1_max'];
    $value_1_min = $_POST['value_1_min'];
    $value_2_max = $_POST['value_2_max'];
    $value_2_min = $_POST['value_2_min'];
    $value_3_max = $_POST['value_3_max'];
    $value_3_min = $_POST['value_3_min'];
    $value_4_max = $_POST['value_4_max'];
    $value_4_min = $_POST['value_4_min'];
    $value_5_max = $_POST['value_5_max'];
    $value_5_min = $_POST['value_5_min'];

    $jpgraph = require_once '../jpgraph/src/jpgraph.php';
    $jpgraph_bar = require_once '../jpgraph/src/jpgraph_bar.php';

    $data1y = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20);
    $data2y = array(20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0);

    // Create the graph. These two calls are always required
    $graph = new Graph(400, 200);
    $graph->clearTheme();
    $graph->SetScale("textlin");

    // $graph->SetShadow();
    $graph->img->SetMargin(60, 10, 40, 40);

    // Create the bar plots
    $b1plot = new BarPlot($data1y);
    $b1plot->SetFillColor("orange");
    $b2plot = new BarPlot($data2y);
    $b2plot->SetFillColor("blue");

    // Create the grouped bar plot
    $gbplot = new GroupBarPlot(array($b1plot, $b2plot));

    // ...and add it to the graPH
    $graph->Add($gbplot);

    $graph->title->Set("Example 21");
    $graph->yaxis->title->Set("Y-title");

    $graph->xaxis->SetTitle('X-title', 'center');
    $graph->xaxis->SetTitleMargin(10);
    $graph->xaxis->title->SetFont(FF_FONT2, FS_BOLD);

    // $graph->xaxis->title->SetMargin(50,50,60,40);

    $graph->title->SetFont(FF_FONT1, FS_BOLD);
    $graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);
    $graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD);

    // Display the graph
    // $graph->Stroke();
    $graph->Stroke('/var/www/html/postapproval/wp-content/themes/twentytwenty/recentsubmited.png');
}

if (!empty($_POST['button_dom_with_pdf'])) {
    $name = $_POST['name'];
    $currency = $_POST['currency'];
    $current_age = $_POST['current_age'];
    $desired_age = (float) $_POST['desired_age'];
    $current_saving = (float) $_POST['current_saving'];
    $monthly_contribution = (float) $_POST['monthly_contribution'];
    $first_year_expenses = (float) $_POST['first_year_expenses'];
    $expected_inflation_rate = (float) $_POST['expected_inflation_rate'];
    $pre_rate_of_return = (float) $_POST['pre_rate_of_return'];
    $post_rate_of_return = (float) $_POST['post_rate_of_return'];

    $rate = ($pre_rate_of_return / 12) / 100;
    $periods = 12;
    $type = 1;
    $savings = $expenses = $age = array();
    $future_value = $current_saving;

    for ($year = $current_age; $year < $desired_age; $year++) {
        array_push($savings, $future_value);
        $expense = 0;

        // Savings Calculation
        $initial = 1 + ($rate * $type);
        $compound = \pow(1 + $rate, $periods);
        $future_value = (($future_value * $compound) + (($monthly_contribution * $initial * ($compound - 1)) / $rate));
        $future_value = round($future_value, 2);
        array_push($expenses, $expense);
        array_push($age, $year);
    }

    $saving_amount = number_format((int) $future_value);
    $expense = $first_year_expenses;
    $graph_savings = $savings;
    $retirement_expenses = $count = 0;

    for ($year = $desired_age; $year < $desired_age + 20; $year++) {
        array_push($expenses, $expense);
        array_push($savings, $future_value);
        $graph_future_value = $future_value;

        if ($future_value < 0) {
            $graph_future_value = 0;
        }
        array_push($graph_savings, $graph_future_value);

        // Retirement expenses calculation at time zero
        $retirement_expenses = $retirement_expenses + ($expense / pow((1 + (($post_rate_of_return) / 100)), $count));

        // Expenses Calculation
        $future_value = ($future_value - $expense) * (1 + (($post_rate_of_return) / 100));
        $future_value = round($future_value, 2);
        $expense = $expense * 1.02;
        $expense = round($expense, 2);
        array_push($age, $year);
        $count++;
    }

    $num_of_payments = ($desired_age - $current_age) * 12;
    $present_value = -$current_saving;
    $future_value = $retirement_expenses;
    $initial = pow((1 + $rate), $num_of_payments);
    $retirement_expenses = number_format($retirement_expenses);
    $expected_monthly_saving = ($present_value * $rate * $initial / ($initial - 1) + $rate / ($initial - 1) * $future_value) * (1 / ($rate + 1));

    // include jpgraph for graph generation
    require_once get_template_directory() . ('/jpgraph/src/jpgraph.php');
    require_once get_template_directory() . ('/jpgraph/src/jpgraph_bar.php');

    $data1y = $graph_savings;
    $data2y = $expenses;
    $graph = new Graph(900, 250);
    $graph->clearTheme();
    $graph->SetScale("textlin");
    $graph->SetFrame(false);
    $graph->SetBox(false);
    $graph->img->SetMargin(60, 20, 20, 20);
    $graph->xaxis->SetTitle('Age', 'center');
    $graph->xaxis->SetTickLabels($age);
    $graph->xaxis->HideTicks(true, true);

    $b1plot = new BarPlot($data1y);
    $b1plot->SetColor("white");
    $b1plot->SetFillColor("#00b0db");
    $b2plot = new BarPlot($data2y);
    $b2plot->SetColor("white");
    $b2plot->SetFillColor("#005063");

    $gbplot = new GroupBarPlot(array($b1plot, $b2plot));

    $graph->Add($gbplot);
    $graph->Stroke('/var/www/html/postapproval/wp-content/themes/twentytwenty/graph.png');

    // pdf generation

    $pathforgroupimage = '/var/www/html/postapproval/wp-content/themes/twentytwenty/pdf_group_image.png';
    $type_second = pathinfo($pathforgroupimage, PATHINFO_EXTENSION);
    $data_second = file_get_contents($pathforgroupimage);
    $base64_group_image = 'data:image/' . $type_second . ';base64,' . base64_encode($data_second);

    $pathforgraph = '/var/www/html/postapproval/wp-content/themes/twentytwenty/graph.png';
    $type_second = pathinfo($pathforgraph, PATHINFO_EXTENSION);
    $data_second = file_get_contents($pathforgraph);
    $base64_graph = 'data:image/' . $type_second . ';base64,' . base64_encode($data_second);

    $pathforqrcode = '/var/www/html/postapproval/wp-content/themes/twentytwenty/ri_1.png';
    $type_second = pathinfo($pathforqrcode, PATHINFO_EXTENSION);
    $data_second = file_get_contents($pathforqrcode);
    $base64_qrcode = 'data:image/' . $type_second . ';base64,' . base64_encode($data_second);

    $pathforlogo = '/var/www/html/postapproval/wp-content/themes/twentytwenty/autoreply_logo.png';
    $type_second = pathinfo($pathforlogo, PATHINFO_EXTENSION);
    $data_second = file_get_contents($pathforlogo);
    $base64_logo = 'data:image/' . $type_second . ';base64,' . base64_encode($data_second);

    $table_data = array();
    $table_data['age'] = $age;
    $table_data['savings'] = $savings;
    $table_data['expenses'] = $expenses;

    $html = "<html>
    <head>
      <style>
			/*! Generated by Font Squirrel (https://www.fontsquirrel.com) on November 12, 2021 */



		@font-face {
			font-family: sf_pro_display;
			src: url('/var/www/html/postapproval/wp-content/themes/twentytwenty/assets/fonts/sfprodisplaybold.woff2') format('woff2'),
				url('/var/www/html/postapproval/wp-content/themes/twentytwenty/assets/fonts/sfprodisplaybold.woff') format('woff');
			font-weight: 700;
			font-style: normal;

		}




		@font-face {
			font-family: sf_pro_display;
			src: url('/var/www/html/postapproval/wp-content/themes/twentytwenty/assets/fonts/sfprodisplaysemibolditalic.woff2') format('woff2'),
				url('/var/www/html/postapproval/wp-content/themes/twentytwenty/assets/fonts/sfprodisplaysemibolditalic.woff') format('woff');
			font-weight: 600;
			font-style: normal;

		}




		@font-face {
			font-family: sf_pro_display;
			src: url('/var/www/html/postapproval/wp-content/themes/twentytwenty/assets/fonts/sfprodisplayregular.woff2') format('woff2'),
				url('/var/www/html/postapproval/wp-content/themes/twentytwenty/assets/fonts/sfprodisplayregular.woff') format('woff');
			font-weight: 400;
			font-style: normal;

		}
        @page {
            margin: 50px 25px 10px 25px;
        }
        header {
            position: fixed;
            top: -20px;
            left: 0px;
            right: 0px;
            height: 50px;
            line-height: 0.5;
            font-weight: bold;
        }

        .header_text_wrapper {
            display: flex;
            flex-direction: column;
            float: left;
        }

        .h_text1 {
            color: rgb(102, 224, 255);
            float: left;
            margin-bottom: 10px;
        }

        .h_text2 {
            color: rgb(95, 95, 95);
            margin-top: 20px;
            float: left;
        }

        hr {
            clear: both;
        }

        span.cls_002{
            font-family:sf_pro_display,sans-serif;
			font-size:26px;
			font-weight: 700;
            color:rgb(0,176,219);
            font-style:normal;
            text-decoration: none
        }

        div.cls_002{
            font-family:sf_pro_display,sans-serif;
            font-size:26px;
            color:rgb(0,176,219);
            font-weight: 700;
            font-style:normal;
            text-decoration: none
        }

        span.cls_003{
			font-family:sf_pro_display,sans-serif;
            font-size:26px;
            color:rgb(109,110,112);
            font-weight: 400;
            font-style:normal;
            text-decoration: none;
			letter-spacing: 0;

        }

        div.cls_003{
            font-family:sf_pro_display,sans-serif;
            font-size:26px;
            color:rgb(109,110,112);
            font-weight: 400;
            font-style:normal;
            text-decoration: none;
			letter-spacing: 0;
        }

        .h_image {
            /* display: inline-block; */
            float: right;
            width: 221px;
            height: 42px;
        }

        .box1 {
            width: 40%;
            height: 200px;
            display: inline-block;
            border: 1.5px solid rgb(0,176,219);
            padding: 10px;
            margin-top: 0px;
        }

        .box2 {
            width: 49.5%;
            height: 200px;
            display: inline-block;
            border: 1.5px solid rgb(175, 175, 175);
            background-color: white;
            margin-left: 20px;
            padding: 10px;
        }

        .container {
            margin-top: 45px;

        }

        .details {
            background-color: #F4F5F6;
            padding: 0px 30px 20px 30px;
        }

        .graph {
            width: 85%;
            height: 200px;
        }

        .graph-table {
            background-color: rgb(255, 255, 255);
            margin-top: 15px;
            padding: 5px;
        }

        table {
            font-family:sf_pro_display,sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .details_image {
            background-color: #0D212F;
            padding: 0px 15px 20px 25px;
        }

        .details_image .block1{
            float: left;
        }

        .details_image .block1{
            float: right;
        }

        .g_image{
            float: left;
            width: 290px;
            height: 140px;
            margin-right: 15px;
            background-color: #0D212F ;
            margin-top: 15px;
        }

        .details_image .main_container{
            height: 150px;
        }

        .block2{
            width: 215px;
            margin-left: 340px;
        }
        .block3{
            margin-left: 750px;
            margin-bottom: 50px;
        }

        td, th {
        text-align: left;
        padding: 2px;
        }

        th {
            border: 2px solid white;
        }

        .table_row:nth-child(even) {
        background-color: #F2F2F3;
        }


        .page_break {
             page-break-before: always;
        }

        .table2 {
            margin-top: 0px;
        }

       .box2_table {
           font-size: 10px;
       }

       .box2_table td {
           width: 50%;
       }
	   .qr_image{
	   height: 75px;
	   width: 75px;
		}
      </style>
    </head>
    <body>
        <header>
        <div style='position:absolute;left:26.87px;top:14.83px; margin: 0px; padding: 0px; ' class='cls_002'>
            <span class='cls_002'>RETIREMENT</span>
        </div>
        <div style='position:absolute;left:26.87px;top:40.03px; margin: 0px; padding: 0px;' class='cls_003'>
            <span class='cls_003'>CALCULATOR REPORT</span>
        </div>
            <img style='margin: 0px; padding: 0px;' class='h_image' src='$base64_logo'>
            <hr style='height: 5px;background: #16243A;'>
        </header>
      <main>
        <div  class='container'>
                <h4 style='margin-bottom: 2px; padding-bottom: 2px;'>Find out if you’re on track for retirement</h4>
                <p style='margin-top: 0px; padding-top: 0px;'>The goal of this report is to help you determine the amount of money that you will need to save monthly to fund your retirement
                    financial objectives. Time, your monthly savings amount and the estimated rate of return are very important factors in planning
                    for your future.</p>
        </div>
        <div class='details' >
            <h3 style='margin-bottom: 2px; padding-bottom: 2px;'>$name,</h3>
            <p style='margin-top: 0px; padding-top: 0px;'>The following results are based on your inputs.</p>
            <div class='box1'>
                <div>
                    <p style='font-size: 11px;margin: 0px;padding: 0px;font-family:sf_pro_display,sans-serif;'>To meet your retirement goals, at the time of retirement you will need a savings of:</p>
                    <p style='font-weight: bold;font-size: 21px;margin: 0px;padding: 0px;font-family:sf_pro_display,sans-serif;font-weight: 700;'>$$retirement_expenses</p>
                </div>
                <hr>
                <div>
                 <p style='font-size: 11px;margin: 0px;padding: 0px;font-family:sf_pro_display,sans-serif;'>With the selected monthly contribution, your savings at retirement will be:</p>
                 <p style='font-weight: bold;font-size: 21px;margin: 0px;padding: 0px;font-family:sf_pro_display,sans-serif;font-weight: 700;'>$$saving_amount</p>
                </div>
                <hr>
                <div>
                 <p style='font-size: 11px;margin: 0px;padding: 0px;font-family:sf_pro_display,sans-serif;'>If you start saving now, to meet your retirement goals,your monthly saving should be:</p>
                 <p style='font-weight: bold;font-size: 21px;margin: 0px;padding: 0px; color: #00b0db;font-family:sf_pro_display,sans-serif;font-weight: 700;'>$$expected_monthly_saving</p>
                </div>
             </div>
            <div class='box2'>
                <p style='color: rgb(0,176,219); font-size: 15px; margin: 0px; padding: 0px;font-family:sf_pro_display,sans-serif;'>
                    Your Retirement Plan Inputs
                </p>
                <hr>
                <table class='box2_table'>
                    <tr>
                        <td>Currency</td>
                        <td align='center'>$currency</td>
                    </tr>
                    <tr>
                        <td>Current Age</td>
                        <td align='center'>$current_age</td>
                    </tr>
                    <tr>
                        <td>Desired Retirement Age</td>
                        <td align='center'>$desired_age</td>
                    </tr>
                    <tr>
                        <td>Current Retirement Savings</td>";
    $current_saving_convert = number_format($current_saving, 0, ',', ',');
    $first_year_expenses_convert = number_format($first_year_expenses, 0, ',', ',');
    $expected_inflation_rate_convert = number_format($expected_inflation_rate, 2, '.', '.') . '%';
    $pre_rate_of_return_convert = number_format($pre_rate_of_return, 2, '.', '.') . '%';
    $post_rate_of_return_convert = number_format($post_rate_of_return, 2, '.', '.') . '%';
    $html .= "<td align='center'>$currency $current_saving_convert</td>
                    </tr>
                    <tr>
                        <td>Monthly Contribution</td>
                        <td align='center'>$currency $monthly_contribution</td>
                    </tr>
                    <tr>
                        <td>First Year of Retirement Expenses</td>
                        <td align='center'>$currency $first_year_expenses_convert</td>
                    </tr>
                    <tr>
                        <td>Expected Annual Inflation Rate</td>
                        <td align='center'>$expected_inflation_rate_convert</td>
                    </tr>
                    <tr>
                        <td>Pre-Retirement Estimated
                            Annual Rate of Return</td>
                        <td align='center'>$pre_rate_of_return_convert</td>
                    </tr>
                    <tr>
                        <td>Post Retirement Estimated
                            Annual Rate of Return</td>
                        <td align='center'>$post_rate_of_return_convert</td>
                    </tr>
                </table>
            </div>
            <div class='graph-table' >
                <span>
                    Retirement Savings Over Time
                </span>

                <div class='graph'>
                    <img style='width: 650px; height: 190px;' src='$base64_graph'>
                </div>
                <div class='table'>

                <table>
                <tr>
                    <th style='background-color: #317996; color:white;' align='center'>Year</th>
                    <th style='background-color: #265F7D; color:white;' align='center'>Age</th>
                    <th style='background-color: #9FB4C0; color:white;' align='center'>Saving</th>
                    <th style='background-color: #5E6771; color:white;' align='center'>Expenses</th>
                </tr>";
    $text_color = '#252525';
    for ($year = 0; $year < 26; $year++) {
        if ($table_data['savings'][$year] < 0) {
            $table_data['savings'][$year] = '(' . abs($table_data['savings'][$year]) . ')';
            $text_color = 'red';
        }
        $html .=
        '<tr class="table_row">
                                <td  style="color: rgb(37, 37, 37);font-size: 9px;padding:0px; font-weight: 100; margin:0px;" align="center">' . $year . '</td>
                                <td  style="color: rgb(37, 37, 37);font-size: 9px;padding:0px; font-weight: 100; margin:0px;" align="center">' . $table_data['age'][$year] . '</td>
                                <td style="color:' . $text_color . ';font-size: 9px;padding:0px; font-weight: 100; margin:0px;" align="right">$' . number_format($table_data['savings'][$year], 3, ',', ',') . '</td>
                                <td style="color: rgb(37, 37, 37);font-size: 9px;padding:0px; font-weight: 100; margin:0px;" align="right">$' . $table_data['expenses'][$year] . '</td>
                            </tr>';
    }

    $html .= "</table>
                </div>
            </div>
        </div>

            <div class='page_break'></div>
            <div >
                <br>
                <br>
                <br>

        </div>
            <div class='details' style='margin-top: 0px;'>
                <div class='graph-table' >
                    <p>
                        Retirement Savings Over Time
                    </p>
                    <div class='table'>
                    <table>
                    <tr>
                        <th style='background-color: #317996; color:white;' align='center'  >Year</th>
                        <th style='background-color: #265F7D; color:white;' align='center' >Age</th>
                        <th style='background-color: #9FB4C0; color:white;' align='center' >Saving</th>
                        <th style='background-color: #5E6771; color:white;' align='center' >Expenses</th>
                    </tr>";
    $age_limit = $desired_age + 20 - $current_age;
    for ($year = 26; $year < $age_limit; $year++) {
        if ($table_data['savings'][$year] < 0) {
            $table_data['savings'][$year] = '(' . abs($table_data['savings'][$year]) . ')';
            $text_color = 'red';
        }
        $html .=
            '<tr class="table_row">
                                    <td style="  color: rgb(37, 37, 37); font-size: 9px;padding:0px; font-weight: 100; margin:0px;" align="center">' . $year . '</td>
                                    <td style=" color: rgb(37, 37, 37);font-size: 9px;padding:0px; font-weight: 100; margin:0px;" align="center">' . $table_data['age'][$year] . '</td>
                                    <td style=" color: ' . $text_color . ';font-size: 9px;padding:0px; font-weight: 100; margin:0px;" align="right">$' . $table_data['savings'][$year] . '</td>
                                    <td style=" color: rgb(37, 37, 37);font-size: 9px;padding:0px; font-weight: 100; margin:0px;" align="right">$' . $table_data['expenses'][$year] . '</td>
                                </tr>';
    }

    $html .= "</table>
                    </div>
                </div>
            </div>

            <div class='details_image' style='margin-top: 15px;'>
            <table border='0' class='main_container' style='background-color: #0D212F;'>
                <tr>
                    <th class='block1'><img class='g_image' src='$base64_group_image' alt='Start Planning Today'> </th>
                    <th class='block2' style='margin-top: 30px;'>
                        <p style='color: white;font-size: 16px;font-weight: bold;font-family:sf_pro_display,sans-serif;font-weight: 600;'>Start Planning Today</p>
                        <p style='color: white;font-size: 12px;font-family:sf_pro_display,sans-serif;font-weight: 400;'>If you're interested in saving for your retirement, find out more about Investors Trust’s Regular Savings Plan by visiting www.investors-trust.com.</p>
                    </th>
                    <th class='block3'>
                        <img class='qr_image' style='float: right;margin-top:70px;'  src='$base64_qrcode' alt='QR Code'>
                    </th>
                </tr>
            </table>
            </div>

            <div class='Important_Disclosures' style='margin-top: 15px;'>
                <p style='font-weight: bold;font-size: 12px;margin: 0px;font-family:sf_pro_display,sans-serif;font-weight: 700;'>Important Disclosures</p>
                <p style='font-size: 10px;margin: 0px;font-family:sf_pro_display,sans-serif;font-weight: 400;'>This interactive calculator is for informational purposes only. The rate of returns indicated abvoe are hypotetical and for illustration purposese and are not intended to represent any specific
                    investment. The value of any investment and the income from it can fall as well as rise, as a result of market and currency fluctuations and you may not get back the amount orinigally
                    invested. Nothing contained in this interactive calculator should be as guidance to the suitability of any investment. Anyone considering investing in these products should seek professional
                    guidance.</p>
            </div>

      </main>
    </body>
    </html>";

    require_once 'dompdf/autoload.inc.php';

    $dompdf = new Dompdf();
    $dompdf->set_option('enable_html5_parser', true);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $to = 'rajan.panchal@creolestudios.com';
    $subject = "PDF Attachement";

    $separator = md5(time());
    $headers = "MIME-Version: 1.0";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"";
    $headers .= "Content-Transfer-Encoding: 7bit";
    $headers .= 'From: <rajan.panchal51196@gmail.com>' . "\r\n";

    $output = $dompdf->output();
    $file_name = $name . '.pdf';
    $data = file_put_contents("/var/www/html/postapproval/wp-content/themes/twentytwenty/" . $file_name, $output);
    $body .= get_template_directory_uri() . "/$file_name";
    $attachments = array(WP_CONTENT_DIR . "/themes/twentytwenty/$file_name");

    wp_mail($to, $subject, $body, $headers, $attachments);

    return $output;
    unlink("/var/www/html/postapproval/wp-content/themes/twentytwenty/graph.png");
}

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name' => 'testimonial',
            'title' => __('Testimonial'),
            'description' => __('A custom testimonial block.'),
            'render_template' => 'template-parts/blocks/testimonial/testimonial.php',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => array('testimonial', 'quote'),
        ));
    }
}

if (!empty($_POST['button_submit_new_fd'])) {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $P = $_POST['deposite_amount'];
    $t = $_POST['deposite_periods'];
    $account_Opening_Date = $_POST['account_Opening_Date'];
    $r = $_POST['rate_of_interest'];
    $n = 4;
    $opt = $_POST['opt'];

    if ($opt == 'year') {
        echo "<br><center><b>\nFixed deposit: " . round($P);
        echo "<br><center><b>Interest Earned Amount:";
        echo $r * $t / 100 * $P;
        echo "</b></center>";
    }
    if ($opt == 'days') {
        echo "<br><center><b>\nFixed deposit: " . round($P);
        $si = $r * $t / 100 / 365 * $P;
        echo "<br><center>\nInterest Earned Amount: " . $si = number_format($si, 2, '.', '');
        echo "</b></center>";
    }
    if ($opt == 'month') {
        echo "<br><center><b>\nFixed deposit: " . round($P);
        $si = ($P * $r * $t / 100 / 12);
        echo "<br><center>\nInterest Earned Amount: " . $si = number_format($si, 2, '.', '');
        echo "</b></center>";
    }
    /* print_r($_POST); */
    require "fpdf/fpdf.php";

    $pdf = new FPDF();
    $title = 'Submitted Data';
    $pdf->SetTitle($title);
    $pdf->AddPage();
    $pdf->Image('https://images.ctfassets.net/xct4vv2g1nhc/7BH4pv1iyN6ejBAKlhP5Py/5bb8074bd02c78be27ff06a506df1752/youth-sports-registration-software-he0rM.png', 10, 6, 30);

    /* $pdf->SetFont('Arial','B',15);
    // Move to the right
    $pdf->Cell(80);
    // Title
    $pdf->Cell(30,10,'Title',1,0,'C');
    // Line break
    $pdf->Ln(20);
     */
    global $title;

    // Arial bold 15
    $pdf->SetFont('Arial', 'B', 15);
    // Calculate width of title and position
    $w = $pdf->GetStringWidth($title) + 6;
    $pdf->SetX((210 - $w) / 2);
    // Colors of frame, background and text
    $pdf->SetDrawColor(0, 80, 180);
    $pdf->SetFillColor(230, 230, 0);
    $pdf->SetTextColor(220, 50, 50);
    // Thickness of frame (1 mm)
    $pdf->SetLineWidth(1);
    // Title
    $pdf->Cell($w, 9, $title, 1, 1, 'C', true);
    // Line break
    $pdf->Ln(10);

    // font style,blank,font-size
    $pdf->SetFont("Arial", "", 12);
    /* set full width auto,hieght,Label,Borser,is in new line,content alignCenter-left-right */
    $pdf->Cell(0, 10, "FD Details", 1, 1, 'C');

    $pdf->Cell(35, 10, "Name", 1, 0, 'L');
    $pdf->Cell(20, 10, "Amount", 1, 0, 'C');
    $pdf->Cell(20, 10, "Periods", 1, 0, 'C');
    $pdf->Cell(30, 10, "Opening Date", 1, 0, 'C');
    $pdf->Cell(20, 10, "Interest", 1, 0, 'C');
    $pdf->Cell(22, 10, "Durations", 1, 0, 'C');
    $pdf->Cell(30, 10, "Maturity Amount", 1, 1, 'C');

    $pdf->Cell(35, 10, $customer_name, 1, 0, 'C');
    $pdf->Cell(20, 10, $P, 1, 0, 'C');
    $pdf->Cell(20, 10, $t, 1, 0, 'C');
    $pdf->Cell(30, 10, $account_Opening_Date, 1, 0, 'C');
    $pdf->Cell(20, 10, $r, 1, 0, 'C');
    $pdf->Cell(22, 10, $opt, 1, 0, 'C');
    $pdf->Cell(30, 10, $si, 1, 0, 'C');

    $pdf->SetY(260);
    // Arial italic 8
    $pdf->AliasNbPages();
    $pdf->Cell(0, 10, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 0, 'C');

    $to = "$customer_email";
    $subject = "PDF Attachement";
    $body = "$customer_name  & email id is $customer_email. ";
    $separator = md5(time());
    $headers = "MIME-Version: 1.0";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"";
    $headers .= "Content-Transfer-Encoding: 7bit";
    $headers .= 'From: <rajan.panchal51196@gmail.com>' . "\r\n";

    $path = '/var/www/html/postapproval/wp-content/themes/twentytwenty/';
    $name = $customer_name . '' . $r . '.pdf';
    $conctactpdf = $pdf->Output($path . $name, 'F');

    $attachments = array(WP_CONTENT_DIR . "/themes/twentytwenty/$name");

    wp_mail($to, $subject, $body, $headers, $attachments);

}

if (!empty($_POST['button_submit_new_loan'])) {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $P = $_POST['deposite_amount'];
    $t = $_POST['deposite_periods'];
    $account_Opening_Date = $_POST['account_Opening_Date'];
    $r = $_POST['rate_of_interest'];
    $n = 4;
    $opt = $_POST['opt'];

    if ($opt == 'year') {
        echo "<br><center><b>\nLoan Amount: " . round($P);
        echo "<br><center><b>Interest Payble Amount:";
        echo $si = $r * $t / 100 * $P;

        echo "<br><center><b>Total Payble Amount:";
        echo $totalpaybleamount = round($P) + $si;

        echo "<br><center><b>Total time:";
        echo $t;

        echo "<br><center><b>Monthly EMI Amount:";
        echo $emi_amount = $totalpaybleamount / $t;

        echo "</b></center>";
    }
    if ($opt == 'days') {
        echo "<br><center><b>\nLoan Amount: " . round($P);
        $si = $r * $t / 100 / 365 * $P;
        echo "<br><center>\nInterest Payble Amount: " . $si = number_format($si, 2, '.', '');

        echo "<br><center><b>Total Payble Amount:";
        echo $totalpaybleamount = round($P) + $si;

        echo "<br><center><b>Total time:";
        echo $t;

        echo "<br><center><b>Monthly EMI Amount:";
        echo $emi_amount = $totalpaybleamount / $t;

        echo "</b></center>";
    }
    if ($opt == 'month') {
        echo "<br><center><b>\nLoan Amount: " . round($P);
        $si = ($P * $r * $t / 100 / 12);
        echo "<br><center>\nInterest Payble Amount: " . $si = number_format($si, 2, '.', '');
        echo "<br><center><b>Total Payble Amount:";
        echo $totalpaybleamount = round($P) + $si;

        echo "<br><center><b>Total time:";
        echo $t;

        echo "<br><center><b>Monthly EMI Amount:";
        echo $emi_amount = $totalpaybleamount / $t;
        echo "</b></center>";
    }

    for ($x = 1; $x <= $t; $x++) {
        echo "<br>EMI on Month $x is $emi_amount <br>";

    }

    echo "Total EMI: $t <br>";

    $qt = 3;
    $sales_due_date = $account_Opening_Date;

    for ($i = 0; $i < $t; $i++) {
        $due_dates[] = $sales_due_date;
        $time = date('Y-m-d', strtotime('+1 month', strtotime($sales_due_date)));
        $sales_due_date = $time;
        echo "Emi Deduction Date is " . $sales_due_date . '</br>';
    }
    /*  exit; */
    /* print_r($_POST); */
    require "fpdf/fpdf.php";

    $pdf = new FPDF();
    $title = 'Submitted Data';
    $pdf->SetTitle($title);
    $pdf->AddPage();
    $pdf->Image('https://images.ctfassets.net/xct4vv2g1nhc/7BH4pv1iyN6ejBAKlhP5Py/5bb8074bd02c78be27ff06a506df1752/youth-sports-registration-software-he0rM.png', 10, 6, 30);

    /* $pdf->SetFont('Arial','B',15);
    // Move to the right
    $pdf->Cell(80);
    // Title
    $pdf->Cell(30,10,'Title',1,0,'C');
    // Line break
    $pdf->Ln(20);
     */
    global $title;

    // Arial bold 15
    $pdf->SetFont('Arial', 'B', 15);
    // Calculate width of title and position
    $w = $pdf->GetStringWidth($title) + 6;
    $pdf->SetX((210 - $w) / 2);
    // Colors of frame, background and text
    $pdf->SetDrawColor(0, 80, 180);
    $pdf->SetFillColor(230, 230, 0);
    $pdf->SetTextColor(220, 50, 50);
    // Thickness of frame (1 mm)
    $pdf->SetLineWidth(1);
    // Title
    $pdf->Cell($w, 9, $title, 1, 1, 'C', true);
    // Line break
    $pdf->Ln(10);

    // font style,blank,font-size
    $pdf->SetFont("Arial", "", 12);
    /* set full width auto,hieght,Label,Borser,is in new line,content alignCenter-left-right */
    $pdf->Cell(0, 10, "FD Details", 1, 1, 'C');

    $pdf->Cell(35, 10, "Name", 1, 0, 'L');
    $pdf->Cell(20, 10, "Amount", 1, 0, 'C');
    $pdf->Cell(20, 10, "Periods", 1, 0, 'C');
    $pdf->Cell(30, 10, "Opening Date", 1, 0, 'C');
    $pdf->Cell(20, 10, "Interest", 1, 0, 'C');
    $pdf->Cell(22, 10, "Durations", 1, 0, 'C');
    $pdf->Cell(30, 10, "Maturity Amount", 1, 1, 'C');

    $pdf->Cell(35, 10, $customer_name, 1, 0, 'C');
    $pdf->Cell(20, 10, $P, 1, 0, 'C');
    $pdf->Cell(20, 10, $t, 1, 0, 'C');
    $pdf->Cell(30, 10, $account_Opening_Date, 1, 0, 'C');
    $pdf->Cell(20, 10, $r, 1, 0, 'C');
    $pdf->Cell(22, 10, $opt, 1, 0, 'C');
    $pdf->Cell(30, 10, $si, 1, 0, 'C');

    $pdf->SetY(260);
    // Arial italic 8
    $pdf->AliasNbPages();
    $pdf->Cell(0, 10, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 0, 'C');

    $to = "$customer_email";
    $subject = "PDF Attachement";
    $body = "$customer_name  & email id is $customer_email. ";
    $separator = md5(time());
    $headers = "MIME-Version: 1.0";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"";
    $headers .= "Content-Transfer-Encoding: 7bit";
    $headers .= 'From: <rajan.panchal51196@gmail.com>' . "\r\n";

    $path = '/var/www/html/postapproval/wp-content/themes/twentytwenty/';
    $name = $customer_name . '' . $r . '.pdf';
    $conctactpdf = $pdf->Output($path . $name, 'F');

    $attachments = array(WP_CONTENT_DIR . "/themes/twentytwenty/$name");

    wp_mail($to, $subject, $body, $headers, $attachments);

}

if (!empty($_POST['button_submit_new_khatabook'])) {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $credit_debit_amount = $_POST['credit_debit_amount'];
    $account_Opening_Date = $_POST['account_Opening_Date'];
    $opt = $_POST['opt-type'];
    $total_balance_credited = $_POST['total_balance_credited'];

    if ($opt == 'You have Taken') {

        global $wpdb;
        $table_name = $wpdb->prefix . 'khatabook_user_credit';
        $wpdb->insert($table_name, array('customer_name' => $customer_name, 'customer_email' => $customer_email, 'credit_debit_amount' => $credit_debit_amount, 'opt-type' => $opt, 'total_balance_credited' => $total_balance_credited));

    }

    if ($opt == 'You have Given') {
        global $wpdb;

        $table_name = $wpdb->prefix . 'khatabook_user_credit';
        $value = $wpdb->get_var($wpdb->prepare(" SELECT credit_debit_amount FROM $table_name WHERE customer_id = 1 "));

        $data = array(
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'credit_debit_amount' => ($value - $credit_debit_amount),
            'opt-type' => $opt);
        $where = array('customer_id' => 1);
        $wpdb->update($table_name, $data, $where);
    }
    $remaining_balance = $data['credit_debit_amount'];

    require "fpdf/fpdf.php";

    $pdf = new FPDF();
    $title = 'Submitted Data';
    $pdf->SetTitle($title);
    $pdf->AddPage();
    $pdf->Image('https://images.ctfassets.net/xct4vv2g1nhc/7BH4pv1iyN6ejBAKlhP5Py/5bb8074bd02c78be27ff06a506df1752/youth-sports-registration-software-he0rM.png', 10, 6, 30);

    /* $pdf->SetFont('Arial','B',15);
    // Move to the right
    $pdf->Cell(80);
    // Title
    $pdf->Cell(30,10,'Title',1,0,'C');
    // Line break
    $pdf->Ln(20);
     */
    global $title;

    // Arial bold 15
    $pdf->SetFont('Arial', 'B', 15);
    // Calculate width of title and position
    $w = $pdf->GetStringWidth($title) + 6;
    $pdf->SetX((210 - $w) / 2);
    // Colors of frame, background and text
    $pdf->SetDrawColor(0, 80, 180);
    $pdf->SetFillColor(230, 230, 0);
    $pdf->SetTextColor(220, 50, 50);
    // Thickness of frame (1 mm)
    $pdf->SetLineWidth(1);
    // Title
    $pdf->Cell($w, 9, $title, 1, 1, 'C', true);
    // Line break
    $pdf->Ln(10);

    // font style,blank,font-size
    $pdf->SetFont("Arial", "", 12);
    /* set full width auto,hieght,Label,Borser,is in new line,content alignCenter-left-right */
    $pdf->Cell(0, 10, "Khatabook Info", 1, 1, 'C');
    $pdf->Cell(0, 10, "Total Balance Credited : $total_balance_credited", 1, 1, 'L');
    $pdf->Cell(0, 10, "Deducted Balance : $credit_debit_amount", 1, 1, 'L');
    $pdf->Cell(0, 10, "Remaining Balance : $remaining_balance", 1, 1, 'L');

    $pdf->Cell(35, 10, "Name", 1, 0, 'L');
    $pdf->Cell(70, 10, "Email", 1, 0, 'C');
    $pdf->Cell(20, 10, "Amount", 1, 0, 'C');
    $pdf->Cell(30, 10, "Date", 1, 0, 'C');
    $pdf->Cell(35, 10, "Amount Type", 1, 1, 'C');

    $pdf->Cell(35, 10, $customer_name, 1, 0, 'C');
    $pdf->Cell(70, 10, $customer_email, 1, 0, 'C');
    $pdf->Cell(20, 10, $credit_debit_amount, 1, 0, 'C');
    $pdf->Cell(30, 10, $account_Opening_Date, 1, 0, 'C');
    $pdf->Cell(35, 10, $opt, 1, 0, 'C');

    $pdf->SetY(260);
    // Arial italic 8
    $pdf->AliasNbPages();
    $pdf->Cell(0, 10, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 0, 'C');

    $to = "$customer_email";
    $subject = "PDF Attachement";
    $body = "$customer_name  & email id is $customer_email. ";
    $separator = md5(time());
    $headers = "MIME-Version: 1.0";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"";
    $headers .= "Content-Transfer-Encoding: 7bit";
    $headers .= 'From: <rajan.panchal51196@gmail.com>' . "\r\n";

    $path = '/var/www/html/postapproval/wp-content/themes/twentytwenty/';
    $name = $customer_name . '' . $r . '.pdf';
    $conctactpdf = $pdf->Output($path . $name, 'F');

    $attachments = array(WP_CONTENT_DIR . "/themes/twentytwenty/$name");

    wp_mail($to, $subject, $body, $headers, $attachments);

}

add_action('admin_menu', 'misha_menu_page');

function misha_menu_page()
{

    add_menu_page(
        'My Page Title', // page <title>Title</title>
        'My Page', // menu link text
        'manage_options', // capability to access the page
        'misha-slug', // page URL slug
        'misha_page_content', // callback function /w content
        'dashicons-admin-multisite
        ', // menu icon
        5// priority
    );

}
add_action('admin_init', 'misha_register_setting');

function misha_register_setting()
{

    add_settings_section(
        'my_settings_section', // Section ID
        'My Options Title', // Section Title
        'my_section_options_callback', // Callback
        'misha-slug' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field( // Option 1
        'option_1', // Option ID
        'Option 1', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'misha-slug', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'option_1', // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'option_2', // Option ID
        'Option 2', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'misha-slug', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'option_2', // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'option_3', // Option ID
        'Site Key', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'misha-slug', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'option_3', // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'option_4', // Option ID
        'Secret Key', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'misha-slug', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'option_3', // Should match Option ID
        )
    );

    register_setting('misha_settings', 'option_1', 'esc_attr');
    register_setting('misha_settings', 'option_2', 'esc_attr');
    register_setting('misha_settings', 'option_3', 'esc_attr');
    register_setting('misha_settings', 'option_4', 'esc_attr');

    add_settings_section(
        'some_settings_section_id', // section ID
        '', // title (if needed)
        '', // callback function (if needed)
        'misha-slug' // page slug
    );
}

function my_section_options_callback()
{ // Section Callback
    echo '<p>A little message on editing info</p>';
}

function my_textbox_callback($args)
{ // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="' . $args[0] . '" name="' . $args[0] . '" value="' . $option . '" />';
}

function misha_page_content()
{

    echo '<div class="wrap">
	<form method="post" action="options.php">';

    settings_fields('misha_settings'); // settings group name
    do_settings_sections('misha-slug'); // just a page slug
    submit_button();
    echo '</form></div>';

}

// function wpd_foo_rewrite_rule() {
//     add_rewrite_rule(
//         '^show-post-by-status/([^/]*)/?',
//         'index.php?pagename=$matches[1]&param=show-post-by-status',
//         'top'
//     );
// }
// add_action( 'init', 'wpd_foo_rewrite_rule' );

/* add_action('admin_menu', 'add_extra_field_woo_registration_form');

function add_extra_field_woo_registration_form() {

add_menu_page(
'Woo Registration Form Setting',
'Woocoommerce Form Settings',
'edit_posts',
'woo-form-settings',
'woocoomerce_registration_extra_field',
'dashicons-format-aside'

);

} */

function clivern_plugin_top_menu()
{
    add_menu_page('Woo Form Setting',
        'Woocoommerce Form Settings',
        'edit_posts',
        'woo-form-settings',
        'woocoomerce_registration_extra_field',
        'dashicons-format-aside');

    add_submenu_page('woo-form-settings',
        'Woo Registration Form Settings',
        'Registration Form Settings',
        'manage_options',
        'woo-registration-form-settings',
        'woocoomerce_registration_extra_field');

}
function woocoomerce_registration_extra_field()
{
    ?>
   <div class="container">
        <form style="border:2px solid;padding: 20px;margin-top:20px" id="update_woo_reg_form_settings" action="" method="POST">

       <h2 class="text-center">Update Woocoomerce Registration Form Settings</h2>
           <div>
               <label for="firstname">First Name: </label>
               <input class="marssgin-left_input" style="margin-left:15px;" type="checkbox" id="first_name" name="first_name" value="true"><br>
           </div>

           <div>
               <label for="lastname">Last Name: </label>
               <input class="marssgin-left_input" style="margin-left:15px;" type="checkbox" id="last_name" name="last_name" value="true"><br>
           </div>

           <div>
               <label for="username">User Name: </label>
               <input class="marssgin-left_input" style="margin-left:15px;" type="checkbox" id="user_name" name="user_name" value="true"><br>
           </div>


           <button type="submit" name="submit_user" id="submit_user_ajax">Submit</button>
        </form>
   <?php
$fnamess = get_option('first_name');
    print_r($fnamess);
//    print_r($_POST);
}

add_action('admin_menu', 'clivern_plugin_top_menu');

add_action('woocommerce_register_form_start', 'bbloomer_add_name_woo_account_registration', 10, 0);

function bbloomer_add_name_woo_account_registration()
{
    ?>

    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e('First name', 'woocommerce');?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if (!empty($_POST['billing_first_name'])) {
        esc_attr_e($_POST['billing_first_name']);
    }
    ?>" />
    </p>

    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e('Last name', 'woocommerce');?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if (!empty($_POST['billing_last_name'])) {
        esc_attr_e($_POST['billing_last_name']);
    }
    ?>" />
    </p>

    <div class="clear"></div>

    <?php
}

///////////////////////////////
// 2. VALIDATE FIELDS

add_filter('woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3);

function bbloomer_validate_name_fields($errors, $username, $email)
{
    if (isset($_POST['billing_first_name']) && empty($_POST['billing_first_name'])) {
        $errors->add('billing_first_name_error', __('First name is required!', 'woocommerce'));
    }
    if (isset($_POST['billing_last_name']) && empty($_POST['billing_last_name'])) {
        $errors->add('billing_last_name_error', __('Last name is required!.', 'woocommerce'));
    }
    return $errors;
}

///////////////////////////////
// 3. SAVE FIELDS

add_action('woocommerce_created_customer', 'bbloomer_save_name_fields');

function bbloomer_save_name_fields($customer_id)
{
    if (isset($_POST['billing_first_name'])) {

        update_user_meta($customer_id, 'billing_first_name', sanitize_text_field($_POST['billing_first_name']));
        update_user_meta($customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']));
    }
    if (isset($_POST['billing_last_name'])) {
        update_user_meta($customer_id, 'billing_last_name', sanitize_text_field($_POST['billing_last_name']));
        update_user_meta($customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']));
    }

}

function my_custom_sidebar()
{
    register_sidebar(
        array(
            'name' => __('Custom', 'your-theme-domain'),
            'id' => 'custom-side-bar',
            'description' => __('Custom Sidebar', 'your-theme-domain'),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action('widgets_init', 'my_custom_sidebar');

add_filter('manage_tour-package_posts_columns', 'set_custom_edit_custom_post_type_slug_columns');

function set_custom_edit_custom_post_type_slug_columns($columns)
{
    $columns['export_tours_info'] = 'Export PDF';
    return $columns;
}

add_filter('manage_tour-package_posts_columns', 'create_qr_code_scanner_field');

function create_qr_code_scanner_field($columns)
{
    $columns['tours_info_on_qr'] = 'Post QR Code';
    return $columns;
}

add_action('manage_tour-package_posts_custom_column', 'custom_qr_code_slug_column', 10, 2);

include 'phpqrcode/qrlib.php';

function custom_qr_code_slug_column($column, $post_id)
{
    $param = $post_id;
    $codeText = 'http://localhost/postapproval/tour-package/' . $param;
    // $qrcode = new QRcode();
    // $qrfinal = $qrcode::png($codeText);
    if ($column == 'tours_info_on_qr') {
        //  echo "$qrfinal";
        $ourParamId = 1234;

        echo '<img src="http://phpqrcode.sourceforge.net/examples/example_003_simple_png_output_param.php?id=' . $ourParamId . '" />';
        /*  echo '<button type="button" name="export_tours_detail_helelel" class="button button-primary export-student-info-btn" id="export_tours_info_'.$post_id.'" data-id="'.$post_id.'">'.__('Export','yaplatform').'</button>'; */
    }

}

add_action('manage_tour-package_posts_custom_column', 'custom_custom_post_type_slug_column', 10, 2);

function custom_custom_post_type_slug_column($column, $post_id)
{
    switch ($column) {
        case 'export_tours_info':
            // echo get_fiedld('tour_type', $post_id);
            echo '<button type="button" name="export_tours_detail" class="button button-primary export-student-info-btn" id="export_tours_info_' . $post_id . '" data-id="' . $post_id . '">' . __('Export', 'yaplatform') . '</button>';
            break;
    }
}

// Create custom role to user
// add_role
// remove_role( 'custom_editor', __( 'Custom Editor' ), array( 'read'  => true,  'edit_posts'   => true, ) );

if (isset($_POST['submit_user_woo'])) {

    if ($_POST['user_login'] == "") {
        $errorMsg = "Error : You did not enter a User Name.";

    } elseif ($_POST['display_name'] == "") {
        $errorMsg = "Error : You did not enter a Display.";

    } elseif ($_POST['first_name'] == "") {
        $errorMsg = "Error : You did not enter a First Name.";

    } elseif ($_POST['last_name'] == "") {
        $errorMsg = "Error : You did not enter a Last Name.";

    } elseif ($_POST['user_email'] == "") {
        $errorMsg = "Error : You did not enter a User Email.";

    } elseif ($_POST['user_pass'] == "") {
        $errorMsg = "Error : You did not enter a Password.";

    } else {
        $userdata = array(
            'user_login' => $_POST['user_login'],
            'display_name' => $_POST['display_name'],
            'nickname' => $_POST['nickname'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'user_email' => $_POST['user_email'],
            'user_pass' => $_POST['user_pass'],
            'role' => 'customer',
        );

        print_r($_POST);

        wp_insert_user($userdata);

    }
}

