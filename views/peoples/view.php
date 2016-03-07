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
$this->params['breadcrumbs'][] = ['label' => 'Люди', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="peoples-view col-md-12">
	<!-- Левая колонка-->
    <div class="col-md-3">
    	<div class="thumbnail">
            
            <img src="http://medik/web/img/user.png" alt="...">
            
            <div class="caption">
                 
                <h3><?php echo $model->peopleFIO; ?></h3>
            
            	<ul class="people_view_list">  
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
			        <?= Html::a('Редагувати', ['update', 'id' => $model->peopleId], ['class' => 'btn btn-primary']) ?>
			        <?= Html::a('Видалити', ['delete', 'id' => $model->peopleId], [
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
<!-- Конец левой колонки -->
<!-- Правая колонка -->
    <div class="col-md-9">
    	<div class="row thumbnail">
    		<h3 class="fluTitle">Флюорография</h3>
                <div class="col-md-8">
                    
                    <ul class="people_view_list">
                        <li title='Номер'>  
                            <h4>
                                <?php echo "<span class='glyphicon glyphicon-tag' title='Номер'></span>&nbsp;".$model->peopleFluNumber; ?>
                            </h4>
                        </li>
                        <li title='Дата проведения'>
                            <h4>
                                <?php echo "<span class='glyphicon glyphicon-calendar'></span>&nbsp;".date('d.m.Y', strtotime($model->peopleBirthday)); ?>
                            </h4>
                        </li>                        
                    </ul>
                </div>
                <div class="col-md-2">
                    <?php
                        if($model->peopleFluResult == 0){
                            $fluClass = "flu_patology";
                        }else{
                            $fluClass = "flu_norm";
                        }
                    ?>
                    <div class="flu_res_div <?php echo ($fluClass == "flu_norm" ?  "flu_norm" : "flu_patology");?>">
                    <?php
                        if($model->peopleFluResult == 0){
                            echo '<span class="glyphicon glyphicon-exclamation-sign"></span><br/><span class="label label-danger">Патология</span>';
                        }else{
                            echo '<span class="glyphicon glyphicon-ok-sign"></span><br/><span class="label label-success">Норма</span>';
                        }
                    ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <?php
                        if($model->peopleFluTerm > 1 ){
                            $termClass = "flu_patology";
                        }else{
                            $termClass = "flu_norm";
                        }
                    ?>
                    <div class="flu_res_div <?php echo ($termClass == "flu_norm" ?  "flu_norm" : "flu_patology");?>">
                    <?php
                        if($model->peopleFluTerm > 1){
                            echo '<span class="glyphicon glyphicon-exclamation-sign"></span><br/><span class="label label-danger">'.$model->peopleFluTerm.' года</span>';
                        }else{
                            echo '<span class="glyphicon glyphicon-ok-sign"></span><br/><span class="label label-success">'.$model->peopleFluTerm.' год</span>';
                        }
                    ?>
                    </div>
                </div>
    	</div>

    	<div class="row thumbnail">
    		<div class="col-md-6 thumbnail nb">
				<div class="ills thumbnail">
					<h4>Болезни</h4>
				
				<ul class="people_view_list">
                <?php

                $findRes = graftsPeoples::find()->where(['peopleId' => $model->peopleId])->all(); 

                        foreach($findRes as $f){
                            $graftName = Grafts::find()->where(['graftId' => $f['graftId']])->all();
                            echo '<li><i class="glyphicon glyphicon-record"></i>&nbsp;'.$graftName[0]['graftName'].'</li>';
                        }           
                ?>
                </ul> 
                </div>
    		</div>
    		<div class="col-md-6 thumbnail nb">
				<div class="grafts thumbnail">
					<h4>Прививки</h4>
				<ul class="people_view_list">
                    <?php

                    $findRes = chronicDiseasesPeoples::find()->where(['peopleId' => $model->peopleId])->all(); 

                            foreach($findRes as $f){
                                $chronicDiseasesName = chronicDiseases::find()->where(['chronicDiseasesId' => $f['chronicDiseasesId']])->all();
                                echo '<li><i class="glyphicon glyphicon-record"></i>&nbsp;'.$chronicDiseasesName[0]['chronicDiseasesName'].'</li>';
                            }          
                    ?>
                    </ul>
				</div>
    		</div>
    	</div>
    		



    	</div>
    </div>
<!-- Конец правой колонки -->
</div>