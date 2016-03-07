<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peoples */

$this->title = 'Редагувати: ' . ' ' . $model->peopleFIO;
$this->params['breadcrumbs'][] = ['label' => 'Люди', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->peopleFIO, 'url' => ['view', 'id' => $model->peopleId]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="peoples-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
