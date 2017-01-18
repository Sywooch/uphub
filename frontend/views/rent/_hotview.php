<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Rent;

?>

<div class="row">

	<div class="col-md-10 col-md-offset-1">

		<div class="callbacks_container">
    
					<?php
					if (! empty ( $rentView )) {
						
						foreach ( $rentView as $rent ) {
							?>
									 
					<div class="col-md-3 resent-grid recommended-grid slider-first">
					<div class="resent-grid-img recommended-grid-img" width="600">
											<?php $img = Url::to('../photoDorm/').$rent['id']; ?>
											
											      <a href="view?id=<?php echo $rent['id']?>" class="">
											        <?php
							if ($rent->image) {
								echo Html::img ( '../PhotoDorm/' . $rent->id . '/thumbnail/' . $rent->image, [ 
										'width' => '600' 
								] );
							?>
									<div class="clck">
										<h3 div="" style="color: white;font-size: 12px;">
										<span style="" class="glyphicon glyphicon-eye-open"></span> <?php echo ($rent['view']==null? "0":$rent['view']);?> </h3>
									</div>
								<?php } else {
								echo Html::img ( '../PhotoDorm/freebuilding.jpg', [ 
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
							<a href="view?id=<?php echo $rent['id']?>" class="title"><?php echo $rent['name']?></a>
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
					
					<span id="btnFVisible" class="hidden"><?php echo $frontVisible;?></span>
			<span id="btnBVisible" class="hidden"><?php echo $backVisible;?></span>
					
					<?php
					
					// echo("allPage".$allPage);
					// echo("backVisible".$backVisible);
					// echo("frontVisible".$frontVisible); 					?>
					
					<?php
					
if ($backVisible == 1) {
						?>
						<button id="back" type="button" class="btn btn-default"
				aria-label="Left Align" onclick="back()"
				style="position: absolute; top: 225px; height: 10%; left: -50px;">
				<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
			</button>
						<?php }?>
					
<?php

if ($allPage != $frontVisible) {
	?>
					<button id="next" type="button" class="btn btn-default"
				aria-label="Left Align" onclick="next()"
				style="position: absolute; top: 225px; right: -35px; height: 10%;">
				<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
			</button>

					<?php }?><br>

			<div class="clearfix"></div>
		</div>







	</div>


</div>