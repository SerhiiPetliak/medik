<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;
use app\models\grafts;
use app\models\chronicDiseases;
use app\models\working;
use app\models\streets;


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
            'format' => 'dd-mm-yyyy'
        ]
]);?>

    <?php
        echo Html::label("Місце роботи/навчання");
        echo Select2::widget([
            'model' => $model,
            'attribute' => 'peopleWorking',
            'language' => 'ru',
            'data' => ArrayHelper::map(Working::find()->all(),'workingId','workingName')
        ]);        
    ?>

    <?= $form->field($model, 'peopleFluNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peopleFluDate')->widget(
    DatePicker::className(), [
        // inline too, not bad
        'inline' => false, 
        'language' => 'ua',
         // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy'
        ]
]);?>

    <?php
        echo Html::label("Результат флюорографії");
        echo Select2::widget([
            'model' => $model,
            'attribute' => 'peopleFluResult',
            'language' => 'ru',
            'data' => [0 => "Патологія", 1 => "Норма"]
        ]);        
    ?>

    <?= $form->field($model, 'peopleFluTerm')->hiddenInput()->label(false) ?>
    
        <?php
        echo Html::label("Вулиця");
        echo Select2::widget([
            'model' => $model,
            'attribute' => 'peopleStreet',
            'language' => 'ru',
            'data' => ArrayHelper::map(Streets::find()->all(),'streetId','streetName')
        ]);        
    ?>
    
    <?= $form->field($model, 'peopleAdress')->textInput() ?>
    
    <?php
        echo Html::label("Щеплення");
        echo Select2::widget([
            'model' => $model,
            'attribute' => 'graft',
            'language' => 'ru',
            'data' => ArrayHelper::map(Grafts::find()->all(),'graftId','graftName'),
            'options' => ['multiple' => true]
        ]);        
    ?>
    
    <?php
        echo Html::label("Хвороби");
        echo Select2::widget([
            'model' => $model,
            'attribute' => 'chronic',
            'language' => 'ru',
            'data' => ArrayHelper::map(chronicDiseases::find()->all(),'chronicDiseasesId','chronicDiseasesName'),
            'options' => ['multiple' => true]
        ]);        
    ?>

    <div class="form-group">
        <br>
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
