<?php

use app\assets\LayerGlobalAsset;
use app\assets\DropDownGlobalAsset;
use app\assets\ReaderAddAsset;

use yii\helpers\Url;
use yii\helpers\Html;

use kartik\date\DatePicker;

use yii\widgets\ActiveForm;

LayerGlobalAsset::register( $this );
DropDownGlobalAsset::register( $this );
ReaderAddAsset::register( $this );


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

	<!-- 面包屑 -->
	<div class='bread-nav'>
		<span>读者管理</span> >
		<span>添加读者</span>
	</div>

	
	<!-- 文本框 -->
	<div class='input-box' >

		<?php $form = ActiveForm::begin() ?>

			<?= $form-> field( $model, 'readerNumber') -> textinput(['placeholder' => '读者编号 (9位数字)']) -> label( false ) ?>
			<?= $form-> field( $model, 'readerName') -> textinput(['placeholder' => '姓名']) -> label( false ) ?>
			<div id='main'>
				<?= Html::dropDownList('readerType', null, $readerTypeData, ['class' => 'basic-usage-demo'] )   ?>
			</div>
			<div class='help-block'></div>
			
			<?php echo DatePicker::widget([
					'name' => 'readerBirthday',
					'options' => ['placeholder' => '出生年月'],
					'value' => date('Y-m-d'),
					'pluginOptions' => [
						'autoclose' => true,
						'format' => 'yyyy-mm-dd',
						'todayHighlight' => true,	
					]
			]);?>
			<div class='help-block'></div>

			<div id='main'>
				<?= Html::dropDownList('readerCertificate', null, $readerCertificate, ['class' => 'basic-usage-demo'] )   ?>
			</div>
			<div class='help-block'></div>

			<?= $form-> field( $model, 'readerCertificateNumber') -> textinput(['placeholder' => '证件号码']) -> label( false ) ?>
			<?= $form-> field( $model, 'readerPhone') -> textinput(['placeholder' => '手机号码']) -> label( false ) ?>
			<?= $form-> field( $model, 'readerEmail') -> textinput(['placeholder' => '电子邮件']) -> label( false ) ?>


			<?= Html::submitButton('新增', ['class' => 'btn btn-primary']) ?>
		<?php ActiveForm::end() ?>


	</div>


</div>

<script>
	window.onload = function()
	{
		dropDown();	
		tip();
	}

	function dropDown()
	{
		$(document).ready(function(){
			$('.basic-usage-demo').fancySelect();	
		});
	}

</script>
