<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

use common\models\User;

use kartik\tabs\TabsX;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สมาชิกภายในเว็บไซต์';
$this->params['breadcrumbs'][] = 'ข้อมูลสมาชิก';
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มสมาชิก', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    

<?php 
$items = [];
$label = ['member','owner','admin','ban'];
for($i=0;$i<sizeof($searchModel);$i++){
	$items[] = [
			'label'=> $label[$i],
			'content' =>$this->render( 'index1',
					['searchModel'=>$searchModel[$i],
					'dataProvider' => $dataProvider[$i],'i'=> $i]
					),
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





