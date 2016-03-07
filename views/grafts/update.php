<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Grafts */

$this->title = 'Редагувати щеплення: ' . ' ' . $model->graftName;
$this->params['breadcrumbs'][] = ['label' => 'Щеплення', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->graftName, 'url' => ['view', 'id' => $model->graftId]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="grafts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
