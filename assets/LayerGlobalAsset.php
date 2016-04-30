<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 此 asset 是用于全局 layer 层
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class LayerGlobalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
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
