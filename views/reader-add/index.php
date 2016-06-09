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


<!--
    本页面是 读者添加 , 由于需要选中下拉框，所以在提交时
    要用 js 去检查是否漏选下拉框。这样的话，就无法用
    bootstrap 给的响应式方案了，因为 js 要判断的下拉框
    选中的问题。
    所以，这里只写上了 <div class='md-all all'>， 因此页
    面在中屏上显示是没有问题的，但是大屏就有问题了，
    所以我要用js解决大屏 元素 位置偏左的问题。
-->

<div class='container'>
    
    <div class='row'> 

		<div class='md-all all'>

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

	</div> <!-- class='row'  end -->
</div> <!-- class='container' end  -->







<script>
	window.onload = function()
	{
		dropDown();	
		optimizeOpsInLarge();
		tip();
	}

	function dropDown()
	{
		$(document).ready(function(){
			$('.basic-usage-demo').fancySelect();	
		});
	}


	// 解决此页面在大屏的显示器下 页面 偏左移的问题
	// 在大屏显示器下优化元素位置
	function optimizeOpsInLarge()
	{
		lg_all = $('.md-all');
		form_group = $('.input-box .form-group');

		screenWidth = $(document).width();      
		// 当屏幕宽度大于 1500px
		if( screenWidth > 1500 ){
			lg_all.css('width', '94%');
			lg_all.css('margin-left', '-13%');
			form_group.css('margin', '13px auto');
		}
	}


</script>
