<?php
/**
 * Routes
 * ======================================================
 * routes.php
 * @version      1 | February 9th 2013
 * @package      WordPress
 * @subpackage   samurai/library/extensions/router.php
 */



/**
 * Sample Get - wp_query conditions (a single movie type)
Samurai_Route::get(array('post_type' => 'page'), function ()
{
	Samurai_View::make('message-no-results');
});
*/



/**
 * Sample Get - URI string redirection // todo regular expression / wild cards
Samurai_Route::get('/movie/***', function ()
{
	Samurai_Route::redirect('/movies/');
});
*/



/**
 * Order all posts all by title, ascending by default
Samurai_Route::query('/', function ($query)
{
	$query->set('orderby', 'title');
	$query->set('order', 'ASC');
});
*/
