<?php

use ZendApp\Scribe\Client;

class ZendApp_Log_Writer_Scribe extends Zend_Log_Writer_Abstract
{
    protected $_client = null;

    public function __construct($socket, $transportName, $protocolName)
    {
        $transport = new $transportName($socket);
        $protocol = new $protocolName($transport);
        $this->_client = new Client($protocol, $transport);
    }

    public function shutdown()
    {
        $this->_client->close();
    }

    public function _write($event)
    {
        $line = $this->_formatter->format($event);
        $this->_client->write($line);
    }
    public static function factory($config)
    {
        $config = self::_parseConfig($config);
        $socketClassName = $config['socketName'] ;
        $socketHosts = $config['socketParams']['host'];
        $socketPorts = $config['socketParams']['port'];
        $persistent = $config['socketParams']['persistent'];
        $transportClassName = $config['transportName'];
        $protocolClassName = $config['protocolName'];
        return new self(
            new $socketClassName($socketHosts, $socketPorts, $persistent),
            $transportClassName,
            $protocolClassName
        );
    }
}
