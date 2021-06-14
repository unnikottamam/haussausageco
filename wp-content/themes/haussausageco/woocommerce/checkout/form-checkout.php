<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
  exit();
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (
  !$checkout->is_registration_enabled() &&
  $checkout->is_registration_required() &&
  !is_user_logged_in()
) {
  echo esc_html(
    apply_filters(
      'woocommerce_checkout_must_be_logged_in_message',
      __('You must be logged in to checkout.', 'woocommerce')
    )
  );
  return;
}
?>

<style>
.wc-square-credit-card-hosted-field {
    margin: 0 0 0.5rem;
}

.wc-square-credit-card-payment-field {
    border: 1px solid #ccc;
    padding: 0 5px;
    min-height: 30px;
}
</style>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(
  wc_get_checkout_url()
); ?>" enctype="multipart/form-data">

    <?php if ($checkout->get_checkout_fields()): ?>

    <?php do_action('woocommerce_checkout_before_customer_details'); ?>

    <div class="col2-set row" id="customer_details">
        <div class="col-lg-6">
            <?php do_action('woocommerce_checkout_billing'); ?>
        </div>

        <div class="col-lg-6">
            <?php do_action('woocommerce_checkout_shipping'); ?>
        </div>
    </div>

    <?php do_action('woocommerce_checkout_after_customer_details'); ?>

    <?php endif; ?>

    <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
    <div class="mt-3">
        <h3 id="order_review_heading">
            <?php esc_html_e('Your order', 'woocommerce'); ?>
        </h3>

        <?php do_action('woocommerce_checkout_before_order_review'); ?>

        <div id="order_review" class="woocommerce-checkout-review-order">
            <?php
            $cat_in_cart = false;
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
              $cart_item_link = get_permalink($cart_item['product_id']);
              if (strpos($cart_item_link, 'post_type=tribe_events') !== false) {
                $cat_in_cart = true;
                break;
              }
            }
            if ($cat_in_cart) {
              echo do_shortcode('[order_tip_form]');
            }
            ?>
            <?php do_action('woocommerce_checkout_order_review'); ?>
        </div>

        <?php do_action('woocommerce_checkout_after_order_review'); ?>
    </div>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout);
?>