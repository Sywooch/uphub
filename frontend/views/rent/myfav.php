<?php
/* @var $this yii\web\View */
use frontend\models\Rent;
use frontend\models\Fav;
use yii\helpers\Html;
use frontend\controllers\RentController;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use frontend\models\Uploads;

use yii\bootstrap\Carousel;
use yii\web\Link;
$this->title = 'หอพักที่เก็บไว้';

$asset = frontend\assets\AppAsset::register ( $this );
$baseUrl = $asset->baseUrl;
?>
<br>
<br>
<br>

</div>
</div>
<div class="main-grids">
	<div class="top-grids">
		<div class="recommended-info">
			<div>
				<h3>หอพักที่เก็บไว้</h3>
			</div>
						
					
					<?php
					if (! empty ( $allrent )) {
						
						foreach ( $allrent as $rent ) {
							?>
									 
					<div class="col-md-4 resent-grid recommended-grid slider-top-grids">
				<div class="resent-grid-img recommended-grid-img" width="600">
											<?php $img = Url::to('http://localhost/uphubgg2016/frontend/web/photoDorm').$rent['id']; ?>
											   <a href="view?id=<?php echo $rent['id']?>" class="">
											        <?php
							if ($rent->image) {
								echo Html::img ( 'http://localhost/uphubgg2016/frontend/web/photoDorm' . $rent->id . '/thumbnail/' . $rent->image, [ 
										'width' => '600' 
								] );
							} else {
								echo Html::img ( 'http://localhost/uphubgg2016/frontend/web/photoDorm/freebuilding.jpg', [ 
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
				<div class="resent-grid-info recommended-grid-info"></div>
			</div>
					<?php }}else echo "error";?>
					
					<div class="clearfix"></div>
		</div>





		<style>
function myFunction () {var j = $('#inp').val();var n = parseInt(j);var
	i=0;while (i < n) { $('<input type="text" id="fname" name="floor[]"
	/><button onclick="myFunction()">Try
	it</button><br/><br/>').appendTo($('#demo'));i ++;
	
}
}
</style>