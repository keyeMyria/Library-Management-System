<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * FramesetTopAsset 资源包用于 app/view/frameset/top.php
 * ( 也就是用在 主页的 top 条)
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class FramesetTopAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		'css/frameset/top.css',
    ];

    public $js = [
		'js/FramesetController-jquery/1.6/jquery.min.js',
		'js/FramesetController-jquery-ui/1.8.13/jquery-ui.min.js',
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
