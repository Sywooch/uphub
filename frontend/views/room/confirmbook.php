<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\User;
use frontend\models\Rent;
use yii\widgets\ActiveForm;
use yii\base\Model;
$this->title = "ยืนยันการจอง";
//$this->params['breadcrumbs'][] = ['label' => 'เลือกห้องพัก', 'url' => ['book']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="alert alert-success" role="alert" align="center">
<span style="font-size: 3.5em;" class="glyphicon glyphicon-certificate"></span>

    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'id_card')->textInput(['type'=>'number','name'=>'idCard','min' =>'1','value' => '','id' =>'inp']) ?>
    <p id="demo"></p>
    <?= $form->field($model, 'tel') ?>
    
   

    <div class="form-group">
        <?= Html::submitButton('ตกลง', ['class' => 'btn btn-primary','id'=>'sub']) ?>
    </div>
    <div class="col-md-3">
        <p id="demo"></p>
        </div>

<?php ActiveForm::end(); ?>
    
    
    
    
    
</div>

<!-- <div class = "container">
<form action="">
 <input type="text" name = "firstname"/>
 <input type="text" name = "lastname"/>
 <input type="text" name = "telCustomer"/>
 <input type="text" name = "contact"/>
<input type="submit" >
</form>

</div> -->

