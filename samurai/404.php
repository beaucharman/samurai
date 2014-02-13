<?php
/**
 * 404
 *
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * 404 error template page.
 */

get_header(); ?>

  <?php Samurai_View::make('message', 'not-found'); ?>

<?php get_footer(); ?>
