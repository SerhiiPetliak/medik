<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Working */

$this->title = 'Редагувати: ' . ' ' . $model->workingName;
$this->params['breadcrumbs'][] = ['label' => 'Місця роботи/навчання', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->workingName, 'url' => ['view', 'id' => $model->workingId]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="working-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
