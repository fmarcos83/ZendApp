<?php
/**
 * class to implement abstract datamappers
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
 * Mapper class
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
    protected $POPOClassName = '';

    public function __construct(DataGatewayInterface $gateway=null)
    {
        if (!empty($gateway)) {
            $this->dataGateway = $gateway;
        }
        $this->init();
    }

    public function setDataGateway(DataGatewayInterface $gateway)
    {
        $this->dataGateway = $gateway;
    }

    public function save(DomainObject $popo){
        if (empty($popo->id)) {
            $this->insert($popo);
        }else{
            $this->update($popo);
        }
    }

    public   function init(){}

    abstract function insert(DomainObject $popo);

    abstract function update(DomainObject $popo);

    abstract function find();

    abstract function delete(DomainObject $popo);

    public function createObject(array $data)
    {
        $className = $this->POPOClassName;
        return new $className($data);
    }



}
