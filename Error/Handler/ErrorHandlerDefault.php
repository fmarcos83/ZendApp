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

namespace ZendApp\Error\Handler;

/**
 * ErrorHandlerDefault class
 *
 * default error handler treats any kind
 * of PHP error,warning etc as an Exception
 *
 * @category Error
 * @package  Handler
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  default
 * @link     default
 * @see      http://php.net/manual/en/function.set-error-handler.php
 **/
class ErrorHandlerDefault implements
ErrorInterface
{

    /**
     * handle method to manage exceptions
     *
     * @param (int)    $errno      the level of the error raised
     * @param (string) $errstr     the error message
     * @param (string) $errfile    the file the error took place in
     * @param (int)    $errline    the line in file the error took
     *                             place in
     * @param (array)  $errcontext the context of the error
     *                             (all the variables in symbol table)
     *
     * @throw  Exception
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    function handle($errno,$errstr,$errfile,$errline,$errcontext)
    {
        throw new Exception($errstr, $errno);
    }
}
