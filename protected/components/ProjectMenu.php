<?php
/*/////////////////////////////////////////////////////////////////////////
// This file is part of
//      _
//     | | __ _  ___ _ __ ___   ___   ___  ___
//  _  | |/ _` |/ __| '_ ` _ \ / _ \ / _ \/ __|
// | |_| | (_| | (__| | | | | | (_) |  __/\__ \
//  \___/ \__,_|\___|_| |_| |_|\___/ \___||___/
//                                             personal blogging software
// Copyright (c) 2010 by Jacob 'jacmoe' Moen
// License: GNU General Public License (GPL) - see root_dir/license.txt for details
// Credits: see root_dir/credits.txt
// Homepage: http://www.jacmoe.dk/page/jacmoes
// Repository: http://bitbucket.org/jacmoe/jacmoes
/////////////////////////////////////////////////////////////////////////*/
?>
<?php
  
class ProjectMenu extends BugitorMenu
{
    public function init()
    {
        $this->items = $this->getMenu();
        parent::init();
    }
    
    private function getMenu()
    {
        $criteria = new CDbCriteria(array(
                    'order' => 'menu_order ASC',
                ));
        $menu = array();
        $items = ProjectLink::model()->findAll($criteria);
        foreach ($items as $item)
        {
            $menu[] = array('label'=>$item->title,'url'=>array($item->link));
        }
        return $menu;
    }
}
  
?>
