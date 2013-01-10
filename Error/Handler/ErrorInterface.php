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
 * @see        http://php.net/manual/en/function.set-error-handler.php
 **/

declare(encoding='UTF-8');

namespace ZendApp\Error\Handler;

/**
 * Handler interface
 *
 * @category PHP
 * @package  Error
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @link     ErrorInterface
 **/
interface ErrorInterface
{
     /**
     * hanle blueprint method to implement php error
     * handling
     *
     * it's just the same callable set_error_handler
     * expects
     *
     * @param (int)    $errno      the level of the error raised
     * @param (string) $errstr     the error message
     * @param (string) $errfile    the file the error took place in
     * @param (int)    $errline    the line in file the error took
     *                             place in
     * @param (array)  $errcontext the context of the error
     *                             (all the variables in symbol table)
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    function handle($errno,$errstr,$errfile,$errline,$errcontext);
}
