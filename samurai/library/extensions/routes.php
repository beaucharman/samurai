<?php
/**
 * Routes
 * ======================================================
 * routes.php
 * @version      1 | February 9th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * About ::query
 *
 * Loops altered from these functions are executed when the requested is made,
 * long before the page is rendered, reducing redundant database calls.
 * This also keeps the core files untouched.
 *
 * By default, all pages with order posts by title, acending.
 *
 * Use: $query->set($loop_variable, $value); to alter the loop output.
 *   Example, hide cat 4 site wide by default:
 *   $query->set('cat', '-12');
 *
 * Use: $query->query_vars[], or conditional statements belonging to the $query array
 *   to select the required loop to alter.  Also use print_r($query->query_vars) to see
 *   all avaliable query vars for a particular template page.
 *   Example, show 3 posts per page if viewing post type 'books':
 *   if ($query->query_vars['post_type'] == 'books') $query->set('posts_per_page','3');
 *
 * Example: Randomly order posts when viewing the search template page.
 *   if ($query->is_search) $query->set('orderby','rand');
 *
 * For more information:
 *   http://codex.wordpress.org/Class_Reference/WP_Query
 *   http://codex.wordpress.org/Function_Reference/query_posts
 *   http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
 *
 */



class Samurai_Route
{



	function __construct()
	{

	}

	public static function redirect($target, $status_code = 302)
	{
		wp_redirect($target, $status_code);
		exit();
	}



	public static function query($callback)
	{
		add_action('pre_get_posts', $callback);
	}



	public static function get($subject, $callback)
	{

		add_action('pre_get_posts', function() use($subject, $callback) {

		  global $wp_query;

			if (! is_admin())
			{
				if (is_string($subject) && strpos($_SERVER['REQUEST_URI'], $subject) !== false)
				{
					add_action('template_redirect', $callback);
				}
				elseif (is_array($subject))
				{
					$flag = true;

					foreach ($subject as $key => $value)
					{
						if ($wp_query->query_vars[$key] != $value && $wp_query->query[$key] != $value && $wp_query->$key != $value)
						{
							$flag = false;
							break;
						}
					}

					if ($flag) add_action('template_redirect', $callback);
				}
			}
		});
	}
}


/**
 * Sample Get - wp_query conditions (a single movie type)
 */
Samurai_Route::get(
	array(
		'post_type' => 'movie',
		'is_single' => true
	),
	function ()
	{
		Samurai_View::template('movie/single');
	}
);



/**
 * Sample Get - URI string redirection // todo regular expression / wild cards
 */
Samurai_Route::get('/movie/*', function ()
{
	Samurai_Route::redirect('/movies/');
});


/**
 * Order all posts all by title, ascending by default
 */
Samurai_Route::query(function ($query)
{
  global $wp_the_query;

  if ($wp_the_query === $query && ! is_admin())
  {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
  }

  return $query;
});
