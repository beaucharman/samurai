<?php
/**
 * Routes
 * ======================================================
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

	public static function redirect($target, $status_code = 303)
	{
		header('Location: ' . $target, true, $status_code);
		die();
	}

	public static function get($subject, $callback)
	{
		$callback();
	}
}
