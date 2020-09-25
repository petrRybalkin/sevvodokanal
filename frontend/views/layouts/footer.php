<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use common\models\Page;
use frontend\widgets\FooterMenuLeftWidget;
use frontend\widgets\FooterMenuRightWidget;

/* @var $this \yii\web\View */
/* @var $model \common\models\Page */
/* @var $client \common\models\User */
/* @var $content string */
?>
<!-- <div class="container bg-blue-800 p-12"> -->
<div class="bg-blue-800 p-12">
    <div class="sm:flex mb-4">
        <div class="sm:w-1/4 h-auto">
            <ul class="list-reset leading-normal">
                <li class="text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700">КОМУНАЛЬНЕ ПІДПРИЄМСТВО "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ"</li>
                <li class="text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700">ЧИСТА ВОДА В КОЖЕН ДIМ!</li>
            </ul>
        </div>
        <div class="sm:w-1/4 h-auto sm:mt-0 mt-8">
            <ul class="list-reset leading-normal">
                <?= FooterMenuLeftWidget::widget(); ?>
                <li class="text-grey-darker"><a href="<?= Url::to(['/article/index']) ?>" class="text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700">Новини</a></li>
            </ul>
        </div>
        <div class="sm:w-1/4 h-auto sm:mt-0 mt-8">
            <ul class="list-reset leading-normal">
                <li class="text-grey-darker"><a href="/" class="text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700">Головна</a></li>
                <?= FooterMenuRightWidget::widget(); ?>
                <li class="text-grey-darker"><a href="<?= Url::to(['/site/contact']) ?>" class="text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700">Контакти</a></li>
            </ul>
        </div>
        <div class="sm:w-1/2 sm:mt-0 mt-8 h-auto">
            <?php $client = false; if($client): ?>
            <p class="text-white leading-normal">Пiдписатись на новини:</p>
            <div class="mt-4 flex">
                <input type="text" class="p-2 border border-grey-light round text-grey-dark text-sm h-auto" placeholder="Your email address">
                <button class="bg-blue-400 text-white rounded-sm h-auto text-xs p-3">Subscribe</button>
            </div>
            <div class="text-gray-200 mb-2">
                <p class="text-white leading-normal">Знайдiть нас:</p>
            </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<div class="bg-black p-2">
    <div class="sm:flex mb-4">
        <p class="text-gray-100">&copy;<?php echo date('Y'); ?> КОМУНАЛЬНЕ ПІДПРИЄМСТВО "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ"</p>
    </div>
</div>
