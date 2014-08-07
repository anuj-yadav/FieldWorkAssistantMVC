<?php if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed'); ?>
<section class="right-aside col-lg-9 col-md-9 col-md-offset-1">
  <h2></h2>
  <section class="welcome <?php echo $display_project_welcome; ?>">
    <h1 class="legend"><?php echo $resx["project_h1"]; ?></h1>
    <p><?php echo $resx["project_welcome_message"]; ?></p>
  </section>
  <section class="form_sections <?php echo $display_add_project; ?>">
      <?php
      foreach ($form_modules as $key => $module_path) {
        require $module_path;
      }
      ?>
  </section>

</section>	
</div><!-- END CONTENT CONTAINER -->
