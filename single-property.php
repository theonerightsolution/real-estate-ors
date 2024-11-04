<?php get_header();
$images = get_post_meta(get_the_ID(), '_realestate_ors_property_images', true);
$images = !empty($images) ? explode(',', $images) : [];
$author_id = get_post_field('post_author', get_the_ID());
$author_data = get_userdata($author_id);
$address = get_post_meta($post->ID, '_realestate_ors_address', true);
$state = get_post_meta($post->ID, '_realestate_ors_state', true);
$country = get_post_meta($post->ID, '_realestate_ors_country', true);
$rooms = get_post_meta($post->ID, '_realestate_ors_rooms', true);
$bathrooms = get_post_meta($post->ID, '_realestate_ors_bathrooms', true);
$price = get_post_meta($post->ID, '_realestate_ors_price', true);

?>

<!-- Banner Start -->
<div
    class="hero page-inner overlay"
    style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hero_bg_3.jpg')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <!-- Dynamic Post Title -->
                <h1 class="heading" data-aos="fade-up">
                    <?php the_title(); ?>
                </h1>

                <nav
                    aria-label="breadcrumb"
                    data-aos="fade-up"
                    data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url()); ?>">Home</a></li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>">Properties</a>
                        </li>
                        <li
                            class="breadcrumb-item active text-white-50"
                            aria-current="page">
                            <?php the_title(); ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Banner Ending -->

<!-- Product Details -->
<div class="section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-7">
                <div class="img-property-slide-wrap">
                    <div class="img-property-slide">
                        <?php
                        if (!empty($images)): ?>
                            <?php foreach ($images as $image): ?>
                                <img src="<?php echo esc_url($image); ?>" alt="Property Image" class="img-fluid" />
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h2 class="heading text-primary"><?php the_title(); ?></h2>
                <p class="meta">
                    <?php
                    // Get the custom meta fields
                    $state = get_post_meta(get_the_ID(), '_realestate_ors_state', true);
                    $country = get_post_meta(get_the_ID(), '_realestate_ors_country', true);
                    echo esc_html($state) . ', ' . esc_html($country);
                    ?>
                </p>
                <ul class="list-unstyled">
                    <li><span class="icon-bed me-2"></span><?php echo $rooms; ?></li>
                    <li><span class="icon-bath me-2"></span><?php echo $bathrooms; ?></li>
                    <li><span class="icon-dollar me-2"></span><?php echo $price; ?></li>
                    <li><span class="icon-home me-2"></span><?php echo $address; ?></li>

                </ul>
                <p class="text-black-50">
                    <?php
                    // Display the main content (description) of the post
                    the_content();
                    ?>
                </p>

                <div class="d-block agent-box p-5">
                    <div class="img mb-4">
                        <?php
                        // Display author avatar
                        echo get_avatar($author_id, 150, '', 'Author Image', ['class' => 'img-fluid']);
                        ?>
                    </div>
                    <div class="text">
                        <h3 class="mb-0 text-capitalize"><?php echo esc_html($author_data->display_name); ?></h3>
                        <!-- <div class="meta mb-3"><?php echo esc_html($author_data->user_nicename); ?></div> -->
                        <p>
                            <?php echo esc_html($author_data->description); ?>
                        </p>
                        <ul class="list-unstyled social dark-hover d-flex">
                            <?php
                            // Social media links
                            $author_instagram = get_the_author_meta('instagram', $author_id);
                            $author_twitter = get_the_author_meta('twitter', $author_id);
                            $author_facebook = get_the_author_meta('facebook', $author_id);
                            $author_linkedin = get_the_author_meta('linkedin', $author_id);

                            if ($author_instagram) : ?>
                                <li class="me-1">
                                    <a href="<?php echo esc_url($author_instagram); ?>" target="_blank"><span class="icon-instagram"></span></a>
                                </li>
                            <?php endif; ?>
                            <?php if ($author_twitter) : ?>
                                <li class="me-1">
                                    <a href="<?php echo esc_url($author_twitter); ?>" target="_blank"><span class="icon-twitter"></span></a>
                                </li>
                            <?php endif; ?>
                            <?php if ($author_facebook) : ?>
                                <li class="me-1">
                                    <a href="<?php echo esc_url($author_facebook); ?>" target="_blank"><span class="icon-facebook"></span></a>
                                </li>
                            <?php endif; ?>
                            <?php if ($author_linkedin) : ?>
                                <li class="me-1">
                                    <a href="<?php echo esc_url($author_linkedin); ?>" target="_blank"><span class="icon-linkedin"></span></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Product Details Ending -->

<?php get_footer(); ?>