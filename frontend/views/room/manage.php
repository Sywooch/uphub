<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-index">

    <h1>จัดการห้องพัก </h1>
 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            	'room',
				
        		'start_date',
        		'end_date',
				'cost',
        		
        		
        		[
        				'attribute' => 'user_id',
        				'value' => function($model){
        				$id = $model->user_id;
        				//return $id;
        				if ($id) return $model->user->fullname;
        				else return 'ว่าง';
        				},
        				
        		],
				
        		[
        				'attribute' => 'status',
        				'value' => function($model){
        				
        				if ($model->status == 0) return 'ว่าง';
        				if ($model->status == 1) return 'ถูกจอง';
        				if ($model->status == 2) return 'ไม่ว่าง';
        				
        				},
        				
        				'filter'=>Html::dropDownList(null,null,[0=>'ว่าง',1=>'จอง',2=>'ไม่ว่าง']),
        		],
           
        		[
        		'class' => 'yii\grid\ActionColumn',
        		'template' => '<div class="btn-group btn-group-sm text-center" role="group"> {free} {full} {booked} </div>',
        		'contentOptions' => [
        				'noWrap' => true
        		],
        		'buttons' => [
        				'free' => function ($url, $model, $key) {
        				return $model->status == 0 ? Html::a('ว่าง',['/room/free', 'id' => $model->id],['class'=>'btn btn-success disabled']): 
        				Html::a('ว่าง',['/room/free', 'id' => $model->id],['class'=>'btn btn-default ']);
        				},
        				'full' => function ($url, $model, $key) {
        				return $model->status == 2 ? Html::a('ไม่ว่าง',['/room/full', 'id' => $model->id],['class'=>'btn btn-danger disabled']): 
        				Html::a('ไม่ว่าง',['/room/full', 'id' => $model->id],['class'=>'btn btn-default ']);
        				},
        				'booked' => function ($url, $model, $key) {
        				return $model->status == 1 ? Html::a('จอง',['/room/booked', 'id' => $model->id],['class'=>'btn btn-warning disabled']):
        				Html::a('จอง',['/room/booked', 'id' => $model->id],['class'=>'btn btn-default ']);
        				}
        				
        		],
        		
        		
        		],
        		[
					  'class' => 'yii\grid\ActionColumn',
					  'template'=>'  {update} {view}',
					  'contentOptions'=>[
					    'noWrap' => true
					  ],
					  'buttons'=>[
					  		'view' => function ($url, $model, $key) {
					  		return Html::a('<span class="glyphicon glyphicon-th-list"></span>',['/room/view', 'id' => $model->id]);
					  		}
					    
					    ]
				],
        ],
    ]); ?>

</div>
