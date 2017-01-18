<?php
use \yii\web\Request;
use \yii\web\View;



$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());

/* Yii::setAlias('@themes', dirname(__DIR__) . '/themes'); */
$params = array_merge ( require (__DIR__ . '/../../common/config/params.php'),
require (__DIR__ . '/../../common/config/params-local.php'),
require (__DIR__ . '/params.php'), require (__DIR__ . '/params-local.php') );

return [
		'id' => 'app-frontend',
		'basePath' => dirname ( __DIR__ ),
		'bootstrap' => [
				'log'
		],
		'controllerNamespace' => 'frontend\controllers',
		'components' => [
				'image' => [
						'class' => 'yii\image\ImageDriver',
						'driver' => 'GD',  //GD or Imagick
				],
				'view'=>[
						'theme'=>[
								'pathMap'=>[
										//'@app/views' => '@app/themes/earth2/views'
										'@app/views'=>'@frontend/themes/play'
								]
						]
				],

				
				'social' => [
						// the module class
						'class' => 'kartik\social\Module',

						// the global settings for the Facebook plugins widget
						'facebook' => [
								'appId' => '1725016781115682',
								'secret' => 'bcf3f49151cabb6906abf1393a27fd4c',
						],

						],
				/*  'view'=> [
					'theme' => [
							'pathMap' => [
									'@app/views' => '@app/themes/earth2/views'
							],
							'baseUrl'   => '@frontend/themes/earth2'
					],
				], */
				'session' => [
						'name' => 'PHPFRONTSESSID',
						//'savePath' => __DIR__ . '/../tmp',
						//'cookieParams' => [
								//'path'=>'/yiiTraining'  
						//],
				],
				'user' => [
						'identityClass' => 'common\models\User',
						'enableAutoLogin' => true,
						'identityCookie' => [
								'name' => '_uphub', // unique for frontend
								'path'=>'/',  // correct path for the frontend app.
						],
				],
				'request' => [
						'baseUrl' => $baseUrl,
				],
				'urlManager' =>[
						'baseUrl' => $baseUrl,
						'enablePrettyUrl' => true,
						'showScriptName' => false,
						//'suffix' => '.xxx',
						'rules'=>[
								'home'=>'/site/index',
								'about' => '/site/about',
								'register' => '/site/signup',
								'owner' => '/room/index',
								'login' => '/site/login',
								'logout' => '/site/logout',
								'frontend/themes/' => '/frontend/themes/',
								'say' =>'/site/say',
								'accessories' => '/accessories/index',
						],
				],

				'log' => [
						'traceLevel' => YII_DEBUG ? 3 : 0,
						'targets' => [
								[
										'class' => 'yii\log\FileTarget',
										'levels' => [
												'error',
												'warning'
										]
								]
						]
				],
				'errorHandler' => [
						'errorAction' => 'site/error'
				],
				'authClientCollection' => [
						'class' => 'yii\authclient\Collection',
						'clients' => [
								'facebook' => [
									'class' => 'yii\authclient\clients\Facebook',
									'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
									'clientId' => '1663454183938808',
									'clientSecret' => '54c7d4f08ed875e400cf9f1af320cc59'

									//'clientId' => '1462669027374339', //เน€เธ�เธ…เน€เธ�ย�เน€เธ�เธ�เน€เธ�ย� web
									//'clientSecret' => '8d3b28efc20700d6a7645e7037411647'
							]
						]
				],
		],
		'modules' => [
				'gridview' =>  [
						'class' => '\kartik\grid\Module'
						// enter optional module parameters below - only if you need to
						// use your own export download action or custom translation
						// message source
						// 'downloadAction' => 'gridview/export/download',
						// 'i18n' => []
				]

				



				
		],
		'params' => $params
];
