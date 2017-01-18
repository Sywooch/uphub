<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

use common\models\User;

use kartik\tabs\TabsX;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'จองห้องพัก');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php 
$items = [];
$label = ['floor1','floor2','floor3','floor4','floor5','floor6','floor7','floor8'];
for($i=0;$i<sizeof($searchModel);$i++){
	$items[] = [
			'label'=> $label[$i],
			'content' =>$this->render( 'inbook',
					['searchModel'=>$searchModel[$i],
					'dataProvider' => $dataProvider[$i],'i'=> $i
							
							
	]),
			'active' => $i==0?true:false
	];
	
}



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

