<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 此 asset 只服务于用户登陆模块
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
