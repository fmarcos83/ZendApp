<?php
/**
 * @author Francisco Marcos <fmarcos83@gmail.com>
 * @version 1.0
 * @copyright Francisco Marcos <fmarcos83@gmail.com>, 08 marzo, 2014
 * @package ZendApp\Controller\Plugin
 */
namespace ZendApp\Controller\Plugin;

use ZendApp\Application\Resource\Exception\RestAuth\Exception;
use ZendApp\Application\Interfaces\Runnable;
use Zend_Controller_Plugin_Abstract as PluginAbstract;
use Zend_Controller_Request_Http;
use Zend_Controller_Front;

/**
 * RestAuth
 *
 * this class is intended to provide a facade
 * for Zend_Auth_Http_Adapter
 *
 * NOTE: this class can only be used in an http context request
 * that's why we are requesting a Zend_Controller_Request_Http
 *
 * @package ZendApp\Controller\Plugin
 * @author  Francisco Marcos <fmarcos83@gmail.com>
 */
class RestAuth extends PluginAbstract
{
    public $result;
    public function routeStartup(Zend_Controller_Request_Http $request)
    {
        $restAuthResource = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getPluginResource('restauth');
        if (null === $restAuthResource) {
            throw new Exception('a restauth application resource is required in order to make this plugin work');
        }
        if (!$restAuthResource instanceof Runnable)
            throw new Exception('restauth instance must implement a runnable interface');
        $restAuthResource->run();
    }
}
