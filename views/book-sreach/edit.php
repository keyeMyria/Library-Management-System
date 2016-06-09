<?php

use app\assets\IndexGlobalAsset;
use app\assets\LayerGlobalAsset;
use app\assets\UpdateGlobalAsset;
use app\assets\BookAddAsset;
use app\assets\DropDownGlobalAsset;
use app\assets\BookSreachEditAsset;

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

use yii\helpers\Url;
use yii\helpers\Html;

IndexGlobalAsset::register( $this );
LayerGlobalAsset::register( $this );
UpdateGlobalAsset::register( $this );
BookAddAsset::register( $this );
DropDownGlobalAsset::register( $this );
BookSreachEditAsset::register( $this );


/** -------------------------------------------------------
 * 判断是否出现 " 操作成功 " 的 tip 层
 * @var $session['isShowTip'] boolean  为 true 则出现 tip 层，false反之
 */
if ( $session['isShowTip'] ){

	echo " <script>function tip(){ layer.msg('{$session['tipContent']}', { icon: 1, offset:'100px'}) }  </script>";
	$session['isShowTip'] = false;
}

?>



<div class='update'>

	<div class="all">
		<div class="bread-nav">
			<span>图书搜索</span>  >
			<span>图书编辑</span>
		</div>


	<?php
	/**----------------------------------------------------
	 * 图书档案编辑 
	 */
	?>
		<div class="input-box">
			<?php $form = ActiveForm::begin();  ?> 
				<?= Html::hiddenInput('bookInfoID', $bookInfoData -> PK_bookInfoID )  ?>
				<?= $form->field( $model, 'bookInfoBookISBN') ->textinput(['placeholder' => 'ISBN', 'value' => $bookInfoData -> bookInfoBookISBN]) -> label( false ) ?>
				<?= $form->field( $model, 'bookInfoBookName') ->textinput(['placeholder' => '图书名称', 'value' => $bookInfoData -> bookInfoBookName ]) -> label( false ) ?>

				
				<?= $form->field( $model, 'bookInfoBookAuthor') ->textinput(['placeholder' => '作者', 'value' => $bookInfoData -> bookInfoBookAuthor]) -> label( false ) ?>
				<?= $form->field( $model, 'bookInfoBookTranslator') ->textinput(['placeholder' => '译者 (选填)', 'value' => $bookInfoData -> bookInfoBookTranslator]) -> label( false ) ?>



				<?= $form->field( $model, 'bookInfoBookPrice') ->textinput(['placeholder' => '图书单价', 'value' => $bookInfoData -> bookInfoBookPrice]) -> label( false ) ?>
				<?= $form->field( $model, 'bookInfoBookPage') ->textinput(['placeholder' => '图书页码', 'value' => $bookInfoData -> bookInfoBookPage]) -> label( false ) ?>

				<div id="main" class="bookshelf">
					<?= Html::dropDownList('bookshelf', null, $bookshelfData, ['class' => 'basic-usage-demo'  , 'value' => $bookRelsData->FK_bookshelfID]); ?>
				</div>
				<div class="help-block"></div> 

				<div id="main" class="bookType">
					<?= Html::dropDownList('bookType', null, $bookTypeData, ['class' => 'basic-usage-demo' , 'value' => $bookRelsData->FK_bookTypeID]); ?>
				</div>
				<div class="help-block"></div>

				<div id="main" class="publisher">
					<?= Html::dropDownList('publisher', null, $publisherData, ['class' => 'basic-usage-demo', 'value' => $bookRelsData->FK_publisherID ]); ?>
				</div>
				<div class="help-block"></div>

				<?= Html::submitButton('更新', ['class' => 'btn btn-primary book-edit-btn'])	?>		
			<?php ActiveForm::end()  ?>
		</div>

	</div>

</div>

	<script>
		window.onload = function()
		{
			dropDown();

			selectOption('bookType'); // 进入编辑页面，自动选择下拉框 对应的值
			selectOption('bookshelf');
			selectOption('publisher');

			tip();
		}

		function dropDown()
		{
			$(document).ready(function(){
				$('.basic-usage-demo').fancySelect();	
			});
		}

		
	</script>



