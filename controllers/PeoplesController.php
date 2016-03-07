<?php

namespace app\controllers;

use Yii;
use app\models\Peoples;
use app\models\PeoplesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\graftsPeoples;
use app\models\chronicDiseasesPeoples;
use app\models\grafts;
use app\models\chronicDiseases;
use app\models\streets;
use app\models\working;

/**
 * PeoplesController implements the CRUD actions for Peoples model.
 */
class PeoplesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Peoples models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PeoplesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Peoples model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $r = "";
        
        $findRes = graftsPeoples::find()->where(['peopleId' => $id])->all(); 
                   
        foreach($findRes as $f){
            $graftName = Grafts::find()->where(['graftId' => $f['graftId']])->all();
            $r .= '<span class="label label-primary">'.$graftName[0]['graftName'].'</span>&nbsp;';
        }
        
        $r2 = "";
        
        $findRes = chronicDiseasesPeoples::find()->where(['peopleId' => $id])->all(); 
        
        $birth = date('d.m.Y', strtotime($model->peopleBirthday));
        $flu = date('d.m.Y', strtotime($model->peopleFluDate));
                   
        foreach($findRes as $f){
            $chronicDiseasesName = chronicDiseases::find()->where(['chronicDiseasesId' => $f['chronicDiseasesId']])->all();
            $r2 .= '<span class="label label-primary">'.$chronicDiseasesName[0]['chronicDiseasesName'].'</span>&nbsp;';
        }
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'graft' => $r,
            'chronic' => $r2,
            'birth' => $birth,
            'flu' => $flu,
        ]);
    }

    /**
     * Creates a new Peoples model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Peoples();

        if ($model->load(Yii::$app->request->post())) {
            
            $birth = date('Y-m-d', strtotime($model->peopleBirthday));
            $fluDate = date('Y-m-d', strtotime($model->peopleFluDate));
            
            $model->peopleBirthday = $birth;
            $model->peopleFluDate = $fluDate;         
                    
            
            $currentYear = date('Y');
            $model->peopleFluTerm = $currentYear - date('Y', strtotime($model->peopleFluDate)); //Вычисляю разницу текущего года и даты флюры
            $model->save();
            
            foreach($model->graft as $m){
                $gm = new graftsPeoples;
                    $gm->peopleId = $model->peopleId;
                    $gm->graftId = $m;
                $gm->insert();
            }
            foreach($model->chronic as $c){
                $cr = new chronicDiseasesPeoples;
                    $cr->peopleId = $model->peopleId;
                    $cr->chronicDiseasesId = $c;
                $cr->insert();
            }
            return $this->redirect(['view', 'id' => $model->peopleId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Peoples model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $birth = date('Y-m-d', strtotime($model->peopleBirthday));
            $fluDate = date('Y-m-d', strtotime($model->peopleFluDate));
            
            $model->peopleBirthday = $birth;
            $model->peopleFluDate = $fluDate; 
            
            $currentYear = date('Y');
            $model->peopleFluTerm = $currentYear - date('Y', strtotime($model->peopleFluDate)); //Вычисляю разницу текущего года и даты флюры
            $model->save();
            
            graftsPeoples::deleteAll('peopleId = '.$id);
            chronicDiseasesPeoples::deleteAll('peopleId = '.$id);
            
            foreach($model->graft as $m){
                $gm = new graftsPeoples;
                    $gm->peopleId = $model->peopleId;
                    $gm->graftId = $m;
                $gm->insert();
            }
            foreach($model->chronic as $c){
                $cr = new chronicDiseasesPeoples;
                    $cr->peopleId = $model->peopleId;
                    $cr->chronicDiseasesId = $c;
                $cr->insert();
            }
            
            return $this->redirect(['view', 'id' => $model->peopleId]);
        } else {
            $opt = graftsPeoples::find()->where(['peopleId' => $_GET['id']])->all();
            $optArr = array();
            foreach($opt as $o){
                $optArr[] = $o['graftId']; 
            }
            $opt2 = chronicDiseasesPeoples::find()->where(['peopleId' => $_GET['id']])->all();
            $optArr2 = array();
            foreach($opt2 as $op){
                $optArr2[] = $op['chronicDiseasesId']; 
            }
            $model->graft = $optArr;
            $model->chronic= $optArr2;
            
            return $this->render('update', [
                'model' => $model,
                //'optArr' => $optArr,
            ]);
        }
    }

    /**
     * Deletes an existing Peoples model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        graftsPeoples::deleteAll('peopleId = '.$id);
            chronicDiseasesPeoples::deleteAll('peopleId = '.$id);
        $this->findModel($id)->delete();
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the Peoples model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Peoples the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Peoples::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Экшн вывода формы для поиска людей по улице и сроку флюры.
     * @return mixed
     */
    public function actionFlu()
    {
        $model = new Peoples;
        
        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['flufind', 'streetId' => $model->streetId, 'yearVal' => $model->yearVal]);
        } else {
            return $this->render('flu', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Экшн поиска людей по улице и сроку флюры.
     * @return mixed
     */    
     public function actionFlufind($streetId,$yearVal)
    {
        $model = new Peoples;
        $peoplesArr = Peoples::find()->where(['peopleStreet' => $streetId])->andWhere('peopleFluTerm>'.$yearVal)->all();
        
        foreach($peoplesArr as $p){
            $findRes = graftsPeoples::find()->where(['peopleId' => $p['peopleId']])->all(); 
            if(empty($findRes)){
                continue;
            }else{
                
                foreach($findRes as $f){
                    $graftName = Grafts::find()->where(['graftId' => $f['graftId']])->all();
                    $arr[$p['peopleId']][] = $graftName[0]['graftName'];
                }                
                
            }
        }        
        
        return $this->render('flufind', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'dt' => $peoplesArr,
            'gr' => $arr,
        ]);
    }    
    /**
     * Экшн вывода формы для поиска людей по улице и сроку флюры.
     * @return mixed
     */
    public function actionPprint()
    {
        $model = new Peoples;
        
        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['pprintfind', 'streetId' => $model->streetId]);
        } else {
            return $this->render('pprint', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Экшн поиска людей по улице и сроку флюры.
     * @return mixed
     */    
     public function actionPprintfind($streetId)
    {
        $model = new Peoples;
        $peoplesArr = Peoples::find()->where(['peopleStreet' => $streetId])->all();
        
        foreach($peoplesArr as $p){
            $findRes = graftsPeoples::find()->where(['peopleId' => $p['peopleId']])->all(); 
            if(empty($findRes)){
                continue;
            }else{
                
                foreach($findRes as $f){
                    $graftName = Grafts::find()->where(['graftId' => $f['graftId']])->all();
                    $arr[$p['peopleId']][] = $graftName[0]['graftName'];
                }                
                
            }
        }        
                
        return $this->render('pprintFind', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'dt' => $peoplesArr
        ]);
    }    
    /**
     * Экшн вывода формы для поиска людей по улице и сроку флюры.
     * @return mixed
     */
    public function actionBackup()
    {
        /*$model = new Peoples;
        
        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['pprintfind', 'streetId' => $model->streetId]);
        } else {
            return $this->render('pprint', [
                'model' => $model,
            ]);
        }*/
                
        $file = fopen("c://backup.sql", "x+");      
        $text = "
-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 07 2016 г., 19:18
-- Версия сервера: 5.5.45
-- Версия PHP: 5.4.44

SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET time_zone = '+00:00';


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `medSys`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chronicDiseases`
--

CREATE TABLE IF NOT EXISTS `chronicDiseases` (
  `chronicDiseasesId` int(5) NOT NULL AUTO_INCREMENT,
  `chronicDiseasesName` varchar(255) NOT NULL,
  PRIMARY KEY (`chronicDiseasesId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chronicDiseases`
--
INSERT INTO `chronicDiseases` (`chronicDiseasesId`, `chronicDiseasesName`) VALUES
";

         $chronicDiseases = chronicDiseases::find()->all();
    
        foreach($chronicDiseases as $key => $cd){
            if(($key + 1) == count($chronicDiseases)){                
                $text .= "(".$cd['chronicDiseasesId'].", '".$cd['chronicDiseasesName']."');\n";
            }else{
                $text .= "(".$cd['chronicDiseasesId'].", '".$cd['chronicDiseasesName']."'),\n";
            }
        }
        
    $text .= "
-- --------------------------------------------------------

--
-- Структура таблицы `chronicDiseasesPeoples`
--

CREATE TABLE IF NOT EXISTS `chronicDiseasesPeoples` (
  `chronicDiseasesId` int(5) NOT NULL,
  `peopleId` int(5) NOT NULL,
  KEY `chronicDiseasesId` (`chronicDiseasesId`),
  KEY `peopleId` (`peopleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chronicDiseasesPeoples`
--

INSERT INTO `chronicDiseasesPeoples` (`chronicDiseasesId`, `peopleId`) VALUES";
    
    $chronicDiseasesPeople = chronicDiseasesPeoples::find()->all();
    
        foreach($chronicDiseasesPeople as $key => $cd){
            if(($key + 1) == count($chronicDiseasesPeople)){                
                $text .= "(".$cd['chronicDiseasesId'].", ".$cd['peopleId'].");\n";
            }else{
                $text .= "(".$cd['chronicDiseasesId'].", ".$cd['peopleId']."),\n";
            }
        }
        
    $text .= "
-- --------------------------------------------------------

--
-- Структура таблицы `grafts`
--

CREATE TABLE IF NOT EXISTS `grafts` (
  `graftId` int(5) NOT NULL AUTO_INCREMENT,
  `graftName` varchar(255) NOT NULL,
  PRIMARY KEY (`graftId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `grafts`
--

INSERT INTO `grafts` (`graftId`, `graftName`) VALUES";
    
    $grafts = grafts::find()->all();
    
        foreach($grafts as $key => $cd){
            if(($key + 1) == count($grafts)){                
                $text .= "(".$cd['graftId'].", '".$cd['graftName']."');\n";
            }else{
                $text .= "(".$cd['graftId'].", '".$cd['graftName']."'),\n";
            }
        }
     
    $text .= "
-- --------------------------------------------------------

--
-- Структура таблицы `graftsPeoples`
--

CREATE TABLE IF NOT EXISTS `graftsPeoples` (
  `graftId` int(5) NOT NULL,
  `peopleId` int(5) NOT NULL,
  KEY `graftId` (`graftId`),
  KEY `peopleId` (`peopleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `graftsPeoples`
--

INSERT INTO `graftsPeoples` (`graftId`, `peopleId`) VALUES";
    
    $graftsP = graftsPeoples::find()->all();
    
        foreach($graftsP as $key => $cd){
            if(($key + 1) == count($graftsP)){                
                $text .= "(".$cd['graftId'].", ".$cd['peopleId'].");\n";
            }else{
                $text .= "(".$cd['graftId'].", ".$cd['peopleId']."),\n";
            }
        }
    
    $text .= "
-- --------------------------------------------------------

--
-- Структура таблицы `peoples`
--

CREATE TABLE IF NOT EXISTS `peoples` (
  `peopleId` int(5) NOT NULL AUTO_INCREMENT,
  `peopleFIO` varchar(255) NOT NULL,
  `peopleBirthday` date NOT NULL,
  `peopleWorking` int(5) NOT NULL,
  `peopleFluNumber` varchar(255) NOT NULL,
  `peopleFluDate` date NOT NULL,
  `peopleFluResult` int(1) NOT NULL,
  `peopleFluTerm` int(2) NOT NULL,
  `peopleStreet` int(5) NOT NULL,
  `peopleAdress` varchar(255) NOT NULL,
  PRIMARY KEY (`peopleId`),
  KEY `peopleWorking` (`peopleWorking`),
  KEY `peopleFlu` (`peopleFluNumber`),
  KEY `peopleStreet` (`peopleStreet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `peoples`
--

INSERT INTO `peoples` (`peopleId`, `peopleFIO`, `peopleBirthday`, `peopleWorking`, `peopleFluNumber`, `peopleFluDate`, `peopleFluResult`, `peopleFluTerm`, `peopleStreet`, `peopleAdress`) VALUES";
    
    $peoples = peoples::find()->all();
    
        foreach($peoples as $key => $cd){
            if(($key + 1) == count($peoples)){                
                $text .= "(".$cd['peopleId'].", '".$cd['peopleFIO']."', '".$cd['peopleBirthday']."', ".$cd['peopleWorking'].", '".$cd['peopleFluNumber']."', '".$cd['peopleFluDate']."', ".$cd['peopleFluResult'].", ".$cd['peopleFluTerm'].", ".$cd['peopleStreet'].", '".$cd['peopleAdress']."');\n";
            }else{
                $text .= "(".$cd['peopleId'].", '".$cd['peopleFIO']."', '".$cd['peopleBirthday']."', ".$cd['peopleWorking'].", '".$cd['peopleFluNumber']."', '".$cd['peopleFluDate']."', ".$cd['peopleFluResult'].", ".$cd['peopleFluTerm'].", ".$cd['peopleStreet'].", '".$cd['peopleAdress']."'),\n";
            }
        }
    
    $text .= "
-- --------------------------------------------------------

--
-- Структура таблицы `streets`
--

CREATE TABLE IF NOT EXISTS `streets` (
  `streetId` int(2) NOT NULL AUTO_INCREMENT,
  `streetName` varchar(255) NOT NULL,
  PRIMARY KEY (`streetId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `streets`
--

INSERT INTO `streets` (`streetId`, `streetName`) VALUES";
       
    $streets = streets::find()->all();
    
        foreach($streets as $key => $cd){
            if(($key + 1) == count($streets)){                
                $text .= "(".$cd['streetId'].", '".$cd['streetName']."');\n";
            }else{
                $text .= "(".$cd['streetId'].", '".$cd['streetName']."'),\n";
            }
        }
       
    $text .= "
-- --------------------------------------------------------

--
-- Структура таблицы `working`
--

CREATE TABLE IF NOT EXISTS `working` (
  `workingId` int(5) NOT NULL AUTO_INCREMENT,
  `workingName` varchar(255) NOT NULL,
  PRIMARY KEY (`workingId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `working`
--

INSERT INTO `working` (`workingId`, `workingName`) VALUES";
    
    $working = working::find()->all();
    
        foreach($working as $key => $cd){
            if(($key + 1) == count($working)){                
                $text .= "(".$cd['workingId'].", '".$cd['workingName']."');\n";
            }else{
                $text .= "(".$cd['workingId'].", '".$cd['workingName']."'),\n";
            }
        }
    
        $text .= "
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `chronicDiseasesPeoples`
--
ALTER TABLE `chronicDiseasesPeoples`
  ADD CONSTRAINT `chd` FOREIGN KEY (`chronicDiseasesId`) REFERENCES `chronicDiseases` (`chronicDiseasesId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `chp` FOREIGN KEY (`peopleId`) REFERENCES `peoples` (`peopleId`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `graftsPeoples`
--
ALTER TABLE `graftsPeoples`
  ADD CONSTRAINT `gg` FOREIGN KEY (`graftId`) REFERENCES `grafts` (`graftId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `gp` FOREIGN KEY (`peopleId`) REFERENCES `peoples` (`peopleId`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `peoples`
--
ALTER TABLE `peoples`
  ADD CONSTRAINT `ws` FOREIGN KEY (`peopleStreet`) REFERENCES `streets` (`streetId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `www` FOREIGN KEY (`peopleWorking`) REFERENCES `working` (`workingId`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
";
        
    fwrite($file, $text);
        
    fclose($file);
    
    echo "Базу даних збережено за адресою C://backup.sql<br>"
    . "<a href='http://medik/web/index.php'>Назад</a>";
    
    }
}
