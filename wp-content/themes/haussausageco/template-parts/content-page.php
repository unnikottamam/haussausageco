<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package haussausageco
 */

get_template_part('template-parts/top', 'banner'); ?>

<main id="primary" class="py-6">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <?php while (have_posts()) {
              the_post();
              the_content();
            } ?>
         </div>
      </div>
   </div>
</main>