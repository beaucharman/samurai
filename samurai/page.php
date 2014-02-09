<?php
/**
 * Page
 *
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * Page template.
 *
 * For a different page template for a particular page,
 * save this template page as page-{{slug}}.php
 */

get_header(); ?>

  <?php if (have_posts()) : ?>

    <?php Samurai_Route::get_view('loop', 'page', $post->post_name); ?>

  <?php else : ?>

    <?php Samurai_Route::get_view('message', 'not-found'); ?>

  <?php endif; ?>

<?php get_footer(); ?>
