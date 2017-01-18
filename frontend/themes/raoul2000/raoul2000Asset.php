<?php

namespace app\themes\raoul2000;

use yii\web\AssetBundle;

class raoul2000Asset extends AssetBundle {
	public $depends = [ 
			'yii\web\YiiAsset',
			//'yii\bootstrap\BootstrapAsset'
			'raoul2000\bootswatch\BootswatchAsset',
	]
	
	
	;
}