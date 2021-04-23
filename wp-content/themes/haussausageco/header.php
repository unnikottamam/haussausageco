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

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=xQ79koakXj">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=xQ79koakXj">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=xQ79koakXj">
    <link rel="manifest" href="/site.webmanifest?v=xQ79koakXj">
    <link rel="mask-icon" href="/safari-pinned-tab.svg?v=xQ79koakXj" color="#cc322b">
    <link rel="shortcut icon" href="/favicon.ico?v=xQ79koakXj">
    <meta name="msapplication-TileColor" content="#cc322b">
    <meta name="theme-color" content="#ffffff">

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
                            <a href="#mobile-menu" class="header__menutoggle d-md-none">
                                <svg class="header__toggle1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z">
                                    </path>
                                </svg>
                                <svg class="header__toggle2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                                    </path>
                                </svg>
                            </a>
                            <?php wp_nav_menu([
                              'container_class' => '',
                              'theme_location' => 'menu-1',
                              'container' => '',
                              'menu_class' => 'header__menu',
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php get_template_part('template-parts/social', 'buttons'); ?>
    </header>