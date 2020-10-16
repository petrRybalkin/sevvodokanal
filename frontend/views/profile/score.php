<?php

/** @var \common\models\ScoreMetering $score */
/** @var \common\models\IndicationsAndCharges $indication */
/** @var \common\models\WaterMetering $metering */

/** @var Payment $payment */


use common\models\Payment;


?>
    Розділ “Рахунок”:

    <a href="<?= \yii\helpers\Url::to(['/profile/word', 'id' => Yii::$app->request->get('id')]) ?>">Скачать в ворд</a>
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

<?php if ($score && $indication && $metering): ?>

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
            <td>Норма водоспоживання:<?= $score->norm ?></td>
        </tr>
        <tr>
            <td>Тариф:<?= $score->total_tariff ?> грн.</td>
        </tr>
        <tr>
            <td>Витрати
                води: <?= $indication->current_readings_first + $indication->current_readings_second
                - $indication->previous_readings_first - $indication->previous_readings_second ?>
                м3, <br>
                витрати води на
                полив: <?= $indication->current_readings_watering - $indication->previous_readings_watering ?> м3
            </td>
        </tr>
        <tr>
            <td>Дата наступної повірки засобу(ів) обліку
                води: <?= Yii::$app->formatter->asDate($metering->verification_date, 'php:d.m.Y') ?></td>
        </tr>
        <tr>
            <td>Наявність пільги: <?= $indication->privilege == 0 ? 'Нi' : "Так" ?></td>
        </tr>
        <tr>
            <td>Заборгованість станом на
                <?= date("m.Y", strtotime(
                        substr($indication->month_year, 0, 4) . "-" . substr($indication->month_year, 4, 6) . '-01  first day of last month')
                );
                ?> р.: <?= $indication->debt_end_month ?> грн.
            </td>
        </tr>
        <tr>
            <td>Нараховано: <?= $indication->accruals ?> грн.</td>
        </tr>
        <tr>
            <td>
                Пільга: <?= $indication->privilege_unpaid !== 0 ? $indication->privilege_unpaid : Payment::getLgota($score->account_number, 2) ?>
                грн.
            </td>
        </tr>
        <tr>
            <td>Субсидія: <?= Payment::getLgota($score->account_number, 3) ?: '0 ' ?> грн.</td>
        </tr>
        <tr>
            <td>Поточна
                оплата: <?= Payment::getLgota($score->account_number, 1) ? Payment::getLgota($score->account_number, 1)->sum : '0' ?>
                грн.
            </td>
        </tr>
        <tr>
            <td>Перерахунок: <?= $indication->correction ?></td>
        </tr>
        <tr>
            <td>До оплати на <?= date('01.m.Y') ?> р. :
                <?= $indication->debt_end_month ?>
                грн.
            </td>
        </tr>
        <tr>
            <td>Всього до оплати: <?= $indication->debt_end_month ?> грн.</td>
        </tr>
        </tbody>
    </table>
<?php else: ?>
    <p style="color: red">
        Нема можливостi сформувати рахунок.
    </p>

<?php endif; ?>