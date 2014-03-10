<?php
//TODO docs
namespace ZendApp\Application\Resource;

use ZendApp\Console\Console;
use Zend_Application_Resource_ResourceAbstract;

class Cli extends Zend_Application_Resource_ResourceAbstract
{
    public function init(){
        Console::factory($this->getOptions());
    }
}
