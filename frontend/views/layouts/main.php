<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
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

<!--    --><?php
//    NavBar::begin([
//        'brandLabel' => Yii::$app->name,
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top',
//        ],
//    ]);
//    $menuItems = [
//        ['label' => 'Home', 'url' => ['/site/index']],
//        ['label' => 'About', 'url' => ['/site/about']],
//        ['label' => 'Contact', 'url' => ['/site/contact']],
//    ];
//    if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
//        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
//    } else {
//        $menuItems[] = '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>';
//    }
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
//        'items' => $menuItems,
//    ]);
//    NavBar::end();
//    ?>

<div>
    <?=$this->render('header'); ?>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto p-12 py-18 px-6 sm:px-8 lg:px-24 md:block" style="background: url('../img/water2.jpg') no-repeat 50% 100%; background-size: cover;">
            <h1 class="md:text-3xl font-bold leading-tight text-white shadow-text">КОМУНАЛЬНЕ ПІДПРИЄМСТВО "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ"</h1>
            <h5 class="md:text-2xl mt-1 font-bold leading-tight text-white shadow-text">Чиста вода в кожен дiм!</h5>
        </div>
    </header>
    <main>
        <div class="container w-full flex flex-wrap mx-auto px-2 pt-8 lg:pt-8 mt-1">
            <?=$this->render('sidebar'); ?>
            <div class="w-full lg:w-3/4 pl-8 pr-8 pb-8 mt-6 lg:mt-0 text-gray-900 leading-normal bg-white">
                <?= Alert::widget() ?>
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
