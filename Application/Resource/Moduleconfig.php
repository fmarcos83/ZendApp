<?php
/**
 * Resource to enable configurations on every module
 * whose Bootstrap class implements App_Application_Bootstrap
 *
 * PHP version 5.3
 *
 * @category App
 * @package  Resource
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  BSD http://www.tid.es
 * @version  SVN: $ Revision: $
 * @date     $ Date: $
 * @link     Moduleconfig
 **/

declare(encoding='UTF-8');

use App\File\RegexFileScanner as RegexFileScanner;

/**
 * App_Application_Resource_Moduleconfig class
 *
 * @category App
 * @package  Resource
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  BSD http://www.tid.es
 * @link     Moduleconfig
 **/
class App_Application_Resource_Moduleconfig
extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        $fc = Zend_Controller_Front::getInstance();
        $bootstrap = $this->getBootstrap();
        $moduleName = strtolower($bootstrap->getModuleName());
        $suffix = 'module';
        $moduleConfigFileName = implode('_', array($moduleName, $suffix));
        $application = $bootstrap->getApplication();
        $environment = $application->getEnvironment();
        $loadPath = $fc->getModuleDirectory(strtolower($bootstrap->getModuleName()));
        $configDir = 'configs';
        $configDirs = implode(DIRECTORY_SEPARATOR, array($loadPath, $configDir));
        //search ini files
        $fileScanner = new RegexFileScanner(
            $configDirs,
            "/^.*(?<!$moduleConfigFileName)\.(ini)$/i"
        );
        $moduleFileScanner = new RegexFileScanner(
            $configDirs,
            "/^.*$moduleConfigFileName\.(ini)$/i"
        );
        $moduleConfigFileNames = $moduleFileScanner->search();
        $files = $fileScanner->search();
        //attach every ini config file to bootstrap

        foreach($moduleConfigFileNames as $configFileName){
            $config = new Zend_Config_Ini(
                $configFileName,
                $environment
            );
            $bootstrap->setOptions($config->toArray());
        }

        foreach($files as $configFileName){
            $config = new Zend_Config_Ini(
                $configFileName
            );
            $bootstrap->setOptions($config->toArray());
        }
    }
}
