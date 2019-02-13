    <footer class="py-3">

      <?php if (is_active_sidebar('footer-left-sidebar') || is_active_sidebar('footer-middle-sidebar') || is_active_sidebar('footer-right-sidebar')): ?>
      <div class="container footer-sidebars">
        <div class="row">
          <div class="col-md-4">
            <?php dynamic_sidebar('footer-left-sidebar'); ?>
          </div>
          <div class="col-md-4">
            <?php dynamic_sidebar('footer-middle-sidebar'); ?>
          </div>
          <div class="col-md-4">
            <?php dynamic_sidebar('footer-right-sidebar'); ?>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <?php if (is_active_sidebar('footer-bottom-sidebar')): ?>
      <div class="container text-center mt-2">
          <?php dynamic_sidebar('footer-bottom-sidebar'); ?>
      </div>
      <?php endif; ?>

    </footer>

  <?php wp_footer(); ?>

  </body>
</html>