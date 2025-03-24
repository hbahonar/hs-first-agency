<?php

/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
        <link rel="pingback" href="<?php esc_url(get_bloginfo('pingback_url')); ?>">
    <?php endif; ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class('m-0'); ?>>
    <?php wp_body_open(); ?>
    <a class='skip-link screen-reader-text' href='#content' aria-label="<?php esc_attr_e('Skip to content', 'hs-first-agency'); ?>">
        <?php esc_html_e('Skip to content', 'hs-first-agency'); ?>
    </a>

    <?php get_template_part('template-parts/sections/header', null); ?>


