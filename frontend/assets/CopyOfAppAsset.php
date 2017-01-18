<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    //public $basePath = '@webroot/miew';
    //public $baseUrl = '@web';
    
	//multi
	public $basePath = '@bower/multi/';
	public $sourcePath = '@bower/multi/';
	
	
	/* //play
	public $basePath = '@bower/play/';
	public $sourcePath = '@bower/play/'; */
	
	
	//Material
	/* public $sourcePath = '@bower/material';
	public $baseUrl = '@web'; */
    
/* 	public $css = [
			'css/material-wfont.min.css',
			'css/material.min.css',
			'css/ripples.min.css',
			'css/style.css',
	];
	public $js = [
			'js/material.min.js',
			'js/ripples.min.js',
	]; */
    public $css = [
       
    		'css/bootstrap.min.css',
    		'css/font-awesome.min.css',
    		'css/animate.min.css',
    		'css/owl.carousel.css',
    		'css/owl.transitions.css',
    		'css/prettyPhoto.css',
    		'css/main.css',
    		'css/responsive.css',
    		
    		/* //play
    		'css/bootstrap.min.css',
    		'css/dashboard.css',
    		'css/style.css', */
    		
    	
    ];
    public $js = [
    		'js/jquery.js',
    		'js/bootstrap.min.js',
    		'http://maps.google.com/maps/api/js?sensor=true',
    		'js/owl.carousel.min.js',
    		'js/mousescroll.js',
    		'js/smoothscroll.js',
    		'js/jquery.prettyPhoto.js',
    		'js/jquery.isotope.min.js',
    		'js/jquery.inview.min.js',
    		'js/wow.min.js',
    		'js/main.js',
    		
    		/* //play
    		'js/jquery-1.11.1.min.js',
    		'js/bootstrap.min.js' */
    		
    		
    		
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
