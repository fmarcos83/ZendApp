<?php
/**
 * This class is intended to apply configuration to viewRenderer
 * globally, usually the way to inject this behaviour is through
 * ContextSwitch utility, if you want to learn more, please refeer
 * to the manual
 *
 * http://framework.zend.com/manual/1.12/en/zend.conotroller.actionhelpers.html
 *
 * PHP version 5.3
 *
 * @category ZendApp
 * @package  Controller\Action\Helper
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org/
 * @version  SVN: $ Revision: $
 * @date     $ Date: $
 * @link     ZendApp\Controller\Action\Helper\ViewRenderer
 * @see      Zend_Controller_Action_Helper_ContextSwitch
 **/

namespace ZendApp\Controller\Action\Helper;

use Zend_Controller_Action_Helper_Abstract;
use Zend_Controller_Action_HelperBroker;

/**
 * ZendApp\Controller\Action\Helper\ViewRenderer class
 *
 * @category ZendApp
 * @package  Controller\Action\Helper
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org
 * @link     default
 **/
class CustomViewRenderer extends Zend_Controller_Action_Helper_Abstract
{
    /**
     * gets the configuration from viewrenderer plugin resource
     * and injects the configuration from the resource to
     * Zend_Controller_Action_Helper_ViewRenderer and injects the
     * configuration through initView method
     *
     * @see Zend_Controller_Action_Helper_ViewRenderer
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function preDispatch()
    {
        $fc = $this->getFrontController();
        $bootstrap = $fc->getParam('bootstrap');
        $res = $bootstrap->getPluginResource('viewrenderer');
        $viewRenderer = Zend_Controller_Action_HelperBroker::
            getStaticHelper('viewRenderer');
        $viewRenderer->initView(null, null, $res->getOptions());
    }
}
