<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Peoples */

$this->title = $model->peopleFIO;
$this->params['breadcrumbs'][] = ['label' => 'Peoples', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peoples-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->peopleId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->peopleId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'peopleId',
            'peopleFIO',
            'peopleBirthday',
            'peopleWorking0.workingName',
            'peopleFluNumber',
            'peopleFluDate',
            'peopleFluResult',
            //'peopleFluTerm',
            'peopleStreet0.streetName',
            'peopleAdress',
            [
                'label' => 'Прививки',
                'format' => 'raw',
                'value' => $graft,
            ],
            [
                'label' => 'Болезни',
                'format' => 'raw',
                'value' => $chronic,
            ],
        ],
    ]) ?>

</div>
