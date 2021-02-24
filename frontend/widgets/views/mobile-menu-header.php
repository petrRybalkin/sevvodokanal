<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Page;

//$model = new Page();
?>
<a href="/" class="text-base leading-3 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
    Головна
</a>
<?php if (isset($pages) && !empty($pages)):  //print_r($infos)?>
    <?php foreach ($pages as $page): ?>
        <?php if (empty(Page::getChild($page->id))) { ?>
            <a href="<?= Url::to(['/page/'.$page->id]) ?>" class="text-base leading-3 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                <?= $page->title ?>
            </a>
        <?php } else { ?>
            <div class="relative group">
                <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
                <?php if((empty(Page::getChild($page->id)) && $page->id !== 24) || (empty(Page::getChild($page->id)) && $page->id !== 25)) { ?>
                    <a href="<?= Url::to(['/page/'.$page->id]) ?>" class="text-base leading-3 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                        <button type="button" class="text-gray-500 inline-flex items-center space-x-2 text-base leading-3 font-medium hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                            <span><?= $page->title ?></span>
                            <!-- Item active: "text-gray-600", Item inactive: "text-gray-400" -->
                            <svg class="text-gray-400 h-5 w-5 group-hover:text-gray-500 group-focus:text-gray-500 transition ease-in-out duration-150" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </a>
                <?php } else { ?>
                    <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                        <button type="button" class="text-gray-500 inline-flex items-center space-x-2 text-base leading-3 font-medium hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                            <span><?= $page->title ?></span>
                            <!-- Item active: "text-gray-600", Item inactive: "text-gray-400" -->
                            <svg class="text-gray-400 h-5 w-5 group-hover:text-gray-500 group-focus:text-gray-500 transition ease-in-out duration-150" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </a>
                <?php } ?>
                <?php foreach (Page::getChild($page->id) as $child): ?>
                    <br>
                    <a href="<?= Url::to(['/page/'.$child['id']]) ?>" class="text-base leading-3 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                        <button type="button" class="text-gray-500 inline-flex items-center space-x-2 text-base leading-3 font-medium hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                            <span>- <?= $child['title'] ?></span>
                        </button>
                    </a>
                <?php endforeach; ?>
                <!--
                  'More' flyout menu, show/hide based on flyout menu state.

                  Entering: "transition ease-out duration-200"
                    From: "opacity-0 translate-y-1"
                    To: "opacity-100 translate-y-0"
                  Leaving: "transition ease-in duration-150"
                    From: "opacity-100 translate-y-0"
                    To: "opacity-0 translate-y-1"
                -->
            </div>
        <?php } ?>
    <?php endforeach; ?>
<?php endif; ?>





<a href="<?= Url::to(['/site/contact']) ?>" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
    Контакти
</a>
