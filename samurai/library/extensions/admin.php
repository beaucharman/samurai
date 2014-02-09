<?php
/**
 * Admin
 * ========================================================================
 * admin.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * This files contains the functions and file references
 * that are used to alter and enhance the general administration area.
 * The dashboard files which the admin function file refers
 * to can be found in the library/dashboard/ directory.
 */



class Samurai_Admin
{



  function __construct()
  {

    /**
     * Dashboard and login functions
     */
    add_filter('admin_footer_text', array(&$this, 'replace_admin_footer'));

    if (! SAMURAI_ENABLE_COMMENTS)
    {
      /* Remove the comments admin menu item */
      add_action('admin_menu', array(&$this, 'remove_admin_menus'));

      add_action('init', array(&$this, 'remove_comment_support'), 100);

      add_action('wp_before_admin_bar_render', array(&$this, 'admin_bar_render'));

      add_action('wp_dashboard_setup', array(&$this, 'remove_comments_dashboard_widget'));
    }

    add_action('wp_dashboard_setup', array(&$this, 'remove_dashboard_widgets'));

    add_action('dashboard_glance_items', array(&$this, 'add_cpt_to_dashboard'));

    /**
     * Content management and display
     */
    add_action('restrict_manage_posts', array(&$this, 'restrict_by_taxonomy'));

    add_filter('parse_query', array(&$this, 'restriction_taxonomy_dropdown'));

    /**
     * User related functions
     */
    add_filter('user_contactmethods', array(&$this, 'custom_userfields', 10, 1));

    /**
     * Security measures
     */
    add_action('admin_head', array(&$this, 'add_admin_nofollow_meta'));

    add_action('init', array(&$this, 'remove_wp_generator'));

    add_filter('login_errors', array(&$this, 'alternate_login_error_message'));

  }



  /**
   *
   * Dashboard and login functions
   *
   */



  /**
   * Replace Admin Footer
   *
   * replace_admin_footer()
   * admin_footer_text filter
   */
  function replace_admin_footer()
  {
    return 'Powered by '
      . '<a href="http://wordpress.org/" title="Visit WordPress.org" rel="external">WordPress</a>. '
      . 'Built with love.';
  }



  /**
   * Disable Global Comments
   *
   * Various methods to remove comment functionality globally
   */
  function remove_admin_menus()
  {
    remove_menu_page('edit-comments.php');
  }

  /* Remove comments support for all post types */
  function remove_comment_support()
  {
    $post_types = get_post_types('', 'names');

    foreach ($post_types as $post_type)
    {
      remove_post_type_support($post_type, 'comments');
    }
  }



  /* Remove comments notifications from the adminbar */
  function admin_bar_render()
  {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
  }

  /* Remove the comments Dashboardwidget */
  function remove_comments_dashboard_widget()
  {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
  }



  /**
   * Remove Dashboard Widgets
   *
   * remove_dashboard_widgets()
   * wp_dashboard_setup action to remove unwanted widgets
   */
  function remove_dashboard_widgets()
  {
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('yoast_db_widget', 'dashboard', 'side');
    remove_meta_box('dashboardb_xavisys', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('bbp-dashboard-right-now', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');
    /**
     * Add more Dashboard Widget handles here to remove.
     */
  }



  /**
   * Add Custom Post Types to 'Right Now'
   *
   * right_now_content_table_end action to add custom post types
  */
  function add_cpt_to_dashboard()
  {
    $showTaxonomies = 1;

    /* Custom taxonomies counts */
    if ($showTaxonomies)
    {
      $taxonomies = get_taxonomies(array('_builtin' => false), 'objects');

      foreach ($taxonomies as $taxonomy)
      {
        $num_terms  = wp_count_terms($taxonomy->name);
        $num = number_format_i18n($num_terms);
        $text = _n($taxonomy->labels->singular_name, $taxonomy->labels->name, $num_terms);
        $associated_post_type = $taxonomy->object_type;

        if (current_user_can('manage_categories'))
        {
          $output = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $num . ' ' . $text . '</a>';
        }

        echo '<li class="taxonomy-count">' . $output . ' </li>';
      }
    }

    /* Custom post types counts */
    $post_types = get_post_types(array('_builtin' => false), 'objects');

    foreach ($post_types as $post_type)
    {

      if ($post_type->show_in_menu == false)
      {
        continue;
      }

      $num_posts = wp_count_posts($post_type->name);
      $num = number_format_i18n($num_posts->publish);
      $text = _n($post_type->labels->singular_name, $post_type->labels->name, $num_posts->publish);

      if (current_user_can( 'edit_posts' ))
      {
        $output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
      }

      echo '<li class="page-count ' . $post_type->name . '-count">' . $output . '</td>';
    }
  }



  /**
   *
   * Content management and display
   *
   */



  /**
   * Create Taxonomy Dropdown Filters
   *
   * restrict_by_taxonomy()
   * restrict_manage_posts action to create custom taxonomy dropdowns
   * for all post types
   */
  function restrict_by_taxonomy()
  {
    global $typenow;

    $args=array('public' => true, '_builtin' => false);
    $post_types = get_post_types($args);

    if (in_array($typenow, $post_types))
    {
      $filters = get_object_taxonomies($typenow);

      foreach ($filters as $tax_slug)
      {
        $tax_obj = get_taxonomy($tax_slug);
        $selected = (isset($_GET[$tax_obj->query_var])) ? $_GET[$tax_obj->query_var] : '';

        wp_dropdown_categories(
          array(
            'show_option_all' => __('Show All ' . $tax_obj->label),
            'taxonomy'        => $tax_slug,
            'name'            => $tax_obj->name,
            'orderby'         => 'term_order',
            'selected'        => $selected,
            'hierarchical'    => $tax_obj->hierarchical,
            'depth'           => 3,
            'show_count'      => false,
            'hide_empty'      => true
         )
       );
      }
    }
  }

  function restriction_taxonomy_dropdown($query)
  {
    global $pagenow,  $typenow;

    if ($pagenow=='edit.php')
    {
      $filters = get_object_taxonomies($typenow);

      foreach ($filters as $tax_slug)
      {
        $var = &$query->query_vars[$tax_slug];

        if (isset($var))
        {
          $term = get_term_by('id', $var,$tax_slug);

          if ($term)
          {
            $var = $term->slug;
          }
        }
      }
    }
  }



  /**
   *
   * User related functions
   *
   */



  /**
   * Custom Userfields
   *
   * custom_userfields()
   * user_contactmethods filter to add custom userfields
   */
  function custom_userfields($methods)
  {
    /* Set user info fields */
    $methods['contact_twitter'] = 'Twitter';
    $methods['contact_linkedin'] = 'LinkedIn';

    return $methods;
  }



  /**
   *
   * Security measures
   *
   */



  /**
   * Add Admin Nofollow Meta
   *
   * add_admin_nofollow_meta()
   * admin_head action to add no follow meta tag to admin
   */
  function add_admin_nofollow_meta()
  {
    if (is_admin())
    {
      echo '<meta name="robots" content="noindex, nofollow">';
    }
  }



  /**
   * Remove WP Version
   *
   * Remove wp_generator from wp_head
   */
  function remove_wp_generator()
  {
    remove_action('wp_head', 'wp_generator');
  }



  /**
   * Alternate Login Error Message
   *
   * alternate_login_error_message()
   * login_errors action to obscure login screen error messages
   */
  function alternate_login_error_message($message)
  {
    if (isset($_GET['action']) && $_GET['action'] === 'lostpassword')
    {
      return $message;
    }
    return 'Sorry, that <strong>Username</strong> and '
      . '<strong>Password</strong> combination is incorrect!';
  }

}

new Samurai_Admin;
