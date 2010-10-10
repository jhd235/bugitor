<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Bugitor',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.modules.user.models.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'user' => array(
                        'modules' => array(
                            'role',
                            'profiles',
                            'messages',
                        ),
                        'debug' => true
                ),
                'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'letmein',
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
                        'class' => 'application.modules.user.components.YumWebUser',
			'allowAutoLogin'=>true,
                        'loginUrl' => array('/user/user/login'),
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=mysql.ogitor.org;dbname=ogitorbugs',
			'emulatePrepare' => true,
			'username' => 'ogitordbadmin',
                        'tablePrefix' => 'bug_',
			'password' => 'Pevum2383',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'jacmoe@mail.dk',
	),
);