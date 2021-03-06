<?php
return [
    'bootstrap' => [
        'kalpok\i18n\LanguageAndCalendarSetter'
    ],
    'aliases' => [
        '@webroot' => '@app/web/admin',
    ],
    'controllerMap' => [
        'gallery' => 'kalpok\gallery\controllers\GalleryController'
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'file/download/<name>' => 'file/serve-file'
            ]
        ],
        'frontendUrlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'baseUrl' => '/'
        ]
    ],
    'modules' => [
        'page' => 'modules\page\backend\Module',
        'post' => 'modules\post\backend\Module',
        'slider' => 'modules\slider\Module',
        'user' => 'modules\user\backend\Module',
        'setting' => 'modules\setting\Module'
    ],
    'params' => [
        'app' => 'backend',
    ]
];
