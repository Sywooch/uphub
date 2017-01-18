<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Rent;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
if ( $role=Yii::$app->user->identity->role==30) {
	$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลสมาชิก', 'url' => ['index']];
}$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h2> คุณ  <?= Html::encode($this->title) ?></h2>

<?php echo  Html::a('แก้ไขข้อมูลส่วนตัว', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
        	'fullname',
            'email:email',
            'created_at:dateTime',
            'updated_at:dateTime',
        ],
    ]) ?>
    <?php foreach ($infobook as $info){?>
    <div class="alert alert-success" role="alert" align="center">
<span style="font-size: 3.5em;" class="glyphicon glyphicon-certificate"></span>
<p>
หอพัก :  <?php 
$num = $info["rent_id"];
$name1= Rent::find()
->where(['id' => $num])
->all();
//print_r($name1);
foreach ($name1 as $name){
echo $name['name'];} ?> 
ห้องพักหมายเลข : <?php echo $info["room"]; ?><br>
วันที่ทำการจอง : <?php echo $info["start_date"]; ?> <b>วันหมดอายุการจอง : <?php echo $info["end_date"]; ?></b><br>
รหัสยืนยันการจอง : <?php echo $info["code"]; ?><br><br>

</p>

</div>
<?php }?>
</div>
<br>