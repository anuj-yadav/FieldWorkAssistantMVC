<?php

namespace Applications\PMTool\Models\Dal;
if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');


abstract class DiscussionDalMaster extends \Library\DAL\BaseManager {
  // temp wrapper for selecting all columns
  //
  public function selectMany($obj, $term, $filter_as_string=false, $all=false) {
    if ($all) {
      $params = array("type" => "SELECT", "dao_class" => \Applications\PMTool\Helpers\CommonHelper::GetFullClassName($obj));
      $query  = sprintf("SELECT * FROM `%s` WHERE `%s` ='%s'", $this->GetTableName($obj),  $term, $obj->$term());
        
      return $this->ExecuteQuery($query, $params);
    } else {
      return parent::selectMany($obj, $term, $filter_as_string);
    }
  }
  public function selectOne($obj, $term=false) {
      $params = array( "type" => "SELECT", "dao_class" => \Applications\PMTool\Helpers\CommonHelper::GetFullClassName($obj));
     return is_string($term)? $this->ExecuteQuery(sprintf(
        "SELECT * FROM `%s` WHERE `%s` = '%s",  $this->GetTableName($obj), $term, $obj->$term()
      ), $params) : parent::selectOne($obj); 
  }

}
final class DiscussionDal extends DiscussionDalMaster {
  public function selectMany($obj, $term, $filter_as_string=false, $all=false) {
    return parent::selectMany($obj, $term, $filter_as_string, $all);
  }
  public function selectOne($obj, $term=false) {
      return parent::selectOne($obj, $term);

  }

}

final class Discussion_contentDal extends DiscussionDalMaster {
  // all = get all columns
  //
  public function selectMany($obj, $term, $filter_as_string=false, $all=true) {
     return  parent::selectMany($obj, $term, $filter_as_string, $all);
  }
  public function selectOne( $obj, $term=false) {
      return parent::selectOne($obj, $term);
  }
}
?>
