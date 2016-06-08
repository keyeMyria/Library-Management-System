<?php

use app\assets\BookAddAsset;
use app\assets\IndexGlobalAsset;
use app\assets\LayerGlobalAsset;
use app\assets\DropDownGlobalAsset;

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

use yii\helpers\Url;
use yii\helpers\Html;

BookAddAsset::register( $this );
LayerGlobalAsset::register( $this );
IndexGlobalAsset::register( $this );
DropDownGlobalAsset::register( $this );



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
	本页面是 图书添加 , 由于需要选中下拉框，所以在提交时
	要用 js 去检查是否漏选下拉框。这样的话，就无法用
	bootstrap 给的响应式方案了，因为 js 要判断的下拉框
	选中的问题。
	所以，这里只写上了 <div class='md-all all'>， 因此页
	面在中屏上显示是没有问题的，但是大屏就有问题了，
	所以我要用js解决大屏 元素 位置偏左的问题。
-->

<div class='container'>
	
	<div class='row'>	
		

			<div class="md-all all">
				<div class="bread-nav">
					<span>图书档案</span>  >
					<span>图书添加</span>
				</div>


			<?php
			/**----------------------------------------------------
			 * 图书档案添加 
			 */
			?>
				<div class="input-box">
					<?php $form = ActiveForm::begin();  ?> 
						<?= $form->field( $model, 'bookInfoBookISBN') ->textinput(['placeholder' => 'ISBN']) -> label( false ) ?>
						<?= $form->field( $model, 'bookInfoBookName') ->textinput(['placeholder' => '图书名称']) -> label( false ) ?>

						<div id="main">
							<?= Html::dropDownList('bookType', null, $bookTypeData, ['class' => 'basic-usage-demo', ] ); ?>
						</div>
						<div class="help-block"></div>	
						
						<?= $form->field( $model, 'bookInfoBookAuthor') ->textinput(['placeholder' => '作者']) -> label( false ) ?>
						<?= $form->field( $model, 'bookInfoBookTranslator') ->textinput(['placeholder' => '译者 (选填)']) -> label( false ) ?>


						<div id="main">
							<?= Html::dropDownList('publisher', null, $publisherData, ['class' => 'basic-usage-demo' ] ); ?>
						</div>
						<div class="help-block"></div>	

						<?= $form->field( $model, 'bookInfoBookPrice') ->textinput(['placeholder' => '图书单价']) -> label( false ) ?>
						<?= $form->field( $model, 'bookInfoBookPage') ->textinput(['placeholder' => '图书页码']) -> label( false ) ?>

						<div id="main">
							<?= Html::dropDownList('bookshelf', null, $bookshelfData, ['class' => 'basic-usage-demo' ] ); ?>
						</div>
						<div class="help-block"></div>	

						<?= Html::submitButton('新增', ['class' => 'btn btn-primary book-add-btn'])	?>		
					<?php ActiveForm::end()  ?>
				</div>
			
			</div> <!-- class='lg-all all'  end -->

		</div> 

	</div>

</div>

<script>
	window.onload = function()
	{
		dropDown();
		isSelectedOptions();
		optimizeOpsInLarge();
		tip();
	}

	function dropDown()
	{
		$(document).ready(function(){
			$('.basic-usage-demo').fancySelect();	
		});
	}

	// 判断下拉框是否已经选择完毕
	function isSelectedOptions()
	{
		$('.book-add-btn').click(function(){
			elmLength = $('.selected').length;
			for( var i=0; i < elmLength; i++){
				
				if ( $('.selected')[i].innerHTML === '请选择'){
					// 如果获取到的元素内的文本是 '请选择' 的话, 说明了还有下拉框未选择
					alert('请选择下拉框完毕后再提交');
					return false;
				}	
			}
		
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
