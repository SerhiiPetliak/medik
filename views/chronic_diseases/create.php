<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ChronicDiseases */

$this->title = 'Create Chronic Diseases';
$this->params['breadcrumbs'][] = ['label' => 'Chronic Diseases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chronic-diseases-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
