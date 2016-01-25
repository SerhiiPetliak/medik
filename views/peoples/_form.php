<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;
use app\models\grafts;
use app\models\chronicDiseases;


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

    <?= $form->field($model, 'peopleWorking')->textInput() ?>

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

    <?= $form->field($model, 'peopleFluResult')->textInput() ?>

    <?= $form->field($model, 'peopleFluTerm')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'peopleStreet')->textInput() ?>
    
    <?= $form->field($model, 'peopleAdress')->textInput() ?>
    
    <?php
        echo Html::label("Прививки");
        echo Select2::widget([
            'model' => $model,
            'attribute' => 'graft',
            'language' => 'ru',
            'data' => ArrayHelper::map(Grafts::find()->all(),'graftId','graftName'),
            'options' => ['multiple' => true]
        ]);        
    ?>
    
    <?php
        echo Html::label("Заболевания");
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
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
