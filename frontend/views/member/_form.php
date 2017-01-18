<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Privilege;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $form yii\widgets\ActiveForm */
?>
<? //$model->isNewRecord?"<h2>สร้างสมาขิก</h2>":"<h2>แก้ไขสมาขิก</h2>"?>

<div class="member-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'privilege_id')
    ->DropDownList(
    ArrayHelper::map(
      Privilege::find()->asArray()->all(),'id','valueTh'
     )
    ,['prompt'=>'เลือกสิทธิ์']
  )
  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php 

?>



