<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/branch_renderer.js"></script>
    </head>
    <body>
<?php
/*
 * This file is part of
 *     ____              _ __
 *    / __ )__  ______ _(_) /_____  _____
 *   / __  / / / / __ `/ / __/ __ \/ ___/
 *  / /_/ / /_/ / /_/ / / /_/ /_/ / /
 * /_____/\__,_/\__, /_/\__/\____/_/
 *             /____/
 * A Yii powered issue tracker
 * http://bitbucket.org/jacmoe/bugitor/
 *
 * Copyright (C) 2009 - 2011 Bugitor Team
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation files
 * (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge,
 * publish, distribute, sublicense, and/or sell copies of the Software,
 * and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT
 * OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
 * OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
?>
        <div class="container" id="page">
            <div id="topmenu" class="span-24">
                <div id="topmenu" class="span-15">
                    <?php
                    $this->widget('BugitorMenu', array(
                        'items' => array(
                            //array('label' => 'Home', 'url' => array('/site/index'), 'id' => 'site/index', 'visible' => Yii::app()->user->checkAccess('Issue.Create')),
                            array('label' => 'Home', 'url' => array('/projects/'), 'id' => 'project/index'),
                            array('label' => 'Administration', 'url' => array('/admin'), 'visible' => Yii::app()->user->checkAccess(Rights::module()->superuserName)),
                        ),
                    )); ?>
                </div>
                <div id="topmenu" class="span-8 last">
                    <span class="right">
                    <?php
                        $this->widget('BugitorMenu', array(
                            'items' => array(
                                array('url' => Yii::app()->getModule('user')->loginUrl, 'label' => Yii::app()->getModule('user')->t("Login"), 'visible' => Yii::app()->user->isGuest, 'id' => 'user/login/login'),
                                array('url' => Yii::app()->getModule('user')->registrationUrl, 'label' => Yii::app()->getModule('user')->t("Register"), 'visible' => Yii::app()->user->isGuest, 'id' => 'user/registration/registration'),
                                array('url' => Yii::app()->getModule('user')->profileUrl, 'label' => Yii::app()->getModule('user')->t("Profile"), 'visible' => !Yii::app()->user->isGuest, 'id' => 'user/profile/profile'),
                                array('url' => Yii::app()->getModule('user')->logoutUrl, 'label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')', 'visible' => !Yii::app()->user->isGuest, 'id' => 'user/logout/logout'),
                            ),
                        )); ?>
                    </span>
                </div>
            </div>
            <div id="mainmenu" class="span-24">
                <div id="header" class="span-24">
                    <div id="logo" class="span-2">
                        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/bugitor_64.png','Bugitor - The Yii-powered issue tracker', array('title' => 'Bugitor - The Yii-powered issue tracker')) ?>
                    </div>
                    <div id="header" class="span-14 alt">
                        <div>
                        <?php if (
                                ((Yii::app()->controller->id === 'project')
                                || (Yii::app()->controller->id === 'issue')
                                || (Yii::app()->controller->id === 'member')
                                || (Yii::app()->controller->id === 'changeset')
                                || (Yii::app()->controller->id === 'version')
                                || (Yii::app()->controller->id === 'issueCategory')
                                || (Yii::app()->controller->id === 'repository')
                                        ) && (isset($_GET['projectname']))) : ?>
                            <h1 class="alt"><?php echo CHtml::encode($_GET['projectname']); ?></h1>
                        <?php else : ?>
                            <h1 class="alt"><?php echo CHtml::encode(Yii::app()->name); ?></h1>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div id="gravatar" class="span-8 last">
                        <div class="right">
                            <?php if (!Yii::app()->user->isGuest): ?>
                            <?php
                                $this->widget('application.extensions.VGGravatarWidget',
                                        array('email' => Yii::app()->getModule('user')->user()->email));
                            ?>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div id="mainmenu" class="span-20 last">
                        <?php
                        $this->widget('BugitorMenu', array(
                            'items' => array(
                                array('label' => 'Admin Home', 'url' => array('/admin/default/index'), 'id' => 'admin/default/index', 'visible' => Yii::app()->user->checkAccess(Rights::module()->superuserName)),
                                array('label' => 'Projects', 'url' => array('/admin'), 'id' => '/admin/projecs', 'visible' => Yii::app()->user->checkAccess(Rights::module()->superuserName)),
                                array('label' => 'Users', 'url' => array('/user/admin'), 'id' => 'user', 'visible' => Yii::app()->user->checkAccess(Rights::module()->superuserName)),
                                array('label' => 'Roles and Rights', 'url' => array('/rights'), 'id' => 'rights', 'visible' => Yii::app()->user->checkAccess(Rights::module()->superuserName)),
                                array('label' => 'Global Settings', 'url' => array('/admin/settings/index'), 'id' => 'admin/settings/index', 'visible' => Yii::app()->user->checkAccess(Rights::module()->superuserName)),
                                array('label' => 'Information', 'url' => array('/admin'), 'id' => '/admin/information', 'visible' => Yii::app()->user->checkAccess(Rights::module()->superuserName)),
                            ),
                        ));
                        ?>
                    </div>
                                </div>
                                <div class="clear"></div>
                                <?php
                                Yii::app()->clientScript->registerScript(
                                   'myHideEffect',
                                   '$(".info").animate({opacity: 1.0}, 4000).fadeOut("slow");',
                                   CClientScript::POS_READY
                                );
                                ?>
                                <?php
                                    $user=Yii::app()->getUser();
                                    foreach($user->getFlashKeys() as $key):
                                        if($user->hasFlash($key)): ?>
                                        <br/>
                                        <div class="info flash-<?php echo $key; ?>">
                                            <?php echo $user->getFlash($key); ?>
                                        </div>
                                <?php
                                        endif;
                                    endforeach; ?>
                                <?php echo $content; ?>
                                        <div class="span-24 alt"><div align="center" class="quiet">
                                        <hr/>
                                                Powered by <a class="noicon" title="Bugitor - The Yii-powered issue tracker" href="http://bitbucket.org/jacmoe/bugitor">Bugitor</a> &copy; 2010 - 2011 by Bugitor Team.<br/>
                                                <a class="noicon" href="http://www.yiiframework.com/" rel="external"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/yii_power_lightblue_white.gif" alt="Made with Yii Framework" title="Made with Yii Framework"/></a>
                                                <hr/>
                                                <a href="http://sourceforge.net/projects/bugitor"><img src="http://sflogo.sourceforge.net/sflogo.php?group_id=542384&amp;type=10" width="80" height="15" alt="Get Bugitor at SourceForge.net. Fast, secure and Free Open Source software downloads" /></a>
                                        </div>
            </div>
        </div>
    </body>
</html>