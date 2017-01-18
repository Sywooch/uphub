<?php
use frontend\models\Room;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\grid\GridView;
?>
<div>
<br><br><br><br><br><br>


 

      <?php 
      
      $s=GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'numFloor',
            'room',
            'status',
            'cost',
            // 'type_pay',
            // 'insurance',
            // 'start_date',
            // 'end_date',
            // 'rent_id',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
      /* 
      
       */
      //$items = [];
      
      $items = [
      		[
      				'label'=>"sss",
      				'content'=>$s,
      				'active'=>true
      		],
      		[
      		'label'=>"sss",
      		'content'=>$s,
      		'active'=>false
      		],
      		[
      		'label'=>"sss",
      		'content'=>$s,
      		'active'=>false
      		],
      ];
      
       
      echo TabsX::widget([
      		'items'=>$items,
      		'position'=>TabsX::POS_ABOVE,
      		'encodeLabels'=>false
      ]);
      
      
?>
</div>
   

   