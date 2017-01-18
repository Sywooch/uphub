<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use frontend\models\Accessories;
use frontend\models\Uploads;
use frontend\models\Rent;
use frontend\models\Fav;
use kartik\social\FacebookPlugin;
use yii\base\Widget;
use yii\jui\AutoComplete;

/* use frontend\models\Rent; */

/* @var $this yii\web\View */
/* @var $model frontend\models\Rent */

/**
 * ********register facebook api *********
 */

$this->title = $model->name;
$this->params ['breadcrumbs'] [] = [ 
		'label' => 'Rents',
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;

$accessories = Accessories::find ()->all ();
$accessoriesArray = [ ];
foreach ( $model->rentHasAccessories as $rentHasAcs ) {
	$accessoriesArray [] = $rentHasAcs->accessories_id;
}

?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1663454183938808";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="rent-view">





	<div class="container">

		<div class="row">
			<div class="col-md-7">
				<div>
        <?php
								/*
								 * $img = Url::to('@web/uploads/').$model['photo'];
								 * $image = '<img src="'.$img.'" width="600" />';
								 * echo Html::img('@web/uploads/'.$model['photo'], ['class' => 'pull-left img-responsive']);
								 */
								?>

        </div>
				<br> <br>
				<div class="row">
					<div class="panel panel-default">
						<div class="panel-body">

							<?php
							if (! empty ( $model->image )) {
								echo Html::img ( '@web/PhotoDorm/' . $model->id . '/' . $model->image, [ 
										'width' => '640' 
								] );
							} else {
								echo Html::img ( '@web/PhotoDorm/freebuilding.png', [ 
										'width' => '480' 
								] );
							}
							
							?>

  </div>
					</div>
					<div class="panel panel-default">
						<div class="panel-body">
  							<?=dosamigos\gallery\Gallery::widget ( [ 'items' => $model->getThumbnails ( $model->id ) ] );?>
  </div>
					</div>

				</div>
			</div>

			<div class="col-md-5">

				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-8"></div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th><h3><?php echo $model['name']?></h3></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>

									<td>ชื่อหอพัก</td>
									<td><?php echo $model['name']?></td>
								<?php
								@$role = Yii::$app->user->identity->role;
								if ($role == 10) {
									echo Html::a ( 'จองห้องพัก', ['/room/book','rent_id' => $model ['id']], ['class' => 'btn btn-primary'] );
									
									
									/* print_r($modelfav);
									die(); */
									if (!empty ($modelfav)){
									
									echo Html::a( '<span class="glyphicon glyphicon-heart"></span>', ['/rent/myfav','id' => $model->id],['class'=>'btn btn-default disabled ']);
								
									}else {
										echo Html::a ( '<span class="glyphicon glyphicon-heart"></span>', ['/rent/myfav','id' => $model ['id']], ['class' => 'btn btn-warning'] );
									}
									
										
									/* $favs->id = null ? Html::a ( 'เพิ่มไว้ดูภายหลัง', ['/rent/myfav','id' => $model ['id']], ['class' => 'btn btn-primary']):
									Html::a( 'เพิ่มไว้ดูภายหลัง', ['/rent/myfav','id' => $model->id],['class'=>'btn btn-default disabled ']); */
									
								}
								?>
							</tr>
								<tr>

									<td>ที่อยู่</td>
									<td><?php echo $model->address->full?></td>
								</tr>
								<tr>
									<td>สถานที่ใกล้เคียง</td>
									<td><?php echo $model['near']?></td>
								</tr>
								<tr>
									<td>ประเภทหอพัก</td>
									<td><?php echo $model['type_gen']?></td>
								</tr>
								<tr>
									<td>ประเภทการเช่าพัก</td>
									<td><?php echo $model['type_rent']?></td>
								</tr>
								<tr>
									<td>ค่าน้ำ</td>
									<td><?php echo $model['cost_water']?> ต่อคน</td>
								</tr>
								<tr>
									<td>ค่าไฟ</td>
									<td><?php echo $model['cost_elec']?> ต่อหน่วย</td>
								</tr>
								<tr>
									<td>เว็บไซต์</td>
									<td><?php echo $model['web']?></td>
								</tr>
								<tr>
									<td>เบอร์โทร</td>
									<td><?php echo $model['tel1']?></td>
								</tr>
								<tr>
									<td>เบอร์โทร</td>
									<td><?php echo $model['tel2']?></td>
								</tr>

								<tr>
									<td>ผู้ดูแลหอพัก</td>
									<td><?php echo $model['intendant']?></td>
								</tr>
								<tr>
									<td>สิ่งอำนวยความสะดวก</td>
									<td><?php
									
									foreach ( $model->rentHasAccessories as $rentHasAcs ) {
										echo $rentHasAcs->accessories->name . "<br>";
									}
									?></td>
								</tr>
							</tbody>
						</table>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="">

        	<?php
									/*
									 * foreach ($accessories as $accessory){
									 * echo "<input type='checkbox' name='accesories'";
									 * echo in_array($accessory->id, $accessoriesArray)?"checked":"";
									 * echo ">".$accessory->name."<br>";
									 * }
									 */
									
									?>
        </div>

			</div>
		</div>
		<div class="row">
		
			<div class="fb-like" data-share="true" data-width="450"
				data-height="50" data-show-faces="true" data-href="<?="localhost/".Url::current()?>"></div>

			<div class="fb-comments"
				data-href="<?="localhost/".Url::current()?>"
				data-numposts="2"></div>

		</div>

	</div>

</div>
