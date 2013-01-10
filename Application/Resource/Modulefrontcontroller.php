<?php
/**
 * ZendApp
 *
 * PHP version 5.3
 *
 * @category   ZendApp
 * @package    Application
 * @subpackage Resource
 * @author     Francisco Marcos <fmarcos83@gmail.com>
 * @license    default
 * @version    SVN: $ Revision: $
 * @date       $ Date: $
 * @link       default
 **/

declare(encoding='UTF-8');

namespace ZendApp\Application\Resource;

use ZendApp\Application\Module\Bootstrap as ModuleBootstrap;

/**
 * Modulefrontcontroller class
 *
 * this classes assumes the same responsibilities
 * as Zend_Controller_Front to load plugins
 * the main difference is that are not registered
 * on the plugin_broker
 *
 * the routing mechanism indicates which module
 * is being accessed, and plugins are concerned
 * about modules on routeShutdown hook so plugin
 * injection is handled by ZendApp\Controller\Plugin\ModulePluginLoader
 * and registers module plugins on routeshutdown method
 *
 * @category ZendApp
 * @package  Application
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  default
 * @link     default
 **/
class Modulefrontcontroller
extends \Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        $bs = $this->getBootstrap();
        $fc = Zend_Controller_Front::getInstance();
        $moduleName = '';
        if($bs instanceof ModuleBootstrap)
        {
            $pluginLoaderName = "ZendApp\Controller\Plugin\ModulePluginLoader";
            //TODO throw exception just in case $pluginLoader is not registered
            $pluginLoader = $fc->getPlugin($pluginLoaderName);
            $moduleName = $bs->getModuleName();
            $options = $this->getOptions();
            foreach($options as $key => $value)
            {
                switch(strtolower($key))
                {
                case 'plugins':
                    foreach((array)$value as $pluginClass)
                    {
                        $stackIndex = null;
                        $disableControllers = array();
                        if(is_array($pluginClass))
                        {
                            $pluginClass = array_change_key_case($pluginClass);
                            if(isset($pluginClass['disable'])){
                                $disableControllers = $pluginClass['disable'];
                                if(!is_array($disableControllers))
                                {
                                   $disableControllers = (array) $disableControllers;
                                }
                            }
                            if(isset($pluginClass['class']))
                            {
                                if(isset($pluginClass['stackindex'])) {
                                    $stackIndex = $pluginClass['stackindex'];
                                }
                                $pluginClass = $pluginClass['class'];
                            }

                        }
                        $pluginClassName = $pluginClass;
                        $pluginLoader->registerModulePlugin($moduleName, $pluginClass, $stackIndex, $disableControllers);
                    }
                default:
                    break;
                }
            }
        }
    }
}
