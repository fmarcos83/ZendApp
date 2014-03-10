<?php
/**
 * Abstract class to implement child strategies classes
 *
 * PHP version 5.3
 *
 * @category App
 * @package  Console\Strategy
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org/licenses/gpl-3.0-standalone.html
 * @version  SVN: $ Revision: $
 * @date     $ Date: $
 * @link     default
 **/

declare(encoding='utf-8');

namespace ZendApp\Console\Strategy;

use Zend_Console_Getopt;
use Zend_Console_Getopt_Exception;
use Zend_Controller_Request_Http;

/**
 * AbstractStrategy class
 *
 * @category App
 * @package  Console\Strategy
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org/licenses/gpl-3.0-standalone.html
 * @link     default
 **/
abstract class AbstractStrategy
{

    protected $_request = null;

    protected $_arguments = array();

    protected $_consoleOpt = null;

    /**
     * abstract method to implement parsing strategy on child
     * classes.
     *
     * basically this method must do 3 simple things
     * 1. retrieve options and give them contextual behaviour
     * 2. inject those params to the request
     * 3. throw Zend_Console_Getopt_Exception for errors
     *
     * @return  null
     * @throw   Zend_Console_Getopt_Exception
     * @author  Francisco Marcos <fmarcos83@gmail.com>
     * @see     App\Console\Strategy\Simple
     * @example App\Console\Strategy\Simple
     **/
    protected abstract function _parse();

    /**
     * initialization method to configure and prepare child
     * classes
     *
     * empty method to be overriden
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    protected function _init()
    {}

    /**
     * constructor
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function __construct()
    {
        $this->_consoleOpt = new Zend_Console_Getopt(
            $this->_arguments
        );
        $this->_init();
    }

    /**
     * proxy method to call Zend_Console_Getopt composite
     * property methods
     *
     * @param (String)      $method    the name of the method
     * @param (mixed|array) $arguments the arguments
     *
     * @author Francisco Marcos <fmarcos83@gmail.com>
     * @see    http://php.net/manual/en/language.oop5.magic.php
     * @see    Zend_Console_Getopt
     *
     * @return mixed what Zend_Console_Getopt returns
     **/
    public function __call($method, $arguments)
    {
        return call_user_func_array(array($this->_consoleOpt, $method), $arguments);
    }

    /**
     * parses consoleOpt options and calls _parse method
     * in children classes
     *
     * !!! exits from the application if any
     * Zend_Console_GetOpt_Exception happens
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public final function parse()
    {
        try {
            $this->_consoleOpt->parse();
            $this->_parse();
        } catch (Zend_Console_Getopt_Exception $e) {
            echo $e->getUsageMessage();
            exit($e->getCode());
        }
    }

    /**
     * accesor method
     *
     * @return Zend_Console_Getopt
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public final function getConsoleOpt()
    {
        return $this->_consoleOpt;
    }

    /**
     * accessor method
     *
     * @return Zend_Controller_Request_Http
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public final function getRequest()
    {
        return $this->_request;
    }

    /**
     * accessor method
     *
     * @param (Zend_Controller_Request_Http) $request ZF mvc http request method
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public final function setRequest(Zend_Controller_Request_Http $request)
    {
        $this->_request = $request;
    }
}
