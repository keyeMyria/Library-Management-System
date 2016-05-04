<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 此 asset 用于全局的下拉框功能， 提供 CSS JS  
 * @author Zhiqiao Xu  <xuzhiqiao97@gmail.com> 
 *
 * 使用方法(以下说的代码，全都是写在 view 层)：
 *	1. 首先注册资源包
 *	2. 创建出 <select>  <option>...... 这些标签块
 *	3. 在 <select> 给上属性 class='basic-usage-demo'
 *	4. 随便找个地方，写上
 *					<script>
					     window.onload = function(){
							$(document).ready(function(){
								$('.basic-usage-demo').fancySelect();
							});
						 }
					</script>

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
