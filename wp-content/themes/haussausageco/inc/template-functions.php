<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package haussausageco
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function haussausageco_body_classes($classes)
{
  // Adds a class of hfeed to non-singular pages.
  if (!is_singular()) {
    $classes[] = 'hfeed';
  }

  // Adds a class of no-sidebar when there is no sidebar present.
  if (!is_active_sidebar('sidebar-1')) {
    $classes[] = 'no-sidebar';
  }

  return $classes;
}
add_filter('body_class', 'haussausageco_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function haussausageco_pingback_header()
{
  if (is_singular() && pings_open()) {
    printf(
      '<link rel="pingback" href="%s">',
      esc_url(get_bloginfo('pingback_url'))
    );
  }
}
add_action('wp_head', 'haussausageco_pingback_header');

if (function_exists('acf_add_options_page')) {
  acf_add_options_page();
}

// Change Menu Active Clas
function change_menu_classes($css_classes)
{
  $css_classes = str_replace("current-menu-item", "active", $css_classes);
  $css_classes = str_replace("current_page_item", "active", $css_classes);
  $css_classes = str_replace("current-menu-parent", "active", $css_classes);
  $css_classes = str_replace("current-menu-ancestor", "active", $css_classes);
  return $css_classes;
}
add_filter('nav_menu_css_class', 'change_menu_classes');

// Remove woocommerce files to prevent load in certain pages
function remove_woocommerce_files()
{
  if (!is_woocommerce() && !is_cart() && !is_account_page() && !is_checkout()) {
    wp_dequeue_style('woocommerce-general');
    wp_dequeue_style('woocommerce-layout');
    wp_dequeue_style('woocommerce-smallscreen');
    wp_dequeue_style('woocommerce_frontend_styles');
    wp_dequeue_style('woocommerce_fancybox_styles');
    wp_dequeue_style('woocommerce_chosen_styles');
    wp_dequeue_style('woocommerce_prettyPhoto_css');
    wp_dequeue_script('wc_price_slider');
    wp_dequeue_script('wc-single-product');
    wp_dequeue_script('wc-add-to-cart');
    wp_dequeue_script('wc-cart-fragments');
    wp_dequeue_script('wc-checkout');
    wp_dequeue_script('wc-add-to-cart-variation');
    wp_dequeue_script('wc-single-product');
    wp_dequeue_script('wc-cart');
    wp_dequeue_script('wc-chosen');
    wp_dequeue_script('woocommerce');
    wp_dequeue_script('prettyPhoto');
    wp_dequeue_script('prettyPhoto-init');
    wp_dequeue_script('jquery-blockui');
    wp_dequeue_script('jquery-placeholder');
    wp_dequeue_script('fancybox');
    wp_dequeue_script('jqueryui');
    wp_deregister_script('jquery');
    wp_dequeue_script('jquery');
  }
}
add_action('wp_enqueue_scripts', 'remove_woocommerce_files', 11);

// Remove block editor styles to prevent loading
function remove_wp_block_library()
{
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('wc-block-style');
  wp_dequeue_script('fancybox');
}
add_action('wp_enqueue_scripts', 'remove_wp_block_library', 11);

// Remove WP scripts to prevent loading
function wp_deregister_scripts()
{
  wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'wp_deregister_scripts');

// Update Image Size
update_option('medium_size_w', 590);
update_option('medium_size_h', 670);
update_option('medium_crop', 1);

// Allow SVG Image Upload
add_filter(
  'wp_check_filetype_and_ext',
  function ($data, $file, $filename, $mimes) {
    global $wp_version;
    if ($wp_version !== '4.7.1') {
      return $data;
    }

    $filetype = wp_check_filetype($filename, $mimes);

    return [
      'ext' => $filetype['ext'],
      'type' => $filetype['type'],
      'proper_filename' => $data['proper_filename'],
    ];
  },
  10,
  4
);

function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
  echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
}
add_action('admin_head', 'fix_svg');

/**
 * Add Menu Item to end of menu
 */
add_filter('wp_nav_menu_items', 'prefix_add_menu_item', 10, 2);
function prefix_add_menu_item($items, $args)
{
  global $woocommerce;
  if ($args->theme_location == 'menu-1') {
    $active = is_cart() ? "active" : "";
    $items .=
      '<li class="menu-item header__cart ' .
      $active .
      '"><a href="' .
      wc_get_cart_url() .
      '">Cart <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/></svg><span>' .
      $woocommerce->cart->cart_contents_count .
      '</span></a></li>';
  }
  return $items;
}