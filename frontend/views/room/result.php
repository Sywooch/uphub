<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\User;
use frontend\models\Rent;
$this->title = "ผลลัพธ์การจอง";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>กรุณาอ่าน !</strong> นำรหัสยืนยันการจองไปทำการยืนยัน ณ ที่หอพักที่ท่านได้ทำการจอง ภายในวันเวลาที่กำหนด <br>
  <strong>*</strong> หากไม่ทำการไปยืนยันที่หอพักในเวลาที่กำนหนดจะ "หลุดจองทันที" โดยอัตโนมัติ
</div>
<div class="alert alert-success" role="alert" align="center">
<span style="font-size: 3.5em;" class="glyphicon glyphicon-certificate"></span>
<h1>ยินดีด้วย !!! คุณ <?php echo $room->user->fullname; ?> ได้จองห้องพักสำเร็จ </h1>
<p>
หอพัก :  <?php echo $room->rent->name; ?> ห้องพักหมายเลข : <?php echo $room->room; ?><br>
วันที่ทำการจอง : <?php echo $room->start_date; ?> <b>วันหมดอายุการจอง : <?php echo $room->end_date; ?></b><br>
รหัสยืนยันการจอง : <?php echo $room->code; ?><br><br>
<button onclick="javascript:window.print()" type="button"  name="print2" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span> พิมพ์หน้านี้</button>
</p>

</div>