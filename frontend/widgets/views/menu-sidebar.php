<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>

<?php if (isset($pagesBefore)): ?>
    <?php foreach ($pagesBefore as $pageBefore): ?>
        <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
            <a href="<?= Url::to(['/page/'.$pageBefore->id]) ?>" class="block pl-4 align-middle text-gray-700 no-underline hover:text-purple-500 border-l-4 border-transparent lg:hover:border-gray-400">
                <span class="pb-1 md:pb-0 text-sm"><?= $pageBefore->title?></span>
            </a>
        </li>
    <?php endforeach; ?>
<?php endif; ?>

<li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
    <a href="<?= Url::to(['/article/index']) ?>" class="block pl-4 align-middle text-gray-700 no-underline hover:text-purple-500 border-l-4 border-transparent lg:hover:border-gray-400">
        <span class="pb-1 md:pb-0 text-sm">Новини</span>
    </a>
</li>

<?php if (isset($pagesAfter)): ?>
    <?php foreach ($pagesAfter as $pageAfter): ?>
        <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
            <a href="<?= Url::to(['/page/'.$pageAfter->id]) ?>" class="block pl-4 align-middle text-gray-700 no-underline hover:text-purple-500 border-l-4 border-transparent lg:hover:border-gray-400">
                <span class="pb-1 md:pb-0 text-sm"><?= $pageAfter->title?></span>
            </a>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
