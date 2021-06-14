<?php
/**
 * Custom Shipping (select local pick-up)
 *
 * @package haussausageco
 */

// Custom function that handle your settings
function carrier_settings()
{
  return [
    'targeted_methods' => ['local_pickup:33'], // Your targeted shipping method(s) in this array
    'field_id' => 'carrier_name', // Field Id
    'field_type' => 'text', // Field type
    'field_label' => '', // Leave empty value if the first option has a text (see below).
    'label_name' => __("Pickup Date:", "woocommerce"), // for validation and as meta key for orders
  ];
}

// Display the custom checkout field
add_action(
  'woocommerce_after_shipping_rate',
  'carrier_company_custom_select_field',
  20,
  2
);
function carrier_company_custom_select_field($method, $index)
{
  extract(carrier_settings()); // Load settings and convert them in variables

  $chosen = WC()->session->get('chosen_shipping_methods'); // The chosen methods
  $value = WC()->session->get($field_id);
  $value = WC()->session->__isset($field_id)
    ? $value
    : WC()->checkout->get_value('_' . $field_id);
  $options = []; // Initializing

  if (
    !empty($chosen) &&
    $method->id === $chosen[$index] &&
    in_array($method->id, $targeted_methods)
  ) {
    echo '<div class="pickup__date mt-2">';

    // Loop through field otions to add the correct keys
    foreach ($field_options as $key => $option_value) {
      $option_key = $key == 0 ? '' : $key;
      $options[$option_key] = $option_value;
    }

    echo '
    <script>
        jQuery(function($){
            $("#carrier_name").datepicker({
              daysOfWeekDisabled: "1,2,3",
              todayHighlight: true,
              startDate: new Date(),
              autoclose: true
            });
        });
    </script>';
    woocommerce_form_field(
      $field_id,
      [
        'type' => $field_type,
        'label' => '', // Not required if the first option has a text.
        'placeholder' => 'Pickup Date', // Not required if the first option has a text.
        'class' => ['form-row-wide ' . $field_id . '-' . $field_type],
        'required' => true,
        'options' => $options,
        'custom_attributes' => ['readonly' => 'readonly', 'required' => 'true'],
      ],
      $value
    );
    echo '<span class="pickup__choose"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z"/><path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-2 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/></svg></span>';
    echo '</div>';
  }
}

add_action('wp_enqueue_scripts', 'enabling_date_picker');
function enabling_date_picker()
{
  // Only on front-end and checkout page
  if (is_admin() || (!is_checkout() && !is_cart())) {
    return;
  }

  // Load the datepicker jQuery-ui plugin script
  wp_enqueue_script(
    'datepicker',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
    ['jquery'],
    '1.9.0',
    true
  );
}

// jQuery code (client side) - Ajax sender
add_action('wp_footer', 'carrier_company_script_js');
function carrier_company_script_js()
{
  // Only cart & checkout pages
  if (is_cart() || (is_checkout() && !is_wc_endpoint_url())):
    // Load settings and convert them in variables

    extract(carrier_settings());
    $js_variable = is_cart() ? 'wc_cart_params' : 'wc_checkout_params';

    // jQuery Ajax code
    ?>
<script type="text/javascript">
jQuery(function($) {
    if (typeof <?php echo $js_variable; ?> === 'undefined')
        return false;
    $(document.body).on('change', '#<?php echo $field_id; ?>', function() {
        var value = $(this).val() ? $(this).val() : '';
        if (value) {
            $.ajax({
                type: 'POST',
                url: <?php echo $js_variable; ?>.ajax_url,
                data: {
                    'action': 'carrier_name',
                    'value': value
                },
                success: function(result) {
                    console.log(result);
                }
            });
        }
    });
});
</script>
<?php
  endif;
}

// The Wordpress Ajax PHP receiver
add_action('wp_ajax_carrier_name', 'set_carrier_company_name');
add_action('wp_ajax_nopriv_carrier_name', 'set_carrier_company_name');
function set_carrier_company_name()
{
  if (isset($_POST['value'])) {
    // Load settings and convert them in variables
    extract(carrier_settings());

    if (empty($_POST['value'])) {
      $value = 0;
      $label = 'Empty';
    } else {
      $value = $label = esc_attr($_POST['value']);
    }

    // Update session variable
    WC()->session->set($field_id, $value);

    // Send back the data to javascript (json encoded)
    echo $label . ' | ' . $field_options[$value];
    die();
  }
}

// Conditional function for validation
function has_carrier_field()
{
  $settings = carrier_settings();
  return array_intersect(
    WC()->session->get('chosen_shipping_methods'),
    $settings['targeted_methods']
  );
}

// Validate the custom selection field
add_action(
  'woocommerce_checkout_process',
  'pickupdate_validation'
);
function pickupdate_validation()
{
  // Load settings and convert them in variables
  extract(carrier_settings());

  if (
    has_carrier_field() &&
    !($_POST['carrier_name'])
  ) {
    wc_add_notice(
      __("Pick up date is a required field.", "woocommerce"),
      "error"
    );
  }
}

// Save custom field as order meta data
add_action(
  'woocommerce_checkout_create_order',
  'save_carrier_company_as_order_meta',
  20,
  2
);
function save_carrier_company_as_order_meta($order)
{
  extract(carrier_settings());

  if (
    has_carrier_field() &&
    isset($_POST[$field_id]) &&
    !empty($_POST[$field_id])
  ) {
    $order->update_meta_data(
      '_' . $field_id,
      $field_options[esc_attr($_POST[$field_id])]
    );
    WC()->session->__unset($field_id);
  }
}

add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['carrier_name'] ) ) {
        update_post_meta( $order_id, 'Pickup Date', sanitize_text_field( $_POST['carrier_name'] ) );
    }
}

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Pickup Date').':</strong> ' . get_post_meta( $order->id, 'Pickup Date', true ) . '</p>';
}

// Display custom field in admin order pages
add_action(
  'woocommerce_admin_order_data_after_shipping_address',
  'admin_order_display_carrier_company',
  30,
  1
);
function admin_order_display_carrier_company($order)
{
  // Load settings and convert them in variables
  extract(carrier_settings());

  $carrier = $order->get_meta('_' . $field_id); // Get carrier company

  if (!empty($carrier)) {
    // Display
    echo '<p><strong>' . $label_name . '</strong>: ' . $carrier . '</p>';
  }
}

// Display carrier company after shipping line everywhere (orders and emails)
add_filter(
  'woocommerce_get_order_item_totals',
  'display_carrier_company_on_order_item_totals',
  1000,
  3
);
function display_carrier_company_on_order_item_totals(
  $total_rows,
  $order,
  $tax_display
) {
  // Load settings and convert them in variables
  extract(carrier_settings());

  $carrier = $order->get_meta('_' . $field_id); // Get carrier company

  if (!empty($carrier)) {
    $new_total_rows = [];

    // Loop through order total rows
    foreach ($total_rows as $key => $values) {
      $new_total_rows[$key] = $values;

      // Inserting the carrier company under shipping method
      if ($key === 'shipping') {
        $new_total_rows[$field_id] = [
          'label' => $label_name,
          'value' => $carrier,
        ];
      }
    }
    return $new_total_rows;
  }
  return $total_rows;
}

add_filter('woocommerce_email_order_meta_keys', 'my_custom_order_meta_keys');

function my_custom_order_meta_keys( $keys ) {
     $keys[] = 'Pickup Date'; // This will look for a custom field called 'Pickup Date' and add it to emails
     return $keys;
}

function validate($data,$errors) { 
  extract(carrier_settings());
  if (
    has_carrier_field() &&
    !($_POST['carrier_name'])
  ) {
    $errors->add( 'validation', __( 'Pick up date is a required field.' ));
  }
}
add_action('woocommerce_after_checkout_validation', 'validate',10,2);