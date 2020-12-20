<?php


use common\models\LegalNumContractForm;
use yii\bootstrap\ActiveForm;
?>


    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-3 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Передача показань юридичними особами (без проведення
                реєстрації)</h3>
            <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                Передача показань засобу(ів) обліку води для підприємств та юридичних осіб, власників об’єктів
                нерухомого майна
                (комерційного призначення), можливо з 1 до 10 числа поточного місяця (без проведення реєстрації).
            </p>
        </div>
    </div>
<?php
$dateThis = (new DateTime())->format('d');
if ((int)$dateThis < 11): ?>
    <div class="min-h-screen flex justify-center bg-gray-50 py-2 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div>
                <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">Передача показань</h2>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'legal-water-metering-form',
                'class' => 'mt-8',
                'enableClientValidation' => true,
            ]);
//            $model = new LegalNumContractForm();
            ?>
            <div class="rounded-md shadow-sm" id="append">
                <div>
                    <?= $form->field($model, 'num_contract')
                        ->textInput([
                            'tabindex'=>'-1', 'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border 
                                border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none 
                                focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5',
                        ])->label('Номер договору ', ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                    ?>
                </div>

            </div>

            <div class="mt-6">

                <button type="submit" name="num_button"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm
                                            leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none
                                             focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150
                                             ease-in-out">
                    Далi
                </button>
            </div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>

<?php else: ?>
        <p style="color: red">
            Передати показники засобiв облiку води можна тiльки з 1 по 10 число мiсяця.
        </p>
<?php endif; ?>