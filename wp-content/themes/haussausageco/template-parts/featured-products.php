<?php
/**
 * Template part for displaying top 3 featured products
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package haussausageco
 */

$args = [
  'post_type' => 'product',
  'posts_per_page' => 3,
  'tax_query' => [
    [
      'taxonomy' => 'product_visibility',
      'field' => 'name',
      'terms' => 'featured',
    ],
  ],
];
query_posts($args);
if (have_posts()) {
  $count = 0; ?>
<section id="featured-products" class="carousel slide featureprods text-white" data-ride="carousel">
   <div class="carousel-inner text-center text-md-right">
      <?php while (have_posts()) {

        $count++;
        the_post();
        $product = wc_get_product(get_the_ID());
        $gallery__imgs = $product->get_gallery_image_ids();
        ?>
      <div class="carousel-item <?php echo $count == 1 ? 'active' : ''; ?>">
         <?php if ($gallery__imgs) {
           echo wp_get_attachment_image($gallery__imgs[0], 'medium', "", [
             "alt" => $product->get_name(),
           ]);
         } ?>
         <div class="container">
            <div class="row justify-content-end">
               <div class="col-md-6">
                  <div class="carousel-content">
                     <h3>Featured</h3>
                     <h2><?php echo $product->get_name(); ?></h2>
                     <p><?php echo $product->get_short_description(); ?></p>
                     <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary">VIEW PRODUCT</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php
      } ?>
   </div>
   <?php if ($count > 1) {
     get_template_part('template-parts/carousel', 'arrows', [
       'id' => '#featured-products',
     ]);
   } ?>
</section>
<?php
} else {
  return;
}
wp_reset_query();