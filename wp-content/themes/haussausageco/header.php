<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and all the header elements in the website
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package haussausageco
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
   <meta charset="<?php bloginfo('charset'); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dist/css/app.min.css" />

   <link rel="profile" href="https://gmpg.org/xfn/11">
   <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
   <?php wp_body_open(); ?>

   <header class="header">
      <div class="container">
         <div class="row header__row align-items-center">
            <div class="col-12">
               <div class="row">
                  <div class="col-md-12 col-10 text-md-center">
                     <a href="<?php echo home_url(); ?>" class="header__logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="logo">
                     </a>
                  </div>
                  <div class="col-md-12 col-2 text-right text-md-center">
                     <ul class="header__menu">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Events</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Contact</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>