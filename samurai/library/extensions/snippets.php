<?php
/**
 * Snippet
 * ========================================================================
 * snippets.php
 * @version      1.0 | June 20th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * This file contains any template related functions that:
 * Get: retrieve data based on an given parameter.
 *   (Get the post's title for example)
 * Include: simple functions that merely render pre defined code.
 *   (Include pagination for example)
 */



class Samurai_Snippet
{



  /**
   *  Get the Comments Template
   */
  public static function get_comments_template()
  {
    if (SAMURAI_ENABLE_COMMENTS)
    {
      comments_template();
    }
  }



  /**
   * samurai Title
   *
   * Samurai_Snippet::title()
   * @param  null
   * @return string
   *
   * Render Title Function. Assign title names and attributes conditionally.
   */
  public static function title()
  {
    global $post;
    if ((is_archive()) && (! is_front_page()))
    {
      if (is_category())
      {
        single_cat_title(); echo ' &#045; ';
      }
      elseif (is_tag())
      {
        echo 'Tag Archive for "'; single_tag_title(); echo '" &#045; ';
      }
      elseif (is_day())
      {
        echo 'Archive for '; the_time('F jS, Y'); echo ' &#045; ';
      }
      elseif (is_month())
      {
        echo 'Archive for '; the_time('F, Y'); echo ' &#045; ';
      }
      elseif (is_year())
      {
        echo 'Archive for '; the_time('Y'); echo ' &#045; ';
      }
      elseif (is_author())
      {
        echo 'Author Archive &#045; ';
      }
      elseif (is_tax())
      {
        global $wp_query; $taxonomy_term = $wp_query->get_queried_object();
        echo $taxonomy_term->name; echo ' Archive &#045; ';
      }
      elseif (method_exists('Samurai_Helper', 'is_post_type') && Samurai_Helper::is_post_type())
      {
        global $wp_query; $post_type_obj = get_post_type_object(get_post_type($wp_query->post->ID));
        print $post_type_obj->labels->singular_name; echo ' Archive &#045; ';
      }
    }
    elseif (is_search())
    {
      echo 'Search results for "'; the_search_query(); echo '" &#045; ';
    }
    elseif ((! is_404()) && (get_the_title()) && (! is_front_page()) && ((is_single()) || (is_page())))
    {
      the_title_attribute(); echo ' &#045; ';
    }
    elseif (is_404())
    {
      echo 'Nothing Found Here &#040;404&#041; &#045; ';
    }
    bloginfo('name'); if (get_bloginfo('description'))
    {
      echo ' &#045; ';
      bloginfo('description');
    }
  }



  /**
   * Meta Description
   *
   * Samurai_Snippet::meta_description()
   * @param  null
   * @return string
   *
   * Default header description meta tag.
   */
  public static  function meta_description()
  {
    global $post;
    $content = '';
    if (is_single() || is_page())
    {
      $meta_description = get_post_meta($post->ID, 'metadescription', true);
      if ($meta_description != '')
      {
        $content .= esc_attr($meta_description);
      }
      else
      {
        if (have_posts())
        {
          while (have_posts())
          {
            the_post();
            $excerpt = esc_attr(strip_tags(get_the_excerpt()));
            if (strlen($excerpt) > 140) $excerpt = substr($excerpt, 0, 140);
            $content .= $excerpt;
          }
        }
      }
    }
    elseif (is_home() || is_front_page())
    {
      $content .= get_bloginfo('description');
    }
    elseif (is_category())
    {
      $cat_desc = esc_attr(trim(strip_tags(category_description ())));
      if ($cat_desc != '')
        $content .= $cat_desc;
      else
        $content .= 'Archive for the category ' . single_cat_title('', false);
    }
    elseif (is_tag())
    {
      $tag_desc = esc_attr(trim(strip_tags(tag_description())));
      if ($tag_desc != '')
        $content .= $tag_desc;
      else
        $content .= 'Archive for the tag ' . single_tag_title('', false);
    }
    elseif (is_author())
    {
      if (isset($_GET['author_name']))
        $curauth = get_user_by('slug', $author_name);
      else
        $curauth = get_userdata(intval($author));
       $content .= 'Archive for the author ' . $curauth->display_name;
    }
    elseif (is_year())
    {
      $content .= 'Archive for ' . get_the_time('Y');
    }
    elseif (is_month())
    {
      $content .= 'Archive for ' . get_the_time('F, Y');
    }
    elseif (is_day())
    {
      $content .= 'Archive for ' . get_the_time('jS F, Y');
    }
    echo $content;
  }



  /**
   * Get Archive Title
   *
   * Samurai_Snippet::get_archive_title()
   * @param  null
   * @return string
   */
  public static function get_archive_title($echo = true)
  {

    global $wp_query;

    if (is_category()) /* Category Archive */
    {
      $archive_title = single_cat_title('', false);
    }
    elseif (is_tag()) /* Tag Archive */
    {
      $archive_title = _e('Articles Tagged &#8216;') . single_tag_title('', false) . _e('&#8217;');
    }
    elseif (is_day()) /* Daily Archive */
    {
      $archive_title = _e('Archive for ') . get_the_time('F jS, Y');
    }
    elseif (is_month()) /* Monthly Archive */
    {
      $archive_title = _e('Archive for ') . get_the_time('F, Y');
    }
    elseif (is_year()) /* Yearly Archive */
    {
      $archive_title = _e('Archive for ') . get_the_time('Y');
    }
    elseif (is_author()) /* Author Archive */
    {
      $archive_title = _e('Author Archive');
    }
    elseif (is_tax()) /* Taxonomy Archive */
    {
      $taxonomy_term = $wp_query->get_queried_object();
      $archive_title = $taxonomy_term->name . _e(' Archive');
    }
    elseif (method_exists('Samurai_Helper', 'is_post_type') && Samurai_Helper::is_post_type()) /* Post Type Archive */
    {
      $post_type_obj = get_post_type_object(get_post_type($wp_query->post->ID));
      $archive_title = $post_type_obj->labels->name;
    }
    elseif (isset($_GET['paged']) && ! empty($_GET['paged'])) /* Paged Archive */
    {
      $archive_title = _e('Article Archives');
    }
    else /* Archive */
    {
      $archive_title = _e('Article Archive');
    }

    if ($echo == true)
    {
      echo $archive_title;
    }

    return $archive_title;
  }



  /**
   * Get Message
   *
   * Samurai_Snippet::get_message()
   * @param  null
   * @return string
   *
   * Function to get defined feedback and notification messages.
   */
  public static function get_message($handle = '')
  {
    get_template_part(SAMURAI_VIEWS_PATH . '/message', Samurai_Helper::urify_words($handle));
  }



  /**
   * Get Loop
   *
   * Samurai_Snippet::get_loop()
   * @param  null
   * @return string
   */
  public static function get_loop($handle = '', $suffix = '')
  {
    $suffix = ($suffix) ? '-' . $suffix: '';
    get_template_part(SAMURAI_VIEWS_PATH . '/loop' . $suffix, Samurai_Helper::urify_words($handle));
  }



  /**
   *  Function to add more edit buttons to comments
   */
  public static function delete_comment_link($id)
  {
    if (current_user_can('edit_post'))
    {
      echo ' | <a href="' . admin_url("comment.php?action=cdc&c=$id") . '">Delete</a> | '
        . '<a href="' . admin_url("comment.php?action=cdc&dt=spam&c=$id") . '">Spam</a>';
    }
  }



  /**
   * Adds a back to parent category, page, etc link
   *
   * Need to add functionality for post type, taxonomy,
   */
  public static function back_to_parent_link()
  {
    global $post;
    $url = '';
    $name = '';
    $category = get_the_category();

    if (is_attachment())
    {
      $post_parent = get_post($post->post_parent);
      $url = get_permalink($post_parent->ID);
      $name = get_the_title($post_parent->ID);
    }
    elseif (Samurai_Helper::is_post_type())
    {
      $url = get_post_type_archive_link(get_post_type($post->ID));
      $name = Samurai_Helper::prettify_words(Samurai_Helper::plurify_words(get_post_type(get_the_ID())));
    }
    else
    {
      $url = home_url();
      $name = get_bloginfo('name');
    }

    if ($url && $name)
    {
      echo '<a class="back-to-parent-link" title="Back to ' . $name . '" href="'
        . $url . '">&larr; Back to ' . $name . '</a>';
    }
  }



  /**
   *  Function to get categories and taxonomies for a post
   */
  public static function get_taxonomies_terms_links()
  {
    global $post, $post_id;
    $post = &get_post($post->ID); // get post by post id
    $post_type = $post->post_type; // get post type by post
    $taxonomies = get_object_taxonomies($post_type); // get post type taxonomies
    foreach ($taxonomies as $taxonomy)
    {
      $terms = get_the_terms($post->ID, $taxonomy); // get the terms related to post
      if (! empty($terms))
      {
        $out = array();
        foreach ($terms as $term)
        {
          $out[] = '<a href="' . get_term_link($term->slug, $taxonomy) . '">' . $term->name . '</a>';
        }
        return join(', ', $out);
      }
    }
    return false;
  }



  /**
   *  Default post meta information
   */
  public static function include_post_meta()
  {
    if (SAMURAI_ENABLE_META_DATA)
    {
      echo '<p class="postmetadata">'
        . '<span class="post-categories-time">'
        . _e('Posted ');

      if (self::get_taxonomies_terms_links())
      {
        echo _e(' in ');
        echo self::get_taxonomies_terms_links();
        echo ', ';
      }

      echo 'on the ';
      the_time('jS \o\f F, Y');
      echo '.';

      if (SAMURAI_ENABLE_COMMENTS)
      {
        echo ' ';
        comments_popup_link('No Comments', '1 Comment &rarr;', '% Comments &rarr;', 'comments-link', '');
      }

      echo '</span><br>';
      the_tags('<span class="post-tags">Tags: ', ', ', '</span>');
      echo '</p>';
    }
  }



  /**
   * Read More Text
   *
   * Samurai_Snippet::read_more_text()
   * @param  null
   * @return string
   *
   * Function to change the read more text on Archive pages
   */
  public static function read_more_text()
  {
    if (is_attachment())
    {
      echo 'View full size image &rarr;';
    }
    else
    {
      echo 'Read more &rarr;';
    }
  }



  /**
   *  Function to create a custom comment list
   */
  public static function advanced_comment($comment, $args, $depth)
  {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <div class="comment-vcard">
        <?php echo get_avatar($comment, '56'); ?>
      </div>
      <div class="comment-body">
        <div class="comment-author">
          <a href="<?php the_author_meta('user_url'); ?>">
            <?php printf(__('%s'), get_comment_author_link()); ?>
          </a> said:
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
        <div>
          <em><?php _e('Your comment is awaiting moderation.'); ?></em>
          <br>
        </div>
        <?php endif; ?>
        <div class="comment-text"><?php comment_text() ?></div>
        <div class="comment-meta">
          <small>on the <?php printf(__('%1$s'), get_comment_date('l, F j, Y')); ?>
            <?php if (current_user_can('edit_post')) : ?>
            (<?php edit_comment_link(__('Edit'), '', '') ?><?php self::delete_comment_link(get_comment_ID()); ?>)
            <?php endif; ?>
          </small>
        </div>
        <div class="reply">
          <?php comment_reply_link(
            array_merge($args,
              array('depth' => $depth, 'max_depth' => $args['max_depth'])
            )
          ); ?>
        </div>
      </div>
  <?php }

}
