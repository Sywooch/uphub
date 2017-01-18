


<?php



use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* 
$this->title = Yii::t('app', 'Search');
$this->params['breadcrumbs'][] = $this->title; */
?>

<br><br>
<h2>ค้นหาหอพัก</h2>
<?php yii\widgets\Pjax::begin(['id' => 'search-rent-pjax','enablePushState'=>false]) ?>
         
<div class="row">
  <div class="col-md-4">
  <!-- เรียก view _search.php -->
  <?php echo $this->render('search_1', ['model' => $searchModel]); ?>
  
  </div>
  <div class="col-md-8">
<?php //echo Yii::$app->request->BaseUrl."++++".Yii::$app->basePath?>

<?= GridView::widget([
                'id'=>'search-rent',
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
				'tableOptions' =>['class' => 'table table-striped table-bordered'],
		
				
                'columns' => [
                    /* ['class' => 'yii\grid\SerialColumn'],
                		['attribute'=>'idss',
                		'value' => function($model){
                			/* $_room = "";
                			foreach ($model->rooms as $room){
                				$_room .= $room->id.",";
                			}//ลูปเรียกเลขห้อง
 							return $_room;    */  //เรียก เลขห้องออกมาก          		
						//}
					//], 
					
                		[
                		'class' => 'yii\grid\ActionColumn', 
                		'template' => '
                			<div class="row">
                					<div class="col-xs-6 col-md-3" a>
                						{image}
                					</div>
  									<div class="col-xs-12 col-sm-6 col-md-8">
                						<H3 style="margin-top: 10px;">{link}</h3> 
                						&nbsp{near}<BR> 
                						&nbsp{view}
                					</div>
                				</div>',
                		'buttons' => [
                				'image' => function ($url,$model) {
                					
                					if ($model->image) {
                						$image=Html::img (  
                								Yii::$app->request->BaseUrl.'/PhotoDorm/' . $model->id . '/thumbnail/' . $model->image
                								, ['width' => '100' , 'class'=>'img-thumbnail'
										] );
                					}else {
                						$image = Html::img(
                								Yii::$app->request->BaseUrl.'/PhotoDorm/freebuilding.jpg',
                								['width'=>'100', 'class'=>'img-thumbnail']);
                					}
                				
                				return $image;
                				},
                				
                				'link' => function ($url,$model,$key) {
                				$name =  Html::a($model->name, '/uphubff/rent/view?id='.$model->id);
                				return $name;
                				},
                				
                				'near' => function ($url,$model,$key) {
                				return'สถานที่ใกล้เคียง :'.$model->near ;
                				},
                				
                				'view' => function ($url,$model,$key) {
                				return'มีผู้เข้าชม :'.$model->view ;
                				},
                				],
                			],
                		//'near',
                ],
            ]); ?>
            
</div>
</div>            
            
				

<?php yii\widgets\Pjax::end() ?>




