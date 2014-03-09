<?php
/**
 * Router
 * ======================================================
 * router.php
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



	/**
	 * [redirect description]
	 * @param  [type]  $target      [description]
	 * @param  integer $status_code [description]
	 * @return [type]               [description]
	 */
	public static function redirect($target, $status_code = 302)
	{
		wp_redirect($target, $status_code);
		exit();
	}



	/**
	 * query
	 * @param  {array} $condition
	 * @param  {function} $callback
	 * @return
	 */
	public static function query($condition, $callback)
	{
		add_action('pre_get_posts', function($query) use ($condition, $callback)
		{
			global $wp_the_query;

			if ($wp_the_query && Samurai_Route::check($condition))
			{
				$callback($query);
			}
		});
	}


	/**
	 * get
	 * @param  {array} $condition
	 * @param  {function} $callback
	 * @return
	 */
	public static function get($condition, $callback)
	{
		add_action('pre_get_posts', function() use($condition, $callback)
		{
			if (Samurai_Route::check($condition))
			{
				add_action('template_redirect', $callback);
			}
		});
	}



	/**
	 * search
	 * @param  {array} $array
	 * @param  {string} $key
	 * @param  {mixed} $value
	 * @param  {array} $results
	 * @return &$results
	 */
	private static function search($array, $key, $value, &$results)
	{
		/* We only want arrays */
		if (! is_array($array))
		{
			return;
		}

		if (isset($array[$key]))
		{
			if (is_array($value) && in_array($array[$key], $value))
			{
				$results[] = $array;
			}
			elseif ($array[$key] == $value)
			{
				$results[] = $array;
			}
		}

		foreach ($array as $subarray)
		{
			self::search($subarray, $key, $value, $results);
		}
	}

	/**
	 * check
	 * @param  {array} $condition
	 * @return [type]
	 */
	public static function check($condition)
	{
		global $wp_query;

		if (! is_admin())
		{
			if (is_string($condition) && strpos($_SERVER['REQUEST_URI'], $condition) !== false)
			{
				return true;
			}
			elseif (is_array($condition))
			{
				$flag = true;
				$query_array = (array)$wp_query;

				foreach ($condition as $key => $value)
				{
					$results = array();
					self::search($query_array, $key, $value, $results);

					if (! $results)
					{
						$flag = false;
						break;
					}
				}

				if ($flag) return true;

			}

		}

		return false;
	}

}
