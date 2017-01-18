<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$asset = frontend\assets\AppAsset::register ( $this );
$baseUrl = $asset->baseUrl;
/* @var $this yii\web\View */
/* @var $model frontend\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="">
    <div class="row">
        <div class="col-md-3">
        <form class="form-inline">
        <?= $form->field($model, 'rent')->hiddenInput(['value'=>$rent_id])->label(false); ?>
		<?= $form->field($model, 'floor')->textInput(['type'=>'number','name'=>'numFloor','min' =>'1','value' => '','id' =>'inp'])?>
		<div align="center"><label onclick="myFunction()" class="btn-lg btn-primary">Add</label><br><br>
        </form>
        </div>
        </div>
        <div class="col-md-3">
        
        </div>
        <div class="col-md-3">
        <p id="demo"></p>
        </div>
    </div>
   <div class="row" align="center">

<?= Html::submitButton('เพิ่มห้องพัก', ['class' => 'btn btn-success btn-lg btn-block', 'name'=>'submit']) ?>

<?= Html::a("ยกเลิก", ['/room/redirect', 'rent_id' =>  $model['id']], ['class' => 'btn btn-default btn-lg btn-block', 'id' => 'refreshButton']) ?>

<br><br>  <br>       
</div>
<?php ActiveForm::end(); ?>
</div>

