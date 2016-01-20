<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Working */

$this->title = 'Update Working: ' . ' ' . $model->workingId;
$this->params['breadcrumbs'][] = ['label' => 'Workings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->workingId, 'url' => ['view', 'id' => $model->workingId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="working-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
