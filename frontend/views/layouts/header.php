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

/* @var $this \yii\web\View */
/* @var $model \common\models\Page */
/* @var $content string */
?>
<div class="bg-blue-800">
    <div class="max-w-9xl mx-auto px-4 sm:px-3 lg:px-3">
        <div class="flex mr-5 items-center justify-between h-16">
            <div class="md:block w-3/4">
                <div class="flex items-baseline justify-start">
                    <p class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700">м. Северодонецк, вул. Богдана Лещини, 13
                    </p>
                    <p class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700">Приймальня: 4-01-33
                    </p>
                    <p class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700">Диспетчерская: 4-32-91
                    </p>
                </div>
            </div>
            <!-- Profile dropdown -->
            <div class="relative profile group w-1/4">
                <div class="flex justify-end">
                    <button class="max-w-xs flex items-center text-sm rounded-full text-white focus:outline-none focus:shadow-solid" id="user-menu" aria-label="User menu" aria-haspopup="true">
                        Дужедовгопризвищский И.И.&nbsp;<img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                    </button>
                </div>
                <!--
                  Profile dropdown panel, show/hide based on dropdown state.

                  Entering: "transition ease-out duration-100"
                    From: "transform opacity-0 scale-95"
                    To: "transform opacity-100 scale-100"
                  Leaving: "transition ease-in duration-75"
                    From: "transform opacity-100 scale-100"
                    To: "transform opacity-0 scale-95"
                -->
                <div class="origin-top-right absolute right-0 pt-2 w-48 rounded-md shadow-lg group-hover:block">
                    <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Личный кабинет
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Налаштування
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Вийти
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- This example requires Tailwind CSS v1.4.0+ -->
<div class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-5 pb-5">
        <div class="flex justify-between items-center py-6 md:justify-start md:space-x-10">
            <div class="lg:w-0 lg:flex-1">
                <a href="/" class="flex">
                    <h3 class="text-2xl font-bold text-left text-black-400">КОМУНАЛЬНЕ ПІДПРИЄМСТВО "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ"</h3>
                </a>
            </div>
            <div class="-mr-2 -my-2 md:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            <nav class="hidden md:flex space-x-10">

                <a href="/" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                    Головна
                </a>

                <div class="relative group h-full">
                    <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
                    <button type="button" class="text-gray-500 group inline-flex items-center space-x-2 text-base leading-6 font-medium hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                        <span>Iнформацiя</span>
                        <!-- Item active: "text-gray-600", Item inactive: "text-gray-400" -->
                        <svg class="text-gray-400 h-5 w-5 group-hover:text-gray-500 group-focus:text-gray-500 transition ease-in-out duration-150" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <!--
                      'Solutions' flyout menu, show/hide based on flyout menu state.

                      Entering: "transition ease-out duration-200"
                        From: "opacity-0 translate-y-1"
                        To: "opacity-100 translate-y-0"
                      Leaving: "transition ease-in duration-150"
                        From: "opacity-100 translate-y-0"
                        To: "opacity-0 translate-y-1"
                    -->
                    <div class="absolute pin-r -ml-4 pt-3 transform px-2 w-screen max-w-md sm:px-0 lg:ml-0 lg:left-1/2 lg:-translate-x-1/2 group-hover:block hidden">
                        <div class="rounded-lg shadow-lg">
                            <div class="rounded-lg shadow-xs overflow-hidden">
                                <div class="z-20 relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                    <a href="#" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium">
                                                Нормативні документи
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              Get a better understanding of where your traffic is coming from.
                                            </p> -->
                                        </div>
                                    </a>
                                    <a href="#" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                Передача показань
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              Speak directly to your customers in a more meaningful way.
                                            </p> -->
                                        </div>
                                    </a>
                                    <a href="#" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                ПОВІРКА ЗАСОБІВ ОБЛІКУ ВОДИ
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              Your customers data will be safe and secure.
                                            </p> -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="#" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                    Послуги та тарифи
                </a>

                <div class="relative group">
                    <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
                    <button type="button" class="text-gray-500 inline-flex items-center space-x-2 text-base leading-6 font-medium hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                        <span>Про пiдприемство</span>
                        <!-- Item active: "text-gray-600", Item inactive: "text-gray-400" -->
                        <svg class="text-gray-400 h-5 w-5 group-hover:text-gray-500 group-focus:text-gray-500 transition ease-in-out duration-150" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <!--
                      'More' flyout menu, show/hide based on flyout menu state.

                      Entering: "transition ease-out duration-200"
                        From: "opacity-0 translate-y-1"
                        To: "opacity-100 translate-y-0"
                      Leaving: "transition ease-in duration-150"
                        From: "opacity-100 translate-y-0"
                        To: "opacity-0 translate-y-1"
                    -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 pt-3 px-2 w-screen max-w-md sm:px-0 group-hover:block hidden">
                        <div class="rounded-lg shadow-lg">
                            <div class="rounded-lg shadow-xs overflow-hidden">
                                <div class="z-20 relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                    <a href="/zagalna-info.php" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                Загальна інформація
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              Get all of your questions answered in our forums or contact support.
                                            </p> -->
                                        </div>
                                    </a>
                                    <a href="#" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                Керівництво
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              Learn how to maximize our platform to get the most out of it.
                                            </p> -->
                                        </div>
                                    </a>
                                    <a href="#" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                Структура
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              See what meet-ups and other events we might be planning near you.
                                            </p> -->
                                        </div>
                                    </a>
                                    <a href="#" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                Якість води
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              Understand how we take your privacy seriously.
                                            </p> -->
                                        </div>
                                    </a>
                                    <a href="#" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                Інвестиційна діяльність
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              Get all of your questions answered in our forums or contact support.
                                            </p> -->
                                        </div>
                                    </a>
                                    <a href="#" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                Державні закупівлі
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              Learn how to maximize our platform to get the most out of it.
                                            </p> -->
                                        </div>
                                    </a>
                                    <a href="#" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                Антикорупційна програма
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              See what meet-ups and other events we might be planning near you.
                                            </p> -->
                                        </div>
                                    </a>
                                    <a href="#" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                Відкриті дані
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              Understand how we take your privacy seriously.
                                            </p> -->
                                        </div>
                                    </a>
                                    <a href="#" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                Вакансії
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              See what meet-ups and other events we might be planning near you.
                                            </p> -->
                                        </div>
                                    </a>
                                    <a href="#" class="-m-3 p-3 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                        <!-- <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg> -->
                                        <div class="space-y-1">
                                            <p class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                Контакти
                                            </p>
                                            <!-- <p class="text-sm leading-5 text-gray-500">
                                              Understand how we take your privacy seriously.
                                            </p> -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="#" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                    Контакти
                </a>
            </nav>
            <!-- <div class="hidden md:flex items-center justify-end space-x-8 md:flex-1 lg:w-0">
              <a href="#" class="whitespace-no-wrap text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900">
                Sign in
              </a>
              <span class="inline-flex rounded-md shadow-sm">
                <a href="#" class="whitespace-no-wrap inline-flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                  Sign up
                </a>
              </span>
            </div> -->
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
    <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
        <div class="rounded-lg shadow-lg">
            <div class="rounded-lg shadow-xs bg-white divide-y-2 divide-gray-50">
                <div class="pt-5 pb-6 px-5 space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-left text-black-400">КОМУНАЛЬНЕ ПІДПРИЄМСТВО "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ"<h3>
                        </div>
                        <div class="-mr-2">
                            <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" onclick="close()">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <nav class="grid row-gap-8">
                            <a href="#" class="-m-3 p-3 flex items-center space-x-3 rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                <div class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                    Analytics
                                </div>
                            </a>
                            <a href="#" class="-m-3 p-3 flex items-center space-x-3 rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                                </svg>
                                <div class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                    Engagement
                                </div>
                            </a>
                            <a href="#" class="-m-3 p-3 flex items-center space-x-3 rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <div class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                    Security
                                </div>
                            </a>
                            <a href="#" class="-m-3 p-3 flex items-center space-x-3 rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                </svg>
                                <div class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                    Integrations
                                </div>
                            </a>
                            <a href="#" class="-m-3 p-3 flex items-center space-x-3 rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                <div class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                    Automations
                                </div>
                            </a>
                        </nav>
                    </div>
                </div>
                <div class="py-6 px-5 space-y-6">
                    <div class="grid grid-cols-2 row-gap-4 col-gap-8">
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Pricing
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Docs
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Enterprise
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Blog
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Help Center
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Guides
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Security
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Events
                        </a>
                    </div>
                    <div class="space-y-6">
            <span class="w-full flex rounded-md shadow-sm">
              <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                Sign up
              </a>
            </span>
                        <p class="text-center text-base leading-6 font-medium text-gray-500">
                            Existing customer?
                            <a href="#" class="text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150">
                                Sign in
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- My test -->
<div class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-5 pb-5">
        <div class="flex justify-between items-center py-6 md:justify-start md:space-x-10">
            <div class="lg:w-0 lg:flex-1">
                <a href="/" class="flex">
                    <h3 class="text-2xl font-bold text-left text-black-400">КОМУНАЛЬНЕ ПІДПРИЄМСТВО "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ"</h3>
                </a>
            </div>
            <div class="-mr-2 -my-2 md:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
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
    <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
        <div class="rounded-lg shadow-lg">
            <div class="rounded-lg shadow-xs bg-white divide-y-2 divide-gray-50">
                <div class="pt-5 pb-6 px-5 space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-left text-black-400">КОМУНАЛЬНЕ ПІДПРИЄМСТВО "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ"<h3>
                        </div>
                        <div class="-mr-2">
                            <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" onclick="close()">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <nav class="grid row-gap-8">
                            <a href="#" class="-m-3 p-3 flex items-center space-x-3 rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                <div class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                    Analytics
                                </div>
                            </a>
                            <a href="#" class="-m-3 p-3 flex items-center space-x-3 rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                                </svg>
                                <div class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                    Engagement
                                </div>
                            </a>
                            <a href="#" class="-m-3 p-3 flex items-center space-x-3 rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <div class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                    Security
                                </div>
                            </a>
                            <a href="#" class="-m-3 p-3 flex items-center space-x-3 rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                </svg>
                                <div class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                    Integrations
                                </div>
                            </a>
                            <a href="#" class="-m-3 p-3 flex items-center space-x-3 rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                <svg class="flex-shrink-0 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                <div class="text-base leading-6 font-medium text-gray-900  text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                    Automations
                                </div>
                            </a>
                        </nav>
                    </div>
                </div>
                <div class="py-6 px-5 space-y-6">
                    <div class="grid grid-cols-2 row-gap-4 col-gap-8">
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Pricing
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Docs
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Enterprise
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Blog
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Help Center
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Guides
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Security
                        </a>
                        <a href="#" class="text-base leading-6 font-medium text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700 transition ease-in-out duration-150">
                            Events
                        </a>
                    </div>
                    <div class="space-y-6">
            <span class="w-full flex rounded-md shadow-sm">
              <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                Sign up
              </a>
            </span>
                        <p class="text-center text-base leading-6 font-medium text-gray-500">
                            Existing customer?
                            <a href="#" class="text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150">
                                Sign in
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
