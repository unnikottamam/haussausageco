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
if (!is_page()) { ?>

<section class="instaposts">
   <div class="container-fluid">
      <div class="row text-center">
         <div class="col-12">
            <h4>INSTAGRAM</h4>
            <h2>@haussausageco</h2>
         </div>
         <?php for ($i = 0; $i < 4; $i++) { ?>
         <div class="col">
            <a href="#insta-image">
               <img src="<?php echo get_template_directory_uri(); ?>/images/featured-thumbnail.jpg"
                  alt="featured-product">
            </a>
         </div>
         <?php } ?>
      </div>
   </div>
</section>
<?php } ?>

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
         </div>
      </div>
   </div>
   <a href="https://foecreative.com" target="_blank" class="footer__brand">Crafted By FOE</a>
</footer>

<script src="<?php echo get_template_directory_uri(); ?>/dist/js/app.js"></script>

<?php wp_footer(); ?>

</body>

</html>