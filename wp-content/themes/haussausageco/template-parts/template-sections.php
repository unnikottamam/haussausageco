<?php
/**
 * Template Name: Sections
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package haussausageco
 */

get_header();

if (have_posts()) {
  while (have_posts()) {
    the_post();
    if (have_rows('layouts')) {
      while (have_rows('layouts')) {
        the_row();

        if (get_row_layout() == 'banner') {
          $bg_theme = get_sub_field('bg_theme'); ?>
<section class="banner <?php echo $bg_theme == "primary"
  ? 'text-white'
  : 'text-primary'; ?>">
   <div class="container">
      <div class="row banner__row <?php echo get_sub_field('full_height')
        ? 'banner-full-h'
        : ''; ?>">
         <div class="col-12 text-center">
            <?php
            the_sub_field('banner_contents');
            if (have_rows('buttons')) {
              echo '<ul class="banner__btns">';
              while (have_rows('buttons')) {
                the_row();
                if (get_sub_field('link') && get_sub_field('title')) { ?>
            <li>
               <a href="<?php the_sub_field(
                 'link'
               ); ?>" class="btn btn-outline-primary"><?php the_sub_field(
  'title'
); ?></a>
            </li>
            <?php }
              }
              echo '</ul>';
            }
            ?>
         </div>
      </div>
   </div>
</section>
<?php
        }

        if (get_row_layout() == 'content_area') {

          $bg_theme = get_sub_field('bg_theme');
          switch ($bg_theme) {
            case 'primary':
              $bg_theme .= " text-white";
              break;
            case 'light':
              $bg_theme .= "";
              break;
            default:
              $bg_theme .= "";
              break;
          }
          if (get_sub_field('column_size') == "half") {
            $column_size = 'col-md-8 col-lg-6';
          } elseif (get_sub_field('column_size') == "medium") {
            $column_size = 'col-md-10 col-lg-9 col-xl-8';
          } else {
            $column_size = 'col-12';
          }
          $text_align = get_sub_field('text_align');
          ?>
<section class="contentarea py-6 <?php echo $bg_theme; ?>">
   <div class="container">
      <div class="row justify-content-center">
         <div class="<?php echo $column_size; ?> text-<?php echo $text_align; ?>">
            <?php
            the_sub_field('contents');
            if (have_rows('buttons')) {
              echo '<ul class="ctalist">';
              while (have_rows('buttons')) {
                the_row();
                if (get_sub_field('link') && get_sub_field('title')) { ?>
            <li>
               <a href="<?php the_sub_field(
                 'link'
               ); ?>" class="btn btn-outline-primary"><?php the_sub_field(
  'title'
); ?></a>
            </li>
            <?php }
              }
              echo '</ul>';
            }
            ?>
         </div>
      </div>
   </div>
</section>
<?php
        }

        if (get_row_layout() == 'contact_area') {

          $bg_theme = get_sub_field('bg_theme');
          switch ($bg_theme) {
            case 'primary':
              $bg_theme .= " text-white";
              break;
            case 'light':
              $bg_theme .= "";
              break;
            default:
              $bg_theme .= "";
              break;
          }
          if (get_sub_field('column_size') == "half") {
            $column_size = 'col-md-8 col-lg-6';
          } elseif (get_sub_field('column_size') == "medium") {
            $column_size = 'col-md-10 col-lg-9 col-xl-8';
          } else {
            $column_size = 'col-12';
          }
          $text_align = get_sub_field('text_align');
          ?>
<section class="contactarea py-6 <?php echo $bg_theme; ?>">
   <div class="container">
      <div class="row justify-content-center">
         <div class="<?php echo $column_size; ?> text-<?php echo $text_align; ?>">
            <?php the_sub_field('contents'); ?>
            <div class="mapbox">
               <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2646.4635237340294!2d-123.37824033402413!3d48.44763533603316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x548f73761750eab9%3A0x8b0556e810c8c8ae!2s515%20Dupplin%20Rd%20%234%2C%20Victoria%2C%20BC%20V8Z%201C2!5e0!3m2!1sen!2sca!4v1618298266276!5m2!1sen!2sca"
                  allowfullscreen="allowfullscreen"></iframe>
            </div>
            <?php if (have_rows('buttons')) {
              echo '<ul class="ctalist">';
              while (have_rows('buttons')) {
                the_row();
                if (get_sub_field('link') && get_sub_field('title')) { ?>
            <li>
               <a href="<?php the_sub_field(
                 'link'
               ); ?>" class="btn btn-outline-primary"><?php the_sub_field(
  'title'
); ?></a>
            </li>
            <?php }
              }
              echo '</ul>';
            } ?>
         </div>
      </div>
   </div>
</section>
<?php
        }

        if (get_row_layout() == 'featured_products') {
          get_template_part('template-parts/featured', 'products');
        }
      }
    } else {
      get_template_part('template-parts/content', 'page');
    }
  }
}

get_footer();