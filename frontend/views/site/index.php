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
$this->title = 'UP Hub';

$asset = frontend\assets\AppAsset::register ( $this );
$baseUrl = $asset->baseUrl;

/*
 * $picture = Uploads::find()
 * ->where(['rent_id' => $id])
 * ->orderBy('upload_id')
 * ->limit('1')
 * ->all();
 */

?>
<br>

<div align="right" class="contrainer visible-lg visible-md">

<?php 
if (!Yii::$app->user->isGuest) {
if (Yii::$app->user->identity->role == 20) {?>
	<a href="rent/create"><button type="text" class="btn btn-primary">
		<span class="glyphicon glyphicon-hand-right"></span> เพิ่มหอพักฟรี
	</button><a>
<?php }else{
	Modal::begin([
				
			'header'=>'<center><h3> หากท่านต้องการเพิ่มหอพักกรุณาติดต่อ</h3> </center><br>
			<center><h4> E-mail : uphub.u@gamil.com</h4> </center><br>
			
			',
			'toggleButton' => ['label' => '<span class="glyphicon glyphicon-hand-right"></span> เพิ่มหอพักฟรี', 'class' => 'btn btn-primary'],
			'id'=>'modal',
			'size'=>'modal-md'
						
						
	]);
	echo "<div id='modalContent'></div>";
		
	Modal::end();
		
 }}else {
 	Modal::begin([
 	
 			'header'=>'<center><h3> หากท่านต้องการเพิ่มหอพักกรุณาติดต่อ</h3> </center><br>
			<center><h4> E-mail : uphub.u@gmail.com</h4> </center><br>
		
			',
 			'toggleButton' => ['label' => '<span class="glyphicon glyphicon-hand-right"></span> เพิ่มหอพักฟรี', 'class' => 'btn btn-primary'],
 			'id'=>'modal',
 			'size'=>'modal-md'
 	
 	
 	]);
 	echo "<div id='modalContent'></div>";
 	
 	Modal::end();
 
 }?>
</div>
<div class="main-grids">

	<link
		href='http://fonts.googleapis.com/css?family=Share+Tech&subset=latin,latin-ext'
		rel='stylesheet' type='text/css'>


<!-- 	<body data-spy="scroll" data-target="#side-nav" >
	<button onclick="$('#side-nav').toggle()"
						title="Close" type="button" class="btn btn-info "
						style="border-radius: 50%; font-size: 10px; width: 20px; height: 20px; border-style: solid; border-width: 1px;">
						<span class="glyphicon glyphicon-eye-open" aria-hidden="true"
							style="font-size: 20px;"></span> <br> 
					</button> -->
		<div id="side-nav" class="visible-lg visible-md" >
			<ul class="nav nav-list affix" style="left: 15px;">
				<!-- <li>ลำดับ</li> -->
				
				<li onclick="move('#view')" style="margin-bottom: 2px;">
					<button
						title="หอพักเข้าชมมากที่สุด" type="button" class="btn btn-info "
						style="border-radius: 50%; font-size: 10px; width: 80px; height: 80px; border-style: solid; border-width: 10px;">
						<span class="glyphicon glyphicon-eye-open" aria-hidden="true"
							style="font-size: 40px;"></span> <br> 
					</button>
					<br>
				</li>


				<li onclick="move('#hot')" style="margin-bottom: 2px;">
					<button
						title="ตามความนิยม" type="button" class="btn btn-info "
						style="border-radius: 50%; font-size: 10px; width: 80px; height: 80px; border-style: solid; border-width: 10px;">
						<span class="glyphicon glyphicon-fire" aria-hidden="true"
							style="font-size: 40px;"></span> 
					</button>
				</li>


				<li onclick="move('#new')" style="margin-bottom: 2px;">
					<button title="หอพักมาใหม่"  type="button" class="btn btn-info "
						style="border-radius: 50%; font-size: 10px; width: 80px; height: 80px; border-style: solid; border-width: 10px;">
						<span class="glyphicon glyphicon-time" aria-hidden="true"
							style="font-size: 40px;"></span> <br> 
					</button>
				</li>



			</ul>
		</div>
<div class="contrainer"  >
<br>
		<p align="center"><?php echo Html::img('@web/img/medium.png')?></p>
		<h4 align="center">หาง่าย | ได้ไว | ใช่ในแบบของคุณ</h4>
</div>
		<div class="recommended">
			<div class="jumbotron" id="view">

				<B><h2 style="color: #6696ba">
						<span style="font-size: 1em; color: #ff8c00;"
							class="glyphicon glyphicon-bookmark"></span> ผู้เข้าชมสูงสุด <a
							href="rent/hotview"><button class="btn btn-default" type="submit">ดูต่อ</button>
						</a>
					</h2></B>
				<hr>
 					<?php
						if (! empty ( $rentView )) {
							
							foreach ( $rentView as $rent ) {
								?>
								 
					<div class="col-lg-4 col-sm-6 col-xs-4 col-md-4 resent-grid slider-first">
					<div class="resent-grid-img recommended-grid-img" width="600">
											<?php $img = Url::to('@web/photoDorm/').$rent['id']; ?>
											
											      <a href="rent/view?id=<?php echo $rent['id']?>"
							class="">
							<?php
								if ($rent->image) {
									echo Html::img ( Yii::$app->request->getAbsoluteUrl () . '/PhotoDorm/' . $rent->id . '/thumbnail/' . $rent->image, [ 
											'width' => '600' 
									] );
									?>
									<div class="clck " >
										<h3 div="" style="color: white;font-size: 12px;">
										<span style="" class="glyphicon glyphicon-eye-open"></span> <?php echo ($rent['view']==null? "0":$rent['view']);?> </h3>
									</div>
								<?php } else {
									echo Html::img ( Yii::$app->request->getAbsoluteUrl () . '/PhotoDorm/freebuilding.jpg', [ 
											'width' => '600' 
									] );
									?>
									<div class="clck">
										<h3 div="" style="color: black;font-size: 12px;">
										<span style="" class="glyphicon glyphicon-eye-open"></span> <?php echo ($rent['view']==null? "0":$rent['view']);?> </h3>
									</div>
								<?php 
								}
								?>
	
											        </a>

						
					</div>
					<div class="resent-grid-info recommended-grid-info">
						<h3>
							<a href="rent/view?id=<?php echo $rent['id']?>" class="title"><?php echo $rent['name']?></a>
						</h3>
						<ul>
							<li style="width: 100%;"><p class="author author-info">
									<a href="#" class="author"><?php 
								$intendant = $rent['intendant'];
								echo iconv_substr($intendant,0,10, "UTF-8");
								?>
								</a></p>
						</ul>
					</div>
				</div>
					
					<?php
							}
						}
						
						?>
					
					
					<div class="clearfix"></div>
			</div>
<?php ////////////////////////////////////?>

<div class="jumbotron" id="hot">

				<B><h2 style="color: #6696ba">
						<span style="font-size: 1em; color: #ff8c00"
							class="glyphicon glyphicon-bookmark"></span> หอพักกำลังมาแรง <a
							href="rent/hotrent"><button class="btn btn-default" type="submit">ดูต่อ</button>
						</a>
					</h2></B>
				<hr>
					
					<?php
					if (! empty ( $renthot )) {
						
						foreach ( $renthot as $rent ) {
							?>
									 
					<div class="col-lg-4 col-sm-6 col-xs-4 col-md-4 resent-grid slider-first">
					<div class="resent-grid-img recommended-grid-img" width="600">
											<?php $img = Url::to('@web/photoDorm/').$rent['id']; ?>
											
											      <a href="rent/view?id=<?php echo $rent['id']?>"
							class="">
									<?php
								if ($rent->image) {
									echo Html::img ( Yii::$app->request->getAbsoluteUrl () . '/PhotoDorm/' . $rent->id . '/thumbnail/' . $rent->image, [ 
											'width' => '600' 
									] );
									?>
									<div class="clck">
										<h3 div="" style="color: white;font-size: 12px;">
										<span style="" class="glyphicon glyphicon-eye-open"></span> <?php echo ($rent['view']==null? "0":$rent['view']);?> </h3>
									</div>
								<?php } else {
									echo Html::img ( Yii::$app->request->getAbsoluteUrl () . '/PhotoDorm/freebuilding.jpg', [ 
											'width' => '600' 
									] );
									?>
									<div class="clck">
										<h3 div="" style="color: black;font-size: 12px;">
										<span style="" class="glyphicon glyphicon-eye-open"></span> <?php echo ($rent['view']==null? "0":$rent['view']);?> </h3>
									</div>
								<?php 
								}
								?>
	
											        </a>
						
					</div>
					<div class="resent-grid-info recommended-grid-info">
						<h3>
							<a href="rent/view?id=<?php echo $rent['id']?>" class="title"><?php echo $rent['name']?></a>
						</h3>
						<ul>
							<li style="width: 100%;"><p class="author author-info">
									<a href="#" class="author"><?php 
								$intendant = $rent['intendant'];
								echo iconv_substr($intendant,0,10, "UTF-8");
								?>
								</a></p>
						</ul>
					</div>
				</div>
					<?php }}?>
					
					<div class="clearfix"></div>

			</div>
				
<?php ////////////////////////////////////?>

		<div class="jumbotron" id="new">

				<h2 style="color: #6696ba">
					<span style="font-size: 1em; color: #ff8c00"
						class="glyphicon glyphicon-bookmark"></span> หอมาใหม่ <a
						href="rent/newrent"><button class="btn btn-default" type="submit">ดูต่อ</button>
					</a>
				</h2>
				<hr>
					
					<?php
					if (! empty ( $rentNew )) {
						
						foreach ( $rentNew as $rent ) {
							?>
									 
					<div class="col-lg-4 col-sm-6 col-xs-4 col-md-4 resent-grid slider-first">
					<div class="resent-grid-img recommended-grid-img" width="600">
											<?php $img = Url::to('@web/photoDorm/').$rent['id']; ?>
											      <a href="rent/view?id=<?php echo $rent['id']?>"
							class="">
							<?php
								if ($rent->image) {
									echo Html::img ( Yii::$app->request->getAbsoluteUrl () . '/PhotoDorm/' . $rent->id . '/thumbnail/' . $rent->image, [ 
											'width' => '600' 
									] );
									?>
									<div class="clck">
										<h3 div="" style="color: white;font-size: 12px;">
										<span style="" class="glyphicon glyphicon-eye-open"></span> <?php echo ($rent['view']==null? "0":$rent['view']);?> </h3>
									</div>
								<?php } else {
									echo Html::img ( Yii::$app->request->getAbsoluteUrl () . '/PhotoDorm/freebuilding.jpg', [ 
											'width' => '600' 
									] );
									?>
									<div class="clck">
										<h3 div="" style="color: black;font-size: 12px;">
										<span style="" class="glyphicon glyphicon-eye-open"></span> <?php echo ($rent['view']==null? "0":$rent['view']);?> </h3>
									</div>
								<?php 
								}
								?>
	
											        </a>
						
						
					</div>
					<div class="resent-grid-info recommended-grid-info">
						<h3>
							<a href="rent/view?id=<?php echo $rent['id']?>" class="title"><?php echo $rent['name']?></a>
						</h3>
						<ul>
							<li style="width: 100%;"><p class="author author-info">
									<a href="#" class="author"><?php 
								$intendant = $rent['intendant'];
								echo iconv_substr($intendant,0,10, "UTF-8");
								?>
								</a></p>
						</ul>
					</div>
				</div>
					<?php }}?>
					
					
					<div class="clearfix"></div>
			</div>


		</div>

</div>
<br>
<style>
function myFunction () {var j = $('#inp ').val ();var n = parseInt
	(j);var
	i =0;while (i < n ) { $('<input type="text" id="fname" name="floor[]"
	/><button onclick="myFunction()">Try
	it</button><br/><br/>').appendTo($('#demo'));i ++;
	
}
}
</style>
<script>
function move(id){
	div = $(id);
	$('html,body').animate({
        scrollTop: div.offset().top-50
    }, 500, function() {   
    });
}
</script>



