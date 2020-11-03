<?php


use frontend\widgets\SidebarProfileWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>


<p>В одному особистому кабінеті можливе додавання до п`яти особових рахунків.
    Кожен особовий рахунок може містити до трьох лічильників. </p>

<p>
    Вашi особовi рахунки:
</p>

<?php
/** @var \common\models\ScoreMetering $item */

foreach ($clientScore as $key => $item):
    ?>
    <p class="flex">
        <a href="<?= Url::to(['/profile/account-number', 'id' => $item->id]) ?>"><b>особовий
                рахунок <?= $key + 1 ?>: </b><?= $item->account_number ?></a>&nbsp;
        <a href="<?= Url::to(['/profile/delete-number', 'id' => $item->id]) ?>">
            <img src="/img/close.jpeg" alt="" width="20">
        </a>

    </p>
<?php endforeach; ?>

<?php if(count($clientScore) < 5) { ?>
<div class="min-h-screen flex justify-left bg-gray-50 py-2 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div>
            <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">Додати особовий рахунок</h2>
            <div>
                <p class="mt-2 text-center text-sm leading-5 text-gray-600">Як вводити дані? Що робити якщо я не знаю
                    номер особового рахунку?</p>
                <p class="mt-2 text-center text-sm leading-5 text-gray-600">Для уточнення правильного номера особового
                    рахунку звертайтеся до відділу збуту КОМУНАЛЬНОГО ПІДПРИЄМСТВА
                    "СЄВЄРОДОНЕЦЬКВОДОКАНАЛ".</p>
                <p class="mt-2 text-center text-sm leading-5 text-gray-600">Копійки в сумі оплати вводяться через кому
                    без слів "грн" і т.ін. наприклад 65,54</p>
            </div>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'add-account-form',
            'class' => 'mt-8',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true
        ]); ?>
        <div class="rounded-md shadow-sm">
            <div>
                <?= $form->field($model, 'account_number')
                    ->textInput(['type' => 'number', 'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                    ->label('Особовий рахунок', ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                ?>
            </div>

            <div>
                <?= $form->field($model, 'act_number')
                    ->textInput(['type' => 'number', 'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                    ->label('Pеєстраційний номер акту', ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                ?>
            </div>

            <div>
                <?= $form->field($model, 'sum')
                    ->textInput(['class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                    ->label('Cумма', ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                ?>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" name="add-score-button" value="1" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                Додати
            </button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php } ?>
