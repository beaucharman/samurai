<?php
/**
 * Config
 *
 * config.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 * @author       Beau Charman | @beaucharman | http://www.beaucharman.me
 * @link         https://github.com/beaucharman/samurai
 * @license      MIT license
 *
 * samurai project configuration
 */



class Samurai_Config {



  function __construct()
  {

    global $content_width;



    /**
     * Development mode
     *
     * Set the production environment for conditional statements.
     * true for development, false for deployment mode.
     */
    if (WP_ENV != 'production')
    {
      define('SAMURAI_DEVELOPMENT_MODE', true);
    }


    /**
     *
     *  Front end layout and design options
     *
     */

    /**
     * Set full page content width
     */
    define('SAMURAI_PAGE_CONTENT_WIDTH', 960);

    /**
     * Set the content width
     */
    if (! isset($content_width))
    {
      $content_width = SAMURAI_PAGE_CONTENT_WIDTH;
    }



    /**
     *
     *  Front end functionality and logic options
     *
     */

    /**
     *  Set the global Excerpt length
     */
    define('SAMURAI_EXCERPT_LENGTH', 40);

    /**
     * Set the global Excerpt More info
     */
    define('SAMURAI_EXCERPT_MORE', 'more &rarr;');

    /**
     * Enable comments
     */
    define('SAMURAI_ENABLE_COMMENTS', false);

    /**
     * Enable site search
     */
    define('SAMURAI_ENABLE_SITE_SEARCH', true);

    /**
     * Show post meta data on pages
     */
    define('SAMURAI_ENABLE_META_DATA', false);



    /**
     *
     *  Script, style and behaviour options
     *
     */

    /**
     * stylesheet cache break
     */
    define('SAMURAI_STYLES_CACHE_BREAK', '0.1');

    /**
     * javascript cache break
     */
    define('SAMURAI_SCRIPTS_CACHE_BREAK', '0.1');



    /**
     *
     * Theme and editor options
     *
     */

    /**
     * Enable extra TinyMCE buttons
     */
    define('SAMURAI_ENABLE_EXTRA_TINYMCE_BUTTONS', true);

    /**
     * Use the custom-editor-style.css file for the TinyMCE
     */
    define('SAMURAI_USE_CUSTOM_EDITOR_STYLES', false);



    /**
     *
     * Utility options
     *
     */

    /**
     * Enable template files debug mode
     */
    define('SAMURAI_ENABLE_TEMPLATE_DEBUG', false);

    /**
     * Use the custom-login-style.css file for the Login screen
     */
    define('SAMURAI_USE_CUSTOM_LOGIN_STYLES', false);

    // End project configuration

	}

}

new Samurai_Config;
