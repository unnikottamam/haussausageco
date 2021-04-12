<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit();

get_header('shop');
?>
<section class="banner text-primary">
   <div class="container">
      <div class="row banner__row banner-full-h">
         <div class="col-12 text-center">
            <?php
            if (apply_filters('woocommerce_show_page_title', true)) { ?>
            <h1><?php woocommerce_page_title(); ?></h1>
            <?php }
            do_action('woocommerce_archive_description');
            ?>
            <a href="#shop-now" class="btn btn-outline-primary scroll-down">Shop Now</a>
         </div>
      </div>
   </div>
</section>
<section id="featured-products" class="carousel slide featureprods text-white" data-ride="carousel">
   <div class="carousel-inner text-center text-md-right">
      <div class="carousel-item active">
         <img src="<?php echo get_template_directory_uri(); ?>/images/featured-thumbnail.jpg" alt="featured-product">
         <div class="container">
            <div class="row justify-content-end">
               <div class="col-md-6">
                  <div class="carousel-content">
                     <h3>Featured</h3>
                     <h2>maple blueberry</h2>
                     <p>The ultimate breakfast sausage. %100 maple syrup with allspice and marjoram, and of course, lots
                        of
                        fresh BC blueberries.</p>
                     <a href="#" class="btn btn-outline-primary">VIEW PRODUCT</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="carousel-item">
         <img src="<?php echo get_template_directory_uri(); ?>/images/featured-thumbnail.jpg" alt="featured-product">
         <div class="container">
            <div class="row justify-content-end">
               <div class="col-md-6">
                  <div class="carousel-content">
                     <h3>Featured</h3>
                     <h2>maple blueberry</h2>
                     <p>The ultimate breakfast sausage. %100 maple syrup with allspice and marjoram, and of course, lots
                        of
                        fresh BC blueberries.</p>
                     <a href="#" class="btn btn-outline-primary">VIEW PRODUCT</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <a class="carousel-control-prev" href="#featured-products" role="button" data-slide="prev">
      <svg xmlns="http://www.w3.org/2000/svg" width="18.813" height="29.313" viewBox="0 0 18.813 29.313">
         <path d="M-2724.775,1325.6l-16.407-13.3,16.407-13.2" transform="translate(2742.182 -1297.695)"
            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke-dasharray="1 4" />
      </svg>
      <span class="sr-only">Previous</span>
   </a>
   <a class="carousel-control-next" href="#featured-products" role="button" data-slide="next">
      <svg xmlns="http://www.w3.org/2000/svg" width="18.813" height="29.313" viewBox="0 0 18.813 29.313">
         <path d="M-2724.775,1325.6l-16.407-13.3,16.407-13.2" transform="translate(-2723.369 1327.008) rotate(180)"
            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke-dasharray="1 4" />
      </svg>
      <span class="sr-only">Next</span>
   </a>
</section>

<?php do_action('woocommerce_before_main_content'); ?>
<section class="py-6">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <?php wc_get_template_part('loop/loop', 'cats'); ?>
         </div>
         <div class="col-12">
            <?php if (woocommerce_product_loop()) {
              do_action('woocommerce_before_shop_loop');
              woocommerce_product_loop_start();

              if (wc_get_loop_prop('total')) {
                while (have_posts()) {
                  the_post();
                  do_action('woocommerce_shop_loop');
                  wc_get_template_part('content', 'product');
                }
              }

              woocommerce_product_loop_end();
              do_action('woocommerce_after_shop_loop');
            } else {
              do_action('woocommerce_no_products_found');
            } ?>
         </div>
      </div>
   </div>
</section>
<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
get_footer('shop');