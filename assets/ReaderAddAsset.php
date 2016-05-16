<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 此 asset 只服务于用户 读者管理 > 添加读者
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class ReaderAddAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

	public $css = [
		'css/readerAdd/index.css',
		'css/indexGlobal.css',
		'css/background.css',
    ];

    public $js = [
		'js/layer/layer.js',
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
