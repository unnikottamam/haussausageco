<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if (!defined('ABSPATH')) {
  exit(); // Exit if accessed directly.
}

do_action('woocommerce_before_customer_login_form');
?>

<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')): ?>

<div class="u-columns col2-set justify-content-between row" id="customer_login">

    <div class="u-column1 col-lg-5 col-md-6 mt-3 pb-3 col-12">

        <?php endif; ?>

        <h2><?php esc_html_e('Login', 'woocommerce'); ?></h2>

        <form class="form-row flex-column woocommerce-form woocommerce-form-login login" method="post">

            <?php do_action('woocommerce_login_form_start'); ?>

            <div class="form-row flex-column woocommerce-form-row woocommerce-form-row--wide">
                <label for="username"><?php esc_html_e(
                  'Username or email address',
                  'woocommerce'
                ); ?>
                    &nbsp;
                    <span class="required">*</span>
                </label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text form-control" name="username"
                    id="username" autocomplete="username" value="<?php echo !empty(
                      $_POST['username']
                    )
                      ? esc_attr(wp_unslash($_POST['username']))
                      : ''; ?>" />
            </div>
            <div class="form-row flex-column woocommerce-form-row woocommerce-form-row--wide">
                <label for="password"><?php esc_html_e(
                  'Password',
                  'woocommerce'
                ); ?>
                    &nbsp;
                    <span class="required">*</span>
                </label>
                <input class="woocommerce-Input woocommerce-Input--text form-control" type="password" name="password"
                    id="password" autocomplete="current-password" />
            </div>

            <?php do_action('woocommerce_login_form'); ?>

            <div class="custom-control my-3 custom-checkbox">
                <input class="custom-control-input woocommerce-form__input woocommerce-form__input-checkbox"
                    name="rememberme" type="checkbox" id="rememberme" value="forever" />
                <label
                    class="custom-control-label woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme"
                    for="rememberme">
                    <?php esc_html_e('Remember me', 'woocommerce'); ?>
                </label>
            </div>

            <?php wp_nonce_field(
              'woocommerce-login',
              'woocommerce-login-nonce'
            ); ?>
            <div class="row align-items-center">
                <div class="col-sm-4 col-12 mb-1">
                    <button type="submit"
                        class="woocommerce-button btn btn-sm btn-outline-primary woocommerce-form-login__submit"
                        name="login" value="<?php esc_attr_e(
                          'Log in',
                          'woocommerce'
                        ); ?>">
                        <?php esc_html_e('Log in', 'woocommerce'); ?>
                    </button>
                </div>
                <div class="col-sm-8 col-12 text-sm-right">
                    <label class="woocommerce-LostPassword lost_password">
                        <a href="<?php echo esc_url(wp_lostpassword_url()); ?>">
                            <?php esc_html_e(
                              'Lost your password?',
                              'woocommerce'
                            ); ?>
                        </a>
                    </label>
                </div>
            </div>

            <?php do_action('woocommerce_login_form_end'); ?>

        </form>

        <?php if (
          'yes' === get_option('woocommerce_enable_myaccount_registration')
        ): ?>

    </div>

    <div class="u-column2 col-lg-5 col-md-6 mt-3 col-12">

        <h2><?php esc_html_e('Register', 'woocommerce'); ?></h2>

        <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action(
          'woocommerce_register_form_tag'
        ); ?>>

            <?php do_action('woocommerce_register_form_start'); ?>

            <?php if (
              'no' === get_option('woocommerce_registration_generate_username')
            ): ?>

            <div class="form-row flex-column woocommerce-form-row woocommerce-form-row--wide">
                <label for="reg_username"><?php esc_html_e(
                  'Username',
                  'woocommerce'
                ); ?>
                    &nbsp;
                    <span class="required">*</span>
                </label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text form-control" name="username"
                    id="reg_username" autocomplete="username" value="<?php echo !empty(
                      $_POST['username']
                    )
                      ? esc_attr(wp_unslash($_POST['username']))
                      : ''; ?>" />
            </div>

            <?php endif; ?>

            <div class="form-row flex-column woocommerce-form-row woocommerce-form-row--wide">
                <label for="reg_email"><?php esc_html_e(
                  'Email address',
                  'woocommerce'
                ); ?>
                    &nbsp;
                    <span class="required">*</span>
                </label>
                <input type="email" class="woocommerce-Input woocommerce-Input--text form-control" name="email"
                    id="reg_email" autocomplete="email" value="<?php echo !empty(
                      $_POST['email']
                    )
                      ? esc_attr(wp_unslash($_POST['email']))
                      : ''; ?>" />
            </div>

            <?php if (
              'no' === get_option('woocommerce_registration_generate_password')
            ): ?>

            <div class="form-row flex-column woocommerce-form-row woocommerce-form-row--wide">
                <label for="reg_password"><?php esc_html_e(
                  'Password',
                  'woocommerce'
                ); ?>
                    &nbsp;
                    <span class="required">*</span>
                </label>
                <input type="password" class="woocommerce-Input woocommerce-Input--text form-control" name="password"
                    id="reg_password" autocomplete="new-password" />
            </div>

            <?php else: ?>

            <p>
                <?php esc_html_e(
                  'A password will be sent to your email address.',
                  'woocommerce'
                ); ?>
            </p>

            <?php endif; ?>

            <?php do_action('woocommerce_register_form'); ?>

            <?php wp_nonce_field(
              'woocommerce-register',
              'woocommerce-register-nonce'
            ); ?>
            <button type="submit"
                class="woocommerce-Button woocommerce-button btn btn-outline-primary btn-sm woocommerce-form-register__submit"
                name="register" value="<?php esc_attr_e(
                  'Register',
                  'woocommerce'
                ); ?>">
                <?php esc_html_e('Register', 'woocommerce'); ?>
            </button>
            <?php do_action('woocommerce_register_form_end'); ?>
        </form>
    </div>
</div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form');
?>