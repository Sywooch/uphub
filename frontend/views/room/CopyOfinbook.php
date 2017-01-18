<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

use frontend\models\Room;

use kartik\tabs\TabsX;
use yii\widgets\Pjax;

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

// $id = $searchModel->id;
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
									 return $model->status == 0 ? Html::a('<span class="glyphicon glyphicon-send"> จอง</span>',['/room/booking', 'id' => $model->id],['class'=>'btn btn-success']): null;
								} 
						] 
				] 
		] 
] );

// echo $label[$i];
?>
 

