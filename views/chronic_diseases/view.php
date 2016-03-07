<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ChronicDiseases */

$this->title = $model->chronicDiseasesName;
$this->params['breadcrumbs'][] = ['label' => 'Захворювання', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chronic-diseases-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->chronicDiseasesId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->chronicDiseasesId], [
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
            'chronicDiseasesId',
            'chronicDiseasesName',
        ],
    ]) ?>

</div>
