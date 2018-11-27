<?php
date_default_timezone_set('Asia/Dhaka');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Chhayanaut School Management System',

	// preloading component
	'preload'=>array(
		'log',
		'bootstrap',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.controllers.*',
		'application.components.*',
		'application.modules.authenticate.models.*',
		'application.extensions.qqFileUploader',
		'application.modules.attendance.models.*',
		//'application.modules.rights.*',
                
		//'application.modules.rights.components.*',
            

		//'application.modules.user.models.*',
		// 'application.modules.user.components.*',
		
		
	),
	

	'modules'=>array(
		'user',
		'authenticate',
		'attendance',
		'reports',
		'rights'=>array(
			//'install'=>true,
		),
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'psms',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('*','::1'),
			'generatorPaths'=>array(
				'bootstrap.gii', // since 0.9.1
			),
		),

	),

	// application components
	'components'=>array(
		/*'user'=>array(
			'class'=>'RWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl' => array('/site/login'),
		),*/
		'urlManager'=>array(
			'class'=>'application.extensions.urlManager.LangUrlManager',
			'languages'=>array('en','bn'),
			'langParam'=>'language',
			'urlFormat'=>'path',
			'rules'=>array(
				//'<language:\w+>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<language:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<language:\w+>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				//'<language:\w+>/<module:\w+>/<controller:\w+>/<id:\d+>'=>'<module>/<controller>/view/',
				'<language:\w+>/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
				'<language:\w+>/<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
			),

			'showScriptName'=>false,
				),
		'authManager'=>array(
			'class'=>'RDbAuthManager',
		),

		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
			'coreCss'=>true, // whether to register the Bootstrap core CSS (bootstrap.min.css), defaults to true
			'responsiveCss'=>false, // whether to register the Bootstrap responsive CSS (bootstrap-responsive.min.css), default to false
			'plugins'=>array(
				// Optionally you can configure the "global" plugins (button, popover, tooltip and transition)
				// To prevent a plugin from being loaded set it to false as demonstrated below
				'transition'=>false, // disable CSS transitions
				'tooltip'=>array(
					'selector'=>'a.tooltip', // bind the plugin tooltip to anchor tags with the 'tooltip' class
					'options'=>array(
						'placement'=>'bottom', // place the tooltips below instead
					),
				),
				// If you need help with configuring the plugins, please refer to Bootstrap's own documentation:
				// http://twitter.github.com/bootstrap/javascript.html
			),
		),

		// URLs  path format
		/*'urlManager'=>array(
			'showScriptName'=> false,
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/

		// MySQL database configuration
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=psms',
			'emulatePrepare' => true,
			'tablePrefix' => '',
			'username' => 'psms',
			'password' => 'psms',
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

				/*
				array(
					'class'=>'CWebLogRoute',
				),
				 */
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'hakim@drikict.net',
	),
);