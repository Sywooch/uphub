<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

use frontend\models\User;

use kartik\tabs\TabsX;
use yii\widgets\Pjax;


$items = [];
$label = ['member','owner','admin','ban'];

	
	//$id = $searchModel->id;
    echo   GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    	'pjax' => true, 
    		'pjaxSettings' =>[
    				'neverTimeout'=>true,
    				'options'=>[
    						'id'=>'data-pjax-container'.$i,
    						'enablePushState'=> false,
    				]
    		], 
    	
        'columns' => [
        		['class' => 'kartik\grid\CheckboxColumn',
        		'checkboxOptions' => function ($model, $key, $index, $column) use ($i) {
        			return ['value' => $model->id,'class'=>'checkbox'.$i];
        		}
        		],
            ['class' => 'yii\grid\SerialColumn'],
        		'username',
        		'fullname',
        		'email:email',
        		'created_at:dateTime',
        		'updated_at:dateTime',
        		
        		//['class' => 'yii\grid\ActionColumn'],
              [
            	'class' => 'yii\grid\ActionColumn',
         	   	'options'=>['style'=>'width:150px;'],
            	'buttonOptions'=>['class'=>'btn btn-default'],
            	'template'=>'
              		<div class="btn-group btn-group-sm text-center" role="group"> {view} {update}</div>
              		
              		'
            ], 
        ],
    ]);
    
    //echo $label[$i];
 ?>
 
 
 <div class="row">
	<?php if ($label[$i] == 'member'  ) {?>
  <div class="col-md-2"><?=Html::a('เจ้าของหอพัก', '#', ['class' => 'btn btn-success','onclick'=>'changeStatus(20,\''.$i.'\')'])?></div>
  <div class="col-md-2"><?=Html::a('ปิดการใช้งาน', '#', ['class' => 'btn btn-danger','onclick'=>'changeStatus(40,\''.$i.'\')'])?></div>
  <?php }?>
  
  <?php if ($label[$i] == 'owner'  ) {?>
  <div class="col-md-2"><?=Html::a('สมาชิก', '#', ['class' => 'btn btn-success','onclick'=>'changeStatus(10,\''.$i.'\')'])?></div>
  <div class="col-md-2"><?=Html::a('ปิดการใช้งาน', '#', ['class' => 'btn btn-danger','onclick'=>'changeStatus(40,\''.$i.'\')'])?></div>
  <?php }?>
  
  <?php if ($label[$i] == 'admin' ) {?>
  <div class="col-md-2"><?=Html::a('ปิดการใช้งาน', '#', ['class' => 'btn btn-danger','onclick'=>'changeStatus(40,\''.$i.'\')'])?></div>
  <?php }?>
  
  <?php if ($label[$i] == 'ban' ) {?>
  <div class="col-md-2"><?=Html::a('เปิดการใช้งาน', '#', ['class' => 'btn btn-success','onclick'=>'changeStatus(10,\''.$i.'\')'])?></div>
  <?php }?>
  
  <div class="col-md-8"></div>
  
</div>
 <?php 

//echo "<hr>";
?>
<script type="text/javascript">

function changeStatus(stat_id,id){ //แก้ไขสิทธ์
	/*var keys = $('#data-pjax-container'+id).yiiGridView('getSelectedRows');
		alert(keys);*/
		
	 var matches = []; //ส่งค่า ID 
	 var keys = $('.checkbox' + id + ':checked').each(function(){
		matches.push(this.value);

		//alert("stat_id : "+stat_id);
		
		// alert("keys : "+keys);
		//alert("matches : "+matches); 
	});

		if ( confirm('ยืนยันการแก้ไขสิทธิ์') ){
			$.ajax({
				url:   'index',
				type:  'post',
				data: {id : matches , role_id : stat_id},
				error: function (xhr, status, error) {
					alert('There was an error with your request.'
							+ xhr.responseText);
				}
			}).done(function (data) {
				
				$.pjax({'container':'#data-pjax-container'});
				//$.pjax({'container':'#data-pjax-container1', async:false});
				//$.pjax({'container':'#data-pjax-container2', async:false});
			});

		} 

}

</script>
