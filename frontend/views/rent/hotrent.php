<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Rent;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'หอพักตามความนิยม');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jumbotron" id="hot">

				<B><h2 style="color: #6696ba">
						<span style="font-size: 1em; color: #ff8c00"
							class="glyphicon glyphicon-bookmark"></span> หอพักกำลังมาแรง
						
					</h2></B>
				<hr>
<div class="rent-search">
	<!-- div ครอบ -->
        <?php echo $this->render('_hotrent', ['rentHot' => $rentHot,
        	'kom'=>$kom,
        		'backVisible' => $backVisible,
				'frontVisible' => $frontVisible,
        		'allPage' => $allPage
        ]);?>
</div>
</div>
<script>

var page = 1;

function next(){
	
	page++;
	
	if (page) {
		$.ajax({
			  method: "GET",
			  url: "<?php echo Url::to(["/rent/hotlist"]);?>",
			  data: { page: page }
			})
			  .done(function( msg ) {
				  //alert(msg);
				  $('.rent-search').html(msg);

				  if (	$('#btnFVisible').html() == 0 ) $('#next').hide();
					else $('#next').show();

				 // alert('btnB ' + $('#btnBVisible').html());
				  if (	$('#btnBVisible').html() == 0 ) $('#back').hide();
					else $('#back').show();
			  });
			   
			   // $.post('hotview.php',{data:page});
	}
	
	
}


function back(){
	
	$('#back').hide();
	page--;
	if (page) {
		$.ajax({
			  method: "GET",
			  url: "<?php echo Url::to(["/rent/hotlist"]);?>",
			  data: { page: page }
			})
			  .done(function( msg ) {
				 // alert(msg);
			    $('.rent-search').html(msg);

			    if (	$('#btnFVisible').html() == 0 ) $('#next').hide();
				else $('#next').show();

			    
			    if (	$('#btnBVisible').html() == 0 ) $('#back').hide();
					else $('#back').show();
			  });
		//	    $.post('hotview.php',{data:page});
	}
		
	
	
}


</script>