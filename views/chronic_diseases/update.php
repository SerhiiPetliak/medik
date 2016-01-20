<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChronicDiseases */

$this->title = 'Update Chronic Diseases: ' . ' ' . $model->chronicDiseasesId;
$this->params['breadcrumbs'][] = ['label' => 'Chronic Diseases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->chronicDiseasesId, 'url' => ['view', 'id' => $model->chronicDiseasesId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chronic-diseases-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
