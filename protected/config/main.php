<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'AFP test',
    'language' => 'zh_cn',
    // preloading 'log' component
    'preload'=>array('log'),
    'runtimePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'/runtime',
    //'runtimePath'=>'/usr/local/webapp/1430/runtime',
    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.components.widgets.*',
		'ext.PHPExcel.*',
    ),
	//配置模块信息
    // application components
    'components'=>array(
        'vipcard'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'loginUrl' => 'index.php?r=site/login',
        ),
        'authManager' => array(
            'class' => 'CPhpAuthManager',
        ),
        'db' => array(
            'connectionString' => 'mysql:host=192.168.22.18;port=3306; dbname=qllife',
            'emulatePrepare' => true,
            'enableProfiling'=>true,
            'username' => 'usrhuish',
            'password' => 'usrhuish_36',
            'charset' => 'utf8',
        ),
        // uncomment the following to use a MySQL database
        'errorHandler'=>array(
            // use 'site/error' action to display errorsMchtinfo.php
            //'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning, info',
                ),
            ),
        ),
		 'cache'=>array(
            'class'=>'system.caching.CFileCache'
            ),
    ),
    'modules'=>array(
        'voucher'=>array(),
    ),
   
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params.php'),
);
