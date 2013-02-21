<?php

declare(encoding='UTF-8');

namespace ZendApp\Model;

class HelperFactory
{
    protected static $finderRegister = array();
    protected static $collectionRegister = array();

    //TODO should store objects so it could check mandatory params
    protected static $mapClassNames = array();

    public function addMapsClassConfig(array $config)
    {
        foreach($config as $name => $node)
        {
            self::addMapClassConfig($name, $node);
        }
    }

    public function addMapClassConfig($name, $node){
        if(!isset(self::$mapClassNames[$name]))
        {
            self::$mapClassNames[$name] = $node;
        }
    }

    public function getMapClassConfigs()
    {
        return self::$mapClassNames;
    }

    private static function nodeExists($name)
    {
        if(!isset(self::$mapClassNames[$name]))
        {
            throw new \Exception("$name node not set");
        }
    }

    public static function getDao($name) {
        self::nodeExists($name);
        $dao = new self::$mapClassNames[$name]['dao'];
        return $dao;
    }

    public static function getFinder($name) {
        self::nodeExists($name);
        if(!isset(self::$finderRegister[$name]))
        {
            $dgClassName = self::$mapClassNames[$name]['datagateway'];
            $daoClassName = self::$mapClassNames[$name]['dao'];
            $mapperClassName = self::$mapClassNames[$name]['mapper'];
            $collectionName = self::$mapClassNames[$name]['collection'];
            $dg = new $dgClassName($collectionName);
            self::$finderRegister[$name] = new $mapperClassName(
                $dg
            );
        }
        return self::$finderRegister[$name];
    }

    public static function getCollection($name) {
        self::nodeExists($name);
        if (!isset(self::$collectionRegister[$name])) {
            $finder = self::getFinder($name);
            $daoCollection = self::$mapClassNames[$name]['daocollection'];
            self::$collectionRegister[$name] = new $daoCollection(array(), $finder);
        }
        return self::$collectionRegister[$name];
    }
}
