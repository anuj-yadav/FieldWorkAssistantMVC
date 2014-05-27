<?php

namespace Library\DAL;

class Managers {

    protected $api = null;
    protected $dao = null;
    protected $managers = array();

    public function __construct($api, $dao) {
        $this->api = $api;
        $this->dao = $dao;
    }

    public function getManagerOf($module) {
        error_log("Module is <".$module.">");
        if (!is_string($module) || empty($module)) {
            throw new \InvalidArgumentException('Le module spécifié est invalide');
        }

        if (!isset($this->managers[$module])) {
            $manager = '\\Library\DAL\\Models\\' . $module . 'Manager_' . $this->api;
            $this->managers[$module] = new $manager($this->dao);
        }

        return $this->managers[$module];
    }

}