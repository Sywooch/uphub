<?php
use frontend\models\Room;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\tabs\TabsX;

if(!empty($model))
    {
    	?>
    	<br><br>
       <?php  foreach($model as $row)
        {
        	/* echo 'rent_id: '.$row['rent_id'].'</br>';
            echo 'numFloor: '.$row['numFloor'].'</br>';
            echo 'status: '.$row['status'].'</br>';
            echo 'cost: '.$row['cost'].'</br>';
            echo 'cost: '.$row['cost'].'</br>';
            echo 'insurance: '.$row['insurance'].'</br>';
            echo 'start_date: '.$row['start_date'].'</br>';
            echo 'end_date: '.$row['end_date'].'</br>'; */
            ?>
            
            <?php if ($row['status']==0){?>
            <div class="col-md-2">
            <br>
            <?= Html::a($row['room'].'cost'.$row['cost'], ['/room/booking', 'id' => $row['id']], ['class' => 'btn btn-success']) ?>
            
            <br>
            </div>
            
           <?php  }else {?>  
        <div class="col-md-2">
        <br>
         
        <a	href="#"><button class="btn btn-default" disabled><?php echo  $row['room']?>cost<?php echo $row['cost']?></button></a><br>
       </div>
       <?php 
        }
    }
    }
?>

   

   