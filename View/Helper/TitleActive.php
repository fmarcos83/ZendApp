<?php
/**
 * View_Helper to get title from active navigation container
 *
 * PHP version 5.3
 *
 * @category View_Helper
 * @package  ZendApp
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $ Revision: $
 * @date     $ Date: $
 * @link     http://framework.zend.com/manual/1.12/en/zend.view.helpers.html
 **/

/**
 * ZendApp_View_Helper_TitleActive class
 *
 * @category View_Helper
 * @package  ZendApp
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  GNU http://www.gnu.org/licenses/gpl.html
 * @link     http://framework.zend.com/manual/1.12/en/zend.view.helpers.html
 **/
class ZendApp_View_Helper_TitleActive
extends Zend_View_Helper_Abstract
{
    /**
     * retrieves the label of the current active navigation container element
     *
     * @return (String) label container
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function titleActive()
    {
        $label = "";
        $activePage = $this->view->navigation()->findOneBy('active', true);
        $label = ($activePage)?$activePage->get('label'):"";
        return $label;
    }
}
