<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use lavrentiev\widgets\toastr\NotificationFlash;
use frontend\widgets\SidebarProfileWidget;
use yii\helpers\Url;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div>
    <?=$this->render('header'); ?>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto p-12 py-18 px-6 sm:px-8 lg:px-24 md:block" style="background: url('../img/water2.jpg') no-repeat 50% 100%; background-size: cover;">
            <h1 class="md:text-3xl font-bold leading-tight text-white shadow-text">КОМУНАЛЬНЕ ПІДПРИЄМСТВО "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ"</h1>
            <h5 class="md:text-2xl mt-1 font-bold leading-tight text-white shadow-text">Чиста вода в кожен дiм!</h5>
        </div>
    </header>
    <main>
        <div class="container lk-sev w-full flex flex-wrap mx-auto px-2 pt-8 lg:pt-8 mt-1">
            <div class="w-full lg:w-4/4 pl-8 pr-8 pb-8 mt-6 lg:mt-0 text-gray-900 leading-normal bg-white">
                <div class="w-full sticky inset-0 h-16 hidden overflow-x-hidden overflow-y-auto lg:overflow-y-hidden lg:block mt-0 border border-gray-400 lg:border-transparent bg-white shadow lg:shadow-none lg:bg-transparent z-20" id="menu-content">
                    <ul class="list-reset sidebar sidebar-profile">
                        <?= SidebarProfileWidget::widget(); ?>
                    </ul>
                    <br><br>
                </div>

                <!-- mobile profile menu -->
                <!-- This example requires Tailwind CSS v2.0+ -->
                <?php if($_SERVER['REQUEST_URI'] !== '/profile/index' && $_SERVER['REQUEST_URI'] !== '/frontend/web/profile/index'): ?>
                <div class="relative inline-block text-left md:hidden lg:hidden">
                    <div>
                        <h3><?= Html::encode($this->title) ?></h3>
                        <button type="button" class="dropdown-mobile inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true">
                            Меню Особистого кабiнету
                            <!-- Heroicon name: chevron-down -->
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <!--
                      Dropdown panel, show/hide based on dropdown state.

                      Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                      Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
                    <div class="dropdown-menu-mobile hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <ul class="list-reset sidebar sidebar-profile">
                                <?= SidebarProfileWidget::widget(); ?>
                            </ul>
                        </div>
                    </div>
                    <br><br>
                </div>
                <?php endif; ?>

                <!-- end mobile profile menu -->

                <?//= Alert::widget() ?>
                <?= NotificationFlash::widget([
                'options' => [
                    "closeButton" => true,
                    "debug" => false,
                    "newestOnTop" => false,
                    "progressBar" => true,
                    "positionClass" => \lavrentiev\widgets\toastr\NotificationFlash::POSITION_TOP_CENTER,
                    "preventDuplicates" => false,
                    "onclick" => null,
                    "showDuration" => "500",
                    "hideDuration" => "2000",
                    "timeOut" => "6000",
                    "extendedTimeOut" => "1000",
                    "showEasing" => "swing",
                    "hideEasing" => "linear",
                    "showMethod" => "fadeIn",
                    "hideMethod" => "fadeOut"
                    ]
                ]) ?>
                <?= $content ?>
                <!--Title-->
            </div>
        </div>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Replace with your content -->
            <div class="px-4 py-6 sm:px-0">
                <div class=" rounded-lg h-96">
                    &nbsp;
                </div>
            </div>
            <!-- /End replace -->
        </div>
    </main>
    <?=$this->render('footer'); ?>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
