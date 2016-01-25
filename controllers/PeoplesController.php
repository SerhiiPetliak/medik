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
            'peoplesGraft' => $arr,
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
}
