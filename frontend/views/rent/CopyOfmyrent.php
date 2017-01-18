<?php
/* @var $this yii\web\View */
use frontend\models\Rent;
use yii\helpers\Html;
use frontend\controllers\RentController;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use frontend\models\Uploads;

use yii\bootstrap\Carousel;
use yii\web\Link;
use yii\bootstrap\Modal;
$this->title = 'หอพักของฉัน';
$this->params ['breadcrumbs'] [] = $this->title;

$asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
?>
		
<div align="right"> <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-plus"></span> เพิ่มหอพัก'), ['create'], ['class' => 'btn btn-primary']) ?></div>
		
		<div class="main-grids">
		<b><h2 style="color: #68a697">
				<span style="font-size: 1em;color: #cec0af" class="glyphicon glyphicon-bookmark"></span> หอพักของฉัน  </h2></b>
				
				<hr>
				<div class="top-grids">
				
					<div class="recommended-info">
					

					<?php 
									 if(!empty($rentMe)){
									 	
									 foreach ($rentMe as $rent){
									 
									 	if ($rent->visible == '1'){?>
									 
					<div class="col-md-4 resent-grid recommended-grid slider-top-grids">
						<div class="resent-grid-img recommended-grid-img" width = "600">
											<?php $img = Url::to('http://localhost/tags/photoDorm/').$rent['id']; ?>
											   <a href="view?id=<?php echo $rent['id']?>" class="">
											        <?php 
											        if ($rent->image){
											        	echo Html::img(
											        		'http://localhost/tags/PhotoDorm/'.$rent->id.'/thumbnail/'
											        		.$rent->image,['width'=>'600']); 
											        }else{
											        	echo Html::img(
											        			'http://localhost/tags/PhotoDorm/freebuilding.jpg',['width'=>'600']);
											        }
											        ?>
	
											        </a>
							<div class="time">
								<p>3:04</p>
							</div>
							<div class="clck">
								<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
							</div>
						</div>
						<div class="resent-grid-info recommended-grid-info">
							<h3><a href="view?id=<?php echo $rent['id']?>" class="title"><?php echo $rent['name']?></a></h3>
					<?php echo Html::a('เพิ่มห้องพัก',['/room/create', 'rent_id' =>  $rent['id']])?>
						  /<?php echo Html::a('สถานะหอพัก',['/room/owner', 'rent_id' =>  $rent['id']])?>
						/<?php echo Html::a('แก้ไขหอพัก', ['update', 'id' => $rent['id']]);?>	
						<ul>
								<li><p class="author author-info"><a href="#" class="author"><?php echo $rent['intendant']?></a></p></li>
														<li class="right-list">
									<?php
									echo Html::a('<span class="glyphicon glyphicon-trash"></span>',[
															
															'/rent/close',
													'id' =>  $rent->id,
									 						'class' => 'btn btn-danger btn-sm',
															'data-method'=>'post',
												]);
									 
									/* Modal::begin([
											
											'header'=>'<center> ยืนยันการลบ ?</center>',
											'footer'=>Html::a ( '<span class="glyphicon glyphicon-ok"></span> ยืนยัน'
												,[
													'/rent/test',
													'id' =>  $rent['id']
												], 
												[
													'class' => 'btn btn-success ',
													'data-method'=>'post',
												]),
											'toggleButton' => ['label' => '<span class="glyphicon glyphicon-trash"></span>', 'class' => 'btn btn-danger btn-sm'],
											'id'=>'modal',
											'size'=>'modal-sm'
											
											
									]);
									echo "<div id='modalContent'></div>";
									
									Modal::end();
									 */
									
									?>
						</li>
							</ul>
						</div>
					</div>
					<?php }}}?>
					
					<div class="clearfix" >
					</div>
				</div>
				</div>
				</div>
				

				
				
				
			<style>
			function myFunction() {
 
    var j = $('#inp').val();
    var n = parseInt(j);
    var i=0;
     while (i < n) {
    $('<input type="text" id="fname" name="floor[]" /><button onclick="myFunction()">Try it</button><br/><br/>').appendTo($('#demo'));
    i++;
}
}
			</style>
	
			
			