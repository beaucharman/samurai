<?php
/**
 * Loop Taxonomy
 * ========================================================================
 * loop-taxonomy.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 * @author       Beau Charman | @beaucharman | http://www.beaucharman.me
 * @link         https://github.com/beaucharman/samurai
 * @license      MIT license
 */
?>

<?php while (have_posts()) : the_post(); ?>

<article <?php post_class('article archive-article article__taxonomy taxonomy entry excerpt post-' . get_the_ID()); ?>>

  <h2 class="article-heading archive-article__heading">
    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
  </h2>

  <?php Samurai_Snippet::include_post_meta(); ?>

  <?php if (has_post_thumbnail()) : ?>
  <figure class="featured-image archive-article__featured-image">
    <?php the_post_thumbnail('thumbnail'); ?>
  </figure>
  <?php endif; ?>

  <?php the_excerpt(); ?>

  <footer class="article-footer archive-article__footer">
    <a class="read-more" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php Samurai_Snippet::read_more_text(); ?></a>
  </footer>

</article>

<?php endwhile; ?>
