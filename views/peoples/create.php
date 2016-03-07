<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Peoples */

$this->title = 'Додати';
$this->params['breadcrumbs'][] = ['label' => 'Люди', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peoples-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
