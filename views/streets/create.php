<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Streets */

$this->title = 'Create Streets';
$this->params['breadcrumbs'][] = ['label' => 'Streets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="streets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>