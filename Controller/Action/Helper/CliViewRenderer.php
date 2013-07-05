<?php
//TODO fix documentation

namespace ZendApp\Controller\Action\Helper;

use Zend_Controller_Action_Helper_Abstract;
use Zend_Controller_Action_HelperBroker;

class CliViewRenderer extends Zend_Controller_Action_Helper_Abstract
{
    public function preDispatch()
    {
        //TODO inject configuration through frontcontroller params
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->setViewSuffix('cli');
    }
}
