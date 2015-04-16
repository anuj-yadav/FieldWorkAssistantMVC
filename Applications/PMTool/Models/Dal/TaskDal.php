<?php

namespace Applications\PMTool\Models\Dal;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class TaskDal extends \Library\DAL\BaseManager {

  public function selectOne($object, $by=false) {
    $params = array('type' => 'SELECT', 
     'dao_class' => \Applications\PMTool\Helpers\CommonHelper::GetFullClassName($object)
     );
    if (is_string($by)) {
    return $this->ExecuteQuery(sprintf("
      SELECT * FROM `%s` WHERE %s = '%s'
    ", $this->GetTableName($object),$by,$object->$by()), $params);
    } else {
     return parent::selectOne($object);
    }
  }

  public function update($object) {
    return NULL;
  }

  public function countById($pm_id) {
    return NULL;
  }
}
