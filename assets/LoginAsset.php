<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		'css/login/normalize.css',
        'css/login/login.css',
    ];

    public $js = [
		'js/layer/layer.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
