<?php

use yii\helpers\Html;
use backend\models\Roles;

/* @var $this yii\web\View */
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
        <!-- Sidebar user panel (optional) -->
<!--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">-->
<!--            <div class="image">-->
<!--                <img src="--><?//=$assetDir?><!--/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
<!--            </div>-->
<!--            <div class="info">-->
<!--                <a href="#" class="d-block">Администратор</a>-->
<!--            </div>-->
<!--        </div>-->

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php
            echo \hail812\adminlte3\widgets\Menu::widget([
                'items' => [
//                    [
//                        'label' => 'Контент сайта',
//                        'icon' => 'tachometer-alt',
//                        //'badge' => '<span class="right badge badge-info">2</span>',
//                        'items' => [
//                            ['label' => 'Страницы', 'url' => ['page/index'], 'iconStyle' => 'far'],
//                            ['label' => 'Новости', 'url' => ['article/index'], 'iconStyle' => 'far'],
//                        ]
//                    ],
//                    [
//                        'label' => 'Пользователи',
//                        'icon' => 'tachometer-alt',
//                        //'badge' => '<span class="right badge badge-info">2</span>',
//                        'items' => [
//                            ['label' => 'Страницы', 'url' => ['site/index'], 'iconStyle' => 'far'],
//                            ['label' => 'Новости', 'iconStyle' => 'far'],
//                        ]
//                    ],
//                    [
//                        'label' => 'Абоненты',
//                        'icon' => 'tachometer-alt',
//                        //'badge' => '<span class="right badge badge-info">2</span>',
//                        'items' => [
//                            ['label' => 'Страницы', 'url' => ['site/index'], 'iconStyle' => 'far'],
//                            ['label' => 'Новости', 'iconStyle' => 'far'],
//                        ]
//                    ],
//
//                    ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    ['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    ['label' => 'Контент сайта', 'header' => true],
                    ['label' => 'Страницы', 'url' => ['page/index'], 'iconStyle' => 'far'],
                    ['label' => 'Новости', 'url' => ['article/index'], 'iconStyle' => 'far'],
                    ['label' => 'Управление сайтом', 'header' => true],
                    [
                        'label' => 'Пользователи',
                        'items' => [
                            ['label' => 'Список пользователей', 'url' => ['user/index'], 'iconStyle' => 'far'],
                            ['label' => 'Права доступа', 'url' => ['roles/index'], 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Управление абенентами', 'header' => true],
                    [
                        'label' => 'Абоненты',
                        'items' => [
                            ['label' => 'Список абенентов', 'iconStyle' => 'far'],
                            ['label' => 'еще что-то с абонентами', 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Импорт данных', 'header' => true],
                    ['label' => 'Загрузить показания водомеров .DBF', 'url' => ['dbf-import/index'], 'iconStyle' => 'far'],
                    ['label' => 'Загрузить счета .DBF', 'url' => ['dbf-import/score'], 'iconStyle' => 'far'],
                    ['label' => 'Загрузить платежи .DBF', 'url' => ['dbf-import/payment'], 'iconStyle' => 'far'],
                    ['label' => 'Загрузить компании .DBF', 'url' => ['dbf-import/company'], 'iconStyle' => 'far'],

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