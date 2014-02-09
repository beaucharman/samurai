<?php
/**
 * Taxonomy Template
 *
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * Taxonomy template page.
 * Custom taxonomy? Save this template page as taxonomy-{{slug}}.php
 */

global $wp_query;
$taxonomy_term = $wp_query->get_queried_object();

get_header(); ?>

  <h1 class="term__heading content-title">
    <?php echo $taxonomy_term->name; ?>
  </h1>

  <?php if (term_description()) : ?>
    <p class="term-description">
      <?php remove_filter('term_description','wpautop'); echo term_description(); ?>
    </p>
  <?php endif; ?>

  <?php if (have_posts()) : ?>

    <?php Samurai_Route::get_view('loop-taxonomy', $taxonomy_term->slug); ?>

    <?php Samurai_Pagination::include_archive_pagination(); ?>

  <?php else : ?>

    <?php Samurai_Route::get_view('message', 'not-found'); ?>

  <?php endif; ?>

<?php get_footer(); ?>
