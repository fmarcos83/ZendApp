<?php
/**
 * RestDataGateway for rest interfaces
 *
 * PHP version 5.3
 *
 * @category ZendApp
 * @package  RestDataGateway
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org
 * @link     ZendApp\Data\DataGateway\RestDataGateway
 **/

declare(encoding='UTF-8');

namespace ZendApp\Data\DataGateway;

use ZendApp\Data\DataGateway\DataGatewayInterface;
use Zend\Config\Factory;

/**
 * RestDataGateway class
 *
 * @category ZendApp
 * @package  RestDataGateway
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org
 * @link     ZendApp\Data\DataGateway\RestDataGateway
 * @see      http://framework.zend.com/manual/2.1/en/modules/zend.http.client.html
 **/
class ConfigFileDataGateway implements DataGatewayInterface
{
    private $_config;
    private $_sectionName;

    /**
     * instantiates a config zf2 component
     *
     * @param (array) $options dictionary to populate the rest client
     *
     *                         (String) uri(mandatory)    => endpoint url
     *                         (Array)  options(optional) => http\client array
     *                         options
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function __construct(array $options=array())
    {
        if (empty($options)) {
            throw new \RuntimeException('Options cannot be empty');
        }

        if (!isset($options['path'])) {
            throw new \RuntimeException('path for configuration file is mandatory');
        }

        if (!isset($options['section'])) {
            throw new \RuntimeException('section name for these objects storage is mandatory');
        }

        $this->_config = Factory::fromFile($options['path'], true);
        $this->_sectionName = $options['section'];
    }

    /**
     * inserts data
     *
     * @param (array) $data dictionary with data to insert
     *
     * @throw  ZendApp\Data\Exception\NotImplemented
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function insert(array $data)
    {
        throw new NotImplementedException('Not implemented yet');
    }

    /**
     * updates data
     *
     * @param (array) $data  dictionary representing data to update
     * @param (array) $where dictionary representing a where clause
     *
     * @throw  ZendApp\Data\Exception\NotImplemented
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function update(array $data, array $where)
    {
        throw new NotImplementedException('Not implemented yet');
    }

    public function find(array $where=array())
    {
        array_unshift($where, $this->_sectionName);
        $auxConfig = clone $this->_config;
        while(current($where)&&!is_null($this->_config))
        {
            $auxConfig = $auxConfig->offsetGet(current($where));
            next($where);
        }
        return ($auxConfig)?$auxConfig->toArray():array();
    }

    /**
     * deletes data
     *
     * @param (array) $where dictionary representing a where clause
     *
     * @throw  ZendApp\Data\Exception\NotImplemented
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function delete(array $where)
    {
        throw new NotImplementedException('Not implemented yet');
    }
}
