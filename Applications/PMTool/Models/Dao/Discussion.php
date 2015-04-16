<?php

/**
*
* @package    Basic MVC framework
* @author     Jeremie Litzler
* @copyright  Copyright (c) 2014
* @license
* @link
* @since
* @filesource
*/
// ------------------------------------------------------------------------

/**
*
* Discussion Dao Class
*
* @package     Application/PMTool
* @subpackage  Models/Dao
* @category    Discussion
* @author      FWM DEV Team
* @link
*/

namespace Applications\PMTool\Models\Dao;
if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed');

class Discussion extends \Library\Entity{
  public 
    $discussion_id,
    $task_id;

  const 
    DISCUSSION_ID_ERR = 0,
    TASK_ID_ERR = 1;

  // SETTERS //
  public function setDiscussion_id($discussion_id) {
      $this->discussion_id = $discussion_id;
  }

  public function setTask_id($task_id) {
      $this->task_id = $task_id;
  }

  public function setDiscussionContentCategory_Value($val) {
    $this->discussion_content_category_value = $val;
  }

  public function setDiscussionContentCategory_Type($type) {
    $this->discussion_content_category_type = $type;
  }

  // GETTERS //
  public function discussion_id() {
    return $this->discussion_id;
  }

  public function task_id() {
    return $this->task_id;
  }


  public function discussion_content_is_receiver($type) {
    return $this->discussion_content_is_receiver = $type; 
  }

  public function discussion_content_category_value() {
    return $this->discussion_content_category_value;
  }

  public function discussion_content_category_type() {
    return $this->discussion_content_category_type;
  }


}
