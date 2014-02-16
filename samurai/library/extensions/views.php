<?php
/**
 * Views
 * ======================================================
 * views.php
 * @version      13th | February 9th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 */



class Samurai_View
{



	function __construct()
	{

	}

	public static function make($base = '', $modifier = '')
	{
		get_template_part(SAMURAI_VIEWS_PATH . '/' .  Samurai_Helper::urify_words($base), Samurai_Helper::urify_words($modifier));
	}

	public static function template($base = '', $modifier = '')
	{
		self::make($base, $modifier);
		die();
	}

}
