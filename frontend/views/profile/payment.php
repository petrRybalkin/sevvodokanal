<?php

use common\models\IndicationsAndCharges;

$this->title = 'Оплата - Особистий кабінет';
$this->params['breadcrumbs'][] = $this->title;


$date = new DateTime('now');
$debt = IndicationsAndCharges::debtBeginMonth(
    $indication->account_number,
//    $indication->month_year
    $date->format('Ym')
);
if ($debt && $debt->debt_end_month > 0) {
    $sum = Yii::$app->formatter->asDecimal($debt->debt_end_month,2);
} else {
    $sum = 100;
}
?>


<div class="mt-6">
    <a href='https://next.privat24.ua/payments/form/{"token" : "c43a7e21620e00a0a4697f5364f07eaf4jfdmqbf", "personalAccount":"<?=$indication->account_number?>", "sum":"<?=$sum?>"}'>
    <button type="submit" name="add-meter-button" class="group relative flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
        Оплатити
    </button>
    </a>
</div>




