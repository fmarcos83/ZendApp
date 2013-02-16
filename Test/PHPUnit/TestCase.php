<?php

namespace ZendApp\Test\PHPUnit;

class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function getCleanMock($className)
    {
        $class = new ReflectionClass($className);
        $methods = $class->getMethods();
        $stubMethods = array();
        foreach ($methods as $method) {
            if($method->isPublic()||($method->isProtected() && $method->isAbstract()))
            {
                $stubMethods[] = $method->getName();
            }
        }
        return $this->getMock($className, $stubMethods, array(), $className.'_Test_'.uniqid(), false);
    }
}
