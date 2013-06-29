<?php
declare(encoding='utf-8');

namespace ZendApp\Console\Strategy;

use Zend_Console_Getopt_Exception;
use Zend_Console_Getopt;
use Zend_Controller_Request_Http;

class Simple extends AbstractStrategy
{

    protected $_keys = array(
        0=>'module',
        1=>'controller',
        2=>'action'
    );

    protected $_arguments = array(
        'action|a=s' => 'application action, with required string param',
        'controller|c=s' => 'application option, with required string param',
        'module|m=s' => 'application module, with required string param',
        'params|p=s' => 'application action, with required string param',
    );

    /**
     * Simple strategy parsing to adapt ZF mvc request
     * to console
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    protected function _parse()
    {
        if (!count($this->getOptions())) {
            throw new Zend_Console_Getopt_Exception(
                "Empty options",
                $this->getUsageMessage()
            );
        }
        $query = '';
        $matches = array('params'=>'','values'=>'');
        foreach ($this->_keys as $key) {
            $query .= '/'.$this->getOption($key);
        }
        $params = $this->getOption('params');
        preg_match_all('/((?P<params>\w+)=(?P<values>\w+)),+/', $params, $matches);
        $queryParams = (count($matches['params']))?http_build_query(array_combine($matches['params'],$matches['values'])):array();
        $query = (count($queryParams))?$query.'?'.$queryParams:$query;
        $this->getRequest()->setRequestUri($query);
    }
}
