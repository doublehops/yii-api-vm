<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['192.168.10.1'],
        ],
    ],
    'components' => [
        'db' => require(__DIR__ .'/../../common/config/db.php'),
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user', 'pluralize' => false],
//                '<controller:[^/]+>/<action:[^/]+>' => '<controller>/<action>',
//                '<controller:[^/]+>/<action:[^/]+>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
]
    ],
    'params' => $params,
];
