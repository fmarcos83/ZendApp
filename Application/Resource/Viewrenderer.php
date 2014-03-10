<?php
/**
 * Class to inject global configuration to ViewRenderer
 *
 * The main aim of this class is for bein used on cli environments
 * and configure it in an easy way, same results could be achieved
 * using ContextSwitch functionality
 *
 * TODO: probably this class should be deprecated in the near future
 *
 * PHP version 5.3
 *
 * @category ZendApp
 * @package  Application\Resource\Viewrenderer
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org
 * @version  SVN: $ Revision: $
 * @date     $ Date: $
 * @link     ZendApp\Application\Resource\Viewrenderer
 **/

namespace ZendApp\Application\Resource;

use Zend_Application_Resource_ResourceAbstract;

use Zend_Controller_Action_HelperBroker;

/**
 * ZendApp\Application\Resource\Viewrenderer class
 *
 * @category ZendApp
 * @package  Application\Resource
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org
 * @link     ZendApp\Application\Resource\Viewrenderer
 **/
class Viewrenderer extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        //injects it's configuration on postDispatch
        //CustomViewRenderer method
        Zend_Controller_Action_HelperBroker
            ::getStaticHelper('CustomViewRenderer');
    }
}
