<?php
/* @var $this yii\web\View */
use frontend\models\Rent;
use frontend\models\Fav;
use yii\helpers\Html;
use frontend\controllers\RentController;
use frontend\controllers\FavController;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use frontend\models\Uploads;
use yii\bootstrap\Modal;

use yii\bootstrap\Carousel;
use yii\web\Link;
$this->title = 'หอพักของฉัน';
$this->params ['breadcrumbs'] [] = $this->title;

$asset = frontend\assets\AppAsset::register ( $this );
$baseUrl = $asset->baseUrl;
?>
<div class="main-grids">
	<div class="top-grids">
		<div class="recommended-info">
			<div>
				<h3>
					<span style="font-size: 1em; color: #cec0af"
						class="glyphicon glyphicon-bookmark"></span> หอพักที่เก็บไว้
				</h3>
				<hr>
			</div>
						
					
					<?php
					
					foreach ( $favs as $fav ) {
						
						?>
									 
					<div class="col-md-4 resent-grid recommended-grid slider-top-grids">
				<div class="resent-grid-img recommended-grid-img" width="600">
											<?php $img = Url::to('http://localhost/tags/photoDorm/').$fav->rent->id; ?>
											   <a href="view?id=<?php echo $fav->rent->id?>" class="">
											        <?php
						if ($fav->rent->image) {
							echo Html::img ( 'http://localhost/uphubgg2016/frontend/web/photoDorm/' . $fav->rent->id . '/thumbnail/' . $fav->rent->image, [ 
									'width' => '600' 
							] );
						} else {
							echo Html::img ( 'http://localhost/uphubgg2016/frontend/web/photoDormfreebuilding.jpg', [ 
									'width' => '600' 
							] );
						}
						?>
	
											        </a>

					<div class="clck">
						<h1 div style="color: white;">
							<span style="font-size: 0.75em;"
								class="glyphicon glyphicon-eye-open"></span> <?php echo $fav->rent['view']?></h1>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info">
					<h3>
						<a href="view?id=<?php echo $fav->rent->id?>" class="title"><?php echo $fav->rent['name']?></a>
					</h3>

					<ul>
						<li><p class="author author-info">
								<a href="#" class="author"><?php echo $fav->rent['intendant']?></a>
							</p></li>
						<li class="right-list">
									<?php
						/*
						 * echo Html::a ( '<span class="glyphicon glyphicon-trash"></span>', [
						 * '/fav/delete',
						 *
						 * 'id' => $fav->id
						 * ],
						 * ['class' => 'btn btn-danger btn-sm',
						 * 'data-method'=>'post',
						 * ]);
						 */
						
						Html::button ( '<span class="glyphicon glyphicon-trash"></span>', [ 
								
								'id' => 'modalButton',
								'class' => 'btn btn-danger btn-sm',
								'data-method' => 'post' 
						] );
						
						Modal::begin ( [ 
								
								'header' => '<center> ยืนยันการลบ ?</center>',
								'footer' => Html::a ( '<span class="glyphicon glyphicon-ok"></span> ยืนยัน', [ 
										'/fav/delete',
										'id' => $fav->id 
								], [ 
										'class' => 'btn btn-success ',
										'data-method' => 'post' 
								] ),
								'toggleButton' => [ 
										'label' => '<span class="glyphicon glyphicon-trash"></span>',
										'class' => 'btn btn-danger btn-sm' 
								],
								'id' => 'modal',
								'size' => 'modal-sm' 
						] );
						echo "<div id='modalContent'></div>";
						
						Modal::end ();
						
						?>
						</li>

					</ul>
				</div>
			</div>
					<?php
					}
					// }else echo "error";
					?>
					
					<div class="clearfix"></div>
		</div>
	</div>
</div>





<style>
function
 
myFunction
 
()
{
var
 
j
 
=
$('
#inp
 
')
.val
 
();
var
 
n
 
=
parseInt

	
(
j
);var

	
i
 
=0;
while
 
(
i
 
<
n
 
)
{
$('<
input
 
type
="text"
 
id
="fname"
 
name
="floor
[
]
"
/
>
<
button
 
onclick
="myFunction()"
>
Try

	
it
</button
>
<
br
/
>
<
br
/
>
')
.appendTo
($('
#demo
'));i
+
+;
}
}
</style>