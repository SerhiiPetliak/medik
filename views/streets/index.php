<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StreetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вулиці';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="streets-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'streetId',
            'streetName',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
