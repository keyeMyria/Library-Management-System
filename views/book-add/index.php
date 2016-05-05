<?php

use app\assets\LayerGlobalAsset;
use app\assets\BookAddAsset;
use app\assets\DropDownGlobalAsset;

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

use yii\helpers\Url;
use yii\helpers\Html;

LayerGlobalAsset::register( $this );
BookAddAsset::register( $this );
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


<div class="all">
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
				<?= Html::dropDownList('bookType', null, $bookTypeData, ['class' => 'basic-usage-demo' ] ); ?>
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




</div>
