<?php
/**
 * Generic class to be implemented by generic POPO
 * part of DataMapper design pattern implementation
 *
 * PHP version 5.3
 *
 * @category Data
 * @package  ZendApp
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org/licenses/gpl.txt
 * @version  SVN: $ Revision: $
 * @date     $ Date: $
 * @link     http://www.martinfowler.com/eaaCatalog/dataMapper.html
 **/

declare(encoding='UTF-8');

namespace ZendApp\Data;

use ZendApp\Data\Exception\DomainObject as DomainObjectException;

/**
 * DomainObject class to implement custom POPO's
 *
 * @category Data
 * @throw    ZendApp\Data\Exception\DomainObject
 * @package  ZendApp
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org/licenses/gpl.txt
 * @link     DomainObject
 **/
class DomainObject implements \IteratorAggregate
{
    //TODO necesary to add an id_key
    //TO not limity id to an implementation

    protected $data = array();
    protected $filterKeys = array();

    /**
     * instantiates POPO's according to protected data or array
     * (the array it's specially intended for testing porpouses)
     *
     * @param (array) $data dictionary to instantiate POPO's
     *
     * @throw ZendApp\Data\Exception\DomainObject if $data property is empty
     *                                            and any dictionary key is no
     *                                            ctype_alpha
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function __construct(array $data=null)
    {
        $data = ($data)?:$this->data;
        if (!count($data)) {
            throw new DomainObjectException("\$data cannot be an empty array");
        }
        array_walk($data, function($value,$key){if(!ctype_alnum($key)){
            throw new DomainObjectException("\$data must be a dictionary with alnum key values");
        }});
        $properties = array_map('strtolower', array_keys($data));
        $values = array_values($data);
        $this->data = array_combine($properties, $values);
        //TODO test fluid interface
        return $this;
    }

    /**
     * sets an array with values to filter the data this object returns
     *
     * @param (array) $keys an array with values to filter from $data
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function setFilterKeys(array $keys)
    {
        $this->filterKeys = $keys;
    }

    /**
     * return the filter keys for this model
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function getFilterKeys()
    {
        return $this->filterKeys;
    }

    /**
     * checks if a property exists
     *
     * @param (String) $property the property to check
     *
     * @throw ZendApp\Data\Exception\DomainObject
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    private function _checkProperty($property)
    {
        if (!array_key_exists($property, $this->data)) {
            throw new DomainObjectException(
                "$property is not present in this domain object"
            );
        }
    }

    /**
     * exports current data array property
     *
     * @params (mixed) object id you don't want to export
     *
     * @return array
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function toArray()
    {
        $data = $this->data;
        $excludeKeys = func_get_args();
        $excludeKeys = (!count($excludeKeys))?
            $this->getFilterKeys():
            $excludeKeys;
        $returnData = (count($excludeKeys))?
            array_diff_key($data, array_flip($excludeKeys))
            :$data;
        return $returnData;
    }

    /**
     * IteratorAggregate public method to export this object to a Traversable
     * instance
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function getIterator()
    {
        return new ArrayIterator($this->toArray());
    }

    /**
     * injects a dictionary on POPO object according to setter rules
     *
     * @param (array) $data dictionary to add values when object
     *                      has been instantiated
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function setData(array $data)
    {
        foreach ($data as $key=>$value) {
            $this->{$key} = $value;
        }
        //TODO test fluid interface
        return $this;
    }

    /**
     * sets a property in the domain object on instantiation
     * throws exception otherwise
     *
     * @param (String) $property property is intended to be set
     * @param (String) $value    property value
     *
     * @throw ZendApp\Data\Exception\DomainObject
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function __set($property, $value)
    {
        $lowerProperty = strtolower($property);
        $this->_checkProperty($lowerProperty);
        if ($lowerProperty=='id'&&!empty($this->{$lowerProperty})) {
            throw new DomainObjectException("id is inmutable in this DomainObject");
        }
        $this->data[$lowerProperty] = $value;
    }

    /**
     * retrieves a property from POPO if exists throws an exception
     * otherwise
     *
     * @param (String) $property the POPO's property value to retrieve
     *
     * @throw ZendApp\Data\Exception\DomainObject
     *
     * @return mixed
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function __get($property)
    {
        $lowerProperty = strtolower($property);
        $this->_checkProperty($lowerProperty);
        return $this->data[$lowerProperty];
    }

    /**
     * checks if POPO's property is set (!=null|0|false|'')
     *
     * @param (String) $property the POPO's property value to retrieve
     *
     * @return Boolean
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function __isset($property)
    {
        $lowerProperty = strtolower($property);
        return isset($this->data[$lowerProperty]);
    }

    /**
     * unset this POPO's object property
     *
     * @param (String) $property the POPO's property value to retrieve
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function __unset($property)
    {
        $lowerProperty = strtolower($property);
        unset($this->data[$lowerProperty]);
    }
}
