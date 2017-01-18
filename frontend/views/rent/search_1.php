<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Rent;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\Typeahead;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Url;
?>






<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['search'],
        'method' => 'get',
        'options' => ['data-pjax' => true ,
        
        ]
    ]); ?>
    <div class="input-group">
      <?php 
      //Html::activeTextInput($model, 'name',['class'=>'form-control','placeholder'=>'ค้นหาข้อมูล...']);
      
    echo Typeahead::widget([
    		'model' => $model, 
    		'attribute' => 'name',
    		'options' => ['placeholder' => 'ค้นหาข้อมูล...'],
    		'pluginOptions' => ['highlight'=>true],
    		'dataset' => [
    				[
    						'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
    						'display' => 'value',
    						//'prefetch' => $baseUrl . '/samples/countries.json',
    						'remote' => [
    								'url' => Url::to(['rent/rentlist']) . '?q=%QUERY',
    								'wildcard' => '%QUERY'
    						],
    						'limit' => 5
    				]
    		]
    ]);
     ?>

	
   
 <?php
 $form->field($model, 'near')->
 dropdownList(['หน้ามอ' => 'หน้ามอ', 'แม่กา' => 'ตลาดแม่กา', 'ไฟฟ้า' => 'การไฟฟ้า', 'แม่ต๋ำ' => 'อ่างแม่ต๋ำ']
 		, ['prompt' => '--- ค้นหาจากสถานที่ใกล้เคียง ---']);
   echo $form->field($model, 'near')->widget(Select2::classname(), [
    'data' => ['หน้ามอ' => 'หน้ามหาวิทยาลัย', 'แม่กา' => 'ตลาดแม่กา','ไฟฟ้า' => 'การไฟฟ้า'
    		,'พีเจไนท์' => 'พีเจไนท์','อนามัย' => 'สถานีอนามัย','วงเวียน' => 'ก๋วยเตี๋ยววงเวียน','กรีนวิง' =>'กรีนวิง',
    		'เจริญภัณฑ์' => 'เจริญภัณฑ์สาขาม.พะเยา','ร้านแซ่บหน้ามอ' =>'ร้านแซ่บหน้ามอ'
    		,'โลตัส' => 'โลตัสสาขาม.พะเยา','อ่างแม่ต๋ำ' => 'อ่างแม่ต๋ำ','one more up' => 'one more up'],
    'options' => ['placeholder' => '--- ค้นหาจากสถานที่ใกล้เคียง ---', 'onchange'=>'this.form.submit()'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
   

   ?>
   
   
   
   
      <?= $form->field($model, 'type_gen')->
      dropdownList(
      		['หญิง' => 'หอพักหญิง', 'ชาย' => 'หอพักชาย' ,'บ้าน'=>'บ้าน','อื่นๆ'=>'อื่นๆ']
      		,['prompt' => '--- ค้นหาจากประเภทหอพัก---', 'onchange'=>'this.form.submit()']
      		 
      		
      		) ?>
      		
       
      
       <?= $form->field($model, 'q')->
      dropdownList(['0' => 'น้อยกว่า 1000บาท','1' => '1001-2000 บาท', '2' => '2001-3000 บาท', '3' => '3001-4000 บาท','4' => 'มากกว่า 4000บาท']
      		, ['prompt' => '--- ค้นหาจากช่วงราคา---', 'onchange'=>'this.form.submit()']) ?>
      		
    <br>
        <button class="btn btn-default" type="submit" style="margin-top: 15 px;margin: auto;display: block;"> 
        <i class="glyphicon glyphicon-search">
        
        </i> ค้นหา</button>
        
      
      
    </div>
    <?php ActiveForm::end(); ?>
    


</div>
