<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 此 asset 只服务于用户 图书档案 > 图书添加
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class BookAddAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

	public $css = [
		'css/bookAdd/index.css',
    ];

    public $js = [
		'js/layer/layer.js',
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
