<?php

use app\assets\ParamSetGlobalAsset;
use app\assets\LayerGlobalAsset;
use app\assets\BookReturnAsset;


use yii\widgets\ActiveForm;
use yii\helpers\Html;

ParamSetGlobalAsset::register( $this );
LayerGlobalAsset::register( $this );
BookReturnAsset::register( $this );


/** -------------------------------------------------------
 * 判断是否出现 " 操作成功 " 的 tip 层
 * @var $session['isShowTip'] boolean  为 true 则出现 tip 层，false反之
 */
if ( $session['isShowTip'] ){
    echo " <script>function tip(){ layer.msg('{$session['tipContent']}', { icon: 1, offset:'100px'}) }  </script>";
    $session['isShowTip'] = false;
}


?>


<div class='all'>

	<div class='bread-nav'>
		<span>图书归还</span>	
	</div>
	
	<div class='top-btn-bar'>
		<button class='btn btn-primary add-borrow-btn'> 借阅图书 </button>		
		<button class='btn btn-primary switch-reader-btn'> 切换读者 </button>		

	</div>

	<div class='reader-data-box'></div>

	<div class='reader-borrow-box'></div>

	
</div>





