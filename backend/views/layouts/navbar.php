<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model \common\models\User */

?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?=\yii\helpers\Url::home()?>" class="nav-link">Главная</a>
        </li>

        <?php if(Yii::$app->user->identity->roleOption->access_abonents == 1):?>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Загрузка/выгрузка данных</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="width:320px;">
                <li><a href="<?= Url::to(['dbf-import/index']) ?>" class="dropdown-item">Загрузить показания водомеров .DBF </a></li>
                <li><a href="<?= Url::to(['dbf-import/score']) ?>" class="dropdown-item">Загрузить счета .DBF</a></li>
                <li><a href="<?= Url::to(['dbf-import/payment']) ?>" class="dropdown-item">Загрузить платежи .DBF</a></li>

                <li class="dropdown-divider"></li>
                <!-- Level two dropdown-->
                <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Загрузить юр. лица </a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                        <li><a href="<?= Url::to(['dbf-import/company']) ?>" class="dropdown-item">Загрузить юр. лица .DBF</a></li>
                        <li><a href="<?= Url::to(['dbf-import/download-company']) ?>" class="dropdown-item">Скачать показания юр. лиц. в dbf</a></li>
                    </ul>
                </li>
                <!-- Level two dropdown-->
                <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Довідник нарахувань та показань .DBF</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                        <li>
                            <a tabindex="-1" href="<?= Url::to(['dbf-import/indications']) ?>" class="dropdown-item">Загрузить Довідник нарахувань та показань .DBF</a>
                        </li>
                        <li><a href="<?= Url::to(['dbf-import/download']) ?>" class="dropdown-item">Скачать показания в dbf</a></li>
                    </ul>
                </li>
                <!-- End Level two -->
            </ul>
        </li>
        <?php endif;?>
        <?php if(Yii::$app->user->identity->roleOption->access_abonents == 1 || Yii::$app->user->identity->roleOption->access_users == 1):?>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Логи</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <?php if(Yii::$app->user->identity->roleOption->access_users == 1):?>
                    <li><a href="<?= Url::to(['admin-log/index']) ?>" class="dropdown-item">Лог администраторов </a></li>
                <?php endif;?>
                <?php if(Yii::$app->user->identity->roleOption->access_abonents == 1):?>
                    <li><a href="<?= Url::to(['files-log/index']) ?>" class="dropdown-item">Логи импорта/экспорта </a></li>
<!--                    <li><a href="#" class="dropdown-item">Лог абонентов</a></li>-->
                <?php endif;?>
            </ul>
        </li>
        <?php endif;?>
    </ul>

    <!-- SEARCH FORM -->
<!--    <form class="form-inline ml-3">-->
<!--        <div class="input-group input-group-sm">-->
<!--            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">-->
<!--            <div class="input-group-append">-->
<!--                <button class="btn btn-navbar" type="submit">-->
<!--                    <i class="fas fa-search"></i>-->
<!--                </button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </form>-->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
<!--        <li class="nav-item dropdown">-->
<!--            <a class="nav-link" data-toggle="dropdown" href="#">-->
<!--                <i class="far fa-comments"></i>-->
<!--                <span class="badge badge-danger navbar-badge">3</span>-->
<!--            </a>-->
<!--            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">-->
<!--                <a href="#" class="dropdown-item">-->
                    <!-- Message Start -->
<!--                    <div class="media">-->
<!--                        <img src="--><?//=$assetDir?><!--/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">-->
<!--                        <div class="media-body">-->
<!--                            <h3 class="dropdown-item-title">-->
<!--                                Brad Diesel-->
<!--                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>-->
<!--                            </h3>-->
<!--                            <p class="text-sm">Call me whenever you can...</p>-->
<!--                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- Message End -->
<!--                </a>-->
<!--                <div class="dropdown-divider"></div>-->
<!--         <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>-->
<!--            </div>-->
<!--        </li>-->
        <!-- Notifications Dropdown Menu -->
<!--        <li class="nav-item dropdown">-->
<!--            <a class="nav-link" data-toggle="dropdown" href="#">-->
<!--                <i class="far fa-bell"></i>-->
<!--                <span class="badge badge-warning navbar-badge">15</span>-->
<!--            </a>-->
<!--            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">-->
<!--                <span class="dropdown-header">15 Notifications</span>-->
<!--                <div class="dropdown-divider"></div>-->
<!--                <a href="#" class="dropdown-item">-->
<!--                    <i class="fas fa-envelope mr-2"></i> 4 new messages-->
<!--                    <span class="float-right text-muted text-sm">3 mins</span>-->
<!--                </a>-->
<!--                <div class="dropdown-divider"></div>-->
<!--                <a href="#" class="dropdown-item">-->
<!--                    <i class="fas fa-users mr-2"></i> 8 friend requests-->
<!--                    <span class="float-right text-muted text-sm">12 hours</span>-->
<!--                </a>-->
<!--                <div class="dropdown-divider"></div>-->
<!--                <a href="#" class="dropdown-item">-->
<!--                    <i class="fas fa-file mr-2"></i> 3 new reports-->
<!--                    <span class="float-right text-muted text-sm">2 days</span>-->
<!--                </a>-->
<!--                <div class="dropdown-divider"></div>-->
<!--                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>-->
<!--            </div>-->
<!--        </li>-->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline"><?=Yii::$app->user->identity->username; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

                    <p>
                        Супер Админ - Web Developer
                        <small>Member since Aug. 2020</small>
                    </p>
                </li>
                <!-- Menu Body -->
<!--                <li class="user-body">-->
<!--                    <div class="row">-->
<!--                        <div class="col-4 text-center">-->
<!--                            <a href="#">&nbsp;</a>-->
<!--                        </div>-->
<!--                        <div class="col-4 text-center">-->
<!--                            <a href="#">&nbsp;</a>-->
<!--                        </div>-->
<!--                        <div class="col-4 text-center">-->
<!--                            <a href="#">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
                <!-- Menu Footer-->
                <li class="user-footer">
                    <?= Html::a('Изменить', ['user/index'], ['class' => 'btn btn-default btn-flat']) ?>
                    <?= Html::a('Выйти', ['site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat float-right']) ?>
                </li>
            </ul>
        </li>
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i-->
<!--                    class="fas fa-th-large"></i></a>-->
<!--        </li>-->
    </ul>
</nav>