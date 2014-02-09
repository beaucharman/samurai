<?php
/**
 * No Posts Message
 * ========================================================================
 * message-no-posts.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * Page not found message, suitable for a 404 message.
 */
?>

<section class="message message--not-found">

  <h3 class="message__heading">
    Oops! Nothing Found Here :(
  </h3>

  <p class="message__content">
    The page you are looking for does not exist. (404)
  </p>

  <?php if (SAMURAI_ENABLE_SITE_SEARCH) : ?>

  <p class="message__content--search-suggestion">
    Try searching our site for what you are after.
  </p>

  <?php get_search_form(); ?>

  <?php endif; ?>

</section>
