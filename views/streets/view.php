<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Streets */

$this->title = $model->streetName;
$this->params['breadcrumbs'][] = ['label' => 'Вулиці', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="streets-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->streetId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->streetId], [
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
            'streetId',
            'streetName',
        ],
    ]) ?>

</div>
