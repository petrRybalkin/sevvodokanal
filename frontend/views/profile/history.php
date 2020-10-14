<?php

/** @var \common\models\WaterMetering $metering */
/** @var \common\models\ScoreMetering $score */
/** @var \common\models\IndicationsAndCharges $indication */

?>

Розділ “Нарахування та передані показання”:
1. Номер особового рахунку. <?= $score->account_number?>
2. П.І.Б. <?= $score->name_of_the_tenant?>
3. Адреса. <?= $score->address?>
4. Таблиця нарахувань


<style>
    table.iksweb{
        width: 100%;
        border-collapse:collapse;
        border-spacing:0;
        height: auto;
    }
    table.iksweb,table.iksweb td, table.iksweb th {
        border: 1px solid #595959;
    }
    table.iksweb td,table.iksweb th {
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

<?php if($score && $indication && $metering):?>
<table class="iksweb">
    <thead>
    <tr>
        <td rowspan="2">Місяць,
            рік</td>
        <td rowspan="2">Кіл.
            осіб</td>
        <td rowspan="2">Сальдо на початок місяця,
            грн</td>
        <td colspan="2">Лічильник №1</td>
        <td colspan="2">Лічильник №2</td>
        <td colspan="2">Лічильник №3</td>
        <td rowspan="2">Обсяг водо<br>споживання, м³</td>
        <td rowspan="2">Тариф,
            грн</td>
        <td rowspan="2">Нараховано,
            грн</td>
        <td rowspan="2">Корекція, грн</td>
        <td rowspan="2">Сплачено,
            грн</td>
        <td rowspan="2">Оплата субсидій, грн</td>
        <td rowspan="2">Оплата пільг, грн</td>
        <td rowspan="2">Сальдо на кінець місяця, грн</td>
        <td rowspan="2">Ознака нарах. середн. кубів, м³</td>
    </tr>
    <tr>
        <td>Попер. показання, м3</td>
        <td>Поточн. показання, м3</td>
        <td>Попередні показання, м3
        </td>
        <td>Поточн. показання, м3</td>
        <td>Попередні показання, м3
        </td>
        <td>Поточн. показання, м3</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($indication as $item):
        $str = substr($item->month_year,0,4) .'-'.substr($item->month_year,4,6).'-01';
        ?>
    <tr>

        <td><?= Yii::$app->formatter->asDate($str,'php:m.Y')?></td>
        <td><?= $item->count ?></td>
        <td> <?= $item->debt_begin_month?> </td>
        <td> <?= $item->previous_readings_first?></td>
        <td> <?= $item->current_readings_first?></td>
        <td> <?= $item->previous_readings_second?></td>
        <td><?= $item->current_readings_second?></td>
        <td> <?= $item->previous_readings_watering ?></td>
        <td><?= $item->current_readings_watering?></td>
        <td> <?= $item->current_readings_first + $item->current_readings_second
            - $item->previous_readings_first - $item->previous_readings_second?> </td>
        <td> <?= $item->total_tariff?></td>
        <td><?= $item->accruals?>
<!--            --><?//= (($item->current_readings_first +
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

        </td>
        <td><?= $item->correction ?></td>
        <td><?= $item->total_tariff?></td>
        <td><?= $item->total_tariff?></td>
        <td><?= $item->total_tariff?></td>
        <td><?= $item->debt_end_month?></td>
        <td><?= $item->medium_cubes?></td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
    <p style="color: red">
        Нема даних.
    </p>

<?php endif; ?>