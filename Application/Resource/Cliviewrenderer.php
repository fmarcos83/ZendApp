<?php
//TODO fix documentation
/**
 *
 *
 * PHP version
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

namespace ZendApp\Application\Resource;

use Zend_Application_Resource_ResourceAbstract;

use Zend_Controller_Action_HelperBroker;

use ZendApp\Controller\Action\Helper\CliViewRenderer as HelperCliViewRenderer;

/**
 * undocumented class
 *
 * @category default
 * @package  default
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  default
 * @link     default
 **/
class Cliviewrenderer extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        //TODO makes more sense having a single resource to load Action_Helpers
        Zend_Controller_Action_HelperBroker::getStaticHelper('CliViewRenderer');
    }
}
