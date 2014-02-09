<?php
/**
 * Comments
 *
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 */
?>

<?php if (!defined('ABSPATH')) exit;

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
  die ('Please do not load this page directly. Thanks!');

if (post_password_required())
{
  echo _e('This post is password protected. Enter the password to view comments.');
  return;
}

if (have_comments()) : ?>

<h3 class="comments-title"><?php comments_number('No Responses', 'One Response', '% Responses');?></h3>

<ol class="commentlist">
  <?php wp_list_comments('type=comment&callback=Samurai_Snippet::advanced_comment'); ?>
</ol>

<div class="comments-navigation">
  <div class="comments-navigation--next-posts"><?php previous_comments_link() ?></div>
  <div class="comments-navigation--prev-posts"><?php next_comments_link() ?></div>
</div>

<?php else : /* this is displayed if there are no comments so far  */?>

<?php if (comments_open()) : ?>

<?php else : /* comments are closed  */?>
<p class="comments-closed-message">
  <?php echo _e('Comments are closed.'); ?>
</p>
<?php endif; ?>

<?php endif; ?>

<?php if (comments_open()) : ?>

<?php /* use comment_form(); for the generic comment form  */?>

<div id="respond" class="clear">

  <h3 class="comment-form form-title"><?php comment_form_title('Leave a Reply', 'Leave a Reply to %s'); ?></h3>

  <div class="cancel-comment-reply">
    <?php cancel_comment_reply_link(); ?>
  </div>

  <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
  <p class="comment-notification comment-form must-be-logged-in-message">
    <?php echo _e('You must be'); ?>
    <a href="<?php echo wp_login_url(get_permalink()); ?>"><?php echo _e('logged in'); ?></a>
    <?php echo _e('to post a comment.'); ?>
  </p>

  <?php else : ?>

  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment-form form">

    <?php if (is_user_logged_in()) : ?>

    <p class="comment-form admin-link">
      <?php echo _e('Logged in as'); ?> <a href="<?php echo home_url(); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.
      <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php echo _e('Log out &rarr;'); ?></a>
    </p>

    <?php else : ?>

    <p class="comment-form input-field-container">
      <label class="input-label" for="author"><?php echo _e('Name'); ?>&nbsp;<?php if ($req) echo "*"; ?><br>
        <input class="input-text input-field" type="text" placeholder="Name&hellip;" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="20" <?php if ($req) echo "aria-required='true'"; ?>>
      </label>
    </p>

    <p class="comment-form input-field-container">
      <label class="input-label" for="email"><?php echo _e('Email'); ?>&nbsp;<?php if ($req) echo "*"; ?> <small class="note"><?php echo _e('(will not be published)'); ?></small><br>
        <input class="input-text input-field" type="email" placeholder="Email&hellip;" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="21" <?php if ($req) echo "aria-required='true'"; ?>>
      </label>
    </p>

    <p class="comment-form input-field">
      <label class="input-label" for="url"><?php echo _e('Website'); ?><br>
        <input class="input-text input-field" type="url" placeholder="Website&hellip;" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="22">
      </label>
    </p>

    <?php endif; ?>

    <p class="note comment-form allowed-tags">
      <?php echo _e('You can use these tags: '); ?><code><?php echo allowed_tags(); ?></code>
    </p>

    <p class="comment-form input-field-container">
      <label class="input-label" for="comment"><?php echo _e('Comment'); ?><br>
        <textarea class="input-textarea input-field" name="comment" placeholder="Your comment&hellip;" id="comment" cols="58" rows="10" tabindex="23"></textarea>
      </label>
    </p>

    <p class="comment-form submit-field-container">
      <input class="input-submit input-field" name="submit" type="submit" id="submit" tabindex="24" value="Submit Comment &rarr;">
      <?php comment_id_fields(); ?>
    </p>

    <?php do_action('comment_form', $post->ID); ?>

  </form>

  <?php endif; /* If registration required and not logged in */ ?>

</div>

<?php endif; ?>
