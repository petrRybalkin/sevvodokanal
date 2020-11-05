<?php

/** @var \common\models\ScoreMetering $score */
/** @var \common\models\IndicationsAndCharges $indication */
/** @var \common\models\WaterMetering $metering */

/** @var Payment $payment */


use common\models\Payment;
?>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                РАХУНОК
            </h3>
            <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                за послуги з централізованого водопостачання та централізованого водовідведення.
            </p>
        </div>
        <div>
            <dl>
            <?php if ($score && $indication && $metering): ?>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Особовий рахунок №</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $score->account_number ?></dd>
                </div>
                <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">№ акта</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $score->act_number ?></dd>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Споживач: П.І.Б.</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $score->name_of_the_tenant ?></dd>
                </div>
                <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Адреса:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $score->address ?></dd>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Норма водоспоживання:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $score->norm ?></dd>
                </div>
                <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Тариф:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $score->total_tariff ?> грн.</dd>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Витрати води:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $indication->current_readings_first + $indication->current_readings_second
                        - $indication->previous_readings_first - $indication->previous_readings_second ?> м3, <br>
                        витрати води на полив: <?= $indication->current_readings_watering - $indication->previous_readings_watering ?> м3</dd>
                </div>
                <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Дата наступної повірки засобу(ів) обліку води: </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= Yii::$app->formatter->asDate($metering->verification_date, 'php:d.m.Y') ?></dd>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Наявність пільги:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $indication->privilege == 0 ? 'Нi' : "Так" ?></dd>
                </div>
                <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Заборгованість станом на
                        <?= date("m.Y", strtotime(substr($indication->month_year, 0, 4) . "-" . substr($indication->month_year, 4, 6) . '-01  first day of last month')); ?>р.:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $indication->debt_end_month ?> грн.</dd>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Нараховано:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $indication->accruals ?> грн.</dd>
                </div>
                <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Пільга:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $indication->privilege_unpaid !== 0 ? $indication->privilege_unpaid : Payment::getLgota($score->account_number, 2) ?> грн.</dd>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Субсидія:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= Payment::getLgota($score->account_number, 3) ?: '0 ' ?> грн.</dd>
                </div>
                <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Поточна оплата:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= Payment::getLgota($score->account_number, 1) ? Payment::getLgota($score->account_number, 1)->sum : '0' ?> грн.</dd>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Перерахунок:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $indication->correction ?></dd>
                </div>
                <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">До оплати на <?= date('01.m.Y') ?>р. :</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $indication->debt_end_month ?> грн.</dd>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">Всього до оплати:</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2"><?= $indication->debt_end_month ?> грн.</dd>
                </div>
                <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        &nbsp;
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul class="border border-gray-200 rounded-md">
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5">
                                <div class="w-0 flex-1 flex items-center">
                                    <!-- Heroicon name: paper-clip -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 flex-1 w-0 truncate">“Рахунок”</span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="<?= \yii\helpers\Url::to(['/profile/word', 'id' => Yii::$app->request->get('id')]) ?>" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">Скачать в ворд</a>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </div>
            <?php else: ?>
                <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">&nbsp;</dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2" style="color: red">Нема можливостi сформувати рахунок.</dd>
                </div>
            <?php endif; ?>
            </dl>
        </div>
    </div>
