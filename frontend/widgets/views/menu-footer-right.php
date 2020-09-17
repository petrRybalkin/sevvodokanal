<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>
<?php if (isset($footer_rights)): ?>
    <?php foreach ($footer_rights as $footer_right): ?>
        <li class="text-grey-darker">
            <a href="<?= Url::to(['/page/'.$footer_right->id]) ?>" class="text-gray-100 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700"><?= $footer_right->title?></a>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
