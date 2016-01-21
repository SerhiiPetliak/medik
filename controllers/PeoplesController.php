<?php

namespace app\controllers;

use Yii;
use app\models\Peoples;
use app\models\PeoplesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\graftsPeoples;
use app\models\grafts;

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
        
        /* */
        $peoplesArr = Peoples::find()->all();
        
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
        /* */
        

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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
            $currentYear = date('Y');
            $model->peopleFluTerm = $currentYear - date('Y', strtotime($model->peopleFluDate)); //Вычисляю разницу текущего года и даты флюры
            $model->save();
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
            
            $currentYear = date('Y');
            $model->peopleFluTerm = $currentYear - date('Y', strtotime($model->peopleFluDate)); //Вычисляю разницу текущего года и даты флюры
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->peopleId]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
