<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;
use yii\rbac\Role;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

<?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            'created_at:dateTime',
            'updated_at:dateTime',
        ],
    ]) ?>
    <?php $form = ActiveForm::begin(); ?>


   <?php echo $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
   
      <?php 
      $id_fb=$model->id_fb;
    
      if ($id_fb == NULL){
      		echo  $form->field($model, 'password')->passwordInput(['maxlength' => true]);
      }else {
      	$form->field($model, 'password')->hiddenInput(['maxlength' => true]);
      }
       ?>

    
		<div class="col-xs-6">
			<?php //echo $form->field($model, 'role')->inline()->radioList($model->getItemRole()) ?>
		</div>
	</div>

    <div class="form-group">
        <?php echo  Html::submitButton($model->isNewRecord ? 'ตกลง' : 'ตกลง', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
