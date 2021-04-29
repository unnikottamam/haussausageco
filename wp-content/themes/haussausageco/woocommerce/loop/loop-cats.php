<?php
/**
 * Template part for displaying the category lists in products category pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package haussausageco
 */

$terms = get_terms('product_cat', [
  'hide_empty' => false,
]);

// Ensure visibility.
if (empty($terms)) {
  return;
}
$count = 0;
?>

<ul class="productcats">
    <?php foreach ($terms as $term) {
      $count++;
      if (is_shop() && $count == 1) {
        echo '<li class="active">';
      } else {
        echo get_queried_object()->term_id == $term->term_id
          ? '<li class="active">'
          : '<li>';
      }
      echo '<a href="' .
        esc_url(get_term_link($term)) .
        '">' .
        $term->name .
        '</a></li>';
    } ?>
</ul>