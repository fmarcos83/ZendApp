<?php

declare(encoding='UTF-8');

namespace ZendApp\Application\Module;

class Autoloader extends \Zend_Application_Module_Autoloader
{
    public function __construct($options)
    {
        parent::__contruct($options);
        $this->initCustomResourceTypes();
    }

    public function initCustomResourceTypes()
    {
        $this->addResourceTypes(array(
            'namespace' => 'Model_POPO',
            'path' => 'models/popos'
        ));
    }
}
