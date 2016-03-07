<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChronicDiseases */

$this->title = 'Редагувати захворювання: ' . ' ' . $model->chronicDiseasesName;
$this->params['breadcrumbs'][] = ['label' => 'Захворювання', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->chronicDiseasesName, 'url' => ['view', 'id' => $model->chronicDiseasesId]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="chronic-diseases-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
