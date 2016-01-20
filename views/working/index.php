<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="working-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Working', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'workingId',
            'workingName',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
