<?php
/**
 * Loop Single
 * ========================================================================
 * loop-single.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 * @author       Beau Charman | @beaucharman | http://www.beaucharman.me
 * @link         https://github.com/beaucharman/samurai
 * @license      MIT license
 */
?>

<?php while (have_posts()) : the_post(); ?>

<article <?php post_class('article article__single single entry content post-' . get_the_ID()); ?>>

  <h1 class="article-title">
    <?php the_title(); ?>
  </h1>

  <?php Samurai_Snippet::include_post_meta(); ?>

  <?php if (has_post_thumbnail()) : ?>
  <figure class="featured-image">
    <?php the_post_thumbnail('medium'); ?>
  </figure>
  <?php endif; ?>

  <?php the_content(); ?>

  <footer class="article-footer">

    <?php Samurai_Pagination::include_page_pagination(); ?>

    <?php Samurai_Snippet::back_to_parent_link(); ?>

  </footer>

</article>

<?php Samurai_Pagination::include_archive_pagination(); ?>

<?php Samurai_Snippet::get_comments_template(); ?>

<?php endwhile ; ?>
