<?php


use frontend\widgets\SidebarProfileWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Вашi особовi рахунки:</h3>
        <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
            В одному особистому кабінеті можливе додавання до п`яти особових рахунків.
            Кожен особовий рахунок може містити до трьох лічильників.
        </p>
    </div>
<!--    <div>-->
<!--        <dl>-->
<!--            --><?php
//            /** @var \common\models\ScoreMetering $item */
//            if(empty($clientScore)) { ?>
<!--                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">-->
<!--                    <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">немає даних</p>-->
<!--                </div>-->
<!--            --><?php //} else {
//                foreach ($clientScore as $key => $item): ?>
<!--                    <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">-->
<!--                        <dt class="text-sm leading-5 font-medium text-gray-500">особовий рахунок --><?//= $key + 1 ?><!--:</dt>-->
<!--                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1 flex">-->
<!--                            <a href="<?//= Url::to(['/profile/account-number', 'id' => $item->id]) ?>"><?//= $item->account_number ?></a>-->
<!--                            <a href="<?//= Url::to(['/profile/delete-number', 'id' => $item->id]) ?>"><img src="/img/close.jpeg" alt="" width="20"></a>-->
<!--                        </dd>-->
<!--                    </div>-->
<!--                --><?php //endforeach; } ?>
<!--        </dl>-->
<!--    </div>-->
</div>
<br>

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Номер
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Статус
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            <th class="px-6 py-3 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                    <?php
                    /** @var \common\models\ScoreMetering $item */
                    if(empty($clientScore)) { ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">немає даних</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } else {
                        foreach ($clientScore as $key => $item): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                Особовий рахунок #<?= $key + 1 ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
<!--                                    <div class="text-sm leading-5 text-gray-900"><?//= $item->account_number ?></div>-->
                                    <div class="text-sm leading-5 text-gray-500"><?= $item->account_number ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                              Активный
                            </span>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <a href="<?= Url::to(['/profile/account-number', 'id' => $item->id]) ?>" class="text-indigo-600 hover:text-indigo-900">Смотреть</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <!--                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>-->
                                    <a href="<?= Url::to(['/profile/delete-number', 'id' => $item->id]) ?>" class="text-indigo-600 hover:text-indigo-900"><img src="/img/close.jpeg" alt="" width="20"></a>
                                </td>
                            </tr>
                        <?php endforeach; } ?>

                    <!-- More rows... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
