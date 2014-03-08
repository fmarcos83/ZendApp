<?php
/**
 * @author Francisco Marcos <fmarcos83@gmail.com>
 * @version 1.0
 * @copyright Francisco Marcos <fmarcos83@gmail.com>, 08 marzo, 2014
 * @package ZendApp\Controller\Plugin
 */
namespace ZendApp\Controller\Plugin;

use Zend_Controller_Plugin_Abstract as PluginAbstract;
use Zend_Controller_Request_Http;
use Zend_Controller_Front;
use Zend_Auth;

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
    public function routeStartup(Zend_Controller_Request_Http $request)
    {
        $restAuthResource = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('restauth');
        if (null === $restAuthResource) {
            throw new Exception('a restauth application resource is required in order to make this plugin work');
        }
        $restAuthResouce->authenticate();
    }
}
