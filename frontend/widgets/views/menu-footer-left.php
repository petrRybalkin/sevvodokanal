<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>
<?php if (isset($footer_lefts)): ?>
    <?php foreach ($footer_lefts as $footer_left): ?>
        <li class="text-grey-darker">
            <a href="<?= Url::to(['/page/'.$footer_left->id]) ?>" class="text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700"><?= $footer_left->title?></a>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
