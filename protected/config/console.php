<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Pathshala School Management System',
	// application components
	'components'=>array(
		// MySQL database configuration

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=psms',
			'emulatePrepare' => true,
			'tablePrefix' => '',
			'username' => 'psms',
			'password' => 'psms',
			'charset' => 'utf8',
		),

	),
	//application commands
	'commandMap' => array(
        'migrate' => array(
            // alias of the path where you extracted the zip file
            'class' => 'application.extensions.migrate.EMigrateCommand',
            // this is the path where you want your core application migrations to be created
            'migrationPath' => 'application.migrations',
            // the name of the table created in your database to save versioning information
            'migrationTable' => '{{migration}}',
	        // the application migrations are in a pseudo-module called "core" by default
            'applicationModuleName' => 'core',
	        // define all available modules (if you do not set this, modules will be set from yii app config)

	        'modulePaths' => array(
		        'rights'      => 'application.modules.rights.migrations',
			'user'=>'application.modules.user.migrations',
	        ),

	        // here you can configrue which modules should be active, you can disable a module by adding its name to this array
	        /*'disabledModules' => array(
	            'admin', 'anOtherModule', // ...
	        ),*/
	        // the name of the application component that should be used to connect to the database
            'connectionID'=>'db',
            // alias of the template file used to create new migrations
            //'templateFile'=>'application.db.migration_template',
        ),
    ),
);