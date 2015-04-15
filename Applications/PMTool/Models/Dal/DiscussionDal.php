<?php

namespace Applications\PMTool\Models\Dal;
if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');


final class DiscussionDal extends \Library\DAL\BaseManager {
}

final class Discussion_contentDal extends \Library\DAL\BaseManager {
  // all = get all columns
  //
  public function selectMany($obj, $term, $filter_by_string=false, $all=true) {
      if (!$all) {
        return parent::selectMany($obj, $term, $filter_by_string);
      }  else {
          $params = array(
            "type" => "SELECT",
            "dao_class" => \Applications\PMTool\Helpers\CommonHelper::GetFullClassName($obj)
          ); 

          $query = sprintf("SELECT * FROM `%s` WHERE `%s` =  '%s'", parent::GetTableName($obj),  $term, $obj->$term());
          return parent::ExecuteQuery($query, $params);
      }

  }
}
?>
