<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>
<?php if (isset($pages)): ?>
    <?php foreach ($pages as $page): ?>
        <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
            <a href="<?= Url::to(['/page/'.$page->id]) ?>" class="block pl-4 align-middle text-gray-700 no-underline hover:text-purple-500 border-l-4 border-transparent lg:hover:border-gray-400">
                <span class="pb-1 md:pb-0 text-sm"><?= $page->title?></span>
            </a>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
