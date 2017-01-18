<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AccessoriesHasRoom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accessories-has-room-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'accessories_id')->textInput() ?>

    <?= $form->field($model, 'room_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
