<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Accessories;
use frontend\models\AccessoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use yii\helpers\Url;
use yii\base\Object;
use yii\filters\AccessControl;
use common\components\AccessRule;
/**
 * AccessoriesController implements the CRUD actions for Accessories model.
 */
class AccessoriesController extends Controller
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
    			
    			//จำกัดการใช้งานไห้ใช้ ได้ เฉพาะ admin owner
    			'access'=>[
    					'class'=> AccessControl::className(),
    					'only' =>['_form','_search','create','index','update','view'],
    					'ruleConfig'=> [
    							'class' => AccessRule::className()
    					],
    					'rules'=>[
    							[
    									'actions'=>['_form','_search','create','index','update','view'],
    									'allow'=> true,
    									'roles'=>[
    											User::ROLE_OWNER,User::ROLE_ADMIN
    									]
    							]
    							
    					]
    			]
    	];
    }

    /**
     * Lists all Accessories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccessoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Accessories model.
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
     * Creates a new Accessories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Accessories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Accessories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Accessories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    
 /*   public function actionDelete($id)
    {
    	$this->findModel($id)->delete();
    
    	return $this->redirect(['index']);
    }*/
    public function actionDelete($id)
    {
    	?>
    <?= Yii::$app->getSession()->setFlash('error', 'ไม่สามารถลบข้อมูลนี้ได้');
    	return $this->redirect(['index']);  ?> 
  <?php   
    }

    /**
     * Finds the Accessories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Accessories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Accessories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
?>