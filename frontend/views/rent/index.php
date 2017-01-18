<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-index">

    <h1><?= Html::encode($this->title) ?></h1>   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'near',
            'intendant',
            'cost_water',
            // 'cost_elec',
            // 'tel1',
            // 'tel2',
            // 'web',
            // 'type_gen',
            // 'type_rent',
            // 'user_id',
            // 'address_id',
            // 'condition:ntext',
            // 'edited',

            [ 
						'class' => 'yii\grid\ActionColumn',
						'template' => '{close} {open} {view} {update}' ,
						'contentOptions' => [ 
								'noWrap' => true 
						],
						'buttons' => [
        				'close' => function ($url, $model, $key) {
        				return $model->visible == 1 ? Html::a('ปิดการใช้งาน',['/rent/closeadmin', 'id' => $model->id],['class'=>'btn btn-danger ','data-confirm' => Yii::t('yii', 'Are you sure you want to delete selected items?')]):
        				Html::a('ปิดการใช้งาน',['/rent/closeadmin', 'id' => $model->id],['class'=>'btn btn-danger disabled']);
        				},
        				'open' => function ($url, $model, $key) {
        				return $model->visible == 0 ? Html::a('เปิดการใช้งาน',['/rent/openadmin', 'id' => $model->id],['class'=>'btn btn-success ']):
        				Html::a('เปิดการใช้งาน',['/rent/openadmin', 'id' => $model->id],['class'=>'btn btn-success disabled']);
        				},
        				'view' => function ($url, $model, $key) {
        				return Html::a('ดู',['/rent/view', 'id' => $model->id],['class'=>'btn btn-default ']);
        				},
        				'update' => function ($url, $model, $key) {
        				return Html::a('แก้ไข',['/rent/update', 'id' => $model->id],['class'=>'btn btn-default ']);
        				}
        				
        				
        		] 
				],
        ],
    ]); ?>

</div>
