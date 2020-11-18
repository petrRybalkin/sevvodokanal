<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>

<div>
    <h6 class="font-sans break-normal font-semibold text-black pt-6 text-lg"><?= $model->title ?></h6>
    <img src="<?=  $model->getThumbFileUrl('img', 'thumb','');?>" alt="" >
    <p class="py-1 text-gray-500"><?= $model->create_utime ?></p>
    <div class="py-6">
        <?= $model->short_description ?>
    </div>

    <a href="<?= Url::to(['/news/'.$model->id]) ?>">
        <button type="button" class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-purple-700 hover:bg-purple-700 text-purple-700 hover:text-white font-normal py-2 px-4 rounded mb-2">Читати повнiстью</button>
    </a>
    <hr class="border-b border-gray-200">
</div>
