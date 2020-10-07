<?php

/** @var \common\models\ScoreMetering $score */
/** @var \common\models\IndicationsAndCharges $indication */
/** @var \common\models\WaterMetering $metering */


//\yii\helpers\VarDumper::dump($indication->water_consumption,10,1);exit;
?>
Розділ “Рахунок”:
1. Передбачити формування рахунку та його друк. Вид рахунку додається.(Додаток №Б)
2. Врахувати можливість переходу на інші розділи особистого кабінету (дані особового рахунку, передача показань, нарахування та передані показаня, оплата).


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
</style>

<table class="iksweb">
    <tbody>
    <tr>
        <td style="  text-align: center;">РАХУНОК <br>
            за послуги з централізованого водопостачання та централізованого водовідведення
        </td>
    </tr>
    <tr>
        <td>Особовий рахунок № <?= $score->account_number ?></td>
    </tr>
    <tr>
        <td>№ акта <?= $score->act_number ?></td>
    </tr>
    <tr>
        <td>Споживач: П.І.Б. <?= $score->name_of_the_tenant ?> </td>
    </tr>
    <tr>
        <td>Адреса:<?= $score->address ?> </td>
    </tr>
    <tr>
        <td>Норма водоспоживання:<?= '---' ?></td>
    </tr>
    <tr>
        <td>Тариф:<?= $score->total_tariff ?></td>
    </tr>
    <tr>
        <td>Витрати води: <?= $indication->current_readings_first + $indication->current_readings_second - $indication->previous_readings_first - $indication->previous_readings_second  ?> м3, <br>
            витрати води на полив:  <?= $indication->current_readings_watering - $indication->previous_readings_watering  ?> м3
        </td>
    </tr>
    <tr>
        <td>Дата наступної повірки засобу(ів) обліку води: <?= Yii::$app->formatter->asDate($metering->verification_date, 'php:d.m.Y')  ?></td>
    </tr>
    <tr>
        <td>Наявність пільги: <?= $indication->privilege ?></td>
    </tr>
    <tr>
        <td>Заборгованість станом на <?= Yii::$app->formatter->asDate(('NOW'), 'php: d.m.Y') ?> р.: <?= $indication->debt_end_month?></td>
    </tr>
    <tr>
        <td>Нараховано:</td>
    </tr>
    <tr>
        <td>Пільга:</td>
    </tr>
    <tr>
        <td>Субсидія:</td>
    </tr>
    <tr>
        <td>Поточна оплата:</td>
    </tr>
    <tr>
        <td>Перерахунок:</td>
    </tr>
    <tr>
        <td>До оплати на ___._____.202_р. : ____________</td>
    </tr>
    <tr>
        <td>Всього до оплати:</td>
    </tr>
    </tbody>
</table>