<?php

/**
 *
 * @package     Basic MVC framework
 * @author      Jeremie Litzler
 * @copyright   Copyright (c) 2015
 * @license		
 * @link		
 * @since		
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * CssManager Class
 *
 * @package       Library
 * @subpackage    Core\Utility
 * @category      CssManager
 * @author        Jeremie Litzler
 * @link		
 */

namespace Library\Core\Utility;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class CssManager extends \Library\ApplicationComponent {

  /**
   *
   * @var array $files CSS files list
   */
  protected $files = array();

  public function __construct(\Library\Application $app) {
    parent::__construct($app);
    $this->files = \Library\Core\DirectoryManager::GetFilesNamesRecursively(
            __ROOT__ . \Library\Enums\ApplicationFolderName::WebCss, "css");
  }

}
