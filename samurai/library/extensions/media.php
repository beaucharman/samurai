<?php
/**
 * Media
 * ========================================================================
 * media.php
 * @version      1.0 | July 20th 2013
 * @package      WordPress
 * @subpackage   samurai
 */



class Samurai_Media
{



  function __construct()
  {

    /**
     *
     * Add Theme Support for Tumbnails
     *
     */
    add_theme_support('post-thumbnails');

    /**
     *
     * Add custom image sizes
     *
     * Thumbnail, Medium and large sizes are set in the initial-theme-setup.php file.
     * If these are changed, resample images with wordpress.org/plugins/regenerate-thumbnails/
     *
     */
    add_action('init', array(&$this, 'add_image_sizes'));

    /**
     *
     * Filter - Add image sizes for selection in the WordPress editor.
     *
     */
    add_filter('image_size_names_choose', array(&$this, 'show_image_sizes'));

  }



  /**
   *
   * Declare various image sizes for WordPress image size sampling
   *
   */
  function add_image_sizes()
  {
    /* Add custom sizes here */

    // add_image_size('handle', $width, $height, $crop);

  }



  function show_image_sizes($sizes)
  {
    /* Add image size handles and desired labels here */
    // $sizes['handle'] = __('Label');

    return $sizes;
  }

}

new Samurai_Media;
