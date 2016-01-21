<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Streets;
use app\models\graftsPeoples;
use app\models\grafts;
use app\models\chronicDiseasesPeoples;
use app\models\chronicDiseases;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeoplesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peoples';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peoples-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Peoples', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'peopleId',
            'peopleFIO',
            'peopleBirthday',
            'peopleWorking0.workingName',
            'peopleFluNumber',
            // 'peopleFluDate',
            // 'peopleFluResult',
            // 'peopleFluTerm',
            [
                'attribute' => 'graft',
                'format' => 'raw',
                'value' => function($data){  
                    $r = "";
        
                   $findRes = graftsPeoples::find()->where(['peopleId' => $data->peopleId])->all(); 
                   
                    foreach($findRes as $f){
                        $graftName = Grafts::find()->where(['graftId' => $f['graftId']])->all();
                        $r .= '<span class="label label-primary">'.$graftName[0]['graftName'].'</span>&nbsp;';
                    }
                    
                    return $r;
                }
            ],
            [
                'attribute' => 'chronic',
                'format' => 'raw',
                'value' => function($data){  
                    $r = "";
        
                   $findRes = chronicDiseasesPeoples::find()->where(['peopleId' => $data->peopleId])->all(); 
                   
                    foreach($findRes as $f){
                        $chronicDiseasesName = chronicDiseases::find()->where(['chronicDiseasesId' => $f['chronicDiseasesId']])->all();
                        $r .= '<span class="label label-primary">'.$chronicDiseasesName[0]['chronicDiseasesName'].'</span>&nbsp;';
                    }
                    
                    return $r;
                }
            ],
            [
                'attribute' => 'peopleStreet',
                'value' => 'peopleStreet0.streetName',
                'filter' => ArrayHelper::map(Streets::find()->all(), 'streetId','streetName')
            ],
            'peopleAdress',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
     

</div>
