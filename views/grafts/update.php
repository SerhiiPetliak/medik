<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Grafts */

$this->title = 'Update Grafts: ' . ' ' . $model->graftId;
$this->params['breadcrumbs'][] = ['label' => 'Grafts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->graftId, 'url' => ['view', 'id' => $model->graftId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grafts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
