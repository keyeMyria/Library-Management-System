<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * IndexFrameTopAsset 资源包用于 app/view/index/top.php
 * ( 也就是用在 主页的 top 条)
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class IndexFrameTopAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		'css/index/top.css',
    ];

    public $js = [
		'js/indexController-jquery/1.6/jquery.min.js',
		'js/indexController-jquery-ui/1.8.13/jquery-ui.min.js',
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
