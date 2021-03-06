<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 此 asset 只服务于主页模块
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		'css/index/index.css',
    ];

    public $js = [
		'js/layer/layer.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
