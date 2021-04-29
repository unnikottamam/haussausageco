<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package haussausageco
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function haussausageco_woocommerce_setup()
{
  add_theme_support('woocommerce', [
    'thumbnail_image_width' => 274,
    'single_image_width' => 390,
    'single_image_height' => 390,
    'product_grid' => [
      'default_rows' => 12,
      'min_rows' => 1,
      'default_columns' => 3,
      'min_columns' => 1,
      'max_columns' => 6,
    ],
  ]);
}
add_action('after_setup_theme', 'haussausageco_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function haussausageco_woocommerce_scripts()
{
  if (function_exists('is_woocommerce')) {
    if (is_woocommerce() || is_cart() || is_checkout()) {
      $font_path = WC()->plugin_url() . '/assets/fonts/';
      $inline_font =
        '@font-face {
			font-family: "star";
			src: url("' .
        $font_path .
        'star.eot");
			src: url("' .
        $font_path .
        'star.eot?#iefix") format("embedded-opentype"),
				url("' .
        $font_path .
        'star.woff") format("woff"),
				url("' .
        $font_path .
        'star.ttf") format("truetype"),
				url("' .
        $font_path .
        'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

      wp_add_inline_style('haussausageco-woocommerce-style', $inline_font);
    }
  }
}
add_action('wp_enqueue_scripts', 'haussausageco_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function haussausageco_woocommerce_active_body_class($classes)
{
  $classes[] = 'woocommerce-active';

  return $classes;
}
add_filter('body_class', 'haussausageco_woocommerce_active_body_class');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function haussausageco_woocommerce_related_products_args($args)
{
  $defaults = [
    'posts_per_page' => 3,
    'columns' => 3,
  ];

  $args = wp_parse_args($defaults, $args);

  return $args;
}
add_filter(
  'woocommerce_output_related_products_args',
  'haussausageco_woocommerce_related_products_args'
);

/**
 * Remove default WooCommerce wrapper.
 */
remove_action(
  'woocommerce_before_main_content',
  'woocommerce_output_content_wrapper',
  10
);
remove_action(
  'woocommerce_after_main_content',
  'woocommerce_output_content_wrapper_end',
  10
);

if (!function_exists('haussausageco_woocommerce_wrapper_before')) {
  /**
   * Before Content.
   *
   * Wraps all WooCommerce content in wrappers which match the theme markup.
   *
   * @return void
   */
  function haussausageco_woocommerce_wrapper_before()
  {
    ?>
<main class="woo-pages">
    <?php
  }
}
add_action(
  'woocommerce_before_main_content',
  'haussausageco_woocommerce_wrapper_before'
);

if (!function_exists('haussausageco_woocommerce_wrapper_after')) {
  /**
   * After Content.
   *
   * Closes the wrapping divs.
   *
   * @return void
   */
  function haussausageco_woocommerce_wrapper_after()
  {
    ?>
</main><!-- #main -->
<?php
  }
}
add_action(
  'woocommerce_after_main_content',
  'haussausageco_woocommerce_wrapper_after'
);

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
 */
// if ( function_exists( 'haussausageco_woocommerce_header_cart' ) ) {
// 		haussausageco_woocommerce_header_cart();
// 	}

if (!function_exists('haussausageco_woocommerce_cart_link_fragment')) {
  /**
   * Cart Fragments.
   *
   * Ensure cart contents update when products are added to the cart via AJAX.
   *
   * @param array $fragments Fragments to refresh via AJAX.
   * @return array Fragments to refresh via AJAX.
   */
  function haussausageco_woocommerce_cart_link_fragment($fragments)
  {
    ob_start();
    haussausageco_woocommerce_cart_link();
    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
  }
}
add_filter(
  'woocommerce_add_to_cart_fragments',
  'haussausageco_woocommerce_cart_link_fragment'
);

if (!function_exists('haussausageco_woocommerce_cart_link')) {
  /**
   * Cart Link.
   *
   * Displayed a link to the cart including the number of items present and the cart total.
   *
   * @return void
   */
  function haussausageco_woocommerce_cart_link()
  {
    ?>
<a class="cart-contents" href="<?php echo esc_url(
  wc_get_cart_url()
); ?>" title="<?php esc_attr_e('View your shopping cart', 'haussausageco'); ?>">
    <?php $item_count_text = sprintf(
      /* translators: number of items in the mini cart. */
      _n(
        '%d item',
        '%d items',
        WC()->cart->get_cart_contents_count(),
        'haussausageco'
      ),
      WC()->cart->get_cart_contents_count()
    ); ?>
    <span class="amount"><?php echo wp_kses_data(
      WC()->cart->get_cart_subtotal()
    ); ?></span> <span class="count"><?php echo esc_html(
  $item_count_text
); ?></span>
</a>
<?php
  }
}

if (!function_exists('haussausageco_woocommerce_header_cart')) {
  /**
   * Display Header Cart.
   *
   * @return void
   */
  function haussausageco_woocommerce_header_cart()
  {
    if (is_cart()) {
      $class = 'current-menu-item';
    } else {
      $class = '';
    } ?>
<ul id="site-header-cart" class="site-header-cart">
    <li class="<?php echo esc_attr($class); ?>">
        <?php haussausageco_woocommerce_cart_link(); ?>
    </li>
    <li>
        <?php
        $instance = [
          'title' => '',
        ];

        the_widget('WC_Widget_Cart', $instance);?>
    </li>
</ul>
<?php
  }
}

// Remove Woo functions
add_filter('woocommerce_get_stock_html', '__return_empty_string', 10, 2);
remove_action(
  'woocommerce_before_single_product_summary',
  'woocommerce_show_product_sale_flash',
  40
);
remove_action(
  'woocommerce_single_product_summary',
  'woocommerce_template_single_rating',
  10
);
remove_action(
  'woocommerce_single_product_summary',
  'woocommerce_template_single_meta',
  40
);
remove_action(
  'woocommerce_single_product_summary',
  'woocommerce_template_single_sharing',
  50
);
remove_action(
  'woocommerce_single_product_summary',
  'woocommerce_template_single_price',
  10
);
remove_action(
  'woocommerce_after_shop_loop_item',
  'woocommerce_template_loop_add_to_cart'
);
remove_action(
  'woocommerce_before_shop_loop_item_title',
  'woocommerce_show_product_loop_sale_flash'
);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action(
  'woocommerce_before_shop_loop',
  'woocommerce_catalog_ordering',
  30
);

// Woocommerce Breadcrumbs change
add_filter('woocommerce_breadcrumb_defaults', 'new_woocommerce_breadcrumbs');
function new_woocommerce_breadcrumbs()
{
  return [
    'delimiter' => '',
    'wrap_before' =>
      '<nav aria-label="breadcrumb" class="machinebreads d-none d-md-block"><div class="container"><ol class="breadcrumb">',
    'wrap_after' => '</ul></div></nav>',
    'before' => '<li class="breadcrumb-item">',
    'after' => '</li>',
    'home' => _x('Home', 'breadcrumb', 'woocommerce'),
  ];
}

// Change Additional Information tab title
add_filter(
  'woocommerce_product_additional_information_tab_title',
  'cmg_information_tab_title'
);
function cmg_information_tab_title()
{
  return 'More Information';
}

// Change form fields
add_filter('woocommerce_form_field', 'woo_form_field');
function woo_form_field($field)
{
  return preg_replace('#form-row#', 'form-row flex-column form-group', $field);
}

add_filter('woocommerce_form_field', 'woo_form_field_select');
function woo_form_field_select($field)
{
  return preg_replace(
    '#country_select#',
    'country_select form-control',
    $field
  );
}

add_filter('woocommerce_form_field', 'woo_form_field_class');
function woo_form_field_class($field)
{
  return preg_replace('#input-text#', 'form-control', $field);
}

// Add Wrapper in between images in product loop
// Add the opening div to the img
function add_img_wrapper_start()
{
  echo '<div class="productloop__img">';
}
add_action(
  'woocommerce_before_shop_loop_item_title',
  'add_img_wrapper_start',
  5,
  2
);

// Close the div that we just added
function add_img_wrapper_close()
{
  echo '</div>';
}
add_action(
  'woocommerce_before_shop_loop_item_title',
  'add_img_wrapper_close',
  12,
  2
);