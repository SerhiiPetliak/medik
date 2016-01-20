<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Streets */

$this->title = 'Update Streets: ' . ' ' . $model->streetId;
$this->params['breadcrumbs'][] = ['label' => 'Streets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->streetId, 'url' => ['view', 'id' => $model->streetId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="streets-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
