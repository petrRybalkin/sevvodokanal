<?php


use common\models\LegalForm;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha; ?>

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
//        $model = new LegalForm();
        ?>
        <div class="rounded-md shadow-sm" id="append">
            <div>
                <?= $form->field($model, 'num_contract')
                    ->textInput([
                            'value' => $num,'tabindex'=>'-1',
                        'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border 
                                border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none 
                                focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5',
                        'readonly'=>'readonly'
                    ])->label('Номер договору ', ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                ?>
            </div>


            <?php
            /** @var \common\models\Company $company */
            /** @var \common\models\Company $item */
            foreach ($company as $k => $item) :
                $num = $k+1;
                ?>

                <div>
                    <?= $form->field($model, "acc_num_$k")
                        ->textInput([
                           'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border 
                                border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none 
                                focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5',
                            'readonly'=>'readonly', 'value' => $item->accounting_number
                        ])->label("Номер засобу обліку води № $num", ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                    ?>
                </div>

                <div>
                    <?= $form->field($model,  "previous_readings_$k" )
                        ->textInput([
                           'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border 
                                border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none 
                                focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5',
                        ])->label("Показання засобу обліку води № $num", ['class' => 'block text-grey-darker text-sm font-bold mb-2'])
                    ?>
                </div>
            <?php endforeach; ?>

            <div>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'captchaAction' => 'legal/captcha',
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])->label('Введить код с зображення', [ 'class'=>'block text-grey-darker text-sm font-bold mb-2']) ?>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" name="meter-button" tabindex="-1"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm
                                            leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none
                                             focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150
                                             ease-in-out">
                Передати показання
            </button>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>
