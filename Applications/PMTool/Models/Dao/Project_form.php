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
 * Service Dao Class
 *
 * @package     Application/PMTool
 * @subpackage  Models/Dao
 * @category    Project_form
 * @author      FWM DEV Team
 * @link
 */
namespace Applications\PMTool\Models\Dao;
if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed');

class Project_form extends \Library\Entity {
  public
    $project_id,
    $master_form_id,
    $user_form_id;

  const
    PROJECT_ID_ERR = 0,
    MASTER_FORM_ID_ERR = 1,
    USER_FORM_ID_ERR = 2;

  // SETTERS //
  public function setProject_id($project_id) {
    $this->project_id = $project_id;
  }

  public function setMaster_form_id($master_form_id) {
    $this->master_form_id = $master_form_id;
  }

  public function setUser_form_id($user_form_id) {
    $this->user_form_id = $user_form_id;
  }

  // GETTERS //
  public function project_id() {
    return $this->project_id;
  }

  public function master_form_id() {
    return $this->master_form_id;
  }

  public function user_form_id() {
    return $this->user_form_id;
  }

}