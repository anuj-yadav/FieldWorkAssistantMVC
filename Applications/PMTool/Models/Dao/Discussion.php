<?php

/**
*
* @package    Basic MVC framework
* @author     Jeremie Litzler
* @copyright  Copyright (c) 2015
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
    $task_id,
    $discussion_start_timestamp;

  const 
    DISCUSSION_ID_ERR = 0,
    TASK_ID_ERR = 1,
    DISCUSSION_START_TIMESTAMP_ERR = 2;

  // SETTERS //
  public function setDiscussion_id($discussion_id) {
      $this->discussion_id = $discussion_id;
  }

  public function setTask_id($task_id) {
      $this->task_id = $task_id;
  }

  public function setDiscussion_start_timestamp($discussion_start_timestamp) {
      $this->discussion_start_timestamp = $discussion_start_timestamp;
  }

  // GETTERS //
  public function discussion_id() {
    return $this->discussion_id;
  }

  public function task_id() {
    return $this->task_id;
  }

  public function discussion_start_timestamp() {
    return $this->discussion_start_timestamp;
  }


}
