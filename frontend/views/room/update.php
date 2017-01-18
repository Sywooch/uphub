<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model frontend\models\Room */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Room',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="room-update">

    <h1>แก้ไขข้อมูลห้องพักหมายเลข <?php echo  $model->room?>  </h1>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numFloor') ?>
	<?= $form->field($model, 'room') ?>
	<?= $form->field($model, 'cost') ?>
	<?= $form->field($model, 'type_pay') ?>
	<?= $form->field($model, 'insurance') ?>
	
	

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
