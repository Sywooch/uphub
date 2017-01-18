<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Androidapp;
use frontend\models\AndroidappSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AndroidappController implements the CRUD actions for Androidapp model.
 */
class AndroidappController extends Controller
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
     * Lists all Androidapp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AndroidappSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Androidapp model.
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
     * Creates a new Androidapp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Androidapp();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Androidapp model.
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
     * Deletes an existing Androidapp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionGetImg($img)
    {
    	//echo CHtml::image('image/1.jpg');
    }
    
    public function actionGetAllRent()
    {
    	$androidApp = Androidapp::find()->asArray()->all();
    	echo json_encode($androidApp);  	
    }
    
    public function actionGetRent($id)
    {
    	$androidApp = $this->findModel($id);
    	if ($androidApp) echo json_encode($androidApp->toArray());
    	else echo $id;
    }
    
    public function actionBookRent($id)
    {
    	$androidApp = $this->findModel($id);
    	$androidApp->status = 1;
    	$androidApp->save();
    	echo json_encode($androidApp->toArray());
    }
    
    public function actionReturnRent($id)
    {
    	$androidApp = $this->findModel($id);
    	$androidApp->status = 0;
    	$androidApp->save();
    	echo json_encode($androidApp->toArray());
    }

    /**
     * Finds the Androidapp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Androidapp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Androidapp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
