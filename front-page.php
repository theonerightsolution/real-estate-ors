<?php
get_header();
// Get the theme options
$options = get_option('realEstate_ors_options');
// Retrieve the logo URL
$banner_img_1 = esc_url($options['banner_image']);
$banner_img_2 = esc_url($options['banner_image_2']);
$banner_img_3 = esc_url($options['banner_image_3']);
$banner_heading = esc_attr($options['banner_heading']);
$banner_body_text = isset($options['banner_body_text']) ? $options['banner_body_text'] : '';
$about_us_heading = esc_attr($options['about_us_heading']);
$about_us_heading = str_replace("\\", "", $about_us_heading);
$about_us_body_text = esc_attr($options['about_us_body_text']);
$about_us_key_point_text_1 = esc_attr($options['about_us_key_point_text_1']);
$about_us_key_point_text_2 = esc_attr($options['about_us_key_point_text_2']);
$about_us_key_point_text_3 = esc_attr($options['about_us_key_point_text_3']);
$about_us_key_point_body_1 = esc_attr($options['about_us_key_point_body_1']);
$about_us_key_point_body_2 = esc_attr($options['about_us_key_point_body_2']);
$about_us_key_point_body_3 = esc_attr($options['about_us_key_point_body_3']);
$countdown_no_1 = (int)esc_attr($options['countdown_no_1']);
$countdown_no_2 = (int)esc_attr($options['countdown_no_2']);
$countdown_no_3 = (int)esc_attr($options['countdown_no_3']);
$countdown_no_4 = (int)esc_attr($options['countdown_no_4']);
$countdown_text_1 = esc_attr($options['countdown_text_1']);
$countdown_text_2 = esc_attr($options['countdown_text_2']);
$countdown_text_3 = esc_attr($options['countdown_text_3']);
$countdown_text_4 = esc_attr($options['countdown_text_4']);
$cta_heading = esc_attr($options['cta_heading']);
$cta_body_text = esc_attr($options['cta_body_text']);
$cta_button_text = esc_attr($options['cta_button_text']);
$cta_button_url = esc_url($options['cta_button_url']);
?>
<!-- Hero Slider -->
<div class="hero">
    <div class="hero-slide">
        <div
            class="img overlay"
            style="background-image: url('<?php echo $banner_img_1; ?>')"></div>
        <div
            class="img overlay"
            style="background-image: url('<?php echo $banner_img_2; ?>')"></div>
        <div
            class="img overlay"
            style="background-image: url('<?php echo $banner_img_3; ?>')"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center">
                <h1 class="heading" data-aos="fade-up">
                    <?php echo $banner_heading; ?>
                </h1>
                <div class="realEstateOrs_banner_body_text">
                    <?php
                    if ($banner_body_text) {
                        echo wp_kses_post($banner_body_text); // Output the content, allowing safe HTML
                    } ?>
                </div>
                <form
                    action="#"
                    class="narrow-w form-search d-flex align-items-stretch mb-3"
                    data-aos="fade-up"
                    data-aos-delay="200">
                    <input
                        type="text"
                        class="form-control px-4"
                        placeholder="Your ZIP code or City. e.g. New York" />
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Hero Slider Ending -->

<!-- Popular properties -->
<div class="section">
    <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="font-weight-bold text-primary heading">
                    Popular Properties
                </h2>
            </div>
            <div class="col-lg-6 text-lg-end">
                <p>
                    <a
                        href="#"
                        target="_blank"
                        class="btn btn-primary text-white py-3 px-4">View all properties</a>
                </p>
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
<!-- Popular properties Ending -->

<!-- Features -->
<section class="features-1">
    <div class="container">
        <div class="row">
            <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="box-feature">
                    <span class="flaticon-house"></span>
                    <h3 class="mb-3">Our Properties</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Voluptates, accusamus.
                    </p>
                    <p><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
            <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                <div class="box-feature">
                    <span class="flaticon-building"></span>
                    <h3 class="mb-3">Property for Sale</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Voluptates, accusamus.
                    </p>
                    <p><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
            <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="box-feature">
                    <span class="flaticon-house-3"></span>
                    <h3 class="mb-3">Real Estate Agent</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Voluptates, accusamus.
                    </p>
                    <p><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
            <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                <div class="box-feature">
                    <span class="flaticon-house-1"></span>
                    <h3 class="mb-3">House for Sale</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Voluptates, accusamus.
                    </p>
                    <p><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Features Ending -->

<!-- Tesitmonial -->
<div class="section sec-testimonials">
    <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-md-6">
                <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
                    Customer Says
                </h2>
            </div>
            <div class="col-md-6 text-md-end">
                <div id="testimonial-nav">
                    <span class="prev" data-controls="prev">Prev</span>

                    <span class="next" data-controls="next">Next</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4"></div>
        </div>
        <div class="testimonial-slider-wrap">
            <div class="testimonial-slider">
                <?php
                // Start the custom query loop for 'testimonial' post type
                $args = array(
                    'post_type' => 'testimonial',
                    'posts_per_page' => -1 // Change this to limit the number of testimonials displayed
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        // Get custom field values
                        $position = get_post_meta(get_the_ID(), '_testimonial_position', true);
                        $rating = get_post_meta(get_the_ID(), '_testimonial_rating', true);
                        $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); // Assuming the featured image is used for the author’s photo
                        $name = get_the_title(); // Testimonial author's name
                        $description = get_the_content(); // Testimonial content
                ?>

                        <div class="item">
                            <div class="testimonial">
                                <img
                                    src="<?php echo esc_url($featured_image_url ? $featured_image_url : get_template_directory_uri() . '/assets/images/person_1-min.jpg'); ?>"
                                    alt="<?php echo esc_attr($name); ?>"
                                    class="img-fluid rounded-circle w-25 mb-4" />

                                <div class="rate">
                                    <?php
                                    // Loop to output star icons based on rating
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo '<span class="icon-star ' . ($i <= $rating ? 'text-warning' : 'text-muted') . '"></span>';
                                    }
                                    ?>
                                </div>

                                <h3 class="h5 text-primary mb-4"><?php echo esc_html($name); ?></h3>

                                <blockquote>
                                    <p>&ldquo;<?php echo esc_html($description); ?>&rdquo;</p>
                                </blockquote>

                                <p class="text-black-50"><?php echo esc_html($position); ?></p>
                            </div>
                        </div>

                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No testimonials found.</p>';
                endif;
                ?>

            </div>
        </div>
    </div>
</div>
<!-- Tesitmonial Ending -->

<!-- About Us -->
<div class="section section-4 bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-5">
                <h2 class="font-weight-bold heading text-primary mb-4">
                    <?php echo esc_html($about_us_heading); ?>
                </h2>
                <p class="text-black-50">
                    <?php echo $about_us_body_text; ?>
                </p>
            </div>
        </div>
        <div class="row justify-content-between mb-5">
            <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
                <div class="img-about dots">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/hero_bg_3.jpg' ?>" alt="Image" class="img-fluid" />
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex feature-h">
                    <span class="wrap-icon me-3">
                        <span class="icon-home2"></span>
                    </span>
                    <div class="feature-text">
                        <h3 class="heading"><?php echo $about_us_key_point_text_1; ?></h3>
                        <p class="text-black-50">
                            <?php echo $about_us_key_point_body_1; ?>
                        </p>
                    </div>
                </div>

                <div class="d-flex feature-h">
                    <span class="wrap-icon me-3">
                        <span class="icon-person"></span>
                    </span>
                    <div class="feature-text">
                        <h3 class="heading"><?php echo $about_us_key_point_text_2; ?></h3>
                        <p class="text-black-50">
                            <?php echo $about_us_key_point_body_2; ?>
                        </p>
                    </div>
                </div>

                <div class="d-flex feature-h">
                    <span class="wrap-icon me-3">
                        <span class="icon-security"></span>
                    </span>
                    <div class="feature-text">
                        <h3 class="heading"><?php echo $about_us_key_point_text_3; ?></h3>
                        <p class="text-black-50">
                            <?php echo $about_us_key_point_body_3; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row section-counter mt-5">
            <div
                class="col-6 col-sm-6 col-md-6 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="300">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary"><?php echo $countdown_no_1; ?></span></span>
                    <span class="caption text-black-50"><?php echo $countdown_text_1; ?></span>
                </div>
            </div>
            <div
                class="col-6 col-sm-6 col-md-6 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="400">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary"><?php echo $countdown_no_2; ?></span></span>
                    <span class="caption text-black-50"><?php echo $countdown_text_2; ?></span>
                </div>
            </div>
            <div
                class="col-6 col-sm-6 col-md-6 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="500">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary"><?php echo $countdown_no_3; ?></span></span>
                    <span class="caption text-black-50"><?php echo $countdown_text_3; ?></span>
                </div>
            </div>
            <div
                class="col-6 col-sm-6 col-md-6 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="600">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary"><?php echo $countdown_no_4; ?></span></span>
                    <span class="caption text-black-50"><?php echo $countdown_text_4; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Us Ending -->

<!-- CTA -->
<div class="section">
    <div class="row justify-content-center footer-cta" data-aos="fade-up">
        <div class="col-lg-7 mx-auto text-center">
            <h2 class="mb-4"><?php echo $cta_heading; ?></h2>
            <p><?php echo $cta_body_text; ?></p>
            <p>
                <a
                    href="<?php echo $cta_button_url; ?>"
                    target="_blank"
                    class="btn btn-primary text-white py-3 px-4"><?php echo $cta_button_text; ?></a>
            </p>
        </div>
        <!-- /.col-lg-7 -->
    </div>
    <!-- /.row -->
</div>
<!-- CTA Ending -->

<!-- Our Staff -->
<div class="section section-5 bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-6 mb-5">
                <h2 class="font-weight-bold heading text-primary mb-4">
                    Our Agents
                </h2>
                <p class="text-black-50">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
                    enim pariatur similique debitis vel nisi qui reprehenderit totam?
                    Quod maiores.
                </p>
            </div>
        </div>
        <div class="row">
            <?php
            // Query to get agents
            $args = array(
                'post_type'      => 'agents',
                'posts_per_page' => 3, // Fetch all agents
            );
            $agents_query = new WP_Query($args);

            if ($agents_query->have_posts()) : ?>
                <div class="row">
                    <?php while ($agents_query->have_posts()) : $agents_query->the_post(); ?>
                        <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                            <div class="h-100 person">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img
                                        src="<?php echo get_the_post_thumbnail_url(); ?>"
                                        alt="<?php the_title(); ?>"
                                        class="img-fluid" />
                                <?php else : ?>
                                    <img
                                        src="<?php echo get_template_directory_uri() . '/assets/images/default-person.jpg'; ?>" <!-- Use a default image if no featured image -->
                                    alt="Default Image"
                                    class="img-fluid" />
                                <?php endif; ?>

                                <div class="person-contents">
                                    <h2 class="mb-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <span class="meta d-block mb-3">
                                        <?php echo get_post_meta(get_the_ID(), '_job_title', true); ?> <!-- Retrieve job title from meta -->
                                    </span>
                                    <p><?php the_content(); ?></p>

                                    <ul class="social list-unstyled list-inline dark-hover">
                                        <li class="list-inline-item">
                                            <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_fb_link', true)); ?>"><span class="icon-facebook"></span></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_insta_link', true)); ?>"><span class="icon-instagram"></span></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_linkedin_link', true)); ?>"><span class="icon-linkedin"></span></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_twitter_link', true)); ?>"><span class="icon-twitter"></span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php
            endif;

            // Reset post data
            wp_reset_postdata();
            ?>

        </div>
    </div>
</div>
<!-- Our Staff Ending -->
<?php
get_footer();
?>