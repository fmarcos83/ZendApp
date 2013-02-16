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

namespace ZendApp\Application\Module;

/**
 * Bootstrap class
 *
 * this class is intended to provide config
 * and plugin injection during module bootstrap
 * the same way frontcontroller does
 *
 * @category   ZendApp
 * @package    Application
 * @subpackage Module
 * @author     Francisco Marcos <fmarcos83@gmail.com>
 * @license    default
 * @link       default
 **/
class Bootstrap
extends \Zend_Application_Module_Bootstrap
{
    /**
     * calls parent constructor and init method
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function __construct($application)
    {
        parent::__construct($application);
        $this->init();
    }

    /**
     * registers Moduleconfig and Moduleplugin to Bootstrap
     * and initializes them
     *
     * !!! bear in mind that you must configure the path
     * !!! to load resources, refer to ZF docs to read about
     * !!! this subject.
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function init(){
        $resources = array('Moduleconfig','Moduleplugin');
        foreach($resources as $resource)
        {
            if(!$this->hasPluginResource($resource)){
                $this->registerPluginResource($resource);
            }
            $this->getPluginResource($resource)->init();
        }
    }
}
