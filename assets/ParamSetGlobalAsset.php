<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 被 参数设置 下的四个子模块所共用的资源包
 *
 * ParamSetGlobal 资源包，顾名思义是负责整个管理系统的 “ 参数设置 ”,
 * 大模块下面的 4 个子模块的 css 样式.
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class ParamSetGlobalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		'css/paramSetGlobal/index.css',
		'css/paramSetGlobal/update.css',
		'css/background.css',
    ];

    public $js = [
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
