<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Streets;
use app\models\Flu;
use app\models\Working;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Peoples */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peoples-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'peopleFIO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peopleBirthday')->widget(
        DatePicker::className(), [
            // inline too, not bad
            'inline' => false, 
            'language' => 'ua',
             // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>
    
    <?=
        $form->field($model, 'peopleWorking')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Working::find()->all(), 'workingId', 'workingName'),   
            'language' => 'uk',
            'pluginOptions' => [
                'allowClear' => true
            ],
            'options' => ['placeholder' => ' '],
        ])->label('Место работы');
    ?> 
    
    <?=
        $form->field($model, 'peopleFlu')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Flu::find()->all(), 'fLuId', 'fluName'),   
            'language' => 'uk',
            'pluginOptions' => [
                'allowClear' => true
            ],
            'options' => ['placeholder' => ' '],
        ])->label('Флюорография');
    ?> 
    
    <?=
        $form->field($model, 'peopleStreet')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Streets::find()->all(), 'streetId', 'streetName'),   
            'language' => 'uk',
            'pluginOptions' => [
                'allowClear' => true
            ],
            'options' => ['placeholder' => ' '],
        ])->label('Улица');
    ?> 


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
