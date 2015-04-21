<?php if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed'); ?>
<div class="right-aside main col-lg-10 col-md-10 col-sm-10">
  <div class="technician_list">
    <h3>
      <?php echo $resx["technician_list_all_header"] ?>
    </h3>
    <div class="content-container container-fluid">
      <div class="row">
        <div  class="col-lg-5 col-md-5">
          <div class="form_sections">
            <?php require $form_modules["user_form"]; ?>
            <?php require $form_modules["technician_form"]; ?>
            <?php require $form_modules[\Applications\PMTool\Resources\Enums\PhpModuleKeys::popup_msg]; ?>
          </div>
        </div>
        <div class="col-lg-1 col-md-1">
          <div class="buttons">
            <input type="button" id="btn_add_technician" class="technician_add btn btn-default" value="<?php echo $resx["technician_button_add"]; ?>" />
            <input type="button" id="btn_edit_technician" class="technician_edit hide btn btn-default" value="<?php echo $resx["technician_button_edit"]; ?>" />
            <input type="button" id="btn_delete_technician" class="technician_edit hide btn btn-default" value="<?php echo $resx["technician_button_delete"]; ?>" />
          </div>
        </div>
        <div  class="col-lg-5 col-md-5">
            <?php require $form_modules[Applications\PMTool\Resources\Enums\PhpModuleKeys::load_file]; ?>
            <?php require $form_modules[Applications\PMTool\Resources\Enums\PhpModuleKeys::upload_file]; ?>
        </div>
      </div>
    </div>
  </div>
</div><!-- END RIGHT ASIDE MAIN -->