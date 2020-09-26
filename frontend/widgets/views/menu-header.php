<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>
            <a href="/" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                Головна
            </a>
        <?php if (isset($infos) && !empty($infos)):  //print_r($infos)?>
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
                <div class="second-item absolute pin-r -ml-4 pt-3 transform px-2 w-screen max-w-md sm:px-0 lg:ml-0 lg:left-1/2 lg:-translate-x-1/2 group-hover:block hidden">
                    <div class="rounded-lg shadow-lg">
                        <div class="rounded-lg shadow-xs overflow-hidden">
                            <div class="z-20 relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                            <?php foreach ($infos as $info): ?>
                                <a href="<?= Url::to(['/page/'.$info->id]) ?>" class="-m-3 p-2 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                    <div class="space-y-1">
                                        <p class="text-base leading-6 font-medium">
                                            <?= $info->title ?>
                                        </p>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($pages)): ?>
            <?php foreach ($pages as $page): ?>
                <?php if ($page->parent_page == 0) { ?>
                    <a href="<?= Url::to(['/page/'.$page->id]) ?>" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                        <?= $page->title ?>
                    </a>
                <?php } //else if ($page->parent_page == 1) { ?>
                <?php //} ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($abouts) && !empty($abouts)): ?>
            <div class="relative group">
                <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
                <button type="button" class="text-gray-500 inline-flex items-center space-x-2 text-base leading-6 font-medium hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                    <span>Про пiдприємство</span>
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
                <div class="second-item absolute pin-r -ml-4 pt-3 transform px-2 w-screen max-w-md sm:px-0 lg:ml-0 lg:left-1/2 lg:-translate-x-1/2 group-hover:block hidden">
                    <div class="rounded-lg shadow-lg">
                        <div class="rounded-lg shadow-xs overflow-hidden">
                            <div class="z-20 relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                            <?php foreach ($abouts as $about): ?>
                                <a href="<?= Url::to(['/page/'.$about->id]) ?>" class="-m-3 p-2 flex items-start space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 text-gray-900 hover:text-blue-700 focus:outline-none focus:text-blue-700">
                                    <div class="space-y-1">
                                        <p class="text-base leading-6 font-medium">
                                            <?= $about->title ?>
                                        </p>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

            <a href="<?= Url::to(['/site/contact']) ?>" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                Контакти
            </a>
