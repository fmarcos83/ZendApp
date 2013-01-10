<?php
/**
 * ZendApp
 *
 * PHP version 5.3
 *
 * @category   ZendApp
 * @package    Application
 * @subpackage Module
 * @author     Francisco Marcos <fmarcos83@gmail.com>
 * @license    default
 * @version    SVN: $ Revision: $
 * @date       $ Date: $
 * @link       default
 **/

declare(encoding='UTF-8');

namespace ZendApp\Application\Resource;

/**
 * Moduleplugin class
 *
 * is itended to load plugin resources under
 * plugins module path
 *
 * @category default
 * @package  default
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  default
 * @link     default
 **/
class Moduleplugin
extends \Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        $bs = $this->getBootstrap();
        $fc = Zend_Controller_Front::getInstance();
        $pLoader = $bs->getPluginLoader();
        $moduleName = $bs->getModuleName();
        $modulePath = $fc->getModuleDirectory(strtolower($moduleName));
        //$pLoader->addPrefixPath();
        $prefixPath='resource';
        $prefix = $moduleName.'_Resource';
        $prefixPathDir = implode(DIRECTORY_SEPARATOR, array( $modulePath, $prefixPath));
        $pLoader->addPrefixPath($prefix, $prefixPathDir);
    }
}
