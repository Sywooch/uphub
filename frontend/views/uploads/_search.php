<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UploadsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uploads-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'upload_id') ?>

    <?= $form->field($model, 'file_name') ?>

    <?= $form->field($model, 'real_filename') ?>

    <?= $form->field($model, 'create_date') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'albumn_id') ?>

    <?php // echo $form->field($model, 'rent_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
