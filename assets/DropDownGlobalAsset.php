<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 此 asset 用于全局的下拉框功能， 提供 CSS JS  
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class dropDownGlobalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [

		'css/dropDownGlobal/normalize.css',
		'css/dropDownGlobal/fancySelect.css',
		'css/dropDownGlobal/index.css',
    ];

    public $js = [
		'js/dropDownGlobal/fancySelect.js',
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
