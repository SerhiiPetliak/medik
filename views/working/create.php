<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Working */

$this->title = 'Додати';
$this->params['breadcrumbs'][] = ['label' => 'Місця роботи/навчання', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="working-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
