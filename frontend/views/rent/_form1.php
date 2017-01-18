<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\date\DatePicker;
use frontend\models\Accessories;
use frontend\models\Rent;



$accessories = Accessories::find()->all();
$accessoriesArray = [];


foreach ($modelRent->rentHasAccessories as $rentHasAccessory ){
	$accessoriesArray[] = $rentHasAccessory->id;
}

?>

<div class="rent-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	<?=$form->errorSummary($modelRent) ?>
     <div class='container'>
    <div class='panel panel-primary dialog-panel'>
      <div class='panel-heading'>
        <h5>รายละเอียดข้อมูลที่จำเป็นเกี่ยวกับที่พัก</h5>
      </div>
      <div class='panel-body'>
        <form class='form-horizontal' role='form'>
        <div class='form-group'>
           
     <div class="row">
    <div class="col-md-12" >
      <div class="row">
        <div class="col-md-6">
        
        	<?= $form->field($modelRent, 'id')->hiddenInput(['maxlength' => true]) ?>
        	
            <?= $form->field($modelRent, 'name')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($modelRent, 'address')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($modelRent, 'near')->textInput(['maxlength' => true]) ?>

		    <?= $form->field($modelRent, 'intendant')->textInput(['maxlength' => true]) ?>

		    <?= $form->field($modelRent, 'user_id')->textInput() ?>
		    
		    <?= $form->field($modelRent, 'cost_water')->textInput() ?>
			
		    <?= $form->field($modelRent, 'cost_elec')->textInput() ?>
	
		    <?= $form->field($modelRent, 'tel1')->textInput(['maxlength' => true]) ?>
		
		    <?= $form->field($modelRent, 'tel2')->textInput(['maxlength' => true]) ?>
        
        </div>
        <div class="col-md-6">
        	<?= $form->field($modelRent, 'web')->textInput(['maxlength' => true]) ?>
		    
		    
		    <?=
		    $form->field($modelRent, 'type_gen')
		         ->dropDownList(['prompt' => '','หอพักหญิง','หอพักชาย','บ้าน'])
 
			?>
					    <?=
		    $form->field($modelRent, 'type_rent')
		         ->dropDownList(['prompt' => '','ที่พักรายวัน','ที่พักรายเดือน'])
 
			?>
		
		
		    <?= $form->field($modelRent, 'condition')->textarea(['rows' => 6]) ?>
		    
		        <?= $form->field($modelRent, 'edited')->widget(
            DatePicker::className(), [
                'language' => 'th',
                 'options' => ['placeholder' => 'Select issue date ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
        ]);?>

			<?= $this->render('_rentHasAccesories.php', [
					'modelHasAccessoriesOne'=>$modelHasAccessoriesOne,
        'modelHasAccessories' => $modelHasAccessories,
        'modelRent'=>$modelRent,
    		'initialPreview'=>$initialPreview,
    		'initialPreviewConfig'=>$initialPreviewConfig,
			'accessories'=>$accessories,
			'form'=>$form,
    ]) ?>
		        
        </div> 
      </div>
      	<div class="form-group field-upload_files">
      		<label class="control-label" for="upload_files[]"> ภาพถ่าย </label>
			    <div>
			    <?= FileInput::widget([
			                   'name' => 'upload_ajax[]',
			                   'options' => ['multiple' => true,'accept' => 'image/*'], //'accept' => 'image/*' หากต้องเฉพาะ image
			                    'pluginOptions' => [
			                        'overwriteInitial'=>false,
			                        'initialPreviewShowDelete'=>true,
			                       'initialPreview'=> $initialPreview,
			                        'initialPreviewConfig'=> $initialPreviewConfig,
			                         'uploadUrl' => Url::to(['/photo-library/upload-ajax']),
			                        'uploadExtraData' => [
			                            'id' => $modelRent->id,
			                        ],
			                        'maxFileCount' => 100
			                    ]
			                ]);
			    ?>
			    </div>
			  </div>
          <div class="form-group">
        <?= Html::submitButton($modelRent->isNewRecord ? 'Create' : 'Update', ['class' => $modelRent->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>

          </div>
          

        </form>
      </div>

  </div>
</div>
    

    <?php ActiveForm::end(); ?>
 