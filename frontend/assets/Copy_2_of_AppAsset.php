<?php
namespace frontend\assets;
use yii\web\AssetBundle;
class AppAsset extends AssetBundle
{

	//play
	public $basePath = '@frontend/themes/Play/';
	public $sourcePath = '@frontend/themes/Play/';
	
	
    public $css = [
    		
    		'css/bootstrap.min.css',
    		'css/dashboard.css',
    		'css/style.css',
    		'css/stylesheet.css'
    		/* 'css/popuo-box.css', */
    	
    ];
    public $js = [
    		'js/addfloor.js',
			'js/fb.js',
    		'js/bootbox.min.js',
    		'js/main.js'
/*     		'js/bootsrap.min.js',
    		'js/jquery.magnific-popup.js',
    		'js/modernizr.custom.min.js',
    		'js/responsiveslides.min.js',
    		'js/jquery-1.11.1.min.js', */
    		
    		
    		
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public function init()
    {
    	parent::init();
    	$this->publishOptions['forceCopy'] = true;
    }
}

