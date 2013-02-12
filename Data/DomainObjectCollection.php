<?php

declare(encoding='UTF-8');

namespace ZendApp\Data;

use ZendApp\Data\DomainObject as DomainObject;
use ZendApp\Data\Mapper as DataMapper;

class DomainObjectCollection implements \Iterator
{
    protected $mapper;
    protected $total = 0;
    protected $raw = array();

    private $pointer = 0;
    private $objects = array();

    public function __construct (array $raw=null, DataMapper $mapper=null) {
        if(!is_null($raw)&&(!is_null($mapper)))
        {
            $this->raw = $raw;
            $this->total = count($this->raw);
        }
        $this->mapper = $mapper;
    }

    public function notifyAccess()
    {}

    public function add(DomainObject $domainObject)
    {
        $this->notifyAccess();
        $this->objects[$this->total] = $domainObject;
        $this->total++;
    }

    private function getDAO($num)
    {
        $this->notifyAccess();
        if( $num >= $this->total || $num < 0 ){
            return null;
        }
        if(isset($this->objects[$num]))
        {
            return $this->objects[$num];
        }
        if(isset($this->raw[$num]))
        {
            $this->objects[$num] = $this->mapper->createObject($this->raw[$num]);
            return $this->objects[$num];
        }
    }

    public function current()
    {
        return $this->getDAO($this->pointer);
    }

    public function key()
    {
        return $this->pointer;
    }

    public function next()
    {
        $row = $this->getDAO($this->pointer++);
        if(empty($row)){
            $this->pointer--;
        }
        return $row;
    }

    public function valid()
    {
        $isValid = !is_null($this->current());
        return $isValid;
    }

    public function rewind()
    {
        $this->pointer = 0;
        return $this->current();
    }

}
