<?php
/**
 * Cache
 *
 * cache.php
 * @version      14th | February 9th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * http://codex.wordpress.org/Class_Reference/WP_Object_Cache
 */



class Samurai_Cache
{



	public function set($id, $value, $expiration = 0, $expiration_trigger = '')
	{
		return wp_cache_set($this->get_id($id, $expiration_trigger), $value, 'samurai', $expiration);
	}



	public function get($id, $expiration_trigger = '')
	{
		return wp_cache_get($this->get_id($id, $expiration_trigger), 'samurai');
	}



	public function delete($id, $expiration_trigger = '')
	{
		return wp_cache_delete($this->get_id($id, $expiration_trigger), 'samurai');
	}



	public function get_id($key, $expiration_trigger = '')
	{
		$last = empty($expiration_trigger) ? '' : $this->get_last_occurrence($expiration_trigger);
		$id = $key . $last;

		if (strlen($id) > 40) $id = md5($id);

		return $id;
	}

	public function get_last_occurrence($action)
	{
		return (int)get_option('samurai_last_' . $action, time());
	}



	public function set_last_occurrence( $action, $timestamp = 0 )
	{
		if (empty($timestamp)) $timestamp = time();

		update_option('samurai_last_' . $action, (int)$timestamp);
	}



	public function clear($groups)
	{
		wp_cache_add_non_persistent_groups('samurai');
	}

}



/**
 * Listen for events and update their timestamps
 */
class Samurai_Cache_Listener
{



	private static $instance = NULL;
	private $cache = NULL;



	public function __construct()
	{
		$this->cache = new Samurai_Cache();
	}



	public function init()
	{
		$this->add_hooks();
	}



	private function add_hooks()
	{
		add_action('save_post', array($this, 'save_post'), 0, 2);
	}



	public function save_post($post_id, $post)
	{
		if (in_array($post->post_type, TribeEvents::getPostTypes()))
		{
			$this->cache->set_last_occurrence('save_post');
		}
	}



	public function __call($method, $args)
	{
		$this->cache->set_last_occurrence($method);
	}



	public static function instance()
	{
		if (empty(self::$instance))
		{
			self::$instance = self::create_listener();
		}

		return self::$instance;
	}



	private static function create_listener()
	{
		$listener = new self();
		$listener->init();
		return $listener;
	}
}