<?php

Yii::setAlias('@runtimeFront', dirname(dirname(__DIR__)) . '/frontend/runtime/');
Yii::setAlias('@runtimeBack', dirname(dirname(__DIR__)) . '/backend/runtime/');


return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => [
        'queue', // Компонент регистрирует свои консольные команды
    ],
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
        'db' => [
            'class' => \yii\db\Connection::class,
        ],
//        'queue' => [
//            'class' => \yii\queue\db\Queue::class,
//            'db' => 'db',
//            'ttr'   =>  15,
//            'attempts' => 3,
//            'tableName' => '{{%queue}}',
//            'channel' => 'default',
//            'mutex' => \yii\mutex\MysqlMutex::class, // Мьютекс для синхронизации запросов
//            'as log' => \yii\queue\LogBehavior::class,
//        ],
        'queue' => [
            'class' => 'yii\queue\db\Queue',
            'db' => 'db', // DB connection component or its config
            'ttr'   =>  120*60,
            'tableName' => '{{%queue}}', // Table name
            'channel' => 'default', // Queue channel key
            'mutex' => 'yii\mutex\MysqlMutex', // Mutex used to sync queries
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp-pulse.com',
                'username' => 'slava.rudnev+severvoda@gmail.com',
                'password' => 'Yc2cmoCj8p',
                'port' => '2525',
                'encryption' => false,
            ],
        ],
    ],
];
