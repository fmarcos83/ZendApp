<?php
/**
 * ZendApp
 *
 * PHP version 5.3
 *
 * @category   ZendApp
 * @package    Application\Controller
 * @subpackage Plugin
 * @author     Francisco Marcos <fmarcos83@gmail.com>
 * @license    default
 * @version    SVN: $ Revision: $
 * @date       $ Date: $
 * @link       default
 **/

declare(encoding='UTF-8');

namespace ZendApp\Controller\Plugin;

/**
 * ModulePluginLoader class
 *
 * injects plugins on routeShutdown hook
 * !!!injected plugin hooks before dispatchLoopstartup
 * !!!won't be called
 *
 * @category default
 * @package  default
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  default
 * @link     default
 **/
class ModulePluginLoader extends
\Zend_Controller_Plugin_Abstract
{
    private $_plugins = array();
    public function registerModulePlugin($moduleName, $plugin, $stackIndex=null,$forwiddenController= null){
        //TODO implement modulePlugin
        //I know it should already be implemented
        //lazyness
        $modulePlugin = array(
            'module' => $moduleName,
            'pluginClassName' => $plugin,
            'stackIndex' => $stackIndex,
            'forwiddenController' => $forwiddenController
        );
        array_unshift($this->_plugins, $modulePlugin);
    }

    public function routeShutdown(
        \Zend_Controller_Request_Abstract $request
    )
    {
        $fc = \Zend_Controller_Front::getInstance();
        $requestModuleName = $request->getModuleName();
        $requestControllerName = $request->getControllerName();
        foreach($this->_plugins as $modulePlugin)
        {
            $forwiddenControllers = $modulePlugin['forwiddenController'];
            if(strcasecmp($requestModuleName, $modulePlugin['module']) === 0 )
            {
                $pluginName = $modulePlugin['pluginClassName'];
                if(!in_array(strtolower($requestControllerName), $forwiddenControllers, true))
                {
                    $plugin = new $pluginName;
                    $fc->registerPlugin($plugin);
                }
            }
        }
    }
}
