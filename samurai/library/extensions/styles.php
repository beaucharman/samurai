<?php
/**
 * Styles
 * ========================================================================
 * styles.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 */



class Samurai_Style
{



  function __construct()
  {
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
   * Load Styles
   *
   */
  function load_styles()
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
  function custom_login_styles()
  {
    echo '<link rel="stylesheet" type="text/css" href="' . SAMURAI_FULL_STYLES_PATH . '/admin/custom-login-style.css">';
  }

}

new Samurai_Style;
