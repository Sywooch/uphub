<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\Rent;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

        <script type="text/javascript" >
        function date_time(id) {
            date = new Date;
            year = date.getFullYear();
            month = date.getMonth();
            months = new Array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
            d = date.getDate();
            day = date.getDay();
            days = new Array('อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสดี', 'ศุกร์', 'เสาร์');
            h = date.getHours();
            if (h < 10) {
                h = "0" + h;
            }
            m = date.getMinutes();
            if (m < 10) {
                m = "0" + m;
            }
            s = date.getSeconds();
            if (s < 10) {
                s = "0" + s;
            }
            result = '' + days[day] + ' ' + d + ' ' + months[month] + ' ' + year + ' ' + h + ':' + m + ':' + s;
            document.getElementById(id).innerHTML = result;
            setTimeout('date_time("' + id + '");', '1000');
            return true;
        }

    </script>


	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74787890-1', 'auto');
  ga('send', 'pageview');

</script>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([


        'brandLabel' => Html::img('@web/img/logo.png'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'หน้าแรก', 'url' => Yii::$app->homeUrl],
        ['label' => 'ค้นหา',// 'url' => ['']
        ],
    ];
    if (Yii::$app->user->isGuest) {
     $menuItems[] = ['label' => 'Login', 'url' => ['/site/auth?authclient=facebook']];

        /* $menuItems[] = [
        		'label' =>  yii\authclient\widgets\AuthChoice::widget(['baseAuthUrl' => ['site/auth']]),
        		'encode'=>false
        ]; */
    } else {
    	$role=Yii::$app->user->identity->role;
    	$id=Yii::$app->user->identity->id;
    	
    	$idU = '/user/view';
    	$updateU= $idU."?id=".$id;



    	$user_id = Rent::find()
    	->where(['=', 'user_id', $id])
    	->one();
    	@$id_rent= $user_id->id;
    	
    	

    	$rent ='rent/view?id=';
    	$rent2 = $rent.$id_rent;



    	
    	
if ($role==10) {
	if (isset(Yii::$app->user->identity->fullname)) {
	
		$menuItems[] = [
				'label' => '' . Yii::$app->user->identity->fullname . '',
				'items' => [
						['label' =>
								'ข้อมูลส่วนตัว',
								'url' => [$updateU],
								'linkOptions' => ['data-method' => 'post']
						],
						['label' =>
								'Logout',
								'url' => ['/site/logout'],
								'linkOptions' => ['data-method' => 'post']
	
						],
						['label' =>
								'หอพักที่เก็บไว้',
								'url' => ['/rent/viewmyfav'],
								'linkOptions' => ['data-method' => 'post']

						],
				],
		];
		
	}else {
		
		$menuItems[] = [
				'label' => '' . Yii::$app->user->identity->username . '',
				'items' => [
	
						['label' =>
								'แก้ไขข้อมูลส่วนตัว',
								'url' => [$updateU],
								'linkOptions' => ['data-method' => 'post']
						],
	
						['label' =>
								'Logout',
								'url' => ['/site/logout'],
								'linkOptions' => ['data-method' => 'post']
	
						],
				],
		];
	}
}

if ($role==20) {
	if (isset(Yii::$app->user->identity->fullname)) {
		
		$menuItems[] = [
				'label' => '' . Yii::$app->user->identity->fullname . '',
				'items' => [
						['label' =>
								'ข้อมูลส่วนตัว',
								'url' => [$updateU],
								'linkOptions' => ['data-method' => 'post']
						],
						['label' =>
								'หอพักของฉัน',
								'url' => ['/rent/myrent'],
								'linkOptions' => ['data-method' => 'post']

						],
						['label' =>
						'Logout',
						'url' => ['/site/logout'],
						'linkOptions' => ['data-method' => 'post']
						
						],
				],
		];
	}else {
		
		$menuItems[] = [
				'label' => '' . Yii::$app->user->identity->username . '',
				'items' => [

						['label' =>
								'แก้ไขข้อมูลส่วนตัว',
								'url' => [$updateU],
								'linkOptions' => ['data-method' => 'post']
						],
						['label' =>
						'หอพักของฉัน',
						'url' => ['/rent/myrent'],
						'linkOptions' => ['data-method' => 'post']
						],
						['label' =>
								'Logout',
								'url' => ['/site/logout'],
								'linkOptions' => ['data-method' => 'post']

						],
				],
		];
	}
}
    	
if ($role==30) {
	
	if (isset(Yii::$app->user->identity->fullname)) {

		$menuItems[] = [
				'label' => '' . Yii::$app->user->identity->fullname . '',
				'items' => [
						['label' =>
								'แก้ไขข้อมูลส่วนตัว',
								'url' => [$updateU],
								'linkOptions' => ['data-method' => 'post']
						],
						['label' =>
								'หอพักทั้งหมด',
								'url' => ['/rent/index'],
								'linkOptions' => ['data-method' => 'post']
						],
						['label' =>
								'จัดการสมาชิก',
								'url' => ['/user/index'],
								'linkOptions' => ['data-method' => 'post']
						],
						['label' =>
								'Logout',
								'url' => ['/site/logout'],
								'linkOptions' => ['data-method' => 'post']

						],
				],
		];
	}else {
		
		$menuItems[] = [
				'label' => '' . Yii::$app->user->identity->username . '',
				'items' => [

						['label' =>
								'แก้ไขข้อมูลส่วนตัว',
								'url' => [$updateU],
								'linkOptions' => ['data-method' => 'post']
						],
						['label' =>
								'หอพักทั้งหมด',
								'url' => ['/rent/index'],
								'linkOptions' => ['data-method' => 'post']
						],
						['label' =>
								'จัดการสมาชิก',
								'url' => ['/user/index'],
								'linkOptions' => ['data-method' => 'post']
						],
						['label' =>
								'ออกจากระบบ',
								'url' => ['/site/logout'],
								'linkOptions' => ['data-method' => 'post']

						],
				],
		];
	}
}
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container"> 
    <div class="row">
  		<div class="col-md-10 col-md-offset-1">
        <?php echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php echo Alert::widget() ?>
        <?php echo$content ?>
    	</div>
    </div>
</div>

<br><br>
<?php $this->endBody() ?>
<div class="footer" style="color: sandybrown">
	
		
			<div class="row">
  				<div class="col-xs-12 col-sm-6 col-md-8">
  			
  				</div>
  				<div class="col-xs-6 col-md-4" align="right">
  					ติดต่อ <br>
  					 <a href="#">สนใจเพิ่มหอพักของท่าน</a><br>
  					 เบอร์โทรติดต่อ : 087-4453719,085-1688917<br>
  				E-mail : uphub.u@gmail.com
  				
  				
  				</div>
			</div>
	
</div>
</body>
</html>
<?php $this->endPage() ?>
