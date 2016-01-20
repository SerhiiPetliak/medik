<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Peoples */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peoples-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'peopleFIO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peopleBirthday')->textInput() ?>

    <?= $form->field($model, 'peopleWorking')->textInput() ?>

    <?= $form->field($model, 'peopleFluNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peopleFluDate')->textInput() ?>

    <?= $form->field($model, 'peopleFluResult')->textInput() ?>

    <?= $form->field($model, 'peopleStreet')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
