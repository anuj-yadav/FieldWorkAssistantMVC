<div class="content-container container-fluid">
  <div class="row">
    <div  class="col-lg-5 col-md-5">
      <span class="h4"><?php echo $resx['h4_taskcomm_leftcol'] ?></span>
      <span id="h4-taskcomm-leftcol-gi" class="glyphicon glyphicon-info-sign"></span>
      <div>
      	<textarea  class="list-panel upload_list" name="task_comm_message" type="text"></textarea>
      </div>
    </div>
    <div class="col-lg-1 col-md-1">
      <div class="buttons">
		<?php require $form_modules["group_list_promote_buttons_module"]; ?>
        <?php 
		if ($comm_with_name !== '')
			require $form_modules["communications_button_module"]; 
		?>
      </div>
    </div>
    <div  class="col-lg-5 col-md-5">
      <span class="h4"><?php echo $resx['h4_taskcomm_rightcol'] ?></span>
      <span id="h4-taskcomm-rightcol-gi" class="glyphicon glyphicon-question-sign"></span>
      <div>
        <span class="h4"><?php echo $resx["h4_taskcomm_services"]; ?></span>
        <span class="glyphicon glyphicon-info-sign" id="h4-taskcomm-services-gi"></span>
        <?php require $form_modules[Applications\PMTool\Resources\Enums\ViewVariablesKeys::categorized_list_left]; ?>
      </div>
      <div>&nbsp;
      </div>
      <div>
        <span class="h4"><?php echo $resx["h4_taskcomm_technicians"]; ?></span>
        <span class="glyphicon glyphicon-info-sign" id="h4-taskcomm-technicians-gi"></span>
        <?php require $form_modules["group_list_left"]; ?>
      </div>
    </div>
  </div>
</div>