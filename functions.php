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


/**
 * Summary of realEstate_ors_register_post_type
 * @return void
 */
function realEstate_ors_register_post_type()
{
    $labels = array(
        'name'               => _x('Properties', 'post type general name', 'textdomain'),
        'singular_name'      => _x('Property', 'post type singular name', 'textdomain'),
        'menu_name'          => _x('Properties', 'admin menu', 'textdomain'),
        'name_admin_bar'     => _x('Property', 'add new on admin bar', 'textdomain'),
        'add_new'            => _x('Add New', 'property', 'textdomain'),
        'add_new_item'       => __('Add New Property', 'textdomain'),
        'new_item'           => __('New Property', 'textdomain'),
        'edit_item'          => __('Edit Property', 'textdomain'),
        'view_item'          => __('View Property', 'textdomain'),
        'all_items'          => __('All Properties', 'textdomain'),
        'search_items'       => __('Search Properties', 'textdomain'),
        'parent_item_colon'  => __('Parent Properties:', 'textdomain'),
        'not_found'          => __('No properties found.', 'textdomain'),
        'not_found_in_trash' => __('No properties found in Trash.', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'properties'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    );

    register_post_type('property', $args);

    // Register Custom Taxonomy for Property Categories
    $taxonomy_labels = array(
        'name'              => _x('Property Categories', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Property Category', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Property Categories', 'textdomain'),
        'all_items'         => __('All Property Categories', 'textdomain'),
        'parent_item'       => __('Parent Property Category', 'textdomain'),
        'parent_item_colon' => __('Parent Property Category:', 'textdomain'),
        'edit_item'         => __('Edit Property Category', 'textdomain'),
        'update_item'       => __('Update Property Category', 'textdomain'),
        'add_new_item'      => __('Add New Property Category', 'textdomain'),
        'new_item_name'     => __('New Property Category Name', 'textdomain'),
        'menu_name'         => __('Property Categories', 'textdomain'),
    );

    $taxonomy_args = array(
        'hierarchical'      => true,
        'labels'            => $taxonomy_labels,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'property-category'),
    );

    register_taxonomy('property_category', array('property'), $taxonomy_args);
}

// Add meta box for multiple images
function realEstate_ors_add_image_meta_box()
{
    add_meta_box(
        'realestate_ors_images',
        __('Property Images', 'textdomain'),
        'realEstate_ors_images_callback',
        'property'
    );
}

add_action('add_meta_boxes', 'realEstate_ors_add_image_meta_box');

function realEstate_ors_images_callback($post)
{
    wp_nonce_field('realestate_ors_save_images', 'realestate_ors_images_nonce');

    $images = get_post_meta($post->ID, '_realestate_ors_property_images', true);
    $images = !empty($images) ? explode(',', $images) : [];

    echo '<div id="realestate-ors-images-container">';
    foreach ($images as $image) {
        echo '<div class="image-item">';
        echo '<img src="' . esc_url($image) . '" style="max-width: 100%; height: auto;" />';
        echo '<input type="hidden" name="realestate_ors_property_images[]" value="' . esc_attr($image) . '" />';
        echo '<button class="remove-image button">Remove</button>';
        echo '</div>';
    }
    echo '</div>';
    echo '<button id="add-image" class="button">Add Image</button>';
    echo '<script>
        jQuery(document).ready(function($) {
            $("#add-image").on("click", function(e) {
                e.preventDefault();
                var mediaUploader;
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                mediaUploader = wp.media({
                    title: "Upload Images",
                    button: {
                        text: "Use this image"
                    },
                    multiple: true // Allow multiple selection
                }).on("select", function() {
                    var attachments = mediaUploader.state().get("selection").toJSON();
                    attachments.forEach(function(attachment) {
                        var imageHtml = \'<div class="image-item"><img src="\' + attachment.url + \'" style="max-width: 100%; height: auto;" /><input type="hidden" name="realestate_ors_property_images[]" value="\' + attachment.url + \'" /><button class="remove-image button">Remove</button></div>\';
                        $("#realestate-ors-images-container").append(imageHtml);
                    });
                }).open();
            });
            $(document).on("click", ".remove-image", function(e) {
                e.preventDefault();
                $(this).closest(".image-item").remove();
            });
        });
    </script>';
}

function realEstate_ors_save_images($post_id)
{
    // Check if our nonce is set.
    if (!isset($_POST['realestate_ors_images_nonce'])) {
        return;
    }

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($_POST['realestate_ors_images_nonce'], 'realestate_ors_save_images')) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don’t want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'property' === $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    // Save the images array
    if (isset($_POST['realestate_ors_property_images'])) {
        $images = array_map('esc_url_raw', $_POST['realestate_ors_property_images']);
        update_post_meta($post_id, '_realestate_ors_property_images', implode(',', $images));
    } else {
        delete_post_meta($post_id, '_realestate_ors_property_images');
    }
}

add_action('save_post', 'realEstate_ors_save_images');
add_action('init', 'realEstate_ors_register_post_type');

add_theme_support('post-thumbnails');



function realEstate_ors_register_testimonial_post_type()
{
    $labels = array(
        'name'               => _x('Testimonials', 'post type general name', 'textdomain'),
        'singular_name'      => _x('Testimonial', 'post type singular name', 'textdomain'),
        'menu_name'          => _x('Testimonials', 'admin menu', 'textdomain'),
        'name_admin_bar'     => _x('Testimonial', 'add new on admin bar', 'textdomain'),
        'add_new'            => _x('Add New', 'testimonial', 'textdomain'),
        'add_new_item'       => __('Add New Testimonial', 'textdomain'),
        'new_item'           => __('New Testimonial', 'textdomain'),
        'edit_item'          => __('Edit Testimonial', 'textdomain'),
        'view_item'          => __('View Testimonial', 'textdomain'),
        'all_items'          => __('All Testimonials', 'textdomain'),
        'search_items'       => __('Search Testimonials', 'textdomain'),
        'parent_item_colon'  => __('Parent Testimonials:', 'textdomain'),
        'not_found'          => __('No testimonials found.', 'textdomain'),
        'not_found_in_trash' => __('No testimonials found in Trash.', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonials'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'), // Includes title and description (editor)
        'menu_icon'          => 'dashicons-testimonial', // Optional: Sets an icon in the admin menu
    );

    register_post_type('testimonial', $args);
}

add_action('init', 'realEstate_ors_register_testimonial_post_type');

// Add custom fields for "Position" and "Rating"
function realEstate_ors_add_testimonial_metabox()
{
    add_meta_box(
        'testimonial_details', // Unique ID
        'Testimonial Details', // Box title
        'realEstate_ors_testimonial_metabox_html', // Content callback
        'testimonial', // Post type
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'realEstate_ors_add_testimonial_metabox');

function realEstate_ors_testimonial_metabox_html($post)
{
    // Retrieve current values
    $position = get_post_meta($post->ID, '_testimonial_position', true);
    $rating = get_post_meta($post->ID, '_testimonial_rating', true);

    // Security nonce field
    wp_nonce_field('testimonial_details_nonce', 'testimonial_details_nonce_field');

?>
    <p>
        <label for="testimonial_position">Position:</label>
        <input type="text" name="testimonial_position" id="testimonial_position" value="<?php echo esc_attr($position); ?>" class="widefat" />
    </p>
    <p>
        <label for="testimonial_rating">Rating:</label>
        <select name="testimonial_rating" id="testimonial_rating" class="widefat">
            <?php for ($i = 0; $i <= 5; $i++): ?>
                <option value="<?php echo $i; ?>" <?php selected($rating, $i); ?>><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </p>
<?php
}

// Save custom field values
function realEstate_ors_save_testimonial_meta($post_id)
{
    // Check for nonce and autosave
    if (!isset($_POST['testimonial_details_nonce_field']) || !wp_verify_nonce($_POST['testimonial_details_nonce_field'], 'testimonial_details_nonce') || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)) {
        return;
    }

    // Save "Position" field
    if (isset($_POST['testimonial_position'])) {
        update_post_meta($post_id, '_testimonial_position', sanitize_text_field($_POST['testimonial_position']));
    }

    // Save "Rating" field
    if (isset($_POST['testimonial_rating'])) {
        update_post_meta($post_id, '_testimonial_rating', intval($_POST['testimonial_rating']));
    }
}

add_action('save_post', 'realEstate_ors_save_testimonial_meta');
