<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Working */

$this->title = $model->workingName;
$this->params['breadcrumbs'][] = ['label' => 'Місця роботи/навчання', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="working-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->workingId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->workingId], [
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
            'workingId',
            'workingName',
        ],
    ]) ?>

</div>
