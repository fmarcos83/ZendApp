<?php
/**
 * ZendApp
 *
 * PHP version 5.3
 *
 * @category ZendApp
 * @package  App
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  default
 * @version  default
 * @date     default
 * @link     default
 **/

declare(encoding='UTF-8');

namespace ZendApp\Application\Resource;

use ZendApp\Error\Manager as errManager;

/**
 * Class to register a class into ZendFramework application
 * to handle PHP errors
 *
 * @category default
 * @package  default
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  default
 * @link     default
 **/
class Errorhandle
extends \Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        $options = $this->getOptions();
        $errorHandlerClassName = $options['class'];
        errManager::register(new $errorHandlerClassName);
    }
}
