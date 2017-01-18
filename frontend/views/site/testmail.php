<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'sendEmail';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-testmail">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to sendEmail:</p>

    <div class="row">
      <div class="row">
          <div class="col-lg-5">
              <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                  <?= $form->field($model, 'username') ?>
                  <?= $form->field($model, 'email') ?>
                  <?= $form->field($model, 'password')->passwordInput() ?>
                  <div class="form-group">
                      <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'sendmail-button']) ?>
                  </div>
              <?php ActiveForm::end(); ?>
          </div>
      </div>
    </div>
</div>
