<?php

namespace ZendApp\Application\Resource;

use ZendApp\Model\HelperFactory;

class Modelconfig
    extends \Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        $options = $this->getOptions();
        if(!isset($options['config']))
            throw new \Exception('config file in yaml format is mandatory');
        $config = new \Zend_Config_Yaml($options['config']);
        HelperFactory::addMapsClassConfig($config->toArray());
    }
}
