<?php
/**
 * Editor
 * ========================================================================
 * editor.php
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 *
 * All extra functionality that effects the admin and post editor.
 */



class Samurai_Editor
{



  function __construct()
  {

    /**
     * Add Mime types
     */
    add_filter('post_mime_types', array(&$this, 'modify_post_mime_types'));

    /**
     * Extra TinyMCE Buttons
     */
    if (SAMURAI_ENABLE_EXTRA_TINYMCE_BUTTONS)
    {
      add_filter('mce_buttons', array(&$this, 'edit_buttons_for_tinymce_editor_1'));

      add_filter('mce_buttons_2', array(&$this, 'edit_buttons_for_tinymce_editor_2'));

      add_filter('mce_buttons_2', array(&$this, 'mce_styleselect_editor_buttons'));

      add_filter('tiny_mce_before_init', array(&$this, 'mce_styleselect_editor_settings'));
    }

  }



  /**
   * Modify Post Mime Types
   *
   * samurai_modify_post_mime_types()
   * post_mime_types filter to add PDFs to the media type filter for posts
   */

  function modify_post_mime_types($post_mime_types)
  {
    $post_mime_types['application/pdf'] = array(
      __('PDFs'),
      __('Manage PDFs'),
      _n_noop('PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>')
    );
    return $post_mime_types;
  }



  /**
   * Enable Extra TinyMCE Buttons and Style Select
   *
   * various filters to add more buttons to the TinyMCE editor
   * and a select style drop down
   */

  /**
   * Level 1 buttons
   */
  function edit_buttons_for_tinymce_editor_1($mce_buttons)
  {
    $pos = array_search('wp_more',$mce_buttons,true);

    if ($pos !== false)
    {
      $tmp_buttons = array_slice($mce_buttons, 0, $pos + 1);
      $tmp_buttons[] = 'wp_page';
      $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
    }

    $pos = array_search('justifyright',$mce_buttons,true);

    if ($pos !== false)
    {
      $tmp_buttons = array_slice($mce_buttons, 0, $pos + 1);
      $tmp_buttons[] = 'justifyfull';
      $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
    }

    $pos = array_search('italic',$mce_buttons,true);

    if ($pos !== false)
    {
      $tmp_buttons = array_slice($mce_buttons, 0, $pos + 1);
      $tmp_buttons[] = 'underline';
      $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
    }

    $pos = array_search('unlink',$mce_buttons,true);

    if ($pos !== false)
    {
      $tmp_buttons = array_slice($mce_buttons, 0, $pos + 1);
      $tmp_buttons[] = 'separator';
      $tmp_buttons[] = 'hr';
      $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
    }

    return $mce_buttons;
  }

  /**
   *  Level 2 buttons
   */
  function edit_buttons_for_tinymce_editor_2($mce_buttons)
  {
    $pos = array_search('forecolor',$mce_buttons,true);

    if ($pos !== false)
    {
      $tmp_buttons = array_slice($mce_buttons, 0, $pos + 1);
      $tmp_buttons[] = 'backcolor';
      $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
    }

    $pos = array_search('formatselect',$mce_buttons,true);

    if ($pos !== false)
    {
      $tmp_buttons = array_slice($mce_buttons, 0, $pos + 1);
      $tmp_buttons[] = 'separator';
      $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
    }

    $pos = array_search('charmap',$mce_buttons,true);

    if ($pos !== false)
    {
      $tmp_buttons = array_slice($mce_buttons, 0, $pos + 1);
      $tmp_buttons[] = 'sub';
      $tmp_buttons[] = 'sup';
      $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
    }

    $pos = array_search('pasteword',$mce_buttons,true);

    if ($pos !== false)
    {
      $tmp_buttons = array_slice($mce_buttons, 0, $pos-1);
      $tmp_buttons[] = 'cut';
      $tmp_buttons[] = 'copy';
      $tmp_buttons[] = 'paste';
      $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos-1));
    }
    return $mce_buttons;
  }



  /**
   *  Adds style select to the TinyMCE Editor
   */
  function mce_styleselect_editor_buttons($buttons)
  {
    array_unshift($buttons, 'styleselect');
    return $buttons;
  }



  /**
   * Allocate styles for the TinyMCE Editor style select
   *
   * Add every custom style format's css selector and it's associated
   * style rules to the custom-editor-style.css (can be easily added via the config.php file)
   * For more information: http://codex.wordpress.org/TinyMCE_Custom_Styles
   */
  function mce_styleselect_editor_settings($settings)
  {
    /**
     * Add style formats here.
     */
    $style_formats = array(
      array(
        'title' => 'Lead',
        'inline' => 'span',
        'classes' => 'lead'
      ),
      array(
        'title' => 'Notice',
        'inline' => 'span',
        'classes' => 'notice'
      ),
      array(
        'title' => 'Warning',
        'inline' => 'span',
        'classes' => 'warning'
      )
    );

    $settings['style_formats'] = json_encode($style_formats);
    return $settings;
  }

}

new Samurai_Editor;
