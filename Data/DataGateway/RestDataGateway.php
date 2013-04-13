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
use Zend\Http\Client;
use Zend\Json\Json;

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
class RestDataGateway implements DataGatewayInterface
{
    private $_httpClient;

    /**
     * instantiates an httpClient zf2 component
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

        if (!isset($options['uri'])) {
            throw new \RuntimeException('Uri is a required option parameter');
        }

        $clientOptions = (!isset($options['options']))?null:$options['options'];
        $this->_httpClient = new Client($options['uri'], $clientOptions);
        $this->_httpClient->setHeaders(array('Accept'=>'application/json'));
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

    public function find()
    {
        $response = $this->_httpClient->send();
        if (!$response->isOk()) {
            $message[] = $response->getStatusCode();
            $message[] = $response->getReasonPhrase();
            throw new \RuntimeException(implode(",",$message));
        }
        return Json::decode($response->getBody(), Json::TYPE_ARRAY);
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
