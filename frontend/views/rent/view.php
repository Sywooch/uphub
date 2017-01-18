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
use yii\bootstrap\Modal;
use yii\base\Model;

/* use frontend\models\Rent; */

/* @var $this yii\web\View */
/* @var $model frontend\models\Rent */

/**
 * ********register facebook api *********
 */

$this->title = $model->name;
$this->params ['breadcrumbs'] [] = [ 
		'label' => 'หน้าค้นหา',
		'url' => [ 
				'search' 
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
<div class="main-grids">
	<div class="row">
		<div class="col-md-6">
			<B><h1 style="color: #68a697">
					<span style="font-size: 1em; color: #cec0af"
						class="glyphicon glyphicon-bookmark"></span> <?php echo $model->name?> 
				</h1></B>

		</div>

		<div class="col-md-6" align="right">
	<?php
	@$role = Yii::$app->user->identity->role;
	if ($role == 10) {
		echo Html::a ( 'จองห้องพัก', [ 
				'/room/book',
				'rent_id' => $model ['id'] 
		], [ 
				'class' => 'btn btn-primary' 
		] );
		
		/*
		 * print_r($modelfav);
		 * die();
		 */
		if (! empty ( $modelfav )) {
			
			echo Html::a ( '<span class="glyphicon glyphicon-heart"></span>', [ 
					'/rent/myfav',
					'id' => $model->id 
			], [ 
					'class' => 'btn btn-default disabled ' 
			] );
		} else {
			echo Html::a ( '<span class="glyphicon glyphicon-heart"></span>', [ 
					'/rent/myfav',
					'id' => $model ['id'] 
			], [ 
					'class' => 'btn btn-warning' 
			] );
		}
	}
	?>
								
								<h1>    ผู้เข้าชม : <?php echo $model['view'] ?></h1>
		</div>
	</div>

	<div align="right"></div>



	<hr>

	<div class="jumbotron" align="center">
	
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

	<div class="jumbotron" align="center">
  				<?=dosamigos\gallery\Gallery::widget ( [ 'items' => $model->getThumbnails ( $model->id ) ] );?>
  			</div>

	<div class="panel panel-default">
		<div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> <b>รายละเอียดข้อมูลหอพัก</b></div>
		<div class="panel-body">
			<div class="col-md-6">
				<p>ชื่อหอพัก : <?php echo $model['name']?></p>
				<p>ที่อยู่ : <?php echo $model['address']['full']?></p>
				<p>สถานที่ใกล้เคียง : <?php echo $model['near']?></p>
				<p>ประเภทหอพัก : <?php echo $model['type_gen']?></p>
				<p>ประเภทการเช่าพัก : <?php echo $model['type_rent']?></p>
			</div>

			<div class="col-md-6">
				<p>เงื่อนไข : <?php echo $model['condition']?></p>
				<p>ผู้ดูแลหอพัก : <?php echo $model['intendant']?></p>
				<p>ค่าน้ำ : <?php echo $model['cost_water']?> ต่อคน</p>
				<p>ค่าไฟ : <?php echo $model['cost_elec']?> ต่อหน่วย</p>
				<p>เว็บไซต์ : <?php echo $model['web']?></td>
				
				
				<p>เบอร์โทร : <?php echo $model['tel1'] ?>  <?php echo $model['tel2'] ?></td>
			
			</div>




		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading"><span class="glyphicon glyphicon-lamp"></span> <b>สิ่งอำนวยความสะดวก</b></div>
		<div class="panel-body">
		<div class="col-md-6">
					<?php
				
					foreach ( $model->rentHasAccessories as $rentHasAcs ) {

						if($rentHasAcs['accessories']['name'] == ""){}else {
						echo "<span style='color: #68a697' class='glyphicon glyphicon-ok'></span>"."  ".$rentHasAcs['accessories']['name'] . "<br>";}
					}
					?>
		</div>





</div>
	</div>

	<div align="center">
		<div class="fb-like" data-share="true" data-width="450"
			data-height="50" data-show-faces="true"
			data-href="<?="localhost/".Url::current()?>"></div>

		<div class="fb-comments" data-href="<?="localhost/".Url::current()?>"
			data-numposts="2"></div>
	</div>


</div>

</div>

