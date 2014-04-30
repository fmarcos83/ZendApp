<?php

namespace ZendApp\Application\Resource;

use ZendApp\Application\Interfaces\Runnable;
use ZendApp\Application\Resource\Exception\RestAuth\UnathorizedException;
use Zend_Application_Resource_ResourceAbstract as ResourceAbstract;
use Zend_Auth_Adapter_Http as HttpAdapter;
use Zend_Controller_Front;
use Zend_Auth;

class RestAuth extends ResourceAbstract
implements Runnable
{
    protected $auth;
    protected $storage;
    protected $adapter;

    protected function getStorage()
    {
        if ($this->storage)
            return $this->storage;
        $options = $this->getOptions();
        $storage = $options['storage'];
        $storageOptions = isset($storage['options'])?$storageOptions:array();
        $storageClass = $storage['class'];
        return $this->storage = new $storageClass($storageOptions);
    }

    protected function getAdapter()
    {
        if ($this->adapter)
            return $this->adapter;
        $frontController = Zend_Controller_Front::getInstance();
        $request = $frontController->getRequest();
        $response = $frontController->getResponse();
        $options = $this->getOptions();
        $adapterOptions = $options['httpadapter'];
        //instantiates and sets the Request response objects
        $this->adapter = new HttpAdapter($adapterOptions);
        $this->adapter->setRequest($request);
        $this->adapter->setResponse($response);
        return $this->adapter;
    }

    protected function getResolver()
    {
        $options = $this->getOptions();
        $options = $options['httpadapter']['resolver'];
        $resolverClassName = $options['class'];
        $resolverOptions = isset($options['options'])?$options['options']:array();
        $resolverInstance = new $resolverClassName($resolverOptions);
        $this->getAdapter()->setBasicResolver($resolverInstance);
    }

    //bootstrap initialization
    public function init()
    {
        $this->auth = Zend_Auth::getInstance();
        $this->auth->setStorage($this->getStorage());
    }

    //lazy load initialization
    public function run()
    {
        $this->getResolver();
        $result = $this->auth->authenticate($this->getAdapter());
        if (!$result->isValid())
            throw new UnathorizedException('invalid creadentials');
    }
}
