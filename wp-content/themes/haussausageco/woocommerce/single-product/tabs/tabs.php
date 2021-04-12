<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if (!defined('ABSPATH')) {
  exit();
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters('woocommerce_product_tabs', []);

if (!empty($product_tabs)) {
  $count = 0; ?>

<div class="pt-5 pb-6 product__tabs tabs" role="tablist">
    <?php if (get_field('nutrition_tab')) {
      $count++; ?>
    <div class="product__tab">
        <h2 class="product__tabtitle" id="tab-title-nutrition" role="tab" aria-controls="tab-nutrition">
            <a class="active" href="#tab-nutrition">Full ingredients + nutrition</a>
        </h2>
        <div class="product__tabcont active" id="tab-nutrition" role="tabpanel" aria-labelledby="tab-title-nutrition">
            <?php the_field('nutrition_tab'); ?>
        </div>
    </div>
    <?php
    } ?>
    <?php foreach ($product_tabs as $key => $product_tab) {
      $count++; ?>
    <div class="product__tab <?php echo $count == 1 ? 'active' : ''; ?>">
        <h2 class="product__tabtitle <?php echo esc_attr(
          $key
        ); ?>_tab" id="tab-title-<?php echo esc_attr(
  $key
); ?>" role="tab" aria-controls="tab-<?php echo esc_attr($key); ?>">
            <a class="<?php echo $count == 1
              ? 'active'
              : ''; ?>" href="#tab-<?php echo esc_attr($key); ?>">
                <?php echo wp_kses_post(
                  apply_filters(
                    'woocommerce_product_' . $key . '_tab_title',
                    $product_tab['title'],
                    $key
                  )
                ); ?>
            </a>
        </h2>
        <div class="product__tabcont tab-<?php echo esc_attr(
          $key
        ); ?>" id="tab-<?php echo esc_attr(
  $key
); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr(
  $key
); ?>">
            <?php if (isset($product_tab['callback'])) {
              call_user_func($product_tab['callback'], $key, $product_tab);
            } ?>
        </div>
    </div>
    <?php
    } ?>
</div>

<?php do_action('woocommerce_product_after_tabs');
}