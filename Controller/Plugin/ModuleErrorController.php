<?php
/**
 * ZendApp\Controller\Plugin\ModuleErrorController
 *
 * PHP version 5.3
 *
 * @category ZendApp
 * @package  Application\Controller\Plugin
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org/licenses/gpl-3.0-standalone.html
 * @version  SVN: $ Revision: $
 * @date     $ Date: $
 * @link     ModuleErrorController
 **/

namespace ZendApp\Controller\Plugin;

use Zend_Controller_Request_Abstract;

use Zend_Controller_Plugin_Abstract;

/**
 * ModuleErrorController class
 *
 * this plugin allows having custom errorHandlers per module
 * the errorController must follow the same rules imposed on ZF
 * /moduleName/controllers/errorController.php
 *
 * !!! It's very important to notice that it must be injected
 * !!! on the indexStack before ZF errorHandler wich it's injected
 * !!! with a 100 index
 *
 * @category ZendApp
 * @package  Application\Controller\Plugin
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org/licenses/gpl-3.0-standalone.html
 * @link     ModuleErrorController
 **/
class ModuleErrorController extends Zend_Controller_Plugin_Abstract
{

    /**
     * postDispatch ZF plugin hook method
     *
     * @param (Zend_Controller_Request_Abstract) $request request to get
     *                                                    the moduleName
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function postDispatch(Zend_Controller_Request_Abstract $request)
    {
        $fc = \Zend_Controller_Front::getInstance();
        $errorHandler = $fc->getPlugin('Zend_Controller_Plugin_ErrorHandler');
        //TODO: this can be outside to factory how errors can be
        //handled outside
        $cloneRequest = clone $request;
        $cloneRequest->setActionName('error');
        $cloneRequest->setControllerName('error');
        $dispatcher = $fc->getDispatcher();
        if(!$dispatcher->isDispatchable($cloneRequest))
            return;
        $errorHandler->setErrorHandlerModule($request->getModuleName());
    }
}
