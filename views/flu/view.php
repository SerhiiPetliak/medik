<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Flu */

$this->title = $model->fluId;
$this->params['breadcrumbs'][] = ['label' => 'Flus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->fluId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->fluId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fluId',
            'fluNumber',
            'fluDate',
            'fluResult',
        ],
    ]) ?>

</div>
