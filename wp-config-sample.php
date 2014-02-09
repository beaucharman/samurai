<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

/**
 * Set up server and deployment credentials
 */

/**
 * Get the current server, server name without the protocol
 * Change to 'SERVER_ADDR' if using IP addresses for reference
 */
$current_server_name = $_SERVER['SERVER_NAME'];

/**
 *
 * Production environment
 *
 */
 $server_credentials['production'] = array(

  /* Production server name */
  'server_name' => '',

  /* Production options */
  'options' => array(
    'db_name'           => '',
    'db_user'           => '',
    'db_password'       => '',
    'db_host'           => '',
    'wp_debug'          => false,
    'wp_debug_log'      => false,
    'wp_debug_display'  => false,
    'wp_env'            => 'production',
    'wp_home'           => null,
    'wp_siteurl'        => null
  )
);

/**
 *
 * Staging environment
 *
 */
 $server_credentials['staging'] = array(

  /* Staging server name */
  'server_name' => '',

  /* Staging options */
  'options' => array(
    'db_name'           => '',
    'db_user'           => '',
    'db_password'       => '',
    'db_host'           => '',
    'wp_debug'          => false,
    'wp_debug_log'      => false,
    'wp_debug_display'  => false,
    'wp_env'            => 'staging',
    'wp_home'           => null,
    'wp_siteurl'        => null
  )
);

/**
 *
 * Development environment
 *
 */
$server_credentials['development'] = array(

  /* StagDevelopmenting server name */
  'server_name' => '',

  /* Development options */
  'options' => array(
    'db_name'           => '',
    'db_user'           => '',
    'db_password'       => '',
    'db_host'           => '',
    'wp_debug'          => true,
    'wp_debug_log'      => true,
    'wp_debug_display'  => false,
    'wp_env'            => 'development',
    'wp_home'           => null,
    'wp_siteurl'        => null
  )
);

/**
 * Get the appropriate credentials
 */
foreach ($server_credentials as $server)
{
  if (strpos($current_server_name, $server['server_name']) !== false)
  {
    $options = $server['options']; break;
  }
}

/**
 * Set up the WordPress database, debug options and environment.
 */
if ($options)
{
  /* Database credentials */
  define('DB_NAME', $options['db_name']);
  define('DB_USER', $options['db_user']);
  define('DB_PASSWORD', $options['db_password']);
  define('DB_HOST', $options['db_host']);

  /* Debug settings */
  define('WP_DEBUG', $options['wp_debug']);
  define('WP_DEBUG_LOG', $options['wp_debug_log']);
  define('WP_DEBUG_DISPLAY', $options['wp_debug_display']);

  /* Environment options*/
  define('WP_ENV', $options['wp_env']);
  if ($options['wp_siteurl']) define('WP_SITEURL', $options['wp_siteurl']);
  if ($options['wp_home']) define('WP_HOME', $options['wp_home']);
}
else
{
  die('Sorry, no appropriate database credentials were found. Make sure your `$server_credentials` are set correctly.');
}

/* End of server and deployment credentials */

/**
 * Set revisions amount
 */
define('WP_POST_REVISIONS', 2);

/**
 * Take out the trash
 */
define('EMPTY_TRASH_DAYS', 2);

/**
 * Disallow administration plugin and template editing
 */
define('DISALLOW_FILE_EDIT', true);

/**
 * Database Charset to use in creating database tables.
 */
define('DB_CHARSET', 'utf8');

/**
 * The Database Collate type. Don't change this if in doubt.
 */
define('DB_COLLATE', '');

/**
 * Increase the WP Memory Limit is needed
 */
// define('WP_MEMORY_LIMIT', '64M');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * This is set in deployment environments
 */

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
