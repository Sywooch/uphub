<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\widgets\Alert;
use frontend\model\main;

/* use frontend\themes\material\MaterialAsset; */
/* MaterialAsset::register($this); */

// $asset_path = Yii::$app->assetManager->getPublishedUrl('@frontend/themes/material/assets');
$this->registerCssFile ( '@web/css/style.css' );
$this->registerJsFile('@web/js/play.js');
AppAsset::register ( $this );
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags()?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>
</head>
<body class="homepage">

    <?php
				
$this->beginBody ();
				/* $this->registerCss("body { background: #EEE5DE; }"); */
				?>
     <?php $this->beginBody()?>
    <div class="wrap">
        <?php
								NavBar::begin ( [ 
										'brandLabel' => 'My Company',
										'brandUrl' => Yii::$app->homeUrl,
										'options' => [ 
												'class' => 'navbar-inverse navbar-fixed-top' 
										] 
								] );
								$menuItems = [ 
										/*
										 * 'option'=>[
										 * 'class'=>'collapse navbar-collapse navbar-right'],
										 */
										[ 
												'label' => 'Home',
												'url' => [ 
														'/site/index' 
												] 
										],
										[ 
												'label' => 'Member',
												'url' => [ 
														'/member' 
												] 
										],
										[ 
												'label' => 'About',
												'url' => [ 
														'/site/about' 
												] 
										],
										[ 
												'label' => 'Contact',
												'url' => [ 
														'/site/contact' 
												] 
										],
										[ 
												'label' => 'Owner',
												'url' => [ 
														'/rent/index' 
												] 
										],
										[ 
												'label' => 'Photo',
												'url' => [ 
														'/photo-library/index' 
												] 
										] 
								];
								if (Yii::$app->user->isGuest) {
									$menuItems [] = [ 
											'label' => 'Signup',
											'url' => [ 
													'/site/signup' 
											] 
									];
									$menuItems [] = [ 
											'label' => 'Login',
											'url' => [ 
													'/site/login' 
											] 
									];
								} else {
									$menuItems [] = [ 
											
											'label' => '<img src="https://graph.facebook.com/' . Yii::$app->user->identity->id_fb . '/picture\" height=\"50\"  />',
											'encode' => false 
									];
									$menuItems [] = [ 
											'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
											'url' => [ 
													'/site/logout' 
											],
											'linkOptions' => [ 
													'data-method' => 'post' 
											] 
									];
								}
								echo Nav::widget ( [ 
										'options' => [ 
												'class' => 'navbar-nav navbar-right' 
										],
										'items' => $menuItems 
								] );
								NavBar::end ();
								?>

        <div class="container">
        <?=Breadcrumbs::widget ( [ 'links' => isset ( $this->params ['breadcrumbs'] ) ? $this->params ['breadcrumbs'] : [ ] ] )?>
        <?= Alert::widget()?>
        <?= $content?>
        </div>
	</div>

	</header>


	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					&copy; 2014 Your Company. Designed by <a target="_blank"
						href="http://shapebootstrap.net/"
						title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>
				</div>
				<div class="col-sm-6">
					<ul class="social-icons">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
						<li><a href="#"><i class="fa fa-behance"></i></a></li>
						<li><a href="#"><i class="fa fa-flickr"></i></a></li>
						<li><a href="#"><i class="fa fa-youtube"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#"><i class="fa fa-github"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!--/#footer-->


    <?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
