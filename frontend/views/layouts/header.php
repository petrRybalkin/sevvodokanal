<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use common\models\Page;
use frontend\widgets\MenuSiteWidget;
use common\models\User;
use common\models\ConfigSite;

/* @var $this \yii\web\View */
/* @var $model \common\models\Page */
/* @var $client \common\models\User */
/* @var $content string */

$settings = ConfigSite::getSettings(1);

?>
<div class="bg-blue-800">
    <div class="max-w-9xl mx-auto px-4 sm:px-1 lg:px-3">
        <div class="flex mr-5 items-center justify-between md:h-12 sm:h-18">
            <div class="md:block md:w-3/4 sm:w-4/4">
                <div class="md:flex items-baseline justify-start">
                    <p class="md:ml-4 sm:ml-1 px-3 py-2 rounded-md text-sm font-medium text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700"> <?= $settings->address ?></p>
                    <p class="md:ml-4 sm:ml-1 px-3 py-2 rounded-md text-sm font-medium text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700">Приймальня: <?= $settings->phone_priem ?></p>
                    <p class="md:ml-4 sm:ml-1 px-3 py-2 rounded-md text-sm font-medium text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700">Диспетчерська: <?= $settings->phone_disp ?></p>
                </div>
            </div>
            <!-- Profile dropdown -->
            <?php $client = true; if($client): ?>
                <div class="relative profile menu group w-1/4 xs:hidden sm:hidden md:visible">
                    <div class="flex justify-end">
                        <div class="max-w-xs flex items-center text-sm text-white focus:outline-none focus:shadow-solid border-r">
                            <?= Html::a('Юридичним особам', ['/legal/index'], ['class'=>'block px-4 py-2 text-sm text-gray-100 hover:text-gray-300']) ?>
                        </div>
                        <div class="max-w-xs flex items-center text-sm text-white focus:outline-none focus:shadow-solid " id="user-menu" aria-label="User menu" aria-haspopup="true">
                            <?php if(Yii::$app->user->isGuest): ?>
                            <?= Html::a('Фізичним особам', '#', ['class'=>'dropdown-menu-lk block px-4 py-2 text-sm text-gray-100 hover:text-gray-300']) ?>
                            <?php else: ?>
                            <?= Html::a('Особистий кабінет', ['/profile/index'], ['class'=>'dropdown-menu-lk block px-4 py-2 text-sm text-gray-100 hover:text-gray-300']) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- Profile dropdown panel, show/hide based on dropdown state.

                      Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                      Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95" -->

                    <div class="origin-top-right-menu absolute right-0 pt-2 w-48 rounded-md shadow-lg group-hover:block">
                        <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                            <?php if(Yii::$app->user->isGuest): ?>
                            <?= Html::a('Увійти', ['/site/login'], ['class'=>'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100', 'role'=>'menuitem']) ?>
                            <?= Html::a('Реєстрація', ['/site/signup'], ['class'=>'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100', 'role'=>'menuitem']) ?>
                            <?php else: ?>
                            <?= Html::a('Особистий кабінет', ['/profile/index'], ['class'=>'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100', 'role'=>'menuitem']) ?>
                            <?= Html::a('Вийти', ['/site/logout'], ['data-method' => 'POST', 'class'=>'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100', 'role'=>'menuitem']) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<!-- This example requires Tailwind CSS v1.4.0+ -->

<!-- My test -->
<div class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-3 pb-3 bigmenu">
        <div class="flex justify-between items-center py-2 md:justify-start md:space-x-10">
            <div class="lg:w-0 lg:flex-1" id="home">
                <a href="/" class="flex">
                    <h3 class="md:text-2xl font-bold text-left text-black-400 sm:text-base"><!--КОМУНАЛЬНЕ ПІДПРИЄМСТВО КП "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ"--><?= $settings->name_header ?></h3>
                </a>
            </div>
            <div class="-mr-2 -my-2 md:hidden" id="burger">
                <button @click="isOpen = !isOpen" type="button" class="mobile-menu inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            <nav class="hidden md:flex space-x-10">

                <?= MenuSiteWidget::widget(); ?>

            </nav>
        </div>
    </div>

    <!--
      Mobile menu, show/hide based on mobile menu state.

      Entering: "duration-200 ease-out"
        From: "opacity-0 scale-95"
        To: "opacity-100 scale-100"
      Leaving: "duration-100 ease-in"
        From: "opacity-100 scale-100"
        To: "opacity-0 scale-95"
    -->
    <div class="hidden absolute top-0 inset-x-0 p-2 transition transform origin-top-right" id="menu" style="z-index:20">
        <div class="rounded-lg shadow-lg">
            <div class="rounded-lg shadow-xs bg-white divide-y-2 divide-gray-50">
                <div class="pt-5 pb-6 px-5 space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="md:text-2xl font-bold text-left text-black-400 sm:text-base">КП "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ"<h3>
                        </div>
                        <div class="-mr-2">
                            <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" id="burger2">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <nav class="grid row-gap-8">
                            <?= MenuSiteWidget::widget(); ?>
                        </nav>
                    </div>
                </div>

                <div class="py-6 px-5 space-y-6">
                    <div class="space-y-6">
                        <?php if(Yii::$app->user->isGuest): ?>
                            <span class="w-full flex rounded-md shadow-sm">
                          <?= Html::a('Реєстрація', ['/site/signup'], ['class'=>'w-full flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150']) ?>
                        </span>
                            <p class="text-center text-base leading-6 font-medium text-gray-500">
                                У вас вже є обліковий запис?
                                <?= Html::a('Увійти', ['/site/login'], ['class'=>'text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150']) ?>
                            </p>
                        <?php else: ?>
                            <span class="w-full flex rounded-md shadow-sm">
                            <?= Html::a('Особистий кабінет', ['/profile/index'], ['class'=>'w-full flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150']) ?>
                        </span>
                            <p class="text-center text-base leading-6 font-medium text-gray-500">
                                <?= Html::a('Вийти', ['/site/logout'], ['data-method' => 'POST', 'class'=>'text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150']) ?>
                            </p>
                        <?php endif; ?>
                        <p class="text-center text-base leading-6 font-medium text-gray-500">
                            <?= Html::a('Юридичнi особи', ['/legal/index'], ['class'=>'text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150']) ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
