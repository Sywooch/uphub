<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Uploads;
use frontend\models\PhotoLibrary;
use frontend\models\PhotoLibary;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\html;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\base\Object;


class PhotoLibraryController extends Controller {
	public function behaviors() {
		return [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'delete' => [ 
										'post' 
								] 
						] 
				] 
		];
	}

	public function actionIndex() {
		$searchModel = new PhotoLibrary ();
		// print_r(Yii::$app->request->queryParams);
		// die();
		if (! empty ( Yii::$app->request->queryParams )) {
			$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
			return $this->render ( 'index', [ 
					'searchModel' => $searchModel,
					'dataProvider' => $dataProvider 
			] );
		}
		
		return $this->render ( 'index-null', [ 
				'searchModel' => $searchModel 
		] );
	}
	

	public function actionView($id) {
		return $this->render ( 'view', [ 
				'model' => $this->findModel ( $id ) 
		] );
	}
	

	public function actionCreate() {
		$model = new PhotoLibrary ();
		
		
		if ($model->load ( Yii::$app->request->post () )) {
			
			$this->Uploads ( false );
			
			if ($model->save ()) {
				return $this->redirect ( [ 
						'view',
						'id' => $model->id 
				] );
			}
		} else {
			$model->rent_id = substr ( Yii::$app->getSecurity ()->generateRandomString (), 10 );
		}
		
		return $this->render ( 'create', [ 
				'model' => $model 
		] );
	}
	

public function actionUpdate($id)
 {
     $model = $this->findModel($id);

     list($initialPreview,$initialPreviewConfig) = $this->getInitialPreview($model->ref);

     if ($model->load(Yii::$app->request->post())) {
         $this->Uploads(false);

         if($model->save()){
              return $this->redirect(['view', 'id' => $model->id]);
         }
     }

     return $this->render('update', [
         'model' => $model,
          'initialPreview'=>$initialPreview,
          'initialPreviewConfig'=>$initialPreviewConfig
     ]);

 }
	

	public function actionDelete($id) {
		$this->findModel ( $id )->delete ();
		
		return $this->redirect ( [ 
				'index' 
		] );
	}
	
	
	protected function findModel($id) {
		if (($model = PhotoLibrary::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
	
	
	/*
	 * |*********************************************************************************|
	 * |================================ Upload Ajax ====================================|
	 * |*********************************************************************************|
	 */
	public function actionUploadAjax() {
		$this->Uploads ( true );
	}
	private function CreateDir($folderName) {
		if ($folderName != NULL) {
			$basePath = PhotoLibrary::getUploadPath ();
			if (BaseFileHelper::createDirectory ( $basePath . $folderName, 0777 )) {
				BaseFileHelper::createDirectory ( $basePath . $folderName . '/thumbnail', 0777 );
			}
		}
		return;
	}
	private function removeUploadDir($dir) {
		BaseFileHelper::removeDirectory ( PhotoLibrary::getUploadPath () . $dir );
	}
	private function Uploads($isAjax = false) {
		if (Yii::$app->request->isPost) {
			$images = UploadedFile::getInstancesByName ( 'upload_ajax' );
			if ($images) {
				
				if ($isAjax === true) {
					$ref = Yii::$app->request->post ( 'id' );
				} else {
					$PhotoLibrary = Yii::$app->request->post ( 'PhotoLibrary' );
					$ref = $PhotoLibrary ['id'];
				}
				
				$this->CreateDir ( $ref );
				
				foreach ( $images as $file ) {
					$fileName = $file->baseName . '.' . $file->extension;
					$realFileName = md5 ( $file->baseName . time () ) . '.' . $file->extension;
					$savePath = PhotoLibrary::UPLOAD_FOLDER . '/' . $ref . '/' . $realFileName;
					if ($file->saveAs ( $savePath )) {
						
						if ($this->isImage ( Url::base ( true ) . '/' . $savePath )) {
							$this->createThumbnail ( $ref, $realFileName );
						}
						
						$model = new Uploads ();
						$model->ref = $ref;
						$model->file_name = $fileName;
						$model->real_filename = $realFileName;
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
	private function getInitialPreview($ref) {
		$datas = Uploads::find ()->where ( [ 
				'ref' => $ref 
		] )->all ();
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
		$filePath = PhotoLibrary::getUploadUrl () . $model->ref . '/thumbnail/' . $model->real_filename;
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
		$uploadPath = PhotoLibrary::getUploadPath () . '/' . $folderName . '/';
		$file = $uploadPath . $fileName;
		$image = Yii::$app->image->load ( $file );
		$image->resize ( $width );
		$image->save ( $uploadPath . 'thumbnail/' . $fileName );
		return;
	}
	public function actionDeletefileAjax() {
		$model = Uploads::findOne ( Yii::$app->request->post ( 'key' ) );
		if ($model !== NULL) {
			$filename = PhotoLibrary::getUploadPath () . $model->rent_id . '/' . $model->real_filename;
			$thumbnail = PhotoLibrary::getUploadPath () . $model->rent_id . '/thumbnail/' . $model->real_filename;
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

