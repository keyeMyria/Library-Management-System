<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * FramesetLeftAsset 资源包用于 @app/view/frameset/left.php
 * ( 也就是用在 主页左侧导航栏)
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class FramesetLeftAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		'css/frameset/left.css',
    ];

    public $js = [
		'js/FramesetController-jquery/1.6/jquery.min.js',
		'js/FramesetController-jquery-ui/1.8.13/jquery-ui.min.js',
		'js/FramesetController-jquery/left.js',
		
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
