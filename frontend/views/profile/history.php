<?php

use common\models\IndicationsAndCharges;
use common\models\Payment;
use yii\widgets\LinkPager;

/** @var \common\models\WaterMetering $metering */
/** @var \common\models\ScoreMetering $score */
/** @var \common\models\IndicationsAndCharges $indication */

$this->title = 'Нарахування та передані показання - Особистий кабінет';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div>
        <dl>
            <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">Номер особового рахунку:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $score->account_number ?></dd>
            </div>
            <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">П.І.Б.:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $score->name_of_the_tenant ?></dd>
            </div>
            <div class="bg-gray-50 px-2 py-1 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                <dt class="text-sm leading-5 font-medium text-gray-500">Адреса:</dt>
                <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-1"><?= $score->address ?></dd>
            </div>
        </dl>
    </div>
</div>
<br>


<style>
    table.iksweb {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        height: auto;
    }

    table.iksweb, table.iksweb td, table.iksweb th {
        border: 1px solid #595959;
    }

    table.iksweb td, table.iksweb th {
        padding: 3px;
        width: 30px;
        height: 35px;
    }

    table.iksweb th {
        background: #347c99;
        color: #fff;
        font-weight: normal;
    }

    table.history-table td {
        border-right: 1px solid #e2e8f0;
        /*max-width: 76px !important;*/
    }

    table.history-table thead td {
        /*font-style: italic;*/
        text-transform: inherit;
        font-size: 0.65rem;
    }

    table.history-table thead td:not([colspan="2"]) {
        /*-webkit-writing-mode: vertical-rl; writing-mode:tb-rl;*/
        /*-webkit-transform: rotate(-90deg); transform: rotate(-90deg);*/
        /*max-width: 76px !important;*/
    }
</style>


<!--            --><?php //(($item->current_readings_first +
//                    $item->current_readings_second +
//                    $item->current_readings_watering -
//                    $item->previous_readings_first -
//                    $item->previous_readings_second -
//                    $item->previous_readings_watering) * $score->tariff_for_water) +
//            (($item->current_readings_first +
//                    $item->current_readings_second -
//                    $item->previous_readings_first -
//                    $item->previous_readings_second) * $score->tariff_for_stocks)
//            ?>
<div>
    <h3 class="mt-2 mb-4 text-center text-1xl leading-3 font-bold text-gray-800">Таблиця нарахувань</h3>
    <!--    <h3 class="text-lg leading-6 font-medium text-gray-900">Таблиця нарахувань</h3>-->
</div>
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <?php

                if ($indication && $score):?>
                    <table class="min-w-full divide-y divide-gray-200 history-table">
                        <thead>
                        <tr>
                            <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider border-red-400"
                                rowspan="2">Місяць, рік
                            </td>
                            <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                rowspan="2">Кіл. осіб
                            </td>
                            <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                rowspan="2">Сальдо&nbsp;на початок<br>місяця, грн
                            </td>
                            <?php
                            $metering = \common\models\WaterMetering::getWaterMeteringInAccNum($score->account_number);
                            if ($metering && $metering->water_metering_first): ?>
                                <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider gor"
                                    colspan="2">Лічильник №1
                                </td>
                            <?php endif; ?>
                            <?php if ($metering && $metering->water_metering_second): ?>
                                <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider gor"
                                    colspan="2">Лічильник №2
                                </td>
                            <?php endif; ?>
                            <?php if ($metering && $metering->watering_number): ?>
                                <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider gor"
                                    colspan="2">Лічильник №3
                                </td>
                            <?php endif; ?>
                            <?php if ($metering): ?>
                                <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    rowspan="2">Обсяг водо-<br>споживання,<br> м³
                                </td>
                            <?php endif; ?>
                            <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                rowspan="2">Тариф, грн
                            </td>
                            <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                rowspan="2">Нараховано, грн
                            </td>
                            <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                rowspan="2">Корекція, грн
                            </td>
                            <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                rowspan="2">Сплачено, грн
                            </td>
                            <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                rowspan="2">Оплата<br>субсидій, грн
                            </td>
                            <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                rowspan="2">Оплата<br>пільг, грн
                            </td>
                            <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                rowspan="2">Сальдо на кінець<br>місяця, грн
                            </td>
                            <?php if ($metering): ?>
                                <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    rowspan="2">Ознака&nbsp;<br>нарах. <br>середн.<br>&nbsp;кубів, м³
                                </td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <?php if ($metering && $metering->water_metering_first): ?>
                                <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Попередні показання,<br>м3
                                </td>
                                <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Поточн. показання,<br>м3
                                </td>
                            <?php endif; ?>
                            <?php if ($metering && $metering->water_metering_second): ?>
                                <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Попередні показання,<br>м3
                                </td>
                                <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Поточн. показання,<br>м3
                                </td>
                            <?php endif; ?>
                            <?php if ($metering && $metering->watering_number): ?>
                                <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Попередні показання,<br>м3
                                </td>
                                <td class="px-1 py-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Поточн. показання,<br>м3
                                </td>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                        <?php foreach ($indication as $item):
                            /** @var \common\models\IndicationsAndCharges $item */
                            $str = substr($item->month_year, 0, 4) . '-' . substr($item->month_year, 4, 6) . '-01';


                            ?>
                            <tr>
                                <td class="px-1 py-2 whitespace-no-wrap text-center"><?= Yii::$app->formatter->asDate($str, 'php:m.Y') ?></td>
                                <td class="px-1 py-2 whitespace-no-wrap text-center"><?= $item->count ?></td>
                                <td class="px-1 py-2 whitespace-no-wrap text-center"> <?php
                                    $date = new DateTime('now');
                                    if ($item->debt_end_month &&
                                        $item->month_year == $date->format('Ym')) {
                                        echo Yii::$app->formatter->asDecimal($item->debt_begin_month, 2);
                                    } else {
                                        echo Yii::$app->formatter->asDecimal($item->debt_begin_month, 2);
                                    }
                                    ?> </td>
                                <?php if ($metering && $metering->water_metering_first): ?>
                                    <td class="px-1 py-2 whitespace-no-wrap text-center"> <?= $item->previous_readings_first ?></td>
                                    <td class="px-1 py-2 whitespace-no-wrap text-center"> <?= $item->current_readings_first ?></td>
                                <?php endif; ?>
                                <?php if ($metering && $metering->water_metering_second): ?>
                                    <td class="px-1 py-2 whitespace-no-wrap text-center"> <?= $item->previous_readings_second ?></td>
                                    <td class="px-1 py-2 whitespace-no-wrap text-center"><?= $item->current_readings_second ?></td>
                                <?php endif; ?>
                                <?php if ($metering && $metering->watering_number): ?>
                                    <td class="px-1 py-2 whitespace-no-wrap text-center"> <?= $item->previous_readings_watering ?></td>
                                    <td class="px-1 py-2 whitespace-no-wrap text-center"><?= $item->current_readings_watering ?></td>
                                <?php endif; ?>
                                <?php if($metering->water_metering_first || $metering->water_metering_second):?>
                                <td class="px-1 py-2 whitespace-no-wrap text-center">
                                    <!--   Обсяг водоспоживання розраховується по формулі: (th1+th2+tp-ph1-ph2-pp)-->
<!--ееш один столбик для поливного сч   -->
                                    <?php
                                    $on = $item->current_readings_first + $item->current_readings_second
                                        - $item->previous_readings_first - $item->previous_readings_second;

                                    if ($on == round($on)) {
                                        $ov =  Yii::$app->formatter->asDecimal($on, 0);
                                    }else{
                                        $ov =  Yii::$app->formatter->asDecimal($on, 3);
                                    }
                                    ?>

                                    <?php
                                    if(strtotime($item->month_year) === strtotime(date('Ym'))){

                                        echo $item->current_readings_first + $item->current_readings_second + $item->current_readings_watering == 0
                                            ? 0
                                            : $ov;
                                    }else{

                                        if ($item->water_consumption === round($item->water_consumption)) {
                                            $item->water_consumption =  Yii::$app->formatter->asDecimal($item->water_consumption, 0);
                                        }else{
                                            $item->water_consumption =  Yii::$app->formatter->asDecimal($item->water_consumption, 3);
                                        }


                                        echo $item->water_consumption;                                    }
                                    ?>

                                </td>
                                <?php endif;?>
                                <?php
                                if($metering->watering_number):?>
                                    <td class="px-1 py-2 whitespace-no-wrap text-center">
                                        <!--   Обсяг водоспоживання розраховується по формулі: (tp-pp)-->
                                        <!--ееш один столбик для поливного сч-->
                                        <?php
                                        $on = $item->current_readings_watering - $item->previous_readings_watering;

                                        if ($on == round($on)) {
                                            $ov =  Yii::$app->formatter->asDecimal($on, 0);
                                        }else{
                                            $ov =  Yii::$app->formatter->asDecimal($on, 3);
                                        }

                                        if(strtotime($item->month_year) === strtotime(date('Ym'))){
                                            echo $item->current_readings_watering ? $ov : 0;
                                        }else{

                                              if ($item->watering_consumption == round($item->watering_consumption)) {
                                                  $iWC =  Yii::$app->formatter->asDecimal($item->watering_consumption, 0);
                                              }else{
                                                  $iWC =  Yii::$app->formatter->asDecimal($item->watering_consumption, 3);
                                              }
                                            echo $iWC;

                                        }
                                        ?>


                                    </td>
                                <?php endif;?>
                                <td class="px-1 py-2 whitespace-no-wrap text-center">
                                    <?=  Yii::$app->formatter->asDecimal($item->total_tariff, 3) ?></td>
                                <td class="px-1 py-2 whitespace-no-wrap text-center">
                                    <!--   Нарахування розраховується по формулі:-->
                                    <!--  Поле nac “-” поле lgota-->
<!--                                    в тек мес  (при передаче показаний я считаю начисления по формуле-->

                                    <?= Yii::$app->formatter->asDecimal($item->accruals - $item->privilege_unpaid, 2) ?></td>
                                <td class="px-1 py-2 whitespace-no-wrap text-center">
                                    <!--   корекция-->
                                    <?= Yii::$app->formatter->asDecimal(($item->correction ?: 0), 2) ?></td>
                                <td class="px-1 py-2 whitespace-no-wrap text-center">
                                    <!--  Сплачено розраховується по формулі (дані беруться з довідника оплати):-->
                                    <!-- (поля з ознакою “1”)+(поля з ознакою “0”)-->

                                    <?= Yii::$app->formatter->asDecimal(
                                        (Payment::getLgota($score->account_number, 1, $str, true)
                                            ? Payment::getLgota($score->account_number, 1, $str, true)['sumAll'] : 0) +
                                        (Payment::getLgota($score->account_number, 0, $str, true)
                                            ? Payment::getLgota($score->account_number, 0, $str, true)['sumAll']
                                            : 0)
                                        , 2)
                                    ?></td>
                                <td class="px-1 py-2 whitespace-no-wrap text-center">
                                    <!--   Оплата субсидій (дані беруться з довідника оплати):  поля з ознакою “3”-->
                                    <?php
                                    $subs = Payment::getLgota($score->account_number, 3, $str, true)
                                        ? Payment::getLgota($score->account_number, 3, $str, true)['sumAll']
                                        : 0;
                                    ?>
                                    <?= Yii::$app->formatter->asDecimal(($subs !== null ? $subs : 0), 2) ?>
                                </td>
                                <td class="px-1 py-2 whitespace-no-wrap text-center">

                                    <!--      Оплата пільг (дані беруться з довідника оплати):  поля з ознакою “2”-->
                                    <?php

                                    if($item->privilege_unpaid > 0){
                                        $lgota = $item->privilege_unpaid;
                                    }else{
                                        $lgota = Payment::getLgota($score->account_number, 2, $str, true)
                                            ? Payment::getLgota($score->account_number, 2, $str, true)['sumAll']
                                            : 0;
                                    }

                                    ?>
                                    <?= Yii::$app->formatter->asDecimal($lgota?:0, 2)

                                    ?></td>
                                <td class="px-1 py-2 whitespace-no-wrap text-center">
                                    <!--   Сальдо на кінець місяця, грн-->

                                    <?php $debt = IndicationsAndCharges::debtBeginMonth(
                                        $item->account_number,
                                        $item->month_year
                                    ); ?>
                                    <?= Yii::$app->formatter->asDecimal($debt->debt_end_month ?: 0, 2) ?>

<!--                                    --><?//=  Yii::$app->formatter->asDecimal($item->debt_end_month, 2) ?><!--</td>-->
                                <?php if($metering):?>
                                <td class="px-1 py-2 whitespace-no-wrap text-center"><?= $item->medium_cubes ?></td>
                                <?php endif;?>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>

                    </table>
                <?php else: ?>
                    <p style="color: red">
                        Нема даних.
                    </p>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?= LinkPager::widget([
    'pagination' => $pages,
]);

?>

