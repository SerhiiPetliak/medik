<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Streets;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeoplesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Печать информации о людях';
$this->params['breadcrumbs'][] = $this->title;

function findStreet($id){
    
    $streetName = Streets::find()->where(['streetId' => $id])->one();
    
    return $streetName['streetName'];    
}

?>
<div class="peoples-index">

    <h1 class="peoples-print"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <table class="table table-striped table-bordered">
        <tr>
            <td><strong>ФИО</strong></td>
            <td><strong>Дата рождения</strong></td>
            <td><strong>Адрес</strong></td>
        </tr>
    <?php    
        foreach($dt as $d){
            echo "
                <tr>
                    <td>".$d['peopleFIO']."</td>
                    <td>".date('d-m-Y', strtotime($d['peopleBirthday']))."</td>
                    <td>".findStreet($d['peopleStreet'])." ".$d['peopleAdress']."</td>
                </tr>
            ";
        }
    ?>
    </table>
    <button class="button button-success peoples-print-button" onclick="window.print();">Print</button>
    

    

</div>
