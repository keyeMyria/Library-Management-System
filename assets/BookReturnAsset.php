<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 此 asset 只服务于主页模块
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class BookReturnAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		'css/bookReturn/index.css',
    ];

    public $js = [
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
