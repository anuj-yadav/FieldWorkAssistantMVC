<?php

namespace Applications\PMTool;
if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed');

class PMToolApplication extends \Library\Application {

  public function __construct() {
    parent::__construct();

    $this->name = 'PMTool';
    $this->context()->setLanguage();
    $this->logoImageUrl = $this->imageUtil->getImageUrl("FWM_logo.jpg");
    
  }

  public function run() {
    \Library\Core\Utility\TimeLogger::StartLog($this, \Library\Enums\ResourceKeys\GlobalAppKeys::log_http_request);
    $this->i8n->loadResources();
    
    $controller = $this->getController();

    //Get add the Project Manager object to the page
    //The variable PM will be available accross the application
    $pm = $controller->app()->user->getAttribute(\Library\Enums\SessionKeys::UserConnected);
    $controller->page()->addVar('pm', $pm[0]);  
    
    $controller->execute();
    

    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
  }

}