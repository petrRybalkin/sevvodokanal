<?php

use common\models\Payment;

/** @var \common\models\IndicationsAndCharges $ind */

$this->title = 'Дані особового рахунку - Особистий кабінет';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-3 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Дані особового рахунку:</h3>
    </div>
    <?php
    /** @var \common\models\ScoreMetering $number */
    $date = new DateTime('now');
    $debt = 0;
    $ind = \common\models\IndicationsAndCharges::find()
        ->where(['account_number' => $number->account_number])
        ->orderBy(['month_year' => SORT_DESC])->one();

    if ($ind) {
        if ($ind->month_year == $date->modify('-1 month')->format('Ym')) {
            $payThisMonth = Payment::getLgota($number->account_number, 1, $date->modify('-1 month')
                ->format('Y-m-d'), true);
//        (если человек передал показания на сайте то
            if ($number->tariff_for_water > 0 && $number->tariff_for_stocks > 0) {
                // (khv+kpv)*tarifv+(khv*tarifst)если есть вода и стоки,
                $s = ($ind->water_consumption + $ind->watering_consumption) * $number->tariff_for_water +
                    ($ind->water_consumption * $number->tariff_for_stocks);
            } elseif ($number->tariff_for_stocks == 0) {
                // или (khv+kpv)*tarifv) если только вода)
                $s = ($ind->water_consumption + $ind->watering_consumption) * $number->tariff_for_water;
            }

// -(минус) оплата в текущем месяце.
            $debt = $s - $payThisMonth['sumAll'];
        } else {
//        задолженность на конец месяца+начисления
            $debt = $ind->debt_end_month + $ind->accruals;

        }

    }

    ?>
    <div>
        <dl>
            <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">Особовий рахунок:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $number->account_number ?></dd>
            </div>
            <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">П.І.Б. власника:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $number->name_of_the_tenant ?></dd>
            </div>
            <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">Адреса:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $number->address ?></dd>
            </div>
            <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">Постачальник послуг:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"> КП «СЄВЄРОДОНЕЦЬКВОДОКАНАЛ»</dd>
            </div>
            <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">Поточна заборгованість:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><b>
                        <?= Yii::$app->formatter->asDecimal(
                                ($ind->synchronization > 0
                                    ? $ind->debt_end_month
                                    : $ind->debt_begin_month
                                ), 2)   . " грн"; ?></b></dd>
            </div>
        </dl>
    </div>
</div>
<br>
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <!--    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">-->
    <!--        <h3 class="text-lg leading-6 font-medium text-gray-900">Дані засобів обліку води:</h3>-->
    <!--    </div>-->
    <div>
        <dl>
            <?php
            /** @var \common\models\WaterMetering $vodomer */
            if (empty($number->vodomers)) { ?>
                <div class="bg-gray-50 px-2 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">Засоби обліку води відсутні</p>
                </div>
            <?php } else {
                foreach ($number->vodomers as $vodomer): ?>
                    <?php
                    if ($vodomer->water_metering_first): ?>
                        <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">Номер засобу обліку води №1</dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $vodomer->water_metering_first ?></dd>
                        </div>
                        <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">Попередні показання засоба обліку
                                води:
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
<!--                                если в табл нач показ тек показ 0 то вывожу из водомеров, если не 0 то вывожу из нач показ. +-->
                                <b>
                                    <?= $ind->current_readings_first > 0 ? $ind->current_readings_first : $vodomer->previous_readings_first ?></b>,
                                дата їх передачі
                                <b><?= Yii::$app->formatter->asDate($vodomer->date_previous_readings, 'php:d.m.Y') ?></b>
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">строк наступної повірки засоба
                                обліку:
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                <?= Yii::$app->formatter->asDate($vodomer->verification_date, 'php:d.m.Y') ?></dd>
                        </div>
                    <?php endif; ?>
                    <?php
                    if ($vodomer->water_metering_second): ?>
                        <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                <?= $vodomer->water_metering_second ? "Номер засобу обліку води №2" : '' ?></dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $vodomer->water_metering_second ?></dd>
                        </div>
                        <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">Попередні показання засоба обліку
                                води:
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                <b><?=
                                    $ind->current_readings_second > 0 ? $ind->current_readings_second : $vodomer->previous_readings_second

                                   ?></b>,
                                дата їх передачі
                                <b><?= Yii::$app->formatter->asDate($vodomer->date_previous_readings, 'php:d.m.Y') ?></b>
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">Cтрок наступної повірки засоба
                                обліку:
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                <?= Yii::$app->formatter->asDate($vodomer->verification_date, 'php:d.m.Y') ?></dd>
                        </div>
                    <?php endif; ?>
                    <?php
                    if ($vodomer->watering_number): ?>
                        <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                <?= $vodomer->watering_number ? "Номер засобу обліку води для поливу" : '' ?></dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $vodomer->watering_number ?></dd>
                        </div>
                        <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">Попередні показання засоба обліку
                                води:
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                <b><?=
                                    $ind->current_readings_watering > 0 ? $ind->current_readings_watering : $vodomer->previous_watering_readings

                                   ?></b>,
                                дата їх передачі
                                <b><?= Yii::$app->formatter->asDate($vodomer->date_previous_readings, 'php:d.m.Y') ?></b>
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm leading-5 font-medium text-gray-500">Cтрок наступної повірки засоба
                                обліку:
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                <?= Yii::$app->formatter->asDate($vodomer->verification_date, 'php:d.m.Y') ?></dd>
                        </div>
                    <?php endif; ?>
                <?php endforeach;
            } ?>
        </dl>
    </div>
</div>
<br>
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-3 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Додаткова інформація:</h3>
    </div>
    <div>
        <dl>
            <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- норма водоспоживання:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"> <?= $number->norm ?> </dd>
            </div>
            <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- вид житла:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $number->type_of_housing ?></dd>
            </div>
            <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- кількість зареєстрованих осіб:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $number->registered_persons ?></dd>
            </div>
        </dl>
    </div>
</div>
<br>
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-3 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Тариф:</h3>
    </div>
    <div>
        <dl>
            <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">-послуги:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    <?php
                    if ($number->tariff_for_water > 0 && $number->tariff_for_stocks > 0) {
                        echo 'вода + стоки';
                    } elseif ($number->tariff_for_stocks == 0) {
                        echo 'вода';
                    }

                    ?></dd>
            </div>
            <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- тариф на водоспоживання:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    <?= Yii::$app->formatter->asDecimal($number->tariff_for_water, 3) ?></dd>
            </div>
            <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- тариф на водовідведення:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    <?= Yii::$app->formatter->asDecimal($number->tariff_for_stocks, 3) ?></dd>
            </div>
            <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">- сумарний тариф:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    <?= Yii::$app->formatter->asDecimal($number->total_tariff, 3) ?></dd>
            </div>
        </dl>
    </div>
</div>
