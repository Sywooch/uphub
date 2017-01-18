<?php

namespace frontend\themes\play;

use yii\web\AssetBundle;

class MaterialAsset extends AssetBundle {
	public $sourcePath = '@frontend/themes/play/assets';
	public $baseUrl = '@web';
	public $css = [ 
			'css/bootstrap.min.css',
			'css/dashboard.css',
			'css/style.css', 
			'css/popuo-box.css',
	]
	;
	public $js = [ 
			'js/bootsrap.min.js',
			'js/jquery.magnific-popup.js',
			'js/modernnizr.custom.min.js',
			'js/responsiveslides.min.js',
			'js/jquery-1.11.1.min.js',
			'js/bootstrap.min.js'
	]
	;
	public $depends = [ 
			'yii\web\YiiAsset',
			'yii\bootstrap\BootstrapAsset' 
	];
}