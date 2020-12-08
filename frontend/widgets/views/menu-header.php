<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Page;

//$model = new Page();
?>
            <a href="/" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                Головна
            </a>
        <?php if (isset($pages) && !empty($pages)):  //print_r($infos)?>
            <?php foreach ($pages as $page): ?>
                <?php if (empty(Page::getChild($page->id))) { ?>
                    <a href="<?= Url::to(['/page/'.$page->id]) ?>" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                        <?= $page->title ?>
                    </a>
                    <?php } else { ?>
                        <div class="relative group">
        <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
                            <?php if($page->id == 25 || $page->id == 24) { ?>
                            <a href="<?= Url::to(['/page/'.$page->id]) ?>" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                                <button type="button" class="text-gray-500 inline-flex items-center space-x-2 text-base leading-6 font-medium hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                                    <span><?= $page->title ?></span>
                                    <!-- Item active: "text-gray-600", Item inactive: "text-gray-400" -->
                                    <svg class="text-gray-400 h-5 w-5 group-hover:text-gray-500 group-focus:text-gray-500 transition ease-in-out duration-150" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </a>
                            <?php } else { ?>
                                <button type="button" class="text-gray-500 inline-flex items-center space-x-2 text-base leading-6 font-medium hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                                    <span><?= $page->title ?></span>
                                    <!-- Item active: "text-gray-600", Item inactive: "text-gray-400" -->
                                    <svg class="text-gray-400 h-5 w-5 group-hover:text-gray-500 group-focus:text-gray-500 transition ease-in-out duration-150" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            <?php } ?>

                            <!--
                              'More' flyout menu, show/hide based on flyout menu state.

                              Entering: "transition ease-out duration-200"
                                From: "opacity-0 translate-y-1"
                                To: "opacity-100 translate-y-0"
                              Leaving: "transition ease-in duration-150"
                                From: "opacity-100 translate-y-0"
                                To: "opacity-0 translate-y-1"
                            -->
                            <div class="second-item absolute pin-r -ml-4 pt-3 transform px-2 w-screen max-w-md sm:px-0 lg:ml-0 lg:left-1/2 lg:-translate-x-1/2 group-hover:block hidden">
                                <div class="rounded-lg shadow-lg">
                                    <div class="rounded-lg shadow-xs overflow-hidden">
                                        <div class="z-20 relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                            <?php foreach (Page::getChild($page->id) as $child): ?>
                                                <a href="<?= Url::to(['/page/'.$child->id]) ?>" class="-m-3 p-2 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                                    <div class="space-y-1">
                                                        <p class="text-base leading-6 font-medium">
                                                            <?= $child['title'] ?>
                                                        </p>
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
            <?php endforeach; ?>
        <?php endif; ?>





            <a href="<?= Url::to(['/site/contact']) ?>" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                Контакти
            </a>
