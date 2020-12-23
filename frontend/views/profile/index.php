<?php


use frontend\widgets\SidebarProfileWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Особистий кабінет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-3 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Вашi особовi рахунки:</h3>
        <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
            В одному особистому кабінеті можливе додавання до п`яти особових рахунків.
            Кожен особовий рахунок може містити до трьох лічильників.
        </p>
    </div>
</div>
<br>

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Адреса</th>
                            <th class="px-6 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Номер</th>
                            <th class="px-6 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Статус</th>
                            <th class="px-6 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            <th class="px-6 py-2 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                    <?php
                    /** @var \common\models\ScoreMetering $item */
                    if(empty($clientScore)) { ?>
                        <tr>
                            <td class="px-6 py-2 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">немає даних</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } else {
                        foreach ($clientScore as $key => $item):?>
                            <tr>
                                <td class="px-6 py-2 whitespace-no-wrap text-center">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
<!--                                                Особовий рахунок #--><?//= $key + 1 ?>
                                                <?= $item->address ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center">
<!--                                    <div class="text-sm leading-5 text-gray-900"><?//= $item->account_number ?></div>-->
                                    <div class="text-sm leading-5 text-gray-500"><?= $item->account_number ?></div>
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                      Активний
                                    </span>
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <a href="<?= Url::to(['/profile/account-number', 'id' => $item->id]) ?>" class="text-indigo-600 hover:text-indigo-900">Відкрити</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-right text-sm leading-5 font-medium">
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
    <div class="accordion flex flex-col items-center justify-center mt-2">
        <!--  Panel 1  -->
        <div class="md:w-1/2 w-1/1">
            <input type="checkbox" name="panel" id="panel-1" class="hidden">
            <label for="panel-1" class="relative block bg-white p-4 shadow border-b border-grey mt-6 text-center text-2xl leading-9 font-bold text-gray-900">Додати особовий рахунок</label>

            <div class="flex justify-left bg-gray-50 py-2 px-4 sm:px-6 lg:px-8 accordion__content overflow-hidden bg-grey-lighter">
                <div class="max-w-md w-full">
                    <div>
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
                        <div class="block text-grey-darker text-sm font-bold mb-2 text-center">або</div>
                        <div>
                            <?= $form->field($model, 'sum')
                                ->textInput(['class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                                ->label('Cума', ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
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
        </div>
    </div>
<?php } ?>
