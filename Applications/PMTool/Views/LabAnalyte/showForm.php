<?php if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed'); ?>
<div class="right-aside main col-lg-10 col-md-10 col-sm-10">
    
  <div class="form_sections">
    <?php
    foreach ($form_modules as $key => $module_path) {
      require $module_path;
    }
    ?>
  </div>

</div>
