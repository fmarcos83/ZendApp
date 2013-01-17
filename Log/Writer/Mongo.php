<?php

namespace ZendApp\Log\Writer;

class Mongo extends \Zend_Log_Writer_Abstract
{
    public function __construct($db, $collection)
    {
        $this->_db = $db;
        $this->_collection = $collection;
    }

    public function shutdown()
    {
        $this->_db = null;
    }

    public function setFormatter(Zend_Log_Formatter_Interface $formatter)
    {
        throw new \Zend_Log_Exception(__CLASS__.'does not support formatting');
    }

    static public function factory($config){

    }

    protected function _write($event){
        $json = \Zend_Json::encode($event);
        $this->_db->{$this->_collection}->insert(\Zend_Json::decode($json, \Zend_Json::TYPE_ARRAY));
    }

}
