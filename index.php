<?php
get_header();
$title = get_the_archive_title();
$title = str_replace("Archives: ", "", $title);
?>
<style>
    .realEstate_ors_blog_container .pagination {
        gap: 14px !important;
    }
</style>
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
            <div class="col-9">
                <div class="realEstate_ors_blog_container">
                    <?php
                    // Custom query for pagination
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'post_type' => 'post', // Replace with your post type
                        'posts_per_page' => 3, // Number of posts per page
                        'paged' => $paged,
                    );
                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post(); ?>

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

                        <?php endwhile; ?>
                </div>
                <div class="pagination">
                    <?php
                        // Pagination links
                        echo paginate_links(array(
                            'total' => $query->max_num_pages,
                            'current' => $paged,
                            'mid_size' => 2,
                            'prev_text' => __('&laquo; Previous', 'real-estate-ors'),
                            'next_text' => __('Next &raquo;', 'real-estate-ors'),

                        ));
                    ?>
                </div>

            <?php else :
                        echo '<p>No posts found.</p>';
                    endif;

                    // Reset Post Data
                    wp_reset_postdata();
            ?>


            </div>
            <div class="col-3">
                <?php if (is_active_sidebar('blog-widget')) : ?>
                    <?php dynamic_sidebar('blog-widget'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>