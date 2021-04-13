<?php
/**
 * Payment methods
 *
 * Shows customer payment methods on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/payment-methods.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

defined('ABSPATH') || exit();

$saved_methods = wc_get_customer_saved_methods_list(get_current_user_id());
$has_methods = (bool) $saved_methods;
$types = wc_get_account_payment_methods_types();

do_action('woocommerce_before_account_payment_methods', $has_methods);
?>

<?php if ($has_methods) {

  $total = 0;
  foreach (
    wc_get_account_payment_methods_columns()
    as $column_id => $column_name
  ) {
    $total++;
  }
  ?>
<div class="paymethod">
    <?php foreach ($saved_methods as $type => $methods) { ?>
    <?php foreach ($methods as $method) { ?>
    <div class="paymethod__item">
        <?php
        $count = 0;
        foreach (
          wc_get_account_payment_methods_columns()
          as $column_id => $column_name
        ) {

          $count++;
          if ($count == 1) {
            echo '<div class="row align-items-end"><div class="col-lg-6">';
          }
          if ($count == $total) {
            echo '</div><div class="col-lg-6">';
          }
          ?>
        <div class="paymethod__<?php echo $count; ?>">
            <?php if (
              has_action(
                'woocommerce_account_payment_methods_column_' . $column_id
              )
            ) {
              do_action(
                'woocommerce_account_payment_methods_column_' . $column_id,
                $method
              );
            } elseif ('method' === $column_id) {
              if (!empty($method['method']['last4'])) {
                echo sprintf(
                  esc_html__('%1$s ending in %2$s', 'woocommerce'),
                  esc_html(
                    wc_get_credit_card_type_label($method['method']['brand'])
                  ),
                  esc_html($method['method']['last4'])
                );
              } else {
                echo esc_html(
                  wc_get_credit_card_type_label($method['method']['brand'])
                );
              }
            } elseif ('expires' === $column_id) {
              echo esc_html($method['expires']);
            } elseif ('actions' === $column_id) {
              echo '<ul class="paymethod__actions d-flex flex-wrap justify-content-lg-end">';
              foreach ($method['actions'] as $key => $action) {
                echo '<li><a href="' .
                  esc_url($action['url']) .
                  '" class="btn btn-small btn-outline-primary ' .
                  sanitize_html_class($key) .
                  '">' .
                  esc_html($action['name']) .
                  '</a></li>';
              }
              echo '</ul>';
            } ?>
        </div>
        <?php if ($count == $total) {
          echo '</div></div>';
        }
        }
        ?>
    </div>
    <?php } ?>
    <?php } ?>
</div>

<?php
} else {
   ?>

<h5 class="woocommerce-Message woocommerce-Message--info woocommerce-info">
    <?php esc_html_e('No saved methods found.', 'woocommerce'); ?>
</h5>

<?php
} ?>

<?php do_action('woocommerce_after_account_payment_methods', $has_methods); ?>

<?php if (WC()->payment_gateways->get_available_payment_gateways()) { ?>
<a class="btn btn-outline-primary btn-sm" href="<?php echo esc_url(
  wc_get_endpoint_url('add-payment-method')
); ?>">
    <?php esc_html_e('Add payment method', 'woocommerce'); ?>
</a>
<?php } ?>