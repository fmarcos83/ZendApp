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
use ZendApp\Model\FormModelAbstract as FormModelAbstract;

/**
 * Mapper class class to implement
 *
 * @category Data
 * @package  ZendApp
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.licenses/lgpl.txt
 * @link     Mapper
 **/
abstract class AbstractMapper
{
    protected $model = null;
    protected $dataGateway = null;

    /**
     * creates a new Mapper instance
     * overwritting $dataGateway and $domainObjectClassName if present
     * in constructor
     * !!NOTE good practice with this abstract class is extend it
     * setting $dataGateway on init method and domainObjectClassName
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
        $this->init();
        if (!empty($gateway)) {
            $this->setDataGateway($gateway);
        }
        if (!empty($className)) {
            $this->setdomainObjectClassName($className);
        }
        if (empty($this->dataGateway)) {
            throw new MapperException("DataGateway is required");
        }
    }

    public function setModel(FormModelAbstract $model)
    {
        $this->model = $model;
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
    public function setDataGateway(DataGatewayInterface $gateway)
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
     * abstract method to implement
     *
     * @return DomainObjectCollection
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    abstract function find(array $where = null);

    /**
     * abstract method to implment
     *
     * @param (DomainObject) $domainObject to operate with
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    abstract function delete(array $where = null);

    /**
     * creates a DomainObject through a dictionary
     *
     * @param (array) $data dictionary to create DomainObject instance
     *
     * @return DomainObject
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    abstract function createObject(array $data);

    protected function getDao()
    {
        return $this->model->getDao();
    }

    protected function getCollection()
    {
        return $this->model->getCollection();
    }
}
