<?php

/**
 * Template Name: About Us
 */

get_header(); ?>
<div
    class="hero page-inner overlay"
    style="background-image: url(<?php echo esc_url(get_template_directory_uri()) . '/assets/images/hero_bg_3.jpg' ?>)">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up"><?php echo get_the_title(); ?></h1>

                <nav
                    aria-label="breadcrumb"
                    data-aos="fade-up"
                    data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url()); ?>">Home</a></li>
                        <li
                            class="breadcrumb-item active text-white-50"
                            aria-current="page">
                            About
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>