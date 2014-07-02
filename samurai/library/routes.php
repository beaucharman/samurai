<?php
/**
 * Routes
 *
 * routes.php
 * @version      1 | February 9th 2013
 * @package      WordPress
 * @subpackage   samurai/library/extensions/router.php
 *
 * Use the following snippet to find out what vars are usable from the wp_query object
 *
 add_action('pre_get_posts', function() { global $wp_query; echo '<pre>'; print_r($wp_query); echo '</pre>'; });
 *
 */



/**
 * Sample Get
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
