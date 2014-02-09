<?php
/**
 * Filters
 * ========================================================================
 * template-filters.php
 * @version      1.0 | June 20th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * Filters that alter and enhance defined WordPress features and functions
 * are managed in this file.
 */



class Samurai_Filter
{



  public static function __contruct () {

    add_action('init', array(&$this, 'add_page_excerpts'));

    add_action('init', array(&$this, 'remove_head_links'));

    remove_filter('get_the_excerpt', array(&$this, 'wp_trim_excerpt'));
    add_filter('get_the_excerpt', array(&$this, 'trim_excerpt'));

    add_filter('body_class', array(&$this, 'browser_body_class'));

    add_filter('img_caption_shortcode', array(&$this, 'img_caption_shortcode_filter'), 10, 3);

    add_filter('the_content', array(&$this, 'remove_empty_paragraphs'), 20, 1);

    add_filter('the_content', array(&$this, 'filter_ptags_on_images'));

    add_filter('embed_oembed_html', array(&$this, 'add_video_wmode_transparent'), 10, 3);

    if (! is_admin())
    {

      add_filter('request', array(&$this, 'search_form_request_filter'));

      add_filter('get_search_form', array(&$this, 'html5_search_form'));

      add_filter('excerpt_more', array(&$this, 'search_excerpt_more'));

      add_filter('post_class', array(&$this, 'add_to_body_class'));

      add_filter('body_class', array(&$this, 'add_to_body_class'));

      add_filter('request', array(&$this, 'search_form_request_filter'));

      add_filter('get_search_form', array(&$this, 'html5_search_form'));

      add_filter('excerpt_more', array(&$this, 'search_excerpt_more'));

      remove_filter('get_the_excerpt', array(&$this, 'wp_trim_excerpt'));
      add_filter('get_the_excerpt', array(&$this, 'trim_excerpt'));

      add_filter('body_class', array(&$this, 'browser_body_class'));
    }

    /* Debug */
    if (SAMURAI_ENABLE_TEMPLATE_DEBUG && SAMURAI_DEVELOPMENT_MODE && ! is_admin())
    {
      add_action('all', array(&$this, 'template_debug'));
    }
  }



  /**
   *  Add excerpt field to pages
   */
  public static function add_page_excerpts()
  {
    add_post_type_support('page', 'excerpt');
  }



  /**
   * Clean up the <head>
   */
  public static function remove_head_links()
  {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
  }



  /**
   * Search Form Request Filter
   *
   * search_form_request_filter()
   * @param  $query_vars | array
   * @return array
   *
   * Callback for the WordPress 'request' filter. A fix for some errors that
   * occur for an empty search query.
   */
  public static function search_form_request_filter($query_vars)
  {
    if (isset($_GET['s']) && empty($_GET['s']))
    {
      $query_vars['s'] = " ";
    }
    return $query_vars;
  }



  /**
   * HTML5 Search Form
   *
   * html5_search_form()
   * @param  {string} $form
   * @return {string} $form
   */
  public static function html5_search_form($form)
  {
    return ''
      . '<form class="search-form" role="search" method="get" action="' . home_url('/') . '">'
      . '<input type="text" placeholder="' . __("Search&hellip;") . '" value="" name="s" id="s">'
      . '<input type="submit" id="searchsubmit" value="Go">'
      . '</form>';
  }



  /**
   *  Remove more text on search page
   */
  public static function search_excerpt_more($more)
  {
    if (is_search())
    {
      global $post;
      return '&hellip;';
    }
  }



  /**
   * Custom post excerpt: Remove <script> tags, set
   * 'Read More' and 'Excerpt Length', allow links
   */
  public static function trim_excerpt($text)
  {
    global $post;
    if ('' == $text)
    {
      $text = get_the_content('');
      $text = apply_filters('the_content', $text);
      $text = str_replace('\]\]\>', ']]&gt;', $text);
      $text = strip_shortcodes($text);
      $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
      $text = strip_tags($text, '<a>');
      $excerpt_length = apply_filters('excerpt_length', SAMURAI_EXCERPT_LENGTH);
      $excerpt_more = apply_filters('excerpt_more', ' '
        . '&hellip; <a href="' . get_permalink($post->ID)
        . '" class="excerpt-read-more" title="link to article: '
        . the_title_attribute(array('echo' => 0))
        . '">' . SAMURAI_EXCERPT_MORE
        . '</a>'
      );
      $text = wp_trim_words($text, $excerpt_length, $excerpt_more);
    }
    return $text;
  }



  /**
   *  Add browser type to body class
   */
  public static function browser_body_class($classes)
  {
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    if ($is_lynx) $classes[] = 'browser-lynx';
    elseif ($is_gecko) $classes[] = 'browser-gecko';
    elseif ($is_opera) $classes[] = 'browser-opera';
    elseif ($is_NS4) $classes[] = 'browser-ns4';
    elseif ($is_safari) $classes[] = 'browser-safari';
    elseif ($is_chrome) $classes[] = 'browser-chrome';
    elseif ($is_IE) $classes[] = 'browser-ie';
    else $classes[] = 'browser-unknown';
    if ($is_iphone) $classes[] = 'browser-iphone';
    return $classes;
  }



  /**
   * Add to the Body Class filter
   */
  public static function add_to_body_class($classes)
  {
    global $post;

    /**
     * Flag if is the front page or not
     */
    if (is_404())
    {
      $classes[] = 'error-page';
    }
    elseif (! is_front_page() && ! is_search() && isset($post->post_name))
    {
      $classes[] = 'not-front-page';
      $classes[] = 'page-' . $post->post_name;
    }
    elseif (is_front_page())
    {
      $classes[] = 'front-page';
    }

    if (! is_404() && ! is_search())
    {
      /**
       * Get terms allocated to the current post type
       * and display as taxonomy--term pairs.
       */
      $taxonomies = get_taxonomies('', 'names');
      foreach ($taxonomies as $taxonomy)
      {
        $post_type_terms = get_the_terms($post->ID, $taxonomy);
        if ($post_type_terms && !is_wp_error($post_type_terms))
        {
          foreach ($post_type_terms as $term)
          {
            $classes[] = 'taxonomy-' . $taxonomy . ' term-' . $term->slug;
          }
        }
      }
    }
    return $classes;
  }



  /**
   *  HTML5 friendly figure tags instead of captions
   */
  public static function img_caption_shortcode_filter($val, $attr, $content = null)
  {
    extract(shortcode_atts(array(
      'id'      => '',
      'align'   => '',
      'width'   => '',
      'caption' => ''
    ), $attr));

    if (1 > (int) $width || empty($caption))
    {
      return $val;
    }
    $capid = '';

    if ($id)
    {
      $id = esc_attr($id);
      $capid = 'id="figcaption_'. $id . '" ';
      $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
    }
    return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: '
      . (10 + (int) $width) . 'px">' . do_shortcode($content) . '<figcaption ' . $capid
      . 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
  }



  /**
   * Remove empty paragraph tags from the_content
   * Optional: $content = str_replace('<p>&nbsp;</p>', '', $content);
   */
  public static function remove_empty_paragraphs($content)
  {
    $pattern = "/<p[^>]*><\\/p[^>]*>/";
    $content = preg_replace($pattern, '', $content);
    $content = str_replace('<p></p>', '', $content);
    return $content;
  }



  /**
   * Remove <p> tags around images in the editor
   */
  public static function filter_ptags_on_images($content)
  {
    return preg_replace(
      '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU',
      '\1\2\3',
      $content
   );
  }



  /**
   *  Add Video Mode Transparent to all WP Embed Files
   */
  public static function add_video_wmode_transparent($html, $url, $attr)
  {
    if (strpos($html, "<embed src=") !== false)
    {
      return str_replace(
        '</param><embed',
        '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ',
        $html
     );
    }
    elseif (strpos ($html, 'feature=oembed') !== false)
    {
      return str_replace('feature=oembed', 'feature=oembed&wmode=opaque', $html);
    }
    else
    {
      return $html;
    }
  }



  /**
   * Template Debug
   *
   * @param null
   * @return {string}
   *
   * Debug the template files and display which ones are being used.
   */
  public static function template_debug()
  {
    $args = func_get_args();

    if (! is_admin() && isset($args[0]))
    {
      if ($args[0] == 'template_include')
      {
        echo "<!-- debug: Base Template: {$args[1]} [turn this debug mode off in "
          . "library/project/config.php] -->\n";
      }
      elseif (strpos($args[0], 'get_template_part_') === 0)
      {
        global $last_template_snoop;

        if ($last_template_snoop)
        {
          echo "\n\n<!-- debug: End Template Part: {$last_template_snoop} "
          . "[turn this debug mode off in library/project/config.php] -->";
        }

        $tpl = rtrim(join('-', array_slice($args, 1)), '-') . '.php';
        echo "\n<!-- debug: Template Part: {$tpl} [turn this debug mode off in "
          . "library/project/config.php] -->\n\n";
        $last_template_snoop = $tpl;
      }
    }
  }

}

new Samurai_Filter;
