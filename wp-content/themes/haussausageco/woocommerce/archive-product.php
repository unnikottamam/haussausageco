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
                if (
                  apply_filters('woocommerce_show_page_title', true) &&
                  !is_shop()
                ) { ?>
                <h1><?php woocommerce_page_title(); ?></h1>
                <?php }
                do_action('woocommerce_archive_description');
                ?>
                <ul class="banner__btns">
                    <li>
                        <a href="#shop-now" class="btn btn-outline-primary scroll-down">Shop Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php
get_template_part('template-parts/featured', 'products');
wp_reset_query();

do_action('woocommerce_before_main_content');
?>
<section id="shop-now" class="py-6">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php wc_get_template_part('loop/loop', 'cats'); ?>
            </div>
            <div class="col-12">
                <?php
                $terms = get_terms('product_cat', [
                  'hide_empty' => false,
                ]);
                if (!empty($terms) && is_shop()) {
                  echo do_shortcode(
                    '[products category="' . $terms[0]->term_id . '"]'
                  );
                } else {
                  if (woocommerce_product_loop()) {
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
                  }
                }
                ?>
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