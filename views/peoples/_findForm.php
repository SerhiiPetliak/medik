<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Streets;

/* @var $this yii\web\View */
/* @var $model app\models\Peoples */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peoples-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo Html::label("Вулиця");
        echo Select2::widget([
            'model' => $model,
            'attribute' => 'streetId',
            'language' => 'uk',
            'data' => ArrayHelper::map(Streets::find()->all(),'streetId','streetName')
        ]);        
    ?>

    <?= $form->field($model, 'yearVal')->textInput()->label('Кількість років') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Пошук' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
