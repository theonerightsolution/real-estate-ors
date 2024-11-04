<?php
$site_name = get_bloginfo('name');
// Get the theme options
$options = get_option('realEstate_ors_options');
// Retrieve the logo URL
$logo_url = esc_url($options['header_image']);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <?php wp_head(); ?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <title><?php bloginfo('name');  ?>
        <?php wp_title(); ?>
        <?php if (is_front_page()) {
            echo "| ", bloginfo('description');
        } ?></title>
</head>

<body class="<?php body_class(); ?>">
    <?php wp_body_open(); ?>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav">
        <div class="container">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <a href="<?php echo esc_url(home_url()); ?>" class=" logo m-0 float-start">
                        <?php
                        if ($logo_url) {
                            echo "<img src='" . $logo_url . "' class='realEstate_ors_logo' alt='$site_name'>";
                        } else {
                            echo $site_name;
                        }
                        ?>
                    </a>
                    <?php
                    wp_nav_menu(
                        array(
                            'menu'              => 'primary-menu',
                            'theme_location'    => 'primary',
                            'depth'             => 2,
                            'container'         => false,
                            'menu_class'        => 'js-clone-nav d-none d-lg-inline-block text-start site-menu float-end',
                            'fallback_cb'       => 'wp_bootstrap_navlist_walker::fallback',
                            'walker'            => new wp_bootstrap_navlist_walker()
                        )
                    );
                    ?>
                    <a
                        href="#"
                        class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
                        data-toggle="collapse"
                        data-target="#main-navbar">
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>