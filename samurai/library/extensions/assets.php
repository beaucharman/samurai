<?php
/**
 * Assets
 * ======================================================
 * assets.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 */



class Samurai_Asset
{



	public function __construct()
	{

		/**
		 * Register and enqeue frontend assets
		 */
		if (! is_admin() && ! in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')))
		{
			/* Frontend JavaScripts */
			add_action('wp_enqueue_scripts', array(&$this, 'load_frontend_javascripts'));

			/* Frontend Stylesheets */
			add_action('init', array(&$this, 'load_frontend_stylesheets'));
		}

		/**
		 * Register and enqeue admin stylesheets 
		 */
		if(is_admin()) 
		{
			add_action('init', array(&$this, 'load_admin_stylesheets'));	
		}

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
 	 * Load front JavaScripts
	 *
	 */
	static function load_frontend_javascripts()
	{
		/**
		 * Register scripts here
		 */
		wp_register_script('samurai_modernizr', SAMURAI_FULL_SCRIPTS_PATH . '/vendor/modernizr.min.js', array(), '0.1', false);
		wp_register_script('samurai_jquery', SAMURAI_FULL_SCRIPTS_PATH . '/vendor/jquery.min.js', array(), '0.1', true);
		wp_register_script('google_jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), '1.11.0', true);
		wp_register_script('samurai_plugins', SAMURAI_FULL_SCRIPTS_PATH . '/plugins.js', array(), SAMURAI_SCRIPTS_CACHE_BREAK, true);
		wp_register_script('samurai_main', SAMURAI_FULL_SCRIPTS_PATH . '/main.js', array(), SAMURAI_SCRIPTS_CACHE_BREAK, true);



		/**
		 * Dequeue the currently registered version of jQuery
		 */
		wp_dequeue_script('jquery');



		/**
		 * Enqueue JavaScripts
		 */
		
		/* Comments */
		if (is_singular() && get_option('thread_comments') && SAMURAI_ENABLE_COMMENTS)
		{
			wp_enqueue_script('comment-reply');
		}

		/* Modernizr */
		// wp_enqueue_script('samurai_modernizr');

		// Load in separate scripts for development, change this to a concatenated
		// file for deployment. See library/extentions/config.php
		
		if (SAMURAI_DEVELOPMENT_MODE)
		{
			/* jQuery */
			// wp_enqueue_script('samurai_jquery'); // theme version
			// wp_enqueue_script('jquery'); // wp-includes version
			// wp_enqueue_script('google_jquery'); // Google hosted version

			/* Plugins */
			wp_enqueue_script('samurai_plugins');

			// Enqueue other theme template scripts for developement,
			// or conditional production scripts here.
		}

		/* Main project JavaScripts */
		wp_enqueue_script('samurai_main');
	}



	/**
	 *
	 * Load frontend stylesheets
	 *
	 */
	static function load_frontend_stylesheets()
	{
		/**
		 * Register styles
		 */
		
		/* Main stylesheet */
		wp_register_style('samurai_main_stylesheet', SAMURAI_FULL_STYLES_PATH . '/main.css', array(), SAMURAI_STYLES_CACHE_BREAK);



		/**
		 * Enqueue styles
		 */

		/* Main stylesheet */
		wp_enqueue_style('samurai_main_stylesheet');

		// Enqueue theme styles here.
		// Consider seperate files for development, then bundle into style.css for production. 
		// Conditional and contextual styles would be appropriate to be loaded here.
	}

	/**
	 *
	 * Load admin stylesheets
	 *
	 */
	static function load_admin_stylesheets()
	{
		// Register and enqueue admin styles here.
	}



	/**
	 *
	 * Custom login styles
	 *
	 */
	static function custom_login_styles()
	{
		echo '<link rel="stylesheet" href="' . SAMURAI_FULL_STYLES_PATH . '/admin/custom-login-style.css">';
	}

}

new Samurai_Asset;
