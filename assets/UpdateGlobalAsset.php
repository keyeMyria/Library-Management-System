<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 本资源包为全局资源包，
 * 负责 frameset right 页面的所有页面的 默认样式
 * 所有的页面都要引入这个资源包，来快速搭建 update 页面的默认样式
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class UpdateGlobalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		'css/updateGlobal.css',		
    ];

    public $js = [
		'js/layer/layer.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
