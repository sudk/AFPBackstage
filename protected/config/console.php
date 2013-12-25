<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.widgets.*',
        'ext.PHPExcel.*',
    ),
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=127.0.0.1;port=3306; dbname=qllife',
            'emulatePrepare' => true,
            'username' => 'mysql',
            'password' => 'sljjyjs',
            'charset' => 'utf8',
        ),
        'fcache'=>array(
            'class'=>'system.caching.CFileCache'
        ),
    ),
    'params' => require(dirname(__FILE__) . '/params.php'),
);
