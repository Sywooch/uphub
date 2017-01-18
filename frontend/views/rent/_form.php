<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\date\DatePicker;
use kartik\widgets\DepDrop;
use frontend\models\Accessories;
use frontend\models\Rent;
use frontend\models\Province;
use frontend\models\District;
use frontend\models\Amphur;
use frontend\models\Room;
use frontend\models\Address;
use yii\helpers\VarDumper;



$accessories = Accessories::find()->all();
$accessoriesArray = [];



foreach ($modelRent->rentHasAccessories as $rentHasAccessory ){
	$accessoriesArray[] = $rentHasAccessory->id;
}

/* $a= ArrayHelper::map(Province::find()->all());
echo $a;
die(); */
?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	<?=$form->errorSummary($modelRent) ?>
	<div >
    <div class="row">
        <div class="col-md-6">
        <?php $form->field($modelRent, 'id')->hiddenInput(['maxlength' => true]) ?>
        	
            <?= $form->field($modelRent, 'name')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($modelRent, 'intendant')->textInput(['maxlength' => true]) ?>
            
            <?php $form->field($modelRent, 'type_rent')->hiddenInput() ?>
            
            <?=$form->field($modelRent, 'near')
		         ->dropDownList(['หน้ามอ' => 'หน้ามหาวิทยาลัย', 'แม่กา' => 'ตลาดแม่กา','ไฟฟ้า' => 'การไฟฟ้า'
    		,'พีเจไนท์' => 'พีเจไนท์','อนามัย' => 'สถานีอนามัย','วงเวียน' => 'ก๋วยเตี๋ยววงเวียน',
    		'เจริญภัณฑ์' => 'เจริญภัณฑ์สาขาม.พะเยา'
    		,'โลตัส' => 'โลตัสสาขาม.พะเยา','อ่างแม่ต๋ำ' => 'อ่างแม่ต๋ำ','one more up' => 'one more up','กรีนวิง' =>'กรีนวิง','ร้านแซ่บหน้ามอ' =>'ร้านแซ่บหน้ามอ'])
 
			?>
			
			<?= $form->field($modelRent, 'cost_water')->textInput() ?>
			
		    <?= $form->field($modelRent, 'cost_elec')->textInput() ?>
	
		    <?= $form->field($modelRent, 'tel1')->textInput(['maxlength' => true]) ?>
		
		    <?= $form->field($modelRent, 'tel2')->textInput(['maxlength' => true]) ?>
        
        </div>
        <div class="col-md-6">
        	        	<?= $form->field($modelRent, 'web')->textInput(['maxlength' => true]) ?>
		    
		    
		    <?=
		    $form->field($modelRent, 'type_gen')
		         ->dropDownList(['เลือก' => '','หอพักหญิง'=>'หอพักหญิง','หอพักชาย'=>'หอพักชาย','บ้าน'=>'บ้าน','อื่นๆ'=>'อื่นๆ'])
 
			?>
					   
		
		
		    <?= $form->field($modelRent, 'condition')->textarea(['rows' => 6]) ?>
		    

			<?= $this->render('_rentHasAccesories.php', [
					'modelHasAccessoriesOne'=>$modelHasAccessoriesOne,
        'modelHasAccessories' => $modelHasAccessories,
        'modelRent'=>$modelRent,
    		'initialPreview'=>$initialPreview,
    		'initialPreviewConfig'=>$initialPreviewConfig,
			'accessories'=>$accessories,
			'form'=>$form,
    ]) ?>
  
<div class="panel panel-default">
  <div class="panel-heading">ที่อยู่</div>
  <div class="panel-body">
   <div class="row">
  	<div class="col-sm-4 col-md-4">
  	<?=$form->field($modelAddress,'number')->textInput()?>
  	</div>
  	
  	<div class="col-sm-4 col-md-4">
  	<?=$form->field($modelAddress,'moo')->textInput()?>
  	</div>
  </div>
  
  <div class="row">
    <div class="col-sm-4 col-md-4">
       <?=$form->field($modelAddress, 'province_id')->dropdownList(
          ArrayHelper::map(
          		$modelAddress->listProvince,
            'id',
            'name'),
            [
                'id'=>'ddl-province',
                'prompt'=>'เลือกจังหวัด',
            		'options' =>
            		[
            				$modelRent->isNewRecord?'44':$modelRent->address->district->amphur->province_id
            				=> ['Selected' => 'selected']
            		],

       ]
       		
       		
       		); 
       ?>
	</div>
	 <div class="col-sm-4 col-md-4">
       <?=$form->field($modelAddress, 'amphur_id')->widget(DepDrop::classname(),
            [
            		'options'=>['id'=>'ddl-amphur'],
            		'data'=> ArrayHelper::map(
            				$modelRent->isNewRecord?[]:$modelAddress->listAmphur,
            'id',
            'name'),
       'pluginOptions'=>[
                'depends'=>['ddl-province'],
                'placeholder'=>'เลือกอำเภอ',
                'url'=>Url::to(['/rent/get-amphur'])
            ]
        ]);  ?>
	</div>
	
    <div class="col-sm-4 col-md-4">
      <?=$form->field($modelAddress, 'district_id')->widget(DepDrop::classname(), [
      		'options'=>['id'=>'ddl-district'],
      		'data'=> ArrayHelper::map(
      				$modelRent->isNewRecord?[]:$modelAddress->listDistrict,
            		'id',
            		'name'
      		),
      		
            'pluginOptions'=>[
                'depends'=>[ 'ddl-province','ddl-amphur'],
                'placeholder'=>'เลือกตำบล',
                'url'=>Url::to(['/rent/get-district'])
            ]
        ]);  ?>
    </div>
    </div>
            <div class="form-group field-upload_files">
      		<label class="control-label" for="upload_files[]"> ภาพถ่าย </label>
			    <div>
			    <?= FileInput::widget([
			                   'name' => 'upload_ajax[]',
			                   'options' => ['multiple' => true,'accept' => 'image/*'], 
			                    'pluginOptions' => [
			                        'overwriteInitial'=>false,
			                        'initialPreviewShowDelete'=>true,
			                       'initialPreview'=> $initialPreview,
			                        'initialPreviewConfig'=> $initialPreviewConfig,
			                         'uploadUrl' => Url::to(['/rent/upload-ajax']),
			                        'uploadExtraData' => [
			                            'id' => $modelRent->id,
			                            
			                        ],
			                        'maxFileCount' => 100
			                    ],
					    		/* 'pluginEvents' => [
					    				'fileuploaded' => "function(event, data, previewId, index) {
		                                            $('#pesan').show();
		                                            $('#pesan').html(data.response.pesan);
		                                        }"
					    		] */
			                ]);
			    ?>
			    </div>
			  </div>
        </div>
    </div>
    

     
			  </div>
			   </div>
			   
			    <div class="form-group" align="center">
        <?= Html::submitButton($modelRent->isNewRecord ? 'ยอมรับเงื่องไขและลงประกาศ' : 'Update', ['class' => $modelRent->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
           <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    </div>
			   </div>


    <?php ActiveForm::end(); ?>
 