<?php
get_header();
$title = get_the_archive_title();
$title = str_replace("Archives: ", "", $title);
?>
<!-- Banner Start -->
<div
    class="hero page-inner overlay"
    style="background-image: url(<?php echo esc_url(get_template_directory_uri()) . '/assets/images/hero_bg_1.jpg'; ?>)">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up"><?php echo $title; ?></h1>

                <nav
                    aria-label="breadcrumb"
                    data-aos="fade-up"
                    data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url()); ?>">Home</a></li>
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
                        if (have_posts()) :
                            while (have_posts()) : the_post(); ?>

                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <header class="entry-header">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail('thumbnail', array('class' => 'realEstateOrs-thumb')); // Custom class added here
                                        } ?>
                                        <h2 class="entry-title">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                        </h2>
                                        <div class="entry-meta">
                                            <span class="posted-on"><?php echo get_the_date(); ?></span>
                                            <span class="byline"> by <?php the_author(); ?></span>
                                        </div>
                                    </header>

                                    <div class="entry-content">
                                        <?php
                                        the_excerpt(); // Display the excerpt of the post.
                                        ?>
                                    </div>

                                    <footer class="entry-footer">
                                        <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                                    </footer>
                                </article>

                        <?php endwhile;

                            the_posts_navigation();

                        else :
                            echo '<p>No posts found.</p>';
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