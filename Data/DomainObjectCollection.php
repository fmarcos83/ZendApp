<?php

declare(encoding='UTF-8');

namespace ZendApp\Data;

use ZendApp\Data\DomainObject as DomainObject;
use ZendApp\Data\Mapper as DataMapper;

class DomainObjectCollection implements \Iterator, \Countable
{
    private $mapper = null;

    private $total  = 0;
    private $raw    = array();

    private $pointer  = 0;
    private $objects  = array();

    public function __construct (array $raw=null, DataMapper $mapper=null) {
        if(!is_null($raw)&&(!is_null($mapper)))
        {
            $this->setRawData($raw);
        }
        $this->mapper = $mapper;
    }

    public function setMapper(DataMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function setRawData(array $raw)
    {
        $this->raw = array_values($raw);
        $this->total = count($raw);
        return $this;
    }

    public function count()
    {
        return $this->total;
    }

    //TODO test this function
    public function one()
    {
        return $this->current();
    }

    public function notifyAccess(){}

    public function add(DomainObject $domainObject)
    {
        $this->notifyAccess();
        $this->objects[$this->total] = $domainObject;
        $this->total++;
    }

    //TODO this method should go outside
    //Method -> MethodObject

    /**
     * retrieves null or
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     * @see http://www.refactoring.com/catalog/replaceMethodWithMethodObject.html
     **/
    private function getDAO($num)
    {
        if( $num >= $this->total || $num < 0 ){
            return;
        }
        //lazy load
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
        $this->notifyAccess();
        return $this->getDAO($this->pointer);
    }

    public function rewind()
    {
        $this->pointer = 0;
        return $this->current();
    }

    public function next()
    {
        $this->notifyAccess();
        $row = $this->getDAO($this->pointer++);
        (!empty($row))||$this->pointer--;
        return $row;
    }

    public function key()
    {
        return $this->pointer;
    }

    public function setData(array $data)
    {
        $this->objects = array();
        $this->setRawData($data);
        return $this;
    }

    public function valid()
    {
        return !is_null($this->current());
    }

}
