<?php
//tags
namespace frontend\controllers;

use Yii;
use common\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\AccessRule;
/////////////////
use yii\base\Object;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use frontend\models\Room;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
        'access'=>[
            'class'=> AccessControl::className(),
            'only' =>['index','view','create','update','delete'],
            'ruleConfig'=> [
                'class' => AccessRule::className()
            ],
            'rules'=>[
            		[
            		'actions'=>['view','update'],
            		'allow'=> true,
            		'roles'=>[
            				User::ROLE_OWNER,
            				User::ROLE_USER
            		]
            		],
            		[
            				'actions'=>['index','view','create','update','delete'],
            				'allow'=> true,
            				'roles'=>[User::ROLE_ADMIN]
            		]
                ]
        ]
    ];
}

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$ids = @$_POST['id'];
    	$role_id = @$_POST['role_id'];

    	if ( !empty($ids) && !empty($role_id) ){
    		foreach ($ids as $id) {
    			//die("id ".$_id);
    			User::updateAll(['role'=>$role_id],'id='.$id);
    		}
    	}


        //$searchModel = new UserSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /* $memberModel = UserSearch::find(['role'=>10])->all();
        $ownerModel = UserSearch::find(['role'=>20])->all();
        $adminModel = UserSearch::find(['role'=>30])->all(); */

    	$memberModel = new UserSearch(['role'=>10]);
    	//echo "name ".$memberModel->username;
    	//print_r($memberModel);
    	//die();
    	$ownerModel = new UserSearch(['role'=>20]);

    	$adminModel = new UserSearch(['role'=>30]);

    	$banModel   = new UserSearch(['role'=>40]);

        $model = [$memberModel,$ownerModel,$adminModel,$banModel];

    /*     foreach ($memberModel as $member){
        echo "email". $member->email."<br>";
        }
        die(); */
       if ($memberModel) $memberDataProvider = $memberModel->search(Yii::$app->request->queryParams);
       if ($ownerModel)  $ownerDataProvider  = $ownerModel ->search(Yii::$app->request->queryParams);
       if ($adminModel)  $adminDataProvider  = $adminModel ->search(Yii::$app->request->queryParams);
       if ($banModel)  	 $banDataProvider    = $banModel   ->search(Yii::$app->request->queryParams);

        $dataProvider = [$memberDataProvider,$ownerDataProvider,$adminDataProvider,$banDataProvider];

        return $this->render('index', [
            'searchModel' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	
    	$infobook = Room::find()
    	->where(['user_id' => $id])
    	->all();
    	//print_r($infobook);
    	
    	if (!empty($infobook)){
    		
    		return $this->render('view2', [
    				'model' => $this->findModel($id),
    				'infobook' => $infobook
    				
    		]);
    	}else {
    		return $this->render('view', [
    				'model' => $this->findModel($id),
    				
    		]);
    	}
        
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
public function actionCreate()
{
    $model = new User();

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {

        $model->setPassword($model->password);
        $model->generateAuthKey();
        $model->save();

        return $this->redirect(['view', 'id' => $model->id]);
    } else {
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}

/**
 * Updates an existing User model.
 * If update is successful, the browser will be redirected to the 'view' page.
 * @param integer $id
 * @return mixed
 */

public function actionUpdate($id)
{
	
	$model = $this->findModel($id);
	$model->password = $model->password_hash;

	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
		
		if($model->password_hash!=$model->password ){
			
			$model->setPassword($model->password);
		}
		print_r($model->load(Yii::$app->request->post()));
		
		
		$model->save();
		return $this->redirect(['view', 'id' => $model->id]);
	} else {
		return $this->render('update', [
				'model' => $model,
		]);
	}
}


    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
