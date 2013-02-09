<?php
/**
 * This class is intended to bootstrap navigation through configuration
 * file
 *
 * PHP version 5.3
 *
 * @category Resource
 * @package  Application
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://
 * @version  SVN: $ Revision: $
 * @date     $ Date: $
 * @link     ZendApp_Application_Resource_Navigation
 **/

declare(encoding='UTF-8');

/**
 * Resource class to setup navigation
 *
 * @category Resource
 * @package  Application
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @throw    Exception
 * @license  GNU http://
 * @link     ZendApp_Application_Resource_Navigation
 **/
class ZendApp_Application_Resource_Navigation extends
Zend_Application_Resource_ResourceAbstract
{
    /**
     * parameters
     * -> config path for navigation configuration
     * -> navigation (navigation dictionary @see section for more info)
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     * @see http://framework.zend.com/manual/1.12/en/zend.view.helpers.html
     **/
    public function init()
    {
        $options = $this->getOptions();
        $config = $options['config'];
        $this->_setFileConfig($config);
        $this->_setNavigation();
    }

    /**
     * sets navigation on registry according to resource options
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    private function _setNavigation()
    {
        $options = $this->getOptions();
        $navigation = $options['navigation'];
        $container = new Zend_Navigation($navigation);
        //TODO check if zend navigation is already set
        Zend_Registry::set('Zend_Navigation', $container);
    }

    /**
     * sets this resource configuration from config file
     *
     * @param (String) $configFile pathname for navigation config file
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    private function _setFileConfig($configFile)
    {
        //TODO check the route
        //TODO NotFoundFileException matches better here
        if (!realpath($configFile)) {
            throw new Exception("$configFile is unreachable");
        }
        $config = new Zend_Config_Yaml($configFile);
        $this->setOptions(array('navigation'=>$config->toArray()));
    }
}
