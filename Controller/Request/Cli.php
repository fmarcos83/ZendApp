<?php
//TODO docs
namespace ZendApp\Controller\Request;
use Zend_Controller_Request_Http;

//TODO set type hinting and inheritance
class Cli extends Zend_Controller_Request_Http
{
    protected $_strategy;

    //TODO set type hinting
    public function setStrategy($strategy)
    {
        $this->_strategy = $strategy;
        $this->_strategy->setRequest($this);
    }

    public function parse()
    {
        $this->_strategy->parse();
    }
}
