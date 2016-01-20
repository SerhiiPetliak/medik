<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Flu */

$this->title = 'Update Flu: ' . ' ' . $model->fluId;
$this->params['breadcrumbs'][] = ['label' => 'Flus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fluId, 'url' => ['view', 'id' => $model->fluId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="flu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
