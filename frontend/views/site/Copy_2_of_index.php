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
<br>
<br>

</div>
</div>
<div class="main-grids">
	<div class="recommended">
		<div class="callbacks_container">
			<h3>
				เข้าชมมากที่สุด <a href="rent/hotview"><button
						class="btn btn-default" type="submit">ดูต่อ</button> </a>
			</h3>
					
					<?php
					if (! empty ( $rentView )) {
						
						foreach ( $rentView as $rent ) {
							?>
									 
					<div class="col-md-3 resent-grid recommended-grid slider-first">
				<div class="resent-grid-img recommended-grid-img" width="600">
											<?php $img = Url::to('@web/photoDorm/').$rent['id']; ?>
											
											      <a href="rent/view?id=<?php echo $rent['id']?>"
						class="">
											        <?php
							if ($rent->image) {
								echo Html::img ( Yii::$app->request->getAbsoluteUrl () . '/PhotoDorm/' . $rent->id . '/thumbnail/' . $rent->image, [ 
										'width' => '600' 
								] );
							} else {
								echo Html::img ( Yii::$app->request->getAbsoluteUrl () . '/PhotoDorm/freebuilding.jpg', [ 
										'width' => '600' 
								] );
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
					<h3>
						<a href="rent/view?id=<?php echo $rent['id']?>" class="title"><?php echo $rent['name']?></a>
					</h3>
					<ul>
						<li><p class="author author-info">
								<a href="#" class="author"><?php echo $rent['intendant']?></a>
							</p></li>
						<li class="right-list"><p class="views views-info"><?php echo $rent['view']?> views</p></li>
					</ul>
				</div>
			</div>
					<?php }}?>
					
					<div class="clearfix"></div>
		</div>
				
				<?php ////////////////////////////////////?>
				<hr>
		<div class="callbacks_container">
			<h3>
				หอพักตามความนิยม <a href="rent/hotrent"><button
						class="btn btn-default" type="submit">ดูต่อ</button> </a>
			</h3>
					
					<?php
					if (! empty ( $leadsCount )) {
						// print_r($rentHot);
						
						foreach ( $leadsCount as $rent1 ) {
							/*
							 * echo $rent1->rent_id;
							 * echo "___".$rent1->cnt;
							 */
							
							$idRent = $rent1->rent_id;
							$rentHot = Rent::find ()->WHERE ( [ 
									'id' => $idRent 
							] )->all ();
							foreach ( $rentHot as $rent ) {
								
								?>
									 
					<div class="col-md-3 resent-grid recommended-grid slider-first">
				<div class="resent-grid-img recommended-grid-img" width="600">
											<?php $img = Url::to('@web/photoDorm/').$rent['id']; ?>
											      <a href="rent/view?id=<?php echo $rent['id']?>"
						class="">
											        <?php
								if ($rent->image) {
									echo Html::img ( Yii::$app->request->getAbsoluteUrl () . '/PhotoDorm/' . $rent->id . '/thumbnail/' . $rent->image, [ 
											'width' => '600' 
									] );
								} else {
									echo Html::img ( Yii::$app->request->getAbsoluteUrl () . '/PhotoDorm/freebuilding.jpg', [ 
											'width' => '600' 
									] );
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
					<h3>
						<a href="rent/view?id=<?php echo $rent['id']?>" class="title"><?php echo $rent['name']?></a>
					</h3>
					<ul>
						<li><p class="author author-info">
								<a href="#" class="author"><?php echo $rent['intendant']?></a>
							</p></li>
						<li class="right-list"><p class="views views-info"><?php echo $rent['view']?> views</p></li>
						<li><p><?php echo $rent->numrooms==0?0:(100*$rent->numroomsavailable/$rent->numrooms);?></p></li>
					</ul>
				</div>
			</div>
					<?php
							
}
						}
					}
					?>
					
					
					<div class="clearfix"></div>
		</div>
				
				
				<?php ////////////////////////////////////?>
				<hr>
		<div class="callbacks_container">
			<h3>
				หอมาใหม่ <a href="rent/newrent"><button class="btn btn-default"
						type="submit">ดูต่อ</button> </a>
			</h3>
					
					<?php
					if (! empty ( $rentNew )) {
						
						foreach ( $rentNew as $rent ) {
							?>
									 
					<div class="col-md-3 resent-grid recommended-grid slider-first">
				<div class="resent-grid-img recommended-grid-img" width="600">
											<?php $img = Url::to('@web/photoDorm/').$rent['id']; ?>
											      <a href="rent/view?id=<?php echo $rent['id']?>"
						class="">
											        <?php
							if ($rent->image) {
								echo Html::img ( Yii::$app->request->getAbsoluteUrl () . '/PhotoDorm/' . $rent->id . '/thumbnail/' . $rent->image, [ 
										'width' => '600' 
								] );
							} else {
								echo Html::img ( Yii::$app->request->getAbsoluteUrl () . '/PhotoDorm/freebuilding.jpg', [ 
										'width' => '600' 
								] );
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
					<h3>
						<a href="rent/view?id=<?php echo $rent['id']?>" class="title"><?php echo $rent['name']?></a>
					</h3>
					<ul>
						<li><p class="author author-info">
								<a href="#" class="author"><?php echo $rent['intendant']?></a>
							</p></li>
						<li class="right-list"><p class="views views-info"><?php echo $rent['view']?> views</p></li>
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
function myFunction () {var j = $('#inp').val();var n = parseInt(j);var
	i=0;while (i < n) { $('<input type="text" id="fname" name="floor[]"
	/><button onclick="myFunction()">Try
	it</button><br/><br/>').appendTo($('#demo'));i ++;
	
}
}
</style>


