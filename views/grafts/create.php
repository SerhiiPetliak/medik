<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Grafts */

$this->title = 'Додати щеплення';
$this->params['breadcrumbs'][] = ['label' => 'Щеплення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grafts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
