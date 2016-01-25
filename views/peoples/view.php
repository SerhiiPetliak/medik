<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Peoples;
use app\models\graftsPeoples;
use app\models\grafts;
use app\models\chronicDiseasesPeoples;
use app\models\chronicDiseases;

/* @var $this yii\web\View */
/* @var $model app\models\Peoples */

$this->title = $model->peopleFIO;
$this->params['breadcrumbs'][] = ['label' => 'Peoples', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peoples-view col-md-12">

    <div class="row">
        <div class="col-md-3">
            <div class="thumbnail">
                <img src="..." alt="...">
                <div class="caption">
                  <h3><?php echo $model->peopleFIO; ?></h3>
            <ul>  
                <li>
                    <?php 
                        $workingName = $model->getPeopleWorking0()->all();
                        echo $workingName[0]['workingName'];
                    ?>
                </li>
                <li>
                    <?php 
                        $streetName = $model->getPeopleStreet0()->all();
                        echo $streetName[0]['streetName']." ".$model->peopleAdress;
                    ?>
                </li>
                <li>
                    <?php 
                        echo date('d.m.Y', strtotime($model->peopleBirthday));
                    ?>
                </li>                
            </ul>
                  
                  <p>
        <?= Html::a('Update', ['update', 'id' => $model->peopleId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->peopleId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])?>
    </p>
                </div>
              </div>

        </div>
        <div class="col-md-3">
            Флюорография
            <ul>
                <li>
                    
                    <?php echo $model->peopleFluNumber; ?>
                </li>
                <li>
                    <?php echo $model->peopleFluDate; ?>
                </li>
                <li>
                    <?php
                        if($model->peopleFluResult == 0){
                            echo '<span class="label label-danger">Патология</span>';
                        }else{
                            echo '<span class="label label-success">Норма</span>';
                        }
                    ?>
                </li>
            </ul>
        </div>
        <div class="col-md-3">
            Прививки
            <ul>
            <?php
            
            $findRes = graftsPeoples::find()->where(['peopleId' => $model->peopleId])->all(); 
                   
                    foreach($findRes as $f){
                        $graftName = Grafts::find()->where(['graftId' => $f['graftId']])->all();
                        echo '<li>'.$graftName[0]['graftName'].'</li>';
                    }           
            ?>
            </ul>
        </div>
        <div class="col-md-3">
            Болезни
            <ul>
            <?php
            
            $findRes = chronicDiseasesPeoples::find()->where(['peopleId' => $model->peopleId])->all(); 
                   
                    foreach($findRes as $f){
                        $chronicDiseasesName = chronicDiseases::find()->where(['chronicDiseasesId' => $f['chronicDiseasesId']])->all();
                        echo '<li>'.$chronicDiseasesName[0]['chronicDiseasesName'].'</li>';
                    }          
            ?>
            </ul>
        </div>
    </div>
    <div class="row">
    
    </div>
    
    <h1><?php// Html::encode($this->title) ?></h1>

    <p>
        <?php //Html::a('Update', ['update', 'id' => $model->peopleId], ['class' => 'btn btn-primary']) ?>
        <?php /*Html::a('Delete', ['delete', 'id' => $model->peopleId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?php/* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'peopleId',
            'peopleFIO',
            [
                'label' => 'Дата рождения',
                'format' => 'raw',
                'value' => $birth,
            ],
            'peopleWorking0.workingName',
            'peopleFluNumber',
            [
                'label' => 'Дата флюорографии',
                'format' => 'raw',
                'value' => $flu, 
            ],
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
    ]) */?>
    
    

</div>
