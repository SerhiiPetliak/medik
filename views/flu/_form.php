<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Flu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="flu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fluNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fluDate')->textInput() ?>

    <?= $form->field($model, 'fluResult')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
