<?php
/**
 * class to implement datamappers
 *
 * PHP version 5.3
 *
 * @category Data
 * @package  ZendApp
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.licenses/lgpl.txt
 * @version  SVN: $ Revision: $
 * @date     $ Date: $
 * @link     default
 **/

declare(encoding='UTF-8');

namespace ZendApp\Data;

use ZendApp\Data\Exception\Mapper as MapperException;
use ZendApp\Data\DomainObject as DomainObject;
use ZendApp\Data\DataGateway\DataGatewayInterface as DataGatewayInterface;

/**
 * Mapper class class to implement
 *
 * @category Data
 * @package  ZendApp
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.licenses/lgpl.txt
 * @link     Mapper
 **/
abstract class Mapper
{
    protected $dataGateway = null;
    protected $DomainObjectClassName = '';

    /**
     * creates a new Mapper instance
     * overwritting $dataGateway and $DomainObjectClassName if present
     * in constructor
     * !!NOTE good practice with this abstract class is extend it
     * setting $dataGateway on init method and DomainObjectClassName
     * on property implmentation
     *
     * @param (DataGatewayInterface) $gateway   implementation of dataGatewayInterface for
     *                                          storage abstraction
     * @param (String)               $className domainObjectClassName this mapper is attached
     *                                          to
     *
     * @throw ZendApp\Data\Exception\Mapper
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public final function __construct(
        DataGatewayInterface $gateway=null,
        $className=null
    ) {
        if (!empty($gateway)) {
            $this->setDataGateway($gateway);
        }
        if (!empty($className)) {
            $this->setDomainObjectClassName($className);
        }
        if (empty($this->dataGateway)) {
            throw new MapperException("DataGateway is required");
        }
        if (empty($this->DomainObjectClassName)) {
            throw new MapperException("DomainObjectClassName is required");
        }
        $this->init();
    }

    /**
     * setter selfexplained
     *
     * @param (String) $className domainObjectclassName
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    protected function setDomainObjectClassName($className)
    {
        $this->DomainObjectClassName = $className;
    }

    /**
     * setter selfexplained
     *
     * @param (DataGatewayInterface) $gateway dataGateway implementation
     *                                        interface
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    protected function setDataGateway(DataGatewayInterface $gateway)
    {
        $this->dataGateway = $gateway;
    }

    /**
     * method to provide custom initialization on child classes
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function init()
    {
    }

    /**
     * redirects save to insert or update methods
     *
     * @param (DomainObject) $domainObject to save on persistence layer
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function save(DomainObject $domainObject)
    {
        //TODO this checking should be done not relying on an
        //instance property if not a method like getModelId
        $methodName = (empty($domainObject->id))?'insert':'update';
        $this->{$methodName}($domainObject);
    }

    /**
     * abstract method to implment
     *
     * @param (DomainObject) $domainObject to operate with
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    abstract function insert(DomainObject $domainObject);

    /**
     * abstract method to implment
     *
     * @param (DomainObject) $domainObject to operate with
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    abstract function update(DomainObject $domainObject);

    /**
     * abstract method to implment
     *
     * @return mixed DomainObject|DomainObjectCollection
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    abstract function find();

    /**
     * abstract method to implment
     *
     * @param (DomainObject) $domainObject to operate with
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    abstract function delete(DomainObject $domainObject);

    /**
     * creates a DomainObject through a dictionary
     *
     * @param (array) $data dictionary to create DomainObject instance
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function createObject(array $data)
    {
        $className = $this->DomainObjectClassName;
        return new $className($data);
    }
}
