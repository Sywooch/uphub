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

<div class="wrapper">
<div id="overlay-1">
                <section id="navigation-scroll">
    <?php
    NavBar::begin([

        
        'brandLabel' => Html::img('@web/img/small.png'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-default navbar-fixed-top', ],
            
    ]);
    
    $menuItems = [
        ['label' => 'หน้าแรก', 'url' => Yii::$app->homeUrl],
          ['label' => 'ค้นหา', 'url' => ['rent/search']
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
                                'หอพักที่เก็บไว้',
                                'url' => ['/rent/viewmyfav'],
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
                        'หอพักที่เก็บไว้',
                        'url' => ['/rent/viewmyfav'],
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


if ($role==40) {

    if (isset(Yii::$app->user->identity->fullname)) {

        $menuItems[] = [
                'label' => '' . Yii::$app->user->identity->fullname . '',
                'items' => [
                        ['label' =>
                        'คุณถูกระงับการใช้งานกรุณาติดต่อผู้ดูแลระบบ',
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
                        'คุณถูกระงับการใช้งานกรุณาติดต่อผู้ดูแลระบบ',
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
</section>
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

</div>
</div>

<?php $this->endBody() ?>

</body>
<!-- js -->
        <script>
            //new WOW().init();
        </script>
        <script>
            $( function() {
  
              // change is-checked class on buttons
                $('.button-group').each( function( i, buttonGroup ) 
                {
                    var $buttonGroup =$( buttonGroup );
                    $buttonGroup.on( 'click', 'button', function() 
                    {
                        $buttonGroup.find('.is-checked').removeClass('is-checked');
                        $( this ).addClass('is-checked');
                    });
                });
              
            });
        </script>
        <!--<script src="js/jquery-ui-1.10.3.min.js"></script>
        <script src="js/jquery.knob.js"></script>
        <script src="js/daterangepicker.js"></script>
        <script src="js/bootstrap3-wysihtml5.all.min.js"></script>
        <script src="js/smoothscroll.js"></script>
        <script src="js/nivo-lightbox/nivo-lightbox.min.js"></script>
        <script src="js/script.js"></script>-->
</html>
<?php $this->endPage() ?>
