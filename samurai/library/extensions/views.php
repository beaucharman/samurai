<?php
/**
 * Views
 * ======================================================
 * views.php
 * @version      13th | February 9th 2013
 * @package      WordPress
 * @subpackage   samurai
 */



class Samurai_View
{



	/**
	 * Make
	 * @param  {string} $base
	 * @param  {string} $modifier
	 * @return {string}
	 */
	public static function make($base = '', $modifier = '')
	{
		get_template_part(SAMURAI_VIEWS_PATH . '/' .  Samurai_Helper::urify_words($base), Samurai_Helper::urify_words($modifier));
	}



	/**
<<<<<<< HEAD
	 * Template
	 * @param  {string} $base
	 * @param  {string} $modifier
	 * @return {string}
	 */
=======
 	 * Template
 	 * @param  {string} $base
 	 * @param  {string} $modifier
 	 * @return {string}
 	 */
>>>>>>> aeb20e4e2b4c6939d1676be61a814193d4af2b89
	public static function template($base = '', $modifier = '')
	{
		self::make($base, $modifier);
		die();
	}

}
