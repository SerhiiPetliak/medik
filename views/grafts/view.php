<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Grafts */

$this->title = $model->graftId;
$this->params['breadcrumbs'][] = ['label' => 'Grafts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grafts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->graftId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->graftId], [
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
            'graftId',
            'graftName',
        ],
    ]) ?>

</div>
