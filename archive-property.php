<?php
get_header();
$title = get_the_archive_title();
$title = str_replace("Archives: ", "", $title);
?>
<!-- Banner Start -->
<div
    class="hero page-inner overlay"
    style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/hero_bg_1.jpg'; ?>)">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up"><?php echo $title; ?></h1>

                <nav
                    aria-label="breadcrumb"
                    data-aos="fade-up"
                    data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo get_site_url(); ?>">Home</a></li>
                        <li
                            class="breadcrumb-item active text-white-50"
                            aria-current="page">
                            <?php echo $title; ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Banner Ending -->

<div class="section">
    <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-lg-6 text-center mx-auto">
                <h2 class="font-weight-bold text-primary heading">
                    Featured Properties
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="property-slider-wrap">
                    <div class="property-slider">
                        <?php
                        $args = array(
                            'post_type' => 'property', // Custom post type slug
                            'posts_per_page' => 10,    // Number of posts to show (you can adjust this)
                        );

                        $property_query = new WP_Query($args);

                        if ($property_query->have_posts()) :
                            while ($property_query->have_posts()) : $property_query->the_post();

                                // Custom fields
                                $price = get_post_meta(get_the_ID(), '_realestate_ors_price', true);
                                $bedrooms = get_post_meta(get_the_ID(), '_realestate_ors_rooms', true);
                                $bathrooms = get_post_meta(get_the_ID(), '_realestate_ors_bathrooms', true);
                                $address = get_post_meta(get_the_ID(), '_realestate_ors_address', true);
                                $state = get_post_meta(get_the_ID(), '_realestate_ors_state', true);
                                $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); // Adjust size as needed
                        ?>

                                <div class="property-item">
                                    <a href="<?php the_permalink(); ?>" class="img">
                                        <?php if ($featured_image_url): ?>
                                            <img src="<?php echo esc_url($featured_image_url); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid" />
                                        <?php else: ?>
                                            <img src="<?php echo get_template_directory_uri() . '/assets/images/default.jpg'; ?>" alt="Default Image" class="img-fluid" />
                                        <?php endif; ?>
                                    </a>

                                    <div class="property-content">
                                        <div class="price mb-2"><span>$<?php echo esc_html($price); ?></span></div>
                                        <div>
                                            <span class="d-block mb-2 text-black-50"><?php echo esc_html($address); ?></span>
                                            <span class="city d-block mb-3"><?php echo esc_html($state); ?></span>

                                            <div class="specs d-flex mb-4">
                                                <span class="d-block d-flex align-items-center me-3">
                                                    <span class="icon-bed me-2"></span>
                                                    <span class="caption"><?php echo esc_html($bedrooms); ?> beds</span>
                                                </span>
                                                <span class="d-block d-flex align-items-center">
                                                    <span class="icon-bath me-2"></span>
                                                    <span class="caption"><?php echo esc_html($bathrooms); ?> baths</span>
                                                </span>
                                            </div>

                                            <a href="<?php the_permalink(); ?>" class="btn btn-primary py-2 px-3">See details</a>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p>No properties found.</p>';
                        endif;
                        ?>

                    </div>

                    <div
                        id="property-nav"
                        class="controls"
                        tabindex="0"
                        aria-label="Carousel Navigation">
                        <span
                            class="prev"
                            data-controls="prev"
                            aria-controls="property"
                            tabindex="-1">Prev</span>
                        <span
                            class="next"
                            data-controls="next"
                            aria-controls="property"
                            tabindex="-1">Next</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>