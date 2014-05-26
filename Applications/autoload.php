<?php

function autoload($class) {
  $file = __ROOT__ . str_replace('\\', '/', $class) . '.php';
  if (file_exists($file)) {
    try {
      require_once $file;
    } catch (Exception $exc) {
      echo "<!--" . $exc->getMessage() . "-->";
    }
  }
}

define('__BASEURL__', '/FieldWorkAssistantMVC/');
define('__ROOT__', dirname(dirname(__FILE__)) . '/');
echo "<!-- " . __ROOT__ . " -->";

spl_autoload_register('autoload');
