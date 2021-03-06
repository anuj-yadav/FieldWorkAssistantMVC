<?php if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed'); ?>
<div class="right-aside main col-lg-10 col-md-10 col-sm-10">
  <div class="location_list">
    <h3>
      <?php echo $current_project->project_name(); ?>
      <span class="glyphicon glyphicon-chevron-right"></span>
      <?php echo $location_editing_header ?>
    </h3>
    <div class="content-container container-fluid">
      <div class="row">
        <div  class="col-lg-5 col-md-5">
          <div class="form_sections">
            <?php
//            require $form_modules["location_tabs_open"];
            require $form_modules["location_form"];
			require $form_modules[\Applications\PMTool\Resources\Enums\PhpModuleKeys::popup_msg];
			require $form_modules[\Applications\PMTool\Resources\Enums\PhpModuleKeys::popup_prompt];
//            require $form_modules["tabs_close"];
            ?>
          </div>
        </div>
        <div class="col-lg-1 col-md-1">
          <div class="buttons">
            <input type="button" id="btn_add_location" class="location_add btn btn-default" value="<?php echo $resx["location_button_add"]; ?>" />
            <input type="button" id="btn_edit_location" class="location_edit hide btn btn-default" value="<?php echo $resx["location_button_edit"]; ?>" />
            <input type="button" id="btn_delete_location" class="location_edit hide btn btn-default" value="<?php echo $resx["location_button_delete"]; ?>" />
          </div>
        </div>
        <div  class="col-lg-5 col-md-5">
          <?php require $form_modules['load_file']; ?>
          <?php require $form_modules['upload_file']; ?>
        </div>
      </div>
    </div>
  </div>
</div><!--END RIGHT ASIDE MAIN -->