<?php
/**
 * Assets
 * ======================================================
 * assets.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * REPLACEMENT CANDIDATE FOR SCRIPT.PHP AND STYLE.PHP
 */



class Samurai_Asset
{



  function __construct()
  {

    /**
     * Register and Enqeue local scripts
     */
    add_action('wp_enqueue_scripts', array(&$this, 'load_scripts'));

    /**
     * Register and enqeue styles action
     */
    add_action('init', array(&$this, 'load_styles'));

    /**
     * Custom Editor Styles action
     *
     * Styles the visual editor with custom-editor-style.css
     * to match the theme style.
     */
    if (SAMURAI_USE_CUSTOM_EDITOR_STYLES)
    {
      add_editor_style(SAMURAI_STYLES_PATH . '/admin/custom-editor-style.css');
    }

    /**
     * Custom Login Styles action
     *
     * This function styles the admin login screen with
     * custom-login-style.css to match the theme style.
     */
    if (SAMURAI_USE_CUSTOM_LOGIN_STYLES)
    {
      add_action('login_head', array(&$this, 'custom_login_styles'));
    }
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
        // wp_enqueue_script('samurai_jquery');

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



  /**
   *
   * Load Styles
   *
   */
  static function load_styles()
  {
    /**
     * Register styles here
     */
    wp_register_style('samurai_custom_admin_styles', SAMURAI_FULL_STYLES_PATH . '/admin/custom-admin-styles.css', array(), SAMURAI_SCRIPTS_CACHE_BREAK);
    wp_register_style('samurai_main_stylesheet', SAMURAI_FULL_STYLES_PATH . '/main.css', array(), SAMURAI_STYLES_CACHE_BREAK);



    /**
     * Enqueue styles here
     */
    if (! is_admin())
    {
      /**
       *
       * Front end stylesheets
       *
       */

      /* Main stylesheet */
      wp_enqueue_style('samurai_main_stylesheet');

      /**
       * Enqueue theme styles here.
       * Consider seperate files for development, then bundle into style.css
       * for deployment. Conditional styles would be appropriate to be loaded here.
       */
    }
    elseif (is_admin())
    {
      /**
       *
       * Admin stylesheets
       *
       */

      /* Add consistency to site settings inputs */
      wp_enqueue_style('samurai_custom_admin_styles');

      // Enqueue admin styles here.
    }
  }



  /**
   *
   * Custom Login Styles
   *
   */
  static function custom_login_styles()
  {
    echo '<link rel="stylesheet" type="text/css" href="' . SAMURAI_FULL_STYLES_PATH . '/admin/custom-login-style.css">';
  }

}

new Samurai_Asset;
