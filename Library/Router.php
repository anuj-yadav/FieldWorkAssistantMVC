<?php

namespace Library;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class Router extends ApplicationComponent {

  protected $routes = array();
  public $pageUrls = array();
  public $isWsCall = false;

  const NO_ROUTE = 1;

  public function addRoute(Route $route) {
    if (!in_array($route, $this->routes)) {
      $this->routes[] = $route;
    }
  }

  public function getRoute($url) {
    foreach ($this->routes as $route) {
      // Si la route correspond à l'URL.
      if (($varsValues = $route->match($url)) !== false) {
        $varsNames = $route->varsNames();
        $listVars = array();
        $this->createListOfVars($varsValues, $varsNames, $listVars);

        // On assigne ce tableau de variables à la route.
        $route->setVars($listVars);
        return $route;
      }
    }

    throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
  }

  private function createListOfVars($varsValues, $varsNames, $listVars) {
    // On créé un nouveau tableau clé/valeur.
    // (Clé = nom de la variable, valeur = sa valeur.)
    foreach ($varsValues as $key => $match) {
      // La première valeur contient entièrement la chaine capturée (voir la doc sur preg_match).
      if ($key !== 0) {
        $listVars[$varsNames[$key - 1]] = $match;
      }
    }
    return $listVars;
  }

  public function LoadAvailableRoutes(Application $currentApp) {
    $xml = new \DOMDocument;
    $xml->load(__ROOT__ . 'Applications/' . $currentApp->name . '/Config/routes.xml');

    $routes = $xml->getElementsByTagName('route');
    // On parcourt les routes du fichier XML.
    foreach ($routes as $route) {
      $vars = array();

      // On regarde si des variables sont présentes dans l'URL.
      if ($route->hasAttribute('vars')) {
        $vars = explode(',', $route->getAttribute('vars'));
      }
      // We store the page Url to be used globally in the app
      $this->pageUrls[$route->getAttribute('url') . "Url"] = $route->getAttribute('url');

      // On ajoute la route au routeur.
      $route_config = array(
          "route_xml" => $route,
          "vars" => $vars,
          "js_head" => $this->_GetJsFiles($route, "head"),
          "js_html" => $this->_GetJsFiles($route, "html"),
          "css" => $this->_LoadCssFiles($route)
      );
      $this->addRoute(new Route($route_config));
    }
  }

  /**
   * Store the script urls to add to the loading view or to the head element
   * 
   * @param type $route
   * @return string
   */
  private function _GetJsFiles($route, $destination) {
    $scripts = "";
    foreach ($route->getElementsByTagName('js_file') as $script) {
      if ($script->getAttribute('use') === $destination) {
        $scripts .= '<script type="application/javascript" src="' . $script->getAttribute('value') . '"></script>';
      }
    }
    return $scripts;
  }

  /**
   * Store the css files urls to add to the loading view
   * @param type $route
   */
  private function _LoadCssFiles($route) {
    $css_files = "";
    foreach ($route->getElementsByTagName('css_file') as $css_file) {
      $css_files .= '<link rel="stylesheet" type="text/css" href="' . $css_file->getAttribute('value') . '"/>';
    }
    return $css_files;
  }

}
