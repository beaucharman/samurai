<?php
/**
 * Loop
 * ========================================================================
 * loop.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 * @author       Beau Charman | @beaucharman | http://www.beaucharman.me
 * @link         https://github.com/beaucharman/samurai
 * @license      MIT license
 */
?>

<?php while (have_posts()) : the_post(); ?>

<article <?php post_class('article article__loop post-' . get_the_ID() . ' entry ',  (is_single()) ? 'excerpt' : 'content'); ?>>

  <h1 class="article-title">
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
  </h1>

  <?php Samurai_Snippet::include_post_meta(); ?>

  <?php if (has_post_thumbnail()) : ?>
  <figure class="featured-image">
    <?php the_post_thumbnail('medium'); ?>
  </figure>
  <?php endif; ?>

  <?php (is_single()) ? the_excerpt() : the_content(); ?>

</article>

<?php Samurai_Snippet::get_comments_template(); ?>

<?php endwhile; ?>
