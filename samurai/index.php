<?php
/**
 * Index
 *
 * index.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 */

get_header(); ?>

  <?php if (have_posts()) : ?>

    <?php Samurai_Route::get_view('loop') ?>

    <?php Samurai_Pagination::include_single_navigation(); ?>

  <?php else : ?>

    <?php Samurai_Route::get_view('message', 'not-found'); ?>

  <?php endif; ?>

<?php get_footer(); ?>
