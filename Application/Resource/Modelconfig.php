<?php

namespace ZendApp\Application\Resource;


class Modelconfig
    extends \Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        $options = $this->getOptions();
        print_r($options);
    }
}
