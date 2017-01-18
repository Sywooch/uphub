<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Uploads;
use frontend\models\Rent;
use frontend\models\RentSearch1;
use frontend\models\RentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\html;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use frontend\models\RentHasAccessories;
use yii\base\Model;
use frontend\models\ReplaceObject;
use frontedn\models\Province;
use frontend\models\Amphur;
use frontend\models\District;
use frontend\models\Address;
use frontend\models\Room;
use frontend\models\Fav;
use frontend\models\PhotoLibrary;
use frontend\models\PhotoLibrarySearch;

use yii\web\HttpException;
use common\models\User;
use yii\base\Object;

use yii\filters\AccessControl;
use common\components\AccessRule;
use yii\web\CookieCollection;
/* use Faker\Provider\Address; */
class RentController extends Controller {

	public function behaviors() {
			return [
					'verbs' => [
							'class' => VerbFilter::className (),
							'actions' => [
									'delete' => [
											'post'
									]
							]
					],
					'access'=>[
							'class'=> AccessControl::className(),
							'only' =>['index','create','update','delete','myrent','view'],
							'ruleConfig'=> [
									'class' => AccessRule::className()
							],
							'rules'=>[
									[
										'actions'=>['update','myrent','create'],
										'allow'=> true,
										'roles'=>[
											User::ROLE_OWNER,	
									]
									],
									[
									'actions'=>['update','index','create'],
									'allow'=> true,
									'roles'=>[
											User::ROLE_ADMIN,
									]
									],
									[
									 'actions'=>['view'],
									'allow'=> true,
									'roles'=>[
											User::ROLE_OWNER,
											User::ROLE_ADMIN,
											User::ROLE_USER,
											'?'
									]
									], 
									
							]
					]
			];
		}

	/**
	 * Lists all Rent models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new RentSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		return $this->render ( 'index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider
		] );
	}


public function actionSub(){

	$id = $_GET["id"];

	$model = new Rent();
	
	$model = Rent::findOne($id);
	$model->lat= $_GET["lat"];
	$model->long= $_GET["long"];
	$model->id= $_GET["id"];
	//$model->update();
	if($model->update()){
		echo "success";
	}

}


	


	public function actionSearch() {
		$searchModel = new RentSearch1();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		return $this->render ( 'search', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider
		] );
	}
	public function actionMyrent() {
		$id=Yii::$app->user->identity->id;
		
		$rentMe = Rent::find()
		->where(['=', 'user_id', $id])
		->all();
		
		
		return $this->render('myrent',[
				'rentMe'=>$rentMe,
		]);
	}

	public function actionHotlist() {
		$page = \Yii::$app->request->get();
		$page = $page['page'];
		if ($page>=0) {
			$rentHot = Rent::find()
			->where(['visible' => 1])
			->limit(8)
			->offset( ($page-1)*8)
			->orderBy(['hot'=>SORT_DESC])
			->all(); // เธ”เธถเธ�เธ�เธฒเธฃเธ�เน�เธ�เธซเธฒ
				
			$allPage = Rent::find()
			->count();
			$allPage = round($allPage/8);
	
	
			echo Yii::$app->controller->renderPartial('_hotrent', [
					'rentHot' => $rentHot,
					'backVisible' => $page==1?0:1,
					'frontVisible' => $page,
					'allPage' => $allPage
			] );
		}
	
	
	}


	
	/* public function actionHotlist2() {
	 $page = \Yii::$app->request->get();
	 $page = $page['page'];
	
	 $rentHot = Rent::find()
	 ->limit(8)
	 ->offset( ($page-1)*8)
	 ->orderBy(['hot'=>SORT_DESC])
	 ->asArray()
	 ->all(); // เธ”เธถเธ�เธ�เธฒเธฃเธ�เน�เธ�เธซเธฒ
	
	 echo json_encode($rentHot);
	
	
	 } */
	//////////////////////////////////////////////////////////////////
	public function actionHotview() {
		$rentView = Rent::find()
		->where(['visible' => 1])
		->limit(8)
		->offset(0)
		->orderBy(['view'=>SORT_DESC])
		->all(); // เธ”เธถเธ�เธ�เธฒเธฃเธ�เน�เธ�เธซเธฒ
	
		$allPage = Rent::find()
		->count();
		$allPage = round($allPage/8);
	
		return $this->render ( 'hotview', [
				'rentView' => $rentView,
				'backVisible' => 0,
				'frontVisible' => 1,
				'allPage' => $allPage
		] );
	}
	
	public function actionHotviewlist() {
		$page = \Yii::$app->request->get();
		$page = $page['page'];
		$rentView = Rent::find()
		->where(['visible' => 1])
		->limit(8)
		->offset( ($page-1)*8)
		->orderBy(['view'=>SORT_DESC])
		->all();
	
		$allPage = Rent::find()
		->count();
		$allPage = round($allPage/8);
	
		echo Yii::$app->controller->renderPartial('_hotview', [
				'rentView' => $rentView,
				'backVisible' => $page==1?0:1,
				'frontVisible' => $page,
				'allPage' => $allPage
		] );
	}
	/////////////////////////////////////////////////////////////////
	
	public function actionNewrent() {
		$rentNew = Rent::find()
		->where(['visible' => 1])
		->limit(8)
		->offset(0)
		->orderBy(['edited'=>SORT_DESC])
		->all(); // เธ”เธถเธ�เธ�เธฒเธฃเธ�เน�เธ�เธซเธฒ
	
		$allPage = Rent::find()
		->count();
		$allPage = round($allPage/8);
	
		return $this->render ( 'newrent', [
				'rentNew'=>$rentNew,
				'backVisible' => 0,
				'frontVisible' => 1,
				'allPage' => $allPage
		] );
	}
	public function actionHotnewlist() {
		$page = \Yii::$app->request->get();
		$page = $page['page'];
		$rentNew = Rent::find()
		->where(['visible' => 1])
		->limit(8)
		->offset( ($page-1)*8)
		->orderBy(['edited'=>SORT_DESC])
		->all(); // เธ”เธถเธ�เธ�เธฒเธฃเธ�เน�เธ�เธซเธฒ
	
		$allPage = Rent::find()
		->count();
		$allPage = round($allPage/8);
	
		echo Yii::$app->controller->renderPartial('_newrent', [
				'rentNew' => $rentNew,
				'backVisible' => $page==1?0:1,
				'frontVisible' => $page,
				'allPage' => $allPage
		] );
	}
	
	/////////////////////////////////////////////////////////////////
	
	
	public function actionImportRent() {
		$file = fopen ( \Yii::$app->getBasePath () . "\\..\\documents\\rent.csv", "r" );

		$id = 1;
		while ( ! feof ( $file ) ) {

			list ( $name, $near, $_address, $fullname ) = fgetcsv ( $file );
			if (empty ( trim ( $fullname ) ))
				continue;
			$address = new Address ();

			$add = explode ( "ม.", $_address );
			if (sizeof ( $add ) == 1)
				$number = $_address;
			else {
				$number = $add [0];
				$moo = $add [1];
			}

			$address->setAttributes ( [
					'number' => $number,
					'moo' => $moo,
					'district_id' => 5806
			] );
			if (! $address->save ()) {
				print_r ( $address->getErrors () );
				die ();
			} else {

				$user_id = User::findOne ( [
						'fullname',
						$fullname
				] );
				$rent = new Rent ();
				$rent->setAttributes ( [
						'name' => $name,
						'near' => $near,
						'user_id' => trim ( $user_id ),
						'address_id' => $address->id
				] );
				if (! $rent->save ()) {
					print_r ( $rent->getErrors () );
					die ();
				} else {
					echo "success " . $name . "<br>";
				}
				$id ++;
			}
		}
		fclose ( $file );
	}

	/**
	 * Displays a single Rent model.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionGetRent() {
		$androidApp = Rent::find ()->asArray ()->all ();
		echo json_encode ( $androidApp );
	}

//////////////// json for admin////////////////////
	public function actionGetAb(){

		$userand = User::findBySQL('SELECT username FROM User')->asArray()->all();
		echo json_encode($userand);
	}
//////////////////////////////////////////////////



	public function actionView($id) {
		/*
		 * $rents = Rent::find()->all();
		 * print_r ($rents);
		 * die();
		 */
		$rent = $this->findmodel ( $id );
		
		$modelfav  = Fav::findOne(['user_id'=>\Yii::$app->user->id,
				'rent_id' => $id
		]);
		
		/* $modelfav = Fav::find()
		->where(['user_id' =>  Yii::$app->user->identity->id ])
		->andWhere([ 'rent_id' => $id])
		->one(); */
		
		$message = "ไม่อนุญาตให้ใช้งาน";
		if (! $rent->visible)
			throw new HttpException ( null, $message );

		$cookies = Yii::$app->response->cookies;

		// add a new cookie to the response to be sent

		$cookies->add(new \yii\web\Cookie([
				'name' => 'rent'.$id,
				'value' => 'ABC',
				'expire' => time() + (60*60*24)
		]));
		

		
		$cookies = Yii::$app->request->cookies;
		
		if ($cookies->has('rent'.$id))
		{
			 /* echo $cookies->getValue('rent'.$id); */			
			//มี
		}
		else 
		{
			/* echo "AAAAAAAAAAAAAAAAA"; */
			//ไม่มี
			if (isset($id)) {
				$RentView = Rent::find()
				->where(['id' => $id])
				->one();
			
				
					/* echo "heyyyyyyyy"; */
					$view= $RentView->view;
					$countView =$view+1;
					/* echo $RentView->name;
						echo "___".$countView; */
					$viewCount = $this->findModel($id);
					$viewCount->view = $countView;
					$viewCount->save();
				
				
			}
		}
			

		

		 echo $cookies["expire"];
		//die();
		
		 return $this->render ( 'view',
		 		[
		 				'model' => $rent,
		 				'modelfav'=>$modelfav
		 		] );
		

		/*
		 * if ($this->render('view',['model'=>$this->findmodel($id)])) {
		 *
		 * return $this->render('view', [
		 * 'model' => $this->findModel($id)]);
		 * }
		 * else{
		 * $rents = Rent::find()->all();
		 * return $rents;
		 *
		 * }
		 */
	}
	/**
	 * Creates a new Rent model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCearlses(){
		$cookies = Yii::$app->response->cookies;
		$cookies->remove('cookies_usser');
		unset($cookies['cookies_usser']);
		
		 return $this->redirect('/tags/');
		
	}
	
	public function actionRentlist(){
		$get = \Yii::$app->request->get();
		$q = $get['q'];
		//echo "q = ".$get['q'];
	
		/* $query = new Query();
	
		$query->select('name')
		->from('country')
		->where('name LIKE "%' . $q .'%"')
		->orderBy('name');
		$command = $query->createCommand();
		$data = $command->queryAll();
		$out = []; */
		$data = Rent::find()->where(['like', 'name',$q])->all();
		$out = [];
		foreach ($data as $d) {
			$out[] = ['value' => $d['name']];
		}
		//$out[] = ['value'=>'เธฃเธฒเธ•เธฃเธต'];
		//$out[] = ['value'=>'เธฅเธทเธญเธ�เธฒ'];
		echo Json::encode($out);
	
	}
	
	public function actionViewmyfav(){
		
		$modelFav = new Fav();
		$favs = new Fav();
		$modelFav->user_id = Yii::$app->user->id;
		
		
		$favs = Fav::find()
		->where(['=', 'user_id', $modelFav->user_id])
		->all();
		
		/* $value = [];
		foreach ($favs as $f  ){
			$value[] = $f->rent_id;
		}
		$allrent = Rent::find()
		->where(['in', 'id', $value])
		->all();
 */

		return $this->render('_viewmyfav',[
				//'allrent'=>$allrent,
				'favs'=>$favs
				
				
		]);
		
	}
	public function actionMyfav($id){
		
		$model = $this->findModel($id);
		$modelFav = new Fav();
		
		$modelFav->rent_id = $model->id;
		$modelFav->user_id = Yii::$app->user->id;
		$rentMe = Fav::find()
		->where(['=', 'user_id', $modelFav->user_id])
		->andWhere(['=', 'rent_id', $modelFav->rent_id])
		->all();
		
		if (count($rentMe)==0){
			if($modelFav->save(false)) {
				print_r("save");
				$favs = Fav::find()
				->where(['=', 'user_id', $modelFav->user_id])
				->all();
				$value = [];
				foreach ($favs as $f  ){
					$value[] = $f->rent_id;
				}
				$allrent = Rent::find()
				->where(['in', 'id', $value])
				->all();

				return Yii::$app->getResponse()->redirect(array('/rent/viewmyfav'));
			}else return print_r("not save");
		}else {
			return Yii::$app->getResponse()->redirect(array('/rent/viewmyfav'));
		}

	}
	public function actionCreate() {
		//die("create");
		$modelRent = new Rent ();
		$modelHasAccessories = new RentHasAccessories ();
		$modelAddress = new Address ();
		$modelDistrict = new District ();
		$modelRoom = new Room();

		$post = @Yii::$app->request->post ();
		
		//$post['floor'];
		if($modelRent->load ( $post )) {
			$modelRent->edited =date("Y-m-d");
			$date = new \DateTime();
			$modelRent->user_id = Yii::$app->user->id;
			$modelAddress->load ( $post );

			if ($modelAddress->save ()) {
				$modelRent->address_id = $modelAddress->id;
				

				if ($modelRent->save ()) {
					$rentHasAccessories = $post ['RentHasAccessories'];

					foreach ( $rentHasAccessories ['accessories_id'] as $rentHasAccessory ) {
						$modelHasAccessoriesOne = new RentHasAccessories ();
						$modelHasAccessoriesOne->rent_id = $modelRent->id;
						$modelHasAccessoriesOne->accessories_id = $rentHasAccessory;
						$modelHasAccessoriesOne->save ();
						// echo $rentHasAccessory."<br>";
					}
				}

			}

			$this->Uploads ( false ,$modelRent->id);

			return $this->redirect(['view', 'id' => $modelRent->id]);
		}

		return $this->render ( 'create', [
				'modelHasAccessoriesOne' => $modelHasAccessories,
				'modelHasAccessories' => $modelHasAccessories,
				'modelRent' => $modelRent,

				'modelAddress' => $modelAddress,
				'amphur' => [ ],
				'district' => [ ]
		] );
	}
	/**
	 * Updates an existing Rent model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionTestReplace() {
		$accessories_id1 = [
				2,
				3,
				4,
				20,
				6
		];
		$accessories_id2 = [
				1,
				2,
				3,
				4,
				6,
				5
		];

		$student1 = [ ];
		for($i = 0; $i < sizeof ( $accessories_id1 ); $i ++) {
			$student = new RentHasAccessories ();
			$student->accessories_id = $accessories_id1 [$i];
			$student->rent_id = 3;
			$student1 [] = $student;
		}

		$student2 = [ ];
		for($i = 0; $i < sizeof ( $accessories_id2 ); $i ++) {
			$student = new RentHasAccessories ();
			$student->accessories_id = $accessories_id2 [$i];
			$student->rent_id = 3;
			$student2 [] = $student;
		}

		list ( $add, $remove ) = ReplaceObject::replace ( $student1, $student2 );

		echo "insert <br>";
		foreach ( $add as $a ) {
			echo $a->accessories_id . "<br>";
		}
		echo "<hr>";
		echo "remove <br>";
		foreach ( $remove as $a ) {
			echo $a->accessories_id . "<br>";
		}
	}
	public function actionUpdate($id) {
		$role=Yii::$app->user->identity->role;
				$idU=Yii::$app->user->identity->id;

				$user_id = Rent::find()
				->where(['=', 'user_id', $idU])
				->one();
				@$idI= $user_id->id;
			//	echo $id;
			//	echo $idI;


				//////////////////////////////////

		$modelRent = $this->findModel ( $id );
		$modelHasAccessories = RentHasAccessories::findAll ( [
				'rent_id' => $modelRent->id
		] );
		$modelAddress = $modelRent->address;
		/*
		 * $amphur = ArrayHelper::map($this->getAmphur($modelRent->province),'id','name');
		 * $district = ArrayHelper::map($this->getDistrict($modelRent->amphur),'id','name');
		 */

		// $modelRentHasAccessory = new RentHasAccessories();

		list ( $initialPreview, $initialPreviewConfig ) = $this->getInitialPreview ( $modelRent->id );

		$post = @Yii::$app->request->post ();

		// Model::validateMultiple([$modelRent,$modelHasAccessories])
		if ($modelRent->load ( $post )) {

			$modelAddress->load ( $post );

			$rentHasAccessoriesOld = RentHasAccessories::find()->asArray()->
			andFilterWhere(['rent_id' => $modelRent->id ])->select(['accessories_id'])->column();

			$rentHasAccessoriesNew = $post ['RentHasAccessories']['accessories_id'] ;

			list($add,$remove) = ReplaceObject::replace($rentHasAccessoriesOld, $rentHasAccessoriesNew);


			/* print_r($rentHasAccessoriesOld);
			echo "<hr>";
			print_r($rentHasAccessoriesNew);
			echo "<hr>";
			print_r($add);
			echo "<hr>";
			print_r($remove);
			die();  */

			//remove accessory
			foreach ( $remove as $rentHasAccessory ) {
				$modelHasAccessoriesOne = RentHasAccessories::deleteAll(
						['accessories_id'=>$rentHasAccessory,'rent_id'=>$modelRent->id]);
			}

			//add new accessory
			foreach ( $add as $rentHasAccessory ) {
				$modelHasAccessoriesOne = new RentHasAccessories ();
				$modelHasAccessoriesOne->rent_id = $modelRent->id;
				$modelHasAccessoriesOne->accessories_id = $rentHasAccessory;
				$modelHasAccessoriesOne->save ();
			}

			//$this->Uploads ( false );
			$this->Uploads ( false, $modelRent->id );
			if ($modelRent->save ()) {
				return $this->redirect ( [
						'view',
						'id' => $modelRent->id
				] );
			}
		}

		if ($modelHasAccessories)
			$modelHasAccessoriesOne = $modelHasAccessories [0];
		else
			$modelHasAccessoriesOne = new RentHasAccessories ();

		return $this->render ( 'update', [
				'modelHasAccessoriesOne' => $modelHasAccessoriesOne,
				'modelHasAccessories' => $modelHasAccessories,
				'modelRent' => $modelRent,
        		/* 'amphur'=> $amphur,
        		'district' =>$district, */
        		'modelAddress' => $modelAddress,
				'initialPreview' => $initialPreview,
				'initialPreviewConfig' => $initialPreviewConfig
		] );

	}

	/**
	 * Deletes an existing Rent model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionClose($id){
		$model = $this->findModel($id);
    	$model->visible=0;
    	if ( !$model->save() ){
    		print_r($model->getErrors());
    		die();
    	}
    	return Yii::$app->getResponse()->redirect(array('/rent/myrent'));
	}
	public function actionCloseadmin($id){
		$model = $this->findModel($id);
		$model->visible=0;
		if ( !$model->save() ){
			print_r($model->getErrors());
			die();
		}
		return Yii::$app->getResponse()->redirect(array('/rent/index'));
	}
	public function actionOpenadmin($id){
		$model = $this->findModel($id);
		$model->visible=1;
		if ( !$model->save() ){
			print_r($model->getErrors());
			die();
		}
		return Yii::$app->getResponse()->redirect(array('/rent/index'));
	}
	public function actionDelete($id) {
		
		//$model = $this->findModel ( $id );
		$model = Rent::find()->where(['id'=>$id])->one();
		$model->visible = 0;
		$model->save();
		return Yii::$app->getResponse()->redirect(array('/rent/myrent'));
		//return $this->redirect ( 'view?id='.$id );
		/* $this->findModel ( $id )->delete ();

		$modelHasAccessories = new RentHasAccessories ();
		$post = @Yii::$app->request->post ();

		$rentHasAccessories = $post ['RentHasAccessories'];

		print_r ( $rentHasAccessories );
		die ();
		foreach ( $rentHasAccessories ['accessories_id'] as $rentHasAccessory ) {
			$modelHasAccessoriesOne = new RentHasAccessories ();
			$modelHasAccessoriesOne->rent_id = $modelRent->id;
			$modelHasAccessoriesOne->accessories_id = $rentHasAccessory;
			$modelHasAccessoriesOne->delete ();
		}

		$model = $this->findModel ( $id );
		$model->delete ();
		// remove upload file & data
		$this->removeUploadDir ( $model->id );
		Uploads::deleteAll ( [
				'rent_id' => $model->id
		] );

		return $this->redirect ( [
				'index'
		] ); */
	}

	/**
	 * Finds the Rent model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 * @return Rent the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Rent::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
	public function actionGetAmphur() {
		$out = [ ];
		if (isset ( $_POST ['depdrop_parents'] )) {
			$parents = $_POST ['depdrop_parents'];
			if ($parents != null) {
				$province_id = $parents [0];
				$out = $this->getAmphur ( $province_id );
				echo Json::encode ( [
						'output' => $out,
						'selected' => ''
				] );
				return;
			}
		}
		echo Json::encode ( [
				'output' => '',
				'selected' => ''
		] );
	}
	public function actionGetDistrict() {
		$out = [ ];
		if (isset ( $_POST ['depdrop_parents'] )) {
			$ids = $_POST ['depdrop_parents'];
			$province_id = empty ( $ids [0] ) ? null : $ids [0];
			$amphur_id = empty ( $ids [1] ) ? null : $ids [1];
			// echo "province ".$province_id. " :: amphur ".$amphur_id;
			// die();
			if ($province_id != null) {
				$data = $this->getDistrict ( $amphur_id );
				echo Json::encode ( [
						'output' => $data,
						'selected' => ''
				] );
				return;
			}
		}
		echo Json::encode ( [
				'output' => '',
				'selected' => ''
		] );
	}
	protected function getAmphur($id) {
		$datas = Amphur::find ()->where ( [
				'province_id' => $id
		] )->all ();
		return $this->MapData ( $datas, 'id', 'name' );
	}
	protected function getDistrict($id) {
		$datas = District::find ()->where ( [
				'amphur_id' => $id
		] )->all ();
		return $this->MapData ( $datas, 'id', 'name' );
	}
	protected function MapData($datas, $fieldId, $fieldName) {
		$obj = [ ];
		foreach ( $datas as $key => $value ) {
			array_push ( $obj, [
					'id' => $value->{$fieldId},
					'name' => $value->{$fieldName}
			] );
		}
		return $obj;
	}

	/*
	 * |*********************************************************************************|
	 * |================================ Upload Ajax ====================================|
	 * |*********************************************************************************|
	 */
	public function actionUploadAjax() {
		//$this->Uploads ( true );
	}
	private function CreateDir($folderName) {
		if ($folderName != NULL) {
			$basePath = Rent::getUploadPath ();
			if (BaseFileHelper::createDirectory ( $basePath . $folderName, 0777 )) {
				BaseFileHelper::createDirectory ( $basePath . $folderName . '/thumbnail', 0777 );
			}
		}
		return;
	}
	private function removeUploadDir($dir) {
		BaseFileHelper::removeDirectory ( Rent::getUploadPath () . $dir );
	}

	private function Uploads($isAjax = false,$id) {
		if (Yii::$app->request->isPost) {
			$images = UploadedFile::getInstancesByName ( 'upload_ajax' );
			 //print_r($images);
			//die(); 
			if ($images) {
				if ($isAjax === true) {
					//denied ajax upload b/c no id of rent from action create
					return true;
					 $id =Yii::$app->request->post('id');
				}

				$this->CreateDir ( $id );
				foreach ( $images as $file ) {
					$fileName = $file->baseName . '.' . $file->extension;
					$realFileName = md5 ( $file->baseName . time () ) . '.' . $file->extension;
					$savePath = Rent::UPLOAD_FOLDER . '/' . $id . '/' . $realFileName;
					if ($file->saveAs ( $savePath )) {
						if ($this->isImage ( Url::base ( true ) . '/' . $savePath )) {
							$this->createThumbnail ( $id, $realFileName );
						}

						$model = new Uploads ();
						$model->file_name = $fileName;
						$model->real_filename = $realFileName;
						$model->rent_id = $id;

						$model->save ();
						if ($isAjax === true) {
							echo json_encode ( [
									'success' => 'true'
							] );
						}
					} else {
						if ($isAjax === true) {
							echo json_encode ( [
									'success' => 'false',
									'eror' => $file->error
							] );
						}
					}
				}
			}
		}
	}
	private function getInitialPreview($id) {
		// $datas = Uploads::find()->where(['rent_id'=>$id])->all();
		$datas = Uploads::findAll ( [
				'rent_id' => $id
		] );
		$initialPreview = [ ];
		$initialPreviewConfig = [ ];
		foreach ( $datas as $key => $value ) {
			array_push ( $initialPreview, $this->getTemplatePreview ( $value ) );
			array_push ( $initialPreviewConfig, [
					'caption' => $value->file_name,
					'width' => '120px',
					'url' => Url::to ( [
							'/photo-library/deletefile-ajax'
					] ),
					'key' => $value->upload_id
			] );
		}
		return [
				$initialPreview,
				$initialPreviewConfig
		];
	}
	public function isImage($filePath) {
		return @is_array ( getimagesize ( $filePath ) ) ? true : false;
	}
	private function getTemplatePreview(Uploads $model) {
		$filePath = Rent::getUploadUrl () . $model->rent_id . '/thumbnail/' . $model->real_filename;
		$isImage = $this->isImage ( $filePath );
		if ($isImage) {
			$file = Html::img ( $filePath, [
					'class' => 'file-preview-image',
					'alt' => $model->file_name,
					'title' => $model->file_name
			] );
		} else {
			$file = "<div class='file-preview-other'> " . "<h2><i class='glyphicon glyphicon-file'></i></h2>" . "</div>";
		}
		return $file;
	}
	private function createThumbnail($folderName, $fileName, $width = 250) {
		$uploadPath = Rent::getUploadPath () . '/' . $folderName . '/';
		$file = $uploadPath . $fileName;
		$image = Yii::$app->image->load ( $file );
		$image->resize ( $width );
		$image->save ( $uploadPath . 'thumbnail/' . $fileName );
		return;
	}
	public function actionDeletefileAjax() {
		$model = Uploads::findOne ( Yii::$app->request->post ( 'key' ) );
		if ($model !== NULL) {
			$filename = Rent::getUploadPath () . $model->id . '/' . $model->real_filename;
			$thumbnail = Rent::getUploadPath () . $model->id . '/thumbnail/' . $model->real_filename;
			if ($model->delete ()) {
				@unlink ( $filename );
				@unlink ( $thumbnail );
				echo json_encode ( [
						'success' => true
				] );
			} else {
				echo json_encode ( [
						'success' => false
				] );
			}
		} else {
			echo json_encode ( [
					'success' => false
			] );
		}
	}
}
