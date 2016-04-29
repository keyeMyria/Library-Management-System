<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 */

class BookshelfAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
		'css/bookshelf/index.css',
		'css/background.css',
		'css/bookshelf/addBookshelf.css',
    ];

    public $js = [
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
