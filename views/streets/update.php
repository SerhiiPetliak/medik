<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Streets */

$this->title = 'Редагувати: ' . ' ' . $model->streetName;
$this->params['breadcrumbs'][] = ['label' => 'Вулиці', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->streetName, 'url' => ['view', 'id' => $model->streetId]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="streets-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
