<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Room */

$this->title = Yii::t('app', 'Create Room');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-create">

    		<b><h2 style="color: #68a697">
				<span style="font-size: 1em;color: #cec0af" class="glyphicon glyphicon-bookmark"></span> เพิ่มห้องพัก  </h2></b>
				
				<hr>

    <?= $this->render('_form', [
        'model' => $model,
    	'rent_id' => $rent_id
    ]) ?>

</div>
