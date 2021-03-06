<?php if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed'); ?>
<div class="scroll-bar">
  <ol id="categorized-list-left" class="list-panel categorized">
    <?php
    $arraysOfObjects = $data[\Applications\PMTool\Resources\Enums\ViewVariablesKeys::categorized_list_left];
    foreach ($arraysOfObjects as $key => $arrayOfObjects) {
      echo "<li class=\"category-name\">" . $key . "</li>";
      foreach ($arrayOfObjects as $object) {
        if(isset($data[\Applications\PMTool\Resources\Enums\ViewVariablesKeys::properties_left][\Applications\PMTool\Resources\Enums\ViewVariablesKeys::data_identifier])) {
          $dataIdentifier =
            $data
            [\Applications\PMTool\Resources\Enums\ViewVariablesKeys::properties_left]
            [\Applications\PMTool\Resources\Enums\ViewVariablesKeys::data_identifier];
          $dataObject = $object->$dataIdentifier();
        } else {
          $dataObject = '';
        }
        $prop_id =
                $data
                [\Applications\PMTool\Resources\Enums\ViewVariablesKeys::properties_left]
                [\Applications\PMTool\Resources\Enums\ViewVariablesKeys::property_id];
        $prop_name =
                $data
                [\Applications\PMTool\Resources\Enums\ViewVariablesKeys::properties_left]
                [\Applications\PMTool\Resources\Enums\ViewVariablesKeys::property_name];
        echo
        "<li data-object=\"".$dataObject."\" data-"
        . $data[\Applications\PMTool\Resources\Enums\ViewVariablesKeys::module]
        . "-id=\"" . $object->$prop_id() . "\" class=\"select_item ui-widget-content\">"
        . $object->$prop_name()
        . "</li>";
      }
    }
    ?>              
  </ol>   
</div>
