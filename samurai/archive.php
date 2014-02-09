<?php
/**
 * Archive
 *
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * Custom post type? Save this template page as archive-{{slug}}.php
 */

get_header(); ?>

  <?php global $post, $wp_query; $post = $posts[0]; ?>

  <h1 class="archive__heading content-heading"><?php Samurai_Snippet::get_archive_title(); ?></h1>

  <?php if (term_description()) : ?>
  <p class="archive__description term-description">
    <?php echo term_description(); ?>
  </p>
  <?php endif; ?>

  <?php if (have_posts()) : ?>

    <?php Samurai_Route::get_view('loop-archive', get_post_type($post->ID)); ?>

    <?php Samurai_Pagination::include_archive_pagination(); ?>

  <?php else : ?>

    <?php Samurai_Snippet::get_view('message', 'no-posts'); ?>

  <?php endif; ?>

<?php get_footer(); ?>
