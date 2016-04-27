<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * IndexFrameLeftAsset 资源包用于 app/view/index/left.php
 * ( 也就是用在 主页左侧导航栏)
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class IndexFrameLeftAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		'css/index/left.css',
    ];

    public $js = [
		'js/indexController-jquery/1.6/jquery.min.js',
		'js/indexController-jquery-ui/1.8.13/jquery-ui.min.js',
		'js/indexController-jquery/left.js',
		
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
