<?php

/** @var \common\models\ScoreMetering $score */
/** @var \common\models\IndicationsAndCharges $indication */
/** @var \common\models\WaterMetering $metering */

/** @var Payment $payment */


use common\models\IndicationsAndCharges;
use common\models\Payment;

$this->title = 'РАХУНОК - Особистий кабінет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-3 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            РАХУНОК
        </h3>
        <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
            за послуги з централізованого водопостачання та централізованого водовідведення.
        </p>
    </div>
    <div>
        <dl>
            <?php if ($score && $indication): ?>
                <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Особовий рахунок №</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $score->account_number ?></dd>
                </div>
                <?php
                if ($metering):?>
                    <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">№ акта</dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $score->act_number ?></dd>
                    </div>
                <?php endif; ?>
                <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Споживач: П.І.Б.</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $score->name_of_the_tenant ?></dd>
                </div>
                <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Адреса:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $score->address ?></dd>
                </div>
                <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Норма водоспоживання:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $score->norm ?></dd>
                </div>
                <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Тариф:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <?= Yii::$app->formatter->asDecimal($score->total_tariff, 3) ?>
                        грн.
                    </dd>
                </div>
                <?php if ($metering): ?>
                    <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">Витрати води:</dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">

<!--                            данные из табл нач и показ за предыдуш мес water_consumption -->
                            <?php
                            $date = new DateTime('now');
                            if ($indication->month_year == $date->format('Ym')){
                                echo ($indication->previous_readings_first - $indication->previous_readings_second) -
                                    ($indication->current_readings_first + $indication->current_readings_second);
                            }else {
                                echo ($indication->previous_readings_first - $indication->previous_readings_second) -
                                    ($indication->current_readings_first + $indication->current_readings_second);
                            }

                            ?>
                            м3, <br>
                            витрати води на
                            полив:
<!--                            данные из табл нач и показ за предыдуш мес watering_consumption -->

                            <?= $indication->current_readings_watering - $indication->previous_readings_watering ?>
                            м3
                        </dd>
                    </div>
                    <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm leading-5 font-medium text-gray-500">Дата наступної повірки засобу(ів) обліку
                            води:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            <?= $metering ? Yii::$app->formatter->asDate($metering->verification_date, 'php:d.m.Y') : '' ?></dd>
                    </div>
                <?php endif; ?>
                <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Наявність пільги:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <?= $indication->privilege == 0 ? 'Нi' : "Так" ?></dd>
                </div>
                <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Заборгованість станом на
                        <?= date("d.m.Y", strtotime('first day of last month')); ?>р.:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
<!--                        Заборгованість станом на-->
                        <?php
                        $d = common\models\IndicationsAndCharges::debtBeginMonth($indication->account_number,
                            date("d.m.Y", strtotime('first day of last month')));

                        ?>
                        <?= Yii::$app->formatter->asDecimal($d ? $d->debt_begin_month : 0, 2) ?>
                        грн.
                    </dd>
                </div>
                <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Нараховано:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
<!--                        Нарахування (дані беруться з довідника нарахувань поле nac).-->
                        <?= Yii::$app->formatter->asDecimal($indication->accruals, 2) ?>
                        грн.
                    </dd>
                </div>
                <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Пільга:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
<!--                        Пільга (дані беруться з довідника оплати з ознакою “2”. У випадку,
 коли в довіднику нарахувань поле lgota<>0, то поле пільга заповнюється з довідника нарахувань з поля lgota).-->
                        <?php
                        $lgota = $indication->privilege_unpaid !== 0
                            ? $indication->privilege_unpaid
                            : Payment::getLgota($score->account_number, 2, null, true)['sumAll'] ;
                        ?>
                        <?= Yii::$app->formatter->asDecimal($lgota ?:0, 2) ?>
                        грн.
                    </dd>
                </div>
                <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Субсидія:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
<!--                        Субсидія (дані беруться з довідника оплати з ознакою “3”)-->
                        <?php
                        $subs = Payment::getLgota($score->account_number, 3,null, true)
                            ? Payment::getLgota($score->account_number, 3,null, true)['sumAll']
                            : 0;
                        ?>
                        <?= Yii::$app->formatter->asDecimal($subs?:0, 2) ?>
                        грн.
                    </dd>
                </div>
                <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Поточна оплата:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <?php
                        $opl1 = Payment::getLgota($score->account_number, 1, null,true)
                            ? Payment::getLgota($score->account_number, 1,null,true)['sumAll']
                            : 0;

                         $opl0 = Payment::getLgota($score->account_number, 0, null,true)
                             ? Payment::getLgota($score->account_number, 0,null,true)['sumAll']
                             : 0
                        ?>

                        <?= Yii::$app->formatter->asDecimal($opl1+$opl0, 2) ?>
                        грн.
                    </dd>
                </div>
                <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Перерахунок:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <?= Yii::$app->formatter->asDecimal($indication->correction?:0, 2) ?></dd>
                </div>
                <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">До оплати на
                        <?= date('01.m.Y') ?>р. :</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <?= Yii::$app->formatter->asDecimal($indication->debt_end_month?:0, 2) ?>
                        грн.
                    </dd>
                </div>
                <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Всього до оплати:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <?= Yii::$app->formatter->asDecimal($indication->debt_end_month?:0, 2) ?>
                        грн.
                    </dd>
                </div>
                <div class="bg-white px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        &nbsp;
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul class="border border-gray-200 rounded-md">
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5">
                                <div class="w-0 flex-1 flex items-center">
                                    <!-- Heroicon name: paper-clip -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    <span class="ml-2 flex-1 w-0 truncate">“Рахунок”</span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="<?= \yii\helpers\Url::to(['/profile/word', 'id' => Yii::$app->request->get('id')]) ?>"
                                       class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">Завантажити
                                        в Word</a>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </div>
            <?php else: ?>
                <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">&nbsp;</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2" style="color: red">Нема
                        можливостi сформувати рахунок.
                    </dd>
                </div>
            <?php endif; ?>
        </dl>
    </div>
</div>
