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
        'cache'=>array(
            'class'=>'system.caching.CFileCache'
        ),
    ),
    'params' => require(dirname(__FILE__) . '/params.php'),
);
