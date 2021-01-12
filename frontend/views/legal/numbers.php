<?php


use common\models\ConfigSite;
use yii\helpers\Html;
$settings = ConfigSite::getSettings(1);
?>


<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-3 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Договiр № <?= mb_strtoupper($num) ?>:</h3>
    </div>
</div>
    <br>
    <?php /** @var \common\models\Company $item */
    foreach ($model as $item): ?>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-3 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Номер засобу облiку води: <?= $item->accounting_number ?> </h3>
            </div>
            <div>
                <dl>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">Попереднi показання:</dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $item->previous_readings ?></dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">Поточні показання:</dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $item->current_readings ?></dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">Дата передачi показань:</dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            <?= $item->date_readings ? Yii::$app->formatter->asDate($item->date_readings, 'php: d.m.Y') : '' ?>
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">Дата повiрки:</dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            <?= $item->verification_date ? Yii::$app->formatter->asDate($item->verification_date, 'php: d.m.Y') : '' ?>
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="mt-4">
                <?php
                if ($settings->action_legal == 1) {

                    if (strtotime($item->date_readings) !== strtotime(date('Y-m-d'))):?>
                    <a type="button" href="<?= \yii\helpers\Url::to(['/legal/meter', 'num' => $num, 'acc' => $item->accounting_number]) ?>"
                       class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
                    >Передати показання</a>
                <?php endif; ?>
                <?php } else { ?>
                <p style="color:red;text-align:center">Проводяться технічні роботи.<br/>Передача показань тимчасово неможлива!</p>
                <?php } ?>
            </div>
        </div>
        <br>
    <?php endforeach; ?>
