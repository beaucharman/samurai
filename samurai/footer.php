<?php
/**
 * Footer
 *
 * @version      2.1 | June 6th 2013
 * @package      WordPress
 * @subpackage   samurai
 */
?>
      </main> <!-- /.page-content -->

      <footer class="page-footer" role="contentinfo">

        <?php /* Site information  */?>
        <div class="page-footer__information site-information">
          &copy;<?php echo date('Y'); ?>&nbsp;<?php echo bloginfo('name'); ?>
        </div>

      </footer>

    </div> <!-- /.page-wrap -->

    <?php wp_footer(); ?>
  </body>
</html>
