<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeoplesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поиск по дате';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peoples-index">

    <h1 class="peoples-print"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <table class="table table-striped table-bordered">
        <tr>
            <td>ФИО</td>
            <td>Улица, дом</td>
            <td>Дата флюры</td>
        </tr>
    <?php    
        foreach($dt as $d){
            echo "
                <tr>
                    <td>".$d['peopleFIO']."</td>
                    <td>".$d['peopleStreet']." ".$d['peopleAdress']."</td>
                    <td>".date('d-m-Y', strtotime($d['peopleFluDate']))."</td>
                </tr>
            ";
        }
    ?>
    </table>
    <button class="button button-success peoples-print-button" onclick="window.print();">Print</button>
    

    

</div>
