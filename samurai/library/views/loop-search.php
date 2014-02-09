<?php
/**
 * Loop Search
 * ========================================================================
 * loop-search.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 * @author       Beau Charman | @beaucharman | http://www.beaucharman.me
 * @link         https://github.com/beaucharman/samurai
 * @license      MIT license
 */
?>

<?php while (have_posts()) : the_post(); ?>

<article <?php post_class('article article__search-result search-result entry excerpt post-' . get_the_ID()); ?>>

  <h2 class="article-title">
    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?> <small>[<?php echo Samurai_Helper::prettify_words(get_post_type()); ?>]</small></a>
  </h2>

  <?php Samurai_Snippet::include_post_meta(); ?>

  <?php if (has_post_thumbnail()) : ?>
  <figure class="featured-image">
    <?php the_post_thumbnail('thumbnail'); ?>
  </figure>
  <?php endif; ?>

  <?php the_excerpt(); ?>

  <footer class="article-footer">
    <a class="read-more" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php Samurai_Snippet::read_more_text(); ?></a>
  </footer>

</article>

<?php endwhile; ?>
