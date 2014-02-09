/**
 * Lt3 File Upload
 * ========================================================================
 * samurai-file-upload.js
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 * @author       Beau Charman | @beaucharman | http://www.beaucharman.me
 * @link         https://github.com/beaucharman/samurai
 * @license      MIT license
 */
(function ($) {

  $('.custom_upload_file_button').click(function () {

    var $formField = $(this).siblings('.custom_upload_file');

    tb_show('Select a File', 'media-upload.php?type=image&TB_iframe=true');
    window.send_to_editor = function (html) {

      var $fileUrl = $(html).attr('href');

      $formField.val($fileUrl);
      tb_remove();

    };
    return false;

  });

  $('.custom_clear_file_button').click(function () {

    $(this)
      .parent()
      .siblings('.custom_upload_file')
      .val('');
    return false;

  });

}(jQuery));
