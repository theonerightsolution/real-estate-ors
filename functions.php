<?php

/**
 * Importing required files
 */
require_once('nav/wp-bootstrap-navlist-walker.php');

/**
 * Register Navigation Menus
 */
function realEstate_ors_menus()
{
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'realEstateOrs'), // 'primary' is the location slug
    ));
}
add_action('after_setup_theme', 'realEstate_ors_menus');


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
    wp_enqueue_style('flaticon-style', get_template_directory_uri() . '/assets/fonts/flaticon/font/flaticon.css', array(), null);
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
 * Summary of realEstate_ors_register_settings
 * @return void
 */
function realEstate_ors_register_settings()
{
    // Register a new setting for the custom theme options
    register_setting('realEstate_ors_options_group', 'realEstate_ors_options');
}
add_action('admin_init', 'realEstate_ors_register_settings');

/**
 * Summary of realEstate_ors_add_admin_menu
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
 * Summary of realEstate_ors_settings_page
 * @return void
 */
function realEstate_ors_settings_page()
{
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

        <form method="post" action="options.php">
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
 * Summary of realEstate_ors_display_header_settings
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
            <th scope="row">Header Setting 1</th>
            <td>
                <input type="text" name="realEstate_ors_options[header_setting1]" value="<?php echo esc_attr($options['header_setting1']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Header Setting 2</th>
            <td>
                <input type="text" name="realEstate_ors_options[header_setting2]" value="<?php echo esc_attr($options['header_setting2']); ?>" />
            </td>
        </tr>

    </table>
<?php
}

/**
 * Summary of realEstate_ors_display_footer_settings
 * @param mixed $options
 * @return void
 */
function realEstate_ors_display_footer_settings($options)
{
?>
    <h2>Footer Settings</h2>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Footer Setting 1</th>
            <td>
                <input type="text" name="realEstate_ors_options[footer_setting1]" value="<?php echo esc_attr($options['footer_setting1']); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Footer Setting 2</th>
            <td>
                <input type="text" name="realEstate_ors_options[footer_setting2]" value="<?php echo esc_attr($options['footer_setting2']); ?>" />
            </td>
        </tr>
    </table>
<?php
}
/**
 * Summary of realEstate_ors_display_page_settings
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
 * Summary of realEstate_ors_enqueue_media_uploader
 * @return void
 */
function realEstate_ors_enqueue_media_uploader()
{
    // Only load media uploader on the settings page
    if (isset($_GET['page']) && $_GET['page'] === 'realEstate-ors-settings') {
        wp_enqueue_media(); // Enqueue WordPress media uploader
        wp_enqueue_script('realEstate-ors-media-uploader', get_template_directory_uri() . '/assets/js/media-uploader.js', array('jquery'), null, true); // Enqueue custom JS for media uploader
        wp_enqueue_style('realEstate-ors-admin-css', get_template_directory_uri() . '/assets/css/admin.css', array(), null); // Enqueue custom admin CSS
    }
}
add_action('admin_enqueue_scripts', 'realEstate_ors_enqueue_media_uploader');
