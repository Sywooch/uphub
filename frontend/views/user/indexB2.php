<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

use frontend\models\User;

use kartik\tabs\TabsX;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    

<?php
$items = [];
$label = ['member','owner','admin','ban'];
for($i=0;$i<sizeof($searchModel);$i++){
	
	$id = $searchModel[$i]->id;
    $content =  GridView::widget([
        'dataProvider' => $dataProvider[$i],
        'filterModel' => $searchModel[$i],
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
        		'checkboxOptions' => function ($model, $key, $index, $column) use ($id) {
        			return ['value' => $model->id,'class'=>'checkbox'.$id];
        		}
        		],
            ['class' => 'yii\grid\SerialColumn'],
        		'username',
        		'email:email',
        		'created_at:dateTime',
        		'updated_at:dateTime',
        		/* [
        		'attribute'=>'status',
        		'filter'=>User::getItemsAlias('status'),
        		'value'=>function($model){
        			return $model->statusName;
        		}
        		], */
        		//['class' => 'yii\grid\ActionColumn'],
              [
            	'class' => 'yii\grid\ActionColumn',
         	   	'options'=>['style'=>'width:150px;'],
            	'buttonOptions'=>['class'=>'btn btn-default'],
            	'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view} </div>'
            ], 
        ],
    ]);
    
    $items[] = [
						'label' => $label[$i],
						'content' =>$content,
						'active' => $i==0?true:false
				];
    echo $label[$i];
 ?>
 
 
 <div class="row">
	<?php if ($label[$i] == 'member'  ) {?>
  <div class="col-md-2"><?=Html::a('เจ้าของหอพัก', '#', ['class' => 'btn btn-success','onclick'=>'changeStatus(20,\''.$id.'\')'])?></div>
  <div class="col-md-2"><?=Html::a('ปิดการใช้งาน', '#', ['class' => 'btn btn-danger','onclick'=>'changeStatus(0,\''.$id.'\')'])?></div>
  <?php }?>
  
  <?php if ($label[$i] == 'owner'  ) {?>
  <div class="col-md-2"><?=Html::a('สมาชิก', '#', ['class' => 'btn btn-success','onclick'=>'changeStatus(10,\''.$id.'\')'])?></div>
  <div class="col-md-2"><?=Html::a('ปิดการใช้งาน', '#', ['class' => 'btn btn-danger','onclick'=>'changeStatus(0,\''.$id.'\')'])?></div>
  <?php }?>
  
  <?php if ($label[$i] == 'admin' ) {?>
  <div class="col-md-2"><?=Html::a('ปิดการใช้งาน', '#', ['class' => 'btn btn-danger','onclick'=>'changeStatus(0,\''.$id.'\')'])?></div>
  <?php }?>
  
  <?php if ($label[$i] == 'ban' ) {?>
  <div class="col-md-2"><?=Html::a('เปิดการใช้งาน', '#', ['class' => 'btn btn-success','onclick'=>'changeStatus(10,\''.$id.'\')'])?></div>
  <?php }?>
  
  <div class="col-md-8"></div>
  
</div>
 <?php 
} 
echo "<hr>";
?>


<?php 

Pjax::begin(['id'=>'data-pjax-container','enablePushState'=>false]);
echo TabsX::widget([
		
		'position' => TabsX::POS_ABOVE,
		'align' => TabsX::ALIGN_LEFT,
    	'bordered'=>true,

	
		'items' => $items,
]);
Pjax::end();
?>
</div>

<script type="text/javascript">

function changeStatus(stat_id,id){ //แก้ไขสิทธ์
	/*var keys = $('#data-pjax-container'+id).yiiGridView('getSelectedRows');
		alert(keys);*/
		
	 var matches = []; // มีเช็คบล๊อกกี่ตัว
	var keys = $('.checkbox'+id+':checked').each(function(){
		matches.push(this.value);
	});

		if ( confirm('ยืนยันการแก้ไขสิทธิ์') ){
			$.ajax({
				url:   'index',
				type:  'post',
				data: {ids : matches,stat_id:status},
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




