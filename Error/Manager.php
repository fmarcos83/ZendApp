<?php
/**
 * ZendApp
 *
 * PHP version 5.3
 *
 * @category   Error
 * @package    Handler
 * @author     Francisco Marcos <fmarcos83@gmail.com>
 * @license    default
 * @version    SVN: $ Revision: $
 * @date       $ Date: $
 * @link       default
 **/

declare(encoding='UTF-8');

namespace ZendApp\Error;
use ZendApp\Error\Handler\ErrorInterface;

/**
 * Manager class
 *
 * this class is intended to hold a an implementation
 * of ErrorInterface that must take care of handling
 * PHP errors
 *
 * is just an OO wrapper interface for restore_error_handler
 * and set_error_handler
 *
 * @category default
 * @package  default
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  default
 * @link     default
 **/
class Manager
{

    /**
     * registers an ErrorInterface implementation that
     * should take care of handling PHP errors
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    static function register(ErrorInterface $handler=null)
    {
        if (!is_null($handler)) {
            set_error_handler(array(&$handler,'handle'));
        }
    }

    /**
     * restores last error handler
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    static function unregister()
    {
        restore_error_handler();
    }

    /**
     * sets PHP built-in error handler
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    static function unregisterAll()
    {
        set_error_handler(
            function(){
                return false;
            }
        );
    }
}
