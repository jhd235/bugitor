<?php
// main navigation
$controller = Yii::$app->controller ? Yii::$app->controller->id : null;
echo Nav::widget([
    'id' => 'main-nav',
    'encodeLabels' => false,
    'options' => ['class' => 'nav navbar-nav navbar-main-menu'],
    'activateItems' => true,
    'activateParents' => true,
    'dropDownCaret' => '<span class="caret"></span>',
    'items' => [
        ['label' => 'Docs', 'url' => ['/docs/page'], 'options' => ['title' => 'Bugitor Documentation']],
        Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/user/login']]
         ) : (
            '<li>' . Html::a('Logout', ['/user/logout'], ['data-method' => 'post']).'</li>'
         )
    ],// items
]);