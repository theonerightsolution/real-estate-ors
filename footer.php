<!-- Footer -->
<?php
$options = get_option('realEstate_ors_options');
$footer_fb_link = esc_url_raw($options['footer_fb_link']);
$footer_insta_link = esc_url_raw($options['footer_insta_link']);
$footer_linkedin_link = esc_url_raw($options['footer_linkedin_link']);
$footer_twitter_link = esc_url_raw($options['footer_twitter_link']);
$copyright_text = esc_attr($options['copyright_text']);
$copyright_url = esc_url($options['copyright_url']);
?>
<div class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <?php if (is_active_sidebar('footer-widget-1')) : ?>
                    <div class="widget">
                        <?php dynamic_sidebar('footer-widget-1'); ?>
                    </div>
                <?php endif; ?>
                <!-- /.widget -->
            </div>
            <!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <div class="widget">
                    <h3>Sources</h3>
                    <?php
                    if (has_nav_menu('footer')) : ?>
                        <ul id="footer-menu" class="list-unstyled float-start links">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'container'      => false,
                                'menu_class'     => 'footer-menu-items list-unstyled', // Custom class for styling
                            ));
                            ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <div class="widget">
                    <h3>Links</h3>
                    <?php
                    if (has_nav_menu('footer')) : ?>
                        <ul id="footer-menu" class="list-unstyled float-start links">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'container'      => false,
                                'menu_class'     => 'footer-menu-items list-unstyled', // Custom class for styling
                            ));
                            ?>
                        </ul>
                    <?php endif; ?>

                    <ul class="list-unstyled social">
                        <li>
                            <a href="<?php echo $footer_insta_link; ?>"><span class="icon-instagram"></span></a>
                        </li>
                        <li>
                            <a href="<?php echo $footer_twitter_link; ?>"><span class="icon-twitter"></span></a>
                        </li>
                        <li>
                            <a href="<?php echo $footer_fb_link; ?>"><span class="icon-facebook"></span></a>
                        </li>
                        <li>
                            <a href="<?php echo $footer_linkedin_link; ?>"><span class="icon-linkedin"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->

        <div class="row mt-5">
            <div class="col-12 text-center">
                <!-- 
              **==========
              NOTE: 
              Please don't remove this copyright link unless you buy the license here https://untree.co/license/  
              **==========
            -->

                <p>
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    . All Rights Reserved. &mdash; Designed with love by
                    <a href="<?php echo esc_url($copyright_url); ?>"><?php echo esc_html($copyright_text); ?></a>
                </p>

            </div>
        </div>
    </div>
    <!-- /.container -->
</div>
<!-- Footer Ending -->

<!-- Preloader -->
<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<?php wp_footer(); ?>
</body>

</html>