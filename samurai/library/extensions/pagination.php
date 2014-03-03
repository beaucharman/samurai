<?php
/**
 * Pagination
 * ======================================================
 * pagination.php
 * @version      1.0 | January 2014
 * @package      WordPress
 * @subpackage   samurai
 */



class Samurai_Pagination
{


	/**
	 * Has Page Pagination
	 *
	 * @param null
	 * @return {boolean}
	 *
	 * Return true if has pagination.
	 */
	static function has_page_pagination($custom_query = null)
	{
		global $wp_query;

		if (! $custom_query)
		{
			$custom_query = $wp_query;
		}

		if ($custom_query->max_num_pages > 1)
		{
			return true;
		}

		return false;
	}



	/**
	 *  Function to get Post Nav Links
	 */
	static function get_single_nav_links()
	{
		echo '<span class="navigation__single--next">';
		next_post_link('%link', 'Next Article &rarr;', true);
		echo '</span>';

		echo '<span class="navigation__single--previous">';
		previous_post_link('%link', '&larr; Previous Article', true);
		echo '</span>';
	}



	/**
	 * Function to get Category Nav Links
	 */
	static function get_archive_nav_links()
	{
		posts_nav_link(' &mdash; ', '&larr; Previous', 'Next &rarr;');
	}



	/**
	 * Functions to include site pagination
	 *
	 * A series of functions that checks for wp_pagenavi(), and conditionally
	 * displays the appropriate pagination method.
	 */
	static function include_single_navigation()
	{
		echo '<nav class="navigation navigation__single">';
		self::get_single_nav_links();
		echo '</nav>';
	}



	/**
	 * Include page pagination (using wp_pagenavi)
	 */
	static function include_page_pagination($custom_query = null)
	{
		global $wp_query;

		if (! $custom_query) $custom_query = $wp_query;

		if (function_exists('wp_pagenavi') && self::has_page_pagination($custom_query))
		{
			echo '<nav class="pagination pagination__page">';
			wp_pagenavi(array('type' => 'multipart', 'query' => $custom_query));
			echo '</nav>';
		}
		else
		{
			self::include_page_navigation();
		}
	}



	/**
	 * Include page navigation (previous and next style)
	 */
	static function include_page_navigation()
	{
		wp_link_pages(array(
			'before'           => '<nav class="navigation navigation__page">' . __('Pages:'),
			'after'            => '</nav>',
			'nextpagelink'     => __('Next Page &rarr;'),
			'previouspagelink' => __('Previous Page &larr;'),
			'pagelink'         => '%')
		);
	}



	/**
	 * Include archive pagination (using wp_pagenavi)
	 */
	static function include_archive_pagination($custom_query = null)
	{
		global $wp_query;

		if (! $custom_query) $custom_query = $wp_query;

		if (self::has_page_pagination($custom_query))
		{

			if (function_exists('wp_pagenavi'))
			{
				echo '<nav class="pagination pagination__archive">';
				wp_pagenavi(array('query' => $custom_query));
				echo '</nav>';
			}
			else
			{
				self::include_archive_navigation();
			}
		}
	}



	/**
	 * Include archive navigation (previous and next style)
	 */
	static function include_archive_navigation()
	{
		if (self::has_page_pagination())
		{
			echo '<nav class="navigation navigation__archive">';
			self::get_archive_nav_links();
			echo '</nav>';
		}
	}

}
