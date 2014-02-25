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



/* ======================================================
   Required Constants
   ====================================================== */
define('SAMURAI_PATH', get_template_directory());

define('SAMURAI_URI', get_template_directory_uri());

define('SAMURAI_FULL_LIBRARY_PATH', SAMURAI_PATH . '/library');

define('SAMURAI_FULL_EXTENSIONS_PATH', SAMURAI_PATH . '/library/extensions');

define('SAMURAI_VIEWS_PATH', 'library/views');

define('SAMURAI_SCRIPTS_PATH', 'assets/javascripts');

define('SAMURAI_FULL_SCRIPTS_PATH', SAMURAI_URI . '/' . SAMURAI_SCRIPTS_PATH);

define('SAMURAI_STYLES_PATH', 'assets/stylesheets');

define('SAMURAI_FULL_STYLES_PATH', SAMURAI_URI . '/' . SAMURAI_STYLES_PATH);

define('SAMURAI_IMAGES_PATH', 'assets/images');

define('SAMURAI_FULL_IMAGES_PATH', SAMURAI_URI . '/' . SAMURAI_IMAGES_PATH);




/* ======================================================
   Site Configuration
   ====================================================== */
require_once(SAMURAI_FULL_LIBRARY_PATH . '/config.php');



/* ======================================================
   Required Extention Files
   ====================================================== */



/* Initial Theme Setup
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/initial-theme-setup.php');

/* Helper Functions
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/helpers.php');

/* Router
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/router.php');

/* Routes
   ====================================================== */
require_once(SAMURAI_FULL_LIBRARY_PATH . '/routes.php');

/* Views
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/views.php');

/* Admin Functions
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/admin.php');

/* Media
   ====================================================== */
require_once(SAMURAI_FULL_LIBRARY_PATH . '/media.php');

/* Editor Functions
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/editor.php');

/* Filters
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/filters.php');

/* Snippets
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/snippets.php');

/* Cache
   ====================================================== */
require_once(SAMURAI_FULL_LIBRARY_PATH . '/cache.php');

/* Pagination
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/pagination.php');

/* Assets
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/assets.php');

/* Menus
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/menus.php');

/* Custom Post Types
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/custom-post-type.php');

/* Custom Taxonomies
   ====================================================== */
require_once(SAMURAI_FULL_EXTENSIONS_PATH . '/custom-taxonomy.php');

/* Models
   ====================================================== */
require_once(SAMURAI_FULL_LIBRARY_PATH . '/models.php');

/**
 * Include more files as needed.
 */
