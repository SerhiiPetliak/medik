<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Flu */

$this->title = 'Create Flu';
$this->params['breadcrumbs'][] = ['label' => 'Flus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
