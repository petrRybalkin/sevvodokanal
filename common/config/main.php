<?php
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
            // ...
        ],
        'queue' => [
            'class' => \yii\queue\db\Queue::class,
            'db' => 'db', // Компонент подключения к БД или его конфиг
            'tableName' => '{{%queue}}', // Имя таблицы
            'channel' => 'default', // Выбранный для очереди канал
            'mutex' => \yii\mutex\MysqlMutex::class, // Мьютекс для синхронизации запросов
        ],
    ],
];
