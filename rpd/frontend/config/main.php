<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'organizer' => [
            'class' => 'common\modules\organizer\Organizer',
        ],
    ],
    'aliases' => [
        '@uploads' => 'C:/OSPanel/domains/rtu/public_html/admin/uploads/',
        '@template' => 'C:/OSPanel/domains/rtu/public_html/admin/template/',
        '@rpdcheck' => 'C:/OSPanel/domains/rtu/public_html/admin/check-rpd/',
        '@rpdapproved' => 'C:/OSPanel/domains/rtu/public_html/admin/approved-rpd/',
        '@temp' => 'C:/OSPanel/domains/rtu/public_html/admin/temp/',
    ],
    'layout' => 'discipline',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation'=>true,
            'enableCookieValidation'=>true,
             'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            // 'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pattern' => 'disciplines/<direction>/<qualification:\w+>/<currentCourse:\d+>',
                    'route' => 'site/disciplines',
                ],
                // [
                //     'pattern' => 'discipline/<id:\d+>',
                //     'route' => 'site/discipline',
                // ],
                // [
                //     'pattern' => 'discipline/<id:\d+>#<anchor:\w+>',
                //     'route' => 'site/discipline',
                // ],
                // ['class' => 'yii\rest\UrlRule', 'controller' => 'api\master'],
            ],
        ],
        
    ],

    'params' => $params,
];
