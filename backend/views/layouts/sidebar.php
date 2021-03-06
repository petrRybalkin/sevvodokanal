<?php

use yii\helpers\Html;
use backend\models\Roles;
use common\models\Admin;

/* @var $this yii\web\View */
/* @var $model common\models\Admin */
/* @var $role2 backend\models\Roles */
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Админка</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php
            echo \hail812\adminlte3\widgets\Menu::widget([
                'items' => [
                    //['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    //['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    //['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    ['label' => 'Контент сайта', 'header' => true],
                    ['label' => 'Страницы', 'url' => ['page/index'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_pages == 1 || Yii::$app->user->identity->roleOption->access_one_page != 0],
                    ['label' => 'Новости', 'url' => ['article/index'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_news == 1],
                    ['label' => 'Файлы', 'url' => ['pdf-files/index'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_news == 1],
                    ['label' => 'Управление сайтом', 'header' => true, 'visible' => Yii::$app->user->identity->roleOption->access_users == 1],
                    ['label' => 'Настройки сайта', 'url' => ['config-site/index'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_settings == 1],
                    [
                        'label' => 'Администраторы','iconStyle' => 'far', 'iconClassAdded' => 'text-danger',
                        'items' => [
                            ['label' => 'Список админов', 'url' => ['user/index'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_users == 1],
                            ['label' => 'Права доступа', 'url' => ['roles/index'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_users == 1],
                            ['label' => 'Лог', 'url' => ['admin-log/index'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_users == 2],
                        ]
                    ],

                    //['label' => 'Управление абонентами', 'header' => true, 'visible' => Yii::$app->user->identity->roleOption->access_abonents == 1],
                    [
                        'label' => 'Абоненты','iconClass' => 'nav-icon far fa-circle text-warning',
                        'items' => [
                            ['label' => 'Список абонентов', 'url' => ['client/index'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_abonents == 1],
                            //['label' => 'еще что-то с абонентами', 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_abonents == 1]
                        ]
                    ],
//
//                    ['label' => 'Загрузка/выгрузка данных', 'header' => true, 'visible' => Yii::$app->user->identity->roleOption->access_abonents == 2],
//                    ['label' => 'Загрузить показания водомеров .DBF', 'url' => ['dbf-import/index'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_abonents == 2],
//                    ['label' => 'Загрузить счета .DBF', 'url' => ['dbf-import/score'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_abonents == 2],
//                    ['label' => 'Загрузить платежи .DBF', 'url' => ['dbf-import/payment'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_abonents == 2],
//                    ['label' => 'Загрузить компании .DBF', 'url' => ['dbf-import/company'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_abonents == 2],
//                    ['label' => 'Лог', 'url' => ['files-log/index'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_abonents == 2],
//
//                    ['label' => 'Довідник нарахувань та показань .DBF',
//                        'items' => [
//                            ['label' => 'Загрузить Довідник нарахувань та показань .DBF', 'url' => ['dbf-import/indications'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_abonents == 2],
//                            ['label' => 'Скачать покзания в dbf', 'url' => ['dbf-import/download'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->identity->roleOption->access_abonents == 2]
//                        ]
//                    ],

//                    ['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
//                    ['label' => 'Level1'],
//                    [
//                        'label' => 'Level1',
//                        'items' => [
//                            ['label' => 'Level2', 'iconStyle' => 'far'],
//                            [
//                                'label' => 'Level2',
//                                'iconStyle' => 'far',
//                                'items' => [
//                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
//                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
//                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
//                                ]
//                            ],
//                            ['label' => 'Level2', 'iconStyle' => 'far']
//                        ]
//                    ],
//                    ['label' => 'Level1'],
//                    ['label' => 'LABELS', 'header' => true],
//                    ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
//                    ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
//                    ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
