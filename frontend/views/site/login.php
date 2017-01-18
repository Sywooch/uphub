<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';
$this->params ['breadcrumbs'] [] = $this->title;
?>

<?php //ehco Html::encode($this->title) ?>
<div class="jumbotron col-md-6 col-md-offset-3">

	<div class="">
		<div class="site-login">
			<div class="col-md-8 col-md-offset-2">
			<div align="center" style="color: 	#7e4b68"><h2><b>เข้าสู่ระบบ <span style="font-size: 0.75em;" class="glyphicon glyphicon-log-in"></span></b></h2></div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')?>

                <?= $form->field($model, 'password')->passwordInput()?>

                <?= $form->field($model, 'rememberMe')->checkbox()?>

               

				<div class="form-group" align="center">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button'])?>
                </div>
			</div>
            <?php ActiveForm::end(); ?>
            <hr>
			<!-- <div class="col-md-8 col-md-offset-2">
				<h4 align="center">เข้าสู่ระบบโดยเฟสบุ๊ค</h4>
				<div class="col-md-6 col-md-offset-3"> -->
               <?php /* echo yii\authclient\widgets\AuthChoice::widget(['baseAuthUrl' => ['site/auth']]); */?> 
				
<!-- </div>
			</div> -->
		</div>
	</div>

</div>
