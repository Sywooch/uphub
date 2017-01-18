<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Room;
use frontend\models\RoomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use frontend\models\Rent;
use yii\base\ExitException;
use yii\helpers\ArrayHelper;
use yii\base\Object;
use yii\helpers\Url;

use yii\filters\AccessControl;
use common\components\AccessRule;

/**
 * RoomController implements the CRUD actions for Room model.
 */
class RoomController extends Controller
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
        				'only' =>['index','create','update','delete','owner','booking'],
        				'ruleConfig'=> [
        						'class' => AccessRule::className()
        				],
        				'rules'=>[
        						[
        								'actions'=>['owner','create','update'],
        								'allow'=> true,
        								'roles'=>[
        										User::ROLE_OWNER
        								]
        						],
        						[
        								'actions'=>['booking'],
        								'allow'=> true,
        								'roles'=>[User::ROLE_USER]
        						]
        				]
        		]
        ];
    }

    /**
     * Lists all Room models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Room model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionOwner($rent_id){
    	$model = Room::find()->where([
    			'rent_id' => $rent_id
    			])->all();

		$searchModel = new RoomSearch(['rent_id'=>$rent_id]);
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		return $this->render ( 'manage', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'model' => $model
				]);
    }
   
    public  function  actionBook($rent_id){
    	$modelRoom = Room::find()->where([
    			'rent_id' => $rent_id
    	])->all();
    	
    	
    
    	$floor1Model = new RoomSearch(['numFloor'=>1]);
    	$floor2Model = new RoomSearch(['numFloor'=>2]);
    	$floor3Model = new RoomSearch(['numFloor'=>3]);
    	$floor4Model = new RoomSearch(['numFloor'=>4]);
    	$floor5Model = new RoomSearch(['numFloor'=>5]);
    	$floor6Model = new RoomSearch(['numFloor'=>6]);
    	$floor7Model = new RoomSearch(['numFloor'=>7]);
    	$floor8Model = new RoomSearch(['numFloor'=>8]);
    	
    	$model = [$floor1Model,$floor2Model,$floor3Model,$floor4Model,$floor5Model,$floor6Model,$floor7Model,$floor8Model];
    	
    	if ($floor1Model) $floor1DataProvider = $floor1Model->search(Yii::$app->request->queryParams);
    	if ($floor2Model) $floor2DataProvider = $floor2Model->search(Yii::$app->request->queryParams);
    	if ($floor3Model) $floor3DataProvider = $floor3Model->search(Yii::$app->request->queryParams);
    	if ($floor4Model) $floor4DataProvider = $floor4Model->search(Yii::$app->request->queryParams);
    	if ($floor5Model) $floor5DataProvider = $floor5Model->search(Yii::$app->request->queryParams);
    	if ($floor6Model) $floor6DataProvider = $floor6Model->search(Yii::$app->request->queryParams);
    	if ($floor7Model) $floor7DataProvider = $floor7Model->search(Yii::$app->request->queryParams);
    	if ($floor8Model) $floor8DataProvider = $floor8Model->search(Yii::$app->request->queryParams);
    	
    	$dataProvider = [$floor1DataProvider,$floor2DataProvider,$floor3DataProvider,$floor4DataProvider,$floor5DataProvider,$floor6DataProvider,$floor7DataProvider,$floor8DataProvider];
    	
    	 return $this->render('index', [
            'searchModel' => $model,
            'dataProvider' => $dataProvider,
    	 		'model'=> $modelRoom

        ]);
   
    	
    	
    }
    
    public function actionBooking($id){
    	
    	$model = $this->findModel($id);
    	if ($model->status == 0){
    	$model->status=1;
    	$model->start_date = date("Y-m-d H:i:s");
    	$model->end_date = date('Y-m-d',strtotime('+1 month'));
    	$model->user_id = \Yii::$app->user->id;   	
    	$date = new \DateTime();
    	
    	$model->code = (\Yii::$app->user->id).
    	Yii::$app->security->generateRandomString(20).$date->getTimestamp();
    	
    	if ($model->code)   	
    	if ( !$model->save() ){
    		print_r($model->getErrors());
    		die();
    	}
    	return $this->render('result', [
    			'room' => $model,
    			
    			
    	]);
    	}else 
    	return Yii::$app->getResponse()->redirect(array('/site/error'));
    }
    
 public function actionDescript($id){
 	$model = $this->findModel($id);
 	
 }  
 public function actionEntry($id){
         
 	$model = $this->findModel($id);
		if ($model->load(Yii::$app->request->post()) ) {
         	$post = Yii::$app->request->post();
         	$model->load($post);
         	
    		if ( !$model->save() ){
    			print_r($model->getErrors());
    			die();
    		}
            return Yii::$app->getResponse()->redirect(array('/room/booking','id'=>$model->id));
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('confirmbook', ['model' => $model]);
        }
    }

    public  function actionFull($id){
    	$model = $this->findModel($id);
    	$model->status = 2;
    	$model->start_date = "";
    	$model->end_date = "";
    	$model->user_id = "";
    	$model->code = "";
    	if ( !$model->save() ){
    		print_r($model->getErrors());
    		die();
    	}
    	return $this->redirect(  Url::to(['/room/owner', 'rent_id' => $model->rent_id]));
    }
    public  function actionAutofree($id){
    	$model = $this->findModel($id);
    	if ($model->end_date == date("Y-m-d")){
    	$model->status = 0;
    	$model->start_date = "";
    	$model->end_date = "";
    	$model->user_id = "";
    	$model->code = "";
    	$model->name = "";
    	$model->id_card = "";
    	$model->tel = "";
    	if ( !$model->save() ){
    		print_r($model->getErrors());
    		die();
    	}
    	
    }
    return $this->redirect(  Url::to(['/site/index']));
    }
    public  function actionFree($id){
    	$model = $this->findModel($id);
    	$model->status = 0;
    	$model->start_date = "";
    	$model->end_date = "";
    	$model->user_id = "";
    	$model->code = "";
    	$model->name = "";
    	$model->id_card = "";
    	$model->tel = "";
    	if ( !$model->save() ){
    		print_r($model->getErrors());
    		die();
    	}
    	return $this->redirect(  Url::to(['/room/owner', 'rent_id' => $model->rent_id]));
    }
    public  function actionBooked($id){
    $model = $this->findModel($id);
    
    	$model->status=1;
    	$model->start_date = date("Y-m-d H:i:s");
    	$model->end_date = date('Y-m-d',strtotime('+1 month'));
    	$model->user_id = \Yii::$app->user->id;   	
    	$date = new \DateTime();
    	
    	$model->code = (\Yii::$app->user->id).
    	Yii::$app->security->generateRandomString(20).$date->getTimestamp();
    	
    	if ($model->code)   	
    	if ( !$model->save() ){
    		print_r($model->getErrors());
    		die();
    	} 
    	return $this->redirect(  Url::to(['/room/owner', 'rent_id' => $model->rent_id]));
    
    }

    /**
     * Creates a new Room model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Room();
		
        if ( Yii::$app->request->post() != null ) {
        	$post = Yii::$app->request->post();
        	 
        	if (isset($post['floor'])){
        		$i = 1;
        		foreach ( $post['floor'] as $floor){
        			 
        			if ( !isset($post['f'.$i.'room']) ) continue;
        			//echo " floor ".$i." <br>";
        			foreach ($post['f'.$i.'room'] as $room ){
        				//echo $room." ";
        				foreach ($post['cost'.$i.'cost'] as $cost){
        					foreach ($post['f'.$i.'insurance'] as $insurance){
        						foreach ($post['f'.$i.'type_pay'] as $type_pay){
			        				$roomModel = new Room();
			        				//$roomModel->load($post);
			        				$roomModel->setAttribute('numFloor', $i);
			        				$roomModel->setAttribute('room', $room);
			        				$roomModel->setAttribute('cost', $cost);
			        				$roomModel->setAttribute('insurance', $insurance);
			        				$roomModel->setAttribute('type_pay', $type_pay);
			        				$roomModel->setAttribute('rent_id', $post['Room']['rent']);
			        				$roomModel->setAttribute('user_id', Yii::$app->getUser()->id);
			        				
			        				//print_r($roomModel);
			        				/* $roomModel->attributes([
			        					'floor'=>$i,
			        					'room'=>$room,
			        					'rent_id'=>8,
			        					'user_id' => Yii::$app->user->id,
			        				]); */
			        				if (!$roomModel->save()){
			        					print_r($roomModel->getErrors());
			        					die("error ");
        				}
        				//$roomModel->id;
        			}
        			}
        			}
        			}
        			$i++;
        			//echo "<hr>";
        		}  
        	}
        	
        	return $this->redirect(  Url::to(['rent/view', 'id' => $post['Room']['rent']]));
        }
        else if (Yii::$app->request->get() != null ){

        	$get = Yii::$app->request->get();
        	$rent_id = $get['rent_id'];
        	$rent = Rent::findOne($rent_id);
        	if (!$rent){
        		throw new ExitException();
        	}
        	
        	return $this->render('create', [
        				'model' => $model,
        				'rent_id' => $rent_id
        				
        		]);
        	

    } 
        	
        	
    }


    /**
     * Updates an existing Room model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    $model = $this->findModel($id);
		if ($model->load(Yii::$app->request->post()) ) {
         	$post = Yii::$app->request->post();
         	$model->load($post);
    		if ( !$model->save() ){
    			print_r($model->getErrors());
    			die();
    		}
            return Yii::$app->getResponse()->redirect(array('/room/owner','rent_id'=>$model->rent_id));
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('update', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing Room model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionRedirect()
    {
    	
    	return Yii::$app->getResponse()->redirect(array('/room/onwer'));
    }

    /**
     * Finds the Room model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Room the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    protected function findModel($id)
    {
        if (($model = Room::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findModelRestFul($id) {
		if (($model = Room::findOne ( $id )) !== null) {
			return $model;
		} else {
			die ( "0" );
		}
	}
	public function actionGetRoom()
	{
	
		$androidApp = Room::find()->asArray()->all();
		echo json_encode($androidApp);
	}
	public function actionBookRoom() {
		
		$get = Yii::$app->request->get ();
		
		$id = @$get ['id'];
		$user_id = @$get ['user'];
		
		if (! $user_id)
			die ( 'user_id not null' );
		$modelUser = User::findOne ( $user_id );
		if (! $modelUser)
			die ( 'model not null' );
		
		$book = $this->findModelRestFul ( $id );
		
		if ($book->status == 1)
			die ( 'ห้องพักไม่ว่าง' );
		
		$book->setAttributes(['status'=>1,'user_id'=>$user_id]);
	    if($book->save()){
	    	echo "จองห้องพักสำเร็จ";
	    }else {
	    	print_r($book->getErrors());
	    }

    }
    public function actionReturnRoom() {
		$get = Yii::$app->request->get ();
		
		$id = @$get ['id'];
		$user_id = @$get ['user'];
		
		if (! $user_id)
			die ( '1' );
		$modelUser = User::findOne ( $user_id );
		if (! $modelUser)
			die ( '1' );
		
		$book = $this->findModelRestFul ( $id );
		
		if ($book->status == 0)
			die ( 'ห้องพักสถานะว่าง' );
		
		$book->setAttributes ( [ 
				'status' => 0,
				'user_id' => $user_id 
		] );
		if ($book->save ()) {
			echo "ยกเลิกการจองสำเร็จ";
		} else {
			print_r ( $book->getErrors () );
		}
    
	}
}
