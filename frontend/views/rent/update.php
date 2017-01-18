<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Rent */

$this->title = 'Update Rent: ' . ' ' . $modelRent->name;
$this->params['breadcrumbs'][] = ['label' => 'Rents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelRent->name,
		'url' => ['view', 'id' => $modelRent->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="rent-update">


    <?= $this->render('_form', [
    	'modelHasAccessoriesOne'=>$modelHasAccessoriesOne,
        'modelHasAccessories' => $modelHasAccessories,
        'modelRent'=>$modelRent,
    	/* 'amphur'=> $amphur,
    	'district' =>$district, */
    		'modelAddress' =>$modelAddress,
    		'initialPreview'=>$initialPreview,
    	'initialPreviewConfig'=>$initialPreviewConfig
    ]) ?>

</div>
