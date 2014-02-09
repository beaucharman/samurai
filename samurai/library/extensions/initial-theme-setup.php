<?php
/**
 * Initial Theme Setup
 * ========================================================================
 * initial-theme-setup.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * For more information:
 * http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
 */



class Samurai_Setup
{



  function __construct()
  {

    /**
     * Run the Setup
     */
    add_action('after_setup_theme', array(&$this, 'initial_theme_setup'));
  }



  /**
   * Initial Theme Setup
   *
   * @param null
   */
  function initial_theme_setup()
  {



    /**
     * Only need to run this once
     */
    if (get_option('theme_setup_status') !== '1')
    {

      /**
       * Set the WordPress options the way you like
       *
       * Initial images sizes increased by 25% for looking pretty damn good
       * natively on retina.
       */
      $core_settings = array(
        'avatar_default'    => 'mystery',
        'avatar_rating'     => 'G',
        'blog_public'       => '0',
        'blogdescription'   => '',
        'comments_per_page' => '20',
        'date_format'       => 'd/m/Y',
        'default_role'      => 'author',
        'large_size_h'      => (SAMURAI_PAGE_CONTENT_WIDTH / 2) * 1.25,
        'large_size_w'      => SAMURAI_PAGE_CONTENT_WIDTH * 1.25,
        'medium_size_h'     => (SAMURAI_PAGE_CONTENT_WIDTH / 3) * 1.25,
        'medium_size_w'     => (SAMURAI_PAGE_CONTENT_WIDTH / 2) * 1.25,
        'posts_per_page'    => '20',
        'thumbnail_crop'    => '1',
        'thumbnail_size_h'  => (SAMURAI_PAGE_CONTENT_WIDTH / 4) * 1.25,
        'thumbnail_size_w'  => (SAMURAI_PAGE_CONTENT_WIDTH / 4) * 1.25,
        'time_format'       => 'g:i a',
        'timezone_string'   => 'Australia/Sydney',
        'use_smilies'       => '0'
      );

      foreach ($core_settings as $key => $value)
      {
        update_option($key, $value);
      }



      /**
       * Add RSS links to <head> section
       */
      add_theme_support('automatic-feed-links');



      /**
       * Add HTML5 markup support for various components
       */
      add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));



      /**
       * Delete the example post, page and comment
       *
       * Set the booleans to false if this is not a fresh
       * install, true will delete the post and pages for real realz
       */
      wp_delete_post(1, true);
      wp_delete_post(2, true);
      wp_delete_comment(1);



      /**
       * Goodbye Dolly
       *
       * feel free to add Akismet to this block of code
       */
      if (file_exists(WP_PLUGIN_DIR.'/hello.php'))
      {
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        delete_plugins(array('hello.php'));
      }



      /**
       * Update the status so this doesn't run again
       */
      update_option('theme_setup_status', '1');



      /**
       * Lets the admin know whats going on with a status message
       */
      $msg = '<div class="updated">'
        . '<p>The ' . get_option('current_theme') . ' theme has changed your WordPress default'
        . ' <a href="' . admin_url('options-general.php') . '" title="See Settings">settings</a>, '
        . 'discouraged search engines and deleted default posts & comments.</p></div>';
      add_action('admin_notices', $c = create_function('', 'echo "'. addcslashes($msg, '"') . '";'));
    }
  }

}

new Samurai_Setup;
