<?php
/**
 * Routes
 * ========================================================================
 * routes.php
 * @version      1 | February 9th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 */


class Samurai_Route
{



	function __construct()
	{

	}

	function get() {
		// Work in progress
	}

	public static function get_view($base = '', $modifier = '') {

		get_template_part(SAMURAI_VIEWS_PATH . '/' .  Samurai_Helper::urify_words($base), Samurai_Helper::urify_words($modifier));

	}

}

new Samurai_Route;