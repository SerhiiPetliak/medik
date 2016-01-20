<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FluSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="flu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fluId') ?>

    <?= $form->field($model, 'fluNumber') ?>

    <?= $form->field($model, 'fluDate') ?>

    <?= $form->field($model, 'fluResult') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
