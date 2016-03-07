<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeoplesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Друк';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peoples-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        //var_dump($dt);
    ?>
    <?= $this->render('_pfindForm', [
            'model' => $model
    ]) ?>

    

</div>
