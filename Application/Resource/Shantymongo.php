<?php
/**
 * ZendApp
 *
 * PHP version 5.3
 *
 * @category   ZendApp
 * @package    Application
 * @subpackage Resource
 * @author     Francisco Marcos <fmarcos83@gmail.com>
 * @license    default
 * @version    SVN: $ Revision: $
 * @date       $ Date: $
 * @link       default
 **/

declare(encoding='UTF-8');

namespace ZendApp\Application\Resource;

/**
 * Shantymongo class
 *
 * Zend Application Resource
 *
 * @category   ZendApp
 * @package    Application
 * @subpackage Resource
 * @author     Francisco Marcos <fmarcos83@gmail.com>
 * @license    default
 * @link       default
 **/
class Shantymongo
extends \Zend_Application_Resource_ResourceAbstract{
    public function init()
    {
        $options = $this->getOptions();
        Shanty_Mongo::addConnections($options);
    }
}
