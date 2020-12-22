<?php

use common\models\IndicationsAndCharges;

$this->title = 'Оплата - Особистий кабінет';
$this->params['breadcrumbs'][] = $this->title;



$debt = IndicationsAndCharges::debtBeginMonth(
    $indication->account_number,
    date('Ym')
);

if ($debt > 0) {
    $sum = Yii::$app->formatter->asDecimal($debt,2);
} else {
    $sum = 100;
}
?>


<div class="mt-6">
    <a href='https://next.privat24.ua/payments/form/{"token" : "c43a7e21620e00a0a4697f5364f07eaf4jfdmqbf", "personalAccount":"0908405420290", "sum":"<?=$sum?>"}'>
    <button type="submit" name="add-meter-button" class="group relative flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
        Оплатить
    </button>
    </a>
</div>




