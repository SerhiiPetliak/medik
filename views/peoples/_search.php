<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PeoplesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peoples-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'peopleId') ?>

    <?= $form->field($model, 'peopleFIO') ?>

    <?= $form->field($model, 'peopleBirthday') ?>

    <?= $form->field($model, 'peopleWorking') ?>

    <?= $form->field($model, 'peopleFluNumber') ?>

    <?php // echo $form->field($model, 'peopleFluDate') ?>

    <?php // echo $form->field($model, 'peopleFluResult') ?>

    <?php // echo $form->field($model, 'peopleFluTerm') ?>

    <?php // echo $form->field($model, 'peopleStreet') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
