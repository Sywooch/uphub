<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Room */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jumbotron">

   <B><h2 style="color: #68a697">
				<span style="font-size: 1em;color: #cec0af" class="glyphicon glyphicon-bookmark"></span> ข้อมูลห้องพัก 
			</h2></B>
			<hr>
			<?php if ($model->status == 0){?>
			<div align="right"><h2 style="color: green;">ห้องพักว่าง</h2></div>
			<?php }else{ ?>
			<div align="right" class="form-inline"><h2 style="color: red;">ยังไม่ได้ชำระเงิน    </h2>  
			<?php echo Html::a('ยืนยันการชำระเงิน',['/room/full', 'id' => $model->id],['class'=>'btn btn-success ']);?>
			</div>
			<br>
			<?php } ?>	
		<table class="table table-bordered">
    
    <tbody>
      <tr>
        <td>ชื่อหอพัก : </td>
        <td><?php echo $model->rent->name ?></td>
      </tr>
<tr>
        <td>ชั้นที่ : </td>
        <td><?php echo $model->numFloor ?></td>
      </tr>
<tr>
        <td>หมายเลขห้อง : </td>
        <td><?php echo $model->room ?></td>
      </tr>
<tr>
        <td>ค่าประกัน : </td>
        <td><?php echo $model->insurance ?></td>
      </tr>
<tr>
        <td>วันที่ทำการจอง : </td>
        <td><?php echo $model->start_date ?></td>
      </tr>
<tr>
        <td>วันหมดอายุการจอง : </td>
        <td><?php echo $model->end_date ?></td>
      </tr>
<tr>
        <td>รหัสยืนยันการจอง : </td>
        <td><p style="color: red;"><?php echo $model->code ?></p></td>
      </tr>
<tr>
        <td>ชื่อผู้จอง : </td>
        <td><?php echo $model->name ?></td>
      </tr>
<tr>
        <td>เลขประจำตัวประชาชน :</td>
        <td><?php echo $model->id_card ?></td>
      </tr>
<tr>
        <td>เบอร์โทรติดต่อ : </td>
        <td><?php echo $model->tel ?></td>
      </tr>
      
    </tbody>
  </table>
			
			</div>