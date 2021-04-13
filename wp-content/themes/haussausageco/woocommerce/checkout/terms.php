<?php
/**
 * Checkout terms and conditions area.
 *
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit();

if (
  apply_filters('woocommerce_checkout_show_terms', true) &&
  function_exists('wc_terms_and_conditions_checkbox_enabled')
) {
  do_action('woocommerce_checkout_before_terms_and_conditions'); ?>
<div class="woocommerce-terms-and-conditions-wrapper">
    <?php do_action('woocommerce_checkout_terms_and_conditions'); ?>

    <?php if (wc_terms_and_conditions_checkbox_enabled()): ?>
    <div class="custom-control mb-3 custom-checkbox validate-required">
        <input type="checkbox"
            class="custom-control-input woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
            name="terms" <?php checked(
              apply_filters(
                'woocommerce_terms_is_checked_default',
                isset($_POST['terms'])
              ),
              true
            ); ?> id="terms" />
        <label class="custom-control-label woocommerce-form__label woocommerce-form__label-for-checkbox checkbox"
            for="terms">
            <span class="woocommerce-terms-and-conditions-checkbox-text">
                <?php wc_terms_and_conditions_checkbox_text(); ?>
                <span class="required">*</span>
            </span>
        </label>
        <input type="hidden" name="terms-field" value="1" />
    </div>
    <?php endif; ?>
</div>
<?php do_action('woocommerce_checkout_after_terms_and_conditions');
}