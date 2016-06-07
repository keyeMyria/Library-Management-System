<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 此 asset 只服务于书架管理模块
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class BookTypeManageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		'css/indexGlobal/index.css',
    ];

    public $js = [
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
