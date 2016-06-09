<?php

use app\assets\IndexGlobalAsset;
use app\assets\UpdateGlobalAsset;
use app\assets\LayerGlobalAsset;
use app\assets\BookReturnAsset;


use yii\widgets\ActiveForm;
use yii\helpers\Html;

IndexGlobalAsset::register( $this );
UpdateGlobalAsset::register( $this );
LayerGlobalAsset::register( $this );
BookReturnAsset::register( $this );


/** -------------------------------------------------------
 * 判断是否出现 " 操作成功 " 的 tip 层
 * @var $session['isShowTip'] boolean  为 true 则出现 tip 层，false反之
 */
if ( $session['isShowTip'] ){
    echo " <script>function tip(){ layer.msg('{$session['tipContent']}', { icon: 2, offset:'100px'}) }  </script>";
    $session['isShowTip'] = false;
}


?>

<div class='update'>

<div class='all'>

	<div class='bread-nav'>
		<span>图书归还</span>	
	</div>
	<div class='verify'>	
		<div class='content'>
			<?php $form = ActiveForm::begin(['method' => 'get']) ?>				
				<?= $form -> field( $readerModel, 'readerNumber') -> textinput(['placeholder' => '请输入读者编码' ]) -> label( false ) ?>
				<?= Html::submitButton('验证', ['class' => 'btn btn-primary verify-btn'] ) ?>	
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>


</div>

<script>

window.onload = function(){

	tip();

}



</script>
