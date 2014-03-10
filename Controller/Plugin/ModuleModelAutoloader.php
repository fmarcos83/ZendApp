<?php
/**
 * Sets resources per module
 *
 * @author <fmarcos83@gmail.com>
 * @version
 * @copyright Francisco Marcos <fmarcos83@gmail.com>, 25 February, 2014
 * @package ZendApp\Controller\Plugin
 */

namespace ZendApp\Controller\Plugin;

use \Zend_Controller_Plugin_Abstract;
use \Zend_Controller_Front;

/**
 * Loads models per module basis
 *
 * @package ZendApp\Controller\Plugin
 * @author <fmarcos83@gmail.com>
 */
class ModuleModelAutoloader extends Zend_Controller_Plugin_Abstract
{
    public function routeShutdown (Zend_Controller_Request_Abstract $request)
    {
        $frontController = Zend_Controller_Front::getInstance();
        $moduleName = $request->getModuleName();
        $bootstrap = $frontController->getParam('bootstrap');
        $resourceName = "model$moduleName";
        $resourcePath = "modules/${moduleName}/models";
        $namespace = ucfirst($moduleName).'_Model';
        $bootstrap->getResourceLoader()
            ->addResourceType($resourceName, $resourcePath, $namespace);
    }
}
