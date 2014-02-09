<?php
/**
 * Loop Attachment
 * ========================================================================
 * loop-attachment.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 */
?>

<?php while (have_posts()) : the_post(); global $post; ?>

<article <?php post_class('article article__attachment attachment post-' . get_the_ID()); ?>>

  <h1 class="article__title article__attachment--title">
    <?php the_title(); ?>
  </h1>

  <?php Samurai_Snippet::include_post_meta(); ?>

  <?php if ($post->post_content) : ?>
  <p class="attachment-description">
    <?php echo $post->post_content; ?>
  <p>
  <?php endif; ?>

  <figure class="attachment-figure">
    <?php echo wp_get_attachment_image($post->ID, 'full'); ?>

    <?php if ($post->post_excerpt) : ?>
    <figcaption class="attachment__figcaption"><?php echo $post->post_excerpt; ?></figcaption>
    <?php endif; ?>
  </figure>

  <footer class="article__footer">
    <?php Samurai_Snippet::back_to_parent_link(); ?>
  </footer>

</article>

<?php endwhile; ?>
