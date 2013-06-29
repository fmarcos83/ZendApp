<?php
//TODO docs
/**
 *
 *
 * PHP version 5.3.10
 *
 * @category   default
 * @package    default
 * @subpackage
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license    default
 * @version    SVN: $ Revision: $
 * @date       $ Date: $
 * @link       default
 **/

namespace ZendApp\Console;

use ZendApp\Controller\Request\Cli;

use Zend_Controller_Front;

//TODO set type hinting and inheritance
class Console
{
    public static function factory(array $options)
    {
        $strategyClassName = (isset($options['strategy']))?$options['strategy']:'ZendApp\Console\Strategy\Simple';
        $fc = Zend_Controller_Front::getInstance();
        $request = new Cli;
        $strategy = new $strategyClassName;
        $request->setStrategy($strategy);
        $request->parse();
        $fc->setRequest($request);
    }
}

