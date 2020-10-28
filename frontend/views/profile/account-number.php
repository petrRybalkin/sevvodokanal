<?php

use common\models\Payment;
use frontend\widgets\SidebarProfileWidget;
use yii\helpers\Url; ?>



<p>Дані особового рахунку</p>
<?php
/** @var \common\models\ScoreMetering $number */
$ind = \common\models\IndicationsAndCharges::find()->where(['account_number' => $number->account_number])->orderBy(['id' => SORT_DESC])->one();
$sum = $ind->accruals - (Payment::getLgota($number->account_number, 1) ? Payment::getLgota($number->account_number, 1)->sum : '0');
  ?>
    <p><b>особовий рахунок:  </b><?= $number->account_number ?>

    </p>
    <p><b> П.І.Б. власника:  </b><?= $number->name_of_the_tenant ?></p>
    <p><b>Адреса:  </b><?= $number->address ?></p>
    <p><b> Постачальник послуг:  </b> КП СЄВЄРОДОНЕЦЬКВОДОКАНАЛ</p>
    <p><b>Поточна заборгованість:<?= $ind->debt_end_month ?
                "<i style='color: red'> $ind->debt_end_month</i>":
                "<i style='color: green'> $sum </i>"
            ?></b></p>
    <p> Дані засобів обліку води: </p>
    <?php
    /** @var \common\models\WaterMetering $vodomer */
    foreach ($number->vodomers as $vodomer):  ?>
        <?php
        if($vodomer->water_metering_first):
            ?>
            <p><?=  "Номер засобу обліку води №1 $vodomer->water_metering_first"  ?> </p>
            <p>- попередні показання засоба обліку води <?= $vodomer->previous_readings_first ?>
                ,  дата їх передачі <?= $vodomer->date_previous_readings ?></p>
            <p>- строк наступної повірки засоба обліку <?= $vodomer->verification_date ?></p>

        <?php endif; ?>
        <?php
        if($vodomer->water_metering_second):
            ?>
            <p>  <?= $vodomer->water_metering_second ? "Номер засобу обліку води №2" : '' ?></p>
            <p>- попередні показання засоба обліку води  <?= $vodomer->previous_readings_second ?>
                ,  дата їх передачі<?= $vodomer->date_previous_readings ?></p>
            <p>- строк наступної повірки засоба обліку <?= $vodomer->verification_date ?></p>
        <?php endif; ?>
        <?php
        if($vodomer->watering_number):
            ?>
            <p> <?= $vodomer->watering_number ? "Номер засобу обліку води для поливу" : '' ?></p>
            <p>- попередні показання засоба обліку води  <?= $vodomer->previous_watering_readings ?>
                , дата їх передачі  <?= $vodomer->date_previous_readings ?></p>
            <p>- строк наступної повірки засоба обліку <?= $vodomer->verification_date ?></p>
        <?php endif; ?>
    <?php endforeach; ?>

<p><b> Додаткова інформація:</b></p>
<p><b> - норма водоспоживання — 0,250 м3/добу/1 особу,  18,30 грн/м3);</b></p>
<p> <b>- вид житла ;</b> <?=$number->type_of_housing ?></p>
<p> <b> - кількість зареєстрованих осіб.</b> <?= $number->registered_persons ?></p>
<p> <b>Тариф:</b></p>
<p> <b>- вода + стоки; </b><?= $number->tariff_for_stocks + $number->tariff_for_water?></p>
<p> <b>- тариф на водоспоживання; </b><?= $number->tariff_for_water ?> </p>
<p> <b>- тариф на водовідведення;</b> <?= $number->tariff_for_stocks ?></p>
<p> <b>- сумарний тариф. </b><?= $number->total_tariff ?></p>
