<?php
/**
 * No Posts Message
 * ========================================================================
 * message-no-posts.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 * @author       Beau Charman | @beaucharman | http://www.beaucharman.me
 * @link         https://github.com/beaucharman/samurai
 * @license      MIT license
 *
 * No search results message.
 */
?>

<section class="message message--no-results">

  <h3 class="message__heading">
    Sorry! We couldn't find anything&hellip;
  </h3>

  <?php if (SAMURAI_ENABLE_SITE_SEARCH) : ?>

  <p class="message__content--search-suggestion">
    Maybe try searching with a different keyword?
  </p>

  <?php get_search_form(); ?>

  <?php endif; ?>

</section>

