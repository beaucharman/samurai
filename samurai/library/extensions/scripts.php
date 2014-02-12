<?php
/**
 * Scripts
 * ======================================================
 * scripts.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 */



class Samurai_Script
{



  function __construct()
  {
    /**
     * Register and Enqeue local scripts
     */
    add_action('wp_enqueue_scripts', array(&$this, 'load_scripts'));
  }


  /**
   *
   * Load Scripts
   *
   */
  static function load_scripts()
  {
    /**
     * Register scripts here
     */
    wp_register_script('samurai_modernizr', SAMURAI_FULL_SCRIPTS_PATH . '/vendor/modernizr.min.js', array(), '0.1', false);
    wp_register_script('samurai_jquery', SAMURAI_FULL_SCRIPTS_PATH . '/vendor/jquery.min.js', array(), '0.1', true);
    wp_register_script('google_jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), '1.11.0', false);
    wp_register_script('samurai_plugins', SAMURAI_FULL_SCRIPTS_PATH . '/plugins.js', array(), SAMURAI_SCRIPTS_CACHE_BREAK, true);
    wp_register_script('samurai_main', SAMURAI_FULL_SCRIPTS_PATH . '/main.js', array(), SAMURAI_SCRIPTS_CACHE_BREAK, true);



    /**
     * Enqueue frontend scripts here
     */
    if (! is_admin())
    {
      /**
       * Dequeue the currently registered version of jQuery
       */
      wp_dequeue_script('jquery');

      /* Comments */
      if (is_singular() && get_option('thread_comments') && SAMURAI_ENABLE_COMMENTS)
      {
        wp_enqueue_script('comment-reply');
      }

      /* Modernizr */
      // wp_enqueue_script('samurai_modernizr');

      /**
       * Load in separate scripts for development, change this to a concatenated
       * file for deployment. See library/extentions/config.php
       */
      if (SAMURAI_DEVELOPMENT_MODE)
      {
        /* jQuery */
        // wp_enqueue_script('samurai_jquery'); // theme version
        // wp_enqueue_script('jquery'); // wp-includes version
        // wp_enqueue_script('google_jquery'); // Google hosted version

        /* Plugins */
        wp_enqueue_script('samurai_plugins');

        /**
         * Enqueue other theme template scripts for developement,
         * or contitional production scripts here.
         */
      }

      /**
       * Main project JavaScript
       */
      wp_enqueue_script('samurai_main');
    }
  }

}

new Samurai_Script;
