<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'frontCache' => [
            'class' => yii\caching\FileCache::class,
            'cachePath' => '@frontend/runtime/cache',
        ],
        'authManager' => [
            'class' => yii\rbac\DbManager::class,
            'defaultRoles' => ['guest', 'user'],
        ],
        'settings' => [
            'class' => 'pheme\settings\components\Settings',
            'frontCache' => 'frontCache',
        ],
    ],
];
