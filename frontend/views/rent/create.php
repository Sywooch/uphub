<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model frontend\models\Rent */

$this->title = 'เพิ่มหอพัก';
$this->params['breadcrumbs'][] = ['label' => 'หอพักของฉัน', 'url' => ['myrent']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-create">


    <?= $this->render('_form', [
        'modelHasAccessories' => $modelHasAccessories,
        'modelRent'=>$modelRent,    	
    	'modelAddress' =>$modelAddress,
    	'modelHasAccessoriesOne'=>$modelHasAccessoriesOne,
    	'initialPreview'=>[],
    	'initialPreviewConfig'=>[],

    ]) ?>

</div>
