<?php

/**
 * BugitorMenu class file.
 *
 * @author Jonah Turnquist <poppitypop@gmail.com>
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2010 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
/**
 * BugitorMenu displays a multi-level menu using nested HTML lists.
 *
 * The main property of BugitorMenu is {@link items}, which specifies the possible items in the menu.
 * A menu item has three main properties: visible, active and items. The "visible" property
 * specifies whether the menu item is currently visible. The "active" property specifies whether
 * the menu item is currently selected. And the "items" property specifies the child menu items.
 *
 * The following example shows how to use BugitorMenu:
 * <pre>
 * $this->widget('zii.widgets.BugitorMenu', array(
 *     'items'=>array(
 *         array('label'=>'Home', 'url'=>array('site/index')),
 *         array('label'=>'Products', 'url'=>array('product/index'), 'items'=>array(
 *             array('label'=>'New Arrivals', 'url'=>array('product/new', 'tag'=>'new')),
 *             array('label'=>'Most Popular', 'url'=>array('product/index', 'tag'=>'popular')),
 *         )),
 *         array('label'=>'Login', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
 *     ),
 * ));
 * </pre>
 *
 * @author Jonah Turnquist <poppitypop@gmail.com>
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id: BugitorMenu.php 2326 2010-08-20 17:02:07Z qiang.xue $
 * @package zii.widgets
 * @since 1.1
 */
Yii::import('zii.widgets.CMenu');

class BugitorMenu extends CMenu {

    /**
     * Checks whether a menu item is active.
     * This is done by checking if the currently requested URL is generated by the 'url' option
     * of the menu item. Note that the GET parameters not specified in the 'url' option will be ignored.
     * @param array the menu item to be checked
     * @param string the route of the current request
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item, $route) {
        if (isset($item['id'])) {
            if($route === $item['id'])
                return true;
            if(($route === 'project/addUser')&&($item['id'] === 'project/settings'))
                return true;
            if(($route === 'issue/view')&&($item['id'] === 'issue/index'))
                return true;
            if(($route === 'issue/update')&&($item['id'] === 'issue/index'))
                return true;
            if(isset(Yii::app()->controller->module)){
                if((Yii::app()->controller->module->id === 'rights')&&($item['id'] === 'rights'))
                    return true;
                }
            if((Yii::app()->controller->id === 'version')&&($item['id'] === 'project/settings')) {
                return true;
            }
            if((Yii::app()->controller->id === 'issuecategory')&&($item['id'] === 'project/settings')) {
                return true;
            }
            return false;
        }
        return false;
    }

}