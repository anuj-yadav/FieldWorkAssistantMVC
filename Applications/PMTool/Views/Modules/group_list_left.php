<?php if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed'); ?>

<ol id="group-list-left" class="list-panel">
<?php
  foreach ($data[\Applications\PMTool\Resources\Enums\ViewVariablesKeys::objects_left] as $object) {
      echo
      "<li data-".$data[\Applications\PMTool\Resources\Enums\ViewVariablesKeys::module]."-id=\"" . $object->$data[\Applications\PMTool\Resources\Enums\ViewVariablesKeys::properties_left][\Applications\PMTool\Resources\Enums\ViewVariablesKeys::property_id] . "\" class=\"select_item ui-widget-content\">"
      . $object->$data[\Applications\PMTool\Resources\Enums\ViewVariablesKeys::properties_left][\Applications\PMTool\Resources\Enums\ViewVariablesKeys::property_name]
      . "</li>";
  }
?>              
</ol>
