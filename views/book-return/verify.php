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
    echo " <script>function tip(){ layer.msg('{$session['tipContent']}', { icon: 2, offset:'100px'}) }  </script>";
    $session['isShowTip'] = false;
}


?>


<div class='all'>

	<div class='bread-nav'>
		<span>图书归还</span>	
	</div>

	<div class='content'>
		<?php $form = ActiveForm::begin() ?>				
			<?= $form -> field( $readerModel, 'readerNumber') -> textinput(['placeholder' => '请输入读者编码' ]) -> label( false ) ?>
			<?= Html::submitButton('验证', ['class' => 'btn btn-primary'] ) ?>	
		<?php ActiveForm::end(); ?>
	</div>

</div>




<script>

window.onload = function(){

	tip();

}



</script>
