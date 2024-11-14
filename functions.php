<?php

/**
 * Importing required files
 */
require_once('classes/wp-bootstrap-navlist-walker.php');

/**
 * Register Navigation Menus
 */
function realEstate_ors_setup()
{
    // Basic theme support
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');

    // Block Styles and Responsive Embeds
    add_theme_support("wp-block-styles");
    add_theme_support("responsive-embeds");

    // HTML5 support
    add_theme_support("html5", array(
        "search-form",
        "comment-form",
        "comment-list",
        "gallery",
        "caption"
    ));

    // Custom Logo
    add_theme_support("custom-logo", array(
        "height"      => 100,
        "width"       => 400,
        "flex-height" => true,
        "flex-width"  => true,
    ));

    // Custom Header
    add_theme_support("custom-header", array(
        "width"         => 1920,
        "height"        => 500,
        "flex-height"   => true,
        "flex-width"    => true,
    ));

    // Custom Background
    add_theme_support("custom-background", array(
        "default-color" => "ffffff",
        "default-image" => "",
    ));

    // Wide Alignment
    add_theme_support("align-wide");

    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'real-estate-ors'), // Primary Menu
        'footer'  => __('Footer Menu', 'real-estate-ors'),  // Footer Menu
        'footer2' => __('Footer Menu 2', 'real-estate-ors'), // Footer Menu 2
    ));
}

add_action("after_setup_theme", "realEstate_ors_setup");


/**
 * Enqueue styles and scripts
 * @return void
 */
function realEstate_ors_theme_enqueue_scripts()
{


    // Google Fonts
    wp_enqueue_style('work-sans-font', 'https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap', array(), null);

    // Enqueue local styles
    wp_enqueue_style('icomoon-style', get_template_directory_uri() . '/assets/fonts/icomoon/style.css', array(), null);
    wp_enqueue_style('tiny-slider-style', get_template_directory_uri() . '/assets/css/tiny-slider.css', array(), null);
    wp_enqueue_style('aos-style', get_template_directory_uri() . '/assets/css/aos.css', array(), null);
    wp_enqueue_style('main-style', get_stylesheet_uri(), array('work-sans-font', 'tiny-slider-style', 'aos-style'), null); // Ensures main style is loaded last
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/style.css', array(), null);

    // Enqueue local scripts
    wp_enqueue_script('bootstrap-bundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), null, true);
    wp_enqueue_script('tiny-slider', get_template_directory_uri() . '/assets/js/tiny-slider.js', array('bootstrap-bundle'), null, true);
    wp_enqueue_script('aos', get_template_directory_uri() . '/assets/js/aos.js', array('tiny-slider'), null, true);
    wp_enqueue_script('navbar', get_template_directory_uri() . '/assets/js/navbar.js', array('aos'), null, true);
    wp_enqueue_script('counter', get_template_directory_uri() . '/assets/js/counter.js', array('navbar'), null, true);
    wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', array('counter'), null, true);
}
add_action('wp_enqueue_scripts', 'realEstate_ors_theme_enqueue_scripts');

/**
 * Summary of realEstate_ors_enqueue_comments_reply
 * @return void
 */
function realEstate_ors_enqueue_comments_reply()
{
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'realEstate_ors_enqueue_comments_reply');


/**
 * Summary of Register theme settings
 * @return void
 */
function realEstate_ors_register_settings()
{
    // Register a new setting for the custom theme options
    register_setting('realEstate_ors_options_group', 'realEstate_ors_options');
}
add_action('admin_init', 'realEstate_ors_register_settings');


/**
 * Summary of realEstate_ors_admin_styles
 * @return void
 */
function realEstate_ors_admin_styles()
{
    add_editor_style('editor-style.css');
}
add_action('admin_init', 'realEstate_ors_admin_styles');


/**
 * Summary of realEstate_ors_register_block_styles
 * @return void
 */
function realEstate_ors_register_block_styles()
{
    // Register a custom style for the paragraph block
    register_block_style(
        'core/paragraph', // The block type to which the style will be added
        array(
            'name'  => 'highlighted', // The custom style name
            'label' => __('Highlighted Text', 'real-estate-ors'), // The label for the style in the editor
        )
    );

    // Register a custom style for the button block
    register_block_style(
        'core/button', // The block type for the button
        array(
            'name'  => 'primary', // The custom style name
            'label' => __('Primary Button', 'real-estate-ors'), // The label for the style
        )
    );
}
add_action('init', 'realEstate_ors_register_block_styles');


function realEstate_ors_register_block_patterns()
{
    // Register a custom block pattern
    register_block_pattern(
        'real-estate-ors/hero-section', // Unique name for the block pattern
        array(
            'title'       => __('Hero Section', 'real-estate-ors'),
            'description' => __('A hero section with a background image and call to action button.', 'real-estate-ors'),
            'content'     => "<!-- wp:group {\"align\":\"full\",\"style\":{\"spacing\":{\"padding\":{\"top\":\"80px\",\"bottom\":\"80px\"}}}} -->
            <div class=\"wp-block-group\" style=\"padding-top:80px;padding-bottom:80px;\">
                <!-- wp:image {\"id\":1,\"sizeSlug\":\"full\"} -->
                <figure class=\"wp-block-image size-full\"><img src=\"your-image-url.jpg\" alt=\"Hero Image\" /></figure>
                <!-- /wp:image -->
                <!-- wp:heading {\"level\":1} -->
                <h1>Welcome to Our Website</h1>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>Your tagline or call to action here.</p>
                <!-- /wp:paragraph -->
                <!-- wp:button -->
                <div class=\"wp-block-button\"><a class=\"wp-block-button__link\" href=\"#\">Learn More</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:group -->",
        )
    );
}
add_action('init', 'realEstate_ors_register_block_patterns');



/**
 * Summary of Register admin menu
 * @return void
 */
function realEstate_ors_add_admin_menu()
{
    add_menu_page(
        'RealEstate Settings', // Page title
        'Theme Settings', // Menu title
        'manage_options', // Capability
        'realEstate-ors-settings', // Menu slug
        'realEstate_ors_settings_page' // Function to display the settings page
    );
}
add_action('admin_menu', 'realEstate_ors_add_admin_menu');

/**
 * Helper method for saving the settings
 * @param mixed $new_options
 * @return void
 */
function realEstate_ors_save_options($new_options)
{
    $current_options = get_option('realEstate_ors_options', []);
    $merged_options = array_merge($current_options, $new_options);
    update_option('realEstate_ors_options', $merged_options);
}



/**
 * Summary of Setting Page Tabs
 * @return void
 */
function realEstate_ors_settings_page()
{
    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['realEstate_ors_options'])) {
        realEstate_ors_save_options($_POST['realEstate_ors_options']);
    }

    // Get the current active tab or set a default
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'header';
?>
    <div class="wrap">
        <h1>Real Estate Theme Settings</h1>

        <h2 class="nav-tab-wrapper">
            <a href="?page=realEstate-ors-settings&tab=header" class="nav-tab <?php echo $active_tab === 'header' ? 'nav-tab-active' : ''; ?>">Header</a>
            <a href="?page=realEstate-ors-settings&tab=footer" class="nav-tab <?php echo $active_tab === 'footer' ? 'nav-tab-active' : ''; ?>">Footer</a>
            <a href="?page=realEstate-ors-settings&tab=page" class="nav-tab <?php echo $active_tab === 'page' ? 'nav-tab-active' : ''; ?>">Page</a>
        </h2>

        <form method="post" action="">
            <?php
            settings_fields('realEstate_ors_options_group'); // Output security fields
            $options = get_option('realEstate_ors_options'); // Retrieve current options

            // Display settings based on the active tab
            if ($active_tab === 'header') {
                realEstate_ors_display_header_settings($options);
            } elseif ($active_tab === 'footer') {
                realEstate_ors_display_footer_settings($options);
            } elseif ($active_tab === 'page') {
                realEstate_ors_display_page_settings($options);
            }

            submit_button();
            ?>
        </form>
    </div>
<?php
}

/**
 * Summary of Theme header settings
 * @param mixed $options
 * @return void
 */
function realEstate_ors_display_header_settings($options)
{
?>
    <h2>Header Settings</h2>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Logo Image</th>
            <td class="logoImgUploadContainer">
                <input type="text" id="header-image-url" name="realEstate_ors_options[header_image]" value="<?php echo esc_attr($options['header_image']); ?>" style="width: 70%;" />
                <button id="upload-header-image" class="button">Upload Image</button>
                <br><br>
                <img id="header-image-preview" src="<?php echo esc_url($options['header_image']); ?>" style="max-width: 100%; height: auto; display: <?php echo esc_attr($options['header_image'] ? 'block' : 'none'); ?>;" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Banner Background Image - 1 </th>
            <td class="logoImgUploadContainer">
                <input type="text" id="banner-image-url-1" name="realEstate_ors_options[banner_image]" value="<?php echo esc_attr($options['banner_image']); ?>" style="width: 70%;" />
                <button id="upload-banner-image-1" class="button">Upload Image</button>
                <br><br>
                <img id="upload-banner-image-preview-1" src="<?php echo esc_url($options['banner_image']); ?>" style="max-width: 100%; height: auto; display: <?php echo esc_attr($options['banner_image'] ? 'block' : 'none'); ?>;" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Banner Background Image - 2 </th>
            <td class="logoImgUploadContainer">
                <input type="text" id="banner-image-url-2" name="realEstate_ors_options[banner_image_2]" value="<?php echo esc_attr($options['banner_image_2']); ?>" style="width: 70%;" />
                <button id="upload-banner-image-2" class="button">Upload Image</button>
                <br><br>
                <img id="upload-banner-image-preview-2" src="<?php echo esc_url($options['banner_image_2']); ?>" style="max-width: 100%; height: auto; display: <?php echo esc_attr($options['banner_image_2'] ? 'block' : 'none'); ?>;" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Banner Background Image - 3 </th>
            <td class="logoImgUploadContainer">
                <input type="text" id="banner-image-url-3" name="realEstate_ors_options[banner_image_3]" value="<?php echo esc_attr($options['banner_image_3']); ?>" style="width: 70%;" />
                <button id="upload-banner-image-3" class="button">Upload Image</button>
                <br><br>
                <img id="upload-banner-image-preview-3" src="<?php echo esc_url($options['banner_image_3']); ?>" style="max-width: 100%; height: auto; display: <?php echo esc_attr($options['banner_image_3'] ? 'block' : 'none'); ?>;" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Banner Heading</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[banner_heading]" value="<?php echo esc_attr($options['banner_heading']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Banner Body Text</th>
            <td>
                <?php
                $content = isset($options['banner_body_text']) ? $options['banner_body_text'] : ''; // Get the current value or default to an empty string
                $editor_id = 'banner_body_text'; // A unique ID for the editor
                $settings = array(
                    'textarea_name' => 'realEstate_ors_options[banner_body_text]', // This matches your options array structure
                    'media_buttons' => false, // Set to true if you want to allow media uploads
                    'teeny' => true, // Simplified editor without some buttons
                    'quicktags' => true, // Allows HTML editing
                );
                wp_editor($content, $editor_id, $settings); // Display the editor
                ?>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">About Us Heading</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[about_us_heading]" value="<?php echo esc_attr($options['about_us_heading']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">About Us Body Text</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[about_us_body_text]" value="<?php echo esc_attr($options['about_us_body_text']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">About Us Key Point Text - 1</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[about_us_key_point_text_1]" value="<?php echo esc_attr($options['about_us_key_point_text_1']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">About Us Key Point Body - 1</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[about_us_key_point_body_1]" value="<?php echo esc_attr($options['about_us_key_point_body_1']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">About Us Key Point Text - 2</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[about_us_key_point_text_2]" value="<?php echo esc_attr($options['about_us_key_point_text_2']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">About Us Key Point Body - 2</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[about_us_key_point_body_2]" value="<?php echo esc_attr($options['about_us_key_point_body_2']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">About Us Key Point Text - 3</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[about_us_key_point_text_3]" value="<?php echo esc_attr($options['about_us_key_point_text_3']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">About Us Key Point Body - 3</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[about_us_key_point_body_3]" value="<?php echo esc_attr($options['about_us_key_point_body_3']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Countdown Number:1</th>
            <td class="bannerHeadingtextOrs">
                <input type="number" name="realEstate_ors_options[countdown_no_1]" value="<?php echo esc_attr($options['countdown_no_1']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Countdown text:1</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[countdown_text_1]" value="<?php echo esc_attr($options['countdown_text_1']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Countdown Number:2</th>
            <td class="bannerHeadingtextOrs">
                <input type="number" name="realEstate_ors_options[countdown_no_2]" value="<?php echo esc_attr($options['countdown_no_2']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Countdown text:2</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[countdown_text_2]" value="<?php echo esc_attr($options['countdown_text_2']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Countdown Number:3</th>
            <td class="bannerHeadingtextOrs">
                <input type="number" name="realEstate_ors_options[countdown_no_3]" value="<?php echo esc_attr($options['countdown_no_3']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Countdown text:3</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[countdown_text_3]" value="<?php echo esc_attr($options['countdown_text_3']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Countdown Number:4</th>
            <td class="bannerHeadingtextOrs">
                <input type="number" name="realEstate_ors_options[countdown_no_4]" value="<?php echo esc_attr($options['countdown_no_4']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Countdown text:4</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[countdown_text_4]" value="<?php echo esc_attr($options['countdown_text_4']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">CTA Heading</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[cta_heading]" value="<?php echo esc_attr($options['cta_heading']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">CTA Body Text</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[cta_body_text]" value="<?php echo esc_attr($options['cta_body_text']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">CTA Button Text</th>
            <td class="bannerHeadingtextOrs">
                <input type="text" name="realEstate_ors_options[cta_button_text]" value="<?php echo esc_attr($options['cta_button_text']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">CTA Button URL</th>
            <td class="bannerHeadingtextOrs">
                <input type="url" name="realEstate_ors_options[cta_button_url]" value="<?php echo esc_attr($options['cta_button_url']); ?>" />
            </td>
        </tr>

    </table>
<?php
}

/**
 * Summary of Theme footer settings
 * @param mixed $options
 * @return void
 */
function realEstate_ors_display_footer_settings($options)
{
?>
    <h2>Footer Settings</h2>
    <h2>Add URL Of Social Icons</h2>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Facebook URL</th>
            <td>
                <input type="url" name="realEstate_ors_options[footer_fb_link]" value="<?php echo esc_attr($options['footer_fb_link']); ?>" placeholder="https://facebook.com/yourprofile" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Instagram URL</th>
            <td>
                <input type="url" name="realEstate_ors_options[footer_insta_link]" value="<?php echo esc_attr($options['footer_insta_link']); ?>" placeholder="https://instagram.com/yourprofile" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">LinkedIn URL</th>
            <td>
                <input type="url" name="realEstate_ors_options[footer_linkedin_link]" value="<?php echo esc_attr($options['footer_linkedin_link']); ?>" placeholder="https://linkedin.com/in/yourprofile" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Twitter URL</th>
            <td>
                <input type="url" name="realEstate_ors_options[footer_twitter_link]" value="<?php echo esc_attr($options['footer_twitter_link']); ?>" placeholder="https://twitter.com/yourprofile" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Copyright Text</th>
            <td>
                <input type="text" name="realEstate_ors_options[copyright_text]" value="<?php echo esc_attr($options['copyright_text']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Copyright URL</th>
            <td>
                <input type="url" name="realEstate_ors_options[copyright_url]" value="<?php echo esc_attr($options['copyright_url']); ?>" />
            </td>
        </tr>
    </table>
<?php
}

/**
 * Summary of Theme Page settings
 * @param mixed $options
 * @return void
 */
function realEstate_ors_display_page_settings($options)
{
?>
    <h2>Page Settings</h2>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Page Setting 1</th>
            <td>
                <input type="text" name="realEstate_ors_options[page_setting1]" value="<?php echo esc_attr($options['page_setting1']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Page Setting 2</th>
            <td>
                <input type="text" name="realEstate_ors_options[page_setting2]" value="<?php echo esc_attr($options['page_setting2']); ?>" />
            </td>
        </tr>
    </table>
<?php
}
/**
 * Summary of Enqueue media uploader
 * @return void
 */
function realEstate_ors_enqueue_media_uploader()
{
    // Load media uploader only on the settings page
    if (isset($_GET['page']) && $_GET['page'] === 'realEstate-ors-settings') {
        wp_enqueue_media(); // Enqueue WordPress media uploader
        wp_enqueue_script('realEstate-ors-media-uploader', get_template_directory_uri() . '/assets/js/media-uploader.js', array('jquery'), null, true); // Enqueue custom JS for media uploader
        wp_enqueue_style('realEstate-ors-admin-css', get_template_directory_uri() . '/assets/css/admin.css', array(), null); // Enqueue custom admin CSS
    }

    // Enqueue CSS for property post type in the admin area
    $screen = get_current_screen();
    if ($screen->post_type === 'property') {
        wp_enqueue_style('realestate-ors-property-css', get_template_directory_uri() . '/assets/css/property.css', array(), null);
    }
}
add_action('admin_enqueue_scripts', 'realEstate_ors_enqueue_media_uploader');

function realEstate_ors_widgets_init()
{
    register_sidebar(array(
        'name'          => __('Footer Widget Area 1', 'real-estate-ors'),
        'id'            => 'footer-widget-1',
        'description'   => __('First footer widget area', 'real-estate-ors'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area 2', 'real-estate-ors'),
        'id'            => 'footer-widget-2',
        'description'   => __('Second footer widget area', 'real-estate-ors'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area 3', 'real-estate-ors'),
        'id'            => 'footer-widget-3',
        'description'   => __('Third footer widget area', 'real-estate-ors'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => __('Blog Widget', 'real-estate-ors'),
        'id'            => 'blog-widget',
        'description'   => __('Third footer widget area', 'real-estate-ors'),
        'before_widget' => '<div class="real-estate-ors-blog-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="real-estate-ors-blog-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'realEstate_ors_widgets_init');
