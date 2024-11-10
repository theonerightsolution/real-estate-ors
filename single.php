<?php
get_header();
?>
<!-- Banner Start -->
<div class="hero page-inner overlay" style="background-image: url(<?php echo esc_url(get_template_directory_uri()) . '/assets/images/hero_bg_1.jpg'; ?>)">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8 text-center mt-5">
                <h1 class="heading text-white" data-aos="fade-up"><?php echo get_the_title(); ?></h1>
                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url()); ?>">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page"><?php echo get_the_title(); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<div class="section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-9">
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post realEstateSinglePost'); ?>>
                    <header class="entry-header text-center mb-4">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('large', array('class' => 'img-fluid  rounded')); // Larger image with rounded corners
                        } ?>
                        <h2 class="entry-title mt-3"><?php the_title(); ?></h2>
                        <div class="entry-meta text-muted">
                            <span class="posted-on"><?php echo get_the_date(); ?></span> |
                            <span class="byline"> by <?php the_author(); ?></span> |
                            <span class="comments-link"><?php comments_number(); ?></span>
                        </div>
                    </header>

                    <div class="entry-content mb-4">
                        <?php
                        the_content(); // Display full content of the post

                        // Add pagination for multiple page posts
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Pages:', 'real-estate-ors'),
                            'after' => '</div>',
                            'link_before' => '<span class="page-number">',
                            'link_after' => '</span>',
                        ));
                        ?>
                    </div>

                    <footer class="entry-footer text-center">
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                    </footer>
                </article>

                <div class="related-posts">
                    <h3 class="font-weight-bold text-primary">Related Posts</h3>
                    <?php
                    // Query for related posts
                    $related_posts = new WP_Query(array(
                        'category__in' => wp_get_post_categories(get_the_ID()),
                        'post__not_in' => array(get_the_ID()),
                        'posts_per_page' => 3,
                    ));
                    if ($related_posts->have_posts()) : ?>
                        <ul class="list-unstyled">
                            <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>

                <div class="realEstate_ors_comments">
                    <?php comments_template(); // Load comments template 
                    ?>

                    <?php
                    // Add comment pagination if there are multiple comment pages
                    if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                        <div class="comment-pagination">
                            <?php
                            // Use paginate_comments_links for comment pagination
                            paginate_comments_links(array(
                                'prev_text' => __('&laquo; Previous', 'real-estate-ors'),
                                'next_text' => __('Next &raquo;', 'real-estate-ors'),
                                'type' => 'list', // You can use 'plain' for a different format
                            ));
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="col-3">
                        <?php if (is_active_sidebar('blog-widget')) : ?>
                            <?php dynamic_sidebar('blog-widget'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>