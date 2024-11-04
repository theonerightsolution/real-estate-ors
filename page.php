<?php get_header();
$current_title = get_the_title();
?>
<section class="realEstate_ors_page_template">
    <div
        class="hero page-inner overlay"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri()) . '/assets/images/hero_bg_1.jpg' ?>')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up"> <?php echo esc_html($current_title); ?></h1>

                    <nav
                        aria-label="breadcrumb"
                        data-aos="fade-up"
                        data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="<?php echo esc_url(site_url()); ?>">Home</a></li>
                            <li
                                class="breadcrumb-item active text-white-50"
                                aria-current="page">
                                <?php echo esc_html($current_title); ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <?php the_content(); ?>
    </div>
</section>
<?php get_footer(); ?>