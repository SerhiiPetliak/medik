<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FluSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Flus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Flu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fluId',
            'fluNumber',
            'fluDate',
            'fluResult',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
