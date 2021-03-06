<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$params = require(__DIR__ . '/params.php');
$snippets = require_once(__DIR__ . '/snippets.php');

$config = [
    'id' => 'bugitor-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'controllerMap' => [
        'migrate' => [
            'class' => 'dmstr\console\controllers\MigrateController',
            'templateFile' => '@app/views/migration/migration.php',
        ],
        'rbac' => [
            'class' => 'app\commands\BugitorRbacCommand',
            'batchSize' => 1000,
            'assignmentsMap' => [
                'old' => 'new', // after next update all `frontend.old` will be replaced by `frontend.new`
            ],
        ],
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'dektrium\user\models\User',
            //'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'useFileTransport' => {{app.mailer.useFileTransport}},
            'transport' => [
                'class' => '{{app.mailer.transport.class}}',
                'host' => '{{app.mailer.transport.host}}',
                'username' => '{{app.mailer.transport.username}}',
                'password' => '{{app.mailer.transport.password}}',
                'port' => '{{app.mailer.transport.port}}',
                'encryption' => '{{app.mailer.transport.encryption}}',
            ],
        ],
        'mailqueue' => [
            'class' => 'nterms\mailqueue\MailQueue',
            'table' => '{{%mail_queue}}',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host={{app.mysql.host}};dbname={{app.mysql.dbname}}',
            'username' => '{{app.mysql.username}}',
            'password' => '{{app.mysql.password}}',
            'charset' => 'utf8',
        ],
    ],
    'modules' => [
      'docs' => [
        'class' => 'jacmoe\mdpages\Module',
        'repository_url' => 'https://github.com/{{app.github.owner}}/{{app.github.repo}}.git',
        'github_token' => '{{app.github.token}}',
        'github_owner' => '{{app.github.owner}}',
        'github_repo' => '{{app.github.repo}}',
        'github_branch' => '{{app.github.branch}}',
        'absolute_wikilinks' => true,
        'generate_page_toc' => true,
        'generate_contributor_data' => true,
        'snippets' => $snippets,
      ],
      'user' => [
          'class' => 'dektrium\user\Module',
          'enableFlashMessages' => false,
          'admins' => ['{{app.user.admins.admin1}}', '{{app.user.admins.admin2}}'],
      ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
