<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Rent;
use frontend\models\RoomSearch;
use frontend\models\Uploads;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use common\models\User;

use  yii\web\Session;
use yii\base\Object;
use yii\rest\UpdateAction;
use yii\rest\IndexAction;
use frontend\models\Room;
use yii\db\Query;
use kartik\grid\GridView;

class SiteController extends Controller {

	public function behaviors() {
		return [
				'access' => [
						'class' => AccessControl::className (),
						'only' => [
								'logout',
								'signup'
						],
						'rules' => [
								[
										'actions' => [
												'signup'
										],
										'allow' => true,
										'roles' => [
												'?'
										]
								],
								[
										'actions' => [
												'logout'
										],
										'allow' => true,
										'roles' => [
												'@'
										]
								],
								[
								'actions'=>['index','view','create','update','delete'],
								'allow'=> true,
								'roles'=>[User::ROLE_OWNER]
								]
						]
				],
				'verbs' => [
						'class' => VerbFilter::className (),
						'actions' => [
								'logout' => [
										'post'
								]
						]
				]
		];
	}

	public function actions() {
		return [
				'error' => [
						'class' => 'yii\web\ErrorAction'
				],
				'captcha' => [
						'class' => 'yii\captcha\CaptchaAction',
						'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
				],
				'auth' => [
						//$this->user_profile =$this->facebook->api('/me&access_token='.$this->facebook->getAccessToken());
						'class' => 'yii\authclient\AuthAction',
						'successCallback' => [
								$this,
								'oAuthSuccess'
						]
				]
		];
	}
	public function actionView(){
		$rents = Rent::find()->all();
		return $this->render('view',['rents'=>$rents]);
	}
	public function actionIndex() {
		
		
		$clearbook = Room::find()
		->where(['end_date' => date("Y-m-d")])
		->one();
		print_r($clearbook);
	
		if ($clearbook!=NULL) {
			echo "rr";
			$clearbook->status = 0;
			$clearbook->start_date = "";
			$clearbook->end_date = "";
			$clearbook->user_id = "";
			$clearbook->code = "";
			$clearbook->name = "";
			$clearbook->id_card = "";
			$clearbook->tel = "";
			if ( !$clearbook->save() ){
				print_r($model->getErrors());
				die();
			}
		}
		
		/* $clearbook->setAttributes ( [
				'status' => 7,
				
		] );
		
		if ( !$clearbook->save() ){
			print_r($model->getErrors());
			die();
		} */
		/* 
		 	foreach ($clearbook as $clear){
		 		$clear->status = 7;
		 		
		 	} */
		 	
		/* print_r($clearbooks);
		die(); */
		
		/* $clearbook = Room::find()
		->where(['status' => 1])
		->all();
		
		print_r($clearbook);
		die();
		if ($clearbook->end_date == "2016-07-07"){
			$clearbook->status = 0;
			$clearbook->start_date = "";
			$clearbook->end_date = "";
			$clearbook->user_id = "";
			$clearbook->code = "";
			$clearbook->name = "";
			$clearbook->id_card = "";
			$clearbook->tel = "";
			if ( !$model->save() ){
				print_r($model->getErrors());
				die();
			}
			//return $this->redirect(  Url::to(['/room/owner', 'rent_id' => $model->rent_id]));
		} */
		/* if (!empty(Yii::$app->user->id)){
			$clearbook = Room::find()
			->where(['status' => 1])
			->all();
			foreach ($clearbook as $model){
				return $this->redirect(  Url::to(['/room/autofree', 'id' => $model->rent_id]));
				
			}
		} */
		
	 	$rentView = Rent::find()
	 	->where(['visible' => 1])
	 	->orderBy(['view'=>SORT_DESC])
    	->limit(8)
    	->all(); // ดึงการค้นหา 
    	
    	
    	
    	/* SELECT *,COUNT(*) 
		FROM `rent`
		LEFT JOIN room
		ON room.rent_id=rent.id  
		WHERE  room.status = 1
		GROUP BY room.rent_id
		ORDER BY COUNT(*)  DESC 
		LIMIT 3*/
    	
    	
        $renthot = Rent::find()
        ->where(['visible' => 1])
         ->orderBy(['hot'=>SORT_DESC])
        ->limit(8)
        ->all();
        
      /*   $renthot = Rent::find()
        ->orderBy(['view'=>SORT_DESC])
        ->limit(8)
        ->all(); */
        
       
    	
    	
    //	echo "<br><br><br><br><br>";
    	// die();
    	$query = new Query();
    	$query	->select(['*,COUNT(*)'])
    	->from('rent')
    	->leftJoin('room', 'room.rent_id = rent.id')
    	->limit(8);
    	
    	$command = $query->createCommand();
    	$data = $command->queryAll();
    	//print_r($data);
    	
    	foreach ($data as $rent){
    		
    	//echo $rent->room.name;
    	}
       // die();
    	 
    	
    	
    	
    	
    	$rentNew = Rent::find()
    	->where(['visible' => 1])
    	->orderBy(['edited'=>SORT_DESC])
    	->limit(8)
    	
    	->all(); // ดึงการค้นหา
	 	
	 	
	 	
		return $this->render('index',[
				'rentView'=>$rentView,
				'renthot'=>$renthot,
				'rentNew'=>$rentNew
				
				
		]);
	}
	
	public function actionMain(){
		//$rents = Rent::findAll();
		$rents = Rent::find()->asArray()->all();
		return $this->render('main',['rents'=>$rents]);
	}
	public function actionLogin() {

		if (! \Yii::$app->user->isGuest) {

			return $this->goHome ();

		}

		$model = new LoginForm ();
		if ($model->load ( Yii::$app->request->post () ) && $model->login ()) {
			return $this->goBack ();
		} else {
			return $this->render ( 'login', [
					'model' => $model
			] );
		}
	}




	public function actionLogout() {
		Yii::$app->user->logout ();

		return $this->goHome ();
	}
	public function actionError(){
		return $this->render ( 'error');
	}
	public function actionContact() {
		$model = new ContactForm ();

		if ($model->load ( Yii::$app->request->post () ) && $model->validate ()) {
			// print_r(Yii::$app->request->post());
			// die("test ");
			if ($model->sendEmail ( Yii::$app->params ['adminEmail'] )) {
				Yii::$app->session->setFlash ( 'success', 'Thank you for contacting us. We will respond to you as soon as possible.' );
			} else {
				Yii::$app->session->setFlash ( 'error', 'There was an error sending email.' );
			}

			return $this->refresh ();
		} else {
			return $this->render ( 'contact', [
					'model' => $model
			] );
		}
	}
	public function actionAbout() {
		return $this->render ( 'about' );
	}
	public function actionSignup() {
		$model = new SignupForm ();
		if ($model->load ( Yii::$app->request->post () )) {
			if ($user = $model->signup ()) {
				if (Yii::$app->getUser ()->login ( $user )) {
					return $this->goHome ();
				}
			}
		}

		return $this->render ( 'signup', [
				'model' => $model
		] );
	}
	public function actionRequestPasswordReset() {
		$model = new PasswordResetRequestForm ();
		if ($model->load ( Yii::$app->request->post () ) && $model->validate ()) {
			if ($model->sendEmail ()) {
				Yii::$app->getSession ()->setFlash ( 'success', 'Check your email for further instructions.' );

				return $this->goHome ();
			} else {
				Yii::$app->getSession ()->setFlash ( 'error', 'Sorry, we are unable to reset password for email provided.' );
			}
		}

		return $this->render ( 'requestPasswordResetToken', [
				'model' => $model
		] );
	}
	public function actionResetPassword($token) {
		try {
			$model = new ResetPasswordForm ( $token );
		} catch ( InvalidParamException $e ) {
			throw new BadRequestHttpException ( $e->getMessage () );
		}

		if ($model->load ( Yii::$app->request->post () ) && $model->validate () && $model->resetPassword ()) {
			Yii::$app->getSession ()->setFlash ( 'success', 'New password was saved.' );

			return $this->goHome ();
		}

		return $this->render ( 'resetPassword', [
				'model' => $model
		] );
	}
	public function actionRoom() {
		return $this->render ( 'room' );
	}
	public function actionSay($message = 'Hello') {
		return $this->render ( 'say', [
				'message' => $message
		] );

	}

	public function actionNn(){

		$id = $_GET["name"];
		$user_id = $_GET["surname"];
	echo $id.' '.$user_id;



	}

	
	public function oAuthSuccess($client) {
		// get user data from client
		$userAttributes = $client->getUserAttributes();
		//print_r($userAttributes);
		// die();
		$id = $userAttributes['id'];
		$name=$userAttributes['name'];
		
		if (empty($userAttributes['email'])){
			$userAttributes['email'] = "";
		}
		//echo "<img src=\"https://graph.facebook.com/10200845338451387/picture\" height=\"50\"  />&nbsp;";
		
		//print_r($userAttributes);
		//die("stop");
		$id_fb = User::find()
		->where(['=', 'id_fb', $userAttributes['id']])
		->one();
			
		if (Yii::$app->user->isGuest) {
			//account exist in database
			if (isset($id_fb)) { // login
				
				Yii::$app->user->login($id_fb);
				
			} else {
				// signup FB//
				$password = Yii::$app->security->generateRandomString(6);
				$user = new User([
						'username' => $userAttributes['name'],
						'email' => $userAttributes['email'],
						'password_hash' => Yii::$app->security->generatePasswordHash($password),
						'password' => $password,
						'id_fb'	=> $userAttributes['id'],
				]);
				$user->role = User::ROLE_USER;
				$user -> save();
					
				//login//
				$user = User::find()
				->where(['=', 'username', $userAttributes['name']])
				->one();
				Yii::$app->user->login($user);
		
			}
		} else {
			$session = Yii::$app->session;
		
			$session->destroy();
			die("isn't Guest");
		}
		/* print_r(Yii::$app->user->identity->username);
		 	
		print_r(Yii::$app->user->id); */
	}
	
}




