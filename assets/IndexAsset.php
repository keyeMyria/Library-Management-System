<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		'css/index/index.css',
		'css/background.css',
    ];

    public $js = [
		'js/jquery/jquery-1.12.3.min.js',
		'js/layer/layer.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
