<?php if (!defined('ABSPATH')) exit;
/**
 * Functions
 *
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * samurai Functions and Theme Setup.
 *
 * For each theme: custom code, snippets and functions should be placed in
 * library/project and included from this functions.php file.
 */


/* ========================================================================
   Required Constants
   ======================================================================== */
define('SAMURAI_PATH', get_template_directory());

define('SAMURAI_URI', get_template_directory_uri());

define('SAMURAI_FULL_EXTENSIONS_PATH', SAMURAI_PATH . '/library/extensions');

define('SAMURAI_SCRIPTS_PATH', 'library/javascripts');

define('SAMURAI_FULL_SCRIPTS_PATH', SAMURAI_URI . '/' . SAMURAI_SCRIPTS_PATH);

define('SAMURAI_STYLES_PATH', 'library/stylesheets');

define('SAMURAI_FULL_STYLES_PATH', SAMURAI_URI . '/' . SAMURAI_STYLES_PATH);

define('SAMURAI_IMAGES_PATH', 'library/images');

define('SAMURAI_FULL_IMAGES_PATH', SAMURAI_URI . '/' . SAMURAI_IMAGES_PATH);

define('SAMURAI_VIEWS_PATH', 'library/views');



/* ========================================================================
   Site Configuration
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/config.php');



/* ========================================================================
   Required Extention Files
   ======================================================================== */


/* Initial Theme Setup
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/initial-theme-setup.php');

/* Helper Functions
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/helpers.php');

/* Routes
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/routes.php');

/* Admin Functions
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/admin.php');

/* Editor Functions
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/editor.php');

/* Media
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/media.php');

/* Loop Functions
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/loop.php');

/* Template Filters
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/filters.php');

/* Template Snippets
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/snippets.php');

/* Pagination
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/pagination.php');

/* Theme Menus
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/menus.php');

/* Theme Scripts
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/scripts.php');

/* Theme Styles
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/styles.php');

/* Custom Post Types
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/custom-post-type.php');

/* Custom Taxonomies
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/custom-taxonomy.php');

/* Models
   ======================================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/models.php');

/**
 * Include more files as needed.
 */
