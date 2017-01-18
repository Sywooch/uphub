<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

use frontend\models\Room;

use kartik\tabs\TabsX;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$items = [ ];
$label = [ 
		'floor1',
		'floor2',
		'floor3',
		'floor4',
		'floor5',
		'floor6',
		'floor7',
		'floor8' 
];


echo GridView::widget ( [ 
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'pjax' => true,
		'pjaxSettings' => [ 
				'neverTimeout' => true,
				'options' => [ 
						'id' => 'data-pjax-container' . $i,
						'enablePushState' => false 
				] 
		],
		
		'columns' => [ 
				[ 
						'class' => 'kartik\grid\CheckboxColumn',
						'checkboxOptions' => function ($model, $key, $index, $column) use($i) {
							return [ 
									'value' => $model->id,
									'class' => 'checkbox' . $i 
							];
						} 
				],
				[ 
						'class' => 'yii\grid\SerialColumn' 
				],
				'room',
				'status',
				'cost',
				'type_pay',
				'insurance',
				
				
				// ['class' => 'yii\grid\ActionColumn'],
				[ 
						'class' => 'yii\grid\ActionColumn',
						'template' => '{book}',
						'contentOptions' => [ 
								'noWrap' => true 
						],
						'buttons' => [ 
								'book' => function ($url, $model, $key) {
									return $model->status == 0 ? Html::a('<span class="glyphicon glyphicon-send"> จอง</span>',['/room/entry', 'id' => $model->id],['class'=>'btn btn-success']): null;
									
									 /* return $model->status == 0 ? Html::button('จอง',[
															
															'id' => 'modalButton',
									 						'class' => 'btn btn-success btn-sm',
															'data-method'=>'post',
												]): null;
									 Modal::begin([
									 			
									 		'header'=>'<center> ยืนยันการจอง</center>',
									 		'footer'=>Html::a ( '<span class="glyphicon glyphicon-ok"></span> ยืนยัน'
									 				,[
									 						'/room/booking',
									 						'id' =>  $model->id
									 				],
									 				[
									 						'class' => 'btn btn-success ',
									 						'data-method'=>'post',
									 				]),
									 		'toggleButton' => ['label' => '<span class="glyphicon glyphicon-trash"></span>', 'class' => 'btn btn-danger btn-sm'],
									 		'id'=>'modal',
									 		'size'=>'modal-sm'
						
						
									 ]);
									 echo "<div id='modalContent'></div>";
									 	
									 Modal::end(); */
								} 
						] 
				] 
		] 
] );

// echo $label[$i];
?>
 

