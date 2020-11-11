<?php

use common\models\Payment;
use frontend\widgets\SidebarProfileWidget;
use yii\helpers\Url; ?>

<!--
  Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
  Read the documentation to get started: https://tailwindui.com/documentation
-->
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Дані особового рахунку:</h3>
    </div>
    <?php
    /** @var \common\models\ScoreMetering $number */
    $ind = \common\models\IndicationsAndCharges::find()->where(['account_number' => $number->account_number])->orderBy(['id' => SORT_DESC])->one();
    $sum = $ind->accruals - (Payment::getLgota($number->account_number, 1) ? Payment::getLgota($number->account_number, 1)->sum : '0');
    ?>
    <div>
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">Особовий рахунок:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $number->account_number ?></dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">П.І.Б. власника:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $number->name_of_the_tenant ?></dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">Адреса:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $number->address ?></dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">Постачальник послуг:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"> КП «СЄВЄРОДОНЕЦЬКВОДОКАНАЛ»</dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">Поточна заборгованість:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><b><?= $ind->debt_end_month ?
                        "<i style='color: red'> $ind->debt_end_month грн</i>":
                        "<i style='color: green'> $sum грн</i>" ?></b></dd>
            </div>
        </dl>
    </div>
</div>
<br>
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Дані засобів обліку води:</h3>
    </div>
    <div>
        <dl>
        <?php
        /** @var \common\models\WaterMetering $vodomer */
        if(empty($number->vodomers)) { ?>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">немає даних</p>
            </div>
        <?php } else {
        foreach ($number->vodomers as $vodomer): ?>
            <?php
            if($vodomer->water_metering_first): ?>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Номер засобу обліку води №1</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $vodomer->water_metering_first ?></dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Попередні показання засоба обліку води: </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><b><?= $vodomer->previous_readings_first ?></b>,
                        дата їх передачі <b><?= Yii::$app->formatter->asDate($vodomer->date_previous_readings , 'php:d.m.Y' )?></b></dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">строк наступної повірки засоба обліку: </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <?= Yii::$app->formatter->asDate($vodomer->verification_date, 'php:d.m.Y' )?></dd>
                </div>
            <?php endif; ?>
            <?php
            if($vodomer->water_metering_second): ?>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500"><?= $vodomer->water_metering_second ? "Номер засобу обліку води №2" : '' ?></dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $vodomer->water_metering_second ?></dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Попередні показання засоба обліку води: </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><b><?= $vodomer->previous_readings_second ?></b>,
                        дата їх передачі <b><?=  Yii::$app->formatter->asDate( $vodomer->date_previous_readings , 'php:d.m.Y' )?></b></dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Cтрок наступної повірки засоба обліку: </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <?= Yii::$app->formatter->asDate($vodomer->verification_date, 'php:d.m.Y' )?></dd>
                </div>
            <?php endif; ?>
            <?php
            if($vodomer->watering_number): ?>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500"><?= $vodomer->watering_number ? "Номер засобу обліку води для поливу" : '' ?></dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $vodomer->watering_number ?></dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Попередні показання засоба обліку води: </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><b><?= $vodomer->previous_watering_readings ?></b>,
                        дата їх передачі <b><?= Yii::$app->formatter->asDate($vodomer->date_previous_readings , 'php:d.m.Y' )?></b></dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Cтрок наступної повірки засоба обліку: </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <?= Yii::$app->formatter->asDate($vodomer->verification_date, 'php:d.m.Y' )?></dd>
                </div>
            <?php endif; ?>
        <?php endforeach; } ?>
        </dl>
    </div>
</div>
<br>
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Додаткова інформація:</h3>
    </div>
    <div>
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- норма водоспоживання:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">0,250 м3/добу/1 особу,  18,30 грн/м3</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- вид житла:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?=$number->type_of_housing ?></dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- кількість зареєстрованих осіб:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $number->registered_persons ?></dd>
            </div>
        </dl>
    </div>
</div>
<br>
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Тариф:</h3>
    </div>
    <div>
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- вода + стоки:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    <?php

                    if ($number->tariff_for_water !== 0 && $number->tariff_for_stocks !== 0) {
                        echo 'вода + стоки' ;
                    } elseif ($number->tariff_for_stocks == 0) {
                        echo 'вода' ;
                    }

                    ?></dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- тариф на водоспоживання:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $number->tariff_for_water ?></dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- тариф на водовідведення:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $number->tariff_for_stocks ?></dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- сумарний тариф:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $number->total_tariff ?></dd>
            </div>
        </dl>
    </div>
</div>
