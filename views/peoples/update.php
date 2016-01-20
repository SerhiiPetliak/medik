<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peoples */

$this->title = 'Update Peoples: ' . ' ' . $model->peopleId;
$this->params['breadcrumbs'][] = ['label' => 'Peoples', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->peopleId, 'url' => ['view', 'id' => $model->peopleId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peoples-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
