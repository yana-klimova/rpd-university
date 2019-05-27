<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'layout'=>'main',
    'language'=>'ru',


    'components' => [
                'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=127.0.0.1;port=5432;dbname=rpdbase',
            'username' => 'postgres',
            'password' => '123',
            'charset' => 'utf8',
        ],
        'db_external' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'oci:dbname=//37.46.128.241:1521/;charset=AL32UTF8',
            // 'driverName' => 'oci',
            // 'dsn' => 'odbc:Driver={Oracle};Server=37.46.128.241:1521',
            'username' => 'MIREA_DOCS_PHP_APP',
            'password' => 'pass',
            // 'charset' => 'AL32UTF8',

        ],
        // 'request' => [
        //     'enableCsrfValidation'=>true,
        //     'enableCookieValidation'=>true,
        //     'csrfParam' => '_csrf-common',
        // ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ], 
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
             'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'rtu.rpd@gmail.com',
                'password' => 'dttfblnciwqjngbq',
                'port' => '587',
                'encryption' => 'tls',
            ],
             'useFileTransport' => false,
        ],
    ],
];
