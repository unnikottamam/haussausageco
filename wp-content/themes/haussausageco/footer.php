<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package haussausageco
 */
get_template_part('template-parts/instagram', 'images'); ?>

<footer class="footer text-white">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <a href="<?php echo home_url(); ?>" class="footer__logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="logo">
                </a>
                <p>
                    #4 - 515 Dupplin Road Victoria, BC <br>
                    <a class="footer__tel" href="tel:+17784334287">778-433-4287</a>
                </p>
                <?php get_template_part('template-parts/social', 'buttons', [
                  'class' => 'light',
                ]); ?>
            </div>
        </div>
    </div>
    <a href="https://foecreative.com" target="_blank" class="footer__brand">Crafted By FOE</a>
</footer>

<script src="<?php echo get_template_directory_uri(); ?>/dist/js/app.js"></script>

<?php wp_footer(); ?>

</body>

</html>