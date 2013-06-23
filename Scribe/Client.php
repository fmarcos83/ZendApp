<?php
namespace ZendApp\Scribe;

use Thrift\Transport;
use Thrift\Protocol;

class Client
{
    protected $_category = 'PHP';
    protected $_client = null;
    protected $_protocol = null;

    public function __construct(Protocol\TProtocol $protocol, $transport, $path = null)
    {
        if (!class_exists('\scribeClient')) {
            //TODO: use Zend_Load to describe dependencies and set namespace
            //to allow loading Thrif Scribe compiled classes from config
            $path = ($path)?$path:(realpath(dirname(__DIR__)));
            require $path.'/Thrift/Facebook/FacebookService.php';
            require $path.'/Thrift/Scribe/scribe.php';
            require $path.'/Thrift/Facebook/Types.php';
            require $path.'/Thrift/Scribe/Types.php';
        }
        $this->setProtocol($protocol);
        $this->setTransport($transport);
    }

    public function setTransport($transport)
    {
        $this->_transport = $transport;
    }

    public function setProtocol(Protocol\TProtocol $protocol)
    {
        $this->_protocol = $protocol;
        $this->_client = new \scribeClient($this->_protocol);
    }

    public function write($message)
    {
        $scribeMessage = array(
            'category'=> $this->_category,
            'message' => $message,
        );
        $this->preWrite();
        $this->_client->Log(array(new \LogEntry($scribeMessage)));
        $this->postWrite();
    }

    protected function preWrite()
    {
        ($this->_transport->isOpen())||$this->_transport->open();
    }

    protected function postWrite()
    {
        (!$this->_transport->isOpen())||$this->_transport->close();
    }

    public function close()
    {
        $this->_transport->close();
        $this->_open = false;
    }

}
