<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 此 asset 只服务于用户 图书档案 -> 图书信息统计
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class BookInfoStatAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';

	public $css = [
		'css/indexGlobal.css',
		'css/background.css',
    ];

    public $js = [
		'js/highcharts/js/highcharts.js',
		'js/highcharts/js/modules/exporting.js',
    ];



    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
