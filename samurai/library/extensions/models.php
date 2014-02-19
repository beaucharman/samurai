<?php
/**
 * Models
 *
 * @version      1 | January 8th 2014
 * @package      WordPress
 * @subpackage   samurai/library/extensions/custom-post-type.php,
 *               samurai/library/extensions/custom-taxonomy.php,
 *               samurai/library/extensions/menu.php
 *
 * Data structures, taxonomies and custom post types
 *
 * To declare a custom post type, simply create a new instance of the
 * Bamboo_Custom_Taxonomy class.
 *
 * Configuration guide:
 * https://github.com/beaucharman/wordpress-custom-post-types
 * https://github.com/beaucharman/wordpress-custom-taxonomies
 */



class Samurai_Model
{



	public function __construct()
	{

		/**
		 * Include Font Awesome
		 */
		// Katana_Custom_Post_Type::get_font_awesome();

		/**
		 * register post types
		 */
		self::create_post_types();

		/**
		 * register taxonomies
		 */
		self::create_taxonomies();

		/**
		 * register menus
		 */
		self::create_menus();

	}



	/**
	 *
	 * Create Post Types
	 *
	 */
	public static function create_post_types()
	{


		// Example - Movie

		// global $Movie;
		//
		// $Movie = new Katana_Custom_Post_Type(
		// 	array(
		// 		'name' => 'movie'
		// 	)
		// );

	}



	/**
	 *
	 * Create Taxonomies
	 *
	 */
	public static function create_taxonomies()
	{


		// Example - Genre

		// global $Genre;

		// $Genre = new Katana_Custom_Taxonomy(
		// 	array(
		// 		'name'      => 'genre',
		// 		'post_type' => 'movie'
		// 	)
		// );

	}



	/**
	 *
	 * Create Menus
	 *
	 */
	public static function create_menus()
	{

		/**
		* Main Navigation Menu
		*/
		global $Main_Navigation_Menu;

		$Main_Navigation_Menu = new Samurai_Menu(
			array(
				'name' => 'Main Navigation Menu'
			)
		);

	}

}

new Samurai_Model;
